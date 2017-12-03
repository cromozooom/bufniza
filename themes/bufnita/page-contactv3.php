<?php
/**
 * Template Name: ContactV3
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
                <hr>
                <h4>Telefon</h4>
                <p>Puteti sa ne contactati telefonic la numarul:</p><a href="tel:0751-02-03-62">0751.02.03.62</a>
                <hr>
                <h4>Sau prin email</h4>
                <p>completati formularul de&nbsp;<a href="#form"><strong>mai jos</strong></a></p><small>vom incerca sa va raspundem cit mai promt la sugestii</small>
            </div>
            <div class="col-xs-12 col-md-6">
                <iframe width="100%" height="450" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2851.017971437764!2d26.117649315764606!3d44.39175281237619!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b1fe4238c67be1%3A0x42dac8cb33f3e51!2sBufnita+din+tei!5e0!3m2!1sen!2suk!4v1456166986782" frameborder="0" style="border:0" allowfullscreen=""></iframe>
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
                            <?php echo do_shortcode('[contact-form-7 id="821" title="Contact Form" html_class="contact-form"]'); ?>
                        </div>
                        <div id="profesor" role="tabpanel" class="tab-pane"><br>                            
                            <?php echo do_shortcode('[contact-form-7 id="829" title="Profesor" html_class="contact-form"]'); ?>
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