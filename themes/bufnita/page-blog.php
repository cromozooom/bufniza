<?php
/**
 * Template Name: Blog Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 require get_template_directory() . '/inc/render_sections.php';?>
<?php get_header(); ?>
    <section class="stiri">
      <div class="container-fluid">
        <div class="col-xs-12">
          <!-- title Post-->
          <h1 class="text-center">Stiri Bufnita din Tei<br><small>Descopera ultimele noutati din cuibul meu ...</small></h1>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-8 col-lg-8">
			  <?php render_news_slot_listing()?>
          </div>
          <?php render_sidebar()?>
      </div>
    </section>
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