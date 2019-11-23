<?php

namespace Drupal\glico_submission\Step;

use Drupal\glico_submission\Button\StepOneNextButton;
use Drupal\glico_submission\Button\StepOnePreviousButton;
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
      new StepOnePreviousButton(),
      new StepOneNextButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {
    $form['video_file'] = [
      '#type' => 'managed_file',
      '#title' => t("Bố mẹ hãy tải video dự thi của bé lên tại đây nhé"),
      '#required' => TRUE,
      '#default_value' => isset($this->getValues()['video_file']) ? $this->getValues()['video_file'] : NULL,
      '#upload_validators' => array(
        'file_validate_extensions' => array('mp4 mkv flv m4v'),
        // Pass the maximum file size in bytes
        'file_validate_size' => array(1024*1024*1024),
      ),
      '#attributes' => [
        'class' => ['select-video-real'],
      ]
    ];

    $form['submit_video'] = [
      '#markup' => '<div class="submit-video"><span id="submit-video-submission">Chọn video để tải lên</span></div>'
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
        new ValidatorRequired("Hãy upload video dự thi để chuyển đến bước tiếp theo"),
      ],
    ];
  }

}
