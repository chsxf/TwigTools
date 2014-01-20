<?php
	/**
	 * Switch node for Twig
	 *
	 * @author Christophe SAUVEUR <christophe@xhaleera.com>
	 * @version 1.0
	 */
	class Xhaleera_Twig_Node_Switch extends Twig_Node
	{
	    public function __construct(Twig_NodeInterface $value, Twig_NodeInterface $cases, Twig_NodeInterface $default = null, $lineno, $tag = null)
	    {
	        parent::__construct(array('value' => $value, 'cases' => $cases, 'default' => $default), array(), $lineno, $tag);
	    }
	
	    /**
	     * Compiles the node to PHP.
	     *
	     * @param Twig_Compiler A Twig_Compiler instance
	     */
	    public function compile($compiler)
	    {
	        $compiler->addDebugInfo($this);
			$compiler
				->write("switch (")
				->subcompile($this->getNode('value'))
				->raw(") {\n")
				->indent();
			
	        foreach ($this->getNode('cases') as $case) {
	            $compiler
					->write('case ')
	                ->subcompile($case[0])
	                ->raw(":\n")
	                ->indent()
	                ->subcompile($case[1])
					->outdent();
	        }
	
	        if (null !== $this->getNode('default')) {
	            $compiler
	                ->write("default:\n")
	                ->indent()
	                ->subcompile($this->getNode('default'))
					->outdent();
	        }
	
	        $compiler
	            ->outdent()
	            ->raw("}\n");
	    }
	}
