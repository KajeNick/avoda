<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package avoda
 */
?>

<footer class="footer bg-hex">
    <div class="container">
        <div class="footer-flex">
			<?php dynamic_sidebar( 'footer_4' ); ?>
			<?php dynamic_sidebar( 'footer_3' ); ?>
			<?php dynamic_sidebar( 'footer_2' ); ?>
			<?php dynamic_sidebar( 'footer_1' ); ?>
        </div>
    </div>
    <div class="fixed">
        <a href="javascript:void(0);" class="fixed-support fixed-circle">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/support.svg" alt="" class="fixed-envelope">
        </a>
        <a href="javascript:void(0);" class="fixed-up fixed-circle">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/arrow-up.svg" alt="" class="fixed-arrow">
        </a>
    </div>

    <div class="popup-cst popup-sending CV-popup">
		<?php echo do_shortcode( '[contact-form-7 id="43" title="Pop up CV"]' ); ?>
    </div>

    <div class="popup-cst thanksForCv">
        <div class="popup-container">
            <a href="javascript:void(0);" data-fancybox-close class="popup-close"></a>
            <p class="popup-title">תודה!</p>
            <p class="popup-text">בקשתך התקבלה ומועברת למעסיק</p>
            <a href="<?php echo get_home_url(); ?>" class="btn popup-btn cst-btn-full">חזרה לבית</a>
        </div>
    </div>


    <div class="popup-cst popup-thanks-data">
        <div class="popup-container">
            <div class="popup-close"></div>
            <p class="popup-text">בקשתך התקבלה ומועברת למעסיק</p>
            <button class="btn popup-btn">חזרה לבית</button>
        </div>
    </div>

    <div class="popup-cst popup-reset-pass">
        <form id="forgot-password" class="reset-pass" action="javascript:void(0);" method="post">
			<?php wp_nonce_field( 'ajax-reset-pass', 'reset-pass-nonce' ); ?>
            <div class="popup-container">
                <div data-fancybox-close class="popup-close"></div>
                <p class="popup-title-bold">
                    שחזור סיסמא
                    <span class="popup-title-span">הכנס את תיבת האימייל שאיתה נרשמת לאתר</span>
                </p>
                <div class="popup-field">
                    <input id="user_login" name="user_login" type="text" class="popup-input" placeholder="אימייל">
                    <div class="notification"></div>
                </div>
                <button type="submit" class="btn popup-btn">לשלוח</button>
            </div>
        </form>
    </div>

    <!-- pop up fo succes creating post in my account -->
    <div class="popup-cst big success-insert">
        <div class="poup-container">
            <div data-fancybox-close class="popup-close"></div>
            <div class="success-insert__inner">
                <span class="line">תודה!</span>
                <span class="line">המשרה הועברה לאישור מנהל האתר</span>
                <span class="line">לאחר סגירת החלון, העמוד ייטען מחדש</span>
            </div>
        </div>
    </div>
    <!-- end -->

    <!-- pop up for success updating vacancy -->
    <div class="popup-cst big success-update">
        <div class="poup-container">
            <div data-fancybox-close class="popup-close"></div>
            <div class="success-insert__inner">
                <span class="line">תודה!</span>
                <span class="line">עדכון פנוי זה בהצלחה</span>
            </div>
        </div>
    </div>
    <!-- end -->


    <!-- pop up for attach cv to vacancy -->
    <div class="popup-cst custom-attach-cv">
        <form data-attach_to_id="" action="javascript:void(0);" method="post" id="custom-user-attach-cv"
              enctype="multipart/form-data">
            <div class="popup-container">
                <div data-fancybox-close class="popup-close"></div>
                <div class="notification"></div>
                <div class="popup-field">
                    <p class="popup-name">שם מלא<span class="black-star">*</span>:</p>
                    <input type="text" class="popup-input" placeholder="טקסט" name="candidate-name" id="candidate-name">

                </div>
                <div class="popup-field">
                    <p class="popup-name">דוא"ל<span class="black-star">*</span>:</p>
                    <input type="text" class="popup-input" placeholder="טקסט" name="candidate-email"
                           id="candidate-email">

                </div>
                <div class="popup-field">
                    <p class="popup-name">טלפון<span class="black-star">*</span>:</p>
                    <input type="text" class="popup-input" placeholder="טקסט" name="candidate-telephone"
                           id="candidate-telephone">

                </div>
                <div class="popup-field">
                    <p class="popup-name">מכתב פתיחה (טקסט חופשי) :</p>
                    <textarea id="candidate_message" name="candidate_message" cols="40" rows="10" class="popup-textarea"
                              placeholder="טקסט"></textarea>

                </div>

                <div class="account-upload cst-upload-file-add">
                    <div class="cst-upload-file__preview-cont hide">
                        <div class="cst-upload-file__preview-item"></div>
                        <a data-fileurl="" href="javascript:void(0);" class="cst-upload-file__delete-file"
                           rel="nofollow"></a>
                    </div>
                    <div class="cst-upload-file-cont">
                        <input type="file" name="cv-file" class="cst-upload-file__inpt" id="cst-upload-file__inpt">
                        <p class="account-name">העלה קורות חיים<span class="black-star">*</span></p>
                        <a href="javascript:void(0);" rel="nofollow" class="btn cst-upload-file__btn">העלה קובץ</a>
                    </div>
                </div>
                <span class="popup-span">אלו שדות חובה *</span>
                <button type="submit" class="btn popup-btn">שלח קורות חיים</button>
            </div>
        </form>
    </div>
    <!-- end -->


</footer>
<div class="footer_bottom">
    <div class="container">
        <ul>
            <li><span class="copy">
                    <?php
                    $footer_text = get_theme_mod( 'footer_text' );

                    if ( empty( $footer_text ) ) {
	                    printf( __( '&copy; %d, %s. All rights are reserved.', 'avoda' ), date( 'Y' ), get_bloginfo( 'name' ) );
                    } else {
	                    echo $footer_text;
                    }
                    ?></span></li>
            <li><span>Made by</span><a href="https://anvi.agency/" target="_blank"><img class="images"
                                                                                        src="<?php echo get_template_directory_uri(); ?>/assets/images/brand_logo.png"
                                                                                        alt="brand_logo"></a></li>
        </ul>
    </div>
</div>
<?php wp_footer(); ?>

</body>
</html>