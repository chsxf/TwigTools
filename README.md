# About This Project

The main purpose of this package is to extend the capabilities of [Twig](https://twig.symfony.com/) with a collection of tools and extensions.

## Conventions

This repository uses [gitmoji](https://gitmoji.dev) for its commit messages.

# Available Extensions

* [`\chsxf\Twig\Extension\Gettext`](README_Gettext.md) provides gettext functions for use in Twig templates
* [`\chsxf\Twig\Extension\Lazy`](README_Lazy.md) provides a Twig tag to temporarily skip strict variable checking
* [`\chsxf\Twig\Extension\SwitchCase`](README_SwitchCase.md) provides a switch case tag implementation for Twig templates

# Additional Tools

In complement of the `Gettext` extension, this package provides a tool allowing you to easily extract localized strings from Twig templates through 3rd-party tools like [poedit](https://poedit.net/).

See the [`Gettext` extension's documentation](README_Gettext.md) for further information.

# Getting Started

## Requirements

* Twig 2+

## Installation

We strongly recommend using [Composer](https://getcomposer.org/) to install this package.

```
composer require chsxf/twig-tools
```

# License

Source code is released under the terms of the [GNU General Public License v2](LICENSE) if not specified otherwise.
