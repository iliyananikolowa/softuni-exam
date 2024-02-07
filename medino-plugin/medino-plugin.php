<?php
/*
* Plugin Name:          Medino Plugin
* Plugin URI:           https://softuni.bg
* Description:          First plugin for Softuni exam
* Version:              1.0.0
* Requires at least:    5.0
* Requires PHP:         8.0
* Author:               Iliyana Nikolova
* Author URI:           https://softuni.bg
* License:              GPL v2
* License URI:          https://www.gnu.org/licenses/gpl-2.0.html
* Update URI:           https://example.com/my-plugin
* Text Domain:          Softuni Exam
* Domain Path:          /languages
*/ 


if ( ! defined( 'MEDINO_PLUGIN_DIR' ) ) {
    define( 'MEDINO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) . 'includes' );
}

if ( ! defined( 'MEDINO_PLUGIN_INCLUDES_DIR' ) ) {
    define( 'MEDINO_PLUGIN_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes' );
}

if ( ! defined( 'MEDINO_PLUGIN_ASSETS_DIR' ) ) {
    define( 'MEDINO_PLUGIN_ASSETS_DIR', plugins_url( 'assets', __FILE__ ) );
}

// load important files
require MEDINO_PLUGIN_INCLUDES_DIR . '/functions.php' ;
require MEDINO_PLUGIN_INCLUDES_DIR . '/class-medino.php' ;