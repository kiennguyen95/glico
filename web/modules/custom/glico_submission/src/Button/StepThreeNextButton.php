<?php

namespace Drupal\glico_submission\Button;

use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepThreeNextButton.
 *
 * @package Drupal\glico_submission\Button
 */
class StepThreeNextButton extends BaseButton {

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
      '#value' => t('Xong'),
      '#goto_step' => StepsEnum::STEP_FINALIZE,
      '#submit_handler' => 'submitValues',
      '#attributes' => [
        'class' => ['submission-to-preview-btn'],
      ],
    ];
  }
}
