<?php
namespace chsxf\Twig\Extension {

    use \Twig\Extension\AbstractExtension;

    /**
     * Switch extension for Twig
     *
     * @author Christophe SAUVEUR <christophe@xhaleera.com>
     * @version 1.0
     */
    class SwitchCase extends AbstractExtension
    {
        /**
         * (non-PHPdoc)
         * @see Twig_ExtensionInterface::getName()
         */
        public function getName()
        {
            return __CLASS__;
        }
        
        /**
         * (non-PHPdoc)
         * @see Twig_Extension::getTokenParsers()
         */
        public function getTokenParsers()
        {
            return array(new \chsxf\Twig\TokenParser\SwitchCase());
        }
    }
}