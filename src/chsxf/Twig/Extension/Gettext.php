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
                    new TwigFunction('gettext', 'gettext'),
                    new TwigFunction('_', 'gettext'),
                    new TwigFunction('ngettext', 'ngettext'),
                    new TwigFunction('_n', 'ngettext'),
                    new TwigFunction('dgettext', 'dgettext'),
                    new TwigFunction('_d', 'dgettext'),
                    new TwigFunction('dngettext', 'dngettext'),
                    new TwigFunction('_dn', 'dngettext'),
                    new TwigFunction('dcgettext', 'dcgettext'),
                    new TwigFunction('_dc', 'dcgettext'),
                    new TwigFunction('dcngettext', 'dcngettext'),
                    new TwigFunction('_dcn', 'dcngettext')
            );
        }
    }
}