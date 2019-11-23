<?php

namespace Drupal\glico_submission\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\RedirectCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateSubmissionController.
 */
class AjaxSubmissionController extends ControllerBase {

  /**
   * Create.
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *   Return Hello string.
   */
  public function submission($flg) {
    $response = new AjaxResponse();
    $tempstore = \Drupal::service('user.private_tempstore')
      ->get('glico_submission');
    $nid = $tempstore->get('nid');
    $node = Node::load($nid);
    if ($node === NULL) {
      return $response;
    }

    if ($flg == 'not-shared') {
      $node->delete();
    }

    if ($flg == 'shared') {
      $response->addCommand(new RedirectCommand($node->toUrl()->toString()));
    }
    return $response;
  }
}
