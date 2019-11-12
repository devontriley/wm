<div class="wm_to_bookmark_popup">
	<div class="wm_to_bookmark_popup_content">
		<div class="wm_to_bookmark_header">
			<span class="wm_svg_bookmark_btn bookmarked"><?php echo file_get_contents( get_stylesheet_directory_uri() . '/images/Bookmark.svg' ); ?></span> <span class="wm_a2b_popup_title" data-swap_value="<?php echo esc_attr(__('Create A Folder'))?>"><?php _e('Bookmark')?></span>
			<a href="#." class="wm_close" data-target="" title="Click to go back">
				<img src="<?php bloginfo('template_url'); ?>/images/close-x.png" alt="close" >
			</a>
		</div>
		<div class="wm_to_bookmark_body">
			<div class="js_create_new_folder wm_to_bookmark_folders" style="display: block;">
				<a href="#" class="btn btn-theme-fix js_wm_popup_add_bookmark js_wm_default_folder" >Quick Save</a>
				<p class="wm_to_bookmark_title_sm"><?php _e('Save To a Folder')?></p>
				<form>
				<div class="search-filter">
					<fieldset class="form-group">
						<label for="s_folders" class="bmd-label-floating">Search Folders</label>
						<input type="text" class="form-control js_search_folder" id="s_folders" name="s_folders">
					</fieldset>
					<i class="search-ico"><img src="<?php bloginfo('template_url'); ?>/images/search-ico.svg" alt="search-ico"></i>
				</div>
				</form>
				<div class="wm_my_bookmarks">
					<div class="js_wm_my_bookmarks wm_a2b_popup"></div>
					<p class="cbxwpbkmarkloading" style="text-align: center;"><img src="<?php echo plugins_url('../img/ajax-loader.gif', __FILE__); ?>" alt="Loading" title="<?php echo esc_html__('Loading', 'wholistic-matters'); ?>" /> </p>
				</div>
				<a href=".js_create_new_folder" class="btn btn-theme-fix wm_create_folder_toggle js_wm_toggle wm_a2b_popup">+ Create New Folder</a>
				<div class="js_create_folder_msg create_folder_msg text-center"></div>
			</div>
			<div class="js_create_new_folder wm_create_folder">
				<div class="wm_folder_name_field">
					<fieldset class="form-group" style="position: relative;">
						<label for="wm_folder_name" class="bmd-label-floating">Folder Name</label>
						<input type="text" name="folder_name" id="wm_folder_name" class="form-control" value="">
					</fieldset>
					<span class="wm_char_count">Character Count: <b class="js_char_count" data-char-count-field="#wm_folder_name">0</b></span>
				</div>
				<div class="wm_create_folder_actions">
					<a href="#" class="btn btn-theme-fix wm_create_folder_save js_wm_create_folder">Create & Save</a>
					<a href=".wm_create_folder_toggle" class="btn btn-theme-fix btn-gray wm_create_folder_cancel js_wm_trigger" style="display: none;" data-trigger="click">Cancel</a>
					<div class="js_create_folder_msg create_folder_msg text-center"></div>
				</div>
				<p class="cbxwpbkmarkloading" style="text-align: center;"><img src="<?php echo plugins_url('../img/ajax-loader.gif', __FILE__); ?>" alt="Loading" title="<?php echo esc_html__('Loading', 'wholistic-matters'); ?>" /> </p>
			</div>
		</div>
	</div>
</div>

<script type="text/html" id="tmpl-wm-toast">
	<h4><# if( data.operation == 1 ){ #><?php echo __('+ Added to'); ?><# }else{ #><?php echo __('- Removed from'); ?><# } #> “<span class="js_wm_toast_folder">{{data.folder_name}}</span>”</h4>
	<# if( data.operation == 1 ){ #>
	<a href="<?php echo site_url('/member-account'); ?>#wm_folder_{{data.folder_id}}"  class="js_wm_toast_folder_link">Go To Folder</a>
	<# } #>
</script>

<div class="Toasts js_wm_toasts"></div>