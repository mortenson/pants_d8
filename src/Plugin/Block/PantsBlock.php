<?php

/**
 * @file
 * Contains \Drupal\pants\Plugin\Block\PantsBlock.
 */

namespace Drupal\pants\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Change Pants' block.
 *
 * @Block(
 *   id = "change_pants",
 *   admin_label = @Translation("Change pants"),
 * )
 */
class PantsBlock extends BlockBase {

  public function build() {
    // @todo use dependency injection
    $uid = \Drupal::currentUser()->id();
    $user = entity_load('user', $uid);

    // @todo Get answer to question: "Is there an easier way to accomplish getting the current value of pants_status (whether or not it's set)?"
    $current_pants_status = $user->hasField('pants_status') ? $user->get('pants_status') : FALSE;
    // If pants_status doesn't exist, something went wrong with the install
    if (!$current_pants_status) {
      drupal_set_message('The pants_status field does not exist. Please uninstall and reinstall the pants_status module.', 'error');
      return FALSE;
    }
    // Check what the current value is
    $value = $current_pants_status->get(0)->getValue();
    $current_value = is_array($value) && isset($value['value']) && $value['value'] ? 0 : 1;
    // Get the current options for pants_status
    $options = $current_pants_status->get(0)->getPossibleOptions();
    // Get the appropriate label
    $label = $options[$current_value];

    $block = array();
    $block['content'] = array(
      'status' => array(
        '#theme' => 'pants_status',
        '#pants_status' => $label,
      ),
      'change_link' => array(
        '#type' => 'link',
        '#title' => t('Change'),
        '#href' => "pants/change/{$uid}",
        '#ajax' => array(
          'wrapper' => 'pants-change-pants-status',
          'method' => 'html',
          'effect' => 'fade',
        ),
      ),
    );
    return $block;
  }

}
