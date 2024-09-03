<?php
 
/**
* @file
* Provides administrators a list of all RSVP signups
*/
namespace Drupal\mymodule\Controller;
 
use Drupal\Core\Controller\ControllerBase;

class Assignment2 extends ControllerBase {
    public function content() {
      $simpleform = \Drupal::formBuilder()->getForm('Drupal\mymodule\Form\MyModuleForm');
      return $simpleform;
    }
}