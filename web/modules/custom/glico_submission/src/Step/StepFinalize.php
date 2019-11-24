<?php

namespace Drupal\glico_submission\Step;

use Drupal\glico_submission\Button\StepFinalizeNextButton;
use Drupal\node\Entity\Node;
use Drupal\Core\Url;

/**
 * Class StepFinalize.
 *
 * @package Drupal\glico_submission\Step
 */
class StepFinalize extends BaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return StepsEnum::STEP_FINALIZE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new StepFinalizeNextButton()
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {

    $form['completed'] = [
      '#markup' => '<p class="message-share">Đang xử lý bài dự thi...</p>',
    ];

    return $form;
  }

}
