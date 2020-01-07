<div class="wm_popup_modal wm_access_popup js_wm_access_popup" >
	<div class="wm_popup_modal_content">
		<div class="wm_popup_wrap">
			<div class="wm_popup_bg"></div>
			<div class="wm_popup_content">
				<a href="#." class="wm_close" title="<?php echo esc_attr(__('Click to close', 'wholistic-matters')); ?>">
					<img src="<?php bloginfo('template_url'); ?>/images/close-x.png" alt="close" >
				</a>
				<h3 class="wm_popup_title"><?php _e('Create a free account to use our great bookmarking tool', 'wholistic-matters'); ?></h3>
				<p><?php _e('Once your account is created, you\'ll be able to save and organize what matters to you!', 'wholistic-matters'); ?></p>
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