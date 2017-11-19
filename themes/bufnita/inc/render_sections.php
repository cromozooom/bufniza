<?php



function render_HP_slider() {



	$hp_slides_posts_args = array(



		'post_type' => 'slider',



		'posts_per_page' => '5',



		'post_status' => 'publish',



	);



	$hp_slides_posts_qry = new WP_Query($hp_slides_posts_args);



	// The Loop



	if ( $hp_slides_posts_qry->have_posts() ) {



		$first_slide_activated = false;



		while ( $hp_slides_posts_qry->have_posts() ) {



			$hp_slides_posts_qry->the_post();



			$meta_data = get_post_meta( get_the_ID() );



			$label_btn = isset($meta_data['buf_slider_btn_label'][0]) ? $meta_data['buf_slider_btn_label'][0] : 'Citeste mai mult';



			$link_btn = isset($meta_data['buf_slider_link'][0]) ? $meta_data['buf_slider_link'][0] : '';



			$active_slide = $first_slide_activated ? '' : ' active';



			$slide_class = sanitize_title(get_the_title());



			if (! $first_slide_activated)



				$first_slide_activated = true;



			?>







			<div class="item <?=$slide_class?><?=$active_slide?>" ><img src="<?=wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) )?>" alt="<?=esc_attr( get_the_title() )?>">



				<div class="carousel-caption">



					<p class="lead"><?=esc_attr( get_the_content() )?></p>



					<div class="btn btn-ghost-default btn-lg">



						<a href="<?=$link_btn?>"><?=$label_btn?></a>



					</div>



				</div>



			</div><?php



		}



	}



	/* Restore original Post Data */



	wp_reset_postdata();



}











function render_HP_article_after_slide() {



	$hp_article_after_slider_posts_args = array(



		'post_type' => 'post',



		'posts_per_page' => '1',



		'post_status' => 'publish',



		'category_name' => 'homepage'



	);



	$hp_article_after_slider_posts_qry = new WP_Query($hp_article_after_slider_posts_args);



	// The Loop



	if ( $hp_article_after_slider_posts_qry->have_posts() ) {?>



		<section class="descriere">



			<div class="container">



				<div class="row"><?php



				while ( $hp_article_after_slider_posts_qry->have_posts() ) {



					$hp_article_after_slider_posts_qry->the_post();?>



					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 no-gutter text-center">



						<img src="<?=wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) )?>" title="<?=the_title()?>" alt="<?php esc_attr( the_excerpt() )?>">



					</div>



					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 no-gutter">



					<h2><?=the_title()?></h2>



					<p><?=the_content()?><a href="<?=strip_tags(get_the_excerpt())?>" class="btn btn-md btn-ghost-type_one">Vezi mai multe</a></p>



					</div>



					<?php } ?>



				</div>



			</div>



		</section><?php



	}



	/* Restore original Post Data */



	wp_reset_postdata();



}







function render_HP_three_courses() {



	$hp_three_courses_posts_args = array(



		'post_type' => 'course',



		'posts_per_page' => '3',



		'post_status' => 'publish',



		'meta_query' => array(



			array(



				'key'	 	=> 'buf_show_on_hp_check',



				'value'	  	=> 'on',



				'compare' 	=> '=',



			),



		)



	);







	$hp_three_courses_posts_qry = new WP_Query($hp_three_courses_posts_args);



	// The Loop



	if ( $hp_three_courses_posts_qry->have_posts() ) {?>



		<section class="cursuri">



			<div class="container">



				<div class="row">



					<div class="col-xs-12 text-center">



						<h2>Cateva dintre activitatile mele:</h2>



					 </div><?php



				$first_course_slot = false;



				while ( $hp_three_courses_posts_qry->have_posts() ) {



					$hp_three_courses_posts_qry->the_post();



					$class_first = $first_course_slot ? '' : 'first';



					$meta_data = get_post_meta( get_the_ID() );



					$svg_icon_id = $meta_data['buf_show_on_hp_svg_id'][0];



					if (! $first_course_slot)



						$first_course_slot = true;?>



						 <div class="col-xs-12 col-md-4 text-center <?=$class_first?>">



							<svg style="display: none;">



							<?php require get_template_directory() . '/inc/svg/' . "svg_{$svg_icon_id}" .'.php';?>



							</svg>



							<svg viewBox="0 0 237 237" width="236" height="236">



							   <use xlink:href="#<?=$svg_icon_id?>" x="0" y="0"></use>



							</svg>



							<h3 class="text-center"><?=esc_attr( get_the_title() )?></h3>



							<p><?=esc_attr( get_the_excerpt() )?></p>



							<a href="<?=get_the_permalink()?>" title="<?=esc_attr( get_the_title() )?>" class="lead">Vezi detalii</a>



						 </div>



				<?php } ?>



					<div class="col-xs-12 text-center"><a class="btn btn-lg btn-ghost-type_two" href="/courses/">Vezi alte activitati</a></div>



				</div>



			</div>



		</section><?php



	}



	/* Restore original Post Data */



	wp_reset_postdata();



}







function render_HP_four_teachers() {



	$hp_four_teachers_posts_args = array(



		'post_type' => 'teacher',



		'posts_per_page' => '4',



		'post_status' => 'publish',



		'meta_query' => array(



			array(



				'key'	 	=> 'buf_teacher_show_on_hp',



				'value'	  	=> 'on',



				'compare' 	=> '=',



			),



		)



	);







	$hp_four_teachers_posts_qry = new WP_Query($hp_four_teachers_posts_args);



	// The Loop



	if ( $hp_four_teachers_posts_qry->have_posts() ) {?>



		<section class="team">



			<div class="container">



				<div class="row">



					<div class="col-xs-12 text-center">



						<h2>Echipa mea:</h2>



					</div><?php



				while ( $hp_four_teachers_posts_qry->have_posts() ) {



					$hp_four_teachers_posts_qry->the_post();



					$meta_data = get_post_meta( get_the_ID() );



					$buf_teacher_art_id = isset($meta_data['buf_teacher_art_id'][0]) ? $meta_data['buf_teacher_art_id'][0] : '';



					$teacher_art_url = $buf_teacher_art_id ? get_permalink($buf_teacher_art_id) : '';



					?><div class="col-xs-12 col-sm-6 col-md-3 first text-center"><?php



					if ( has_post_thumbnail() ) {



						$resized_image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );



						echo "<img src=\"$resized_image_url\" class=\"img-responsive img-circle\" />";



					} else {



						echo '<img src="' . get_template_directory_uri() . '/assets/images/profDefault.jpg" class="img-responsive img-circle" />';



					}?>



						<h4><?php the_title()?></h4>



						<?php if ($teacher_art_url) : ?>



						<a href="<?=$teacher_art_url?>" title="<?=esc_attr( get_the_title() )?>" class="profLink">Vezi articol</a>



						<?php endif;?>



				</div>



				<?php } ?>



					<div class="col-xs-12 text-center"><a href="/teacher/" title="" class="btn btn-lg btn-ghost-type_two">Vezi profesori</a></div>



				</div>



			</div>



		</section><?php



	}



	/* Restore original Post Data */



	wp_reset_postdata();



}











