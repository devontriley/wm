<?php 
$meta_prefix = WM_META_PREFIX;
?>
<?php get_header(); ?>
<div class="boxed">
	<!---Boxed-->
	<div class="sm-wrapp">
		<h2 class="section_heading"><?php _e( 'Wholistic Matters News', 'wholistic-matters' ); ?></h2>
		<br>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php 
		$rel_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wm-featured');
		$rel_feat_image = $rel_feat_image !== false ? $rel_feat_image[0] : '';
		
		$news_external_link = rwmb_meta( $meta_prefix.'news_external_link' ); 
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
				<span class="datetime"><?php _e('News'); ?> • <?php echo get_the_date(); ?></span>
				<?php if(!empty($news_external_link)): ?>
				<a href="<?php echo esc_url($news_external_link); ?>" class="link-primary" style="text-decoration: underline;font-size: 14px;" target="_blank" rel="nofollow"><?php _e('View Us In The News'); ?></a>
				<?php endif; ?>
			</div>
		</div>
		<?php endwhile; endif; ?>      
		<?php WM_page_navi(); ?>
    
  </div>
</div>   
<?php get_footer(); ?>