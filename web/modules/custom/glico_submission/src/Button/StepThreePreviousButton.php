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
//      '#submit' => [],
      '#value' => t('Chọn lại khung'),
      '#goto_step' => StepsEnum::STEP_TWO,
      '#skip_validation' => TRUE,
      '#attributes' => [
        'class' => ['submission-btn back-to-previous step-three-prev'],
      ],
    ];
  }

}
