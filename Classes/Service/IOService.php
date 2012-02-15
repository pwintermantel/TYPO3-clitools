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
 */
class  Tx_Clitools_Service_IOService
{
  const WARNING = 'warning';
  const NOTICE  = 'notice';
  const SUCCESS = 'success';

  const GREEN="\033[0;32m";
  const RED="\033[0;31m";
  const YELLOW="\033[0;33m";
  const LIGHTGRAY="\033[0;37m";
  const WHITE="\033[1;37m";

  /**
   * @todo make setting configurable
   */
  public function __construct() {
    $this->in = STDIN;

    $this->levelOutput = array(
      self::WARNING => STDERR,
      self::NOTICE  => STDOUT,
      self::SUCCESS => STDOUT
    );

    $this->levelColors = array(
      self::WARNING => self::RED,
      self::NOTICE  => self::YELLOW,
      self::SUCCESS => self::GREEN
    );
  }

  /**
   * Writes formated message to output
   *
   * @param string The Message
   * @param string The Severity Level
   * @return void
   */
  public function out($message, $level=self::NOTICE) {
    fwrite($this->levelOutput[$level], $this->levelColors[$level] . $message . self::WHITE . chr(10));
  }

  /**
   * Returns stdin args
   *
   * @return string
   */
  public function in() {
    return fgets($this->in);
  }
}
