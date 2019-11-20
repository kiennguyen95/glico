<?php

namespace Drupal\glico_submission\Manager;

use Drupal\glico_submission\Step\StepInterface;
use Drupal\glico_submission\Step\StepsEnum;

/**
 * Class StepManager.
 *
 * @package Drupal\glico_submission\Manager
 */
class StepManager {

  /**
   * Multi steps of the form.
   *
   * @var \Drupal\glico_submission\Step\StepInterface
   */
  protected $steps;

  /**
   * StepManager constructor.
   */
  public function __construct() {
  }

  /**
   * Add a step to the steps property.
   *
   * @param \Drupal\glico_submission\Step\StepInterface $step
   *   Step of the form.
   */
  public function addStep(StepInterface $step) {
    $this->steps[$step->getStep()] = $step;
  }

  /**
   * Fetches step from steps property, If it doesn't exist, create step object.
   *
   * @param int $step_id
   *   Step ID.
   *
   * @return \Drupal\glico_submission\Step\StepInterface
   *   Return step object.
   */
  public function getStep($step_id) {
    if (isset($this->steps[$step_id])) {
      // If step was already initialized, use that step.
      // Chance is there are values stored on that step.
      $step = $this->steps[$step_id];
    }
    else {
      // Get class.
      $class = StepsEnum::map($step_id);
      // Init step.
      $step = new $class($this);
    }

    return $step;
  }

  /**
   * Get all steps.
   *
   * @return \Drupal\glico_submission\Step\StepInterface
   *   Steps.
   */
  public function getAllSteps() {
    return $this->steps;
  }

}
