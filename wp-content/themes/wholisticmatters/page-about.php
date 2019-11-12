<?php 
/*Template Name: About Page */

$meta_prefix = WM_META_PREFIX;
$wm_settings = Wholistic_Matters::get_settings();
$about_mission = ( isset( $wm_settings['about_mission'] ) && $wm_settings['about_mission'] ) ? $wm_settings['about_mission'] : array();
$about_values = ( isset( $wm_settings['about_values'] ) && $wm_settings['about_values'] ) ? $wm_settings['about_values'] : array();
$about_education = ( isset( $wm_settings['about_education'] ) && $wm_settings['about_education'] ) ? $wm_settings['about_education'] : array();
$about_partners = ( isset( $wm_settings['about_partners'] ) && $wm_settings['about_partners'] ) ? $wm_settings['about_partners'] : array();

$interactive_tools_page = ( isset( $wm_settings['interactive_tools_page'] ) && $wm_settings['interactive_tools_page'] ) ? intval($wm_settings['interactive_tools_page']) : 0;

$hpage_text_signup = ( isset( $wm_settings['hpage_text_signup'] ) && $wm_settings['hpage_text_signup'] ) ? $wm_settings['hpage_text_signup'] : '';

get_header(); ?>
<div class="boxed padding-0">
	<!---Boxed-->
	<div class="container-lg">
		<?php do_action('wm_floating_links'); ?>
		
		<div class="main_banner pos_right">
			<div class="row">
				<div class="col-md-7">
					<div class="banner_desc_container">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php the_title( '<h1 class="banner_heading">', '</h1>' ); ?>
							<div class="banner_desc"><?php the_content(); ?></div>
						<?php endwhile; endif; ?> 
					</div>
				</div>
				<div class="col-md-5">
					<div class="featured_image">
						<?php the_post_thumbnail('wm-topic'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-lg">
		<?php
		$am_image = isset($about_mission['image']) ? $about_mission['image'] : '';
		$am_textarea = isset($about_mission['textarea']) ? $about_mission['textarea'] : '';
		?>
		<div class="row">
			<div class="col-lg-10">
				<div class="culinary-block righ-flip">
					<img src="<?php echo !empty($am_image) ? $am_image : get_template_directory_uri().'/images/about-image.png'; ?>" alt="<?php _e('Our Mission'); ?>">
					<div class="data-calinary">
						<h2><?php _e('Our Mission'); ?></h2>
						<p><?php echo wpautop($am_textarea); ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
		<?php
		$av_image = isset($about_values['image']) ? $about_values['image'] : '';
		$av_textarea = isset($about_values['textarea']) ? $about_values['textarea'] : '';
		?>
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-10">
				<div class="culinary-block">
					<img src="<?php echo !empty($av_image) ? $av_image : get_template_directory_uri().'/images/about-image.png'; ?>" alt="<?php _e('Our Values'); ?>">
					<div class="data-calinary">
						<h2><?php _e('Our Values'); ?></h2>
						<p><?php echo wpautop($av_textarea); ?></p>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<div class="about-data-big">
					<div class="image-big" style="background-image:url(<?php echo get_template_directory_uri(); ?>/images/tea.jpg);">
						<!--<img src="<?php //echo get_template_directory_uri(); ?>/images/tea.jpg" alt="tea">-->
						<div class="logo-brand">
							<img src="<?php echo get_template_directory_uri(); ?>/images/footer-icon.png" alt="footer-icon.png">
						</div>
					</div>
					<div class="about-big-content container">
						<?php if($interactive_tools_page > 0): ?>
						<?php
						$tools_page = get_post( $interactive_tools_page );
						?>
						<h2><?php _e('Interactive Tools'); ?></h2>
						<p><?php echo WM_get_post_excerpt( get_the_excerpt($tools_page), 250 ); ?></p>
						<?php endif; ?>
					</div>
				</div>
	<div class="container">
		<div class="data-overlap">
			<div class="row">
				<div class="col-sm-12">
					<div class="key_topics">
						<?php if($interactive_tools_page > 0): ?>
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
								<div class="row">
									<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
										<?php get_template_part( 'template-parts/page/tool' ); ?>
									<?php endwhile;?>
								</div>
							<?php wp_reset_postdata();  ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		$ae_image = isset($about_education['image']) ? $about_education['image'] : '';
		$ae_textarea = isset($about_education['textarea']) ? $about_education['textarea'] : '';
		$ae_link = isset($about_education['link']) ? get_permalink(intval($about_education['link'])) : '#';
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="culinary-block righ-flip fix-lg">
					<img src="<?php echo !empty($ae_image) ? $ae_image : get_template_directory_uri().'/images/about-image.png'; ?>" alt="<?php _e('Continuing Education'); ?>">
					<div class="data-calinary">
						<h2><?php _e('Continuing Education'); ?></h2>
						<p><?php echo wpautop($ae_textarea); ?></p>
						<a href="<?php echo $ae_link; ?>" class="btn btn-theme-fix"><?php _e('View'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	$ap_textarea = isset($about_partners['textarea']) ? $about_partners['textarea'] : '';
	$ap_images = isset($about_partners['image']) ? $about_partners['image'] : array();
	?>

	
				<div class="about-data-big margin-ad">
					<div class="about-big-content">
						<h2><?php _e('Our Partners'); ?></h2>
						<p><?php echo wpautop($ap_textarea); ?></p>
						<div class="partner-logo">
							<?php if(count($ap_images) > 0): ?>
								<?php foreach($ap_images as $ap_image): ?>
									<?php if(!empty($ap_image)): ?>
										<div class="partner-block" style="background-image: url('<?php echo $ap_image; ?>');"></div>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if(!is_user_logged_in()): ?>
					<div class="account no-top">
						<div class="account-box">
							<h2><?php _e('Create an Account & Gain Full Access'); ?></h2>
							<p><?php echo wpautop($hpage_text_signup); ?></p>
							<a class="btn btn-theme signup_popup" href="<?php echo esc_url(wp_registration_url()); ?>">Sign Up</a>
						</div>
					</div>
				<?php endif; ?>
			


</div>
<?php get_footer(); ?>