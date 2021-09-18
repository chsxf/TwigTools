<?php
namespace chsxf\Twig\Node {
	use \Twig\Node\Node;
	use \Twig\Compiler;

    /**
     * Lazy variable check node for Twig
     *
     * @author Christophe SAUVEUR <christophe@xhaleera.com>
     * @version 1.0
     */
    class Lazy extends Node
    {
        /**
         * Constructor
         * @param Node $body Node surrounded by the tag
         * @param int $lineno Line number of this node
         * @param string $tag Tag name for this node
         */
        public function __construct(Node $body, $lineno, $tag)
        {
            parent::__construct(array('body' => $body), array(), $lineno, $tag);
        }
    
        /**
         * (non-PHPdoc)
         * @see Twig_Node::compile()
         */
        public function compile(Compiler $compiler)
        {
            $compiler->addDebugInfo($this)
				->write('$env_strict = $this->env->isStrictVariables();')->raw("\n")
				->write('$this->env->disableStrictVariables();')->raw("\n")
				->subcompile($this->getNode('body'))
				->write('if ($env_strict) $this->env->enableStrictVariables();')->raw("\n");
        }
    }
}