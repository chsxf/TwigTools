<?php
	/**
	 * Switch token parser for Twig
	 *
	 * @author Christophe SAUVEUR <christophe@xhaleera.com>
	 * @version 1.0
	 */
	class Xhaleera_Twig_TokenParser_Switch extends Twig_TokenParser
	{
		/**
		 * Parses a token and returns a node.
		 *
		 * @param Twig_Token $token A Twig_Token instance
		 *
		 * @return Twig_NodeInterface A Twig_NodeInterface instance
		 */
		public function parse(Twig_Token $token)
		{
			$lineno = $token->getLine();
	        
			$name = $this->parser->getExpressionParser()->parseExpression();
	        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);
	        
	        $default = null;
	        
	        $cases = array();
	        $end = false;
	        $this->parser->getStream()->expect(Twig_Token::BLOCK_START_TYPE);
	        
	        while (!$end) {
	            $v = $this->parser->getStream()->next();
	            switch ($v->getValue())
	            {
	                case 'case_default':
	                	if ($default !== NULL)
	                		throw new Twig_Error_Syntax(sprintf("Error at line %d. Switch blocks must contain only one case_default sub-block.", $v->getLine()));
	                    $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);
	                    $default = $this->parser->subparse(array($this, 'decideIfFork'));
	                    break;
	
	                case 'case':
	                    $expr = $this->parser->getExpressionParser()->parseExpression();
	                    $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);
	                    $body = $this->parser->subparse(array($this, 'decideIfFork'));
	                    $cases[] = array($expr, $body);
	                    break;
	
	                case 'endswitch':
	                    $end = true;
	                    break;
	
	                default:
	                    throw new Twig_Error_Syntax(sprintf('Unexpected end of template. Twig was looking for the following tags "case", "default", or "endswitch" to continue the "switch" block started at line %d)', $lineno), -1);
	            }
	        }
	
	        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);
	
	        return new Twig_Node_Switch($name, new Twig_Node($cases), $default, $lineno, $this->getTag());
		}
	
		/**
		 * Decides when the subparser must stop between different cases
		 * 
		 * @param Twig_Token $token
		 * @return boolean
		 */
		public function decideIfFork($token)
		{
			return $token->test(array('case', 'case_default', 'endswitch'));
		}
	
		/**
		 * Gets the tag name associated with this token parser.
		 *
		 * @return string The tag name
		 */
		public function getTag()
		{
			return 'switch';
		}
	}
