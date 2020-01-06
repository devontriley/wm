<?php 
global $post,$wp_query;
$meta_prefix = WM_META_PREFIX;
$tax_term = get_queried_object();
$tax_lbls = get_taxonomy_labels(get_taxonomy($tax_term->taxonomy));
$tax_label = isset($tax_lbls->name) ? $tax_lbls->name : 'Archive';
$series_thumb = ''; //default/fallback  image
$series_cover = get_field('podcast_season_cover', $tax_term);
if ( $tax_term->term_image ) {
    $series_thumb_data = wp_get_attachment_image_src( $tax_term->term_image, 'wm-topic' );
	$series_thumb = isset($series_thumb_data[0]) ? $series_thumb_data[0] : $series_thumb;
}
$spotify = WMHelper::get_term_meta_url( $tax_term->term_id, 'wm_series_soptify' ); 
$apple = WMHelper::get_term_meta_url( $tax_term->term_id, 'wm_series_apple' );
$itunes = WMHelper::get_term_meta_url( $tax_term->term_id, 'wm_series_itunes' );

$series_title = get_the_archive_title();
$seasonNumber;

// query all seasons to get the correct season index
$seasons = WMHelper::getSeries(['orderby' => 'date']);
$seasons = $seasons['terms'];
$totalSeasons = count($seasons);

for ($i = 0; $i <= $totalSeasons; $i++) {
    $season = $seasons[$i];
    $seasonName = $season->name;
    $seasonIndex = ($totalSeasons - $i);
    if($seasonName == $series_title) {
        $seasonNumber = $seasonIndex;
    }
};
?>

<?php get_header(); ?>
<div class="boxed no-padding podcast-season-single">
	<div class="album-block">
		<?php do_action('wm_floating_links'); ?>
		<div class="sm-wrapp">
			<div class="album-data">
				<div class="image-side-album" style="<?php echo 'background-image:url(\''. $series_cover .'\');'?>">
				</div>
				<div class="content-side-album podcast-metadata">
                    <h2 class="entry-title">Season <?php echo($seasonNumber); ?>: <?php the_archive_title(); ?></h2>
					<p class="p_author"><?php _e('By:'); ?> <?php echo WMHelper::get_term_meta_text( $tax_term->term_id, 'wm_series_host' ); ?></p>
					<p class="p_count"><?php echo $tax_term->count; ?> <?php _e('Episodes'); ?></p>
					<span class="p_social_links">
						<ul style="margin-left:0;">
							<li style="padding-left:0;"><?php _e('Find Us On:'); ?></li>
							<li><a target="_BLANK" rel="noreferrer noopener" href="<?php echo esc_attr($spotify); ?>"><?php _e('Spotify'); ?></a></li>
							<li><a target="_BLANK" rel="noreferrer noopener" href="<?php echo esc_attr($apple); ?>"><?php _e('Apple Music'); ?></a></li>
                            <li><a target="_BLANK" rel="noreferrer noopener" href="https://play.google.com/music/m/Iexe42hoohnnqiqijbwdkwd6ldm?t=WholisticMatters_Podcast_Series"><?php _e('Google Play'); ?></a></li>
						</ul>
					</span>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	<div class="sm-wrapp">
		<div class="section-album">
			<div class="row">
				<div class="col-sm-12">
					<div class="data-with-post margin-20 entry-content">
						<h4><?php _e('About Season'); ?> <?php echo($seasonNumber); ?></h4>
						<?php the_archive_description(); ?>
					</div><!-- .entry-content -->
				</div>
			</div>
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
                        <?php $aud_posts  = WMHelper::getPosts( 'audio', array('order' => 'DESC') ); ?>
						<?php if( $aud_posts->have_posts()  ): ?>
							<?php while ( $aud_posts->have_posts() ) : $aud_posts->the_post(); ?>
								<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
							<?php endwhile;?>
						<?php wp_reset_postdata();  ?>
						<?php endif; ?>
						<?php if ( $aud_posts->max_num_pages > 1 ): ?>      
						<div class="text-center margin-40 wm_loadmore_archive_all">
							<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="audio" data-load-order="DESC"><?php _e('Load More'); ?></a>
						</div>
						<?php endif; ?>  
                    </div>
                    <div class="tab-pane fade" id="oldest" role="tabpanel" aria-labelledby="oldest-tab">
                        <?php $aud_posts  = WMHelper::getPosts( 'audio', array('order' => 'ASC') ); ?>
						<?php if( $aud_posts->have_posts()  ): ?>
							<?php while ( $aud_posts->have_posts() ) : $aud_posts->the_post(); ?>
								<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
							<?php endwhile;?>
						<?php wp_reset_postdata();  ?>
						<?php endif; ?>
						<?php if ( $aud_posts->max_num_pages > 1 ): ?>      
						<div class="text-center margin-40 wm_loadmore_archive_all">
							<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="audio" data-load-order="ASC"><?php _e('Load More'); ?></a>
						</div>
						<?php endif; ?>  
                    </div>
                </div>
            </div>
			

		</div>
	</div>
</div>   
<?php get_footer(); ?>