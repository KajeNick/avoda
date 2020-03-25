<?php
/**
 * Filter in head
 *
 * @since 1.0.0
 */

class Avoda_Core_Filter {

	private $north_cities;
	private $sharon_cities;
	private $center_cities;
	private $experience_work;
	private $term_of_work;
	private $scope_of_job;
	private $field_of_office;
	private $lowland_cities;
	private $south_cities;
	private $jerusalem_cities;

	/**
	 * Avoda_Core_Employer constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'avoda_core_head_filter', array( $this, 'head_filter' ) );
		add_action( 'avoda_filter_results', array( $this, 'show_results' ) );

		add_action( 'wp_ajax_avoda_filter_results', array( $this, 'ajax_results' ) );
		add_action( 'wp_ajax_nopriv_avoda_filter_results', array( $this, 'ajax_results' ) );

	}

	/**
	 * Create filter form
	 *
	 * @since 1.0.0
	 */
	public function head_filter() {

		$this->prepare_terms();
		?>
        <div class="absolute__wrapper">
            <section class="second">

                <button class="second-item-search bg-hex">
                    <p class="second-name">חיפוש </p>
                    <span class="arrow-drop"></span>
                </button>

                <button class="second-item bg-hex" style="margin-bottom: 15px">
                    <p class="second-name">חיפוש מתקדם</p>
                    <span class="arrow-drop"></span>
                </button>

				<?php $this->big_filter(); ?>

				<?php $this->small_filter(); ?>

                <div class="filter-response hidden">
                    <a href="javascript:void(0);" rel="nofollow" class="reset-filter">אפס סנן</a>
                    <div class="filter-response_inner"></div>
                </div>
            </section>

        </div>
        <script>

            jQuery(function ($) {
                $('#filter').submit(function () {
                    var filter = $('#filter');

                    console.log(filter.serialize());

                    $.ajax({
                        url: filter.attr('action'),
                        data: filter.serialize(), // form data
                        type: filter.attr('method'), // POST
                        beforeSend: function (xhr) {
                            filter.find('button').text('מעבד...'); // changing the button label
                        },
                        success: function (data) {
                            filter.find('button').text('חיפוש'); // changing the button label back
                            $('#response').html(data); // insert data

                            setTimeout(function () {
                                $('html, body').stop().animate({
                                    scrollTop: $('.third-top.bg-hex').offset().top
                                }, 777);
                            }, 100);

                            $('ul.work__type.double__class').css('display', 'none');
                            $('ul.work__area.double__class').css('display', 'none');


                            $('.hider__one').css('display', 'none');
                            $('.hider_two').css('display', 'none');
                            $('.hider_three').css('display', 'none');
                            $('.hide_five').css('display', 'none');
                            $('.hider_foure').css('display', 'none');
                        }
                    });
                    return false;
                });

                /*** Start Big Filter ***/
                $('#big_filter').submit(function () {
                    var filter = $('#big_filter');

                    console.log(filter.serialize());
                    $.ajax({
                        url: filter.attr('action'),
                        data: filter.serialize(), // form data
                        type: filter.attr('method'), // POST
                        beforeSend: function (xhr) {
                            filter.find('button').text('מעבד...'); // changing the button label
                        },
                        success: function (data) {
                            filter.find('button').text('חיפוש'); // changing the button label back
                            $('button.second-item.bg-hex').click();


                            $('#response').html(data); // insert data

                            setTimeout(function () {
                                $('html, body').stop().animate({
                                    scrollTop: $('.third-top.bg-hex').offset().top
                                }, 777);
                            }, 1000);

                            $('.hider__one').css('display', 'none');
                            $('.hider_two').css('display', 'none');
                            $('.hider_three').css('display', 'none');
                            $('.hide_five').css('display', 'none');
                            $('.hider_foure').css('display', 'none');
                        }
                    });
                    return false;
                });


            });

        </script>
		<?php
	}