function render_HP_last_two_news() {



	$hp_three_courses_posts_args = array(



		'post_type' => 'post',



		'posts_per_page' => '2',



		'post_status' => 'publish',



		'category_name' => 'blog'



	);







	$hp_three_courses_posts_qry = new WP_Query($hp_three_courses_posts_args);



	// The Loop



	if ( $hp_three_courses_posts_qry->have_posts() ) {?>



		<section class="cursuriAction">



			<div class="container">



				<div class="row">



					<div class="col-xs-12">



						<h2 class="text-center">"Cum profita" altii de mine :)</h2>



					</div>



				</div>



				<div class="row"><?php



				while ( $hp_three_courses_posts_qry->have_posts() ) {



					$hp_three_courses_posts_qry->the_post();



					$resized_image_url = has_post_thumbnail() ? aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 570, 380) : null;?>



					<div class="col-sm-12 col-md-6">



						<div class="thumbnail first">



							<?php if ($resized_image_url) : ?>



							<img src="<?=$resized_image_url?>" />



							<?php endif; ?>



							<div class="caption">



								<h3><?=the_title()?></h3>



								<p><?=the_excerpt()?></p>



								<p><a href="<?=the_permalink()?>" role="button" class="btn btn-md btn-ghost-type_one">Vezi descrierea completa</a></p>



							</div>



						</div>



					</div>



				<?php } ?>



					<div class="col-xs-12 text-center"><a href="/stiri/" title="" class="btn btn-lg btn-ghost-type_two">Vezi alte stiri</a></div>



				</div>



			</div>



		</section><?php



	}



	/* Restore original Post Data */



	wp_reset_postdata();



}





function render_hp_newsletter() {?>

	<section class="newsletter">

      <div class="container-fluid">

        <div class="container owlBg">

          <div class="row">

            <form>

              <div class="col-sm-12 col-lg-8 col-lg-offset-2 text-center">

                <h3>Newsletter</h3>

              </div>

              <div class="col-sm-12 col-lg-8 col-lg-offset-2 text-center">

                <div role="alert" class="alert alert-danger buf_rum_ns_msg" style="display:none;">

					<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>

					<span class="sr-only">Error:</span>&nbsp;&nbsp;

					<span class="buf_rum_ns_msg_txt">Aceasta nu este o adresa de mail.</span>

				</div>

              </div>

              <div class="form-group col-xs-12 col-sm-5 col-md-7 col-lg-4 col-lg-offset-2">

                <label for="email" class="sr-only">Email address</label>

                <input type="email" id="email" name="email" placeholder="Email" class="input-lg form-control">

              </div>

			  <input type="hidden" name="buf_rum_nonce" id="buf_rum_nonce" value="<?=wp_create_nonce("buf_rum_ns_today");?>" />

              <div class="col-xs-12 col-sm-7 col-md-5 col-lg-4">

                <button type="submit" class="pull-right btn-lg btn btn-default btn-primary subscribe-mc">Inscrie-ma la update-uri pe email</button>

              </div>

            </form><br>

          </div>

        </div>

      </div>

    </section><?php

}



function render_newsletter_popup() {?>

	<div id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="newsletterModalLabel" class="modal fade in" style="display:none; padding-right: 17px;">

      <div role="document" class="modal-dialog">

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>

            <h4 id="newsletterModalLabel" class="modal-title">Newsletter</h4>

          </div>

          <div class="modal-body">

            <form>

              <div role="alert" class="alert alert-danger buf_rum_ns_msg">

				<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>

				<span class="sr-only">Error:</span>&nbsp;&nbsp;

				<span class="buf_rum_ns_msg_txt">Aceasta nu este o adresa de mail.</span>

			  </div>

              <div class="form-group">

                <label for="email" class="sr-only">Email address</label>

                <input type="email" id="email_popup" name="email" placeholder="Email" class="input-lg form-control">

              </div>

			  <input type="hidden" name="buf_rum_nonce" id="buf_rum_nonce" value="<?=wp_create_nonce("buf_rum_ns_today");?>" />

              <div class="form-group">

                <button type="button" class="btn btn-primary pull-right subscribe-mc" id="subscribe-mc-popup">Inscrie-ma la update-uri pe email</button>

              </div>

              <div class="clearfix"></div>

            </form>

          </div>

          <!--.modal-footer-->

        </div>

      </div>

    </div><?php

}





function render_courses_svg_icon() {



	echo '<svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">



		<path class="children_small" d="M41.4,30.6c-0.3-1.4-1.7-2.3-3.1-1.9L2,37c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1l10.4-2.4v23.5c0,1.5,1.2,2.7,2.7,2.7s2.7-1.2,2.7-2.7v-13h2.8v13c0,1.5,1.2,2.7,2.7,2.7



			c1.5,0,2.7-1.2,2.7-2.7V36.6l12.4-2.8C40.8,33.4,41.7,32,41.4,30.6z"/>



		<ellipse  class="children_small" cx="19.2" cy="23" rx="5.9" ry="5.8"/>



		<path class="children_large" d="M121.8,12.2c-0.3-1.4-1.7-2.3-3.1-1.9L74.2,20.5c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1L86.1,23v40.1c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V41.9h3.5v21.2c0,1.5,1.2,2.7,2.7,2.7



			s2.7-1.2,2.7-2.7V19.8l19.6-4.5C121.2,15,122.1,13.6,121.8,12.2z"/>



		<circle class="children_large" cx="92.7" cy="6.1" r="5.9"/>



		<ellipse class="children_medium" cx="56" cy="14.6" rx="5.9" ry="5.8"/>



		<path class="children_medium" d="M77.3,22.4c-0.3-1.4-1.7-2.3-3.1-1.9l-35.9,8.2c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1l10.4-2.4v31.8c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V46h3.1v17.1c0,1.5,1.2,2.7,2.7,2.7



			c1.5,0,2.7-1.2,2.7-2.7V28.2l11.7-2.7C76.7,25.2,77.6,23.8,77.3,22.4z"/>



	</svg>';



}











