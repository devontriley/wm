<div class="shortLinks my-2 my-lg-0 wm_nav_secondary_links">
    <ul>
		<?php if(!is_search()):  ?>
        <li class="search-head">
			<a href="Javascript:;">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Searchicon.svg" alt="Search" class="wm_open_search">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/close-x.png" alt="Close Search" class="wm_close_search">
			</a>
		</li>
		<?php endif; ?>
        <?php if( is_user_logged_in() ): ?>
                <?php $current_user = wp_get_current_user(); ?>
                <li>
                    <a href="<?php echo site_url('/member-account'); ?>">Hi <?php echo $current_user->display_name; ?>&nbsp;&nbsp;<i class="fas fa-user-circle fa-lg"></i></a>
                    &nbsp;&nbsp;<a href="<?php echo esc_url( wp_logout_url(site_url('/member-account')) ); ?>" class="logout_button"><?php _e('Logout'); ?></a>
                </li>
        <?php else: ?>
                <li><a href="<?php echo wp_login_url( WM_get_current_url() ); ?>" class="login_popup login_button"><?php _e('Login'); ?></a></li>
                <li><a href="<?php echo esc_url( wp_registration_url() ); ?>" class="btn btn-theme signup_popup signup_button"><?php _e('Sign Up'); ?></a></li>
        <?php endif; ?>
    </ul>
</div>