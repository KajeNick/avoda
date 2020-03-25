<?php
/**
 * Class Avoda_Core_Brands
 * Display Brands slider by shortcode
 *
 * @since 1.0.0
 */

class Avoda_Core_Brands {

	/**
	 * Avoda_Core_Brands constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'avoda_brands', array( $this, 'show_brands' ) );

	}

	/**
	 * Display Brands slider
	 *
	 * @since 1.0.0
	 */
	public function show_brands() {

		$result = '';

		if ( have_rows( 'ad_slider', 'settings' ) ) {
			$result = '<h3 class="title">עבודות זמניות שפורסמו לאחרונה</h3>';
			$result .= '<div class="third-slider">';
			while ( have_rows( 'ad_slider', 'settings' ) ) {
				the_row();

				$result .= '<div class="third-slider-item">';
				$result .= '    <img src="' .get_sub_field('ad-logo'). '" alt="logo-ad" class="third-slider-img">';
				$result .= '</div>';
			}
		}
		$result .= '</div>';

		echo $result;

	}
}

function avoda_core_brands_runner() {

	return new Avoda_Core_Brands();
}

avoda_core_brands_runner();