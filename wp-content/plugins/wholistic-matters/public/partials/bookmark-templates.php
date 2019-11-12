<script type="text/html" id="tmpl-wm-accordion-folder">
	<div class="card wm_my_folder">
		<div class="card-header <# if(data.is_collapsed){ #>collapsed<# } #>" id="wm_folder_{{data.id}}" data-toggle="collapse" data-target="#wm_collapse_folder_{{data.id}}" aria-expanded="<# if(data.is_collapsed){ #>false<# }else{ #>true<# } #>" aria-controls="wm_collapse_folder_{{data.id}}">
			<h5 class="mb-0">
				<button class="btn btn-link collapsed">
					<span id="wm_folder_name_{{data.id}}">{{data.folder_name}}</span> (<span class="js_mybookmarks_count">{{data.count}}</span>)
				</button>
			</h5>
			<# if( data.default_folder_id == 0 || data.id != data.default_folder_id ){ #>
			<ul>
				<li>
					<a href="#." class="wm_svg_edit_btn js_wm_toggle_subactions js_wm_edit_folder" data-folder_id="{{data.id}}"><?php echo file_get_contents( get_stylesheet_directory_uri() . '/images/edit.svg' ); ?></a>
					<ul class="wm_action_actions">
						<li><a href=".js_wm_edit_folder[data-folder_id='{{data.id}}']" class="js_wm_trigger js_wm_edit_folder_cancel" data-trigger="click">Cancel</a></li>
						<li><a href="#." class="color-primary js_wm_edit_folder_save" data-folder_id="{{data.id}}">Save</a></li>
					</ul>
				</li>
				<li>
					<a href="#." class="wm_svg_trash_btn js_wm_toggle_subactions js_wm_delete_folder" data-folder_id="{{data.id}}"><?php echo file_get_contents( get_stylesheet_directory_uri() . '/images/trash.svg' ); ?></a>
					<ul class="wm_action_actions">
						<li><a href=".js_wm_delete_folder[data-folder_id='{{data.id}}']" class="js_wm_trigger js_wm_delete_folder_cancel" data-trigger="click">Cancel</a></li>
						<li><a href="#." class="color-danger js_wm_delete_folder_confirm" data-folder_id="{{data.id}}">Confirm Delete</a></li>
					</ul>
				</li>
			</ul>
			<# } #>
		</div>
		<div id="wm_collapse_folder_{{data.id}}" class="collapse <# if(!data.is_collapsed){ #>show<# } #>" aria-labelledby="wm_folder_{{data.id}}" data-parent="#accordion">
			<div class="card-body">
				{{{data.bookmarks}}}
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tmpl-wm-folder-popup">
	<div class="wm-popup-folder" id="wm_folder_{{data.id}}">
		<button class="btn btn-link js_wm_popup_add_bookmark <# if( data.bookmark_in_folder ){ #>added<# } #>" data-folder_id="{{data.id}}" <# if( data.bookmark_in_folder ){ #>title="<?php echo __('Bookmark already added to this folder. Click to remove bookmark from this folder.'); ?>"<# } #>>
			<# if( data.bookmark_in_folder ){ #>
			<span title="<?php echo __('Bookmark already added to this folder. Click to remove bookmark from this folder.'); ?>" class="wm_folder_bookmark_added"></span>
			<# } #>
			<span id="wm_folder_name_{{data.id}}">{{data.folder_name}}</span> (<span class="js_mybookmarks_count">{{data.count}}</span>)
		</button>
	</div>
</script>

<script type="text/html" id="tmpl-wm-bookmark">
	<div class="wm_my_bookmark box-feature {{data.item_type}}" id="my_bookmark_{{data.bookmark_id}}">
		<# if(data.item_image){ #>
		<div class="image-side">
			<img src="{{data.item_image}}" alt="{{data.item_title}}">
			<# if(data.item_type == 'document'){ #>
				<a href="{{data.item_link}}" class="icon-feature"><i class="icon-wrapp"><img src="<?php echo get_template_directory_uri(); ?>/images/document-down.svg" alt="View"></i></a>
			<# } #>
			<# if(data.item_type == 'audio'){ #>
				<a href="{{data.item_link}}" class="icon-feature"><i class="icon-wrapp"><img src="<?php echo get_template_directory_uri(); ?>/images/audio.svg" alt="Play"></i></a>
			<# } #>
			<# if(data.item_type == 'video'){ #>
				<a href="{{data.item_link}}" class="icon-feature"><i class="icon-wrapp"><img src="<?php echo get_template_directory_uri(); ?>/images/play-icon.svg" alt="Play"></i></a>
			<# } #>
		</div>
		<# } #>
		<div class="feature-data">
			<h2><a href="{{data.item_link}}">{{data.item_title}}</a></h2>
			<p>{{data.item_desc}}</p>
			<span class="datetime wm_post_meta"><# if(data.item_type_label){ #>{{{data.item_type_label}}} • <# } #>{{data.item_date}}<# if(data.item_length){ #> • {{{data.item_length}}}<# } #></span>
			<a href="#." class="wm_svg_bookmark_btn js_wm_add_bookmark bookmarked" data-folder_id="{{data.folder_id}}" data-object_id="{{data.object_id}}" data-bookmark_id="{{data.bookmark_id}}" data-object_type="{{data.object_type}}"><?php echo file_get_contents( get_stylesheet_directory_uri() . '/images/Bookmark.svg' ); ?></a>
			<# if(data.is_premium == 'yes'){ #>
			<span class="badge"><?php _e('PREMIUM'); ?></span>
			<# } #>
		</div>
	</div>
</script>
