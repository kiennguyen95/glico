<?php

namespace Drupal\glico_submission\Step;


use Drupal\file\Entity\File;
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
    $tempstore = \Drupal::service('user.private_tempstore')->get('glico_submission');
    $file = $tempstore->get('file');
    $file = File::load($file);
    $frame = $tempstore->get('frame');
    $baby_name = $tempstore->get('baby_name');
    $caption = $tempstore->get('caption');
    $form['preview'] = [
      '#theme' => 'glico_submission_preview',
      '#variables' => [
        'submitter' => [
          'name' => \Drupal::currentUser()->getDisplayName(),
        ],
        'title' => $baby_name,
        'caption' => $caption,
        'video_src' => $file === NULL ? NULL : file_create_url($file->getFileUri()),
        'frame' => $frame,
      ],
    ];
    return $form;
  }

}
