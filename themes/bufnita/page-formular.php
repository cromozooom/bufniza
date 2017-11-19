<?php
/**
 * Template Name: Formular
 *
 * @package WordPress
 * @subpackage Bufnita
 * @since Twenty Fourteen 1.0
 */
require get_template_directory() . '/inc/render_sections.php';
include get_template_directory() . '/inc/preprocessing_form.php';?>
<?php get_header(); ?>
        <section class="form">
            <div class="container-fluid">
                <div class="col-xs-12">
                    <!-- title Post-->
                    <h1 class="text-center">Formular de inscriere<br><small>ideal ar fi sa completati formularul de mai jos</small></h1>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <form method="post" id="contact-form" action="/formular/" data-toggle="validator">
						<?php if ( $returned_message ) :?>
						<div class="row">
							<?=$returned_message?>
						</div>
						<?php endif;?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h3 class="text-center">Datele dumneavoastra</h3>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group has-feedback">
                                        <label for="Numele" class="control-label">Numele dumneavoastra</label>
                                        <input name="full_name" type="input" placeholder="numele complet va rugam" class="form-control Numele input-lg" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group has-feedback">
                                        <label for="Email" class="control-label">Email</label>
                                        <input name="email" type="email" placeholder="email de contact" class="form-control Email input-lg" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="Tel" class="control-label">Telefon</label>
                                        <input name="phone" type="input" placeholder="telefon fix sau mobil" class="form-control Tel input-lg" required>
                                    </div>
                                </div>
								<div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" checked="checked" name="newsletter">Sunt de acord sa ma inscriu la update-uri pe email
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 sectionPadding">
                                    <h3 class="text-center" class="control-label">Datele Copilului</h3>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="Prenumele" class="control-label">Prenumele</label>
                                        <input required name="child_last_name" type="input" id="Prenumele copilului" placeholder="prenumele copilului" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="dataNastere" class="control-label">Data de nastere a copilului</label>
                                        <input required name="child_birthday" type="input" id="dataNastere" placeholder="in acest format dd/mm/yyyy" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="vista" class="control-label">Categoria de varsta</label>
                                        <select required name="child_category" id="child_category" class="form-control">
                                            <option value="">Alege categoria de varsta</option>
                                            <option value="mic">5-7 ani</option>
                                            <option value="mijlociu">8-12 ani</option>
                                            <option value="mare">12-14 ani</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="control-label">Ce pasiuni are copilul dumneavoastra?</label>
                                        <textarea required name="child_description" rows="8" placeholder="sau daca aveti alte observatii..." class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 sectionPadding">
                                    <h3 class="text-center"> Optiuni pentru acesta activitate</h3>
                                </div>
								<?php render_dummy_form_footer($data_from_course["render_footer_dummy"]);?>
                                <?php foreach ( array('mic', 'mijlociu', 'mare') as $group) :?>
								<?php render_footer_form($group, $data_from_course, $data_from_course["render_footer_{$group}"]);?>
								<?php endforeach;?>
								
								<div class="col-xs-8 col-sm-offset-4 col-sm-4" style="padding-top:10px;">
									<div class="g-recaptcha" data-sitekey="6LfE5QwTAAAAADlSDsLRCsODreMQK-nedb7Lda2K"></div>
								</div>
                                <div class="col-xs-12 text-center sectionPadding">
									<a href="" id="contact-form-submit" class="btn btn-lg btn-ghost-type_two">Inscrie-te acum</a>
								</div>
                            </div>
							<div class="row">
                                <input type="hidden" name="course_post_id" value="<?=$data_from_course["id"]?>" />
								<input type="hidden" name="c" value="<?=$data_from_course["c"]?>" />
                            </div>
                        </form>
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

        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="<?php echo get_template_directory_uri()?>/assets/javascripts/bootstrap.min.js"></script>
		<script src="<?php echo get_template_directory_uri()?>/assets/javascripts/moment.min.js"></script>
		<script src="<?php echo get_template_directory_uri()?>/assets/javascripts/datepicker.min.js"></script>
		<script src="<?php echo get_template_directory_uri()?>/assets/javascripts/validator.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js"></script>
		
        <!-- yamm-->
        <script src="<?php echo get_template_directory_uri()?>/assets/javascripts/yamm.js"></script>
        <script src="<?php echo plugins_url( 'buf_rum_newsletter/js/buf_rum_script.js'); ?>"></script>
        <script src="<?php echo plugins_url( 'buf_rum_newsletter/js/jquery.nearest.min.js'); ?>"></script>
		<script>
			(function($) {
				$('#dataNastere').datetimepicker({format: 'DD-MM-YYYY'});
				$('#contact-form-submit').on('click', function(e){
					e.preventDefault();
					$('*[class*="week_"]').filter(":hidden").children('label').children("input[type='checkbox']").attr("disabled", "disabled");
					$('*[class*="schedule_"]').filter(":hidden").children('label').children("input[type='checkbox']").attr("disabled", "disabled");
					$('#contact-form').submit();
				});
				$("#child_category").on('change', function(e) {
					sel_val = $(this).val();
					$('*[class*="week_"]').css("display","none");
					$('*[class*="schedule_"]').css("display","none");
					if (sel_val)
						$(".week_"+sel_val+", .schedule_"+sel_val).css("display","block");
					else 
						$('*[class*="schedule_dummy"], *[class*="week_dummy"]').css("display","block");
				});
			})(jQuery)
		</script>
		<?php wp_footer();?>
    </body>
</html>