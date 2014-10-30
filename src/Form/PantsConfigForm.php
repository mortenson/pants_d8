<?php
namespace Drupal\pants\Form;


use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PantsConfigForm extends ConfigFormBase {

  /**
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $plugin_manager;

  public function __construct(ConfigFactoryInterface $config_factory, PluginManagerInterface $plugin_manager) {
    $this->plugin_manager = $plugin_manager;
    parent::__construct($config_factory);
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('plugin.manager.pants.pants_type')
    );
  }

  public function getFormId() {
    return 'pants_config';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['pants_type'] = array(
      '#type' => 'radios',
      '#title' => t('Pants type'),
      '#options' => array(
        '' => t('None (just show on/off status)'),
      ),
      '#default_value' => $this->config('pants.type'),
      '#description' => t('Choose pants type to show on the user profile.'),
    );

    foreach($this->plugin_manager->getDefinitions() as $pants_type_id => $pants_type_info) {
      $form['pants_type']['#options'][$pants_type_id] = $pants_type_info['label'];
    }
    return parent::buildForm($form, $form_state);
  }

}