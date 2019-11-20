<?php

namespace Drupal\glico_submission\Step;


use Drupal\glico_submission\Button\StepPreviewNextButton;
use Drupal\glico_submission\Button\StepPreviewPreviousButton;

/**
 * Class StepFinalize.
 *
 * @package Drupal\glico_submission\Step
 */
class StepPreview extends BaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return StepsEnum::STEP_PREVIEW;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new StepPreviewNextButton()
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {
    $form['preview'] = [
      '#theme' => 'glico_submission_preview'
    ];
//    $form['askdjhasd'] = [
//      '#type'
//    ];

    return $form;
  }

}
