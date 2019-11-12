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

				$news_external_link = rwmb_meta( $meta_prefix.'news_external_link' ); 
				$news_source = rwmb_meta( $meta_prefix.'news_source' ); 
				?>
				
					<?php do_action('wm_floating_links'); ?>
					<div class="section-album">
						<div class="post_featured_image_wrap">
							<a href="#.">
								<img src="<?php echo $rel_feat_image;?>" alt="Feature Image: <?php echo esc_attr(get_the_title()); ?>">
							</a>
						</div>
						<div class="detail-head no-border">
							<h2 style="margin-bottom: 0;"><?php the_title(); ?></h2>
							<div class="row">
								<div class="col-sm-12">
									<span><?php _e('By:'); ?> <?php if(!empty($news_source)): ?><?php echo $news_source; ?><?php else: ?><?php echo get_the_author_meta('display_name'); ?><?php endif; ?></span>
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
								<?php if(!empty($news_external_link)): ?>
								<a href="<?php echo esc_attr($news_external_link); ?>" class="btn btn-theme-fix margin-right-10" target="_blank" rel="nofollow"><i class="fa fas fa-link"></i> <?php _e('Learn More'); ?></a>
								<?php endif; ?>
								<a href="<?php echo get_post_type_archive_link('wm_news'); ?>" class="btn btn-theme-fix"><?php _e('View All'); ?></a>
							</div>
						</div>
					</div>
				<?php
				endwhile; // End of the loop.
				?>
				<?php 
				global $post;
				$related_posts  = new WP_Query( array(
					'post_type' => 'wm_news',
					'posts_per_page' => 10,
					'post_status' => 'publish',
					'post__not_in' => array( get_the_ID() ),
					'orderby' => 'date', // date?
				) );
				?>

				<?php if( $related_posts->have_posts()  ): ?>
				<div class="row related-posts">
					<div class="col-sm-12">
						<h2 class="section_heading"><?php _e('Recent News'); ?></h2>
						<br>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<?php 
							$rel_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wm-featured');
							$rel_feat_image = $rel_feat_image !== false ? $rel_feat_image[0] : '';

							$news_external_link = rwmb_meta( $meta_prefix.'news_external_link' ); 
							?>
							<div class="box-feature simple">
								<div class="image-side">
									<img src="<?php echo $rel_feat_image;?>" alt="Feature Image: <?php echo esc_attr(get_the_title()); ?>">
								</div>
								<div class="feature-data">
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<p><?php echo WM_get_post_excerpt( get_the_excerpt(), 150 ); ?></p>
									<span class="datetime"><?php _e('News'); ?> • <?php echo get_the_date(); ?></span>
									<?php if(!empty($news_external_link)): ?>
									<a href="<?php echo esc_url($news_external_link); ?>" class="link-primary" style="text-decoration: underline;font-size: 14px;" target="_blank" rel="nofollow"><?php _e('View Us In The News'); ?></a>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile;?>
					</div>
				</div>
				<?php wp_reset_postdata();  ?>
				<?php endif; ?>
			</div>
		</main><!-- #site-main -->
</div><!-- .site-content -->

<?php get_footer();
