<?php
/*
	Template for displaying a temporary jobs
 * Template Name: short-terms-vacancy
 * Template Post Type: post, page
 */

get_header();
?>


<?php get_template_part('template-parts/section-header'); ?>

<div class="single-page" id="<?php echo get_the_ID()?>">

    <div class="container">
       
        <?php get_template_part('template-parts/additional-filter'); ?>
        
        <?php if( 0 /*have_rows('basic_slider','settings') */) {?>
        <section class="first">
            <div class="first-slider">
                <?php while(have_rows('basic_slider','settings')) {
					the_row();
				?>
                <div class="first-slider-item">
                    <img src="<?php the_sub_field('slide');?>" alt="offer" class="first-img">
                </div>
                <?php }?>
            </div>
            <h1 class="first-title">
                <?php the_field('slider_text','settings');?>
            </h1>
        </section>
        <?php } ?>

        <section class="third">
            <?php
                $vacancy_term_long_args = array(
                    'post_type' => 'vacancy',
                    'meta_query' => [
                        'relation' => 'AND',
                        [
                            'key' => 'approve',
                            'value' => 'yes'
                        ],
                        [
                            'key' => 'in_archive',
                            'value' => 'no'
                        ],
                        [
                            'key' => 'in_freezee',
                            'value' => 'no'
                        ]
                    ],
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'term_of_work',
                            'field'    => 'slug',
                            'terms'    => 'temporery'
                        )
                    )
                );

                $vacancy_term_long = new WP_Query($vacancy_term_long_args);
                
                if($vacancy_term_long->have_posts()) {
            ?>
            <h3 class="title">
                עבודות זמניות  
            </h3>
            <div class="third-top bg-hex">
                <p class="third-top-name">תאור המשרה</p>
                <p class="third-top-name">אזור</p>
                <p class="third-top-name">תחום</p>
            </div>
            <ul class="third-menu">
                <?php while($vacancy_term_long-> have_posts()) {
                    $vacancy_term_long->the_post();

                    $vacancy_id = get_the_ID();

                    $carr_user_id = $post->post_author;
                    $vacancy_company_logo = get_user_meta($carr_user_id,'company_logo',true);

                    $vacancy_city_north = wp_get_post_terms($vacancy_id, 'north', array('fields'=> 'names'));
                    $vacancy_city_sharon = wp_get_post_terms($vacancy_id, 'sharon', array('fields'=> 'names'));
                    $vacancy_city_center = wp_get_post_terms($vacancy_id, 'center', array('fields'=> 'names'));
                    $vacancy_city_jerusalem = wp_get_post_terms($vacancy_id, 'jerusalem', array('fields' => 'names'));
                    $vacancy_city_south = wp_get_post_terms($vacancy_id, 'south', array('fields'=> 'names'));
                    $vacancy_city_lowland = wp_get_post_terms($vacancy_id, 'lowland', array('fields'=> 'names'));

                    $vacancy_cities_all = array();
                    

                    if(!is_wp_error( $vacancy_city_north ) && !empty( $vacancy_city_north ) ) {
                        for($i = 0; $i<count($vacancy_city_north); $i++) {
                            array_push($vacancy_cities_all, $vacancy_city_north[$i]);
                        }
                    }

                    if(!is_wp_error( $vacancy_city_sharon ) && !empty( $vacancy_city_sharon ) ) {
                        for($i = 0; $i<count($vacancy_city_sharon); $i++) {
                            array_push($vacancy_cities_all, $vacancy_city_sharon[$i]);
                        }
                    }

                    if(!is_wp_error( $vacancy_city_center ) && !empty( $vacancy_city_center ) ) {
                        for($i = 0; $i<count($vacancy_city_center); $i++) {
                            array_push($vacancy_cities_all, $vacancy_city_center[$i]);
                        }
                    }

                    if(!is_wp_error( $vacancy_city_jerusalem ) && !empty( $vacancy_city_jerusalem ) ) {
                        for($i = 0; $i<count($vacancy_city_jerusalem); $i++) {
                            array_push($vacancy_cities_all, $vacancy_city_jerusalem[$i]);
                        }
                    }

                    if(!is_wp_error( $vacancy_city_south ) && !empty( $vacancy_city_south ) ) {
                        for($i = 0; $i<count($vacancy_city_south); $i++) {
                            array_push($vacancy_cities_all, $vacancy_city_south[$i]);
                        }
                    }

                    if(!is_wp_error( $vacancy_city_lowland ) && !empty( $vacancy_city_lowland ) ) {
                        for($i = 0; $i<count($vacancy_city_lowland); $i++) {
                            array_push($vacancy_cities_all, $vacancy_city_lowland[$i]);
                        }
                    }

                    $vacancy_cities_str = join($vacancy_cities_all, ', ');

                    $vacancy_type_of_office = wp_get_post_terms($vacancy_id, 'field_of_office', array('fields'=> 'names'));
                    $vacancy_type_of_office_str = join(', ', $vacancy_type_of_office);

                    /*$vacancy_type_of_job = wp_get_post_terms($vacancy_id, 'type_of_job', array('fields'=> 'names'));
                    $vacancy_type_of_job_str = join(', ', $vacancy_type_of_job);*/

                    $vacancy_scope_of_job = wp_get_post_terms($vacancy_id, 'scope_of_job', array('fields'=> 'names'));
                    $vacancy_scope_of_job_str = join(', ', $vacancy_scope_of_job);
                
                    $vacancy_salary = get_post_meta($vacancy_id, 'salary-field',true);
                ?>
                <li class="third-list ">
                    <div class="third-list-choice bg-hex">
                        <div class="third-list-item">
                            <?php echo get_the_title(); ?>
                        </div>
                        <div class="third-list-item ">
                            <?php echo $vacancy_cities_str;?>
                        </div>
                        <div class="third-list-item ">
                            <?php echo $vacancy_type_of_office[0];?>
                        </div>

                        <div class="drop-icon">
                            <img src="<?php echo get_template_directory_uri( );?>/assets/images/chevron-circle-left-solid.svg" alt="open" class="drop-icon-open">
                            <img src="<?php echo get_template_directory_uri( );?>/assets/images/times-circle-solid.svg" alt="close" class="drop-icon-close">
                        </div>
                    </div>
                    <ul class="third-drop">
                        <li class="third-drop-list">
                            <div class="third-drop-right">
                                <p class="third-drop-title"><?php echo get_the_title();?><br>
                                <span class="third-drop-subspan">
                                        <span class="third-drop-bold">תחום:</span>
                                        <?php echo $vacancy_type_of_office_str;?>
                                        </span>
                                    </span>
                                </p>

                                <div class="text">
                                    <span class="third-drop-bold">תיאור המשרה:</span><br class="br-have">
                                    <?php the_content(); ?>
                                </div>
                                <p class=" text">
                                    <?php if(is_array($vacancy_salary)) {?>
                                        <span class="third-drop-bold">שכר:</span><?php echo $vacancy_salary[1].' - '.$vacancy_salary[0]; ?> ₪
                                    <?php } else {?>
                                        <span class="third-drop-bold">שכר:</span>₪<?php echo $vacancy_salary; ?>
                                    <?php } ?>
                                </p>
                                <div class=" text">
                                    <span class="third-drop-bold">מיקום המשרה:</span>
                                    <?php echo $vacancy_cities_str;?>
                                </div>
                                <div class=" text">
                                    <span class="third-drop-bold">היקף המשרה:</span>
                                    <?php echo $vacancy_scope_of_job_str;?>
                                </div>
                            </div>
                            <div class="third-drop-left">
                                <div class="third-drop-logo">
                                    <img src="<?php echo $vacancy_company_logo; ?>" alt="<?php echo get_the_title(); ?>">
                                </div>
                                <button data-attach_vacancy="<?php echo $vacancy_id;?>" class="btn third-drop-btn attach-cv">שלח קורות חיים</button>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php
                    }
                ?>
            </ul>
            <?php 
                } else {
            ?>
                <div class="account-form bg-hex account-no-content">
                מצטערים, לא נמצאו מקומות עבודה
                </div>
            <?php
                }
                wp_reset_postdata();
            ?>
        </section>
    </div>
</div>

<?php
get_footer();