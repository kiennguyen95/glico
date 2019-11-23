<?php

namespace Drupal\glico_submission\Step;

use Drupal\file\Entity\File;
use Drupal\glico_submission\Button\StepTwoNextButton;
use Drupal\glico_submission\Button\StepTwoPreviousButton;
use Drupal\glico_submission\Validator\ValidatorRequired;

/**
 * Class StepTwo.
 *
 * @package Drupal\glico_submission\Step
 */
class StepTwo extends BaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return StepsEnum::STEP_TWO;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new StepTwoPreviousButton(),
      new StepTwoNextButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {
    $form['frame'] = [
      '#type' => 'textfield',
      '#title' => t('Bố mẹ chọn khung cho video thêm sinh động nhé'),
      '#default_value' => isset($this->getValues()['interests']) ? $this->getValues()['interests'] : [],
      '#size' => 60,
      '#maxlength' => 128,
    ];

    $tempstore = \Drupal::service('user.private_tempstore')->get('glico_submission');
    $file = $tempstore->get('file');
    $file = File::load($file);

    $form['pick_frame'] = [
      '#theme' => 'glico_pick_frame',
      '#variables' => [
        'video_src' => $file === NULL ? NULL : file_create_url($file->getFileUri()),
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'frame',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [];
  }

}
