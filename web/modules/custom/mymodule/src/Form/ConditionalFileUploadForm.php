<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ConditionalFileUploadForm extends FormBase {
  
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'conditional_file_upload_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['toggle_upload'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show file upload'),
      '#ajax' => [
        'callback' => '::toggleUploadCallback',
        'wrapper' => 'file-upload-wrapper',
        'effect' => 'fade',
      ],
    ];

    $form['file_upload_wrapper'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'file-upload-wrapper'],
    ];

    if ($form_state->getValue('toggle_upload')) {
      $form['file_upload_wrapper']['file_upload'] = [
        '#type' => 'managed_file',
        '#title' => $this->t('Upload a file'),
        '#upload_validators' => [
          'file_validate_extensions' => ['csv'],
        ],
        '#upload_location' => 'public://uploads/',
      ];

      $form['file_upload_wrapper']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
      ];
    }

    return $form;
  }

  /**
   * AJAX callback to show/hide the file upload.
   */
  public function toggleUploadCallback(array &$form, FormStateInterface $form_state) {
    return $form['file_upload_wrapper'];
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Handle form submission.
    $file = $form_state->getValue('file_upload');
    if ($file) {
      $file = \Drupal::entityTypeManager()->getStorage('file')->load($file[0]);
      $file->setPermanent();
      $file->save();
      \Drupal::messenger()->addMessage($this->t('File uploaded successfully.'));
    }
    else {
      \Drupal::messenger()->addMessage($this->t('No file uploaded.'));
    }
  }
}
