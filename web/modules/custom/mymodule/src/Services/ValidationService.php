<?php
 
namespace Drupal\mymodule\Services;
 
class ValidationService {
  
  public function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
  }
 
  public function isValidName($name) {
    return preg_match('/^[a-zA-Z\s]+$/', $name);
}

 
  public function isValidAge($age) {
    return preg_match('/^[0-9]+$/', $age);
  }
 
  public function isValidGender($gender) {
    return in_array(strtoupper($gender), ['M', 'F']);
  }

  public function getData($node) {
    $data = [
      'nid' => $node->id(),
      'title' => $node->getTitle(),
      'name' => $node->get('field_title')->value,
      'gender' => $node->get('field_gender')->value,
      'email' => $node->get('field_email')->value,
      'age' => $node->get('field_age')->value,
    ];
 
    return $data;
  }

}