<?php
$is_popup = isset($attributes['display']) && in_array(trim(strtolower($attributes['display'])), array('popup','modal'));
$container_style = '';
if( $is_popup ){
	//$container_style = 'style="display: none;"';
}
?>

<div class="LoginScreen <?php if($is_popup): ?>LoginScreenPopup<?php endif ?>" <?php echo $container_style; ?>>
    <div class="header-login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a href="<?php echo home_url('/'); ?>"> <img src="<?php bloginfo('template_url'); ?>/images/login-sm-logo.png" alt="login-sm-logo"></a>
                </div>
                <div class="col-sm-6">
					<?php if($is_popup): ?>
					<a href="#." class="closeModal">
						<img src="<?php bloginfo('template_url'); ?>/images/close-x.png" alt="close">
					</a>
					<?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="login-wrapp">
        <a href="<?php echo home_url('/'); ?>">
            <img src="<?php bloginfo('template_url'); ?>/images/wm-logo.svg" width="415" alt="signup-logo" class="logo-log">
        </a>
        
        <!-- Show errors if there are any -->
        <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
            <?php foreach ( $attributes['errors'] as $error ) : ?>
                <p class="login-error">
                    <?php echo $error; ?>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Show logged out message if user just logged out -->
        <?php if ( $attributes['logged_out'] ) : ?>
            <p class="login-info">
                <?php _e( 'You have signed out. Would you like to sign in again?', 'wholistic-matters' ); ?>
            </p>
        <?php endif; ?>

        <!-- Show success message if user just registered -->
        <?php if ( $attributes['registered'] ) : ?>
            <p class="login-info">
                <?php
                    printf(
                        __( 'You have successfully registered to <strong>%s</strong>. Please sign in using the form below:', 'wholistic-matters' ),
                        get_bloginfo( 'name' )
                    );
                ?>
            </p>
        <?php endif; ?>

        <!-- Show success message if user sent a password reset email -->
        <?php if ( $attributes['lost_password_sent'] ) : ?>
            <p class="login-info">
                <?php _e( 'Check your email for a link to reset your password.', 'wholistic-matters' ); ?>
            </p>
        <?php endif; ?>

        <!-- Show success message if user updated their password -->
        <?php if ( $attributes['password_updated'] ) : ?>
            <p class="login-info">
                <?php _e( 'Your password has been changed. You can sign in now.', 'wholistic-matters' ); ?>
            </p>
        <?php endif; ?>

        <!-- Hide form after reset password sent -->
        <?php if ( !$attributes['lost_password_sent'] ) : ?>
        <div class="login-form">
            <?php
                $attributes['redirect'] = isset($attributes['redirect']) ? $attributes['redirect'] : ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
            ?>
            <form id="LoginForm<?php if($is_popup): ?>Popup<?php endif ?>" class="LoginForm" method="post" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>">
                <fieldset class="form-group <?php echo isset($_REQUEST['registered']) && !empty($_REQUEST['registered']) ? 'is-focused' : ''; ?>">
                    <label for="user_login" class="bmd-label-floating"><?php _e( 'Email', 'wholistic-matters' ); ?></label>
                    <input type="text" class="form-control" id="user_login" name="log" tabindex="1" value="<?php echo isset($_REQUEST['registered']) && !empty($_REQUEST['registered']) ? esc_attr($_REQUEST['registered']) : ''; ?>">
                </fieldset>
                <fieldset class="form-group with-link">
                    <label for="user_pass" class="bmd-label-floating"><?php _e( 'Password', 'wholistic-matters' ); ?></label>
                    <a class="forgot_link" href="<?php echo wp_lostpassword_url(); ?>" tabindex="5">
                            <?php _e( 'Forgot Password?', 'wholistic-matters' ); ?>
                    </a>
                    <input type="password" name="pwd" class="form-control" id="user_pass" tabindex="2">
                    <i class="password-show" data-password-field="#user_pass" tabindex="4"><img src="<?php bloginfo('template_url'); ?>/images/show-pass.png" alt="show-pass"></i>
                </fieldset>
                <fieldset class="form-group with-link text-center">
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url( $attributes['redirect'] ); ?>" />
                    <input type="submit" class="btn btn-theme-fix" value="Sign In" tabindex="3">
                </fieldset>
                <fieldset class="form-group text-center">
                    <?php $registration_url_txt = sprintf( '<p>%s <a href="%s" class="signup_popup signup_button_2 link-primary" tabindex="6">%s</a></p>', __('Don\'t Have an Account yet? <br/>You can Sign Up', 'wholistic-matters'), esc_url( wp_registration_url() ), __( 'here.', 'wholistic-matters' ) ); ?>
                    <?php echo $registration_url_txt; ?>
                </fieldset>
            </form>
        </div>
        <?php endif; ?>

    </div>
</div>

