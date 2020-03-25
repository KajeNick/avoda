<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package avoda
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
    <![endif]-->

	<?php wp_head(); ?>
</head>

<body>

<div>
	<?php do_action( 'before' ); ?>

    <div class="header">
        <div class="container">
            <div class="header-flex">
                <div class="header-right">
                    <a href="<?php echo get_home_url(); ?>" class="header-logo">
                        <img src="<?php echo get_field( 'site_logo', 'settings' ); ?>" alt="AvodaZmanitLogo"
                             class="header-img">
                    </a>

					<?php
					if ( wp_get_nav_menu_items( 'Header menu' ) ) {
						$out_menu = '<ul class="header-menu">';
						$menu_arr = wp_get_nav_menu_items( 'Header menu' );
						$cur_item = '';

						foreach ( (array) $menu_arr as $key => $menu_item ) {
							if ( $menu_item->object_id == get_queried_object_id() ) {
								$cur_item = 'active';
							} else {
								$cur_item = '';
							}
							$out_menu .= '<li class="header-list"><a class="header-link ' . $cur_item . '" href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
						}
						$out_menu .= '</ul>';

						echo $out_menu;
					} else {
						echo '';
					}
					?>

                    <div class="header-left-mob">
                        <a href="javascript:void();" class="header-sing">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/user.svg'; ?>" alt="user"
                                 class="header-sing-icon">
                        </a>
                        <div class="header-burder">
                            <span class="header-line header-top"></span>
                            <span class="header-line header-mid"></span>
                            <span class="header-line header-bottom"></span>
                        </div>
                    </div>

                </div>

                <div class="header-left">
					<?php
					if ( is_user_logged_in() ) {
						$curr_user_info = wp_get_current_user();
						echo '<a href="/my-account" class="user-link">' . $curr_user_info->user_login . '</a>';

						?>
                        <div class="hidden_menu">
                            <a href="<?php echo site_url(); ?>/my-account" class="link">אזור אישי</a>
                            <a href="<?php echo wp_logout_url( $redirect = site_url() ); ?>" class="link">התנתק</a>
                        </div>
						<?php
					} else {
						?>
                        <a href="javascript:void();" class="header-link header-link-sing">התחברות</a>
                        <a href="javascript:void();" class="header-link header-link-sing-new">כניסה לעובדים</a>
                        <a href="javascript:void();" class="header-link header-link-registration">רישום</a>
						<?php
					}
					?>

                </div>

            </div>

            <form action="javascript:void(0);" class="header-form-registration header-form" id="register" method="post">
				<?php wp_nonce_field( 'ajax-register-nonce', 'signonsecurity' ); ?>
                <span class="header-form-title">רישום</span>
                <div class="notification"></div>
                <input id="email-reg" name="email" type="text" class="header-form-input" placeholder="דוא''ל">
                <input id="password-reg" name="password" type="password" class="header-form-input"
                       placeholder="סיסמה באנגלית ומספרים ללא רווח">
                <input id="repeat-password-reg" name="repeat-password" type="password" class="header-form-input"
                       placeholder="הקלידו סיסמה בשנית">
                <div class="terms-group">
                    <label class="header-form-label">
                        <input id="policy" type="checkbox" class="checkbox">
                        <span class="dropdown-check "></span>
                        <span class="header-form-name"> אני מסכים לתנאי <a href="/תקנון-אתר-מעסיקים-ומשתמשים/">תקנון האתר</a></span>
                    </label>

                </div>


                <button type="submit" class="btn header-form-btn">הרשם</button>
            </form>

            <form action="javascript:void(0);" class="header-form-sing header-form" id="login" method="post">
				<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                <span class="header-form-title">התחברות</span>
                <div class="notification"></div>
                <input id="email-log" name="email" type="text" class="header-form-input" placeholder="אימייל">
                <input id="password-log" name="password" type="password" class="header-form-input" placeholder="סיסמא">
                <button type="submit" class="btn header-form-btn">התחבר</button>
                <span class="header-form-item">זקוקים לחשבון? <a href="javascript:void();"
                                                                 class="header-form-item header-next-registration"> לחצו כאן</a></span>
                <span class="header-form-item">הסיסמה נשכחה? <a href="javascript:void();"
                                                                class="header-form-item header-next-recovery"> לחצו כאן</a></span>
            </form>

            <form action="javascript:void(0);" class="header-form-sing-new header-form" id="login-new" method="post">
				<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                <span class="header-form-title">כניסה לעובדים</span>
                <div class="notification"></div>
                <input id="email-log" name="email" type="text" class="header-form-input" placeholder="אימייל">
                <input id="password-log" name="password" type="password" class="header-form-input" placeholder="סיסמא">
                <button type="submit" class="btn header-form-btn">התחבר</button>
                <span class="header-form-item">זקוקים לחשבון? <a href="javascript:void();"
                                                                 class="header-form-item header-next-registration"> לחצו כאן</a></span>
                <span class="header-form-item">הסיסמה נשכחה? <a href="javascript:void();"
                                                                class="header-form-item header-next-recovery"> לחצו כאן</a></span>
            </form>
        </div>
    </div>

    <section class="sec-header">

		<?php echo do_shortcode( '[URIS id=708]' ); ?>

        <div class="container">

            <h1>
				<?php the_field( 'slider_text', 'settings' ); ?>
            </h1>

        </div>

	    <?php do_action('avoda_core_head_filter'); ?>
    </section>
