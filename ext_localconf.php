<?php
if (TYPO3_MODE=='BE')  {
  $TYPO3_CONF_VARS['SC_OPTIONS']['GLOBAL']['cliKeys'][$_EXTKEY] = array('EXT:' . $_EXTKEY . '/cli/class.clitools.php', '_CLI_user');
}
// Fix for strange bug when phpunit /pear autoloader could not find class
require_once(PATH_t3lib . '/utility/class.t3lib_utility_math.php');
