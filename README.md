TwigTools
=========

A collection of Twig tools and extensions

Available Tools
===============

* `Xhaleera_Twig_Extension_Gettext` provides gettext functions for use in Twig templates
* `Xhaleera_Twig_Extension_Lazy` provides a Twig tag to temporarily skip strict variable checking
* `Xhaleera_Twig_Extension_Switch` provides a switch case tag implementation for Twig templates

Setting Up Twig Template Message Extractor with Poedit
======================================================

The file `extract_gettext_messages.php` available in the repository can be set up as an extractor for Twig templates in Poedit, providing you use the same syntax as the Gettext extension you can find here.

A common path for xgettext on macOS is:
`/Applications/Poedit.app/Contents/PlugIns/GettextTools.bundle/Contents/MacOS/bin/`

Here are the proper settings to enter in the extractor settings window:
* __Language__: Custom name. Set it to `Twig` or anything else, at your convenience
* __List of extensions...__: Set it to `*.twig`. You can add any other extension that suits your needs.
* __Parser command__: `php -f /path/to/extract_gettext_messages.php -- -o %o %C %K --xgettext-path /path/to/xgettext/parent/folder/ %F`
* __An item in keyword list__: `-k%k` (should be the default)
* __An item in input files list__: `%f` (should be the default)
* __Source code charset__: `‪--from-code=%c` (should be the default)

License
=======

Source code is released under the terms of the GNU General Public License v2 if not specified otherwise.
