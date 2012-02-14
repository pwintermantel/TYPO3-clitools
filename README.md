Clitools for TYPO3
==================

The Clitools Project aims to increase productivity whilst developing
extensions for TYPO3. One part of that is to expose the extension
builder funtionality to teh commandline. In addition Railsy Generators
can be added.


Dependencies
------------
TYPO3 4.6.1+
Extension Builder 2+

Usage
-----

$: typo3/cli_dispatch.phpsh clitools <task> <arguments ...>

For convienience you can alias the above eg. alias
typo3="typo3/cli_dispatch.phpsh clitools" and use it like this: typo3 g
extension foo

