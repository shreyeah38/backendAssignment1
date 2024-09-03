<?php

namespace  Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Controller for JSON data of nodes.
 */
class MyModuleController extends ControllerBase {

  /**
   * Returns JSON data of all nodes of type assignment_content.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   JSON response containing nodes data.
   */
  public function nodesJson() {
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'assignment_content']);

    $getData = \Drupal::service('mymodule.validation_service');
    $data = [];
    foreach($nodes as $node) {
      $data[] = [($getData->getData($node))];
    }

    return new JsonResponse($data);
  }

}
