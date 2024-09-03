<?php
 
namespace Drupal\mymodule\Controller;
 
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\mymodule\Form\MyModuleForm;
 
/**
* Provides a controller for the custom form.
*/
class Assignment3 extends ControllerBase {
  /**
   * The form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;
 
  /**
   * Constructs a new Assignment2 object.
   *
   * @param \Drupal\Core\Form\FormBuilderInterface $formBuilder
   *   The form builder service.
   */
  public function __construct(FormBuilderInterface $formBuilder) {
    $this->formBuilder = $formBuilder;
  }
 
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('form_builder')
    );
  }
 
  /**
   * Returns the custom form.
   *
   * @return array
   *   A render array representing the custom form.
   */
  public function content() {
    $simpleform = $this->formBuilder->getForm(MyModuleForm::class);
    return $simpleform;
  }
}