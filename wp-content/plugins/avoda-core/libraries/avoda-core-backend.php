<?php
/**
 * Class Avoda_Core_Frontend
 * Init all frontend methods and functionality
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Avoda_Core_Backend {

	/**
	 * Avoda_Core_Backend constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->includes();

	}

	/**
	 * Add employer methods
	 *
	 * @since 1.0.0
	 */
	private function includes() {

		require AVODA_CORE_LIBRARIES_PATH . 'backend/avoda-core-filter-results.php';

	}


}

function avoda_core_backend_runner() {

	return new Avoda_Core_Backend();
}

avoda_core_backend_runner();