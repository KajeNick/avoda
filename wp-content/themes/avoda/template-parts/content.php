<?php
/**
 * The template part for displaying content
 *
 * @package avoda
 */
?>

<section class="third">

    <h2 class="title-main third-title">
		<?php the_title(); ?>
    </h2>

    <div class="entry-content">
		<?php the_content(); ?>
    </div><!-- .entry-content -->

	<?php if ( is_front_page() ) {
		do_action( 'avoda_filter_results' );
		do_action( 'avoda_brands' );
	} ?>

</section>
