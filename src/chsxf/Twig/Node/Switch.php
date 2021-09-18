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
	    public function compile(Twig_Compiler $compiler)
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
	                ->subcompile($case->getNode('expression'))
	                ->raw(":\n")
	                ->indent()
	                ->subcompile($case->getNode('body'))
	                ->raw("break;\n")
					->outdent();
	        }
	
	        if (null !== $this->getNode('default')) {
	            $compiler
	                ->write("default:\n")
	                ->indent()
	                ->subcompile($this->getNode('default'))
	                ->raw("break;\n")
					->outdent();
	        }
	
	        $compiler
	            ->outdent()
	            ->raw("}\n");
	    }
	}
