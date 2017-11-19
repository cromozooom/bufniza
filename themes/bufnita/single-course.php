<?php require get_template_directory() . '/inc/render_sections.php';?>
	<?php get_header(); ?>
        <section class="cours">  
            <div class="container">
                <div class="row">
					<?php while ( have_posts() ) : the_post(); 
					$terms = get_the_terms(get_the_ID(), 'course_category');
					$course_category_name = isset($terms[0]) ? $terms[0]->name : '';
					$course_category_slug = isset($terms[0]) ? $terms[0]->slug : '#';
					//$image_url = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) : null;
					
					$meta_data = get_post_meta( get_the_ID() );
					$teachers_ids = isset($meta_data['buf_mic_teachers_assigned'][0]) ? unserialize(unserialize($meta_data['buf_mic_teachers_assigned'][0])) : array();
					$teachers_ids = array_merge($teachers_ids,(isset($meta_data['buf_mijlociu_teachers_assigned'][0]) ? unserialize(unserialize($meta_data['buf_mijlociu_teachers_assigned'][0])) : array()));
					$teachers_ids = array_merge($teachers_ids,(isset($meta_data['buf_mare_teachers_assigned'][0]) ? unserialize(unserialize($meta_data['buf_mare_teachers_assigned'][0])) : array()));
					//echo '<pre>';print_r($teachers_ids);die; 
					$categories_data = getCategoriesDataForCourse($meta_data);
					$categs_data = getDataForSidebarCourse($meta_data);
					?>
                    <div class="col-xs-12">
                        <!-- categorie principala-->
						<?php if($course_category_name) :?>
						<a href="<?=site_url() . '/courses/?categ=' . $course_category_slug?>"><?=$course_category_name?></a>
						<?php endif;?>
                        <!-- title cours-->
                        <h1><?=esc_attr( get_the_title() )?></h1>
                    </div>
                    <div class="col-xs-12 col-md-8 col-lg-7">
                        <div class="description">
                            <!-- excerpt-->
							<?php if(has_excerpt( get_the_ID())) :?>
							<p class="lead">
								<?=esc_attr( get_the_excerpt() )?>
							</p>
							<?php endif;?>
							<div class="visible-xs-block visible-sm-block">
								<!-- Mobile sidebar-->
								<div class="well text-center">
									<!-- link catre formular-->
									<a href="/formular?c=<?=get_the_cpt_slug()?>" class="btn btn-lg btn-ghost-type_two">Inscrie-te acum</a>
									<?php render_sidebar_group_categories_widget($categs_data)?>
								</div>
								<div class="tags">
									<?php if ( function_exists('show_share_buttons') ) :?>
										<?=show_share_buttons('');?>
									<?php endif;?>
								</div>
							</div>
							<!-- WYSIWYG-->
                            <?php the_content()?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-5 sidebar">
                        <div class="visible-md-block visible-lg-block">
                            <!-- Desktop sidebar (same like in mobile)-->
                            <div class="well text-center">
                                <!-- link catre formular-->
								<a href="/formular?c=<?=get_the_cpt_slug()?>" class="btn btn-lg btn-ghost-type_two">Inscrie-te acum</a>
                                <?php render_sidebar_group_categories_widget($categs_data)?></div> 
								<div class="tags">
							<?php if ( function_exists('show_share_buttons') ) :?>
								<?=show_share_buttons('');?>
							<?php endif;?>
						</div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Timeframe-->
                        <div class="timeFrame">
                            <h3>Time frame</h3>
                            <ul>
                                <?php if (isset($categs_data['mic_category_details']['duration']) && $categs_data['mic_category_details']['duration']) : ?>
                                <li>
                                    <p><strong>&nbsp;Mici:&nbsp;</strong><?=$categs_data['mic_category_details']['duration']?></p>
                                </li>
								<?php endif;?>
								<?php if (isset($categs_data['mijlociu_category_details']['duration']) && $categs_data['mijlociu_category_details']['duration']) : ?>
                                <li>
                                    <p><strong>&nbsp;Mijlocii:&nbsp;</strong><?=$categs_data['mijlociu_category_details']['duration']?></p>
                                </li>
								<?php endif;?>
								<?php if (isset($categs_data['mare_category_details']['duration']) && $categs_data['mare_category_details']['duration']) : ?>
                                <li>
                                    <p><strong>&nbsp;Mari:&nbsp;</strong><?=$categs_data['mare_category_details']['duration']?></p>
                                </li>
								<?php endif;?>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Tags-->
                        <!-- Tags-->
						<?php $tags = get_the_terms(get_the_ID(), 'post_tag');?>
						<?php if (! empty($tags)) : ?>
                        <div class="tags">
							<?php //echo '<pre>';print_R(get_the_terms(get_the_ID(), 'post_tag'));die;?>
                            <h3>Tags</h3>
                            <hr>
                            <ul class="list-inline">
								<?php foreach ($tags as $tag) :?>
                                <li><a href="/?s=<?=urlencode($tag->name)?>"><span class="badge"><?=$tag->name?></span></a></li>
								<?php endforeach;?>
                            </ul>
                        </div>
						<?php endif;?>
                        <div class="clearfix"></div>
                        <!-- profesori sau profesor-->
                        <div class="profesori">
                            <h3>Profesor (i)</h3>
							<?foreach( getTeachersAssignedToCourse($teachers_ids) as $teacher):?>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="profesor">
                                <div class="col-xs-4">
									<a href="<?=$teacher['art_url']?>" class="text-center">
										<img src="<?=$teacher['image_url']?>" class="img-responsive img-circle">
									</a>
								</div>
                                <div class="col-xs-12">
                                    <h5><small><?=$teacher['function']?></small><br><a href="<?=$teacher['art_url']?>"><?=$teacher['name']?></a></h5>
                                    <p>
                                        <?=$teacher['description']?>
                                    </p>
                                </div>
                            </div>
							<?php endforeach;?>
                            <div class="clearfix"></div>
                        </div>
						
						 <?php if ( teacher_registration_widget_can_be_displayed() ) :?>
						<div class="weneedyou text-center">
                            <a href="<?=site_url()?>/contact/#profesor">
                                <img src="<?=get_template_directory_uri()?>/assets/images/weNeedYou.jpg" alt="Esti profesor? Locul tau este aici!" class="img-responsive">
                            </a>
                            <p class="lead">Ai un proiect interesant?</p>
                            <a href="<?=site_url()?>/contact/#profesor" class="btn btn-lg btn-ghost-type_two">contacteaza-ne rapid</a>
                        </div>
						<?php endif;?>
						
                    </div>
					<?php endwhile;?>
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
                    <div class="modal-body">
                        <p>Iconitele de mai jos reprezinta categoriile de virsta in modul urmator:</p>
                        <div class="pull-left">3-7 ani</div>
                        <div class="pull-right a">
                            <!--?xml version="1.0" encoding="utf-8"?-->
                            <svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">
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
                            </svg>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-left">8-12 ani</div>
                        <div class="pull-right b">
                            <!--?xml version="1.0" encoding="utf-8"?-->
                            <svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">
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
                            </svg>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-left">peste 12 ani</div>
                        <div class="pull-right c">
                            <!--?xml version="1.0" encoding="utf-8"?-->
                            <svg class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 121.9 66">
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
                            </svg>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Inchide fereastra</button>
                    </div>
                </div>
            </div>
        </div>
		<script type="text/javascript">
			var ajaxurl = '<?=admin_url('admin-ajax.php'); ?>';
			var buf_rum_c_name = '<?=session_id() ? session_id() : ""?>';
		</script>
        <!-- START HP newsletter -->
        <?php render_hp_newsletter()?>
        <!-- END HP newsletter -->

        <!-- START HP newsletter -->
        <?php render_newsletter_popup()?>
        <!-- END HP newsletter -->

        <?php render_footer()?>

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