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
            <form id="lostpasswordform" method="post" action="<?php echo wp_lostpassword_url(); ?>">
                <fieldset class="form-group <?php echo isset($_GET['email']) && !empty($_GET['email']) ? 'is-focused' : ''; ?>">
                    <label for="user_login" class="bmd-label-floating"><?php _e( 'Email', 'wholistic-matters' ); ?></label>
                    <input type="email" class="form-control" id="user_login" name="user_login" tabindex="1" required value="<?php echo isset($_GET['email']) ? esc_attr($_GET['email']) : ''; ?>">
                </fieldset>
                <fieldset class="form-group text-center">
					<p class="description indicator-hint">
					<?php
						_e(
							"Enter your email address and we'll send you a link you can use to reset your password.",
							'wholistic-matters'
						);
					?>
					</p>
                </fieldset>
                <fieldset class="form-group with-link text-center">
                    <input type="submit" class="btn btn-theme-fix" value="Send Confirmation" tabindex="3">
                </fieldset>
            </form>
        </div>

    </div>
</div>