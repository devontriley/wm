<?php
/**
 * Template part for displaying interactive tools content
 *
 */

?>
<div class="wrapp-xs">
	<div class="row">
		<div class="col-md-12 tool-content" style="margin-top: 0;">
			<?php the_content(); ?>
		</div>
	</div>
</div>
<div class="container wm_herbs_wrap">
	<form action="" method="post" id="wm_herbs_form">
		<div class="filter-herbal">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/herbal-search.svg" alt="search">
			<input type="text" class="form-control js_wm_herb_keyword" placeholder="Search by herb name, family, or use" name="keyword">
			<input type="submit" class="btn btn-theme-fix filter-bt" value="Filter">
		</div>
	</form>
	<div class="row wm_herbs js_wm_herbs"></div>
	<p class="cbxwpbkmarkloading" style="text-align: center;"><img src="<?php echo get_stylesheet_directory_uri().'/images/ajax-loader.gif'; ?>" alt="Loading" title="<?php echo esc_html__('Loading', 'wholistic-matters'); ?>" /> </p>				
</div>
