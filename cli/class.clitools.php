<?php
/**
 * Copyright (c) 2012 Philipp Wintermantel
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished 
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR
 * IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 * @package clitools
 *
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
   * @TODO throw exception when invalid generator is called
   */
  public function dispatch($argv) {
    try {
      // @TOTO Load this from TS Config Object
      switch($argv[1]) {
        case 'g':
        case 'generate':
            $generatorKey = self::findGeneratorByAlias($argv[2]);
            require_once dirname(dirname(__FILE__)) . "/Generators/{$generatorKey}/Classes/Generator.php";
            $generator = t3lib_div::makeInstance('Tx_Clitools_Generators_' . $generatorKey . '_Generator');
            $generator->start(array_slice($argv, 2));
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
   * Finds generator by alias
   */
  public static function findGeneratorByAlias($arg) {
    $arg = ucfirst(trim($arg));
    $generators = array(
      'Class' => array('Task')
    );
    foreach ($generators as $g => $aliases) {
      if(in_array($arg, $aliases)) {
        return $g;
      }
    }
    return $arg;
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
