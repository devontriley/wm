<?php
/**
 * The template for displaying all single posts
 *
 */
$meta_prefix = WM_META_PREFIX;
get_header(); ?>

<div id="site-content" class="site-content">
		<main class="boxed" id="site-main">
			<!---Boxed-->
			<div class="sm-wrapp video-det">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				$rel_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$rel_feat_image = $rel_feat_image !== false ? $rel_feat_image[0] : '';

				$read_time = WMHelper::get_post_watch_time(get_the_ID());
				
				$embed_video_type = rwmb_meta( $meta_prefix.'embed_video'  ); 
				if($embed_video_type == $meta_prefix.'embed_video1') {
					$embed_video = rwmb_meta( $meta_prefix.'embed_video1'  ) ;
				}else{
					$videos = rwmb_meta( $meta_prefix.'embed_video2', array( 'limit' => 1 ) );
					$video = reset( $videos );
					$embed_video = do_shortcode('[video src="'.$video['src'].'" ]');
				}
				
				?>
				
					<?php do_action('wm_floating_links'); ?>
					<div class="section-album">
						<div class="post_featured_image_wrap">
							<?php  if(!empty($embed_video)){echo $embed_video;}else{ the_post_thumbnail('full'); } ?>
						</div>
						<div class="detail-head">
							<h2 style="margin-bottom: 0;"><?php the_title(); ?></h2>
							<div class="row">
								<div class="col-sm-12">
									<span><?php the_date(); ?> • <?php if(!empty($read_time)): ?><?php echo $read_time; ?><?php endif; ?></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="short-btn">
									<?php do_action('wm_single_share'); ?>
								</div>
							</div>
						</div>
						<?php if(has_excerpt()): ?>
							<div class="row">
								<div class="col-sm-12">
									<div class="summary">
										<h5><?php _e('Summary'); ?></h5>
										<?php echo wpautop( get_the_excerpt() ); ?>
									</div>
								</div>
							</div>
						<?php else: ?>
							<br/>
						<?php endif; ?>
						<div class="row">
							<div class="col-sm-12">
								<div class="data-with-post event-graph ">
									<?php
									/* translators: %s: Name of current post */
									the_content( sprintf(
										__( 'Continue reading<span class="screen-reader-text"> "%s"</span>'),
										get_the_title()
									) );

									wp_link_pages( array(
										'before'      => '<div class="page-links">' . __( 'Pages:' ),
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
									) );
									?>
								</div>
							</div>
						</div>
							
					</div>
				<?php
				endwhile; // End of the loop.
				?>
				<?php 
				global $post;
				$tag_ids = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
				$rel_args = array(
					'post_type' => 'wm_skill_video',
					'posts_per_page' => 5,
					'post_status' => 'publish',
					'post__not_in' => array( get_the_ID() ),
					'orderby' => 'rand' // date?
				);
				if(count($tag_ids)){
					$rel_args['tax_query'] = array( 
						array(                
							'taxonomy' => 'post_tag',
							'field' => 'term_id',
							'terms' =>  $tag_ids
						)
					);
				}
				$related_posts  = new WP_Query( $rel_args );
				?>

				<?php if( $related_posts->have_posts()  ): ?>
				<div class="row related-posts">
					<div class="col-sm-12">
						<div class="inner-heading">
							<h2 class="section_heading"><?php _e('Related Videos'); ?></h2>
							<a href="<?php echo get_post_type_archive_link( 'wm_skill_video'); ?>"><?php _e('View All Skills >'); ?></a>
						</div>
						<br>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
						<?php endwhile;?>
					</div>
				</div>
				<?php wp_reset_postdata();  ?>
				<?php endif; ?>
			</div>
		</main><!-- #site-main -->
</div><!-- .site-content -->

<?php get_footer();
