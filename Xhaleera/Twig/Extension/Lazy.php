<?php
	/**
	 * Lazy variable check extension for Twig
	 * 
	 * @author Christophe SAUVEUR <christophe@xhaleera.com>
	 * @version 1.0
	 */
	class Xhaleera_Twig_Extension_Lazy extends Twig_Extension
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
			return array(new Xhaleera_Twig_TokenParser_Lazy());
		}
	}
