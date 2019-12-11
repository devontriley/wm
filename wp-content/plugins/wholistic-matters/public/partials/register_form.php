<?php 
$wm_settings = Wholistic_Matters::get_settings();
$signup_para = ( isset( $wm_settings['signup_para'] ) && $wm_settings['signup_para'] ) ? $wm_settings['signup_para'] : '';	

$custom_meta_fields = WMHelper::get_custom_user_meta_fields();
$is_popup = isset($attributes['display']) && in_array(trim(strtolower($attributes['display'])), array('popup','modal'));
$container_style = '';
if( $is_popup ){
	//$container_style = 'style="display: none;"';
}
$user_role = isset($_REQUEST['user_role']) ? $_REQUEST['user_role'] : 'hcp'; 
?>
<div class="signUpScreen <?php if($is_popup): ?>signUpScreenPopup<?php endif ?>" <?php echo $container_style; ?>>
    <div class="content-side">
        <div class="data-wrapp">
             <a href="<?php echo home_url('/'); ?>"> 
				 <img src="<?php bloginfo('template_url'); ?>/images/wm-logo.svg" width="415" alt="signup-logo" style="margin-bottom:1em;">
             </a>
			<?php echo wpautop($signup_para); ?>
        </div>
    </div>
    <div class="form-side">
		<?php if($is_popup): ?>
            <a href="#." class="closeModal">
                <img src="<?php bloginfo('template_url'); ?>/images/close.png" alt="close">
            </a>
		<?php endif ?>

        <div class="form-image">
            <picture>
                <source srcset="<?php bloginfo('template_directory'); ?>/images/signup.jpg" media="(min-width: 992px)" />
                <img src="<?php bloginfo('template_directory'); ?>/images/signup-mobile.jpg" />
            </picture>
        </div>

        <div class="form-wrapp">
            <div class="inner-wrapp">

                <img src="<?php bloginfo('template_url'); ?>/images/wm-logo.svg" width="415" alt="signup-logo" class="mobile-logo">

                <h2><?php _e( 'Create Your Account:', 'wholistic-matters' ); ?></h2>

				<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
					<?php foreach ( $attributes['errors'] as $error ) : ?>
						<p class="login-error">
							<?php echo $error; ?>
						</p>
					<?php endforeach; ?>
				<?php endif; ?>

                <form id="signupForm<?php if($is_popup): ?>Popup<?php endif ?>" class="signupForm" action="<?php echo wp_registration_url(); ?>" method="post">
                    <div class="Data-one">
                        <div class="row">
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="first_name" class="bmd-label-floating"><?php _e( 'First Name', 'wholistic-matters' ); ?></label>
                                    <input type="text" name="first_name" class="form-control" id="first_name">
                                </fieldset>
                            </div>
                            <div class="col-sm-6">
                                <fieldset class="form-group">
                                    <label for="last_name" class="bmd-label-floating"><?php _e( 'Last Name', 'wholistic-matters' ); ?></label>
                                    <input type="text" name="last_name" class="form-control" id="last_name">
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    <label for="email" class="bmd-label-floating"><?php _e( 'Email Address', 'wholistic-matters' ); ?></label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    <label for="user_pass_reg" class="bmd-label-floating"><?php _e( 'Password', 'wholistic-matters' ); ?></label>
                                    <input type="password" name="password" class="form-control" id="user_pass_reg">
                                    <i class="password-show" data-password-field="#user_pass_reg"><img src="<?php bloginfo('template_url'); ?>/images/show-pass.png" alt="show-pass"></i>
                                    <span><?php _e( 'Please use 8 or more characters with a mix of letters, numbers & symbols', 'wholistic-matters' ); ?></span>
                                </fieldset>
                            </div>
                        </div>
                        <?php do_action('wm_register_fields'); ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group margin-fix">
                                    <div class="checkbox-btn">
                                        <input id="_wm_newsletter" type="checkbox" name="_wm_newsletter" value="yes" checked><label for="_wm_newsletter"><?php echo $custom_meta_fields['_wm_newsletter']['label']; ?></label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group margin-0">
                                    <label class="label-control"><?php _e( 'I am a:', 'wholistic-matters' ); ?></label>
                                    <div class="checkbox-btn">
                                        <input id="user_role_hcp" type="radio" name="user_role" value="hcp" class="user_role hcp" <?php echo checked($user_role, 'hcp', false); ?>><label for="user_role_hcp">Healthcare Practitioner</label>
                                        <input id="user_role_non_hcp" type="radio" name="user_role" value="non-hcp" <?php echo checked($user_role, 'non-hcp', false); ?> class="user_role non-hcp"><label for="user_role_non_hcp">Nutrition Enthusiast</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    
                    <div id="continue-data" style="display:none;">
                        <?php
                        $hcp_type_field = $custom_meta_fields['_wm_hc_professional_type'];
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select class="form-control" name="_wm_hc_professional_type" id="_wm_hc_professional_type">
                                        <?php
                                        print('<option value="">Select '.$hcp_type_field['label'].'</options>');
                                        if(isset($hcp_type_field['options']) && is_array($hcp_type_field['options'])){
                                            foreach ($hcp_type_field['options'] as $opt_val => $opt_lbl) {
                                                $opt_selected = '';
                                                print('<option value="'.$opt_val.'" '.$opt_selected.'>'.$opt_lbl.'</options>');
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                         <?php
                        $degrees_field = $custom_meta_fields['_wm_degrees'];
                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="label-control"><?php _e( 'Optional', 'wholistic-matters' ); ?>*</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $degrees_field['label']; ?>" name="_wm_degrees[]" style="margin-bottom: 5px;"/>
                                    <a href="#." class="link-text js_wm_clone" data-tmpl="wm-clone-degree" data-tmpl-data="{}" data-max="7">+ <?php _e('Add Another Degree'); ?></a>
                                    <script type="text/html" id="tmpl-wm-clone-degree">
                                        <input type="text" class="form-control" placeholder="<?php echo $degrees_field['label']; ?>" name="_wm_degrees[]" style="margin-bottom: 5px;"/>
                                    </script>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="City" name="_wm_city">
                                </div>
                            </div>
                             <?php
                            $state_field = $custom_meta_fields['_wm_state'];
                            ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control">
                                        <?php
                                        print('<option value="">Select '.$state_field['label'].'</options>');
                                        if(isset($state_field['options']) && is_array($state_field['options'])){
                                            foreach ($state_field['options'] as $opt_val => $opt_lbl) {
                                                $opt_selected = '';
                                                print('<option value="'.$opt_val.'" '.$opt_selected.'>'.$opt_lbl.'</options>');
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <fieldset class="form-group">
                                    <input type="submit" class="btn btn-theme-fix" value="<?php _e( 'Finish', 'wholistic-matters' ); ?>">
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="finish">
                        <div class="col-sm-12">
                            <fieldset class="form-group register_legal_info">
                                <input type="submit" class="btn btn-theme-fix" value="<?php _e( 'Finish', 'wholistic-matters' ); ?>">
								<small class="legal_info_txt">By clicking "Finish" you agree to the  <a href="<?php echo esc_url( site_url('/legal') ); ?>" target="_blank">Terms & Conditions</a></small>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row" id="continue" style="display:none;">
                        <div class="col-sm-12">
                            <fieldset class="form-group register_legal_info">
                                <a href="#." class="btn btn-theme-fix" id="continue-next"><?php _e( 'Continue', 'wholistic-matters' ); ?></a>
								<small class="legal_info_txt">By clicking "Continue" you agree to the  <a href="<?php echo esc_url( site_url('/legal') ); ?>" target="_blank">Terms & Conditions</a></small>
                            </fieldset>
                        </div>
                    </div>
                    
                    <!-- Honeypot -->
                    <input type="text" style="border:none;height:0;font-size:0;position:absolute;left:-9999px;" id="foobar" name="foobar" placeholder="Foobar" autocomplete="off">

                </form>
            </div>
        </div>
    </div>
</div>