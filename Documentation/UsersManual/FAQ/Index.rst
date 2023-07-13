.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.rst.txt

.. _faq:

FAQ
===

.. toctree::
	:maxdepth: 5
	:titlesonly:

Q: When I download the localization package and open the XML file, my XML editor fails (Error: encoding is not correct UTF-8). What can I do?
	A: The reason might be a database and/or configuration problem. Check the TYPO3 configuration for UTF-8 database support. You might also want to set :html:`TYPO3_CONF_VARS[BE][forceCharset] = utf-8`, and check :html:`[SYS][multiplyDBfieldSize]` and :html:`[SYS][UTF8filesystem]`. (See http://wiki.typo3.org/index.php/UTF-8_support for more information). Localization Manager assumes that you are using UTF-8 (which is the most highly recommended for multilingual websites).

Q: I get the error message “Call-time pass-by-reference has been deprecated...” under PHP5. What can I do?
	A: Add `php_value allow_call_time_pass_reference 1` to your .htaccess file.

Q: My exported files are not valid XML. What can I do?
	A: Problem is mainly due to nasty bodytext fields or other database fields where editors are allowed to insert HTML code. Try to use Tidy to clean the contents of theses fields. Or use an XML editor and fix the errors manually ;-)
