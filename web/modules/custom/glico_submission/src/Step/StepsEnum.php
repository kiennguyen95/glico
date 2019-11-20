<?php

namespace Drupal\glico_submission\Step;

/**
 * Class StepsEnum.
 *
 * @package Drupal\glico_submission\Step
 */
abstract class StepsEnum {

  /**
   * Steps used in form.
   */
  const STEP_ONE = 1;
  const STEP_TWO = 2;
  const STEP_THREE = 3;
  const STEP_PREVIEW = 4;
  const STEP_FINALIZE = 6;

  /**
   * Return steps associative array.
   *
   * @return array
   *   Associative array of steps.
   */
  public static function toArray() {
    return [
      self::STEP_ONE => 'step-one',
      self::STEP_TWO => 'step-two',
      self::STEP_THREE => 'step-three',
      self::STEP_PREVIEW => 'step-preview',
      self::STEP_FINALIZE => 'step-finalize',
    ];
  }

  /**
   * Map steps to it's class.
   *
   * @param int $step
   *   Step number.
   *
   * @return bool
   *   Return true if exist.
   */
  public static function map($step) {
    $map = [
      self::STEP_ONE => 'Drupal\\glico_submission\\Step\\StepOne',
      self::STEP_TWO => 'Drupal\\glico_submission\\Step\\StepTwo',
      self::STEP_THREE => 'Drupal\\glico_submission\\Step\\StepThree',
      self::STEP_PREVIEW => 'Drupal\\glico_submission\\Step\\StepPreview',
      self::STEP_FINALIZE => 'Drupal\\glico_submission\\Step\\StepFinalize',
    ];

    return isset($map[$step]) ? $map[$step] : FALSE;
  }

}
