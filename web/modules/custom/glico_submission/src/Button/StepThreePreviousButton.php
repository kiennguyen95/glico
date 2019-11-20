<?php

namespace Drupal\glico_submission\Button;

use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepThreePreviousButton.
 *
 * @package Drupal\glico_submission\Button
 */
class StepThreePreviousButton extends BaseButton {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'previous';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'submit',
      '#value' => t('Previous'),
      '#goto_step' => StepsEnum::STEP_TWO,
      '#skip_validation' => TRUE,
    ];
  }

}
