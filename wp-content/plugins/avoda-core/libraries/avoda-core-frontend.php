<?php
/**
 * Class Avoda_Core_Frontend
 * Init all frontend methods and functionality
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Avoda_Core_Frontend {

	public function __construct() {
	}

}

function avoda_core_frontend_runner() {

	return new Avoda_Core_Frontend();
}

avoda_core_frontend_runner();