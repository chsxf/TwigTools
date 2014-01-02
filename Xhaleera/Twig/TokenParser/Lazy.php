<?php
	/**
	 * Lazy variable check token parser for Twig
	 * 
	 * @author Christophe SAUVEUR <christophe@xhaleera.com>
	 * @version 1.0
	 */
	class Xhaleera_Twig_TokenParser_Lazy extends Twig_TokenParser
	{
		/**
		 * (non-PHPdoc)
		 * @see Twig_TokenParserInterface::parse()
		 */
		public function parse(Twig_Token $token) {
			$lineno = $token->getLine();
				
			$this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);
			$body = $this->parser->subparse(array($this, 'decideLazyEnd'), true);
			$this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);
				
			return new Xhaleera_Twig_Node_Lazy($body, $lineno, $this->getTag());
		}
	
		/**
		 * Decides when to end a lazy token
		 * @param Twig_Token $token
		 * @return boolean
		 */
		public function decideLazyEnd(Twig_Token $token)
		{
			return $token->test('endlazy');
		}
	
		/**
		 * (non-PHPdoc)
		 * @see Twig_TokenParserInterface::getTag()
		 */
		public function getTag() {
			return 'lazy';
		}
	}