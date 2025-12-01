<?php
/**
 * Plugin Name: CF7 Preloader
 * Plugin URI: https://github.com/adam-git1/cf7-preloader
 * Description: Adds preloader when submitting Contact Form 7 forms
 * Version: 1.0.1
 * Author: adam-git1
 * Author URI: https://github.com/adam-git1
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cf7-preloader
 * GitHub Plugin URI: adam-git1/cf7-preloader
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CF7_PRELOADER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CF7_PRELOADER_PLUGIN_URL', plugin_dir_url(__FILE__));

class CF7_Preloader {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }
    
    public function enqueue_scripts() {
        if (function_exists('wpcf7_contact_form')) {
            wp_enqueue_style(
                'cf7-preloader-css',
                CF7_PRELOADER_PLUGIN_URL . 'assets/css/preloader.css',
                array(),
                CF7_PRELOADER_VERSION
            );
            
            wp_enqueue_script(
                'cf7-preloader-js',
                CF7_PRELOADER_PLUGIN_URL . 'assets/js/preloader.js',
                array('jquery', 'contact-form-7'),
                CF7_PRELOADER_VERSION,
                true
            );
        }
    }
}

function cf7_preloader_init() {
    if (class_exists('WPCF7_ContactForm')) {
        CF7_Preloader::get_instance();
    }
}

add_action('plugins_loaded', 'cf7_preloader_init');

require 'plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/adam-git1/cf7-preloader',
    __FILE__,
    'cf7-preloader'
);

$myUpdateChecker->setBranch('main');