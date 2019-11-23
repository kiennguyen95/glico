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
//      '#prefix' => '<div type="button" id="back-to-home-page" class="button js-form-submit form-submit ui-button ui-corner-all ui-widget">Quay lại trang chủ</div>',
      '#attributes' => [
        'class' => ['submission-btn'],
      ],
    ];
  }

}
