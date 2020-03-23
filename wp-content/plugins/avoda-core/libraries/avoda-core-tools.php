<?php
/**
 * Some tools for work with files and another objects
 *
 * @since 1.0.0
 */

class Avoda_Core_Tools {

	/**
	 * Avoda_Core_Tools constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_filter( 'wpcf7_validate_text*', array( $this, 'custom_text_validation_filter' ), 20, 2 );

		add_action( 'wp_ajax_fileupload', array( $this, 'avoda_custom_file_upload' ), 10 );
		add_action( 'wp_ajax_nopriv_fileupload', array( $this, 'avoda_custom_file_upload' ), 10 );

	}

	/**
	 * Custom file uploading
	 *
	 * @since 1.0.0
	 */
	public function avoda_custom_file_upload() {

		$posted_data = isset( $_POST ) ? $_POST : array();
		$file_data   = isset( $_FILES ) ? $_FILES : array();

		$data = array_merge( $posted_data, $file_data );

		//check_ajax_referer('avoda-custom-file-upload' ,'security');

		$response = array();

		$uploaded_file = wp_handle_upload( $data['file'], array( 'test_form' => false ) );
		if ( $uploaded_file && ! isset( $uploaded_file['error'] ) ) {
			$response['response'] = "SUCCESS";
			$response['filename'] = basename( $uploaded_file['url'] );
			$response['url']      = $uploaded_file['url'];
			$response['type']     = $uploaded_file['type'];

			$file_path          = pathinfo( $uploaded_file['url'] );
			$file_name          = $file_path['filename'];
			$uploaded_file_type = $uploaded_file['type'];

			$file_name_and_location       = $uploaded_file["file"];
			$file_title_for_media_library = $file_name;
			$attachment                   = array(
				"post_mime_type" => $uploaded_file_type,
				"post_title"     => $file_title_for_media_library,
				"post_content"   => "",
				"post_status"    => "inherit"
			);

			if ( ! is_null( $post ) ) {
				if ( ! is_numeric( $post ) ) {
					$post = $post->ID;
				}

				$attachment ['post_parent'] = $post;
			}
			$id = wp_insert_attachment( $attachment, $file_name_and_location );
			require_once( ABSPATH . "wp-admin/includes/image.php" );
			$attach_data = wp_generate_attachment_metadata( $id, $file_name_and_location );
			wp_update_attachment_metadata( $id, $attach_data );
		} else {
			$response['response'] = "ERROR";
			$response['error']    = $uploaded_file['error'];
		}

		echo json_encode( $response );

		die();
	}

	/**
	 * Validate name in CV
	 *
	 * @since 1.0.0
	 *
	 * @param $result
	 * @param $tag
	 *
	 * @return mixed
	 */
	public function custom_text_validation_filter( $result, $tag ) {
		if ( 'name-cst-validation' == $tag->name ) {
			$re = "/^[A-Za-z\x{0590}-\x{05FF}\s]+$/u";

			if ( ! preg_match( $re, $_POST['name-cst-validation'], $matches ) ) {
				$result->invalidate( $tag, "זה לא שם תקף!" );
			}
		}

		return $result;
	}

}

function avoda_core_tools_runner() {

	return new Avoda_Core_Tools();
}

avoda_core_tools_runner();