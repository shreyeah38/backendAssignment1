<?php
 
namespace Drupal\mymodule\Form;
 
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\mymodule\Services\ValidationService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\node\Entity\Node;
 
class MyModuleForm extends FormBase {
 
  protected $validationService;
 
  public function __construct(ValidationService $validationService) {
    $this->validationService = $validationService;
  }
 
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('mymodule.validation_service')
    );
  }
 
  public function getFormId() {
    return 'my_custom_module_form';
  }
 
  public function buildForm(array $form, FormStateInterface $form_state) {
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = is_null($node) ? 0 : $node->id();
 
    $form['name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Name'),
        '#size' => 25,
        '#description' => $this->t('Please enter the Name'),
        '#required' => TRUE,
    ];
    $form['email'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Email address'),
        '#size' => 25,
        '#description' => $this->t("We will send updates to the email"),
        '#required' => TRUE,
    ];
    $form['age'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Age'),
      '#size' => 25,
      '#description' => $this->t('Please enter the age'),
      '#required' => TRUE,
    ];
    $form['gender'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Gender'),
      '#size' => 25,
      '#description' => $this->t('Please enter the gender M/F'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
    ];
    $form['nid'] = [
        '#type' => 'hidden',
        '#value' => $nid,
    ];
 
    return $form;
  }
 
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    $name = $form_state->getValue('name');
    $age = $form_state->getValue('age');
    $gender = $form_state->getValue('gender');
 
    if (!$this->validationService->isValidEmail($email)) {
      $form_state->setErrorByName('email', $this->t('It appears that %mail is not a valid email', ['%mail' => $email]));
    }
    if (!$this->validationService->isValidName($name)) {
      $form_state->setErrorByName('name', $this->t('The name cannot contain numbers.'));
    }
    if (!$this->validationService->isValidAge($age)) {
      $form_state->setErrorByName('age', $this->t('The age must be a number.'));
    }
    if (!$this->validationService->isValidGender($gender)) {
      $form_state->setErrorByName('gender', $this->t('The gender must be either M or F.'));
    }
  }
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $submitted_email = $form_state->getValue('email');
    $submitted_gender = $form_state->getValue('gender');
    $submitted_name = $form_state->getValue('name');
    $submitted_age = $form_state->getValue('age');
 
    $node = Node::create([
      'type' => 'assignment_content',
      'title' => $submitted_name,
      'field_title' => [
        'value' => $submitted_name,
      ],
      'field_email' => [
        'value' => $submitted_email,
      ],
      'field_age' => [
        'value' => $submitted_age,
      ],
      'field_gender' => [
        'value' => $submitted_gender,
      ],
      'status' => 1,
    ]);
 
    $node->save();
    $form_state->setRedirect('entity.node.canonical', ['node' => $node->id()]);
  }
}