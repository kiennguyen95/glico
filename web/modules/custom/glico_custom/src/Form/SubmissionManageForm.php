<?php

namespace Drupal\glico_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use function dump;

/**
 * Class SubmissionManageForm.
 */
class SubmissionManageForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'submission_manage_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['list'] = [
      '#type' => 'view',
      '#name' => 'submission',
      '#display_id' => 'page',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    $data = \Drupal::request()->request->all();
    $field_scores = $data['field_scores'];
    foreach ($field_scores as $nid => $value) {
      $node = Node::load($nid);
      if (empty($node)) continue;
      $node->set('field_score', $value);
      $node->save();
    }
    \Drupal::messenger()->addMessage('Scores of submissons were saved.');
  }

}
