<?php

namespace Drupal\glico_submission\Button;

/**
 * Class BaseButton.
 *
 * @package Drupal\glico_submission\Button
 */
abstract class BaseButton implements ButtonInterface {

  /**
   * {@inheritdoc}
   */
  public function ajaxify() {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getSubmitHandler() {
    return FALSE;
  }

}
