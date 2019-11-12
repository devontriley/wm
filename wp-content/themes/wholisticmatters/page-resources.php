<?php 
/*Template Name: Resources Page */

$meta_prefix = WM_META_PREFIX;
get_header(); ?>
<div class="boxed">
	<div class="sm-wrapp">
		 <?php 
		$recent_post = WMHelper::getRecentPosts( 'pdf' ); 
		?>
		<?php if( $recent_post->have_posts()  ):  ?>
			<?php while ( $recent_post->have_posts() ) : $recent_post->the_post(); ?>
				<?php 
				$read_time = WMHelper::get_post_read_time(get_the_ID());
				$is_premium = rwmb_meta( $meta_prefix.'is_premium' );
				$embed_files = rwmb_meta( $meta_prefix.'embed_file', array( 'limit' => 1 )  ); 
				$embed_file = reset( $embed_files );
				$is_premium = rwmb_meta( $meta_prefix.'is_premium' ); 
				if($is_premium && !is_user_logged_in()){
					$embed_file['url'] = '';//hide premium url
				}
				?>
			<h2 class="section_heading"><?php _e('Latest Resource'); ?></h2><br>
			<div class="row archive_recent_posts">
				<div class="col-sm-12 col-md-5">
					<?php the_post_thumbnail('full'); ?>
				</div>
				<div class="col-sm-12 col-md-7">
					<div class="feature-data">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo WM_get_post_excerpt( get_the_excerpt(), 300 ); ?></p>
						<span class="datetime"><?php the_author(); ?> • <?php echo get_the_date(); ?> <?php if(!empty($read_time)): ?>• <?php echo $read_time; ?><?php endif; ?></span>
						<div class="short-btn">
							<?php do_action('wm_single_share'); ?>
							<?php if($is_premium): ?>
								<span class="badge"><?php _e('PREMIUM'); ?></span>
							<?php endif; ?>
						</div>
						<a href="<?php echo esc_url($embed_file['url']); ?>" class="btn btn-theme-fix margin-20" download>Download</a>
					</div>
				</div>
			</div>
			<?php endwhile;?>
			<?php wp_reset_postdata();  ?>
		<?php endif; ?>
		<div class="row">
            <div class="col-md-12">
				<h2 class="section_heading"><?php _e('Resource Library'); ?></h2>
				<div class="tabs-me full-w wm-archive-tabs">
					<span class="tabs_links_lbl">Sort By:</span>
					<span class="tabs-links">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active show" id="recent-tab" data-toggle="tab" href="#recent" role="tab" aria-controls="recent" aria-selected="true">Recent</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="oldest-tab" data-toggle="tab" href="#oldest" role="tab" aria-controls="oldest" aria-selected="false">Oldest</a>
							</li>
						</ul>
					</span>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade active show" id="recent" role="tabpanel" aria-labelledby="recent-tab">
							<?php $recent_posts  = WMHelper::getPosts( 'pdf', array('order' => 'DESC') ); ?>
							<?php if( $recent_posts->have_posts()  ): ?>
								<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
									<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
								<?php endwhile;?>
							<?php wp_reset_postdata();  ?>
							<?php endif; ?>
							<?php if ( $recent_posts->max_num_pages > 1 ): ?>      
							<div class="text-center margin-40 wm_loadmore_archive_all">
								<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tab="pdf" data-load-order="DESC"><?php _e('Load More'); ?></a>
							</div>
							<?php endif; ?>  
						</div>
						<div class="tab-pane fade" id="oldest" role="tabpanel" aria-labelledby="oldest-tab">
							<?php $old_posts  = WMHelper::getPosts( 'pdf', array('order' => 'ASC') ); ?>
							<?php if( $old_posts->have_posts()  ): ?>
								<?php while ( $old_posts->have_posts() ) : $old_posts->the_post(); ?>
									<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
								<?php endwhile;?>
							<?php wp_reset_postdata();  ?>
							<?php endif; ?>
							<?php if ( $old_posts->max_num_pages > 1 ): ?>      
							<div class="text-center margin-40 wm_loadmore_archive_all">
								<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tab="pdf" data-load-order="ASC"><?php _e('Load More'); ?></a>
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