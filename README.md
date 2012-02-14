Clitools for TYPO3
==================

The Clitools Project aims to increase productivity whilst developing
extensions for TYPO3. One part of that is to expose the extension
builder funtionality to teh commandline. In addition Railsy Generators
can be added.


Dependencies
------------
* TYPO3 4.6.1+
* Extension Builder 2+

Usage
-----

`$: typo3/cli_dispatch.phpsh clitools <task> <arguments ...>`

For convienience you can alias the above eg. `alias
typo3="typo3/cli_dispatch.phpsh clitools"` and use it like this: typo3 g
extension foo

Generators
----------

Invoke generators with task argument `generate` or `g` followed by the
generator type. See below for implemented types

### extension
This generator exposes the Extension Builders funtionality to generate a
bare extension structure.

TODO:
- Add arguments and options for categories and persons
- Implement Tests and improve error proneness

Arguments:
* extension key
* extension name

Example:

`typo3 g extension foo "The Foo Extension"`


### class

This generator creates class skeletons in existing extensions. as type
argument you can put the class category, such as task, service,
controller... A corresponding PHPUnit test file will be created too.

TODO:
- Add more categories (Controller, Model (Nested), Service, Test, Task,
  and maybe custom categories)
- Implement Tests and improve error proneness
- Check for existing files. Existing Files are still overwritten.

Currently implemented categories:
* Task

Arguments:
* extension key
* category


Example:
`typo3 g task fooextension FooTask`


