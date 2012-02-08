<?php
if (TYPO3_MODE=='BE')  {
  $TYPO3_CONF_VARS['SC_OPTIONS']['GLOBAL']['cliKeys'][$_EXTKEY] = array('EXT:' . $_EXTKEY . '/cli/class.clitools.php', '_CLI_user');
}

