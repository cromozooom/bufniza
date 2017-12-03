<?php require get_template_directory() . '/inc/render_sections.php';?>
<?php $data = prepare_courses_for_listing();?>
<?php get_header(); ?>

        <section class="listaCursuri">

            <div class="container-fluid no-gutter cover">
                <div class="row">
                    <div class="col-xs-12"><img src="<?=get_template_directory_uri()?>/assets/images/header_cursuri.jpg" alt="..." class="img-responsive"></div>
                </div>
            </div>

            <?php // ========================= modificari ========================= ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-3 col-lg-2">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <h5>Filtreaza activitatile</h5>
                                <div class="list-group filters" data-filter-group="categs">
                                    <?php foreach($data['categories_filter'] as $key => $categ):?>
                                        <a href="#" <?=$key == 'toate' ? 'data-filter=""' : "data-filter=\".$key\""?> class="single-filter list-group-item<?=$key == 'toate' ? ' active' : ''?>">
                                            <div class="badge"><?=$key == 'toate' ? $data['groups']['toate-grupele']['count'] : $categ['count']; /*  aici e un bug dar count-ul de cursuri e acelasi ca la grupe  */?></div><?=$categ['name']?>
                                        </a>
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-12 col-lg-12">
                                <h5>Filtreaza grupele</h5>
                                <div class="list-group filters" data-filter-group="groups">
                                    <?php foreach($data['groups'] as $key => $group):?>
                                        <a href="#" <?=$key == 'toate-grupele' ? 'data-filter=""' : "data-filter=\".$key\""?> class="single-filter list-group-item<?=$key == 'toate-grupele' ? ' active' : ''?>">
                                            <div class="badge"><?=$group['count']?></div><?=$group['name']?>
                                        </a>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-9 col-lg-10">
                        <h5>Toate activitatile</h5>
                        <div class="row isotope">
                            <?php foreach($data['courses'] as $key => $course):?>
                                <?php $teachers_slugs = implode(' ', array_map('build_group_slug_from_arr', array_values($course['svg_class'])));?>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 element-item <?=$course['category_slug']?> <?=$teachers_slugs?>">
                                    <div class="curs thumbnail">
                                        <a href="<?=$course['course_url']?>">
                                            <img src="<?=$course['image_url']?>" alt="<?=$course['title']?>" class="img-responsive">
                                        </a>
                                        <div class="caption">
                                            <a href="<?=$course['course_url']?>"></a>
                                            <a href="<?=$course['course_url']?>"><span class="label label-default"><?=$course['category_name']?></span></a>
                                            <a href="<?=$course['course_url']?>"><h5><?=$course['title']?></h5></a>
                                            <div class="pull-left <?=implode(' ', $course['svg_class'])?>"><?=render_courses_svg_icon()?></div>
                                            <p class="pull-right"><?=$course['duration']?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
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
        <script src="<?=get_template_directory_uri()?>/assets/javascripts/bootstrap.min.js"></script>
        <!-- yamm-->
        <script src="<?=get_template_directory_uri()?>/assets/javascripts/yamm.js"></script>
		<script src="<?=get_template_directory_uri()?>/js/isotope.pkgd.min.js"></script>
		<script src="<?php echo plugins_url( 'buf_rum_newsletter/js/buf_rum_script.js'); ?>"></script>
        <script src="<?php echo plugins_url( 'buf_rum_newsletter/js/jquery.nearest.min.js'); ?>"></script>
		<script src="<?=get_template_directory_uri()?>/assets/javascripts/imagesloaded.pkgd.min.js"></script>
		<script>
			$(document).ready(function() {
				var current_category = <?=( isset($_GET['categ']) && $_GET['categ']) ? ("'" . preg_replace('/[^A-Za-z0-9\-]/', '', $_GET['categ']) . "'") : "''"?>;
				// init Isotope
				var $container = $('.isotope');
				$container.imagesLoaded( function(){
					$container.isotope({
						itemSelector: '.element-item',
						layoutMode: 'fitRows'
					});
				});
				
				var filters = {};
				
				$('.filters').on('click', '.single-filter', function() {
					var $this = $(this);
					// get group key
					var $buttonGroup = $this.parents('.filters');
					var filterGroup = $buttonGroup.attr('data-filter-group');
					// set filter for group
					filters[filterGroup] = $this.attr('data-filter');
					// combine filters
					var filterValue = concatValues(filters);
					// set filter for Isotope
					$container.isotope({
						filter: filterValue
					});
				});

				// change is-checked class on buttons
				$('.sudului').each(function(i, buttonGroup) {
					var $buttonGroup = $(buttonGroup);
					$buttonGroup.click(function(e) {
					e.preventDefault();
						$(buttonGroup).siblings('.active').removeClass('active');
						$(this).addClass('active');
						var filterValue = $(this).attr('data-filter');
						$container.isotope({ filter: filterValue });
					});
				});
				setTimeout(function() {
					if (current_category)
						$('.filters a[data-filter=".'+current_category+'"]').trigger('click');
				}, 10);
			});
			
			function concatValues(obj) {
				var value = '';
				for (var prop in obj) {
					value += obj[prop];
				}
				return value;
			}

		</script>

        <script>
            $(document).ready(function() {
                var current_category = <?=( isset($_GET['categ']) && $_GET['categ']) ? ("'" . preg_replace('/[^A-Za-z0-9\-]/', '', $_GET['categ']) . "'") : "''"?>;
                // init Isotope
                var $container = $('.isotope2');
                $container.imagesLoaded( function(){
                    
                });

                var filters = {};

                $('.filters2').on('click', '.single-filter', function() {
                    var $this = $(this);
                    // get group key
                    var $buttonGroup = $this.parents('.filters');
                    var filterGroup = $buttonGroup.attr('data-filter-group');
                    // set filter for group
                    filters[filterGroup] = $this.attr('data-filter');
                    // combine filters
                    var filterValue = concatValues(filters);
                    // set filter for Isotope
                    $container.isotope({
                        filter: filterValue
                    });
                });

                // change is-checked class on buttons
                $('.cismigiu').each(function(i, buttonGroup) {
                    var $buttonGroup = $(buttonGroup);
                    $buttonGroup.click(function(e) {
                        e.preventDefault();
                        $(buttonGroup).siblings('.active').removeClass('active');
                        $(this).addClass('active');
                        var filterValue = $(this).attr('data-filter');
                        $container.isotope({ filter: filterValue });
                    });
                });
                setTimeout(function() {
                    if (current_category)
                        $('.filters2 a[data-filter=".'+current_category+'"]').trigger('click');
                }, 10);
            });

            function concatValues(obj) {
                var value = '';
                for (var prop in obj) {
                    value += obj[prop];
                }
                return value;
            }

        </script>

		<?php wp_footer();?>
    </body>
</html>