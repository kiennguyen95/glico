<?php

namespace Drupal\glico_submission\Controller;

use Drupal\Core\Ajax\AjaxResponse;
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
  public function delete() {
    $tempstore = \Drupal::service('user.private_tempstore')->get('glico_submission');
    $file = $tempstore->get('file');
    $frame = $tempstore->get('frame');
    $baby_name = $tempstore->get('baby_name');
    $caption = $tempstore->get('caption');
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties([
      'type'        => 'submission',
      'title'       => $baby_name,
      'field_frame' => $frame,
      'field_caption' => $caption,
      'field_video' => [
        'target_id' => $file,
      ],
    ]);
    $node = array_shift($nodes);

    $node->delete();
    return new AjaxResponse();
  }

}
