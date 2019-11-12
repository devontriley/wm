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
			
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="container">
						<div class="banner-inner <?php if(!has_post_thumbnail()){echo 'banner-inner-tag';}?>">
						   <div class="data-banner">
							   <div class="badge-banner"><?php _e('HERBAL MEDICINAL'); ?></div>
							   <div class="detail-data">
								   <?php the_title('<h2>','</h2>'); ?>

							   </div>
						   </div>
						   <div class="image-banner">
							   <?php the_post_thumbnail('wm-topic'); ?>
						   </div>
						</div>
					</div>
					<div class="sm-wrapp">
						<div class="row">
							<div class="col-md-12 tool-content">
									<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; endif; ?>  

			
		</main><!-- #site-main -->
</div><!-- .site-content -->

<?php get_footer();
