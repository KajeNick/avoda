<?php

/**
 * Init class for Avoda Core plugin
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Avoda_Core {

	/**
	 * The one and only true Avoda_Core instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @var object $instance
	 */
	private static $instance;

	/**
	 * Plugin version
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $version = '1.0.0';

	/**
	 * Instantiate the main class
	 *
	 * This function instantiates the class, initialize all functions and return the object.
	 *
	 * @since 1.0.0
	 * @return object The one and only true Avoda_Core instance.
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) && ( ! self::$instance instanceof Avoda_Core ) ) {

			self::$instance = new Avoda_Core;
			self::$instance->set_up_constants();
			self::$instance->includes();

		}

		return self::$instance;
	}

	/**
	 * Function for setting up constants
	 *
	 * This function is used to set up constants used throughout the plugin.
	 *
	 * @since 1.0.0
	 */
	public function set_up_constants() {

		self::set_up_constant( 'AVODA_CORE_VERSION', $this->version );
		self::set_up_constant( 'AVODA_CORE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) . '../' );
		self::set_up_constant( 'AVODA_CORE_PLUGIN_URL', plugin_dir_url( __FILE__ ) . '../' );
		self::set_up_constant( 'AVODA_CORE_LIBRARIES_PATH', plugin_dir_path( __FILE__ ) );
		self::set_up_constant( 'AVODA_CORE_DEBUG', true );

	}

	/**
	 * Make new constants
	 *
	 * @param string $name
	 * @param mixed $val
	 *
	 * @since 1.0.0
	 */
	public static function set_up_constant( $name, $val = false ) {

		if ( ! defined( $name ) ) {
			define( $name, $val );
		}

	}

	/**
	 * Includes all necessary PHP files
	 *
	 * This function is responsible for including all necessary PHP files.
	 *
	 * @since 1.0.0
	 */
	public function includes() {

		if ( defined( 'AVODA_CORE_LIBRARIES_PATH' ) ) {
			require AVODA_CORE_LIBRARIES_PATH . 'avoda-core-tools.php';
			require AVODA_CORE_LIBRARIES_PATH . 'avoda-core-supports.php';

			if ( ! is_admin() ) {
				require AVODA_CORE_LIBRARIES_PATH . 'avoda-core-frontend.php';
			}
		}

	}

}