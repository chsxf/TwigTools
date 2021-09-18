<?php
namespace chsxf\Twig\TokenParser {

	use \Twig\TokenParser\AbstractTokenParser;
	use \Twig\Token;
	use \Twig\Node\Node;
	use \Twig\Error\SyntaxError;

    /**
     * Switch token parser for Twig
     *
     * @author Christophe SAUVEUR <christophe@xhaleera.com>
     * @version 1.0
     */
    class SwitchCase extends AbstractTokenParser
    {
        /**
         * Parses a token and returns a node.
         *
         * @param \Twig\Token $token A Twig_Token instance
         *
         * @return \Twig_NodeInterface A Twig_NodeInterface instance
         */
        public function parse(Token $token)
        {
            $lineno = $token->getLine();
            $parser = $this->parser;
            $stream = $parser->getStream();
            $exprParser = $parser->getExpressionParser();
            
            $default = null;
            $cases = array();
            $end = false;
            
            $name = $exprParser->parseExpression();
            if ($stream->getCurrent()->getType() == Token::BLOCK_END_TYPE) {
                $stream->next();
                $parser->subparse(array($this, 'decideIfFork'));
            }
            
            while (!$end) {
                $v = $stream->next();
                switch ($v->getValue()) {
                    case 'case_default':
                        if ($default !== null) {
                            throw new SyntaxError(sprintf("Error at line %d. Switch blocks must contain only one case_default sub-block.", $v->getLine()));
                        }
                        $stream->expect(Token::BLOCK_END_TYPE);
                        $default = $parser->subparse(array($this, 'decideIfFork'));
                        break;
    
                    case 'case':
                        $expr = $exprParser->parseExpression();
                        $stream->expect(Token::BLOCK_END_TYPE);
                        $body = $parser->subparse(array($this, 'decideIfFork'));
                        $cases[] = new Node(array('expression' => $expr, 'body' => $body));
                        break;
    
                    case 'endswitch':
                        $end = true;
                        break;
    
                    default:
                        throw new SyntaxError(sprintf('Unexpected end of template. Twig was looking for the following tags "case", "default", or "endswitch" to continue the "switch" block started at line %d)', $lineno), -1);
                }
            }
    
            $stream->expect(Token::BLOCK_END_TYPE);
    
            return new \chsxf\Twig\Node\SwitchCase($name, new Node($cases), $default, $lineno, $this->getTag());
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
}