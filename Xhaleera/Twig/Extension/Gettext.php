<?php
	/**
	 * Gettext extension for Twig
	 * 
	 * @author Christophe SAUVEUR <christophe@xhaleera.com>
	 * @version 1.0
	 */
	class Xhaleera_Twig_Extension_Gettext extends Twig_Extension
	{
		/**
		 * Name of the extenstion
		 * @return string 
		 * 
		 * @see Twig_ExtensionInterface::getName()
		 */
		public function getName() {
			return __CLASS__;
		}
		
		/**
		 * List of defined functions by the extension
		 * @return array
		 * 
		 * @see Twig_Extension::getFunctions()
		 */
		public function getFunctions()
		{
			return array(
					new Twig_SimpleFunction('gettext', array(&$this, 'gettext')),
					new Twig_SimpleFunction('_', array(&$this, 'gettext')),
					new Twig_SimpleFunction('ngettext', array(&$this, 'ngettext')),
					new Twig_SimpleFunction('_n', array(&$this, 'ngettext')),
					new Twig_SimpleFunction('dgettext', array(&$this, 'dgettext')),
					new Twig_SimpleFunction('_d', array(&$this, 'dgettext')),
					new Twig_SimpleFunction('dngettext', array(&$this, 'dngettext')),
					new Twig_SimpleFunction('_dn', array(&$this, 'dngettext'))
			);
		}
		
		/**
		 * Returns a localized message
		 * 
		 * This function uses the native gettext() function to retrieve the message
		 * and accepts a variable count of arguments, so you can pass
		 * replacements in your localized messages.
		 * 
		 * Example:
		 * _("Hello %s!", name)
		 * 
		 * @param string $msgid Message id
		 * @return string
		 * 
		 * @link http://php.net/manual/en/function.gettext.php
		 * @link http://php.net/manual/en/function.sprintf.php
		 */
		public function gettext($msgid) {
			$msg = gettext($msgid);
			if (func_num_args() == 1)
				return $msg;
			else
			{
				$args = func_get_args();
				$args[0] = $msg;
				return call_user_func_array('sprintf', $args);
			}
		}
		
		/**
		 * Returns a localized message from a specific domain
		 *
		 * This function uses the native dgettext() function to retrieve the message
		 * and accepts a variable count of arguments, so you can pass
		 * replacements in your localized messages.
		 *
		 * Example:
		 * _d("mydomain", "Hello %s!", name)
		 *
		 * @param string $domain Message domain
		 * @param string $msgid Message id
		 * @return string
		 *
		 * @link http://php.net/manual/en/function.dgettext.php
		 * @link http://php.net/manual/en/function.sprintf.php
		 */
		public function dgettext($domain, $msgid) {
			$msg = dgettext($domain, $msgid);
			if (func_num_args() == 2)
				return $msg;
			else
			{
				$args = func_get_args();
				array_shift($args);
				$args[0] = $msg;
				return call_user_func_array('sprintf', $args);
			}
		}
		
		/**
		 * Returns a string based on plural forms of the message
		 * 
		 * This function uses the native ngettext() function to retrieve the message
		 * then uses sprintf() to replace the unit count in the string.
		 * So, your message strings should be of the form "Dispose of %d unit" and "Dispose of %d units"
		 * %d will be replaced by sprintf() with the provided unit count
		 * 
		 * This functions also accepts a variable count of arguments, so you can pass other
		 * replacements in your localized messages.
		 * The unit count is always the first parameter, but you can use sprintf()'s indexed notation
		 * to identify any other parameter as a replacement.
		 * 
		 * Example:
		 * _n("Hello %2$s, you have %1$d coin left.", "Hello %2$s, you have %1$d coins left", count, name)
		 * 
		 * @param string $msgid1 Singular form message id
		 * @param string $msgid2 Plural form message id
		 * @param int $n Number of units to consider
		 * @return string
		 * 
		 * @link http://php.net/manual/en/function.ngettext.php
		 * @link http://php.net/manual/en/function.sprintf.php
		 */
		public function ngettext($msgid1, $msgid2, $n)
		{
			$msg = ngettext($msgid1, $msgid2, $n);
			if (func_num_args() == 3)
				return sprintf($msg, $n);
			else
			{
				$args = func_get_args();
				array_shift($args);
				$args[0] = $msg;
				return call_user_func_array('sprintf', $args);
			}
		}
		
		/**
		 * Returns a string based on plural forms of the message from a specific domain
		 *
		 * This function uses the native dngettext() function to retrieve the message
		 * then uses sprintf() to replace the unit count in the string.
		 * So, your message strings should be of the form "Dispose of %d unit" and "Dispose of %d units"
		 * %d will be replaced by sprintf() with the provided unit count
		 *
		 * This functions also accepts a variable count of arguments, so you can pass other
		 * replacements in your localized messages.
		 * The unit count is always the first parameter, but you can use sprintf()'s indexed notation
		 * to identify any other parameter as a replacement.
		 *
		 * Example:
		 * _dn("mydomain", "Hello %2$s, you have %1$d coin left.", "Hello %2$s, you have %1$d coins left", count, name)
		 *
		 * @param string $domain Message domaine
		 * @param string $msgid1 Singular form message id
		 * @param string $msgid2 Plural form message id
		 * @param int $n Number of units to consider
		 * @return string
		 *
		 * @link http://php.net/manual/en/function.dngettext.php
		 * @link http://php.net/manual/en/function.sprintf.php
		 */
		public function dngettext($domain, $msgid1, $msgid2, $n)
		{
			$msg = dngettext($domain, $msgid1, $msgid2, $n);
			if (func_num_args() == 4)
				return sprintf($msg, $n);
			else
			{
				$args = func_get_args();
				array_splice($args, 0, 2);
				$args[0] = $msg;
				return call_user_func_array('sprintf', $args);
			}
		}
	}