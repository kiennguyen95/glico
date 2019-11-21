<?php

namespace Drupal\glico_submission\Step;

use Drupal\glico_submission\Button\StepThreeNextButton;
use Drupal\glico_submission\Button\StepThreePreviousButton;
use Drupal\glico_submission\Validator\ValidatorRegex;
use Drupal\glico_submission\Validator\ValidatorRequired;

/**
 * Class StepThree.
 *
 * @package Drupal\glico_submission\Step
 */
class StepThree extends BaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return StepsEnum::STEP_THREE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new StepThreePreviousButton(),
      new StepThreeNextButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {

    $form['name_and_comment'] = [
      '#type' => 'fieldset',
      '#title' => t('Bố mẹ hãy điền tên bé và cảm nhận cho bài dự thi nhé'),
    ];

    $form['name_and_comment']['baby_name'] = [
      '#type' => 'textfield',
      '#attributes' => array(
        'placeholder' => t('Tên bé'),
      ),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
    ];

    $form['name_and_comment']['caption'] = [
      '#type' => 'textarea',
      '#attributes' => array(
        'placeholder' => t('Bố mẹ hãy chia sẻ cảm nhận về video này nhé!'),
      ),
      '#size' => 60,
      '#maxlength' => 128,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'name_and_comment',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [];
  }

}
