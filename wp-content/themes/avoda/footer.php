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
			<?php
			if ( function_exists( 'dynamic_sidebar' ) ) {
				dynamic_sidebar( 'footer_4' );
			}

			?>
			<?php
			if ( function_exists( 'dynamic_sidebar' ) ) {
				dynamic_sidebar( 'footer_3' );
			}

			?>
			<?php
			if ( function_exists( 'dynamic_sidebar' ) ) {
				dynamic_sidebar( 'footer_2' );
			}

			?>
			<?php
			if ( function_exists( 'dynamic_sidebar' ) ) {
				dynamic_sidebar( 'footer_1' );
			}

			?>
        </div>
    </div>
    <div class="fixed">
        <a href="javascript:void(0);" class="fixed-support fixed-circle">
            <img src="<?php echo get_template_directory_uri() ?>/img/support.svg" alt="" class="fixed-envelope">
        </a>
        <a href="javascript:void(0);" class="fixed-up fixed-circle">
            <img src="<?php echo get_template_directory_uri() ?>/img/arrow-up.svg" alt="" class="fixed-arrow">
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

    <!-- pop up for editing information on account page -->
	<?php
	$curr_user    = wp_get_current_user();
	$curr_user_id = $curr_user->ID;

	$company_name  = get_user_meta( $curr_user_id, 'company_name', true );
	$company_logo  = get_user_meta( $curr_user_id, 'company_logo', true );
	$user_email    = get_user_meta( $curr_user_id, 'contact_email', true );
	$user_phone    = get_user_meta( $curr_user_id, 'contact_phone', true );
	$user_activity = get_user_meta( $curr_user_id, 'type_of_activity', true );
	$contact_face  = get_user_meta( $curr_user_id, 'contact_face', true );
	$contact_site  = get_user_meta( $curr_user_id, 'contact_site', true );
	$contact_fb    = get_user_meta( $curr_user_id, 'contact_fb', true );


	if ( avoda_check_user_add_info() ) {

		?>


        <div class="popup-cst email-edit">
            <form data-prev="<?php echo $user_email; ?>" action="javascript:void(0);" id="email-edit" method="post">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>
                    <p class="popup-name">דוא"ל דואר:</p>
                    <input name="email-edit" type="text" class="popup-input" value="<?php echo $user_email; ?>">
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">לשלוח</button>
                </div>
            </form>
        </div>

        <div class="popup-cst contact-face-edit">
            <form data-prev="<?php echo $contact_face ?>" action="javascript:void(0);" id="contact-face-edit"
                  method="post">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>
                    <p class="popup-name">איש קשר בבית העסק:</p>
                    <input name="contact-face-edit" type="text" class="popup-input" value="<?php echo $contact_face ?>">
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">שמור</button>
                </div>
            </form>
        </div>

        <div class="popup-cst activity-edit">
            <form data-prev="<?php echo $user_activity ?>" action="javascript:void(0);" id="activity-edit"
                  method="post">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>
                    <p class="popup-name">תחום עיסוק:</p>
                    <select id="type-of-activity-add" class="account-select-add" placeholder="טסקט"
                            name="type-of-activity">
						<?php
						while ( have_rows( 'account_type_activity', 'settings' ) ) {
							the_row();
							if ( the_sub_field( 'activity_item' == $user_activity ) ) {
								?>
                                <option value="<?php the_sub_field( 'activity_item' ) ?>"
                                        selected="selected"><?php the_sub_field( 'activity_item' ) ?></option>
							<?php } else { ?>
                                <option value="<?php the_sub_field( 'activity_item' ); ?>"><?php the_sub_field( 'activity_item' ); ?></option>
							<?php }
						} ?>
                    </select>
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">שמור</button>
                </div>
            </form>
        </div>

        <div class="popup-cst company-name-edit">
            <form data-prev="<?php echo $company_name; ?>" method="post" action="javascript:void(0);"
                  id="company-name-edit">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>
                    <p class="popup-name">שם העסק:</p>
                    <input name="company-name-edit" type="text" class="popup-input"
                           value="<?php echo $company_name; ?>">
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">שמור</button>
                </div>
            </form>

        </div>

        <div class="popup-cst contact-site-edit">
            <form data-prev="<?php echo $contact_site; ?>" action="javascript:void(0);" method="post"
                  id="contact-site-edit">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>
                    <p class="popup-name">כתובת אתר:</p>
                    <input name="contact-site-edit" type="text" class="popup-input"
                           value="<?php echo $contact_site; ?>">
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">שמור</button>
                </div>
            </form>
        </div>

        <div class="popup-cst contact-fb-link">
            <form data-prev="<?php echo $contact_fb; ?>" action="javascript:void(0);" method="post"
                  id="contact-fb-link">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>
                    <p class="popup-name">קישור לדף הפייסבוק:</p>
                    <input name="contact-site-edit" type="text" class="popup-input" value="<?php echo $contact_fb; ?>">
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">שמור</button>
                </div>
            </form>
        </div>

        <div class="popup-cst pass-edit">
			<?php
			$curr_user    = wp_get_current_user();
			$curr_user_id = $curr_user->ID;
			?>
            <form action="javascript:void(0);" id="pass-edit" method="post" data-user_id="<?php echo $curr_user_id; ?>">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>
                    <p class="popup-name">סיסמא:</p>
                    <input id="old_pass" name="old_pass" type="password" class="popup-input mrg-bt"
                           placeholder="סיסמא ישנה">
                    <input id="new_pass" name="new_pass" type="password" class="popup-input mrg-bt"
                           placeholder="סיסמא חדשה">
                    <input id="repeat_pass" name="reapeat_pass" type="password" class="popup-input"
                           placeholder="סיסמא חוזרת">
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">שמור</button>
                </div>
            </form>
        </div>

        <div class="popup-cst user-phone-edit">
            <form data-prev="<?php echo $user_phone; ?>" action="javacsript:void(0);" method="post"
                  id="user-phone-edit">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>
                    <p class="popup-name">טלפון ליצירת קשר:</p>
                    <input type="text" id="phone-edit" name="phone-edit" type="text" class="popup-input"
                           value="<?php echo $user_phone; ?>">
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">שמור</button>
                </div>
            </form>

        </div>


        <div class="popup-cst company-edit-logo">
            <form data-prev="<?php echo $company_logo; ?>" action="javascript:void(0);" method="post"
                  id="company-edit-logo" enctype="multipart/form-data">
                <div class="popup-container">
                    <div data-fancybox-close class="popup-close"></div>

                    <div class="account-upload cst-upload-file without-mrg">
                        <div class="cst-upload-file__preview-cont hide">
                            <div class="cst-upload-file__preview-item"></div>
                            <a data-fileurl='' href="javascript:void(0);" class="cst-upload-file__delete-file"
                               rel="nofollow"></a>
                        </div>

                        <div class="cst-upload-file-cont">
                            <input type="file" name="company-logo" class="cst-upload-file__inpt"
                                   id="cst-upload-file__inpt">
                            <a href="javascript:void(0);" rel="nofollow" class="btn cst-upload-file__btn full">העלה
                                קובץ</a>
                        </div>
                    </div>
                    <div class="notification"></div>
                    <button type="submit" class="btn popup-btn">שמור</button>
                </div>
            </form>
        </div>
	<?php } else {
		echo '';
	} ?>

    <!-- end -->

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