<?php
/**
 * Template Name: Contact
 *
 * @package WordPress
 * @subpackage Bufnita
 * @since Twenty Fourteen 1.0
 */
require get_template_directory() . '/inc/render_sections.php';
include get_template_directory() . '/inc/preprocessing_form_contact.php';?>
<?php get_header(); ?>
    <section class="form">
        <div class="container-fluid">
            <div class="col-xs-12">
                <p class="text-center">Puteti sa ne contactati telefonic la numarul: <a href="tel:0751-02-03-62">0751.02.03.62</a></p>
                <!-- title Post-->
                <h1 class="text-center">Formular contact<br><small>vom incerca sa va raspundem cit mai prompt la sugestii</small></h1>
            </div>
        </div>
        <div class="container contactForm">
            <div class="row">
                <div class="row">
                    <?php if ( $returned_message ) :?>
                        <?=$returned_message?>
                    <?php endif;?>
                </div>
                <div class="col-xs-12 col-md-9">
                    <!-- Nav tabs-->
                    <ul role="tablist" class="nav nav-tabs">
                        <li role="presentation" class="active"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab" aria-expanded="true">Contact</a></li>
                        <li role="presentation" class=""><a href="#profesor" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Profesor Contact</a></li>
                    </ul>
                    <!-- Tab panes-->
                    <div class="tab-content">
                        <div role="tabpanel" id="contact" class="tab-pane active"><br>
                            <form method="post" class="contact-form" action="/contact/" data-toggle="validator">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="Numele" class="control-label">Numele dumneavoastra</label>
                                            <input required name="full_name" type="input" id="Numele1" placeholder="numele complet va rugam" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email de contact" class="control-label">Email</label>
                                            <input required name="email" type="input" id="email1" placeholder="email de contact" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefon" class="control-label">Telefon</label>
                                            <input required name="phone" type="input" id="telefon1" placeholder="telefon sau mobil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="control-label">Mesajul dumnevoastra</label>
                                            <textarea required name="message" rows="8" placeholder="sau daca aveti alte observatii..." class="form-control"></textarea>
                                        </div>
                                    </div>
									<div class="col-xs-12 col-sm-12">
										<div class="form-group">
											<div class="checkbox">
												<label>
													<input type="checkbox" checked="checked" name="newsletter">Sunt de acord sa ma inscriu la update-uri pe email
												</label>
											</div>
										</div>
									</div>
                                    <div class="col-xs-12 text-center sectionPadding"><a href="#" class="btn btn-lg btn-ghost-type_two submit-form-btn">Trimite mesajul</a></div>
                                    <div class="col-xs-12 text-center sectionPadding">
                                        <p>Va multumim pentru ca ne-ati contactat</p>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="client"/>
                            </form>
                        </div>
                        <div id="profesor" role="tabpanel" class="tab-pane"><br>
                            <form enctype="multipart/form-data" method="post" class="contact-form" action="/contact/" data-toggle="validator">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="Numele" class="control-label">Numele dumneavoastra</label>
                                            <input required name="full_name" type="input" id="Numele2" placeholder="numele complet va rugam" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email de contact" class="control-label">Email</label>
                                            <input required name="email" type="input" id="email2" placeholder="email de contact" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefon" class="control-label">Telefon</label>
                                            <input required name="phone" type="input" id="telefon2" placeholder="telefon sau mobil" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="control-label">Mesajul dumnevoastra</label>
                                            <textarea required name="message" rows="8" placeholder="sau daca aveti alte observatii..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="projectPrez">Incarca fisier*</label>
                                            <input type="file" id="projectPrez" name="presentation_file">
                                            <p class="help-block">Daca ai o prezentare (pdf, powerpoint sau alt format) noi o vom analiza cu mare atentie.</p>
                                            <p class="help-block">Fisierele atasate trebuie sa fie de maxim <?=ini_get("upload_max_filesize")?>.</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 text-center sectionPadding"><a href="#" class="btn btn-lg btn-ghost-type_two submit-form-btn">Trimite mesajul</a></div>
                                    <div class="col-xs-12 text-center sectionPadding">
                                        <p>Va multumim pentru ca ne-ati contactat</p>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="teacher"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="weneedyou text-center">
                        <a class="trigger-teacher" href="#profesor">
                            <img src="<?=get_template_directory_uri()?>/assets/images/weNeedYou.jpg" alt="Esti profesor? Locul tau este aici!" class="img-responsive">
                        </a>
                        <p class="lead">Ai un proiect interesant?</p>
                        <a href="#profesor" class="btn btn-lg btn-ghost-type_two trigger-teacher">Contacteaza-ne rapid</a>
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
    <script src="<?php echo get_template_directory_uri()?>/assets/javascripts/bootstrap.min.js"></script>
    <!-- yamm-->
    <script src="<?php echo get_template_directory_uri()?>/assets/javascripts/yamm.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/assets/javascripts/validator.min.js"></script>
	<script>
		(function($) {
			$('.submit-form-btn').on('click', function(e){
				e.preventDefault();
                $(this).nearest(".contact-form").submit();
			});
		})(jQuery);
        jQuery(document).ready(function(){
            var hashContact = window.location.hash;
            if (hashContact)
                $('.nav-tabs a[href="' + hashContact + '"]').tab('show');

            $('.trigger-teacher').click(function(e){
                e.preventDefault();
                $('.nav-tabs a[href="' + $(this).attr('href') + '"]').tab('show');
            });
        })
	</script>
	<script src="<?php echo plugins_url( 'buf_rum_newsletter/js/buf_rum_script.js'); ?>"></script>
    <script src="<?php echo plugins_url( 'buf_rum_newsletter/js/jquery.nearest.min.js'); ?>"></script>
	<?php wp_footer();?>
  </body>
</html>