<?php
/**
 * Template part for displaying interactive tool page item
 *
 */

$is_premium = rwmb_meta( WM_META_PREFIX.'is_premium' ); 

$link_attr = '';
if( $is_premium && (!is_user_logged_in() || current_user_can('non-hcp')) ){
	$link_attr = 'data-is_premium="1"';
}
?>
<div class="col-sm-4">
	<div class="item relative tool_item <?php if(has_post_thumbnail()): ?>has_thumb<?php endif; ?>">
		<?php if($is_premium): ?>
			<span class="badge"><?php _e('PREMIUM'); ?></span>
		<?php endif; ?>
		<a href="<?php the_permalink(); ?>" <?php echo $link_attr; ?>><?php the_post_thumbnail('wm-topic'); ?></a>
		<h2><a href="<?php the_permalink(); ?>" style="color: inherit;text-decoration: none;" <?php echo $link_attr; ?>><?php the_title(); ?></a></h2>
		<div class="legal-data">
			<p><?php echo WM_get_post_excerpt( get_the_excerpt(), 250 ); ?></p>
		</div>
	</div>
</div>