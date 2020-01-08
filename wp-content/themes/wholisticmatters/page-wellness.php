<?php 
/*Template Name: Culinary Wellness Page */

$meta_prefix = WM_META_PREFIX;
$wm_settings = Wholistic_Matters::get_settings();
$chef_name = ( isset( $wm_settings['chef_name'] ) && $wm_settings['chef_name'] ) ? $wm_settings['chef_name'] : '';	
$chef_about = ( isset( $wm_settings['chef_about'] ) && $wm_settings['chef_about'] ) ? $wm_settings['chef_about'] : '';	
$chef_about_img = ( isset( $wm_settings['chef_about_img'] ) && $wm_settings['chef_about_img'] ) ? $wm_settings['chef_about_img'] : '';	

get_header(); ?>
<div class="boxed">
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="banner-inner <?php if(!has_post_thumbnail()){echo 'banner-inner-tag';}?>">
			   <div class="data-banner">
				   <div class="detail-data">
					   <?php the_title('<h1>','</h1>'); ?>
					  <?php the_content(); ?>
				   </div>
			   </div>
			   <div class="image-banner">
				   <?php the_post_thumbnail('wm-topic'); ?>
			   </div>
		   </div>
		<?php endwhile; endif; ?>  
		
	</div>
	<div class="sm-wrapp">
		<div class="row">
            <div class="col-md-12">
				<?php 
				$related_posts  = new WP_Query( array(
					'post_type' => 'wm_recipe',
					'posts_per_page' => 3,
					'post_status' => 'publish',
					'orderby' => 'date', // date?
				) );
				?>

				<?php if( $related_posts->have_posts()  ): ?>
				<div class="row related-posts">
					<div class="col-sm-12">
						<div class="inner-heading">
							<h2 class="section_heading"><?php _e('Latest Recipes'); ?></h2>
							<a href="<?php echo get_post_type_archive_link( 'wm_recipe'); ?>"><?php _e('View All Recipes >'); ?></a>
						</div>
						<br>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
						<?php endwhile;?>
					</div>
				</div>
				<?php wp_reset_postdata();  ?>
				<?php endif; ?>
				
				<?php 
				$rel_args = array(
					'post_type' => 'wm_skill_video',
					'posts_per_page' => 3,
					'post_status' => 'publish',
					'post__not_in' => array( get_the_ID() ),
					'orderby' => 'date' // date?
				);
				$related_posts  = new WP_Query( $rel_args );
				?>
				<?php if( $related_posts->have_posts()  ): ?>
				<div class="row related-posts">
					<div class="col-sm-12">
						<div class="inner-heading">
							<h2 class="section_heading"><?php _e('Latest Skills'); ?></h2>
							<a href="<?php echo get_post_type_archive_link( 'wm_skill_video'); ?>"><?php _e('View All Skills >'); ?></a>
						</div>
						<br>
						<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
							<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
						<?php endwhile;?>
					</div>
				</div>
				<?php wp_reset_postdata();  ?>
				<?php endif; ?>
			</div>
		</div>
	</div>

<!--	<div class="container">-->
<!--		<div class="row">-->
<!--			<div class="col-md-12">-->
<!--				<div class="culinary-block righ-flip">-->
<!--					<img src="--><?php //echo !empty($chef_about_img) ? $chef_about_img : get_template_directory_uri().'/images/cultivvate.png'; ?><!--" alt="--><?php //echo $chef_name; ?><!--">-->
<!--					<div class="data-calinary">-->
<!--						<h2>--><?php //_e('About Our Chef'); ?><!--</h2>-->
<!--						<h5>--><?php //echo $chef_name; ?><!--</h5>-->
<!--						<p>--><?php //echo wpautop($chef_about); ?><!--</p>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!---->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="culinary-block righ-flip">-->
<!--                    <div class="data-calinary">-->
<!--                        <h2>--><?php //_e('About Our Chef'); ?><!--</h2>-->
<!--                        <h5>-->
<!--                            Chef Megan Lambert, M.S., R.D.<br />-->
<!--                            JWU College of Culinary Arts – Senior Instructor-->
<!--                        </h5>-->
<!--                        <p>A senior instructor and Registered Dietitian at Johnson & Wales University College of Culinary Arts in Charlotte, North Carolina, Chef Megan Lambert has a strong interest in teaching children about healthy food and how to grow their own gardens, as well as contributing to the local food system in Charlotte as an educator, writer, and food entrepreneur. Chef Lambert’s credentials include a master’s degree in Nutrition Science from East Carolina University, bachelor’s degrees in nutrition, and in hotel, restaurant, and institutional management from the Pennsylvania State University.</p>-->
<!--                    </div>-->
<!--                    <img src="--><?php //bloginfo('template_directory'); ?><!--/images/chef_lambert.jpg ?>" alt="Chef Megan Lambert, M.S., R.D.">-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

</div>   
<?php get_footer(); ?>