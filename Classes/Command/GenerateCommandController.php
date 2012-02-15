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
class Tx_Clitools_Command_GenerateCommandController extends Tx_Extbase_MVC_Controller_CommandController {

  /**
   * @var ioService Tx_Clitools_Service_IOService
   */
  private $ioService;


  /**
   * @param Tx_Clitools_Service_IOService $service
   */
  public function injectIOService(Tx_Clitools_Service_IOService $service) {
    $this->ioService = $service;
  }


  /**
   * Generate a Task Class
   *
   * Generates a Task Class with corresponding Test File if PHPunit is installed
   *
   * @param string $extKey Extension Key
   * @param string $name The task Name
   */
  public function taskCommand($extKey, $name) {
  }


  /**
   * Generate a extension skeleton:
   *
   * Generates a extension using the extention builders facilities
   *
   * @param string $extKey The Extension Key
   * @param string $name The Extension Name
   */
  public function extensionCommand($extKey, $name) {
    $generator = $this->objectManager->get('Tx_Clitools_Generators_Extension_Generator');
    $generator->injectIOService($this->ioService);
    $generator->setExtKey($extKey);
    $generator->setName($name);
    $this->run(function() use ($generator) {
      $generator->start();
    });
  }


  private function run($func) {
    try {
      $func();
    } catch(Exception $e) {
      $this->ioService->out($e->getMessage(), Tx_Clitools_Service_IOService::WARNING);
    }
  }
}
