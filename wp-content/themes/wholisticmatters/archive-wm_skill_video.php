<?php 
$meta_prefix = WM_META_PREFIX;
?>
<?php get_header(); ?>
<div class="boxed">
	<div class="sm-wrapp">
		 <?php 
		$recent_post = WMHelper::getRecentPosts( 'skill_video', array('post_type' => 'wm_skill_video') ); 
		?>
		<?php if( $recent_post->have_posts()  ):  ?>
			<?php while ( $recent_post->have_posts() ) : $recent_post->the_post(); ?>
				<?php 
				$watch_time = rwmb_meta( $meta_prefix.'mins_to_watch' );
				$watch_time = !empty($watch_time) ? $watch_time : '1';
				$watch_time .= ' '.__('min watch');
				$read_time = $watch_time;
				$embed_video_type = rwmb_meta( $meta_prefix.'embed_video'  ); 
				if($embed_video_type == $meta_prefix.'embed_video1') {
					$embed_video = rwmb_meta( $meta_prefix.'embed_video1'  ) ;
				}else{
					$videos = rwmb_meta( $meta_prefix.'embed_video2', array( 'limit' => 1 ) );
					$video = reset( $videos );
					$embed_video = do_shortcode('[video src="'.$video['src'].'" ]');
				}
				?>
			<h2 class="section_heading"><?php _e('Latest Skill'); ?></h2><br>
			<div class="row archive_recent_posts">
				<div class="col-sm-12">
					<?php  if(!empty($embed_video)){
						echo $embed_video;
					}else{
						echo '<a href="'.get_the_permalink().'">';
							the_post_thumbnail('full'); 
						echo '</a>';
					} ?>
				</div>
				<div class="col-sm-12">
					<div class="feature-data fw-feature-data">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo WM_get_post_excerpt( get_the_excerpt(), 300 ); ?></p>
						<span class="datetime"><?php the_author(); ?> • <?php echo get_the_date(); ?> <?php if(!empty($read_time)): ?>• <?php echo $read_time; ?><?php endif; ?></span>
						<div class="short-btn">
							<?php do_action('wm_single_share'); ?>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile;?>
			<?php wp_reset_postdata();  ?>
		<?php endif; ?>
		<div class="row">
            <div class="col-md-12">
				<h2 class="section_heading"><?php _e('All Skill Videos'); ?></h2>
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
						</ul>
					</span>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade active show" id="recent" role="tabpanel" aria-labelledby="recent-tab">
							<?php $recent_posts_args  = array('post_type' => 'wm_skill_video', 'order' => 'DESC'); ?>
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
							<?php $old_posts_args  = array('post_type' => 'wm_skill_video', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'views_total'); ?>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>   

<?php get_footer(); ?>