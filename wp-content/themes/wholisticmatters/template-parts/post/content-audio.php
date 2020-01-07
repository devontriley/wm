<?php
/**
 * Template part for displaying audio posts
 *
 */
$meta_prefix = WM_META_PREFIX;
$host_name = rwmb_meta( $meta_prefix.'podcast_host' ); 
$podcast_file = WMHelper::get_podcast_url(); 
$podcast_file_ogg = WMHelper::get_podcast_url('ogg'); 

$ep_length .= WMHelper::get_post_listen_time(get_the_ID());

$terms = get_the_terms( get_the_ID(), 'series' );
$term = array_pop($terms);

$spotify = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_soptify' ); 
$apple = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_apple' );
$itunes = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_itunes' );

$series_thumb = ''; //default/fallback  image
if ( $term->term_image ) {
    $series_thumb_data = wp_get_attachment_image_src( $term->term_image, 'full' );
	$series_thumb = isset($series_thumb_data[0]) ? $series_thumb_data[0] : $series_thumb;
}

$spotify = rwmb_meta( $meta_prefix.'podcast_spotify' ); 
$apple = rwmb_meta( $meta_prefix.'podcast_apple' ); 
$itunes = rwmb_meta( $meta_prefix.'podcast_itunes' ); 

$is_premium = rwmb_meta( $meta_prefix.'is_premium' ); 
if($is_premium && !is_user_logged_in()){
	$podcast_file = '';//hide premium url
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="album-block">
		<?php do_action('wm_floating_links'); ?>
		<div class="sm-wrapp">
			<div class="album-data">
				<div class="image-side-album" style="<?php echo 'background-image:url(\''. $series_thumb .'\');'?>">
				</div>
				<div class="content-side-album podcast-metadata">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<p><?php _e('Series:'); ?> <?php echo $term->name;  ?></p>
					<p><?php _e('Host:'); ?> <?php echo WMHelper::get_term_meta_text( $term->term_id, 'wm_series_host' ); ?></p>
					<span><a href="<?php echo $podcast_file; ?>" target="_blank"><?php _e('Download'); ?></a></span> <span>
						<ul>
							<li><?php _e('Find Us On:'); ?></li>
							<li><a target="_BLANK" rel="noreferrer noopener" href="https://open.spotify.com/show/3l2qY0hjwTgJyNS7zDn0NT"><?php _e('Spotify'); ?></a></li>
							<li><a target="_BLANK" rel="noreferrer noopener" href="https://podcasts.apple.com/us/podcast/wholistic-matters-podcast-series/id1312406856"><?php _e('Apple Music'); ?></a></li>
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
			<div class="audio-album">
				<?php echo do_shortcode('[audio mp3="'. $podcast_file .'" ogg="'. $podcast_file_ogg .'"][/audio]'); ?>
			</div>
			<div class="entry-header">
				<div class="detail-head">
					<?php
					/* translators: used between list items, there is a space after the comma */
					$separate_meta = __( ' • ' );
					// Get Categories for posts.
					$categories_list = get_the_category_list( $separate_meta );

					// Get Tags for posts.
					$tags_list = get_the_tag_list( '', $separate_meta );
					?>
					<div class="row">
						<div class="col-sm-6">
							<span class="pmeta_key_topics">Key Topics: <?php echo $categories_list;?></span>
						</div>
						<div class="col-sm-6 text-right">
							<span><?php the_date(); ?> • <?php echo $ep_length; ?></span>
						</div>
					</div>
				</div>
				<?php if($tags_list): ?>
				<div class="row article-tags">
					<div class="col-sm-12">
						<div class="tags">
							<span><img src="<?php echo get_template_directory_uri(); ?>/images/tag-ico.svg" alt="image"></span> 
							<span class="pmeta_tags">
								<?php echo $tags_list; ?>
							</span>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="short-btn single-post-links">
							<?php do_action('wm_single_share'); ?>
						</div>
					</div>
				</div>
			</div><!-- .entry-header -->
			
			<div class="row">
				<div class="col-sm-12">
					<div class="data-with-post margin-20 entry-content">
						<?php the_post_thumbnail('full'); ?>
						<h4><?php _e('About this Episode'); ?></h4>
						<?php
						/* translators: %s: Name of current post */
						the_content( sprintf(
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>' ),
							get_the_title()
						) );

						wp_link_pages( array(
							'before'      => '<div class="page-links">' . __( 'Pages:' ),
							'after'       => '</div>',
							'link_before' => '<span class="page-number">',
							'link_after'  => '</span>',
						) );
						?>
					</div><!-- .entry-content -->
				</div>
			</div>
			
			<?php 
			global $post;
			$related_posts  = new WP_Query( array(
				'post_type' => 'post',
				'posts_per_page' => 5,
				'post_status' => 'publish',
				'post__not_in' => array( get_the_ID() ),
				'orderby' => 'rand', // date?
				'tax_query' => array( //only default format
					'relation' => 'AND',
					array(                
						'taxonomy' => 'series',
						'field' => 'term_id',
						'terms' =>  array($term->term_id)
					),
					array(                
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array( 
							'post-format-audio'
						),
						'operator' => 'IN'
					)
				)
			) );
			?>
			<?php if( $related_posts->have_posts()  ): ?>
			<div class="row related-posts">
				<div class="col-sm-12">
					<div class="inner-heading">
						<h2 class="section_heading"><?php _e('Related Episodes'); ?></h2>
						<a href="<?php echo get_term_link($term->slug, 'series'); ?>"><?php _e('View All Podcast Episodes >'); ?></a>
					</div>
					<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
						<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
					<?php endwhile;?>
				</div>
			</div>
			<?php wp_reset_postdata();  ?>
			<?php endif; ?>
			
		</div>
	</div>
</article><!-- #post-## -->
