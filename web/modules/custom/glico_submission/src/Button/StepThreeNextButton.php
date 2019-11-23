<?php

namespace Drupal\glico_submission\Button;

use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepThreeFinishButton.
 *
 * @package Drupal\glico_submission\Button
 */
class StepThreeNextButton extends BaseButton {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'finish';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'submit',
      '#value' => t('Xong'),
      '#submit_handler' => 'submitValues',
      '#attributes' => [
        'class' => ['submission-to-preview-btn'],
      ],
    ];
  }
}
