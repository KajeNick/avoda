<?php
/**
 * Actions for filter
 *
 * @since 1.0.0
 */

class Avoda_Core_Filter_Results {

	/**
	 * Avoda_Core_Employer constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'wp_ajax_avoda_filter_results', array( $this, 'ajax_filter_results' ) );
		add_action( 'wp_ajax_nopriv_avoda_filter_results', array( $this, 'ajax_filter_results' ) );

		add_action( 'wp_ajax_big_filter_results', array( $this, 'ajax_big_filter_results' ) );
		add_action( 'wp_ajax_nopriv_big_filter_results', array( $this, 'ajax_big_filter_results' ) );

	}

	/**
	 * Filter results by AJAX
	 *
	 * @since 1.0.0
	 */
	public function ajax_filter_results() {

		// print_r($_POST);

//формируем массив
		$arr = [];
		foreach ( $_POST as $key => $val ) {
			if ( $key != 'action' ) {
				if ( strripos( $key, '-' ) ) {
					$keys           = stristr( $key, '-', true );
					$arr[ $keys ][] = $val;
				} else {
					$keys           = $key;
					$arr[ $keys ][] = $val;
				}
			}
		}
		$args              = array(
			'post_type' => 'vacancy'
		);
		$args['tax_query'] = array(
			'relation' => 'AND',
		);
		foreach ( $arr as $key => $val ) {
			$args['tax_query'][] =
				array(
					'taxonomy' => $key,
					'field'    => 'id',
					'terms'    => $val
				);
		}

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ): $query->the_post();
				get_template_part( 'template-parts/content', 'filter_data' );
			endwhile;
			wp_reset_postdata();
		else :
			echo '<div class="not__fond">
		מצטערים, לא נמצאו מקומות עבודה      
		</div>';
		endif;
		die();
	}

}

function avoda_core_filter_results_runner() {

	return new Avoda_Core_Filter_Results();
}

avoda_core_filter_results_runner();