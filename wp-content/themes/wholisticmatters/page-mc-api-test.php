<?php
/*Template Name: MC API TEST */

get_header(); ?>

<?php get_template_part( 'template-parts/newsletter-signup' ); ?>

<div class="sm-wrapp">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
