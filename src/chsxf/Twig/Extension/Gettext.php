<?php
namespace chsxf\Twig\Extension {
	
    use \Twig\Extension\AbstractExtension;
    use \Twig\TwigFunction;

    /**
     * Gettext extension for Twig
     *
     * @author Christophe SAUVEUR <christophe@xhaleera.com>
     * @version 1.0
     */
    class Gettext extends AbstractExtension
    {
        /**
         * Name of the extension
         * @return string
         *
         * @see Twig_ExtensionInterface::getName()
         */
        public function getName()
        {
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
                    new TwigFunction('gettext', array(&$this, 'gettext')),
                    new TwigFunction('_', array(&$this, 'gettext')),
                    new TwigFunction('ngettext', array(&$this, 'ngettext')),
                    new TwigFunction('_n', array(&$this, 'ngettext')),
                    new TwigFunction('dgettext', array(&$this, 'dgettext')),
                    new TwigFunction('_d', array(&$this, 'dgettext')),
                    new TwigFunction('dngettext', array(&$this, 'dngettext')),
                    new TwigFunction('_dn', array(&$this, 'dngettext'))
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
        public function gettext($msgid)
        {
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
        public function dgettext($domain, $msgid)
        {
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
}