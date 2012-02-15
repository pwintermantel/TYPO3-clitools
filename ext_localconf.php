<?php

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers']['clitools'] = 'Tx_Clitools_Command_GenerateCommandController';

// Fix for strange bug when phpunit /pear autoloader could not find class
//require_once(PATH_t3lib . '/utility/class.t3lib_utility_math.php');
