<?php
/**
 * Extends for support new post types, menus and another
 *
 * @since 1.0.0
 */

class Avoda_Core_Supports {

	/**
	 * Avoda_Core_Supports constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_filter( 'upload_mimes', array( $this, 'avoda_add_svg' ), 1, 1 );
		add_filter( 'wpcf7_autop_or_not', '__return_false' ); // clean f cf7 markup
		add_filter( 'wpcf7_form_elements', 'do_shortcode' );
		add_filter( 'acf/format_value/type=wysiwyg', 'do_shortcode' );
		add_filter( 'acf/format_value/type=textarea', 'do_shortcode' );
		add_filter( 'acf/format_value/type=text', 'do_shortcode' );
		add_filter( 'acf/format_value/type=email', 'do_shortcode' );
		add_filter( 'acf/format_value/type=url', 'do_shortcode' );
		add_filter( 'acf/format_value/type=number', 'do_shortcode' );
		add_filter( 'acf/format_value/type=image', 'do_shortcode' );
		add_filter( 'acf/format_value/type=link', 'do_shortcode' );

		add_action( 'after_setup_theme', array( $this, 'avoda_menu_init' ), 10 );
		add_action( 'acf/init', array( $this, 'avoda_options_acf_init' ) );
		add_action( 'widgets_init', array( $this, 'sidebars_widgets_init' ) );
		add_action( 'admin_init', array( $this, 'avoda_add_employer_role' ) );
		add_action( 'admin_init', array( $this, 'remove_no_need_roles' ) );

	}

	/**
	 * Add SVG image supports
	 *
	 * @since 1.0.0
	 *
	 * @param $mime_types
	 *
	 * @return mixed
	 */
	public function avoda_add_svg( $mime_types ) {

		$mime_types['svg'] = 'image/svg+xml';

		return $mime_types;
	}

	/**
	 * Register new menu
	 *
	 * @since 1.0.0
	 */
	public function avoda_menu_init() {

		register_nav_menus( array( 'header_menu' => 'Header menu' ) );

	}

	/**
	 * Add Advanced Custom Fields options page
	 *
	 * @since 1.0.0
	 */
	public function avoda_options_acf_init() {

		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( array(
				'page_title'      => 'הגדרות מתקדמות',
				'menu_title'      => 'הגדרות מתקדמות',
				'menu_slug'       => 'theme-general-settings',
				'capability'      => 'edit_posts',
				'redirect'        => false,
				'post_id'         => 'settings',
				'update_button'   => __( 'עדכן הגדרות', 'acf' ),
				'updated_message' => __( 'ההגדרות עודכנו', 'acf' ),
			) );

			acf_add_options_page( array(
				'page_title' => __( 'Theme settings' ),
				'menu_title' => __( 'Theme settings' ),
				'menu_slug'  => 'general-settings',
				'capability' => 'edit_posts',
				'redirect'   => false
			) );
		}

	}

	/**
	 * Register new widgets areas
	 *
	 * @since 1.0.0
	 */
	public function sidebars_widgets_init() {

		register_sidebar( array(
			'name'          => 'Footer 1 section',
			'id'            => 'footer_1',
			'before_widget' => '<div class="footer-col">',
			'after_widget'  => '</div>',
			'before_title'  => '<p class="footer-main">',
			'after_title'   => '</p>',
		) );
		register_sidebar( array(
			'name'          => 'Footer 2 section',
			'id'            => 'footer_2',
			'before_widget' => '<div class="footer-col">',
			'after_widget'  => '</div>',
			'before_title'  => '<p class="footer-main">',
			'after_title'   => '</p>',
		) );
		register_sidebar( array(
			'name'          => 'Footer 3 section',
			'id'            => 'footer_3',
			'before_widget' => '<div class="footer-col">',
			'after_widget'  => '</div>',
			'before_title'  => '<p class="footer-main">',
			'after_title'   => '</p>',
		) );

		register_sidebar( array(
			'name'          => 'Footer 4 section',
			'id'            => 'footer_4',
			'before_widget' => '<div class="footer-col">',
			'after_widget'  => '</div>',
			'before_title'  => '<p class="footer-main">',
			'after_title'   => '</p>',
		) );

	}

	/**
	 * Add role Employer
	 *
	 * @since 1.0.0
	 */
	public function avoda_add_employer_role() {

		add_role(
			'employer',
			'המעביד',
			array(
				'read'                 => true,
				'delete_posts'         => true,
				'delete_private_pages' => true,
				'edit_others_posts'    => true,
				'edit_posts'           => true,
				'edit_published_posts' => true,
				'manage_categories'    => true,
				'manage_links'         => true,
				'publish_posts'        => true,
				'read_private_posts'   => true,
				'upload_files'         => true
			)
		);

	}

	/**
	 * Remove default roles
	 *
	 * @since 1.0.0
	 */
	public function remove_no_need_roles() {

		remove_role( "editor" );
		remove_role( "author" );
		remove_role( "contributor" );

	}

}

function avoda_core_supports_runner() {

	return new Avoda_Core_Supports();
}

avoda_core_supports_runner();