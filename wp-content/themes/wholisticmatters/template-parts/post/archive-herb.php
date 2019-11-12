<?php
/**
 * Template part for displaying audio posts
 *
 */
global $post;
$meta_prefix = WM_META_PREFIX;
$family = rwmb_meta( $meta_prefix.'herb_family' ); 
//$herb_parts = rwmb_meta( $meta_prefix.'herb_parts' ); 
//$herb_use = rwmb_meta( $meta_prefix.'herb_use' ); 
?>
<div class="col-sm-4">
	<div class="herbal-box">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('wm-topic'); ?></a>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p><?php echo $family; ?></p>
		<?php //echo do_shortcode('[wm-bookmark-link]');// removed bcz of feedback: Feedback-v6.docx ?>
	</div>
</div>
