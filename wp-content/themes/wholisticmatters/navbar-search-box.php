<?php
global $wp_query;
$sel_p_types = isset($wp_query->query['post_type']) ? $wp_query->query['post_type'] : array();
$sel_p_formats = isset($_REQUEST['media']) && is_array($_REQUEST['media']) ? array_map('sanitize_text_field', $_REQUEST['media']) : array();
$sel_main_topics = isset($_REQUEST['key_topic']) && is_array($_REQUEST['key_topic']) ? array_map('sanitize_text_field', $_REQUEST['key_topic']) : array();
$sel_spot_topics = isset($_REQUEST['spotlight_topic']) && is_array($_REQUEST['spotlight_topic']) ? array_map('sanitize_text_field', $_REQUEST['spotlight_topic']) : array();

$wm_s_query = isset($_REQUEST['wm_s_query']) ? htmlspecialchars(json_encode($_REQUEST['wm_s_query']), ENT_QUOTES, 'UTF-8') : '';
//print_r($wp_query->query);
?><div class="search-box">
	<form role="search" method="get" class="wp-search-form" action="<?php echo home_url( '/' ); ?>">
		<input type="hidden" value="<?php echo $wm_s_query; ?>" id="wm_s_query" />
		<div class="search-form">
			<a href="#." class="close-search"><img src="<?php bloginfo('template_url'); ?>/images/close-x.png" alt="close"></a>
			<div class="row">
				<div class="col-sm-12">
					<input type="text" name="s" class="form-control" placeholder="<?php _e('Enter search here...'); ?>" value="<?php the_search_query(); ?>">
					<a href="#." class="short_link_search"><?php _e('Advanced Search Options'); ?></a>
					<input type="submit" class="btn btn-theme-fix" value="<?php _e('Search'); ?>">
				</div>
			</div>

		</div>
		<div class="advance-search">
			<div class="search-form">
				<p><?php _e('Refine your search:'); ?></p>
				<div class="row">
					<div class="col-sm-4">
						<h3><?php _e('Key Topics'); ?></h3>
						<?php
						$main_terms = get_terms( 'category' );
						if ( ! empty( $main_terms ) && ! is_wp_error( $main_terms ) ): ?>
							<?php 
							foreach ( $main_terms as  $main_term ): 
								if ( $main_term->term_id == 1 ){
									continue; // skip 'uncategorized'
								}
								?>
								<div class="checkbox-btn">
									<input id="main_term_<?php echo $main_term->term_id; ?>" type="checkbox" name="key_topic[]" value="<?php echo $main_term->slug; ?>" <?php checked( in_array($main_term->slug, $sel_main_topics) ); ?>> <label for="main_term_<?php echo $main_term->term_id; ?>"><?php echo $main_term->name; ?></label>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div class="col-sm-4">
						<h3><?php _e('Spotlight Topics'); ?></h3>
						<?php
						$spotlight_terms = get_terms( 'spotlight-topic' );
						if ( ! empty( $spotlight_terms ) && ! is_wp_error( $spotlight_terms ) ): ?>
							<?php foreach ( $spotlight_terms as  $spotlight_term ):  ?>
								<div class="checkbox-btn">
									<input id="main_term_<?php echo $spotlight_term->term_id; ?>" type="checkbox" name="spotlight_topic[]" value="<?php echo $spotlight_term->slug; ?>" <?php checked( in_array($spotlight_term->slug, $sel_spot_topics) ); ?>> <label for="main_term_<?php echo $spotlight_term->term_id; ?>"><?php echo $spotlight_term->name; ?></label>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div class="col-sm-4">
						<h3><?php _e('Media Type'); ?></h3>
						<div class="checkbox-btn">
							<input id="post_format_article" type="checkbox" name="media[]" value="article" <?php checked( in_array('article', $sel_p_formats) || (in_array('post', $sel_p_types) && count($sel_p_formats) == 0) );?>><label for="post_format_article"><?php _e('Article'); ?></label>
						</div>
						<div class="checkbox-btn">
							<input id="post_format_video" type="checkbox" name="media[]" value="video" <?php checked( in_array('video', $sel_p_formats) || (in_array('post', $sel_p_types) && count($sel_p_formats) == 0) );?>><label for="post_format_video"><?php _e('Video'); ?></label>
						</div>
						<div class="checkbox-btn">
							<input id="post_format_audio" type="checkbox" name="media[]" value="audio" <?php checked( in_array('audio', $sel_p_formats) || (in_array('post', $sel_p_types) && count($sel_p_formats) == 0) );?>><label for="post_format_audio"><?php _e('Podcast'); ?></label>
						</div>
						<div class="checkbox-btn">
							<input id="post_format_link" type="checkbox" name="media[]" value="link" <?php checked( in_array('link', $sel_p_formats) || (in_array('post', $sel_p_types) && count($sel_p_formats) == 0) );?>><label for="post_format_link"><?php _e('PDF Resources'); ?></label>
						</div>
						<!--
						<div class="checkbox-btn">
							<input id="post_type_recipe" type="checkbox" name="post_type[]" value="wm_recipe" <?php checked( in_array('wm_recipe', $sel_p_types) );?>><label for="post_type_recipe"><?php _e('Recipes'); ?></label>
						</div>
						-->
						<div class="checkbox-btn">
							<input id="post_type_skill" type="checkbox" name="post_type[]" value="wm_skill_video" <?php checked( in_array('wm_skill_video', $sel_p_types) );?>><label for="post_type_skill"><?php _e('Skill Videos'); ?></label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>