<?php

namespace Drupal\mymodule\Plugin\rest\resource;

use Drupal\Core\Entity\EntityStorageException;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\mymodule\Services\ValidationService;
use Drupal\node\Entity\Node;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "demo_resource",
 *   label = @Translation("Demo Resource"),
 *   uri_paths = {
 *     "canonical" = "/mymodule/demo_resource",
 *     "create" = "add/demo_resource"
 *   }
 * )
 */
class DemoResource extends ResourceBase {
  /**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ResourceResponse
   */
  public function get() {
    $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'assignment_content']);

    $getData = \Drupal::service('mymodule.validation_service');
    $data = [];
    foreach($nodes as $node) {
      $data[] = [($getData->getData($node))];
    }

    return new ResourceResponse($data);
  }

  /**
 * Responds to POST requests.
 *
 * @param array $data
 *   The data array containing POSTed JSON data.
 * @return \Drupal\rest\ResourceResponse
 *   The response containing JSON data.
 */
public function post(array $data) {
    $validationService = new ValidationService();
  
    if (empty($data)) {
      return new ResourceResponse(['message' => 'No data received'], 400);
    }
  
    $required_fields = ['name', 'email', 'age', 'gender'];
    foreach ($required_fields as $field) {
      if (!isset($data[$field]) || empty($data[$field])) {
        return new ResourceResponse(['message' => 'Missing required fields'], 400);
      }
    }
  
    if (
      !$validationService->isValidName($data['name']) ||
      !$validationService->isValidEmail($data['email']) ||
      !$validationService->isValidAge($data['age']) ||
      !$validationService->isValidGender($data['gender'])
    ) {
      return new ResourceResponse(['message' => 'Invalid data format'], 400);
    }
  
    try {
      $node = Node::create([
        'type' => 'assignment_content',
        'title' => $data['name'],
        'field_title' => $data['name'],
        'field_email' => $data['email'],
        'field_age' => $data['age'],
        'field_gender' => strtoupper($data['gender']),
        'status' => 1,
      ]);
  
      $node->save();
  
      return new ResourceResponse(['message' => 'Node Created'], 201);
    } catch (EntityStorageException $e) {
      \Drupal::logger('custom-rest')->error('Error saving node: @error', ['@error' => $e->getMessage()]);
      return new ResourceResponse(['message' => 'An error occurred while saving the node'], 500);
    }
  }
}  

