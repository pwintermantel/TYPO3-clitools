<?php
/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 * @package clitools
 **/
class Tx_Clitools_Generators_Class_Generator extends Tx_Clitools_Generator_Base
      implements Tx_Clitools_Generator_Interface
{
  /**
   *
   */
  public function start($argv) {
    $this->checkDependencies();
    tx_clitools::info('Creating Class and Test Files');
    $classType  = ucfirst(trim($argv[0]));
    $extKey     = trim($argv[1]);
    $className  = ucfirst(trim($argv[2]));
       var_dump($argv);
    $paths = $this->assembleFilePaths($extKey, $classType, $className);
    var_dump($paths);
  }


  /**
   * assembles path and filename to write the class to
   *
   * @param string $extkey Extension KEy
   * @param string $classType The Classtype
   * @param string $className The class name
   * @return array The assembled paths
   **/
  private function assembleFilePaths($extKey, $classType, $className) {
     $classPath = array('Classes', $classType, $className);
     $testPath = array('Tests', 'Unit', $classType, $className);
     return array(
        'class' => $this->getExtensionPath($extKey) . implode('/', $classPath) . '.php',
        'test'  => $this->getExtensionPath($extKey) . implode('/', $testPath) . 'Test.php'
      );
  }


  /**
   * Checks if Extension Dir exists
   * @return void
   */
  private function getExtensionPath($extKey) {
    $path = t3lib_extMgm::extPath($extKey);
    if (!is_dir($path)) {
      throw new Tx_Clitools_Exception_Generator('Extension Directory not found at ' . $path);
    }
    return $path;
  }
}

