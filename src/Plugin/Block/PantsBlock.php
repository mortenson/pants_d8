<?php

/**
 * @file
 * Contains \Drupal\pants\Plugin\Block\PantsBlock.
 */

namespace Drupal\pants\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'Change Pants' block.
 *
 * @Block(
 *   id = "change_pants",
 *   admin_label = @Translation("Change pants"),
 * )
 */
class PantsBlock extends BlockBase {
  // @todo Set cache tags on a per user basis
  public function build() {
    // @todo use dependency injection
    $uid = \Drupal::currentUser()->id();
    $user = entity_load('user', $uid);

    // Check what the current value is
    $current_value = (int) $user->pants_status->value;
    // Get the current options for pants_status
    $options = $user->get('pants_status')->get(0)->getPossibleOptions();
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

  protected function blockAccess(AccountInterface $account) {
    $user = entity_load('user', $account->id());
    // If pants_status doesn't exist, something went wrong with the install
    if (!$user->hasField('pants_status')) {
      return FALSE;
    }
    return TRUE;
  }

}
