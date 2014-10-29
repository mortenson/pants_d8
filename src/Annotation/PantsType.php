<?php

/**
 * @file
 * Contains \Drupal\pants\Annotation\PantsType.
 */

namespace Drupal\pants\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a PantsType annotation object.
 *
 * @Annotation
 */
class PantsType extends Plugin {

  /**
   * The plugin ID of the PantsType plugin.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the PantsType plugin.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $label;

  /**
   * The path to the PantsType image.
   *
   * @var string
   */
  public $image_path;

}