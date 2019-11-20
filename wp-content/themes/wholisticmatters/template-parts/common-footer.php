<?php
if(!is_page(array(98, 101, 102, 103, 104, 105, 597, 2428))) {
    get_template_part( 'template-parts/newsletter-signup' );
}

$pagesWithStickyFooter = array(101/*member-login*/);
?>

<footer <?php if(in_array(get_the_ID(), $pagesWithStickyFooter)){ echo 'class="footer-sticky"'; } ?>>
	<div class="container-fluid">
		<div class="row align-items-end">
			<div class="col-md-4">
				<div class="footer_menu">
					<?php
						wp_nav_menu( array(
						  'theme_location' => 'footer',
						  'container'      => false,
						  'menu_class'     => 'footer-nav',
						  'fallback_cb'    => '__return_false',
						  'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						  'depth'          => 1,
					   ) );
					?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="footer_logo_icon"><a href="<?php echo site_url('/'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/footer-icon.png" class="img-fluid d-block mx-auto" alt="Wholistic Matters" /></a></div>
				<p class="text-center">Powered by: Standard Process</p>
				<p class="text-center">Copyright WholisticMatters 2019</p>
			</div>
			<div class="col-md-4">
				<?php
				$wm_settings = Wholistic_Matters::get_settings();
				$wm_social_links = ( isset( $wm_settings['wm_social_links'] ) && is_array($wm_settings['wm_social_links']) ) ? $wm_settings['wm_social_links'] : array();
				?>
				<?php if(count($wm_social_links)): ?>
				<div class="social_icons">
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
                        <li>
                            <a href="https://youtube.com/wholisticmatters" target="_blank" rel="nofollow">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/youtube.png" alt="youtube" class="sim">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/youtube-ac.png" alt="youtube" class="act">
                            </a>
                        </li>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>