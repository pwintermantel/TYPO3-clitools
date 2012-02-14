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
class Tx_Clitools_Generators_Class_GeneratorTest extends Tx_Extbase_Tests_Unit_BaseTestCase
{
  public function setUp() {
    require_once(dirname(__FILE__). '/../../Classes/Generator.php');
    $this->generator = t3lib_div::makeInstance('Tx_Clitools_Generators_Class_Generator');
  }


  public function tearDown() {
  }


  /**
   * @TODO Mock out t3lib call
   * @expectedException BadFunctionCallException
   * @test
   */
  public function getExtensionPathShouldThrowGeneratorException() {
    $this->getExposedMethod('getExtensionPath')->invoke($this->generator, 'iisnotthere');
  }


  /**
   * @TODO Mock out t3lib call
   * @test
   */
  public function getExtensionPathShouldReturnPath() {
    $path = $this->getExposedMethod('getExtensionPath')->invoke($this->generator, 'clitools');
    $this->assertEquals(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/', $path);
  }


  /**
   * @test
   */
  public function getFileContentShouldReturnRenderedViewString() {
    $method = $this->getExposedMethod('getFileContent');
    $string = $method->invoke($this->generator, 'Task', 'bar', 'foo');
    $expected = file_get_contents(dirname(dirname(__FILE__)) . '/Fixtures/task.txt');
    $this->assertEquals($expected, $string);
  }


  private function getExposedMethod($method) {
    $class = new ReflectionClass($this->generator);
    $method = $class->getMethod ($method);
    $method->setAccessible(true);
    return $method;
  }
}
