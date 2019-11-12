<?php 
/*Template Name: Podcasts Page */
get_header(); ?>
<div class="boxed  no-padding">
	<div class="album-block">
		 <?php 
		$l_series = WMHelper::getSeries( array('number' => 1) );
		$l_series = current($l_series['terms']);
		?>
		<?php if( $l_series  ):  ?>
			<?php
			$series_thumb = ''; //default/fallback  image
			if ( $l_series->term_image ) {
				$series_thumb_data = wp_get_attachment_image_src( $l_series->term_image, 'wm-topic' );
				$series_thumb = isset($series_thumb_data[0]) ? $series_thumb_data[0] : $series_thumb;
			}
			$spotify = WMHelper::get_term_meta_url( $l_series->term_id, 'wm_series_soptify' ); 
			$apple = WMHelper::get_term_meta_url( $l_series->term_id, 'wm_series_apple' );
			$itunes = WMHelper::get_term_meta_url( $l_series->term_id, 'wm_series_itunes' );
			$series_title = $l_series->name;
			?>
			<div class="sm-wrapp">
				<div class="album-data">
					<div class="image-side-album" style="<?php echo 'background-image:url(\''. $series_thumb .'\');'?>">
					</div>
					<div class="content-side-album podcast-metadata">
						<?php echo sprintf( '<h2 class="entry-title">%s</h2>', $series_title ); ?>
						<p><?php _e('By:'); ?> <?php echo WMHelper::get_term_meta_text( $l_series->term_id, 'wm_series_host' ); ?></p>
						<p><?php echo $l_series->count; ?> <?php _e('Episodes'); ?></p>
						<span>
							<ul style="margin-left:0;">
								<li style="padding-left:0;"><?php _e('Find Us On:'); ?></li>
								<li><a href="<?php echo esc_attr($spotify); ?>"><?php _e('Spotify'); ?></a></li>
								<li><a href="<?php echo esc_attr($apple); ?>"><?php _e('Apple Music'); ?></a></li>
								<li><a href="<?php echo esc_attr($itunes); ?>"><?php _e('iTunes'); ?></a></li>
							</ul>
						</span>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		<?php endif; ?>
	</div>
	<div class="clearfix"></div>
	<div class="sm-wrapp">
		<div class="section-album">
			<div class="row">
				<div class="col-sm-12">
					<div class="data-with-post margin-20 entry-content">
						<h4><?php _e('About this Podcast'); ?></h4>
						<?php echo wpautop($l_series->description); ?>
					</div><!-- .entry-content -->
				</div>
			</div>
			<h2 class="section_heading"><?php _e('Podcast Library'); ?></h2>
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
                        <?php $recent_posts  = WMHelper::getSeries( array('order' => 'DESC') ); ?>
						<?php if( $recent_posts['total'] > 0  ): ?>
							<?php foreach( $recent_posts['terms'] as $series_term ): ?>
								<?php get_template_part( 'template-parts/post/archive', 'series' ); ?>
							<?php endforeach;?>
						<?php endif; ?>
						<?php if ( $recent_posts['pages'] > 1 ): ?>      
						<div class="text-center margin-40 wm_loadmore_archive_all">
							<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tax="series" data-load-tab="series" data-load-order="DESC"><?php _e('Load More'); ?></a>
						</div>
						<?php endif; ?>  
                    </div>
                    <div class="tab-pane fade" id="oldest" role="tabpanel" aria-labelledby="oldest-tab">
                        <?php $old_posts  = WMHelper::getSeries( array('order' => 'ASC') ); ?>
						<?php if( $old_posts['total'] > 0  ): ?>
							<?php foreach( $old_posts['terms'] as $series_term ): ?>
								<?php get_template_part( 'template-parts/post/archive', 'series' ); ?>
							<?php endforeach;?>
						<?php endif; ?>
						<?php if ( $old_posts['pages'] > 1 ): ?>      
						<div class="text-center margin-40 wm_loadmore_archive_all">
							<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tax="series" data-load-tab="series" data-load-order="ASC"><?php _e('Load More'); ?></a>
						</div>
						<?php endif; ?>  
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>   
<?php get_footer(); ?>