<?php

namespace Drupal\leaflet_plugins\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form to enter global settings and to assemble custom maps from overlays.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * The module handler service.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Class constructor.
   *
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   */
  public function __construct(ModuleHandlerInterface $moduleHandler, ConfigFactoryInterface $config_factory) {
    $this->moduleHandler = $moduleHandler;
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('module_handler'),
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'leaflet_plugins_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    global $base_url;
    $config = $this->configFactory->get('leaflet_plugins.settings');

    $form['plugins'] = [
      '#type' => 'details',
      '#title' => $this->t('Leaflet Plugins Settings'),
      '#open' => true,
    ];
    // Feature Control 
    if (!$this->moduleHandler->moduleExists('leaflet_feature_control')) {
      $form['plugins']['#description'] .= '<br/>' . $this->t('The Leaflet plugin Feature Control module is currently not enabled. To enable it, please go to <a href="@extend" target="_extend">admin modules page</a>.', [
        '@extend' => $base_url . '/admin/modules',
      ]);
    }
    else { 
      $form['plugins']['feature_control'] = [
        '#type' => 'details',
        '#title' => $this->t('Feature Control Settings'),
      ];
      $form['plugins']['feature_control']['feature_control_control'] = [
        '#type' => 'radios',
        '#title' => $this->t('Enable Feature Control'),
        '#options' => [
          0 => $this->t('None'),
          1 => $this->t('Default control'),
          2 => $this->t('Apperance plgin control'),
        ],
        '#description' => $this->t('Select control to use'),
        '#default_value' => $config->get('feature_control_control') ?? 0,
      ];
      $form['plugins']['feature_control']['feature_control_position'] = [
        '#type' => 'select',
        '#title' => $this->t('Control position.'),
        '#options' => [
          'topleft' => 'Top left',
          'topright' => 'Top right',
          'bottomleft' => 'Bottom left',
          'bottomright' => 'Bottom right',
        ],
        '#default_value' => $config->get('feature_control_position') ?? 'topright',
      ];
    }

    // Style Editor
    if (!$this->moduleHandler->moduleExists('leaflet_styleeditor')) {
      $form['plugins']['#description'] .= '<br/>' . $this->t('The Leaflet plugin Styleeditor module is currently not enabled. To enable it, please go to <a href="@extend" target="_extend">admin modules page</a>.', [
        '@extend' => $base_url . '/admin/modules',
      ]);
    }
    else { 
      $form['plugins']['styleeditor'] = [
        '#type' => 'details',
        '#title' => $this->t('Style Editor Settings'),
      ];
      $form['plugins']['styleeditor']['styleeditor_control'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Enable Style Editor'),
        '#description' => $this->t('Add Style Editor'),
        '#default_value' => $config->get('styleeditor_control') ?? false,
      ];
      $form['plugins']['styleeditor']['styleeditor_position'] = [
        '#type' => 'select',
        '#title' => $this->t('Control position.'),
        '#options' => [
          'topleft' => 'Top left',
          'topright' => 'Top right',
          'bottomleft' => 'Bottom left',
          'bottomright' => 'Bottom right',
        ],
        '#default_value' => $config->get('styleeditor_position') ?? 'topleft',
      ];
    }

    // LocateControl
    if (!$this->moduleHandler->moduleExists('leaflet_locatecontrol')) {
      $form['plugins']['#description'] .= '<br/>' . $this->t('The Leaflet plugin locatecontrol module is currently not enabled. To enable it, please go to <a href="@extend" target="_extend">admin modules page</a>.', [
        '@extend' => $base_url . '/admin/modules',
      ]);
    }
    else { 
      $form['plugins']['locatecontrol'] = [
        '#type' => 'details',
        '#title' => $this->t('LocateControl Settings'),
      ];
      $form['plugins']['locatecontrol']['locatecontrol_control'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Enable LocateControl'),
        '#description' => $this->t('Add LocateControl'),
        '#default_value' => $config->get('locatecontrol_control') ?? false,
      ];
      $form['plugins']['locatecontrol']['locatecontrol_position'] = [
        '#type' => 'select',
        '#title' => $this->t('Control position.'),
        '#options' => [
          'topleft' => 'Top left',
          'topright' => 'Top right',
          'bottomleft' => 'Bottom left',
          'bottomright' => 'Bottom right',
        ],
        '#default_value' => $config->get('locatecontrol_position') ?? 'topleft',
      ];
    }

    // Style Double Click
    if (!$this->moduleHandler->moduleExists('leaflet_doubleclick')) {
      $form['plugins']['#description'] .= '<br/>' . $this->t('The Leaflet plugin Doubleclick module is currently not enabled. To enable it, please go to <a href="@extend" target="_extend">admin modules page</a>.', [
        '@extend' => $base_url . '/admin/modules',
      ]);
    }
    else { 
      $form['plugins']['doubleclick'] = [
        '#type' => 'details',
        '#title' => $this->t('Doubleclick Settings'),
      ];
      $form['plugins']['doubleclick']['doubleclick_control'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Enable Double Click'),
        '#description' => $this->t('Open a pop on <shift><doubleclick>.<br><b>Work in progress:</b> display of relevant information '),
        '#default_value' => $config->get('doubleclick_control') ?? false,
      ];
    }

    // Geoman
    if (!$this->moduleHandler->moduleExists('leaflet_geoman')) {
      $form['plugins']['#description'] .= '<br/>' . $this->t('The Leaflet plugin Geoman module is currently not enabled. To enable it, please go to <a href="@extend" target="_extend">admin modules page</a>.', [
        '@extend' => $base_url . '/admin/modules',
      ]);
    }
    else { 
      $form['plugins']['geoman'] = [
        '#type' => 'details',
        '#title' => $this->t('Geoman Settings'),
      ];
      $form['plugins']['geoman']['geoman_control'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Enable Geoman functionality'),
        '#description' => $this->t('Add Geoman'),
        '#default_value' => $config->get('geoman_control') ?? false,
      ];
      $form['plugins']['geoman']['geoman_position'] = [
        '#type' => 'select',
        '#title' => $this->t('Control position.'),
        '#options' => [
          'topleft' => 'Top left',
          'topright' => 'Top right',
          'bottomleft' => 'Bottom left',
          'bottomright' => 'Bottom right',
        ],
        '#default_value' => $config->get('geoman_position') ?? 'topleft',
      ];
      $form['plugins']['geoman']['options'] = [
        '#type' => 'details',
        '#title' => $this->t('Geoman Options'),
      ];
      $form['plugins']['geoman']['options']['geoman_options'] = [
        '#type' => 'checkboxes',
        '#title' => $this->t('Options'),
        '#description' => $this->t('Geoman Options'),
        '#options' => [
          'drawMarker' => 'Adds button to draw Markers.',
          'drawCircleMarker' => 'Adds button to draw CircleMarkers.',
          'drawPolyline' => 'Adds button to draw Line.',
          'drawRectangle' => 'Adds button to draw Rectangle.',
          'drawPolygon' => 'Adds button to draw Polygon.',
          'drawCircle' => 'Adds button to draw Circle.',
          'editMode' => 'Adds button to toggle Edit Mode for all layers.',
          'dragMode' => 'Adds button to toggle Drag Mode for all layers.',
          'cutPolygon' => 'Adds button to cut a hole in a Polygon or Line.',
          'removalMode' => 'Adds a button to remove layers.',
          'rotateMode' => 'Adds a button to rotate layers.',
          'oneBlock' => 'All buttons will be displayed as one block',
          'drawControls' => 'Shows all draw buttons / buttons in the draw block.',
          'editControls' => 'Shows all edit buttons / buttons in the edit block.',
          'customControls' => 'Shows all buttons in the custom block.',
        ],
        '#default_value' => $config->get('geoman_options') ?? ['drawMarker', 'drawPolyline', 'drawPolygon', 
                'editMode', 'dragMode', 'cutPolygon', 'removalMode', 'drawControls', 'editControls', 'customControls' ],
      ];
    }

    // Ajax
    if (!$this->moduleHandler->moduleExists('leaflet_ajax')) {
      $form['plugins']['#description'] .= '<br/>' . $this->t('The Leaflet plugin Ajax module is currently not enabled. To enable it, please go to <a href="@extend" target="_extend">admin modules page</a>.', [
        '@extend' => $base_url . '/admin/modules',
      ]);
    }
    else { 
      $form['plugins']['ajax'] = [
        '#type' => 'details',
        '#title' => $this->t('Ajax Settings'),
      ];
      $form['plugins']['ajax']['ajax_control'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Enable Ajax'),
        '#description' => $this->t('Add Ajax support'),
        '#default_value' => $config->get('ajax_control') ?? false,
      ];
    }
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->config('leaflet_plugins.settings')
      ->set('feature_control_control', $form_state->getValue('feature_control_control'))
      ->set('feature_control_position', $form_state->getValue('feature_control_position'))
      ->set('styleeditor_control', $form_state->getValue('styleeditor_control'))
      ->set('styleeditor_position', $form_state->getValue('styleeditor_position'))
      ->set('locatecontrol_control', $form_state->getValue('locatecontrol_control'))
      ->set('locatecontrol_position', $form_state->getValue('locatecontrol_position'))
      ->set('doubleclick_control', $form_state->getValue('doubleclick_control'))
      ->set('doubleclick_control', $form_state->getValue('doubleclick_control'))
      ->set('geoman_control', $form_state->getValue('geoman_control'))
      ->set('geoman_position', $form_state->getValue('geoman_position'))
      ->set('geoman_options', $form_state->getValue('geoman_options'))
      ->set('ajax_control', $form_state->getValue('ajax_control'))
      ->save();

    parent::submitForm($form, $form_state);
    // @todo Need to refresh config cache.
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['leaflet_plugins.settings'];
  }

}
