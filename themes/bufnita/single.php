<?php require get_template_directory() . '/inc/render_sections.php';?>
<?php get_header(); ?>
    <section class="cours">
      <div class="container">
        <div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
          <div class="col-xs-12 col-md-8 col-lg-8">
            <!-- title Post-->
            <h1><?php the_title()?></h1>
            <div class="description">
              <!-- excerpt-->
              <!-- excerpt-->
			  <?php if(has_excerpt( get_the_ID())) :?>
              <p class="lead">
                <?=get_the_excerpt()?>
              </p>
			  <?php endif;?>
			  <!-- WYSIWYG-->
			  <?php $image_url = has_post_thumbnail() ? aq_resize( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ), 500, 250) : null;?>
			  <?php if ($image_url) :?>
			  <img src="<?=$image_url?>" alt="<?php esc_attr( the_title() )?>" class="img-responsive">
			  <?php endif?>
              <?php esc_attr( the_content() )?>
            </div>
          </div>
		  <?php endwhile;?>
          <?php render_sidebar()?>
        </div>
      </div>
    </section>
	<!-- popUP categorii de virsta ?-->
    <div id="categoriiVarsta" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Categorii de vista</h4>
          </div>
        </div>
      </div>
    </div>
	<!-- START HP newsletter -->
	<?php render_hp_newsletter()?>
	<!-- END HP newsletter -->

	<script type="text/javascript">
		var ajaxurl = '<?=admin_url('admin-ajax.php'); ?>';
		var buf_rum_c_name = '<?=session_id() ? session_id() : ""?>';
	</script>
	<!-- START HP newsletter -->
	<?php render_newsletter_popup()?>
	<!-- END HP newsletter -->

	<?php render_footer()?>
    <!-- Bootstrap core JavaScript-->
    <!-- ==================================================-->
    <!-- Placed at the end of the document so the pages load faster-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri()?>/assets/javascripts/bootstrap.min.js"></script>
    <!-- yamm-->
    <script src="<?php echo get_template_directory_uri()?>/assets/javascripts/yamm.js"></script>
	<script src="<?php echo plugins_url( 'buf_rum_newsletter/js/buf_rum_script.js'); ?>"></script>
	<script src="<?php echo plugins_url( 'buf_rum_newsletter/js/jquery.nearest.min.js'); ?>"></script>
	<?php wp_footer();?>
  </body>
</html>