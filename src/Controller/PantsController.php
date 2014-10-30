<?php

/**
 * @file
 * Contains \Drupal\pants\Controller\PantsController.
 */

namespace Drupal\pants\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\UserInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PantsController extends ControllerBase {

  public function changePants(UserInterface $user) {
    // Check what the current value is
    $user->pants_status->value = (int) !$user->pants_status->value;
    $user->save();

    // Get the current options for pants_status
    $options = $user->get('pants_status')->get(0)->getPossibleOptions();
    // Get the appropriate label
    $label = $options[$user->pants_status->value];

    return array(
      '#theme' => 'pants_status',
      '#pants_status' => $label
    );
  }

  public function changeAccess(UserInterface $user) {
    // If pants_status doesn't exist, something went wrong with the install
    if (!$user->hasField('pants_status')) {
      return AccessResult::forbidden();
    }
    // Check if user is an administrator or has access to change pants
    $access = $user->hasPermission('change pants status') || $user->hasPermission('administer pants');
    // Return the appropriate AccessResultInterface
    return $access ? AccessResult::allowed() : AccessResult::forbidden();
  }

}
