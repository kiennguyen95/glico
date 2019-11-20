<?php

namespace Drupal\glico_submission\Validator;

/**
 * Interface ValidatorInterface.
 *
 * @package Drupal\glico_submission\Validator
 */
interface ValidatorInterface {

  /**
   * Returns bool indicating if validation is ok.
   */
  public function validates($value);

  /**
   * Returns error message.
   */
  public function getErrorMessage();

}
