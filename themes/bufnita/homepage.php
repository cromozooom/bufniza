<?php

/**

* Template Name: HomePage

*/

require get_template_directory() . '/inc/render_sections.php';?>

<?php $data = prepare_courses_for_listing_homepage();?>

	<?php get_header(); ?>

	<!-- START HP carousel -->

    <section class="carousel">

      <div id="carousel-example-generic" data-ride="carousel" class="carousel slide">

        <!-- Wrapper for slides-->

        <div role="listbox" class="carousel-inner">

		<?php render_HP_slider(); ?>

        </div>

        <!-- Controls--><a href="#carousel-example-generic" role="button" data-slide="prev" class="left carousel-control"><span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span><span class="sr-only">Previous</span></a><a href="#carousel-example-generic" role="button" data-slide="next" class="right carousel-control"><span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span><span class="sr-only">Next</span></a>

      </div>

    </section>

    <!-- END HP carousel -->

	

	<!-- START HP article after carousel -->

	<?php render_HP_article_after_slide()?>

	<!-- END HP article after carousel -->

	

	<!-- START HP three courses -->

	<?php 

	//render_HP_four_courses()

	?>

	<script type="text/javascript">

        var ajaxurl = '<?=admin_url('admin-ajax.php'); ?>';

        var buf_rum_c_name = '<?=session_id() ? session_id() : ""?>';

    </script>

	<!-- START HP newsletter -->

	<?php render_hp_newsletter()?>

	<!-- END HP newsletter -->	



	<!-- START HP three courses -->

	<section class="cursuri">

		<div class="container">

			<div class="row">

				<div class="col-xs-12 text-center">

					<h2>Vezi citeva dintre asctivitatile noastre</h2>

				</div>

			</div>

			<section class="listaCursuri row listaCursuri--noBg">

				<?php foreach($data['courses'] as $key => $course):?>

					<?php $teachers_slugs = implode(' ', array_map('build_group_slug_from_arr', array_values($course['svg_class'])));?>

					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">

						<div class="curs thumbnail">

							<a href="<?=$course['course_url']?>">

								<img src="<?=$course['image_url']?>" alt="<?=$course['title']?>" class="img-responsive">

							</a>

							<div class="caption">

								<a href="<?=$course['course_url']?>"><span class="label label-default"><?=$course['category_name']?></span></a>

								<a href="<?=$course['course_url']?>"><h5><?=$course['title']?></h5></a>

								<div class="pull-left <?=implode(' ', $course['svg_class'])?>"><?=render_courses_svg_icon()?></div>

									<p class="pull-right"><?=$course['duration']?></p>

							</div>

						</div>

					</div>

				<?php endforeach;?>

			</section>

		</div>

	</section>	



	<?php ?>

	<!-- END HP three courses -->

	

	<!-- START HP three courses -->

	<?php render_HP_four_teachers()?>

	<!-- END HP three courses -->

	

	<script type="text/javascript">

        var ajaxurl = '<?=admin_url('admin-ajax.php'); ?>';

        var buf_rum_c_name = '<?=session_id() ? session_id() : ""?>';

    </script>

	<!-- START HP newsletter -->

	<?php render_hp_newsletter()?>

	<!-- END HP newsletter -->	



	<!-- START HP three courses -->

	<?php render_HP_last_two_news()?>

	<!-- END HP three courses -->



    <?php render_footer()?>

	

	<?php render_newsletter_popup()?>

    <!-- Bootstrap core JavaScript-->

    <!-- ==================================================-->

    <!-- Placed at the end of the document so the pages load faster-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/bootstrap.min.js"></script>

    <!-- yamm-->

    <script src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/yamm.js"></script>	

	<script src="<?php echo plugins_url( 'buf_rum_newsletter/js/buf_rum_script.js'); ?>"></script>

	<script src="<?php echo plugins_url( 'buf_rum_newsletter/js/jquery.nearest.min.js'); ?>"></script>

	<?php wp_footer();?>

  </body>

</html>

