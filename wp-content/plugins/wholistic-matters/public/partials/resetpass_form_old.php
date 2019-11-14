<?php 
wp_enqueue_script('utils');
wp_admin_css( 'login', true );
wp_enqueue_script('user-profile'); 
?>


<div class="LoginScreen">
    <div class="login-wrapp">
        <a href="<?php echo home_url('/'); ?>"> 
            <img src="<?php bloginfo('template_url'); ?>/images/wm-logo.svg" alt="signup-logo" class="logo-log">
        </a>
        <br/>
        <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
			<?php foreach ( $attributes['errors'] as $error ) : ?>
				<p class="login-error">
					<?php echo $error; ?>
				</p>
			<?php endforeach; ?>
		<?php endif; ?>

        <div class="login-form">
            <?php
                $attributes['redirect'] = isset($attributes['redirect']) ? $attributes['redirect'] : ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
            ?>
            <form name="resetpassform" id="wm_resetpassform" method="post" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=resetpass', 'login_post' ) ); ?>"  autocomplete="off">
				<input type="hidden" name="rp_login" id="user_login" value="<?php echo esc_attr( $attributes['login'] ); ?>" autocomplete="off" />
                <fieldset class="form-group is-focused">
					<div class="user-pass1-wrap">
						<label for="pass1-text" class="bmd-label-floating"><?php _e( 'New password', 'wholistic-matters' ); ?></label>
						<div class="wp-pwd">
							<span class="password-input-wrapper">
								<input type="password" data-reveal="1" data-pw="<?php echo esc_attr( wp_generate_password( 16 ) ); ?>" name="pass1" id="pass1" class="input form-control" size="20" value="" autocomplete="off" aria-describedby="pass-strength-result"/>
							</span>
							<div id="pass-strength-result" class="hide-if-no-js" aria-live="polite"><?php _e( 'Strength indicator' ); ?></div>
						</div>
					</div>
                </fieldset>
                <fieldset class="form-group" style="margin: 0;">
					<p class="user-pass2-wrap">
						<label for="pass2" class="bmd-label-floating"><?php _e( 'Confirm new password' ) ?></label>
						<input type="password" name="pass2" id="pass2" class="input form-control" size="20" value="" autocomplete="off"/>
					</p>
                </fieldset>
                <fieldset class="form-group text-center" style="margin: 0;">
					<p class="description indicator-hint"><?php echo wp_get_password_hint(); ?></p>
                </fieldset>
				<br class="clear" />
				<?php
				/**
				 * Fires following the 'Strength indicator' meter in the user password reset form.
				 *
				 * @since 3.9.0
				 *
				 * @param WP_User $user User object of the user whose password is being reset.
				 */
				do_action( 'resetpass_form', $user );
				?>
                <fieldset class="form-group with-link text-center">
					<input type="hidden" name="rp_key" value="<?php echo esc_attr( $attributes['key'] ); ?>" />
                    <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-theme-fix" value="<?php esc_attr_e('Reset Password'); ?>" >
                </fieldset>
            </form>
        </div>

    </div>
</div>