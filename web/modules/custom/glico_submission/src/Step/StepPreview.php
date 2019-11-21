<?php

namespace Drupal\glico_submission\Step;


use Drupal\file\Entity\File;
use Drupal\glico_submission\Button\StepPreviewNextButton;
use Drupal\glico_submission\Button\StepPreviewPreviousButton;
use Drupal\user\Entity\User;

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
    $user_img = User::load(\Drupal::currentUser()->id());
    $user_img = $user_img->get('user_picture')->getValue();
    $user_img = File::load($user_img[0]['target_id']);
    $form['preview'] = [
      '#theme' => 'glico_submission_preview',
      '#variables' => [
        'submitter' => [
          'name' => \Drupal::currentUser()->getDisplayName(),
          'img_src' => $user_img == NULL ? NULL : file_create_url($user_img->getFileUri()),
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
