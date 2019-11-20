<?php

namespace Drupal\glico_submission\Button;

use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepTwoNextButton.
 *
 * @package Drupal\glico_submission\Button
 */
class StepTwoNextButton extends BaseButton {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'next';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'submit',
      '#value' => t('Next'),
      '#goto_step' => StepsEnum::STEP_THREE,
      '#submit_handler' => 'storeValues',
    ];
  }

}
