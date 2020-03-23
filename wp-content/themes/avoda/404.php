<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package avoda
 */
get_header();
?>

    <div class="error">
        <div class="error-mid">
            <p class="error-main">404</p>
            <p class="error-text">מצטערים אבל הדף אינו זמין או שהוסר לצפייה</p>
            <a href="<?php echo get_home_url(); ?>" class="error-btn btn">חזור לדף הבית</a>
        </div>
        <div class="error-overlay"></div>
    </div>

<?php get_footer(); ?>