function render_sidebar() {?>



	<div class="col-xs-12 col-md-4 col-lg-4 sidebar">



	<!-- ADD all courses-->



	<div class="addAllCourses text-center">



	  <h3>Activitatile noastre<br><small>de la cei mai mici la cei mai mari</small></h3>



	  <hr>



	  <table class="table">



		<thead>



		  <tr>



			<td> <a href="">



				<div class="a"><!--?xml version="1.0" encoding="utf-8"?-->



<svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">







<path class="children_small" d="M41.4,30.6c-0.3-1.4-1.7-2.3-3.1-1.9L2,37c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1l10.4-2.4v23.5c0,1.5,1.2,2.7,2.7,2.7s2.7-1.2,2.7-2.7v-13h2.8v13c0,1.5,1.2,2.7,2.7,2.7



c1.5,0,2.7-1.2,2.7-2.7V36.6l12.4-2.8C40.8,33.4,41.7,32,41.4,30.6z"></path>



<ellipse class="children_small" cx="19.2" cy="23" rx="5.9" ry="5.8"></ellipse>



<path class="children_large" d="M121.8,12.2c-0.3-1.4-1.7-2.3-3.1-1.9L74.2,20.5c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1L86.1,23v40.1c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V41.9h3.5v21.2c0,1.5,1.2,2.7,2.7,2.7



s2.7-1.2,2.7-2.7V19.8l19.6-4.5C121.2,15,122.1,13.6,121.8,12.2z"></path>



<circle class="children_large" cx="92.7" cy="6.1" r="5.9"></circle>



<ellipse class="children_medium" cx="56" cy="14.6" rx="5.9" ry="5.8"></ellipse>



<path class="children_medium" d="M77.3,22.4c-0.3-1.4-1.7-2.3-3.1-1.9l-35.9,8.2c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1l10.4-2.4v31.8c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V46h3.1v17.1c0,1.5,1.2,2.7,2.7,2.7



c1.5,0,2.7-1.2,2.7-2.7V28.2l11.7-2.7C76.7,25.2,77.6,23.8,77.3,22.4z"></path>







</svg>







				</div><small>3-7 ani</small></a></td>



			<td> <a href="">



				<div class="b"><!--?xml version="1.0" encoding="utf-8"?-->



<svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">







<path class="children_small" d="M41.4,30.6c-0.3-1.4-1.7-2.3-3.1-1.9L2,37c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1l10.4-2.4v23.5c0,1.5,1.2,2.7,2.7,2.7s2.7-1.2,2.7-2.7v-13h2.8v13c0,1.5,1.2,2.7,2.7,2.7



c1.5,0,2.7-1.2,2.7-2.7V36.6l12.4-2.8C40.8,33.4,41.7,32,41.4,30.6z"></path>



<ellipse class="children_small" cx="19.2" cy="23" rx="5.9" ry="5.8"></ellipse>



<path class="children_large" d="M121.8,12.2c-0.3-1.4-1.7-2.3-3.1-1.9L74.2,20.5c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1L86.1,23v40.1c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V41.9h3.5v21.2c0,1.5,1.2,2.7,2.7,2.7



s2.7-1.2,2.7-2.7V19.8l19.6-4.5C121.2,15,122.1,13.6,121.8,12.2z"></path>



<circle class="children_large" cx="92.7" cy="6.1" r="5.9"></circle>



<ellipse class="children_medium" cx="56" cy="14.6" rx="5.9" ry="5.8"></ellipse>



<path class="children_medium" d="M77.3,22.4c-0.3-1.4-1.7-2.3-3.1-1.9l-35.9,8.2c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1l10.4-2.4v31.8c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V46h3.1v17.1c0,1.5,1.2,2.7,2.7,2.7



c1.5,0,2.7-1.2,2.7-2.7V28.2l11.7-2.7C76.7,25.2,77.6,23.8,77.3,22.4z"></path>







</svg>







				</div><small>8-12 ani</small></a></td>



			<td><a href="">



				<div class="c"><!--?xml version="1.0" encoding="utf-8"?-->



<svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">







<path class="children_small" d="M41.4,30.6c-0.3-1.4-1.7-2.3-3.1-1.9L2,37c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1l10.4-2.4v23.5c0,1.5,1.2,2.7,2.7,2.7s2.7-1.2,2.7-2.7v-13h2.8v13c0,1.5,1.2,2.7,2.7,2.7



c1.5,0,2.7-1.2,2.7-2.7V36.6l12.4-2.8C40.8,33.4,41.7,32,41.4,30.6z"></path>



<ellipse class="children_small" cx="19.2" cy="23" rx="5.9" ry="5.8"></ellipse>



<path class="children_large" d="M121.8,12.2c-0.3-1.4-1.7-2.3-3.1-1.9L74.2,20.5c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1L86.1,23v40.1c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V41.9h3.5v21.2c0,1.5,1.2,2.7,2.7,2.7



s2.7-1.2,2.7-2.7V19.8l19.6-4.5C121.2,15,122.1,13.6,121.8,12.2z"></path>



<circle class="children_large" cx="92.7" cy="6.1" r="5.9"></circle>



<ellipse class="children_medium" cx="56" cy="14.6" rx="5.9" ry="5.8"></ellipse>



<path class="children_medium" d="M77.3,22.4c-0.3-1.4-1.7-2.3-3.1-1.9l-35.9,8.2c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



c0.2,0,0.4,0,0.6-0.1l10.4-2.4v31.8c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V46h3.1v17.1c0,1.5,1.2,2.7,2.7,2.7



c1.5,0,2.7-1.2,2.7-2.7V28.2l11.7-2.7C76.7,25.2,77.6,23.8,77.3,22.4z"></path>







</svg>







				</div><small>peste 12 ani</small></a></td>



		  </tr>



		</thead>



	  </table>



	  <div class="clearfix"></div>



	</div>



	<?php if ( teacher_registration_widget_can_be_displayed() ) :?>

	<div class="weneedyou text-center">

        <a href="<?=site_url()?>/contact/#profesor">

            <img src="<?=get_template_directory_uri()?>/assets/images/weNeedYou.jpg" alt="Esti profesor? Locul tau este aici!" class="img-responsive" />

        </a>

        <p class="lead">Ai un proiect interesant?</p>

        <a href="<?=site_url()?>/contact/#profesor" class="btn btn-lg btn-ghost-type_two">Contacteaza-ne rapid</a>

    </div>

	<?php endif;?>



	<hr><?php



		$sidebar_four_courses_posts_args = array(



		'post_type' => 'course',



		'posts_per_page' => '4',



		'post_status' => 'publish',



	);







	$sidebar_four_courses_posts_qry = new WP_Query($sidebar_four_courses_posts_args);



	// The Loop



	if ( $sidebar_four_courses_posts_qry->have_posts() ) {?>



			<!-- Ultimele Cursuri (prmotii)-->



			<div class="profesori text-center">



			  <h3>Ultimele activitati</h3>



			  <hr>



			  <div class="clearfix"></div><?php



				while ( $sidebar_four_courses_posts_qry->have_posts() ) {



					$sidebar_four_courses_posts_qry->the_post();?>



					<div class="col-xs-6">



						<div class="curs thumbnail">



							<a href="<?php the_permalink()?>">



								<img src="<?=(has_post_thumbnail() ? aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 500, 250) : '')?>" alt="<?=esc_attr( the_title() )?> " class="img-responsive">



							</a>



							<div class="caption">



								<a href="<?php the_permalink()?>">



									<h5><?php esc_attr( the_title() )?></h5>



								</a>



							</div>



						</div>



					</div>



				<?php } ?>



				<div class="clearfix"></div>



			</div><?php



	  }



		/* Restore original Post Data */



		wp_reset_postdata();?>







	<!-- Echipa noastra-->



	<?php



	$sidebar_four_teachers_posts_args = array(



		'post_type' => 'teacher',



		'posts_per_page' => '4',



		'post_status' => 'publish',



		'orderby' => 'rand',



	);







	$sidebar_four_teachers_posts_qry = new WP_Query($sidebar_four_teachers_posts_args);



	// The Loop



	if ( $sidebar_four_teachers_posts_qry->have_posts() ) {?>



		<div class="profesori text-center">



			<h3>Din echipa noastra</h3>



			<hr>



			<div class="clearfix"></div><?php



			while ( $sidebar_four_teachers_posts_qry->have_posts() ) {



				$sidebar_four_teachers_posts_qry->the_post();



				$meta_data = get_post_meta( get_the_ID() );



				$teacher_function = isset($meta_data['buf_teacher_function'][0]) ? $meta_data['buf_teacher_function'][0] : '';



				$buf_teacher_art_id = isset($meta_data['buf_teacher_art_id'][0]) ? $meta_data['buf_teacher_art_id'][0] : '';



				$teacher_art_url = $buf_teacher_art_id ? get_permalink($buf_teacher_art_id) : 'javascript:void(0)';



				$resized_image_url = has_post_thumbnail() ?



					aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 75, 75) :



					(get_template_directory_uri() . '/assets/images/profDefault.jpg');?>



				<div class="col-xs-6 col-sm-4 col-lg-6">



					<a href="#profesor" class="text-center">



						<img src="<?=$resized_image_url?>" style="max-width: 50%; margin:0 auto;" class="img-responsive img-circle">



					</a>



					<h5>



						<small><?=$teacher_function?></small><br>



						<a href="<?=$teacher_art_url?>"><?=esc_attr( get_the_title() )?></a>



					</h5>



				</div>



			<?php } ?>



			<div class="clearfix"></div>



		</div><?php 			}



	/* Restore original Post Data */



	wp_reset_postdata();?>



	<div class="clearfix"></div>



  </div>



