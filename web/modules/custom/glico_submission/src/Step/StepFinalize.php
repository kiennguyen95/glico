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
      '#markup' => '<p class="message-share">Bố mẹ hãy chia sẻ bài dự thi về Facebook để được tính là hợp lệ nhé!</p><p class="btn-share-fake">CHIA SẺ NGAY</p>',
    ];
    $tempstore = \Drupal::service('user.private_tempstore')
      ->get('glico_submission');
    $nid = $tempstore->get('nid');
    $host = \Drupal::request()->getSchemeAndHttpHost();
    $link = Url::fromRoute('entity.node.canonical', ['node' => $nid])->toString();
    $form['#attached'] = [
      'drupalSettings' => [
        'variables' => [
          'link' => $host . $link,
        ],
      ],
    ];

    return $form;
  }

}
