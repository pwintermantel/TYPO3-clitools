<?php
/**
 *
 * Interface for all generators
 *
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 * @package clitools
 **/
interface Tx_Clitools_Generator_Interface
{

  /**
   * Main entry point for generator
   * @param $args array Generator arguments
   */
  public function start($args);
}
