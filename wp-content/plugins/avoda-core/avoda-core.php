<?php
/**
 * Plugin Name: Avoda Core
 * Plugin URI: https://anvi.agency
 * Description: Core plugin for avoda theme. Contains all functionality, methods and other.
 * Version: 1.0.0
 * Author: NSukonny
 * Author URI: https://nsukonny.ru
 * Text Domain: avoda-core
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Avoda_Core' ) ) {

	include_once dirname( __FILE__ ) . '/libraries/avoda-core.php';

}

/**
 * The main function for returning Avoda_Core instance
 *
 * @since 1.0.0
 *
 * @return object The one and only true Avoda_Core instance.
 */
function avoda_core_runner() {

	return Avoda_Core::instance();
}

avoda_core_runner();