	/**
	 * Display small filter
	 *
	 * @since 1.0.0
	 */
	private function small_filter() {
		?>
        <form class="firstscreen__form" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST"
              id="filter">

            <!-- Company Area  -->
            <div class="drop__field-wrapper">
                <div class="drop__field drop__field_direction">

                    <div class="drop__field-title">
                        אזור :
                    </div>
                    <div class="carret">
                        <i class="fas fa-sort-down"></i>
                        <i class="carret__none fas fa-caret-up"></i>
                    </div>
                </div>
                <ul class="work__area double__class">
					<?php $this->small_filter_checkbox_list( $this->north_cities, 0 ); ?>
					<?php $this->small_filter_checkbox_list( $this->sharon_cities ); ?>
					<?php $this->small_filter_checkbox_list( $this->center_cities ); ?>
					<?php $this->small_filter_checkbox_list( $this->jerusalem_cities ); ?>
					<?php $this->small_filter_checkbox_list( $this->south_cities ); ?>
					<?php $this->small_filter_checkbox_list( $this->lowland_cities ); ?>
                </ul>
            </div>


            <!-- Company Direction  -->

            <div class="drop__field-wrapper">
                <div class="drop__field drop__field_type">

                    <div class="drop__field-title">
                        סוג משרה :
                    </div>
                    <div class="carret">
                        <i class="fas fa-sort-down"></i>
                        <i class="carret__none fas fa-caret-up"></i>
                    </div>
                </div>
                <ul class="work__type double__class">
					<?php $this->small_filter_checkbox_list( $this->field_of_office ); ?>
                </ul>
            </div>


            <button class="filter__btn">חיפוש</button>
            <input type="hidden" name="action" value="avoda_filter_results">
        </form>
		<?php
	}

	/**
	 * Display big filter
	 *
	 * @since 1.0.0
	 */
	private function big_filter() {
		?>
        <form id="big_filter" class="advanced-search ad-search__redesign bg-hex"
              action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST">

            <h3 class="title advanced-search-title">אזור בארץ:</h3>
            <div class="advanced-search-tabs">
                <div class="advanced-search-contain">

                    <!-- Filter Region Tabs  -->
                    <ul class="advanced-search-flex ad-tabs__redesign-border">
                        <li class="advanced-search-tab active">צפון</li>
                        <li class="advanced-search-tab">שרון</li>
                        <li class="advanced-search-tab">המרכז</li>
                        <li class="advanced-search-tab">ירושלים</li>
                        <li class="advanced-search-tab">דרום</li>
                        <li class="advanced-search-tab">שפלה</li>
                    </ul>
                    <!-- Filter Region Tabs End -->

					<?php $this->big_filter_checkbox_list( $this->north_cities, 'city-north', 118 ); ?>
					<?php $this->big_filter_checkbox_list( $this->north_cities, 'city-sharon', 119 ); ?>
					<?php $this->big_filter_checkbox_list( $this->north_cities, 'city-center', 120 ); ?>
					<?php $this->big_filter_checkbox_list( $this->north_cities, 'jerusalem-city', 121 ); ?>
					<?php $this->big_filter_checkbox_list( $this->north_cities, 'south-city', 122 ); ?>
					<?php $this->big_filter_checkbox_list( $this->north_cities, 'lowland-city', 123 ); ?>

                    <!-- Field of office -->
                    <ul>
						<?php $this->advanced_search_list( 'תחום משרה:', 'field_of_office', $this->field_of_office ); ?>
						<?php $this->advanced_search_list( 'היקף משרה:', 'scope_of_job', $this->scope_of_job ); ?>

                        <div class="slery__filter">
                            <h3 class="title">שכר:</h3>
                            <div class="slery__filter-content">
                                <div class="selery__filter-selery-type">
                                    <label id="swich_hourly" class="dropdown-lv1-label active">
                                        <input type="radio" class="checkbox" name="vacancy_term" value="1" checked>
                                        <span class="dropdown-lv1-name">שכר שעתי</span>
                                    </label>
                                    <label id="swich_mounthly" class="dropdown-lv1-label">
                                        <input type="radio" class="checkbox" name="vacancy_term" value="2">
                                        <span class="dropdown-lv1-name">שכר חודשי</span>
                                    </label>
                                </div>
                                <div class="slery__filter-item">
                                    <label for="price_min">החל מ</label>
                                    <input class="selery__filter-input" type="text" name="price_min" placeholder="₪0"/>
                                    <label for="price_max">עד</label>
                                    <input class="selery__filter-input" type="text" name="price_max" placeholder="₪0"/>
                                    <label for="fix_price">שער קבוע</label>
                                    <input class="selery__filter-input" type="text" name="fix_price" placeholder="₪0"/>
                                </div>
                            </div>
                            <label class="dropdown-lv1-label" style=" margin-top: 15px; ">
                                <input type="checkbox" class="checkbox" name="vacancy_c">
                                <span class="dropdown-check"></span>
                                <span class="dropdown-lv1-name">לא משנה</span>
                            </label>
                        </div>

                        <div class="term__exp ad-redesign__term__exp">
							<?php $this->advanced_search_list( 'סוג משרה:', 'term_of_job', $this->term_of_work, false ); ?>
							<?php $this->advanced_search_list( 'ניסיון:', 'experience_work', $this->experience_work, false, true ); ?>
                        </div>

                    </ul>
                    <!-- End Field of office -->
                </div>
            </div>
            <button class="btn advanced-search-btn submit">חיפוש</button>
            <input type="hidden" name="action" value="big_filter_results">
        </form>
		<?php
	}


