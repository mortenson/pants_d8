<?php

/**
 * @file
 * Contains \Drupal\pants\Controller\PantsController.
 */

namespace Drupal\pants\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;
use Drupal\pants\Plugin\Block\PantsBlock;

class PantsController extends ControllerBase {

  public function changePants(UserInterface $user) {
    // Get the field from $user
    $current_pants_status = $user->hasField('pants_status') ? $user->get('pants_status') : FALSE;
    // If pants_status doesn't exist, something went wrong with the install
    if (!$current_pants_status) {
      drupal_set_message('The pants_status field does not exist. Please uninstall and reinstall the pants_status module.', 'error');
      return FALSE;
    }
    // Check what the current value is
    $value = $current_pants_status->get(0)->getValue();
    $new_pants_status = is_array($value) && $value['value'] ? 0 : 1;
    // Set pants_status and save the User entity
    $user->set('pants_status', $new_pants_status);
    $user->save();

    // Get the current options for pants_status
    $options = $current_pants_status->get(0)->getPossibleOptions();
    // Get the appropriate label
    $label = $options[$new_pants_status];

    return array(
      '#theme' => 'pants_status',
      '#pants_status' => $label
    );
  }

}
