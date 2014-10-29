<?php

namespace Drupal\pants\Plugin;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

class PantsTypeManager extends DefaultPluginManager {

  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    $this->alterInfo('pants_type_info');
    $this->setCacheBackend($cache_backend, 'pants_type_plugins');
    parent::__construct('Plugin/PantsType', $namespaces, $module_handler, 'Drupal\pants\PantsType\PantsTypeInterface', 'Drupal\pants\Annotation\PantsType');
  }

}