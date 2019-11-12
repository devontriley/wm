<?php 
$meta_prefix = WM_META_PREFIX;
?>
<?php get_header(); ?>
<div class="boxed">
	<div class="sm-wrapp">
		 <?php 
		$recent_post = WMHelper::getRecentPosts( 'recipe', array('post_type' => 'wm_recipe') ); 
		?>
		<?php if( $recent_post->have_posts()  ):  ?>
			<?php while ( $recent_post->have_posts() ) : $recent_post->the_post(); ?>
			<h2 class="section_heading"><?php _e('Latest Recipe'); ?></h2><br>
			<div class="row archive_recent_posts">
				<div class="col-sm-12">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
				</div>
				<div class="col-sm-12">
					<div class="feature-data fw-feature-data">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo WM_get_post_excerpt( get_the_excerpt(), 300 ); ?></p>
						<div class="short-btn">
							<?php do_action('wm_single_share'); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="btn btn-theme-fix margin-20"><?php _e('View Recipe'); ?></a>
					</div>
				</div>
			</div>
			<?php endwhile;?>
			<?php wp_reset_postdata();  ?>
		<?php endif; ?>
		<div class="row">
            <div class="col-md-12">
				<h2 class="section_heading"><?php _e('All Recipes'); ?></h2>
				<div class="tabs-me full-w wm-archive-tabs">
					<span class="tabs_links_lbl">Sort By:</span>
					<span class="tabs-links">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active show" id="recent-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="true">Recent</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="popular-tab" data-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="false">Popular</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="time_to_cook-tab" data-toggle="tab" href="#time_to_cook" role="tab" aria-controls="time_to_cook" aria-selected="false">Time to Cook</a>
							</li>
						</ul>
					</span>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade active show" id="recent" role="tabpanel" aria-labelledby="recent-tab">
							<?php $recent_posts_args  = array('post_type' => 'wm_recipe', 'order' => 'DESC'); ?>
							<?php $recent_posts_params  = htmlspecialchars(json_encode($recent_posts_args), ENT_QUOTES, 'UTF-8'); ?>
							<?php $recent_posts  = WMHelper::getAllPosts( $recent_posts_args ); ?>
							<?php if( $recent_posts->have_posts()  ): ?>
								<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
									<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
								<?php endwhile;?>
							<?php wp_reset_postdata();  ?>
							<?php endif; ?>
							<?php if ( $recent_posts->max_num_pages > 1 ): ?>      
							<div class="text-center margin-40 wm_loadmore_archive_all">
								<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tab="recent" data-params="<?php echo $recent_posts_params; ?>"><?php _e('Load More'); ?></a>
							</div>
							<?php endif; ?>  
						</div>
						<div class="tab-pane fade" id="popular" role="tabpanel" aria-labelledby="popular-tab">
							<?php $old_posts_args  = array('post_type' => 'wm_recipe', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'views_total'); ?>
							<?php $old_posts_params  = htmlspecialchars(json_encode($old_posts_args), ENT_QUOTES, 'UTF-8'); ?>
							<?php $old_posts  = WMHelper::getPosts( 'popular', $old_posts_args ); ?>
							<?php if( $old_posts->have_posts()  ): ?>
								<?php while ( $old_posts->have_posts() ) : $old_posts->the_post(); ?>
									<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
								<?php endwhile;?>
							<?php wp_reset_postdata();  ?>
							<?php endif; ?>
							<?php if ( $old_posts->max_num_pages > 1 ): ?>      
							<div class="text-center margin-40 wm_loadmore_archive_all">
								<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tab="popular" data-params="<?php echo $old_posts_params; ?>"><?php _e('Load More'); ?></a>
							</div>
							<?php endif; ?>  
						</div>
						<div class="tab-pane fade" id="time_to_cook" role="tabpanel" aria-labelledby="time_to_cook-tab">
							<?php $time_posts_args  = array('post_type' => 'wm_recipe', 'orderby' => 'meta_value_num', 'order' => 'ASC', 'meta_key' => $meta_prefix.'mins_to_cook'); ?>
							<?php $time_posts_params  = htmlspecialchars(json_encode($time_posts_args), ENT_QUOTES, 'UTF-8'); ?>
							<?php $time_posts  = WMHelper::getAllPosts( $time_posts_args ); ?>
							<?php if( $time_posts->have_posts()  ): ?>
								<?php while ( $time_posts->have_posts() ) : $time_posts->the_post(); ?>
									<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
								<?php endwhile;?>
							<?php wp_reset_postdata();  ?>
							<?php endif; ?>
							<?php if ( $time_posts->max_num_pages > 1 ): ?>      
							<div class="text-center margin-40 wm_loadmore_archive_all">
								<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tab="time_to_cook" data-params="<?php echo $time_posts_params; ?>"><?php _e('Load More'); ?></a>
							</div>
							<?php endif; ?>  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>   

<?php get_footer(); ?>