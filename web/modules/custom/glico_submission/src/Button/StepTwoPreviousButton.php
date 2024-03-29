<?php

namespace Drupal\glico_submission\Button;

use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepTwoPreviousButton.
 *
 * @package Drupal\glico_submission\Button
 */
class StepTwoPreviousButton extends BaseButton {

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
      '#value' => t('Chọn lại video'),
      '#goto_step' => StepsEnum::STEP_ONE,
      '#skip_validation' => TRUE,
      '#attributes' => [
        'class' => ['submission-btn back-to-previous step-two-prev'],
      ],
    ];
  }

}
