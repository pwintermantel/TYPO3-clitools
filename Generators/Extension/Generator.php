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
    $this->ext = t3lib_div::makeInstance('Tx_ExtensionBuilder_Domain_Model_Extension');
    $this->ext->setExtensionKey($argv[0]);
    $this->ext->setName($argv[1]);
    $this->writeExtension();
  }

  private function writeExtension() {
    if (!is_dir($this->ext->getExtensionDir())) {
        t3lib_div::mkdir($this->ext->getExtensionDir());
		} else {
      fwrite(STDOUT, "Directory {$this->ext->getExtensionDir()} not empty. Overwrite? [y/N] \n"); // Output - prompt user
      $overwrite = chop(fgets(STDIN));
      if(!preg_match('/y/i', $overwrite)) {
        return;
      }
    }
    $this->codeGenerator->build($extension);
  }
}

