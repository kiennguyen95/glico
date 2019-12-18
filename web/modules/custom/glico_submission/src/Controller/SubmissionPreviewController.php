<?php

namespace Drupal\glico_submission\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\node\Entity\Node;
use function dump;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class SubmissionPreviewController.
 */
class SubmissionPreviewController extends ControllerBase {

  /**
   * Preview.
   *
   */
  public function preview($nid) {
    $node = Node::load($nid);
    if (empty($node) || $node->bundle() != 'submission') {
      throw new NotFoundHttpException;
    }
    $user = $node->getOwner();
    $username = $user->getUsername();

    if (!$user->user_picture->isEmpty()) {
      $avatar_url = file_url_transform_relative(file_create_url($user->user_picture->entity->getFileUri()));
    } else {
      $avatar_url = '/themes/custom/glico/images/other/no-avatar.png';
    }
    $node_url = Url::fromRoute('entity.node.canonical', ['node' => $nid], ['absolute' => TRUE])->toString();
    if (!$node->field_video->isEmpty()) {
      $video_url = file_url_transform_relative(file_create_url($node->field_video->entity->getFileUri()));
    }
    if (!$node->field_thumbnail->isEmpty()) {
      $thumbnail_url = file_url_transform_relative(file_create_url($node->field_thumbnail->entity->getFileUri()));
    }
    $variables = [
      'username' => $username,
      'avatar_src' => $avatar_url,
      'video_src' => $video_url,
      'thumbnail_src' => $thumbnail_url,
      'video_frame' => $node->field_frame->value,
      'baby_name' => $node->getTitle(),
      'caption' => $node->field_caption->value,
      'share_url' => $node_url,
      'nid' => $nid,
    ];
//    dump($variables); die;
    return [
      '#theme' => 'glico_submission_preview',
      '#variables' => $variables,
    ];
  }

}
