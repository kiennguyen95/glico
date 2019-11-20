<?php

namespace Drupal\glico_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\file\Entity\File;
use Drupal\node\Entity\Node;
use FFMpeg\Coordinate\TimeCode;

/**
 * Class TestController.
 */
class TestController extends ControllerBase {

  /**
   * Test.
   *
   * @return string
   *   Return Hello string.
   */
  public function test() {
    $node = Node::load(79);
    $video_url = $node->field_video->entity->getFileUri();

    $real_path = \Drupal::service('file_system')->realpath($video_url);

    $thumbnail_path = 'thumbnail_images/vid_thumb_' . $node->id() . '.png';
    $thumbnail_real_path = 'sites/default/files/' . $thumbnail_path;

    $drupal_path = 'public://' . $thumbnail_path;

    $ffmpeg = \Drupal::service('php_ffmpeg');
    $video = $ffmpeg->open($real_path);
    $video->frame(TimeCode::fromSeconds(1))->save($thumbnail_real_path);


    // Check if file exist
    $files = \Drupal::entityTypeManager()
      ->getStorage('file')
      ->loadByProperties(['uri' => $drupal_path]);
    $file = reset($files);

    // If not then create a file
    if (!$file) {
      $file = File::create([
        'uri' => $drupal_path,
      ]);
      $file->save();
    }

    $node->field_thumbnail[] = [
      'target_id' => $file->id(),
    ];

    $node->save();

    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: test')
    ];
  }

}
