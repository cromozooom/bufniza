<?php

/**

 * Template Name: ContactV2

 *

 * @package WordPress

 * @subpackage Bufnita

 * @since Twenty Fourteen 1.0

 */

require get_template_directory() . '/inc/render_sections.php';

include get_template_directory() . '/inc/preprocessing_form_contact.php';?>

<?php get_header(); ?>



<section id="contactmap" class="map">

    <div class="container">

      <div class="row">
        <div class="col-xs-12 col-md-6">
          <h4> Adresa mea este:</h4>
          <p>Sector 4,<br>Strada Serg. Nitu Vasile nr. 26,<br>etaj 1 - deasupra farmaciei Belladonna</p>
        </div>
        <div class="col-xs-12 col-md-6">
          <h4>Telefon</h4>
          <p>Puteti sa ne contactati telefonic la numarul:</p><a href="tel:0751-02-03-62">
            <h4>0751.02.03.62</h4></a>
        </div>
      </div>
      <div class="row">
        <hr>
        <div class="col-xs-12">
          <h4>Iata Cluburile noastre din Bucuresti</h4>
        </div>
        <div class="col-xs-12 col-md-6">
          <h5>Club Piata Sudului</h5>
          <iframe width="100%" height="450" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2851.017971437764!2d26.117649315764606!3d44.39175281237619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b1fe4238c67be1%3A0x42dac8cb33f3e51!2sBufnita+din+tei!5e0!3m2!1sen!2suk!4v1456166986782" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-xs-12 col-md-6">
          <h5>Club Cismigiu - sediul Mini-Stars Learning Center</h5>
          <iframe width="100%" height="450" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1007.2192734101138!2d26.086303837917267!3d44.43631466404844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x67f5e324685810f6!2sMini+Stars+Learning+Center!5e0!3m2!1sen!2suk!4v1490041902345" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>

    </div>

</section>





    <section class="form" id="form">

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

                <div class="col-xs-12 col-md-3">

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
