<?php
$custom_meta_fields = WMHelper::get_custom_user_meta_fields();
$userid = intval($attributes['user']);
$user_info = get_userdata( $userid );

$wm_settings = Wholistic_Matters::get_settings();

$bookmark_info = ( isset( $wm_settings['bookmark_info'] ) && $wm_settings['bookmark_info'] ) ? $wm_settings['bookmark_info'] : '';
?>
<div class="boxed">
	<!---Boxed-->
	<div class="sm-wrapp">
		<?php //do_shortcode('[wm-bookmark-btn]'); ?>
		<div class="bokmark-box">
			<h2 class="section_heading"><?php _e( 'Bookmarks', 'wholistic-matters' ); ?></h2>
			<?php echo wpautop($bookmark_info); ?>
			<a href=".js_create_new_folder" class="btn btn-theme-fix wm_create_folder_toggle js_wm_toggle">+ Create New Folder</a>
			<div class="js_create_new_folder wm_create_folder">
				<div class="wm_folder_name_field">
					<input type="text" name="folder_name" id="wm_folder_name" class="form-control" placeholder="New Folder Name" value="">
					<span class="wm_char_count">Character Count: <b class="js_char_count" data-char-count-field="#wm_folder_name">0</b></span>
				</div>
				<div class="wm_create_folder_actions">
					<a href="#" class="btn btn-theme-fix wm_create_folder_save js_wm_create_folder">Save</a>
					<a href=".wm_create_folder_toggle" class="btn btn-theme-fix btn-gray wm_create_folder_cancel js_wm_trigger" data-trigger="click">Cancel</a>
				</div>
				<p class="cbxwpbkmarkloading" style="text-align: center;"><img src="<?php echo plugins_url('../img/ajax-loader.gif', __FILE__); ?>" alt="Loading" title="<?php echo esc_html__('Loading', 'wholistic-matters'); ?>" /> </p>
			</div>
			<div class="js_create_folder_msg create_folder_msg"></div>
		</div>
		<div class="search-filter">
			<fieldset class="form-group">
				<label for="s_folders" class="bmd-label-floating">Search Folders</label>
				<input type="text" class="form-control js_search_folder" id="s_folders" name="s_folders">
			</fieldset>
			<i class="search-ico"><img src="<?php bloginfo('template_url'); ?>/images/search-ico.svg" alt="search-ico"></i>
		</div>
		<div class="wm_my_bookmarks">
			<div id="accordion" class="js_wm_my_bookmarks wm-a2b-account"></div>
			<p class="cbxwpbkmarkloading" style="text-align: center;"><img src="<?php echo plugins_url('../img/ajax-loader.gif', __FILE__); ?>" alt="Loading" title="<?php echo esc_html__('Loading', 'wholistic-matters'); ?>" /> </p>
		</div>
			<h2 class="section_heading"><?php _e( 'Account', 'wholistic-matters' ); ?> <a href="<?php echo esc_url( wp_logout_url() ); ?>" class="wm_account_logout_link">Logout</a></h2>
		<!-- Show errors if there are any -->
		<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
			<?php foreach ( $attributes['errors'] as $error ) : ?>
				<div class="alert alert-danger">
					<?php echo $error; ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if ( isset($attributes['updated']) && !empty($attributes['updated']) ) : ?>
				<div class="alert alert-success">
					<?php echo $attributes['updated']; ?>
				</div>
		<?php endif; ?>
		<form class="account-login" id="form-login-account" method="post">
			<div class="form-group">
				<label class="label-border" for="email_readonly"><?php _e( 'Email', 'wholistic-matters' ); ?> <a href=".js_wm_email_toggle_content" class="wm_account_email_toggle js_wm_toggle"><img src="<?php bloginfo('template_url'); ?>/images/edit.svg" alt="edit"></a></label>
				<input type="text" name="email" id="email_readonly" class="form-control" placeholder="Email Address" value="<?php echo esc_attr($user_info->user_email); ?>" readonly>
			</div>
			<div class="wm_account_update_fields js_wm_email_toggle_content" style="display: none;">
				<div class="row">
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="email_new" class="bmd-label-floating"><?php _e( 'New Email Address', 'wholistic-matters' ); ?></label>
							<input type="email" name="email_new" class="form-control" id="email_new">
						</fieldset>
					</div>
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="email_new2" class="bmd-label-floating"><?php _e( 'Confirm Email Address', 'wholistic-matters' ); ?></label>
							<input type="email" name="email_new2" class="form-control" id="email_new2">
						</fieldset>
					</div>
				</div>
				<div class="wm_update_account_actions">
					<a href="#" class="btn btn-theme-fix js_wm_account_email_update"><?php _e( 'Save', 'wholistic-matters' ); ?></a>
					<a href=".wm_account_email_toggle" class="btn btn-theme-fix btn-gray  wm_account_email_cancel js_wm_trigger" data-trigger="click" data-default_email="<?php echo esc_attr($user_info->user_email); ?>">Cancel</a>
				</div>
			</div>
			<div class="form-group">
				<label class="label-border" for="password_readonly"><?php _e( 'Password', 'wholistic-matters' ); ?> <a href=".js_wm_password_toggle_content" class="wm_account_password_toggle js_wm_toggle"><img src="<?php bloginfo('template_url'); ?>/images/edit.svg" alt="edit"></a></label>
				<input type="password" name="password"  id="password_readonly" class="form-control" placeholder="************" readonly disabled>
			</div>
			<div class="wm_account_update_fields js_wm_password_toggle_content" style="display: none;">
				<div class="row">
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="password1" class="bmd-label-floating"><?php _e( 'New Password', 'wholistic-matters' ); ?></label>
							<input type="password" name="password1" class="form-control" id="password1">
						</fieldset>
					</div>
					<div class="col-sm-6">
						<fieldset class="form-group">
							<label for="password2" class="bmd-label-floating"><?php _e( 'Confirm Password', 'wholistic-matters' ); ?></label>
							<input type="password" name="password2" class="form-control" id="password2">
						</fieldset>
					</div>
				</div>
				<div class="wm_update_account_actions">
					<a href="#" class="btn btn-theme-fix js_wm_account_password_update"><?php _e( 'Save', 'wholistic-matters' ); ?></a>
					<a href=".wm_account_password_toggle" class="btn btn-theme-fix btn-gray  wm_account_password_cancel js_wm_trigger" data-trigger="click">Cancel</a>
				</div>
			</div>
		   <div class="form-group">
			   <label class="label-border"><?php echo $custom_meta_fields['_wm_newsletter']['column']; ?></label>
			   <div class="checkbox-btn margin-10">
					<input id="_wm_newsletter" type="checkbox" name="_wm_newsletter" value="yes" <?php checked(get_user_meta($userid, '_wm_newsletter', true ), 'yes')?>><label for="_wm_newsletter"><?php echo $custom_meta_fields['_wm_newsletter']['label']; ?></label>
			   </div>
		   </div>
		   <div class="form-group">
			   <label class="label-border"><?php echo $custom_meta_fields['_wm_legal_agreement']['column']; ?></label>
			   <div class="checkbox-btn margin-10">
					<input id="_wm_legal_agreement" type="checkbox" name="_wm_legal_agreement" value="yes" <?php checked(get_user_meta($userid, '_wm_legal_agreement', true ), 'yes')?> <?php echo($custom_meta_fields['_wm_legal_agreement']['required'] == true ? 'required' : ''); ?>><label for="_wm_legal_agreement"><?php echo $custom_meta_fields['_wm_legal_agreement']['label']; ?></label>
			   </div>
		   </div>
		   <?php do_action('wm_account_fields', $attributes['user']); ?>
		   <div class="form-group">
			   <!-- Honeypot -->
				<input type="text" style="border:none;height:0;font-size:0;position:absolute;left:-9999px;" id="foobar" name="foobar" placeholder="Foobar" autocomplete="off">
			   <input type="submit" class="btn btn-theme-fix account-update-button" name="wm_account_update" value="<?php _e( 'Save Changes', 'wholistic-matters' ); ?>">
		   </div>
	   </form>
	</div>
</div>