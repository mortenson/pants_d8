<?php

namespace Drupal\pants\PantsType;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

class PantsTypeBase extends PluginBase implements PantsTypeInterface {

  use StringTranslationTrait;

  public function viewEnabled() {
    $definition = $this->getPluginDefinition();
    return array(
      '#theme' => 'image',
      '#path' => $definition['image_path']
    );
  }

  public function viewDisabled() {
    return array(
      '#markup' => $this->t('Off')
    );
  }

}
