# About the `Lazy` Extension

This extension allows you to use undefined variables in Twig templates even if `strict_variables` is used in the current environment.

# Usage

If the `user` variable is not defined in the current context and `strict_variables` is used, the following code will produce an error.

```twig
Hello, {{ user }}! 
```

Use the following tags to avoid this error:

```twig
{% lazy %}
Hello, {{ user }}!
{% endlazy %}
```