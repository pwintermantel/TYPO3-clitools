<?php
/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 * @package clitools
 **/
class Tx_Clitools_Generators_Class_Generator extends Tx_Clitools_Generator_Base
      implements Tx_Clitools_Generator_Interface
{
  /**
   * Entry method for this generator
   *
   * @param array arguments for this generator
   * @return void
   * @throws Tx_Clitools_Exception_Generator
   */
  public function start($argv) {
    $this->checkDependencies();
    tx_clitools::info('Creating Class and Test Files');
    $classType  = ucfirst(trim($argv[0]));
    $extKey     = trim($argv[1]);
    $className  = ucfirst(trim($argv[2]));
    $paths = $this->assembleFilePaths($extKey, $classType, $className);
    t3lib_div::mkdir_deep($paths['class']);
    if (!t3lib_div::writeFile($paths['class'] . '/' . $className . '.php', $this->getFileContent($classType, $className, $extKey)))  {
      throw new Tx_Clitools_Exception_Generator('Class File could not be written');
    }
    t3lib_div::mkdir_deep($paths['test']);
    if (!t3lib_div::writeFile($paths['test'] . '/' . $className . 'Test.php', $this->getFileContent($classType, $className , $extKey, true)))  {
      throw new Tx_Clitools_Exception_Generator('Test File could not be written');
    }
  }


  private function getFileContent($classType, $className, $extKey, $test) {
    $view = t3lib_div::makeInstance('Tx_Fluid_View_StandaloneView');
    $testSuffix = $test ? 'Test' : '';
    $tmpl = file_get_contents(dirname(dirname(__FILE__)) . '/templates/' . $classType . $testSuffix . '.tmpl');
    $view->setTemplateSource($tmpl);
    $view->setFormat('php');
    $view->assign('className', ucfirst($className));
    $view->assign('extKey', $extKey);
    $view->assign('classExtPart', ucfirst($extKey));
    $view->assign('classType', ucfirst($classType));
    return $view->render();
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
    $classPath = array('Classes', $classType);
    $testPath  = array('Tests', 'Unit', $classType);
    return array(
      'class' => $this->getExtensionPath($extKey) . implode('/', $classPath),
      'test'  => $this->getExtensionPath($extKey) . implode('/', $testPath)
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
