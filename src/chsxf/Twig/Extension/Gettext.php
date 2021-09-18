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
		 * This function uses the native gettext() function to retrieve the message.
		 * 
		 * @param string $msgid Message id
		 * @return string
		 * 
		 * @link http://php.net/manual/en/function.gettext.php
		 * @link http://php.net/manual/en/function.sprintf.php
		 */
		public function gettext($msgid) {
			return gettext($msgid);
		}
		
		/**
		 * Returns a localized message from a specific domain
		 *
		 * This function uses the native dgettext() function to retrieve the message.
		 *
		 * @param string $domain Message domain
		 * @param string $msgid Message id
		 * @return string
		 *
		 * @link http://php.net/manual/en/function.dgettext.php
		 * @link http://php.net/manual/en/function.sprintf.php
		 */
		public function dgettext($domain, $msgid) {
			return dgettext($domain, $msgid);
		}
		
		/**
		 * Returns a string based on plural forms of the message
		 * 
		 * This function uses the native ngettext() function to retrieve the message.
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
			return ngettext($msgid1, $msgid2, $n);
		}
		
		/**
		 * Returns a string based on plural forms of the message from a specific domain
		 *
		 * This function uses the native dngettext() function to retrieve the message.
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
			return dngettext($domain, $msgid1, $msgid2, $n);
		}
	}