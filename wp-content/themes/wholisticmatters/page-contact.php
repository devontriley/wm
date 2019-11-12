<?php 
/*Template Name: Contact Us Page */

$wm_settings = Wholistic_Matters::get_settings();
get_header(); ?>
	<div class="signUpScreen contact-data">
        <div class="content-side">
            <div class="data-wrapp">
<!--                <h2>We're here to answer <br> your questions & hear <br> your ideas!</h2>-->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php endwhile; endif; ?> 

				<?php
				$wm_social_links = ( isset( $wm_settings['wm_social_links'] ) && is_array($wm_settings['wm_social_links']) ) ? $wm_settings['wm_social_links'] : array();
				?>
				<?php if(count($wm_social_links)): ?>
				<div class="social_icons">
					<p><?php _e('Connect with us on:'); ?></p>
					<ul>
						<?php if(isset($wm_social_links['fb']) && !empty($wm_social_links['fb'])): ?>
							<!--<li><a href="<?php echo esc_url($wm_social_links['fb']); ?>" target="_blank" rel="nofollow"><i class="fab fa-facebook-f"></i></a></li>-->
							<li>
								<a href="<?php echo esc_url($wm_social_links['fb']); ?>" target="_blank" rel="nofollow">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fb.png" alt="fb" class="sim">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/fb-ac.png" alt="fb" class="act">
								</a>
							</li>
						<?php endif; ?>
						<?php if(isset($wm_social_links['tw']) && !empty($wm_social_links['tw'])): ?>
							<!--<li><a href="<?php echo esc_url($wm_social_links['tw']); ?>" target="_blank" rel="nofollow"><i class="fab fa-twitter"></i></a></li>-->
							<li>
								<a href="<?php echo esc_url($wm_social_links['tw']); ?>" target="_blank" rel="nofollow">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/tw.png" alt="tw" class="sim">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/tw-ac.png" alt="tw" class="act">
								</a>
							</li>
						<?php endif; ?>
						<?php if(isset($wm_social_links['li']) && !empty($wm_social_links['li'])): ?>
							<!--<li><a href="<?php echo esc_url($wm_social_links['li']); ?>" target="_blank" rel="nofollow"><i class="fab fa-linkedin-in"></i></a></li>-->
							<li>
								<a href="<?php echo esc_url($wm_social_links['li']); ?>" target="_blank" rel="nofollow">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/li.png" alt="li" class="sim">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/li-ac.png" alt="li" class="act">
								</a>
							</li>
						<?php endif; ?>
						<?php if(isset($wm_social_links['insta']) && !empty($wm_social_links['insta'])): ?>
							<!--<li><a href="<?php echo esc_url($wm_social_links['insta']); ?>" target="_blank" rel="nofollow"><i class="fab fa-instagram"></i></a></li>-->
							<li>
								<a href="<?php echo esc_url($wm_social_links['insta']); ?>" target="_blank" rel="nofollow">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/in.png" alt="in" class="sim">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/in-ac.png" alt="in" class="act">
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
            </div>
        </div>
        <div class="form-side">
            <div class="form-wrapp">
                <div class="inner-wrapp">
                    <h2><?php _e('Contact Us:'); ?></h2>
					<div class="wm_error_msgs"></div>
                    <form id="contactForm" class="contactForm" action="<?php echo admin_url( 'admin-ajax.php'); ?>" method="post">
						<input name="action" value="wm_contact_form" type="hidden"/>
                        <div class="Data-one">
                            <div class="row">
                                <div class="col-sm-6">
                                    <fieldset class="form-group">
                                        <label for="exampleInputEmail1" class="bmd-label-floating"><?php _e('Name'); ?></label>
                                        <input type="text" name="contactName" class="form-control"
                                            id="exampleInputEmail1">
                                        <p>(<?php _e('min. 6 char'); ?>)</p>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6">
                                    <fieldset class="form-group">
                                        <label for="exampleInputEmail3" class="bmd-label-floating"><?php _e('Email'); ?></label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail3">
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        <label for="subject" class="bmd-label-floating"><?php _e('Subject'); ?></label>
                                        <input type="text" name="subject" class="form-control" id="subject">
                                        <p>(<?php _e('min. 6 char'); ?>)</p>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <fieldset class="form-group">
                                        <label for="message" class="bmd-label-floating"><?php _e('Message'); ?></label>
                                        <textarea class="form-control" name="message" id="message"></textarea>
                                    </fieldset>
                                </div>
                            </div>
							<div style="display:none;">
								<label for="wm_message2">Honeypot</label>
								<input type="text" name="wm_message2" id="wm_message2">
							</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    <input type="submit" class="btn btn-theme-fix" value="<?php _e('Send'); ?>">
                                </fieldset>
                            </div>
                        </div>
                    </form>
					<p class="cbxwpbkmarkloading" style="text-align: center;"><img src="<?php echo get_stylesheet_directory_uri().'/images/ajax-loader.gif'; ?>" alt="Loading" title="<?php echo esc_html__('Loading', 'wholistic-matters'); ?>" /> </p>
				</div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>