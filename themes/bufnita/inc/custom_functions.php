<?php 
function getTeachersList() {
	$teacher_posts_args = array(
		'post_type' => 'teacher',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
	);
	$teacher_posts_qry = new WP_Query($teacher_posts_args);
	// The Loop
	$teachers = array();
	if ( $teacher_posts_qry->have_posts() ) {
		while ( $teacher_posts_qry->have_posts() ) {
			$teacher_posts_qry->the_post();
			$teachers[get_the_ID()] = get_the_title();
		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	return $teachers;
}

			
function getTeachersListForCourses() {
	$teacher_posts_args = array(
		'post_type' => 'teacher',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
	);
	$teacher_posts_qry = new WP_Query($teacher_posts_args);
	// The Loop
	$teachers = array();
	if ( $teacher_posts_qry->have_posts() ) {
		while ( $teacher_posts_qry->have_posts() ) {
			$teacher_posts_qry->the_post();
			$teachers[get_the_ID()] = array(
				'slug' => sanitize_title( get_the_title() ),
				'title' => get_the_title(),
			);
		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	return $teachers;
}


function getPresentationTeachersArticle() {
	$article_pres_posts_args = array(
		'post_type' => 'post',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'category_name' => 'teachers'
	);
	$article_pres_posts_qry = new WP_Query($article_pres_posts_args);
	// The Loop
	$articles = array();
	if ( $article_pres_posts_qry->have_posts() ) {
		while ( $article_pres_posts_qry->have_posts() ) {
			$article_pres_posts_qry->the_post();
			$articles[get_the_ID()] = get_the_title();
		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	return $articles;
}


function getTeachersAssignedToCourse( $ids ) {
	$teacher_posts_args = array(
		'post_type' => 'teacher',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'post__in' => $ids
	);
	$teacher_posts_qry = new WP_Query($teacher_posts_args);
	// The Loop
	$teachers = array();
	if ( $teacher_posts_qry->have_posts() ) {
		while ( $teacher_posts_qry->have_posts() ) {
			$teacher_posts_qry->the_post();
			$meta_data = get_post_meta( get_the_ID() );
			$buf_teacher_art_id = isset($meta_data['buf_teacher_art_id'][0]) ? $meta_data['buf_teacher_art_id'][0] : '';
			$teacher_art_url = $buf_teacher_art_id ? get_permalink($buf_teacher_art_id) : '';
			$teacher_function = isset($meta_data['buf_teacher_function'][0]) ? $meta_data['buf_teacher_function'][0] : '';
			$resized_image_url = has_post_thumbnail() ? 
				aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 175, 175) :
				get_template_directory_uri() . '/assets/images/profDefault.jpg';
			$teachers[get_the_ID()] = array(
				'name' => get_the_title(),
				'art_url' => $teacher_art_url,
				'image_url' => $resized_image_url,
				'function' => $teacher_function,
				'description' => get_the_content(),
			);
		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	return $teachers;
}


function getCategoriesDataForCourse( $custom_post_fields ) {
	$data = array();
	//mic 
	if ((isset($custom_post_fields['buf_mic_price_full'][0]) && $custom_post_fields['buf_mic_price_full'][0] != '' ) || 
			isset($custom_post_fields['buf_mic_price_discount'][0]) && $custom_post_fields['buf_mic_price_discount'][0] != '') {
		$data['svg_class'][]= 'a';
		$data['mic_category_details'] = array(
			'price_full' => ( isset($custom_post_fields['buf_mic_price_full'][0]) ? $custom_post_fields['buf_mic_price_full'][0] : null),
			'price_discount' => ( isset($custom_post_fields['buf_mic_price_discount'][0]) ? $custom_post_fields['buf_mic_price_discount'][0] : null),
		);
		$data['mic_category_details']['visible'] = (isset($custom_post_fields['buf_mic_price_visibility'][0]) && $custom_post_fields['buf_mic_price_visibility'][0] != '' ) ? true : false;
		$data['mic_category_details']['cut_discount'] = ($data['mic_category_details']['price_full'] && $data['mic_category_details']['price_discount']) ? true : false;
		if ( isset($custom_post_fields['buf_mic_long_period_desc'][0]) )
			$data['mic_category_details']['duration'] = $custom_post_fields['buf_mic_long_period_desc'][0];
	}
	//mijlociu
	if ( ((isset($custom_post_fields['buf_mijlociu_price_full'][0]) && $custom_post_fields['buf_mijlociu_price_full'][0] != '' ) || 
			isset($custom_post_fields['buf_mijlociu_price_discount'][0]) && $custom_post_fields['buf_mijlociu_price_discount'][0] != '')) {
		$data['svg_class'][] = 'b';
		$data['mijlociu_category_details'] = array(
			'price_full' => ( isset($custom_post_fields['buf_mijlociu_price_full'][0]) ? $custom_post_fields['buf_mijlociu_price_full'][0] : null),
			'price_discount' => ( isset($custom_post_fields['buf_mijlociu_price_discount'][0]) ? $custom_post_fields['buf_mijlociu_price_discount'][0] : null),
		);
		$data['mijlociu_category_details']['visible'] = (isset($custom_post_fields['buf_mijlociu_price_visibility'][0]) && $custom_post_fields['buf_mijlociu_price_visibility'][0] != '' ) ? true : false;
		$data['mijlociu_category_details']['cut_discount'] = ($data['mijlociu_category_details']['price_full'] && $data['mijlociu_category_details']['price_discount']) ? true : false;
		if ( isset($custom_post_fields['buf_mijlociu_long_period_desc'][0]) )
			$data['mijlociu_category_details']['duration'] = $custom_post_fields['buf_mijlociu_long_period_desc'][0];
	}
	//mare
	if ( (isset($custom_post_fields['buf_mare_price_full'][0]) && $custom_post_fields['buf_mare_price_full'][0] != '' ) || 
			isset($custom_post_fields['buf_mare_price_discount'][0]) && $custom_post_fields['buf_mare_price_discount'][0] != '') {
		$data['svg_class'][] = 'c';
		$data['mare_category_details'] = array(
			'price_full' => ( isset($custom_post_fields['buf_mare_price_full'][0]) ? $custom_post_fields['buf_mare_price_full'][0] : null),
			'price_discount' => ( isset($custom_post_fields['buf_mare_price_discount'][0]) ? $custom_post_fields['buf_mare_price_discount'][0] : null),
		);
		$data['mare_category_details']['visible'] = (isset($custom_post_fields['buf_mare_price_visibility'][0]) && $custom_post_fields['buf_mare_price_visibility'][0] != '' ) ? true : false;
		$data['mare_category_details']['cut_discount'] = ($data['mare_category_details']['price_full'] && $data['mare_category_details']['price_discount']) ? true : false;
		if ( isset($custom_post_fields['buf_mare_long_period_desc'][0]) )
			$data['mare_category_details']['duration'] = $custom_post_fields['buf_mare_long_period_desc'][0];
	}
	//echo '<pre>';print_R($data);die;
	return $data;
}


function get_the_cpt_slug() {
	global $post;
	return ( is_single() || is_page() ) ? $post->post_name : '';
}



function prepare_courses_for_listing() {
	$courses_for_listing_args = array(
		'post_type' => 'course',
		'posts_per_page' => -1,
		'post_status' => 'publish',
	);
	$courses_for_listing_qry = new WP_Query($courses_for_listing_args);
	// The Loop
	$courses = array();
	$groups_filter = array(
		'group_a' => 0,
		'group_b' => 0,
		'group_c' => 0,
		'total' => 0,
	);
	$categories_filter = array();
	if ( $courses_for_listing_qry->have_posts() ) {
		while ( $courses_for_listing_qry->have_posts() ) {
			
			$courses_for_listing_qry->the_post();
			$current_course = array(
				'title' => get_the_title(),
				'duration' => null,
				'image_url' => (has_post_thumbnail() ? aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 500, 250) : null),
				'course_url' => get_the_permalink(),
			);
			
			$terms = get_the_terms(get_the_ID(), 'course_category');
			if ( isset($terms[0]) ) {
				$current_course['category_name'] = $terms[0]->name;
				$current_course['category_slug'] = $terms[0]->slug;
				if ( isset($categories_filter[$current_course['category_slug']]) ) {
					$categories_filter[$current_course['category_slug']]['count']++;
				} else {
					$categories_filter[$current_course['category_slug']]['count'] = 1;
				}
				$categories_filter[$current_course['category_slug']]['name'] = $current_course['category_name'];
			}
			
			$custom_post_fields = get_post_custom( get_the_ID() );
			$flag_group_counted = false;
			//mic 
			if ( (isset($custom_post_fields['buf_mic_price_full'][0]) && $custom_post_fields['buf_mic_price_full'][0] != '' ) || 
					isset($custom_post_fields['buf_mic_price_discount'][0]) && $custom_post_fields['buf_mic_price_discount'][0] != '') {
				$current_course['svg_class'][] = 'a';
				$current_course['mic_category_details'] = array(
					'price_full' => ( isset($custom_post_fields['buf_mic_price_full'][0]) ? $custom_post_fields['buf_mic_price_full'][0] : null),
					'price_discount' => ( isset($custom_post_fields['buf_mic_price_discount'][0]) ? $custom_post_fields['buf_mic_price_discount'][0] : null),
				);
				if ( ! $current_course['duration'] && isset($custom_post_fields['buf_mic_short_period_desc'][0]) )
					$current_course['duration'] = $custom_post_fields['buf_mic_short_period_desc'][0];
				$groups_filter['group_a']++;
				$flag_group_counted = true;
			}
			//mijlociu
			if ( (isset($custom_post_fields['buf_mijlociu_price_full'][0]) && $custom_post_fields['buf_mijlociu_price_full'][0] != '' ) || 
					isset($custom_post_fields['buf_mijlociu_price_discount'][0]) && $custom_post_fields['buf_mijlociu_price_discount'][0] != '') {
				$current_course['svg_class'][] = 'b';
				$current_course['mijlociu_category_details'] = array(
					'price_full' => ( isset($custom_post_fields['buf_mijlociu_price_full'][0]) ? $custom_post_fields['buf_mijlociu_price_full'][0] : null),
					'price_discount' => ( isset($custom_post_fields['buf_mijlociu_price_discount'][0]) ? $custom_post_fields['buf_mijlociu_price_discount'][0] : null),
				);
				if ( ! $current_course['duration'] && isset($custom_post_fields['buf_mijlociu_short_period_desc'][0]) )
					$current_course['duration'] = $custom_post_fields['buf_mijlociu_short_period_desc'][0];
				$groups_filter['group_b']++;
				$flag_group_counted = true;
			}
			//mare
			if ( (isset($custom_post_fields['buf_mare_price_full'][0]) && $custom_post_fields['buf_mare_price_full'][0] != '' ) || 
					isset($custom_post_fields['buf_mare_price_discount'][0]) && $custom_post_fields['buf_mare_price_discount'][0] != '') {
				$current_course['svg_class'][] = 'c';
				$current_course['mare_category_details'] = array(
					'price_full' => ( isset($custom_post_fields['buf_mare_price_full'][0]) ? $custom_post_fields['buf_mare_price_full'][0] : null),
					'price_discount' => ( isset($custom_post_fields['buf_mare_price_discount'][0]) ? $custom_post_fields['buf_mare_price_discount'][0] : null),
				);
				if ( ! $current_course['duration'] && isset($custom_post_fields['buf_mare_short_period_desc'][0]) )
					$current_course['duration'] = $custom_post_fields['buf_mare_short_period_desc'][0];
				$groups_filter['group_c']++;
				$flag_group_counted = true;
			}
			if( $flag_group_counted )
				$groups_filter['total']++;
			
			$courses[] = $current_course;
		}
	}
	$categories_filter = array_merge(
		array('toate' => 
			array('count' => count($categories_filter), 'name' => 'Toate')), 
		$categories_filter
	);
	$groups = array();
	$groups_filter = array(
		'toate-grupele' => array('count' => $groups_filter['total'], 'name' => 'Toate grupele'), 
		'group_a' => array('count' => $groups_filter['group_a'], 'name' => 'Mici'),
		'group_b' => array('count' => $groups_filter['group_b'], 'name' => 'Mijlocii'),
		'group_c' => array('count' => $groups_filter['group_c'], 'name' => 'Mari'),
	);
	$data = array(
		'courses' => $courses,
		'groups' => $groups_filter,
		'categories_filter' => $categories_filter,
	);
	//echo '<pre>';print_R($data);die;
	wp_reset_postdata();
	return $data;
}

function build_group_slug_from_arr($elem) {
	return 'group_'.$elem;
}



function getDataForSidebarCourse( $custom_post_fields ) {
	//echo '<pre>';print_R($custom_post_fields);die;
	$fields = array(
		'buf_mic_categ_available',
		'buf_mijlociu_categ_available',
		'buf_mare_categ_available'
	);
	$data = array('available_categories' => array());
	if( isset($custom_post_fields['buf_mic_categ_available'][0]) && $custom_post_fields['buf_mic_categ_available'][0] ){
		$data['available_categories'][] = 'mic';
	}
	if( isset($custom_post_fields['buf_mijlociu_categ_available'][0]) && $custom_post_fields['buf_mijlociu_categ_available'][0] ){
		$data['available_categories'][] = 'mijlociu';
	}
	if( isset($custom_post_fields['buf_mare_categ_available'][0]) && $custom_post_fields['buf_mare_categ_available'][0] ){
		$data['available_categories'][] = 'mare';
	}
	
	
	foreach ($data['available_categories'] as $categ) {
		$data['price_full'][$categ] = ( isset($custom_post_fields["buf_{$categ}_price_full"][0]) && $custom_post_fields["buf_{$categ}_price_full"][0] ) ? $custom_post_fields["buf_{$categ}_price_full"][0] : 0;
		$data['price_discount'][$categ] = ( isset($custom_post_fields["buf_{$categ}_price_discount"][0]) && $custom_post_fields["buf_{$categ}_price_discount"][0] ) ? $custom_post_fields["buf_{$categ}_price_discount"][0] : 0;
		
		//post procesare
		//daca discount > full & full = 0 full = discount & discount 0;
		if ($data['price_discount'][$categ] > $data['price_full'][$categ] && $data['price_full'][$categ] == 0) {
			$data['price_full'][$categ] = $data['price_discount'][$categ];
			$data['price_discount'][$categ] = 0;
		}
		
		//a gresit editorul -> switch intre ele;
		if ($data['price_discount'][$categ] > $data['price_full'][$categ]) {
			$temp = $data['price_full'][$categ];
			$data['price_full'][$categ] = $data['price_discount'][$categ];
			$data['price_discount'][$categ] = $temp;
		}
		
		
		//post procesare
		//daca full & ! discount -> discount e full;
		if ($data['price_full'][$categ] && ! $data['price_discount'][$categ] ) {
			$data['price_discount'][$categ] = $data['price_full'][$categ];
			$data['price_full'][$categ] = 0;
		}
		
		// daca NU doreste afisarea preturilor -> 0 ambele
		if (! isset($custom_post_fields["buf_{$categ}_price_visibility"]) ){
			$data['price_discount'][$categ] = $data['price_full'][$categ] = 0;
		}
		//add duration to data array;
		$data["{$categ}_category_details"]['duration'] = ( isset($custom_post_fields["buf_{$categ}_long_period_desc"][0]) && $custom_post_fields["buf_{$categ}_long_period_desc"][0])
			? $custom_post_fields["buf_{$categ}_long_period_desc"][0]
			: '';
	}
	
	//afisarea liniilor full/discount & render table cell -> prepare for front-end;
	$sum_discount = $sum_full = 0;
	foreach ($data['available_categories'] as $categ) {
		$sum_discount += $data['price_discount'][$categ];
		$sum_full += $data['price_full'][$categ];
		$data['price_full'][$categ] = buf_render_sidebar_cell_group($data['price_full'][$categ], true);
		$data['price_discount'][$categ] = buf_render_sidebar_cell_group($data['price_discount'][$categ], false);
	}
	$data['show_discount_row'] = $sum_discount ? true : false;
	$data['show_full_row'] = $sum_full ? true : false;
	$data['show_full_row_sum'] = $sum_full;
	$data['show_discount_row_sum'] = $sum_discount;
	return $data;
}

function buf_render_sidebar_cell_group($value, $is_full_price = false) {
	if ($is_full_price) {
		return $value ? "<p class=\"oldPrice\"><del>$value<span class=\"curency\"> RON</span></del></p>" : 
			"<p class=\"oldPrice\"> - </p>";
	} else {
		return "<p class=\"price\"> " . ($value ? "$value RON": '<small> - </small>') . " </p>";
	}
}