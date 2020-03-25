<?php
/**
 * All functionality for Employer and his cabinet
 *
 * @since 1.0.0
 */

class Avoda_Core_Employer {

	/**
	 * Avoda_Core_Employer constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'wp_ajax_employeraccinf', 'avoda_employer_account_info' );

	}

	/**
	 * Update employer info
	 *
	 * @since 1.0.0
	 */
	public function avoda_employer_account_info() {

		if ( isset( $_POST ) ) {
			$company_logo     = sanitize_text_field( $_POST['logo'] );
			$company_name     = sanitize_text_field( $_POST['name'] );
			$type_of_activity = sanitize_text_field( $_POST['activity'] );
			$contact_face     = sanitize_text_field( $_POST['face'] );
			$contact_phone    = sanitize_text_field( $_POST['phone'] );
			$contact_email    = sanitize_text_field( $_POST['email'] );
			$contact_site     = sanitize_text_field( $_POST['site'] );
			$contact_fb       = sanitize_text_field( $_POST['fb'] );

			$response = array();

			if ( ! empty( $company_name ) && ! empty( $type_of_activity ) && ! empty( $contact_face ) && ! empty( $contact_phone ) && ! empty( $contact_email ) ) {
				$curr_user    = wp_get_current_user();
				$curr_user_id = $curr_user->ID;

				update_user_meta( $curr_user_id, 'add_info_valid', true );

				update_user_meta( $curr_user_id, 'company_logo', $company_logo );
				update_user_meta( $curr_user_id, 'company_name', $company_name );
				update_user_meta( $curr_user_id, 'type_of_activity', $type_of_activity );
				update_user_meta( $curr_user_id, 'contact_face', $contact_face );
				update_user_meta( $curr_user_id, 'contact_email', $contact_email );
				update_user_meta( $curr_user_id, 'contact_phone', $contact_phone );

				update_user_meta( $curr_user_id, 'contact_site', $contact_site );
				update_user_meta( $curr_user_id, 'contact_fb', $contact_fb );

				$response['response'] = 'SUCCESS';
			} else {
				$response['response'] = "ERROR";
				$response['error']    = "בדקו את נכונות הנתונים";
			}

		}

		wp_send_json_success( $response );

		die();

	}

	/**
	 * Check user info
	 *
	 * @since 1.0.0
	 *
	 * @return mixed|void
	 */
	public static function avoda_check_user_add_info() {

		if ( avoda_check_user_role() ) {
			$curr_user      = wp_get_current_user();
			$curr_user_id   = $curr_user->ID;
			$valid_add_info = get_user_meta( $curr_user_id, 'add_info_valid', true );

			return $valid_add_info;
		} else {
			return null;
		}

	}

}

function avoda_core_employer_runner() {

	return new Avoda_Core_Employer();
}

avoda_core_employer_runner();