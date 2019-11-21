<?php

namespace Drupal\glico_submission\Button;

use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepOneNextButton.
 *
 * @package Drupal\glico_submission\Button
 */
class StepOneNextButton extends BaseButton {

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
      '#value' => t('Tiếp theo'),
      '#goto_step' => StepsEnum::STEP_TWO,
      '#submit_handler' => 'storeValues',
      '#attributes' => [
        'class' => ['submission-btn'],
      ],
    ];
  }

}
