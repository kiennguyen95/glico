<?php

namespace Drupal\glico_submission\Button;

use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepOneNextButton.
 *
 * @package Drupal\glico_submission\Button
 */
class StepFinalizeNextButton extends BaseButton {

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
      '#type' => 'button',
      '#value' => t('Chia sẻ ngay'),
      '#attributes' => [
        'class' => ['fb-share-submission'],
      ],
      '#submit_handler' => 'submitValues',
    ];
  }

}
