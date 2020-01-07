<div class="wm_popup_modal wm_access_tools_popup js_wm_access_tools_popup <?php if(isset($_REQUEST['is_premium']) && $_REQUEST['is_premium'] == '1'): ?>opened<?php endif; ?>">
	<div class="wm_popup_modal_content">
		<div class="wm_popup_wrap">
			<div class="wm_popup_bg"></div>
			<div class="wm_popup_content">
				<a href="#." class="wm_close" title="<?php echo esc_attr(__('Click to close', 'wholistic-matters')); ?>">
					<img src="<?php bloginfo('template_url'); ?>/images/close-x.png" alt="close" >
				</a>
				<h3 class="wm_popup_title"><?php _e('Are you a Healthcare Professional? Sign Up For Free Access!', 'wholistic-matters'); ?></h3>
				<p><?php _e('We\'ll verify your credentials and get you access to our great interactive tools.', 'wholistic-matters'); ?></p>
				<p><a href="<?php echo esc_url(wp_registration_url()); ?>" class="btn btn-theme-fix signup_popup"><?php echo __('Sign Up', 'wholistic-matters'); ?></a></p>
                <p class="fz-small-em">
                    Already have an Account? <a href="<?php bloginfo('url'); ?>/member-login">Login Here</a>
                </p>
				<br>
				<small>
					<?php _e('Click \'Sign Up\' above to accept Wholistic Matters\'s ', 'wholistic-matters'); ?>
					<?php echo sprintf( '<a href="%s">%s</a>', esc_url( site_url('/legal') ), __( 'Terms of Service', 'wholistic-matters' ) ); ?> & 
					<?php echo sprintf( '<a href="%s">%s</a>', esc_url( site_url('/legal') ), __( 'Privacy Policy', 'wholistic-matters' ) ); ?>.
					</small>
			</div>
		</div>
	</div>
</div>