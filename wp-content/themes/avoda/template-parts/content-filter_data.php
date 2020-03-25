 
  <?php
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
	$vacancy_scope_of_job = wp_get_post_terms($vacancy_id, 'scope_of_job', array('fields'=> 'names'));
	$vacancy_scope_of_job_str = join(', ', $vacancy_scope_of_job);
	$vacancy_salary = get_post_meta($vacancy_id, 'salary-field', true);
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