	/**
	 * Prepare all terms for select fields
	 *
	 * @since 1.0.0
	 */
	private function prepare_terms() {

		$this->north_cities = get_terms( array(
			'taxonomy'   => 'north',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->sharon_cities = get_terms( array(
			'taxonomy'   => 'sharon',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->center_cities = get_terms( array(
			'taxonomy'   => 'center',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->jerusalem_cities = get_terms( array(
			'taxonomy'   => 'jerusalem',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->south_cities = get_terms( array(
			'taxonomy'   => 'south',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->lowland_cities = get_terms( array(
			'taxonomy'   => 'lowland',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->field_of_office = get_terms( array(
			'taxonomy'   => 'field_of_office',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->scope_of_job = get_terms( array(
			'taxonomy'   => 'scope_of_job',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->term_of_work = get_terms( array(
			'taxonomy'   => 'term_of_work',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

		$this->experience_work = get_terms( array(
			'taxonomy'   => 'experience_work',
			'hide_empty' => false,
			'orderby'    => 'none',
			'hide_empty' => false
		) );

	}

	/**
	 * Make checkboxes list
	 *
	 * @since 1.0.0
	 *
	 * @param $elements
	 * @param int $parent_id
	 */
	private function small_filter_checkbox_list( $elements, $parent_id = null ) {

		foreach ( $elements as $element ) {
			if ( null === $parent_id || $element->parent != $parent_id ) {
				?>
                <li>
                    <label for='small_filter_<?php esc_attr_e( $element->term_id ); ?>'>
                        <span><?php esc_attr_e( $element->name ); ?></span>
                        <input class="default__checker" id='small_filter_<?php esc_attr_e( $element->term_id ); ?>'
                               name="<?php esc_attr_e( $element->taxonomy ); ?>-<?php esc_attr_e( $element->term_id ); ?>"
                               type="checkbox" value='<?php esc_attr_e( $element->term_id ); ?>'>
                        <span class="custom__checker"></span>
                    </label>
                </li>
				<?php
			}
		}

	}

	/**
	 * Make checkboxes list for bit filter
	 *
	 * @since 1.0.0
	 *
	 * @param $elements
	 * @param $id
	 * @param int $parent_id
	 */
	private function big_filter_checkbox_list( $elements, $id, $parent_id = null ) {

		if ( ! is_wp_error( $elements ) ) { ?>

            <ul class="advanced-search-drop active" id="<?php esc_attr_e( $id ); ?>">
                <li class="advanced-search-list">
                    <div class="advanced-search-flex ad-search__redesign-border">
						<?php foreach ( $elements as $element ) { ?>
							<?php if ( $element->parent == $parent_id ) { ?>
                                <label class="dropdown-lv1-label" for="north_<?php esc_attr_e( $element->term_id ); ?>">
                                    <input value="<?php esc_attr_e( $element->term_id ) ?>"
                                           id="north_<?php esc_attr_e( $element->term_id ); ?>" type="checkbox"
                                           name="<?php esc_attr_e( $element->taxonomy ); ?>-<?php esc_attr_e( $element->term_id ); ?>"
                                           class="d1 checkbox">

                                    <span class="dropdown-check"></span>
                                    <span class="dropdown-lv1-name"><?php esc_attr_e( $element->name ); ?></span>
                                </label>
							<?php } ?>
						<?php } ?>
                    </div>
                </li>
            </ul>
			<?php
		}

	}

	/**
	 * Make checkboxes list in advanced field
	 *
	 * @since 1.0.0
	 *
	 * @param $title
	 * @param $id
	 * @param $elements
	 * @param bool $check_all
	 * @param bool $right_border
	 */
	private function advanced_search_list( $title, $id, $elements, $check_all = true, $right_border = false ) {
		?>
        <li class="advanced-search-list<?php if ( $right_border ) {
			echo ' right__border';
		} ?>">
            <div class="advanced-search-flex ad-search__office-field">
                <h3 class="title advanced-search-item"><?php esc_attr_e( $title ); ?></h3>
            </div>

            <div class="advanced-search-inner active" id="<?php esc_attr_e( $id ); ?>">
				<?php foreach ( $elements as $element ) { ?>
                    <label class="dropdown-lv1-label">
                        <input value="<?php esc_attr_e( $element->term_id ); ?>"
                               id="<?php esc_attr_e( $element->term_id ); ?>"
                               type="checkbox"
                               name="<?php esc_attr_e( $element->taxonomy ); ?>-<?php esc_attr_e( $element->term_id ); ?>"
                               class="d2 checkbox">
                        <span class="dropdown-check"></span>
                        <span class="dropdown-lv1-name"><?php esc_attr_e( $element->name ); ?></span>
                    </label>
				<?php } ?>

				<?php if ( $check_all ) { ?>
                    <!-- Check All -->
                    <label class="dropdown-lv1-label" for="<?php esc_attr_e( $id ); ?>_all_check">
                        <input id="<?php esc_attr_e( $id ); ?>_all_check" type="checkbox" class="checkbox">
                        <span class="dropdown-check"></span>
                        <span class="dropdown-lv1-name"> <span class="strong__check">בחר הכול</span> </span>
                    </label>
                    <!-- Check All End -->
				<?php } ?>
            </div>
        </li>
		<?php
	}

	/**
	 * Display search results by shortcode
	 *
	 * @since 1.0.0
	 */
	public function show_results() {

		$vacancy_term_short_args = array(
			'post_type'      => 'vacancy',
			'posts_per_page' => 6,
			'meta_query'     => [
				'relation' => 'AND',
				[
					'key'   => 'approve',
					'value' => 'yes'
				],
				[
					'key'   => 'in_archive',
					'value' => 'no'
				],
				[
					'key'   => 'in_freezee',
					'value' => 'no'
				]
			],
			'tax_query'      => array(
				array(
					'taxonomy' => 'term_of_work',
					'field'    => 'slug',
					'terms'    => 'temporery'
				)
			)
		);
		$vacancy_term_short      = new WP_Query( $vacancy_term_short_args );

		if ( $vacancy_term_short->have_posts() ) {
			?>
            <h3 class="title hide_five">
                עבודות זמניות שפורסמו לאחרונה
            </h3>
            <div class="third-top bg-hex">
                <p class="third-top-name">תאור המשרה</p>
                <p class="third-top-name">אזור</p>
                <p class="third-top-name">תחום</p>
            </div>

            <ul class="hider_foure third-menu">
				<?php while ( $vacancy_term_short->have_posts() ) {
					$vacancy_term_short->the_post();

					$vacancy_id = get_the_ID();

					$carr_user_id         = get_the_author_meta( 'ID' );
					$vacancy_company_logo = get_user_meta( $carr_user_id, 'company_logo', true );

					$vacancy_city_north     = wp_get_post_terms( $vacancy_id, 'north', array( 'fields' => 'names' ) );
					$vacancy_city_sharon    = wp_get_post_terms( $vacancy_id, 'sharon', array( 'fields' => 'names' ) );
					$vacancy_city_center    = wp_get_post_terms( $vacancy_id, 'center', array( 'fields' => 'names' ) );
					$vacancy_city_jerusalem = wp_get_post_terms( $vacancy_id, 'jerusalem', array( 'fields' => 'names' ) );
					$vacancy_city_south     = wp_get_post_terms( $vacancy_id, 'south', array( 'fields' => 'names' ) );
					$vacancy_city_lowland   = wp_get_post_terms( $vacancy_id, 'lowland', array( 'fields' => 'names' ) );

					$vacancy_cities_all = array();


					if ( ! is_wp_error( $vacancy_city_north ) && ! empty( $vacancy_city_north ) ) {
						for ( $i = 0; $i < count( $vacancy_city_north ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_north[ $i ] );
						}
					}

					if ( ! is_wp_error( $vacancy_city_sharon ) && ! empty( $vacancy_city_sharon ) ) {
						for ( $i = 0; $i < count( $vacancy_city_sharon ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_sharon[ $i ] );
						}
					}

					if ( ! is_wp_error( $vacancy_city_center ) && ! empty( $vacancy_city_center ) ) {
						for ( $i = 0; $i < count( $vacancy_city_center ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_center[ $i ] );
						}
					}

					if ( ! is_wp_error( $vacancy_city_jerusalem ) && ! empty( $vacancy_city_jerusalem ) ) {
						for ( $i = 0; $i < count( $vacancy_city_jerusalem ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_jerusalem[ $i ] );
						}
					}

					if ( ! is_wp_error( $vacancy_city_south ) && ! empty( $vacancy_city_south ) ) {
						for ( $i = 0; $i < count( $vacancy_city_south ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_south[ $i ] );
						}
					}

					if ( ! is_wp_error( $vacancy_city_lowland ) && ! empty( $vacancy_city_lowland ) ) {
						for ( $i = 0; $i < count( $vacancy_city_lowland ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_lowland[ $i ] );
						}
					}

					$vacancy_cities_str = join( $vacancy_cities_all, ', ' );

					$vacancy_type_of_office     = wp_get_post_terms( $vacancy_id, 'field_of_office', array( 'fields' => 'names' ) );
					$vacancy_type_of_office_str = join( ', ', $vacancy_type_of_office );

					$vacancy_scope_of_job     = wp_get_post_terms( $vacancy_id, 'scope_of_job', array( 'fields' => 'names' ) );
					$vacancy_scope_of_job_str = join( ', ', $vacancy_scope_of_job );
					?>
                    <li class="third-list ">
                        <div class="third-list-choice bg-hex">
                            <div class="third-list-item">
								<?php echo get_the_title(); ?>
                            </div>
                            <div class="third-list-item ">
								<?php echo $vacancy_cities_str; ?>
                            </div>
                            <div class="third-list-item ">
								<?php echo $vacancy_type_of_office[0]; ?>
                            </div>

                            <div class="drop-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chevron-circle-left-solid.svg"
                                     alt="open" class="drop-icon-open">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/times-circle-solid.svg"
                                     alt="close" class="drop-icon-close">
                            </div>
                        </div>
                        <ul class="third-drop">
                            <li class="third-drop-list">
                                <div class="third-drop-right">
                                    <p class="third-drop-title"><?php echo get_the_title(); ?><br>
                                        <span class="third-drop-subspan">
                                        <span class="third-drop-bold">תחום:</span>
                                        <?php echo $vacancy_type_of_office_str; ?>
                                        </span>
                                    </p>

                                    <div class="text">
                                        <span class="third-drop-bold">תיאור המשרה:</span><br class="br-have">
										<?php the_content(); ?>
                                    </div>
                                    <p class=" text">
                                        <span class="third-drop-bold">שכר:</span>₪200
                                    </p>
                                    <div class=" text">
                                        <span class="third-drop-bold">מיקום המשרה:</span>
										<?php echo $vacancy_cities_str; ?>
                                    </div>
                                    <div class=" text">
                                        <span class="third-drop-bold">היקף המשרה:</span>
										<?php echo $vacancy_scope_of_job_str; ?>
                                    </div>
                                </div>
                                <div class="third-drop-left">
                                    <div class="third-drop-logo">
                                        <img src="<?php echo $vacancy_company_logo; ?>"
                                             alt="<?php echo get_the_title(); ?>">
                                    </div>
                                    <button data-attach_vacancy="<?php echo $vacancy_id; ?>"
                                            class="btn third-drop-btn attach-cv">שלח קורות חיים
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </li>
					<?php
				}
				?>
            </ul>
			<?php
		}
		wp_reset_postdata();

		$vacancy_term_long_args = array(
			'post_type'      => 'vacancy',
			'meta_query'     => [
				'relation' => 'AND',
				[
					'key'   => 'approve',
					'value' => 'yes'
				],
				[
					'key'   => 'in_archive',
					'value' => 'no'
				],
				[
					'key'   => 'in_freezee',
					'value' => 'no'
				]
			],
			'posts_per_page' => 6,
			'tax_query'      => array(
				array(
					'taxonomy' => 'term_of_work',
					'field'    => 'slug',
					'terms'    => 'longterm'
				)
			)
		);

		$vacancy_term_long = new WP_Query( $vacancy_term_long_args );

		if ( $vacancy_term_long->have_posts() ) {
			?>
            <h3 class="hider_two title">
                הזדמנויות קריירה שפורסמו לאחרונה
            </h3>
            <div class="third-top hider_three bg-hex">
                <p class="third-top-name">תאור המשרה</p>
                <p class="third-top-name">אזור</p>
                <p class="third-top-name">תחום</p>
            </div>

            <ul id="response" class="third-menu">
                <div class="not__fond">
                    מצטערים, לא נמצאו מקומות עבודה
                </div>
            </ul>

            <ul class="third-menu hider__one">
				<?php while ( $vacancy_term_long->have_posts() ) {
					$vacancy_term_long->the_post();
					$vacancy_id             = get_the_ID();
					$carr_user_id           = get_the_author_meta( 'ID' );
					$vacancy_company_logo   = get_user_meta( $carr_user_id, 'company_logo', true );
					$vacancy_city_north     = wp_get_post_terms( $vacancy_id, 'north', array( 'fields' => 'names' ) );
					$vacancy_city_sharon    = wp_get_post_terms( $vacancy_id, 'sharon', array( 'fields' => 'names' ) );
					$vacancy_city_center    = wp_get_post_terms( $vacancy_id, 'center', array( 'fields' => 'names' ) );
					$vacancy_city_jerusalem = wp_get_post_terms( $vacancy_id, 'jerusalem', array( 'fields' => 'names' ) );
					$vacancy_city_south     = wp_get_post_terms( $vacancy_id, 'south', array( 'fields' => 'names' ) );
					$vacancy_city_lowland   = wp_get_post_terms( $vacancy_id, 'lowland', array( 'fields' => 'names' ) );
					$vacancy_cities_all     = array();

					if ( ! is_wp_error( $vacancy_city_north ) && ! empty( $vacancy_city_north ) ) {
						for ( $i = 0; $i < count( $vacancy_city_north ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_north[ $i ] );
						}
					}
					if ( ! is_wp_error( $vacancy_city_sharon ) && ! empty( $vacancy_city_sharon ) ) {
						for ( $i = 0; $i < count( $vacancy_city_sharon ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_sharon[ $i ] );
						}
					}
					if ( ! is_wp_error( $vacancy_city_center ) && ! empty( $vacancy_city_center ) ) {
						for ( $i = 0; $i < count( $vacancy_city_center ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_center[ $i ] );
						}
					}

					if ( ! is_wp_error( $vacancy_city_jerusalem ) && ! empty( $vacancy_city_jerusalem ) ) {
						for ( $i = 0; $i < count( $vacancy_city_jerusalem ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_jerusalem[ $i ] );
						}
					}
					if ( ! is_wp_error( $vacancy_city_south ) && ! empty( $vacancy_city_south ) ) {
						for ( $i = 0; $i < count( $vacancy_city_south ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_south[ $i ] );
						}
					}
					if ( ! is_wp_error( $vacancy_city_lowland ) && ! empty( $vacancy_city_lowland ) ) {
						for ( $i = 0; $i < count( $vacancy_city_lowland ); $i ++ ) {
							array_push( $vacancy_cities_all, $vacancy_city_lowland[ $i ] );
						}
					}

					$vacancy_cities_str         = join( $vacancy_cities_all, ', ' );
					$vacancy_type_of_office     = wp_get_post_terms( $vacancy_id, 'field_of_office', array( 'fields' => 'names' ) );
					$vacancy_type_of_office_str = join( ', ', $vacancy_type_of_office );
					$vacancy_scope_of_job       = wp_get_post_terms( $vacancy_id, 'scope_of_job', array( 'fields' => 'names' ) );
					$vacancy_scope_of_job_str   = join( ', ', $vacancy_scope_of_job );
					$vacancy_salary             = get_post_meta( $vacancy_id, 'salary-field', true );
					?>

                    <li class="third-list ">

                        <div class="third-list-choice bg-hex">
                            <div class="third-list-item">
								<?php echo get_the_title(); ?>
                            </div>
                            <div class="third-list-item ">
								<?php echo $vacancy_cities_str; ?>
                            </div>
                            <div class="third-list-item ">
								<?php echo $vacancy_type_of_office[0]; ?>
                            </div>

                            <div class="drop-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chevron-circle-left-solid.svg"
                                     alt="open" class="drop-icon-open">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/times-circle-solid.svg"
                                     alt="close" class="drop-icon-close">
                            </div>
                        </div>

                        <ul class="third-drop">
                            <li class="third-drop-list">
                                <div class="third-drop-right">
                                    <p class="third-drop-title"><?php echo get_the_title(); ?><br>
                                        <span class="third-drop-subspan">
                                        <span class="third-drop-bold">תחום:</span>
                                        <?php echo $vacancy_type_of_office_str; ?>
                                    </span>
                                    </p>

                                    <div class="text">
                                        <span class="third-drop-bold">תיאור המשרה:</span><br class="br-have">
										<?php the_content(); ?>
                                    </div>
                                    <p class=" text">
										<?php if ( is_array( $vacancy_salary ) ) { ?>
                                            <span class="third-drop-bold">שכר:</span><?php echo $vacancy_salary[1] . ' - ' . $vacancy_salary[0]; ?> ₪
										<?php } else { ?>
                                            <span class="third-drop-bold">שכר:</span>₪<?php echo $vacancy_salary; ?>
										<?php } ?>
                                    </p>
                                    <div class=" text">
                                        <span class="third-drop-bold">מיקום המשרה:</span>
										<?php echo $vacancy_cities_str; ?>
                                    </div>
                                    <div class=" text">
                                        <span class="third-drop-bold">היקף המשרה:</span>
										<?php echo $vacancy_scope_of_job_str; ?>
                                    </div>
                                </div>
                                <div class="third-drop-left">
                                    <div class="third-drop-logo">
                                        <img src="<?php echo $vacancy_company_logo; ?>"
                                             alt="<?php echo get_the_title(); ?>">
                                    </div>
                                    <button data-attach_vacancy="<?php echo $vacancy_id; ?>"
                                            class="btn third-drop-btn attach-cv">שלח קורות חיים
                                    </button>
                                </div>
                            </li>
                        </ul>

                    </li>
					<?php
				}
				?>
            </ul>

			<?php
		}
		wp_reset_postdata();
		?>

		<?php
	}

	/**
	 * Return results for a big filter
	 *
	 * @since 1.0.0
	 */
	public function big_filter_function() {

		$arr = [];
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

			if ( $_POST['fix_price'] != '' ) {
				$args['meta_query'][1][] =
					array(
						'key'   => 'salary-field',
						'value' => $_POST['fix_price'],
						'type'  => 'NUMERIC'
					);
			}

			if ( $_POST['vacancy_term'] == 1 ) {

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

}

function avoda_core_filter_runner() {

	return new Avoda_Core_Filter();
}

avoda_core_filter_runner();