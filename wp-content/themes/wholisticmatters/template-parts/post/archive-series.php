<?php
/**
 * Template part for displaying series
 *
 */
global $series_term;
if(isset($args['series_term'])){
	$series_term = $args['series_term'];
}
$meta_prefix = WM_META_PREFIX;
$series_thumb = ''; //default/fallback  image
if ( $series_term->term_image ) {
	$series_thumb_data = wp_get_attachment_image_src( $series_term->term_image, 'wm-topic' );
	$series_thumb = isset($series_thumb_data[0]) ? $series_thumb_data[0] : $series_thumb;
}
$spotify = WMHelper::get_term_meta_url( $series_term->term_id, 'wm_series_soptify' ); 
$apple = WMHelper::get_term_meta_url( $series_term->term_id, 'wm_series_apple' );
$itunes = WMHelper::get_term_meta_url( $series_term->term_id, 'wm_series_itunes' );
$series_title = $series_term->name;
$series_link = !is_wp_error(get_term_link($series_term->term_id, 'series')) ? get_term_link($series_term->term_id, 'series') : '#';
$iconLink = '<a href="'.$series_link.'" class="icon-feature"><i class="icon-wrapp"><img src="'. get_template_directory_uri() .'/images/audio.svg" alt="Play"></i></a>';
					
?>
<div class="box-feature audio">
	<div class="image-side">
		<a href="<?php echo $series_link; ?>">
		<img src="<?php echo $series_thumb;?>" alt="Series Thumb: <?php echo esc_attr($series_title); ?>">
		</a>
		<?php echo $iconLink; ?>
	</div>
	<div class="feature-data">
		<h2><a href="<?php echo $series_link; ?>"><?php echo $series_title; ?></a></h2>
		<p><?php echo WM_get_post_excerpt( $series_term->description, 150 ); ?></p>
		<span class="datetime"><?php _e('By:'); ?> <?php echo WMHelper::get_term_meta_text( $series_term->term_id, 'wm_series_host' ); ?> • <?php echo $series_term->count; ?> <?php _e('Episodes'); ?></span>
	</div>
</div>