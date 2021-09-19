# About the `SwitchCase` Extension

This extension allows you to use switch/case-like syntax in your templates.

# Usage

**Note:** A `case_default` is mandatory in every `switch` instance.

```twig
{% switch value %}
    {% case 1 %}
        This is the first model.
    {% case 10 %}
        This is the tenth model.
    {% case_default %}
        This model is unidentified.
{% endswitch %}
```