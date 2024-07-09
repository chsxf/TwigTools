<?php
if (PHP_SAPI != 'cli') {
	die('Must be run using the Command-Line Interface.');
}

if (!isset($argv)) {
	$argv = array();
}
$regs = NULL;

array_shift($argv);

// Parameters
$encoding = 'UTF-8';
$outputFile = 'messages.po';
$xgettextPath = '';
$keywords = array('_', 'gettext', 'dgettext:2', 'dcgettext:2', 'ngettext:1,2', 'dngettext:2,3', 'dcngettext:2,3');
$additional_keywords = array();
for ($i = 0; $i < count($argv); $i++) {
	$a = $argv[$i];

	if (!preg_match('/^\-/', $a))
		break;

	if (preg_match('/^\-k(.+)$/', $a, $regs)) {
		$keywords[] = $regs[1];
		$additional_keywords[] = $a;
	} else if ($a == '-o')
		$outputFile = $argv[++$i];

	else if (preg_match('/^' . preg_quote('--from-code=') . '(.+)$/', $a, $regs))
		$encoding = $regs[1];

	else if ($a == '--xgettext-path') {
		$xgettextPath = $argv[++$i];
		if (!preg_match('#/$#', $xgettextPath))
			$xgettextPath .= '/';
	}
}
$keywords = array_unique($keywords);
$regexp = implode('|', array_map(function ($item) {
	$chunks = explode(':', $item, 2);
	return preg_quote($chunks[0], '/');
}, $keywords));
$regexp = "/\b({$regexp})\(/";
$additional_keywords = implode(' ', $additional_keywords);

// Parsing files
$str = "<?php\n";
for (; $i < count($argv); $i++) {
	$a = $argv[$i];

	if (preg_match('/^\-/', $a)) {
		$str = '';
		break;
	}

	$fc = file_get_contents($a);
	$max = strlen($fc);
	preg_match_all($regexp, $fc, $regs, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);

	foreach ($regs as $r) {
		$keyword = $r[0][0];

		$index = $r[0][1] + strlen($keyword);
		$inString = false;
		$level = 0;
		while ($index < $max) {
			$char = $fc[$index];
			$keyword .= $char;

			if ($char == "'" || $char == '"')
				$inString = !$inString;
			else {
				if ($inString) {
					if ($char == '\\')
						$index++;
				} else {
					if ($char == '(')
						$level++;

					else if ($char == ')') {
						if ($level == 0)
							break;
						$level--;
					}
				}
			}
			$index++;
		}

		$str .= "{$keyword};\n";
	}
}

$descriptorspec = array(
	0 => array('pipe', 'r'),
	1 => STDOUT,
	2 => STDERR
);
$cmd = "{$xgettextPath}xgettext --language=PHP --force-po -o {$outputFile} --from-code={$encoding} {$additional_keywords} -";
$pipes = array();
$proc = proc_open($cmd, $descriptorspec, $pipes);

if (is_resource($proc)) {
	fwrite($pipes[0], $str);
	fclose($pipes[0]);

	$return_value = proc_close($proc);

	// Cleaning unwanted special unicode characters
	$lines = file($outputFile, FILE_IGNORE_NEW_LINES);
	$outputLines = [];
	foreach ($lines as $line) {
		if (!preg_match('/^#\:/', $line)) {
			$outputLines[] = $line;
		} else {
			preg_match_all('/\:\d+/', $line, $regs);
			foreach ($regs[0] as $reg) {
				$outputLines[] = "#: standard input{$reg}";
			}
		}
	}
	$result = implode("\n", $outputLines);
	file_put_contents($outputFile, $result);

	exit($return_value);
}

fprintf(STDERR, "Unable to launch xgettext\n");
exit(-1);
