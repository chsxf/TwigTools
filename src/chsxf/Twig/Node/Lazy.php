<?php
	/**
	 * Lazy variable check node for Twig
	 * 
	 * @author Christophe SAUVEUR <christophe@xhaleera.com>
	 * @version 1.0
	 */
	class Xhaleera_Twig_Node_Lazy extends Twig_Node
	{
		/**
		 * Constructor
		 * @param Twig_NodeInterface $body Node surrounded by the tag
		 * @param int $lineno Line number of this node
		 * @param string $tag Tag name for this node
		 */
		public function __construct(Twig_NodeInterface $body, $lineno, $tag)
		{
			parent::__construct(array('body' => $body), array(), $lineno, $tag);
		}
	
		/**
		 * (non-PHPdoc)
		 * @see Twig_Node::compile()
		 */
		public function compile(Twig_Compiler $compiler)
		{
			$compiler->addDebugInfo($this)
			->write('$env_strict = $this->env->isStrictVariables();')->raw("\n")
			->write('$this->env->disableStrictVariables();')->raw("\n")
			->subcompile($this->getNode('body'))
			->write('if ($env_strict) $this->env->enableStrictVariables();')->raw("\n");
		}
	}