<?php
/**
 * LookBook DHMD functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package avoda
 */

if ( ! function_exists( 'avoda_setup' ) ) {
	function avoda_setup() {
		load_theme_textdomain( 'avoda', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'menus' );
		add_theme_support( 'post-thumbnails' );
	}
}
add_action( 'after_setup_theme', 'avoda_setup' );


// add compoibility for woocommerce
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
/*---------------- end ---------------*/

/*--------------- theme functions -------------*/

// scripts and styles
wp_enqueue_script( 'jquery-ui-button' );
wp_enqueue_script( 'jquery-ui-spinner' );

function avoda_style_scripts() {
	wp_enqueue_style( 'avoda-fancybox-css', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
	wp_enqueue_style( 'avoda-basic-style', get_template_directory_uri() . '/style/libs.min.css' );
	wp_enqueue_style( 'avoda-basic-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'avoda-cst-style', get_template_directory_uri() . '/style/main.css?v=113' );


	wp_enqueue_script( 'avoda-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', '', '', true );
	wp_enqueue_script( 'avoda-jquery-mask', get_template_directory_uri() . '/js/jquery.inputmask.min.js', '', '', true );
	wp_enqueue_script( 'avoda-fancybox-js', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', '', '', true );
	wp_enqueue_script( 'avoda-libs-js', get_template_directory_uri() . '/js/libs.min.js', '', '', true );
	wp_enqueue_script( 'avoda-custom-script', get_template_directory_uri() . '/js/common.js?v=83', '', '', true );

}

add_action( 'wp_enqueue_scripts', 'avoda_style_scripts', 10 );


// template additional functions and add-ons
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/ajax-auth.php';
require get_template_directory() . '/inc/employer-info.php';
require get_template_directory() . '/inc/ajax-employer_account.php';
// end

// add ajax functions
add_action( 'wp_ajax_fileupload', 'avoda_custom_file_upload' );
add_action( 'wp_ajax_nopriv_fileupload', 'avoda_custom_file_upload' );

add_action( 'wp_ajax_employeraccinf', 'avoda_employer_account_info' );
// end

// add svg support
function avoda_add_svg( $mime_types ) {
	$mime_types['svg'] = 'image/svg+xml';

	return $mime_types;
}

add_filter( 'upload_mimes', 'avoda_add_svg', 1, 1 );
// end

// register header menu
if ( function_exists( 'avoda_menu_init' ) ) {
	function avoda_menu_init() {
		register_nav_menus( [
			'header_menu' => 'Header menu',
		] );
	}

	add_action( 'after_setup_theme', avoda_menu_init );
}

// end

// init ACF settings page
add_action( 'acf/init', 'avoda_options_acf_init' );

function avoda_options_acf_init() {

	if ( function_exists( 'acf_add_options_page' ) ) {
		$option_page = acf_add_options_page( array(
			'page_title'      => 'הגדרות מתקדמות',
			'menu_title'      => 'הגדרות מתקדמות',
			'menu_slug'       => 'theme-general-settings',
			'capability'      => 'edit_posts',
			'redirect'        => false,
			'post_id'         => 'settings',
			'update_button'   => __( 'עדכן הגדרות', 'acf' ),
			'updated_message' => __( 'ההגדרות עודכנו', 'acf' ),
		) );
	}

}

// end

// init footer widgets column
function sidebars_widgets_init() {

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

add_action( 'widgets_init', 'sidebars_widgets_init' );
// end

/* clean f cf7 markup */
add_filter( 'wpcf7_autop_or_not', '__return_false' );
/* end */

/* add custom user role for employer */
function avoda_add_employer_role() {

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

add_action( 'admin_init', 'avoda_add_employer_role' );
/* end */

/* hide wp admin bar for user with employer and default role */
global $user;
if ( ! current_user_can( 'administrator' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}
/* end */

/*  delete default users role */
remove_role( "editor" );
remove_role( "author" );
remove_role( "contributor" );
/* end */

/* validate name field in CV form */
add_filter( 'wpcf7_validate_text*', 'custom_text_validation_filter', 20, 2 );

function custom_text_validation_filter( $result, $tag ) {
	if ( 'name-cst-validation' == $tag->name ) {
		$re = "/^[A-Za-z\x{0590}-\x{05FF}\s]+$/u";

		if ( ! preg_match( $re, $_POST['name-cst-validation'], $matches ) ) {
			$result->invalidate( $tag, "זה לא שם תקף!" );
		}
	}

	return $result;
}

/* end */

/* init posts widget */
if ( ! function_exists( 'avoda_register_widgets' ) ) {
	function avoda_register_widgets() {
		include_once get_template_directory() . '/inc/posts-widget.php';
		register_widget( 'avoda_popular_posts_widget' );
	}

	add_action( 'widgets_init', 'avoda_register_widgets' );
}
/* end */


function misha_filter_function() {

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

add_action( 'wp_ajax_myfilter', 'misha_filter_function' ); // wp_ajax_{ACTION HERE}
add_action( 'wp_ajax_nopriv_myfilter', 'misha_filter_function' );

/*** Big Filter Function ***/
function big_filter_function() {

	//формируем массив
	$arr     = [];
	$arrmeta = [];
	foreach ( $_POST as $key => $val ) {
		if ( $key != 'action' && $key != 'price_min' && $key != 'price_max' && $key != 'fix_price' && $key != 'vacancy_term' && $key != 'vacancy_c' ) {
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

	$args['meta_query'] = array(
		'relation' => 'AND',
	);

	if ( $_POST['vacancy_c'] != 'on' ) {

		$args['meta_query'] [1] = array(
			'relation' => 'OR',
		);
		//от и до
		if ( $_POST['price_min'] == '' && $_POST['price_max'] != '' ) {
			$args['meta_query'][1][] =
				array(
					'key'     => 'salary-field',
					'value'   => array( 1, $_POST['price_max'] ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN'
				);
		} else if ( $_POST['price_min'] != '' && $_POST['price_max'] == '' ) {
			$args['meta_query'][1][] =
				array(
					'key'     => 'salary-field',
					'value'   => array( $_POST['price_min'], 100000000 ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN'
				);
		} else if ( $_POST['price_min'] != '' && $_POST['price_max'] != '' ) {
			$args['meta_query'][1][] =
				array(
					'key'     => 'salary-field',
					'value'   => array( $_POST['price_min'], $_POST['price_max'] ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN'
				);
		}

//фиксированная цена
		if ( $_POST['fix_price'] != '' ) {
			$args['meta_query'][1][] =
				array(
					'key'   => 'salary-field',
					'value' => $_POST['fix_price'],
					'type'  => 'NUMERIC'
				);
		}


		//выбор
		if ( $_POST['vacancy_term'] == 1 ) {
			/*
			$args['meta_query'][] =
				array(
					'key' => 'radio',
					'value' => $_POST['vacancy_term']
				);
			*/
		} else if ( $_POST['vacancy_term'] != '' ) {
			$args['meta_query'][] =
				array(
					'key'   => 'radio',
					'value' => $_POST['vacancy_term']
				);
		}
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

add_action( 'wp_ajax_bigfilter', 'big_filter_function' ); // wp_ajax_{ACTION HERE}
add_action( 'wp_ajax_nopriv_bigfilter', 'big_filter_function' );


if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => __( 'Theme settings' ),
		'menu_title' => __( 'Theme settings' ),
		'menu_slug'  => 'general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );
}

// DO_SHORTCODE
add_filter( 'wpcf7_form_elements', 'do_shortcode' );
add_filter( 'acf/format_value/type=wysiwyg', 'do_shortcode' );
add_filter( 'acf/format_value/type=textarea', 'do_shortcode' );
add_filter( 'acf/format_value/type=text', 'do_shortcode' );
add_filter( 'acf/format_value/type=email', 'do_shortcode' );
add_filter( 'acf/format_value/type=url', 'do_shortcode' );
add_filter( 'acf/format_value/type=number', 'do_shortcode' );
add_filter( 'acf/format_value/type=image', 'do_shortcode' );
add_filter( 'acf/format_value/type=link', 'do_shortcode' );
// END DO_SHORTCODE

