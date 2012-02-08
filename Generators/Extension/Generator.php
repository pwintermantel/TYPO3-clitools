<?php
/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 * @package clitools
 **/
class Tx_Clitools_Generators_Extension_Generator extends Tx_Clitools_Generator_Base
      implements Tx_Clitools_Generator_Interface
{
  /**
   *
   */
  public function start($argv) {
    $this->checkDependencies();
    $this->initializeExtbuilder();	
    $this->ext = t3lib_div::makeInstance('Tx_ExtensionBuilder_Domain_Model_Extension');
    $this->ext->setExtensionKey($argv[0]);
    $this->ext->setName($argv[1]);
    $this->writeExtension();
  }


  /**
   * Checks the dependencies for this generator
   *
   * @TODO 
   */
  public function checkDependencies() {
    if ((float) t3lib_extMgm::getExtensionVersion('extension_builder') < 2) {
      throw new Tx_Clitools_Exception_Dependency('This generator depends on extension_builder 2 higher');
    }
  }

  /**
   * Handles the initializiation of Extbuilder objects
   *
   * @return void
   */
  private function initializeExtbuilder() {
    $this->codeGenerator = t3lib_div::makeInstance('Tx_ExtensionBuilder_Service_CodeGenerator');
    $this->classParser = t3lib_div::makeInstance('Tx_ExtensionBuilder_Utility_ClassParser');
		$this->roundTripService = t3lib_div::makeInstance('Tx_ExtensionBuilder_Service_RoundTrip');
		$this->classBuilder = t3lib_div::makeInstance('Tx_ExtensionBuilder_Service_ClassBuilder');
		$this->templateParser =t3lib_div::makeInstance('Tx_Fluid_Core_Parser_TemplateParser');
		$this->codeGenerator = t3lib_div::makeInstance('Tx_ExtensionBuilder_Service_CodeGenerator');
		$this->codeGenerator->setSettings(array(
				'codeTemplateRootPath' => PATH_typo3conf.'ext/extension_builder/Resources/Private/CodeTemplates/Extbase/',
    ));

    if (class_exists('Tx_Extbase_Object_ObjectManager')) {
			$this->objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
			$this->codeGenerator->injectObjectManager($this->objectManager);
			$this->templateParser->injectObjectManager($this->objectManager);
		}

		$this->roundTripService->injectClassParser($this->classParser);
		$this->classBuilder->injectRoundtripService($this->roundTripService);
		$this->codeGenerator->injectTemplateParser($this->templateParser);
		$this->codeGenerator->injectClassBuilder($this->classBuilder);
  }


  /**
   * Checks if Extension Dir exists and writes Contents
   * @return void
   */
  private function writeExtension() {
    tx_clitools::info('Creating extension');
    if (is_dir($this->ext->getExtensionDir())) {
      fwrite(STDOUT, "Directory {$this->ext->getExtensionDir()} not empty. Overwrite? [y/N] \n"); // Output - prompt user
      $overwrite = chop(fgets(STDIN));
      if(!preg_match('/y/i', $overwrite)) {
        return false;
      }
    }
    $this->codeGenerator->build($this->ext);
  }
}

