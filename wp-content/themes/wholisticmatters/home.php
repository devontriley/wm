<?php 
$meta_prefix = '_wm_';
?>
<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
		<h2 class="section_heading"><?php _e( 'Blog', 'wholistic-matters' ); ?></h2>
		<br>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
		<?php endwhile; endif; ?>      
		<?php WM_page_navi(); ?>
    </div>
  </div>
</div>   
<?php get_footer(); ?>