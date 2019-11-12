	<?php do_action('wm_gated_content'); ?>
	<?php get_template_part('template-parts/common', 'footer'); ?>

    <!-- NEWSLETTER SIGNUP -->
    <div class="newsletter-modal">
        <div class="inner">
            <img src="<?php bloginfo('template_directory'); ?>/images/close-x.png" alt="close" class="close" />
            <?php get_template_part( 'template-parts/newsletter-signup' ); ?>
        </div>
    </div>

    <!-- PREMIUM SIGNUP MODAL -->
    <div class="premium-signup-modal">
        <div class="inner">
            <div class="copy-block px-4">
                <div class="container my-3 my-sm-5">
                    <div class="row align-items-center">
                        <div class="col-lg-7 p-4 p-sm-5 order-lg-2 content">
                            <p class="h1">Join Our Community to Read Further</p>
                            <p>This is a premium article created for our Healthcare Practitioner readers. Create a free account to continue reading and gain full access.</p>
                            <p class="text-center"><a href="#" class="btn btn-theme signup_popup">Create a Free Account</a></p>
                            <p class="text-center"><a href="#" class="close">Dismiss</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
  </body>
</html>