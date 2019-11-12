<?php 
$meta_prefix = WM_META_PREFIX;
?>
<?php get_header(); ?>
<div class="boxed">
	<!---Boxed-->
	<div class="sm-wrapp">
		<h2 class="section_heading"><?php _e( 'Upcoming Events', 'wholistic-matters' ); ?></h2>
		<br>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
		$rel_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wm-featured');
		$rel_feat_image = $rel_feat_image !== false ? $rel_feat_image[0] : '';
		
		$event_date = rwmb_meta( $meta_prefix.'event_date' ); 
		$event_time = rwmb_meta( $meta_prefix.'event_time' ); 
		$event_tz = rwmb_meta( $meta_prefix.'event_time_zone' ); 
		//$event_lmore = rwmb_meta( $meta_prefix.'event_learn_more' ); 
		
		$event_date = date( get_option('date_format'), $event_date );
		$event_time = !empty($event_tz) ? $event_time .' '. $event_tz : $event_time;
		?>
		<div class="box-feature simple">
			<div class="image-side">
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo $rel_feat_image;?>" alt="Feature Image: <?php echo esc_attr(get_the_title()); ?>">
				</a>
			</div>
			<div class="feature-data">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p><?php echo WM_get_post_excerpt( get_the_excerpt(), 150 ); ?></p>
				<span class="datetime"><?php echo $event_date; ?> • <?php echo $event_time; ?></span>
			</div>
		</div>
		<?php endwhile; endif; ?>      
		<?php WM_page_navi(); ?>
    
  </div>
</div>   
<?php get_footer(); ?>