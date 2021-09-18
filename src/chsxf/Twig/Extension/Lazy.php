<?php
namespace chsxf\Twig\Extension {
	
	use \Twig\Extension\AbstractExtension;

	/**
	 * Lazy variable check extension for Twig
	 * 
	 * @author Christophe SAUVEUR <christophe@xhaleera.com>
	 * @version 1.0
	 */
	class Lazy extends AbstractExtension
	{
		/**
		 * (non-PHPdoc)
		 * @see Twig_ExtensionInterface::getName()
		 */
		public function getName() {
			return __CLASS__;
		}
		
		/**
		 * (non-PHPdoc)
		 * @see Twig_Extension::getTokenParsers()
		 */
		public function getTokenParsers() {
			return array(new \chsxf\Twig\TokenParser\Lazy());
		}
	}
}
