<?php
/**
 * Template part for displaying video posts
 *
 */
$meta_prefix = WM_META_PREFIX;
$feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$feat_image = $feat_image !== false ? $feat_image[0] : '';

$embed_video_type = rwmb_meta( $meta_prefix.'embed_video'  ); 
if($embed_video_type == $meta_prefix.'embed_video1') {
	$embed_video = rwmb_meta( $meta_prefix.'embed_video1'  ) ;
}else{
	$videos = rwmb_meta( $meta_prefix.'embed_video2', array( 'limit' => 1 ) );
	$video = reset( $videos );
	$embed_video = do_shortcode('[video src="'.$video['src'].'" ]');
}
$is_premium = rwmb_meta( $meta_prefix.'is_premium' ); 
$iconLink = '<a href="'.get_the_permalink().'" class="icon-feature"><i class="icon-wrapp"><img src="'. get_template_directory_uri() .'/images/play-icon.svg" alt="Play"></i></a>';
		
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="sm-wrapp video-det">
		<?php do_action('wm_floating_links'); ?>
		<div class="section-album">
			<div class="data-with-post margin-20">
				<?php if($is_premium && !is_user_logged_in()): ?>
					<div class="single_premium_icon">
						<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="Video Thumb">
						<?php echo $iconLink; ?>
					</div>
				<?php else: ?>
					<?php echo $embed_video; ?>
				<?php endif; ?>
			</div>
			<div class="entry-header">
				<div class="detail-head">
					<?php
					the_title( '<h1 class="entry-title">', '</h1>' );
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
							<span><?php the_date(); ?></span>
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
			
			<div class="row">
				<div class="col-sm-12">
					<div class="data-with-post status">
						<?php echo do_shortcode('[wm-like title="Did you like this Video?"]'); ?>
					</div>
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
						'taxonomy' => 'category',
						'field' => 'term_id',
						'terms' =>  wp_get_post_categories(get_the_ID())
					),
					array(                
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array( 
							'post-format-video'
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
						<h2 class="section_heading"><?php _e('Related Videos'); ?></h2>
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
