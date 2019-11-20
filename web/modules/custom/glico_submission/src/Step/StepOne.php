<?php

namespace Drupal\glico_submission\Step;

use Drupal\glico_submission\Button\StepOneNextButton;
use Drupal\glico_submission\Validator\ValidatorRequired;

/**
 * Class StepOne.
 *
 * @package Drupal\glico_submission\Step
 */
class StepOne extends BaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return StepsEnum::STEP_ONE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new StepOneNextButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {
    $form['video_file'] = [
      '#type' => 'managed_file',
      '#title' => t("Bố mẹ hãy tải video của bé lên đây nhé"),
      '#required' => TRUE,
      '#default_value' => isset($this->getValues()['video_file']) ? $this->getValues()['video_file'] : NULL,
      '#upload_validators' => array(
        'file_validate_extensions' => array('mp4 mkv flv m4v'),
        // Pass the maximum file size in bytes
        'file_validate_size' => array(1024*1024*1024),
      ),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'video_file',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [
      'video_file' => [
        new ValidatorRequired("Hey stranger, please tell me your name. I would like to get to know you."),
      ],
    ];
  }

}
