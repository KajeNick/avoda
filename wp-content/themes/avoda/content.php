<?php
$thumb      = get_field( 'post_thumb', get_the_ID() );
$short_desc = get_field( 'post_short_text', get_the_ID() );
?>

<div class="blog-item bg-hex">

	<?php if ( $thumb ) { ?>
        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" class="blog-img">
	<?php } else { ?>
        <img src="<?php echo get_template_directory_uri() . '/img/default-img.svg'; ?>" alt="<?php the_title(); ?>"
             class="blog-img">
	<?php } ?>

    <p class="blog-name"><a href="<?php get_the_permalink( get_the_ID() ) ?>"><?php the_title(); ?></a></p>
	<?php if ( $short_desc ) { ?>
        <p class="blog-text"><?php esc_attr_e( $short_desc ); ?></p>
	<?php } ?>

    <div class="blog-info">
        <div class="blog-date">
			<?php avoda_displ_post_date( get_the_ID() ); ?>
        </div>
        <a href="<?php echo get_the_permalink( get_the_ID() ); ?>" class="blog-more">המשך לקרוא</a>
    </div>
</div>