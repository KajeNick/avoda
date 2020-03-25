<?php
/**
 * Class Avoda_Core_Frontend
 * Init all frontend methods and functionality
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Avoda_Core_Frontend {

	/**
	 * Avoda_Core_Frontend constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'avoda_style_scripts' ), 10 );

		if ( ! is_user_admin() ) {
			add_filter( 'show_admin_bar', '__return_false' ); //Hide admin bar in frontend
		}

		$this->includes();
	}

	/**
	 * Frontend styles and scripts
	 *
	 * @since 1.0.0
	 */
	public function avoda_style_scripts() {

		wp_enqueue_style( 'kit-free', 'https://kit-free.fontawesome.com/releases/latest/css/free.min.css' );
		wp_enqueue_style( 'avoda-fancybox-css', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
		wp_enqueue_style( 'avoda-basic-style', get_template_directory_uri() . '/assets/css/libs.min.css' );
		wp_enqueue_style( 'avoda-basic-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'avoda-cst-style', get_template_directory_uri() . '/assets/css/main.css?v=113' );

		wp_enqueue_script( 'avoda-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', '', '', true );
		wp_enqueue_script( 'avoda-jquery-mask', get_template_directory_uri() . '/assets/js/jquery.inputmask.min.js', '', '', true );
		wp_enqueue_script( 'avoda-fancybox-js', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', '', '', true );
		wp_enqueue_script( 'avoda-libs-js', get_template_directory_uri() . '/assets/js/libs.min.js', '', '', true );
		wp_enqueue_script( 'avoda-custom-script', get_template_directory_uri() . '/assets/js/common.js', array(
			'avoda-jquery',
			'avoda-jquery-mask',
			'avoda-fancybox-js',
			'avoda-libs-js'
		), time(), true );

	}

	/**
	 * Add employer methods
	 *
	 * @since 1.0.0
	 */
	private function includes() {

		require AVODA_CORE_LIBRARIES_PATH . 'frontend/avoda-core-filter.php';
		require AVODA_CORE_LIBRARIES_PATH . 'frontend/avoda-core-employer.php';
		require AVODA_CORE_LIBRARIES_PATH . 'frontend/avoda-core-vacancy.php';
		require AVODA_CORE_LIBRARIES_PATH . 'frontend/avoda-core-brands.php';

	}


}

function avoda_core_frontend_runner() {

	return new Avoda_Core_Frontend();
}

avoda_core_frontend_runner();