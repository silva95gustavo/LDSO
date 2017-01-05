<?php

/**
 * @file
 * Contains \Drupal\text_resize\Form\TextResizeSettingsForm.
 */

namespace Drupal\text_resize\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Displays the text resize settings form.
 */
class TextResizeSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'text_resize.settings'
    ];
  }

  /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
  public function getFormID() {
    return 'text_resize_admin_settings';
  }

  /**
   * Implements \Drupal\Core\Form\FormInterface::buildForm().
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('text_resize.settings');
    $form['text_resize_scope'] = array(
      '#type' => 'textfield',
      '#title' => t('Text Resize Scope'),
      '#default_value' => $config->get('text_resize_scope'),
      '#description' => t('Which portion of the body would you like to be resized by the Text Resize block? You may enter either the CSS class attribute, the CSS id attribute, or an HTML tag.<br />For example, if you want all text within &lt;div id="my-container"&gt; to be resized, enter the ID <strong>my-container</strong>.<br />If, on the other hand, you would like all text within the BODY tag to be resized, enter <strong>body</strong>.'),
      '#required' => TRUE,
    );
    $form['text_resize_minimum'] = array(
      '#type' => 'textfield',
      '#title' => t('Default/Minimum Text Size'),
      '#maxlength' => 2,
      '#default_value' => $config->get('text_resize_minimum'),
      '#description' => t('What is the smallest font size (in pixels) that your text can be resized to by users?'),
      '#required' => TRUE,
    );
    $form['text_resize_maximum'] = array(
      '#type' => 'textfield',
      '#title' => t('Maximum Text Size'),
      '#maxlength' => 2,
      '#default_value' => $config->get('text_resize_maximum'),
      '#description' => t('What is the largest font size (in pixels) that your text can be resized to by users?'),
      '#required' => TRUE,
    );
    $form['text_resize_reset_button'] = array(
      '#type' => 'checkbox',
      '#title' => t('Add Reset Button'),
      '#default_value' => $config->get('text_resize_reset_button'),
      '#description' => t('Do you want to add an extra button to the block to allow the font size to be reset to the default/minimum size set above?'),
    );
    $form['text_resize_line_height_allow'] = array(
      '#type' => 'checkbox',
      '#title' => t('Allow Line-Height Adjustment'),
      '#default_value' => $config->get('text_resize_line_height_allow'),
      '#description' => t('Do you want to allow Text Resize to change the spacing between the lines of text?'),
    );
    $form['text_resize_line_height_min'] = array(
      '#type' => 'textfield',
      '#title' => t('Minimum Line-Height'),
      '#maxlength' => 2,
      '#default_value' => $config->get('text_resize_line_height_min'),
      '#description' => t('What is the smallest line-height (in pixels) that your text can be resized to by users?'),
    );
    $form['text_resize_line_height_max'] = array(
      '#type' => 'textfield',
      '#title' => t('Maximum Line-Height'),
      '#maxlength' => 2,
      '#default_value' => $config->get('text_resize_line_height_max'),
      '#description' => t('What is the largest line-height (in pixels) that your text can be resized to by users?'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * Implements \Drupal\Core\Form\FormInterface:validateForm()
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    parent::validateForm($form, $form_state);
  }

  /**
   * Implements \Drupal\Core\Form\FormInterface:submitForm()
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->config('text_resize.settings')
      ->set('text_resize_scope', $form_state->getValue('text_resize_scope'))
      ->set('text_resize_minimum', $form_state->getValue('text_resize_minimum'))
      ->set('text_resize_maximum', $form_state->getValue('text_resize_maximum'))
      ->set('text_resize_reset_button', $form_state->getValue('text_resize_reset_button'))
      ->set('text_resize_line_height_allow', $form_state->getValue('text_resize_line_height_allow'))
      ->set('text_resize_line_height_min', $form_state->getValue('text_resize_line_height_min'))
      ->set('text_resize_line_height_max', $form_state->getValue('text_resize_line_height_max'))
      ->save();
  }

}
