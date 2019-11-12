<?php 
$custom_meta_fields = WMHelper::get_custom_user_meta_fields();
?>

<div class="LoginScreen">
    <div class="header-login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?php echo home_url('/'); ?>"> <img src="<?php bloginfo('template_url'); ?>/images/login-sm-logo.png" alt="login-sm-logo"></a>
                </div>
                <div class="col-sm-6">
<!--                    <a href="#." class="closeModal">
                        <img src="<?php bloginfo('template_url'); ?>/images/close-x.png" alt="close">
                    </a>-->
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="login-wrapp">
        <a href="<?php echo home_url('/'); ?>"> 
            <img src="<?php bloginfo('template_url'); ?>/images/wm-logo.png" alt="signup-logo" class="logo-log">
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
                <fieldset class="form-group">
					<div class="user-pass1-wrap">
						<label for="pass1" class="bmd-label-floating"><?php _e( 'New password', 'wholistic-matters' ); ?></label>
						<input type="password" name="pass1" id="pass1" class="input form-control" size="20" value="" autocomplete="off" required/>
						<i class="password-show" data-password-field="#pass1"><img src="<?php bloginfo('template_url'); ?>/images/show-pass.png" alt="show-pass"></i>
					</div>
                </fieldset>
                <fieldset class="form-group" style="margin: 1em 0;">
					<div class="user-pass2-wrap">
						<label for="pass2" class="bmd-label-floating"><?php _e( 'Confirm new password' ) ?></label>
						<input type="password" name="pass2" id="pass2" class="input form-control" size="20" value="" autocomplete="off" required/>
						<i class="password-show" data-password-field="#pass2"><img src="<?php bloginfo('template_url'); ?>/images/show-pass.png" alt="show-pass"></i>
					</div>
                </fieldset>
                <fieldset class="form-group text-center" style="margin: 0 0 20px 0;">
					<p class="description indicator-hint"><?php _e( 'Please use 8 or more characters with a mix of letters, numbers & symbols', 'wholistic-matters' ); ?></p>
                </fieldset>
                <fieldset class="form-group text-center" style="margin: 0;">
                    <p><?php echo sprintf(__('By clicking "Update Your Password" you agree to the <a href="%s" target="_blank" style="color:inherit;text-decoration:underline;">Terms & Conditions</a>'), esc_url( site_url('/legal') )); ?></p>
					<!--
					<div class="checkbox-btn margin-10">
						<input id="_wm_legal_agreement" type="checkbox" name="_wm_legal_agreement" value="yes" <?php echo($custom_meta_fields['_wm_legal_agreement']['required'] == true ? 'required' : ''); ?>>
                        <label for="_wm_legal_agreement"><?php echo sprintf(__('By clicking "Update Your Password" you agree to the <a href="%s" target="_blank" style="color:inherit;text-decoration:underline;">Terms & Conditions</a>'), esc_url( site_url('/legal') )); ?>
                        </label>
					</div>
					-->
                </fieldset>
				<?php
				/**
				 * Fires following the 'Strength indicator' meter in the user password reset form.
				 *
				 * @since 3.9.0
				 *
				 * @param WP_User $user User object of the user whose password is being reset.
				 */
				//do_action( 'resetpass_form', $user );
				?>
                <fieldset class="form-group with-link text-center">
					<input type="hidden" name="rp_key" value="<?php echo esc_attr( $attributes['key'] ); ?>" />
                    <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-theme-fix" value="<?php esc_attr_e('Reset Password'); ?>" >
                </fieldset>
            </form>
        </div>

    </div>
</div>