<?php

namespace Drupal\mymodule\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Controller\ControllerBase;
use Drupal\mymodule\Services\ValidationService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller to handle POST data and create nodes.
 */
class PostController extends ControllerBase {

  /**
   * The validation service.
   *
   * @var \Drupal\mymodule\Services\ValidationService
   */
  protected $validationService;

  /**
   * Constructs a new PostController object.
   *
   * @param \Drupal\mymodule\Services\ValidationService $validationService
   *   The validation service.
   */
  public function __construct(ValidationService $validationService) {
    $this->validationService = $validationService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('mymodule.validation_service')
    );
  }

  /**
   * Handles POST data.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current request.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response with the status of the operation.
   */
  public function handlePost(Request $request) {
    try {
      $data = json_decode($request->getContent(), TRUE);

      if (empty($data)) {
        return new JsonResponse(['status' => 'error', 'message' => 'No data'], 400);
      }

      $validationErrors = [];
      if (!$this->validationService->isValidName($data['name'])) {
        $validationErrors[] = 'Invalid name format. Name must contain only letters.';
      }
      if (!$this->validationService->isValidEmail($data['email'])) {
        $validationErrors[] = 'Invalid email format.';
      }
      if (!$this->validationService->isValidAge($data['age'])) {
        $validationErrors[] = 'Invalid age format. Age must be a number.';
      }
      if (!$this->validationService->isValidGender($data['gender'])) {
        $validationErrors[] = 'Invalid gender. Gender must be either "M" or "F".';
      }

      if (!empty($validationErrors)) {
        return new JsonResponse(['status' => 'error', 'message' => implode(' ', $validationErrors)], 400);
      }

      $node = \Drupal\node\Entity\Node::create([
        'type' => 'assignment_content',
        'title' => $data['name'],
        'field_email' => $data['email'],
        'field_age' => $data['age'],
        'field_gender' => strtoupper($data['gender']),
      ]);

      $node->save();

      return new JsonResponse(['status' => '200', 'message' => 'Your data has been saved successfully', 'node_id' => $node->id()]);
    } catch (\Exception $e) {
      return new JsonResponse(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
  }

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