<?php



}







function render_news_slot_listing( $search_arr = array() ) {



	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;



	$news_list_posts_args = !empty($search_arr) ? $search_arr : array(



		'post_type' => 'post',



		'posts_per_page' => '8',



		'post_status' => 'publish',



		'category_name' => 'blog',



		'paged' => $paged,



	);



	$news_list_posts_qry = new WP_Query($news_list_posts_args);



	// The Loop



	if ( $news_list_posts_qry->have_posts() ) {?>



		<ul class="posts"><?php



				while ( $news_list_posts_qry->have_posts() ) {



					$news_list_posts_qry->the_post();



					?>



					<li>



						<div class="col-xs-12">



							<small><?php the_date( 'd.m.Y' )?></small>



							<!-- title news-->



							<a href="<?php the_permalink()?>">



								<h4><?php esc_attr( the_title())?></h4>



							</a>



						</div>



						<?php if ( has_post_thumbnail() ) :?>



						<div class="col-xs-12 col-sm-6"><img src="<?=aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 500, 250);?>" alt="<?php the_title()?>" class="img-responsive"></div>



						<div class="col-xs-12 col-sm-6">



							<p class="small"><?= get_the_excerpt()?></p>



							<a href="<?php the_permalink()?>" class="btn btn-sm btn-ghost-type_two pull-right">citeste mai mult</a>



						</div>



						<?php else : ?>



						<div class="col-xs-12 col-sm-12">



							<p class="small"><?= get_the_excerpt()?></p>



							<a href="<?php the_permalink()?>" class="btn btn-sm btn-ghost-type_two pull-right">citeste mai mult</a>



						</div>



						<?php endif;?>



						<div class="clearfix"></div>



						<hr>



					</li>



					<?php } ?>



		</ul>



		<?php



		bufnita_numeric_posts_nav($news_list_posts_qry);



	}



	/* Restore original Post Data */



	wp_reset_postdata();



}











function bufnita_numeric_posts_nav($new_query) {



	global $wp_query;



	$old_query = $wp_query;



	$wp_query = $new_query ? $new_query : $wp_query;



	/** Stop execution if there's only 1 page */



	if( $wp_query->max_num_pages <= 1 )



		return;







	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;



	$max   = intval( $wp_query->max_num_pages );







	/**	Add current page to the array */



	if ( $paged >= 1 )



		$links[] = $paged;







	/**	Add the pages around the current page to the array */



	if ( $paged >= 3 ) {



		$links[] = $paged - 1;



		$links[] = $paged - 2;



	}







	if ( ( $paged + 2 ) <= $max ) {



		$links[] = $paged + 2;



		$links[] = $paged + 1;



	}







	echo '<ul class="pagination">' . "\n";







	/**	Previous Post Link */



	if ( get_previous_posts_link() )



		printf( '<li>%s</li>' . "\n", str_replace('Previous Page', '', get_previous_posts_link() ));







	/**	Link to first page, plus ellipses if necessary */



	if ( ! in_array( 1, $links ) ) {



		$class = 1 == $paged ? ' class="active"' : '';







		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );







		if ( ! in_array( 2, $links ) )



			echo '<li>…</li>';



	}







	/**	Link to current page, plus 2 pages in either direction if necessary */



	sort( $links );



	foreach ( (array) $links as $link ) {



		$class = $paged == $link ? ' class="active"' : '';



		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );



	}







	/**	Link to last page, plus ellipses if necessary */



	if ( ! in_array( $max, $links ) ) {



		if ( ! in_array( $max - 1, $links ) )



			echo '<li>…</li>' . "\n";







		$class = $paged == $max ? ' class="active"' : '';



		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );



	}







	/**	Next Post Link */



	if ( get_next_posts_link() )



		printf( '<li>%s</li>' . "\n", str_replace('Next Page', '', get_next_posts_link() ));







	echo '</ul>' . "\n";



	$wp_query = $old_query;



}







