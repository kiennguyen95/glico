<?php

namespace Drupal\glico_submission\Step;

use Drupal\glico_submission\Button\StepFinalizeNextButton;

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
      '#markup' => t('Bố mẹ hãy chia sẻ bài dự thi về Facebook để được tính là hợp lệ nhé'),
    ];

    return $form;
  }

}
