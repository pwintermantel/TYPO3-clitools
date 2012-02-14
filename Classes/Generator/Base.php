<?php
/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 * @package clitools
 **/

abstract class Tx_Clitools_Generator_Base
{
  /**
   * @var template
   */
  protected $template = '';

  public function Tx_Clitools_Generator_Base() {
    
  }

   /**
   * Checks the dependencies for this generator
   *
   * @TODO 
   */
  public function checkDependencies() {
  }
}
