<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); ?>

<div id="site-content" class="site-content">
		<main class="boxed no-padding" id="site-main">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						//comments_template();
					endif;

					//the_post_navigation( array(
					//	'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					//	'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
					//) );

				endwhile; // End of the loop.
				?>
		</main><!-- #site-main -->
</div><!-- .site-content -->

<?php
$feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
$feat_image = $feat_image !== false ? $feat_image[0] : '';
?>

<script type="application/ld+json">
{
  "@type": "NewsArticle",
  "headline": "<?php the_title() ?>",
  "image": "<?php echo $feat_image ?>",
  "datePublished": "<?php echo get_the_date() ?>",
  "dateModified": "<?php the_modified_date() ?>",
  "description": "<?php echo htmlspecialchars(WM_get_post_excerpt( get_the_excerpt(), 150 )) ?>",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php the_id() ?>"
  },
  "author": {
    "@type": "Organization",
    "name": "WholisticMatters"
  },
  "publisher": {
    "@type": "Organization",
    "name": "WholisticMatters"
  },
  "logo": {
    "@type": "ImageObject",
    "url": "https://wholisticmatters.com/wp-content/themes/wholisticmatters/images/logo.svg"
  },
  "citation": {
    "@type": "",
    "@id": ""
  }
}
</script>

<?php get_footer();
