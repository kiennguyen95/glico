<?php

namespace Drupal\glico_submission\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use function dump;
use function Psy\sh;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateSubmissionController.
 */
class AjaxSubmissionController extends ControllerBase {

  /**
   * Create.
   */
  public function complete() {
    $response = new Response();
    $tempstore = \Drupal::service('user.private_tempstore')->get('glico_submission');
    $nid = $tempstore->get('nid');
    $tempstore->delete('nid');
    if (empty($nid)) return $response;
    $node = Node::load($nid);
    if (empty($node)) return $response;
    $node->set('field_approved', 1);
    $node->save();
    return $response;
  }
}
