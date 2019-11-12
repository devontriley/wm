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

				$event_date = rwmb_meta( $meta_prefix.'event_date' ); 
				$event_time = rwmb_meta( $meta_prefix.'event_time' ); 
				$event_tz = rwmb_meta( $meta_prefix.'event_time_zone' ); 
				$event_lmore = rwmb_meta( $meta_prefix.'event_learn_more' ); 

				$event_date = date( get_option('date_format'), $event_date );
				$event_time = !empty($event_tz) ? $event_time .' '. $event_tz : $event_time;
				?>
					<?php do_action('wm_floating_links'); ?>
					<div class="section-album">
						<div class="post_featured_image_wrap">
							<a href="#.">
								<img src="<?php echo $rel_feat_image;?>" alt="Feature Image: <?php echo esc_attr(get_the_title()); ?>">
							</a>
						</div>
						<div class="detail-head no-border">
							<h2><?php the_title(); ?></h2>
							<div class="row">
								<div class="col-sm-12">
									<span><?php echo $event_date; ?> • <?php echo $event_time; ?></span>
								</div>
							</div>
						</div>

						<div class="row article-tags">
							<div class="col-sm-12">
								<div class="data-with-post event-graph margin-20">
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
						<div class="row">
							<div class="col-sm-12">
								<?php if($event_lmore): ?>
									<a href="<?php echo esc_attr($event_lmore); ?>" class="btn btn-theme-fix margin-right-10"><?php _e('Learn More'); ?></a>
								<?php endif; ?>
								<a href="<?php echo get_post_type_archive_link('wm_event'); ?>" class="btn btn-theme-fix"><?php _e('View All'); ?></a>
							</div>
						</div>
					</div>
				<?php
				endwhile; // End of the loop.
				?>
			</div>
		</main><!-- #site-main -->
</div><!-- .site-content -->

<?php get_footer();
