<?php

namespace Drupal\glico_submission\Validator;

/**
 * Class ValidatorRequired.
 *
 * @package Drupal\glico_submission\Validator
 */
class ValidatorRequired extends BaseValidator {

  /**
   * {@inheritdoc}
   */
  public function validates($value) {
    return is_array($value) ? !empty(array_filter($value)) : !empty($value);
  }

}
