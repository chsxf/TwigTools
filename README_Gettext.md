# About the `Gettext` Extension

The `Gettext` extension allows most [gettext](https://www.php.net/manual/fr/book.gettext.php) functions to be called directly from the templates.

# Available Methods

The following gettext methods have been made available from the templates:

- [`gettext`](https://www.php.net/manual/fr/function.gettext.php) and the alias `_`
- [`ngettext`](https://www.php.net/manual/fr/function.ngettext.php) and the alias `_n`
- [`dgettext`](https://www.php.net/manual/fr/function.dgettext.php) and the alias `_d`
- [`dngettext`](https://www.php.net/manual/fr/function.dngettext.php) and the alias `_dn`
- [`dcgettext`](https://www.php.net/manual/fr/function.dcgettext.php) and the alias `_dc`
- [`dcngettext`](https://www.php.net/manual/fr/function.dcngettext.php) and the alias `_dcn`

# Setting up the Template Message Extractor

The file `extract_gettext_messages.php` available in the `tools` folder can be set up as an extractor for Twig templates in [poedit](https://poedit.net/), providing you use the same syntax as the `Gettext` extension you can find here.

Here are the proper settings to enter in the extractor settings window:

- **Language**: Custom name. Set it to `Twig` or anything else, at your convenience
- **List of extensions...**: Set it to `*.twig`. You can add any other extension that suits your needs.
- **Parser command**: `/path/to/php -f /path/to/extract_gettext_messages.php -- -o %o %C %K --xgettext-path /path/to/xgettext/parent/folder/ %F`
- **An item in keyword list**: `-k%k` (should be the default)
- **An item in input files list**: `%f` (should be the default)
- **Source code charset**: `‪--from-code=%c` (should be the default)

A common path for `xgettext` on macOS is:<br />
`/Applications/Poedit.app/Contents/PlugIns/GettextTools.bundle/Contents/MacOS/bin/`
