<?php

namespace Drupal\glico_custom\Form;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\node\Entity\Node;
use Drupal\views\Views;

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
    $type = \Drupal::request()->query->get('type');

    $form['panel'] = [
      '#type' => 'html_tag',
      '#tag' => 'div',
    ];
    $form['panel']['type'] = [
      '#type' => 'select',
      '#title' => 'Type',
      '#options' => [
        'all' => $this->t('All'),
        'new' => $this->t('New submissions'),
      ],
      '#default_value' => ($type == 'new') ? 'new' : 'all',
      '#attributes'    => [
        'onChange' => 'this.form.submit();',
      ],
    ];

    $form['panel']['recreate_url'] = [
      '#type' => 'submit',
      '#value' => $this->t('Recreate shorten URL'),
      '#name' => 'recreate_url',
    ];

    $export_url = Url::fromRoute('view.submission.data_export');
    $export_url->setOption('attributes', ['class' => ['button']]);
    $form['panel']['export'] = Link::fromTextAndUrl($this->t('Export data'), $export_url)->toRenderable();

    $view = Views::getView('submission');
    if (is_object($view)) {
      $view->setDisplay('page');

      if ($type != 'new') {
        $filters = $view->display_handler->getOption('filters');
        if (isset($filters['field_score_value'])) {
          unset($filters['field_score_value']);
        }
        $view->display_handler->overrideOption('filters', $filters);
      }
      $view->preExecute();
      $view->execute();
      $list = $view->buildRenderable('page');
      $list['#cache']['contexts'][] = 'url';
    }

    $form['list'] = $list;

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#name' => 'save',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $data = \Drupal::request()->request->all();

    // Trigger save
    if (isset($data['save'])) {
      $field_scores = $data['field_scores'];
      foreach ($field_scores as $nid => $value) {
        $node = Node::load($nid);
        if (empty($node)) continue;
        $node->set('field_score', $value);
        $node->save();
      }
      \Drupal::messenger()->addMessage('Scores of the submissions have been saved.');
    }

    // Trigger recreate shorten URL
    elseif (isset($data['recreate_url'])) {
      $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'submission']);
      foreach ($nodes as $node) {
        $nid = $node->id();
        $node_url = Url::fromRoute('entity.node.canonical', ['node' => $nid], ['absolute' => TRUE])->toString();
        $node_url = str_replace('node', 'video', $node_url);
        $node->field_shorten_link = shorten_url($node_url, SHORTEN_LINK_SERVICE);
        $node->save();
      }
      \Drupal::messenger()->addMessage('Shorten URLs have been recreated.');
    }
    else {
      if ($data['type'] == 'new') {
        $options = [
          'query' => [
            'type' => $data['type'],
          ],
        ];
      } else {
        $options = [];
      }
    }
    $form_state->setRedirect('glico_custom.submission_manage_form', [], $options);
  }

  public function access(AccountInterface $account) {
    $roles = $account->getRoles();
    if (in_array(ROLE_ADMIN, $roles) || in_array(ROLE_MOD, $roles)) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }

}
