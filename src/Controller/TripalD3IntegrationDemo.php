<?php
/**
 * @file Construct Demo Page.
 */

namespace Drupal\tripald3\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines TripalD3IntegrationDemo class.
 */
class TripalD3IntegrationDemo extends ControllerBase {
  /**
   * Returns a render-able array for Demo page.
   */
  public function content() {
    // Fetch configuration settings - autoresize, colour scheme and pedigree terms.
    // Configuration values will be available in scripts as drupalSettings.
    $config = \Drupal::service('config.factory')
      ->getEditable('tripald3.settings');
    
    // Namespace module name to prevent name collision.
     
    // Colour schemes.
    $default_scheme = $config->get('tripald3_colorScheme');
    $to_Drupalsettings['tripalD3']['vars']['scheme'] = tripald3_register_colorschemes($default_scheme);

    // Auto resize configuration.        
    $default_resize = $config->get('tripald3_autoResize');
    $to_Drupalsettings['tripalD3']['vars']['autoResize'] = $default_resize;
    
    // @see libraries.yml
    $libraries = [
      // CORE
      // D3, Tripal D3 and Test Script
      'tripald3/D3',
      'tripald3/tripalD3',
      
      // CHARTS
      // Pie
      'tripald3/lib-pie',
      'tripald3/lib-bar',
      'tripald3/lib-pedigree',
      
      // CREATE
      'tripald3/create-multidonut',
      'tripald3/create-pie',
      'tripald3/create-multiseriesdonut',
      'tripald3/create-bar',
      'tripald3/create-pedigree',
      
      // STYLE
      'tripald3/style-tripald3'
    ];

    return [
      '#theme' => 'theme_tripald3demo',
      '#attached' => [
        'library' => $libraries,
        'drupalSettings' => $to_Drupalsettings
      ]      
    ];  
  }    
}