<?php 
/*Template Name: Page Template - Boxed */
get_header(); ?>
<div class="boxed">
	<!---Boxed-->
	<div class="sm-wrapp">
		<div class="row">
		  <div class="col-md-12">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>      
		  </div>
		</div>
	</div>   
</div>   
<?php get_footer(); ?>