function render_footer_form ( $group, $data, $show = false) {?>







	<div class="col-xs-12 col-sm-6 text-center week_<?=$group?>" <?=$show ? 'style="display:block;"' : 'style="display:none;"'?>>



		<h4>Ce zile preferati</h4>



		<p class="small">alegeti din optiunile disponibile</p>



		<label <?=!$data["buf_{$group}_luni_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_luni_check" id="buf_<?=$group?>_luni_check" type="checkbox" <?php checked( $data["buf_{$group}_luni_check"], 'on' )?> <?=!$data["buf_{$group}_luni_check"] ? 'disabled="disabled"' : ''?>>L



		</label>



		<label <?=!$data["buf_{$group}_marti_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_marti_check" id="buf_<?=$group?>_marti_check" type="checkbox" <?php checked( $data["buf_{$group}_marti_check"], 'on' )?> <?=!$data["buf_{$group}_marti_check"] ? 'disabled="disabled"' : ''?>>M



		</label>



		<label <?=!$data["buf_{$group}_miercuri_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_miercuri_check" id="buf_<?=$group?>_miercuri_check" type="checkbox" <?php checked( $data["buf_{$group}_miercuri_check"], 'on' )?> <?=!$data["buf_{$group}_miercuri_check"] ? 'disabled="disabled"' : ''?>>M



		</label>



		<label <?=!$data["buf_{$group}_joi_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_joi_check" id="buf_<?=$group?>_joi_check" type="checkbox" <?php checked( $data["buf_{$group}_joi_check"], 'on' )?> <?=!$data["buf_{$group}_joi_check"] ? 'disabled="disabled"' : ''?>>J



		</label>



		<label <?=!$data["buf_{$group}_vineri_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_vineri_check" id="buf_<?=$group?>_vineri_check" type="checkbox" <?php checked( $data["buf_{$group}_vineri_check"], 'on' )?> <?=!$data["buf_{$group}_vineri_check"] ? 'disabled="disabled"' : ''?>>V



		</label>



		<label <?=!$data["buf_{$group}_sambata_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_sambata_check" id="buf_<?=$group?>_sambata_check" type="checkbox" <?php checked( $data["buf_{$group}_sambata_check"], 'on' )?> <?=!$data["buf_{$group}_sambata_check"] ? 'disabled="disabled"' : ''?>>S



		</label>



		<label <?=!$data["buf_{$group}_duminica_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_duminica_check" id="buf_<?=$group?>_duminica_check" type="checkbox" <?php checked( $data["buf_{$group}_duminica_check"], 'on' )?> <?=!$data["buf_{$group}_duminica_check"] ? 'disabled="disabled"' : ''?>>D



		</label>



	</div>



	<div class="col-xs-12 col-sm-6 text-center schedule_<?=$group?>" <?=$show ? 'style="display:block;"' : 'style="display:none;"'?>>



		<h4>Care e orarul preferat</h4>



		<p class="small">alegeti din optiunile disponibile</p>



		<label <?=!$data["buf_{$group}_first_interval_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_first_interval_check" id="buf_<?=$group?>_first_interval_check" type="checkbox" <?php checked( $data["buf_{$group}_first_interval_check"], 'on' )?> <?=!$data["buf_{$group}_first_interval_check"] ? 'disabled="disabled"' : ''?>>7.00 - 10.00



		</label>



		<label <?=!$data["buf_{$group}_second_interval_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_second_interval_check" id="buf_<?=$group?>_second_interval_check" type="checkbox" <?php checked( $data["buf_{$group}_second_interval_check"], 'on' )?> <?=!$data["buf_{$group}_second_interval_check"] ? 'disabled="disabled"' : ''?>>10.00 - 13.00



		</label>



		<label <?=!$data["buf_{$group}_third_interval_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_third_interval_check" id="buf_<?=$group?>_third_interval_check" type="checkbox" <?php checked( $data["buf_{$group}_third_interval_check"], 'on' )?> <?=!$data["buf_{$group}_third_interval_check"] ? 'disabled="disabled"' : ''?>>13.00 - 16.00



		</label>



		<label <?=!$data["buf_{$group}_fourth_interval_check"] ? 'disabled="disabled"' : ''?> class="checkbox-inline">



		<input name="buf_<?=$group?>_fourth_interval_check" id="buf_<?=$group?>_fourth_interval_check" type="checkbox" <?php checked( $data["buf_{$group}_fourth_interval_check"], 'on' )?> <?=!$data["buf_{$group}_fourth_interval_check"] ? 'disabled="disabled"' : ''?>>16.00 - 19.00



		</label>



	</div>



<?php



}







function getCPTCourseFieldsIDMapping() {



	return array(



		'buf_mic_luni_check',



		'buf_mic_marti_check',



		'buf_mic_miercuri_check',



		'buf_mic_joi_check',



		'buf_mic_vineri_check',



		'buf_mic_sambata_check',



		'buf_mic_duminica_check',



		'buf_mic_first_interval_check',



		'buf_mic_second_interval_check',



		'buf_mic_third_interval_check',



		'buf_mic_fourth_interval_check',







		'buf_mijlociu_luni_check',



		'buf_mijlociu_marti_check',



		'buf_mijlociu_miercuri_check',



		'buf_mijlociu_joi_check',



		'buf_mijlociu_vineri_check',



		'buf_mijlociu_sambata_check',



		'buf_mijlociu_duminica_check',



		'buf_mijlociu_first_interval_check',



		'buf_mijlociu_second_interval_check',



		'buf_mijlociu_third_interval_check',



		'buf_mijlociu_fourth_interval_check',







		'buf_mare_luni_check',



		'buf_mare_marti_check',



		'buf_mare_miercuri_check',



		'buf_mare_joi_check',



		'buf_mare_vineri_check',



		'buf_mare_sambata_check',



		'buf_mare_duminica_check',



		'buf_mare_first_interval_check',



		'buf_mare_second_interval_check',



		'buf_mare_third_interval_check',



		'buf_mare_fourth_interval_check',



	);



}







function getCPTCourseFieldsIDMappingLabels() {



	return array(



		'mic' => array(



			'zile' => array(



				'buf_mic_luni_check' => 'Luni',



				'buf_mic_marti_check' => 'Marti',



				'buf_mic_miercuri_check' => 'Miercuri',



				'buf_mic_joi_check' => 'Joi',



				'buf_mic_vineri_check' => 'Vineri',



				'buf_mic_sambata_check' => 'Sambata',



				'buf_mic_duminica_check' => 'Duminica',



			),



			'interval' => array(



				'buf_mic_first_interval_check' => '07.00 - 10.00',



				'buf_mic_second_interval_check' => '10.00 - 13.00',



				'buf_mic_third_interval_check' => '13.00 - 16.00',



				'buf_mic_fourth_interval_check' => '16.00 - 19.00',



			)



		),



		'mijlociu' => array(



			'zile' => array(



				'buf_mijlociu_luni_check' => 'Luni',



				'buf_mijlociu_marti_check' => 'Marti',



				'buf_mijlociu_miercuri_check' => 'Miercuri',



				'buf_mijlociu_joi_check' => 'Joi',



				'buf_mijlociu_vineri_check' => 'Vineri',



				'buf_mijlociu_sambata_check' => 'Sambata',



				'buf_mijlociu_duminica_check' => 'Duminica',



			),



			'interval' => array(



				'buf_mijlociu_first_interval_check' => '07.00 - 10.00',



				'buf_mijlociu_second_interval_check' => '10.00 - 13.00',



				'buf_mijlociu_third_interval_check' => '13.00 - 16.00',



				'buf_mijlociu_fourth_interval_check' => '16.00 - 19.00',



			)



		),



		'mare' => array(



			'zile' => array(



				'buf_mare_luni_check' => 'Luni',



				'buf_mare_marti_check' => 'Marti',



				'buf_mare_miercuri_check' => 'Miercuri',



				'buf_mare_joi_check' => 'Joi',



				'buf_mare_vineri_check' => 'Vineri',



				'buf_mare_sambata_check' => 'Sambata',



				'buf_mare_duminica_check' => 'Duminica',



			),



			'interval' => array(



				'buf_mare_first_interval_check' => '07.00 - 10.00',



				'buf_mare_second_interval_check' => '10.00 - 13.00',



				'buf_mare_third_interval_check' => '13.00 - 16.00',



				'buf_mare_fourth_interval_check' => '16.00 - 19.00',



			)



		)



	);



}











function render_dummy_form_footer( $show ) {?>



	<div class="col-xs-12 col-sm-6 text-center week_dummy" <?=$show ? 'style="display:block;"' : 'style="display:none;"'?>>



	  <h4>Ce zile preferati</h4>



	  <p class="small">alegeti din optiunile disponibile</p>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxLuni" type="checkbox" value="optionLuni" disabled="disabled">L



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxMarti" type="checkbox" value="optionMarti" disabled="disabled">M



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxMiercuri" type="checkbox" value="optionMiercuri" disabled="disabled">M



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxJoi" type="checkbox" value="optionJoi" disabled="disabled">J



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxVineri" type="checkbox" value="optionVineri" disabled="disabled">V



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxSimbata" type="checkbox" value="optionSimbata" disabled="disabled">S



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxDuminica" type="checkbox" value="optionDuminica" disabled="disabled">D



	  </label>



	</div>



	<div class="col-xs-12 col-sm-6 text-center schedule_dummy">



	  <h4>Care e orarul preferat</h4>



	  <p class="small">alegeti din optiunile disponibile</p>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxProgram01" type="checkbox" value="Program01" disabled="disabled">7.00 - 10.00



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxProgram02" type="checkbox" value="Program02" disabled="disabled">10.00 - 13.00



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxProgram03" type="checkbox" value="Program03" disabled="disabled">13.00 - 16.00



	  </label>



	  <label disabled="disabled" class="checkbox-inline">



		<input id="inlineCheckboxProgram04" type="checkbox" value="Program04" disabled="disabled">16.00 - 19.00



	  </label>



	</div><?php



}











function render_sidebar_group_categories_widget($data) {



	//echo '<pre>';print_R($data);die;



	echo "



		<table class=\"table table-price\">



			<thead>



				<tr class=\"title\">



					<td colspan=\"". count($data['available_categories']) . "\">



						<em>Preturile / categorii de varsta



							<a href=\"modal\" data-toggle=\"modal\" data-target=\"#categoriiVarsta\" class=\"badge\">?</a>



						</em>



					</td>



				</tr>



				<tr>";



	foreach ($data['available_categories'] as $categ) {



		switch($categ) {



			case "mic" :



				echo "



					<td>



						<div class=\"a\">" . render_mic_category_svg() . "</div>



					</td>";



				break;



			case "mijlociu" :



				echo "



					<td>



						<div class=\"b\">" . render_mijlociu_category_svg() . "</div>



					</td>";



				break;



			case "mare" :



				echo "<td>



						<div class=\"c\">" . render_mare_category_svg() . "</div>



					</td>";



				break;



		}



	}



	echo "



			</tr>



		</thead>



		<tbody>";



	if( $data['show_full_row'] ) {



		echo "



			<tr>";



		foreach ($data['price_full'] as $price_row) {



		echo "



				<td>$price_row</td>";



		}



		echo "



			</tr>";



	}







	if( $data['show_discount_row'] ) {



		echo "



			<tr>";



		foreach ($data['price_discount'] as $price_row) {



		echo "



				<td>$price_row</td>";



		}



		echo "



			</tr>";



	}



	echo "



		</tbody>



	</table>";



}











function render_mic_category_svg() {



	return '<svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">



		<path class="children_small" d="M41.4,30.6c-0.3-1.4-1.7-2.3-3.1-1.9L2,37c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1l10.4-2.4v23.5c0,1.5,1.2,2.7,2.7,2.7s2.7-1.2,2.7-2.7v-13h2.8v13c0,1.5,1.2,2.7,2.7,2.7



			c1.5,0,2.7-1.2,2.7-2.7V36.6l12.4-2.8C40.8,33.4,41.7,32,41.4,30.6z"></path>



		<ellipse class="children_small" cx="19.2" cy="23" rx="5.9" ry="5.8"></ellipse>



		<path class="children_large" d="M121.8,12.2c-0.3-1.4-1.7-2.3-3.1-1.9L74.2,20.5c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1L86.1,23v40.1c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V41.9h3.5v21.2c0,1.5,1.2,2.7,2.7,2.7



			s2.7-1.2,2.7-2.7V19.8l19.6-4.5C121.2,15,122.1,13.6,121.8,12.2z"></path>



		<circle class="children_large" cx="92.7" cy="6.1" r="5.9"></circle>



		<ellipse class="children_medium" cx="56" cy="14.6" rx="5.9" ry="5.8"></ellipse>



		<path class="children_medium" d="M77.3,22.4c-0.3-1.4-1.7-2.3-3.1-1.9l-35.9,8.2c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1l10.4-2.4v31.8c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V46h3.1v17.1c0,1.5,1.2,2.7,2.7,2.7



			c1.5,0,2.7-1.2,2.7-2.7V28.2l11.7-2.7C76.7,25.2,77.6,23.8,77.3,22.4z"></path>



	</svg>';



}











function render_mijlociu_category_svg() {



	return '<svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">



		<path class="children_small" d="M41.4,30.6c-0.3-1.4-1.7-2.3-3.1-1.9L2,37c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1l10.4-2.4v23.5c0,1.5,1.2,2.7,2.7,2.7s2.7-1.2,2.7-2.7v-13h2.8v13c0,1.5,1.2,2.7,2.7,2.7



			c1.5,0,2.7-1.2,2.7-2.7V36.6l12.4-2.8C40.8,33.4,41.7,32,41.4,30.6z"></path>



		<ellipse class="children_small" cx="19.2" cy="23" rx="5.9" ry="5.8"></ellipse>



		<path class="children_large" d="M121.8,12.2c-0.3-1.4-1.7-2.3-3.1-1.9L74.2,20.5c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1L86.1,23v40.1c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V41.9h3.5v21.2c0,1.5,1.2,2.7,2.7,2.7



			s2.7-1.2,2.7-2.7V19.8l19.6-4.5C121.2,15,122.1,13.6,121.8,12.2z"></path>



		<circle class="children_large" cx="92.7" cy="6.1" r="5.9"></circle>



		<ellipse class="children_medium" cx="56" cy="14.6" rx="5.9" ry="5.8"></ellipse>



		<path class="children_medium" d="M77.3,22.4c-0.3-1.4-1.7-2.3-3.1-1.9l-35.9,8.2c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1l10.4-2.4v31.8c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V46h3.1v17.1c0,1.5,1.2,2.7,2.7,2.7



			c1.5,0,2.7-1.2,2.7-2.7V28.2l11.7-2.7C76.7,25.2,77.6,23.8,77.3,22.4z"></path>



	</svg>';



}











function render_mare_category_svg() {



	return '<svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">



		<path class="children_small" d="M41.4,30.6c-0.3-1.4-1.7-2.3-3.1-1.9L2,37c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1l10.4-2.4v23.5c0,1.5,1.2,2.7,2.7,2.7s2.7-1.2,2.7-2.7v-13h2.8v13c0,1.5,1.2,2.7,2.7,2.7



			c1.5,0,2.7-1.2,2.7-2.7V36.6l12.4-2.8C40.8,33.4,41.7,32,41.4,30.6z"></path>



		<ellipse class="children_small" cx="19.2" cy="23" rx="5.9" ry="5.8"></ellipse>



		<path class="children_large" d="M121.8,12.2c-0.3-1.4-1.7-2.3-3.1-1.9L74.2,20.5c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1L86.1,23v40.1c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V41.9h3.5v21.2c0,1.5,1.2,2.7,2.7,2.7



			s2.7-1.2,2.7-2.7V19.8l19.6-4.5C121.2,15,122.1,13.6,121.8,12.2z"></path>



		<circle class="children_large" cx="92.7" cy="6.1" r="5.9"></circle>



		<ellipse class="children_medium" cx="56" cy="14.6" rx="5.9" ry="5.8"></ellipse>



		<path class="children_medium" d="M77.3,22.4c-0.3-1.4-1.7-2.3-3.1-1.9l-35.9,8.2c-1.4,0.3-2.3,1.7-1.9,3.1c0.3,1.2,1.3,2,2.5,2



			c0.2,0,0.4,0,0.6-0.1l10.4-2.4v31.8c0,1.5,1.2,2.7,2.7,2.7c1.5,0,2.7-1.2,2.7-2.7V46h3.1v17.1c0,1.5,1.2,2.7,2.7,2.7



			c1.5,0,2.7-1.2,2.7-2.7V28.2l11.7-2.7C76.7,25.2,77.6,23.8,77.3,22.4z"></path>



	</svg>';



}















function render_footer() {



	echo '<section class="footer">



		<div class="container-fluid">



			<div class="container">



				<div class="row">';



	$footer_categs = bufnita_footer_categories();



	if ( $footer_categs ) :?>



		<div class="col-xs-12 col-sm-6 col-md-3 col-md-push-3 cursuriFooter">



			<h4>Zone de interes</h4>



			<ul>



			<?php foreach ($footer_categs as $name => $link) :?>



				<li><a href="<?=$link?>"><?=$name?></a></li>



			<?php endforeach;?>



			</ul>



		</div>



	<?endif;?><?php



	$footer_last_six_posts_args = array(



		'post_type' => 'post',



		'posts_per_page' => '6',



		'post_status' => 'publish',



		'category_name' => 'blog'



	);







	$footer_last_six_posts_qry = new WP_Query($footer_last_six_posts_args);



	// The Loop



	if ( $footer_last_six_posts_qry->have_posts() ):?>



		<div class="col-xs-12 col-sm-6 col-md-3 col-md-push-3 newsFooter">



			<hr class="visible-xs-block visible-sm-block" />



			<h4>Articole recente</h4>



			<ul>



			<?php while ( $footer_last_six_posts_qry->have_posts() ): $footer_last_six_posts_qry->the_post();?>



				<li><a href="<?=esc_url(get_the_permalink())?>"> <?=esc_attr(get_the_title())?> </a></li>



			<?php endwhile; ?>



			</ul>



		</div><?php wp_reset_postdata(); /* Restore original Post Data */?>



	<?php endif;?>











	<div class="col-xs-12 col-sm-6 col-md-3 col-md-push-3">



		<hr class="visible-xs-block visible-sm-block">



		<h4>Pagina de facebook</h4>



		<div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/Bufnita-din-Tei-1609911665934551" data-small-header="false" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true" data-show-posts="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=&amp;container_width=263&amp;hide_cover=true&amp;href=https%3A%2F%2Fwww.facebook.com%2FBufnita-din-Tei-1609911665934551&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=false"><span style="vertical-align: bottom; width: 263px; height: 214px;"><iframe name="f2e53d91dc" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:page Facebook Social Plugin" src="https://www.facebook.com/v2.4/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fs-static.ak.facebook.com%2Fconnect%2Fxd_arbiter%2F44OwK74u0Ie.js%3Fversion%3D41%23cb%3Df30275337%26domain%3Drawgit.com%26origin%3Dhttps%253A%252F%252Frawgit.com%252Ff2de21277c%26relation%3Dparent.parent&amp;container_width=263&amp;hide_cover=true&amp;href=https%3A%2F%2Fwww.facebook.com%2FBufnita-din-Tei-1609911665934551&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=false" style="border: none; visibility: visible; width: 263px; height: 214px;" class=""></iframe></span></div>



	</div><?php







	$footer_article_presentation_posts_args = array(



		'post_type' => 'post',



		'posts_per_page' => '1',



		'post_status' => 'publish',



		'category_name' => 'footer'



	);



	$footer_article_presentation_posts_qry = new WP_Query($footer_article_presentation_posts_args);



	// The Loop



	if ( $footer_article_presentation_posts_qry->have_posts() ):?>



		<div class="col-xs-12 col-sm-6 col-md-3 col-md-pull-9 despreNoiFooter">



			<hr class="visible-xs-block visible-sm-block">



			<h4>Despre noi</h4>



			<p class="small">



			<?php while ( $footer_article_presentation_posts_qry->have_posts() ) : $footer_article_presentation_posts_qry->the_post();?>



			<?=esc_attr(get_the_content())?>



			<?php endwhile;?>



			</p>



		</div>



	<?php endif; /* Restore original Post Data */ wp_reset_postdata();?>







				</div>



			</div>



		</div>



		<div class="container-fluid lastRowFooter">



			<div class="container">



				<div class="row">



					<div class="col-xs-6">



						<p class="text-left small"><a href="/">Bufnita din Tei</a> &copy; <?=date('Y')?></p>



					</div>



					<div class="col-xs-6">



						<p class="text-right small">telefon: (0751) 02.03.62</p>



					</div>



				</div>



			</div>



		</div>



	</section>



	<!-- google analytics HERE -->
	<?php include(ABSPATH . 'wp-content/themes/bufnita/inc/marketing/google_analitycs.php'); ?>
	<!-- google analytics END -->


	<!-- Google Code for Remarketing Tag -->
	<!--------------------------------------------------
	Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
	--------------------------------------------------->
	<?php include(ABSPATH . 'wp-content/themes/bufnita/inc/marketing/google_remarketing.php'); ?>
	<!-- END GOOGLE REMARKETING TAG-->


	<!-- Facebook Pixel Code -->
	<?php include(ABSPATH . 'wp-content/themes/bufnita/inc/marketing/facebook_pixel.php'); ?>
	<!-- End Facebook Pixel Code -->


	<?php



}







function bufnita_footer_categories() {



	global $wpdb;



	$old_query = $wpdb;



	$results = $wpdb->get_results ( "



		SELECT t.slug, t.name FROM $wpdb->terms t



		INNER JOIN $wpdb->term_taxonomy tt on t.term_id = tt.term_id



		WHERE taxonomy = 'course_category'



		ORDER BY RAND( CURDATE() )



		LIMIT 6" );



	$categories = array();



	foreach ( $results as $cat ) {



		$categories[esc_attr($cat->name)] = get_site_url() . '/courses/?categ=' . $cat->slug;



	}



	$wpdb = $old_query;



	return $categories;



}















function render_teachers_slot_listing( $search_arr = array() ) {



	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;



	$news_list_posts_args = !empty($search_arr) ? $search_arr : array(



		'post_type' => 'teacher',



		'posts_per_page' => '8',



		'post__not_in' => array(304),



		'post_status' => 'publish',



		'paged' => $paged,



	);



	$news_list_posts_qry = new WP_Query($news_list_posts_args);



	// The Loop



	if ( $news_list_posts_qry->have_posts() ) {?>



		<ul class="posts"><?php



				while ( $news_list_posts_qry->have_posts() ) {



					$news_list_posts_qry->the_post();



					$meta_data = get_post_meta( get_the_ID() );



					$teacher_function = isset($meta_data['buf_teacher_function'][0]) ? $meta_data['buf_teacher_function'][0] : '';



					$buf_teacher_art_id = isset($meta_data['buf_teacher_art_id'][0]) ? $meta_data['buf_teacher_art_id'][0] : '';



					$teacher_art_url = $buf_teacher_art_id ? get_permalink($buf_teacher_art_id) : 'javascript:void(0)';



					?>



					<li>



						<div class="col-xs-12">



							<small><?php the_date( 'd.m.Y' )?></small>



							<!-- title news-->



							<a href="<?=$teacher_art_url?>">



								<h4><?php esc_attr( the_title())?></h4>



							</a>



						</div>



						<?php if ( has_post_thumbnail() ) :?>



						<div class="col-xs-12 col-sm-6"><img src="<?=wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );?>" alt="<?php the_title()?>" class="img-responsive"></div>



						<div class="col-xs-12 col-sm-6">



							<p class="small"><?= get_the_excerpt()?></p>

							<?php if ($teacher_art_url != 'javascript:void(0)') :?>

							<a href="<?=$teacher_art_url?>" class="btn btn-sm btn-ghost-type_two pull-right">citeste mai mult</a>

							<?php endif;?>

						</div>



						<?php else : ?>



						<div class="col-xs-12 col-sm-12">



							<p class="small"><?=get_the_excerpt()?>

							<?php if ($teacher_art_url != 'javascript:void(0)') :?>

							<a href="<?=$teacher_art_url?>" class="btn btn-sm btn-ghost-type_two pull-right">citeste mai mult</a>

							<?php endif;?>

						</div>



						<?php endif;?>



						<div class="clearfix"></div>



						<hr>



					</li>



					<?php } ?>



		</ul>



		<?php



		bufnita_numeric_posts_nav($news_list_posts_qry);



	}



	/* Restore original Post Data */



	wp_reset_postdata();



}
