<?php
/**
 * Template part for displaying posts/articles
 *
 */
$meta_prefix = WM_META_PREFIX;
$feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$feat_image = $feat_image !== false ? $feat_image[0] : '';

$is_premium = rwmb_meta( $meta_prefix.'is_premium' ); 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-featured-image" style="<?php echo 'background-image:url(\''. $feat_image .'\');'?>" >
	</div>
	<div class="sm-wrapp">
		<?php do_action('wm_floating_links'); ?>
<!--		<div class="link-purpal">
			<a href="#.">Gated Page Link</a>
		</div>-->
		<div class="deatil-data">
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
					
					$read_time = WMHelper::get_post_read_time(get_the_ID());
					?>
					<div class="row">
						<div class="col-sm-6">
							<span class="pmeta_key_topics">Key Topics: <?php echo $categories_list;?></span>
						</div>
						<div class="col-sm-6 text-right">
							<span><?php the_date(); ?> • <?php echo $read_time; ?></span>
						</div>
					</div>
				</div>
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
				<div class="row">
					<div class="col-sm-12">
						<div class="short-btn single-post-links">
							<?php do_action('wm_single_share'); ?>
						</div>
					</div>
				</div>
			</div><!-- .entry-header -->
			
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
					<div class="data-with-post entry-content">
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
					</div><!-- .entry-content -->
				</div>
			</div>
				
			<div class="row">
				<div class="col-sm-12">
					<div class="data-with-post status">
						<?php echo do_shortcode('[wm-like title="Did you like this article?"]'); ?>
					</div>
				</div>
			</div>
			<?php $references = rwmb_meta( $meta_prefix.'references' ); ?>
			<?php if(!empty($references)): ?>
			<div class="row">
				<div class="col-sm-12">
					<div class="refrence">
						<div id="accordion">
							<div class="card">
								<div class="card-header collapsed" data-toggle="collapse" data-target="#References" aria-expanded="false" aria-controls="References">
									<a class="card-link ">
										<?php _e('References'); ?>
									</a>
								</div>
								<div id="References" class="collapse " aria-labelledby="References" data-parent="#accordion">
									<div class="card-body">
										<?php echo $references; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
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
							'post-format-aside',
							'post-format-audio',
							'post-format-chat',
							'post-format-gallery',
							'post-format-image',
							'post-format-link',
							'post-format-quote',
							'post-format-status',
							'post-format-video'
						),
						'operator' => 'NOT IN'
					)
				)
			) );
			?>
                                
			<?php if( $related_posts->have_posts()  ): ?>
			<div class="row related-posts">
				<div class="col-sm-12">
					<h2 class="section_heading"><?php _e('Related Articles'); ?></h2>
					<br>
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
