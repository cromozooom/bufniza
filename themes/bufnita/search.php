<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package bufnita
 */
 require get_template_directory() . '/inc/render_sections.php';?>
<?php get_header(); ?>
    <section class="stiri">
      <div class="container-fluid">
        <div class="col-xs-12">
          <!-- title Post-->
		  <?php $s = get_search_query(); $args_search = array('s' => $s);?>
          <?php if ($s) :?><h1 class="text-center">Cautare dupa: <br><small><?=$s?></small></h1><?php endif;?>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-8 col-lg-8">
			  <?php render_news_slot_listing($args_search)?>
          </div>
          <?php render_sidebar()?>
      </div>
    </section>
	<?php render_footer()?>
    <!-- Bootstrap core JavaScript-->
    <!-- ==================================================-->
    <!-- Placed at the end of the document so the pages load faster-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri()?>/assets/javascripts/bootstrap.min.js"></script>
    <!-- yamm-->
    <script src="<?php echo get_template_directory_uri()?>/assets/javascripts/yamm.js"></script>
	<?php wp_footer();?>
  </body>
</html>
