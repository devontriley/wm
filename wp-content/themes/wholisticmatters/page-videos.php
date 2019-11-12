<?php 
/*Template Name: Videos Page */

$meta_prefix = '_wm_';
get_header(); ?>
<div class="boxed">
	<div class="container">
		 <?php 
		$recent_post = WMHelper::getRecentPosts( 'video' ); 
		?>
		<?php if( $recent_post->have_posts()  ):  ?>
			<?php while ( $recent_post->have_posts() ) : $recent_post->the_post(); ?>
				<?php 
				$watch_time = rwmb_meta( $meta_prefix.'mins_to_watch' );
				$watch_time = !empty($watch_time) ? $watch_time : '1';
				$watch_time .= ' '.__('min watch');
				$read_time = $watch_time;
				?>
			<h2 class="section_heading"><?php _e('Latest Video'); ?></h2><br>
			<div class="row archive_recent_posts">
				<div class="col-sm-12 col-md-6">
					<?php the_post_thumbnail('full'); ?>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="feature-data">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo WM_get_post_excerpt( get_the_excerpt(), 300 ); ?></p>
						<span class="datetime"><?php the_author(); ?> • <?php echo get_the_date(); ?> <?php if(!empty($read_time)): ?>• <?php echo $read_time; ?><?php endif; ?></span>
						<div class="short-btn">
							<?php do_action('wm_single_share'); ?>
						</div>
						<!--<span class="badge">PREMIUM</span>-->
					</div>
				</div>
			</div>
			<?php endwhile;?>
			<?php wp_reset_postdata();  ?>
		<?php endif; ?>
		<div class="row">
            <div class="col-md-12 col-lg-7">
				<h2 class="section_heading"><?php _e('Video Library'); ?></h2>
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
							<?php $recent_posts  = WMHelper::getPosts( 'video', array('order' => 'DESC') ); ?>
							<?php if( $recent_posts->have_posts()  ): ?>
								<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
									<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
								<?php endwhile;?>
							<?php wp_reset_postdata();  ?>
							<?php endif; ?>
							<?php if ( $recent_posts->max_num_pages > 1 ): ?>      
							<div class="text-center margin-40 wm_loadmore_archive_all">
								<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tab="video" data-load-order="DESC"><?php _e('Load More'); ?></a>
							</div>
							<?php endif; ?>  
						</div>
						<div class="tab-pane fade" id="oldest" role="tabpanel" aria-labelledby="oldest-tab">
							<?php $old_posts  = WMHelper::getPosts( 'video', array('order' => 'ASC') ); ?>
							<?php if( $old_posts->have_posts()  ): ?>
								<?php while ( $old_posts->have_posts() ) : $old_posts->the_post(); ?>
									<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
								<?php endwhile;?>
							<?php wp_reset_postdata();  ?>
							<?php endif; ?>
							<?php if ( $old_posts->max_num_pages > 1 ): ?>      
							<div class="text-center margin-40 wm_loadmore_archive_all">
								<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tab="video" data-load-order="ASC"><?php _e('Load More'); ?></a>
							</div>
							<?php endif; ?>  
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-5 articles-secton">
                <div class="article-block">
                     <?php if (function_exists('wpp_get_mostpopular')): ?>
                    <div class="head-section">
                        <h2>Trending Videos</h2>
                    </div>
                    <div class="body-section">
                       <?php
                            $args = array(
                                'post_format' => 1,
                                'limit' => 5,
                                'stats_date' => 1,
                                'stats_author' => 1,
                                'range' => 'all',
                                'post_type' => 'post,post_format_video',
                                'wpp_start' => '<ul class="wm-wpp-trending">',
                                'post_html' => '<li class="box-article">'
                                . '<span class="numbers"></span>'
                                . '<span>{title} <br> <i class="wm-trending-meta">{author} • {date}</i></span>'
                                . '</li>'
                            );
                            wpp_get_mostpopular($args);
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
		</div>
	</div>
</div>   
<?php get_footer(); ?>