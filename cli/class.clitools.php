<?php
/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 * @package clitools
 **/

if (!defined('TYPO3_cliMode'))  die('You cannot run this script directly!');
require_once(PATH_t3lib.'class.t3lib_cli.php');

class tx_clitools extends t3lib_cli
{

  const GREEN="\033[0;32m";
  const RED="\033[0;31m";
  const YELLOW="\033[0;33m";
  const LIGHTGRAY="\033[0;37m";
  const WHITE="\033[1;37m";

  /**
   * CLI Entry point
   * @param array $argv CLI Arguments
   * @return string CLI Output
   */
  public function dispatch($argv) {
    try {
      // @TOTO Load this from TS Config Object
      switch($argv[1]) {
        case 'g':
        case 'generate':
            $generatorKey = ucfirst($argv[2]);
            require_once dirname(dirname(__FILE__)) . "/Generators/{$generatorKey}/Generator.php";
            $generator = t3lib_div::makeInstance('Tx_Clitools_Generators_' . $generatorKey . '_Generator');
            $generator->start(array_slice($argv, 3));
          break;
        default:
          self::error('Argument not found');
          break;
        }
      } catch(Exception $e) {
        self::error($e->getMessage());
    }
  }


  /**
   * print error text to STDOUT
   *
   * @param string $text $text to print
   * @return void
   * */
  public static function error($text) {
    self::colorPrint(self::RED, $text);
  }


  /**
   * print info text to STDOUT
   *
   * @param string $text text to print
   * @return void
   * */
  public static function info($text) {
    self::colorPrint(self::YELLOW, $text);
  }

  /**
   * print colored text to STDOUT
   *
   * @param string $color output color
   * @param string $text text to print
   * @return void
   * */
  public static function colorPrint($color, $text) {
    print  $color . $text  . self::WHITE . "\n";
  }
}

$clitools = t3lib_div::makeInstance('tx_clitools');
print $clitools->dispatch($_SERVER['argv']);
print chr(10);
