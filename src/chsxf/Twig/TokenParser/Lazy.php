<?php
namespace chsxf\Twig\TokenParser {

	use \Twig\TokenParser\AbstractTokenParser;
	use \Twig\Token;

    /**
     * Lazy variable check token parser for Twig
     *
     * @author Christophe SAUVEUR <christophe@xhaleera.com>
     * @version 1.0
     */
    class Lazy extends AbstractTokenParser
    {
        /**
         * (non-PHPdoc)
         * @see \Twig\TokenParserInterface::parse()
         */
        public function parse(Token $token)
        {
            $lineno = $token->getLine();
                
            $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
            $body = $this->parser->subparse(array($this, 'decideLazyEnd'), true);
            $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
                
            return new \chsxf\Twig\Node\Lazy($body, $lineno, $this->getTag());
        }
    
        /**
         * Decides when to end a lazy token
         * @param \Twig\Token $token
         * @return boolean
         */
        public function decideLazyEnd(Token $token)
        {
            return $token->test('endlazy');
        }
    
        /**
         * (non-PHPdoc)
         * @see \Twig\TokenParserInterface::getTag()
         */
        public function getTag()
        {
            return 'lazy';
        }
    }
}