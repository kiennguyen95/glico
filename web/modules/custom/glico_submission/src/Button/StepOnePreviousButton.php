<?php

namespace Drupal\glico_submission\Button;

use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepOnePreviousButton.
 *
 * @package Drupal\glico_submission\Button
 */
class StepOnePreviousButton extends BaseButton {

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
      '#type' => 'markup',
      '#markup' => '<div type="button" id="back-to-home-page" class="button js-form-submit form-submit ui-button ui-corner-all ui-widget">Quay lại trang chủ</div>',
    ];
  }

}
