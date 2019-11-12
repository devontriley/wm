<?php 
/*Template Name: Interactive Tools Page */

$wm_settings = Wholistic_Matters::get_settings();
$interactive_tools_page = ( isset( $wm_settings['interactive_tools_page'] ) && $wm_settings['interactive_tools_page'] ) ? intval($wm_settings['interactive_tools_page']) : 0;
$hpage_text_signup = ( isset( $wm_settings['hpage_text_signup'] ) && $wm_settings['hpage_text_signup'] ) ? $wm_settings['hpage_text_signup'] : '';		

get_header(); ?>
<div class="boxed" <?php if(!is_user_logged_in()): ?>style="padding-bottom: 0;"<?php endif; ?>>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="container">
				<div class="banner-inner <?php if(!has_post_thumbnail()){echo 'banner-inner-tag';}?>">
				   <div class="data-banner">
					   <div class="detail-data">
						   <?php the_title('<h2>','</h2>'); ?>
						  <?php the_excerpt(); ?>
					   </div>
				   </div>
				   <div class="image-banner">
					   <?php the_post_thumbnail('wm-topic'); ?>
				   </div>
			   </div>
		</div>
		<div class="sm-wrapp">
			<div class="row">
				<div class="col-md-12 data-with-post tool-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		<?php if($interactive_tools_page > 0): ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php 
					$related_posts  = new WP_Query( array(
						'post_type' => 'page',
						'posts_per_page' => 5,
						'post_status' => 'publish',
						'orderby' => 'title', // date?
						'post_parent' => $interactive_tools_page,
					) );
					?>

					<?php if( $related_posts->have_posts()  ): ?>
					<div class="row related-posts">
						<div class="col-sm-12">
							<div class="inner-heading">
								<h2 class="section_heading"><?php _e('HCP Tools'); ?></h2>
							</div>
							<br>
							<div class="row">
								<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
									<?php get_template_part( 'template-parts/page/tool' ); ?>
								<?php endwhile;?>
							</div>
						</div>
					</div>
					<?php wp_reset_postdata();  ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php if(!is_user_logged_in()): ?>
            <div class="account">
                <div class="account-box">
                    <h2><?php _e('Create an Account & Gain Full Access'); ?></h2>
                    <p><?php echo wpautop($hpage_text_signup); ?></p>
                    <a class="btn btn-theme signup_popup" href="<?php echo esc_url(wp_registration_url()); ?>">Sign Up</a>
                </div>
            </div>
        <?php endif; ?>
	<?php endwhile; endif; ?>  
</div>   
<?php get_footer(); ?>