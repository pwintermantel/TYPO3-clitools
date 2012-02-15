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
abstract class Tx_Clitools_Generator_Base
{
  /**
   * @var string
   */
  protected $template = '';

  /**
   * @var string
   */
  protected $extKey = '';

  /**
   * @var string
   */
  protected $name;

  /**
   * @var ioService Tx_Clitools_Service_IOService
   */
  protected $ioService;

  /**
   * @param Tx_Clitools_Service_IOService $service
   */
  public function injectIOService(Tx_Clitools_Service_IOService $service) {
    $this->ioService = $service;
  }

  /**
   * Checks the dependencies for this generator
   *
   * @return void
   */
  public  function checkDependencies() {
  }

  /**
   * Setter for Extension Key
   * @param string $extKey
   */
  public function setExtKey($extKey) {
    $this->extKey = $extKey;
  }

  /**
   * Setter for Name
   * @param string $name
   */
  public function setName($name) {
    $this->name = $name;
  }


  /**
   * Getter for Extension Key
   * @return string $extKey
   */
  public function getExtKey() {
    return $this->extKey;
  }

  /**
   * Getter for Name
   * @return string $name
   */
  public function getName() {
    return $this->name;
  }
}
