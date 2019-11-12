<?php 
/*Template Name: Spotlight Topics Page */
$wm_settings = Wholistic_Matters::get_settings();
$hpage_text_1 = ( isset( $wm_settings['hpage_text_1'] ) && $wm_settings['hpage_text_1'] ) ? $wm_settings['hpage_text_1'] : '';	
$hpage_link_recipes = ( isset( $wm_settings['hpage_link_recipes'] ) && $wm_settings['hpage_link_recipes'] ) ? $wm_settings['hpage_link_recipes'] : '#';
$hpage_link_skill = ( isset( $wm_settings['hpage_link_skill'] ) && $wm_settings['hpage_link_skill'] ) ? $wm_settings['hpage_link_skill'] : '#';

$learn_about_text = ( isset( $wm_settings['learn_about_text'] ) && $wm_settings['learn_about_text'] ) ? $wm_settings['learn_about_text'] : '';		
$about_img = ( isset( $wm_settings['learn_about_img'] ) && $wm_settings['learn_about_img'] ) ? $wm_settings['learn_about_img'] : '';	
$learn_about_link = ( isset( $wm_settings['learn_about_link'] ) && $wm_settings['learn_about_link'] ) ? get_permalink(intval($wm_settings['learn_about_link'])) : '#';

$args = array(
	'taxonomy' => 'spotlight-topic',
	'number' => 99
);
$res = WMHelper::getTerms($args);
$topics = $res['total'] > 0 ? $res['terms'] : array();
get_header(); ?>
<div class="boxed no-padding">
	<!---Boxed-->
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="banner-inner banner-inner-fw">
			<div class="container">
				<div class="data-banner">
					<div class="detail-data">
						<?php the_title('<h2>','</h2>'); ?>
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>
		</div>	
		<div class="container relative">
			<?php if(count($topics) > 0): ?>
				<?php $topics_counter = 0; ?>
				<?php $topics_total = count($topics); ?>
				<div class="row">
						<?php foreach($topics as $topic): ?>
							<?php 
							$topic_image = ''; //default/fallback  image
							if ( $topic->term_image ) {
								$topic_image = wp_get_attachment_image( $topic->term_image, 'wm-topic' );
							} 
							?>
							<div class="col-sm-4">
								<div class="item">
									<a href="<?php echo get_term_link($topic, 'spotlight-topic'); ?>"><?php echo $topic_image; ?></a>
									<h2><a href="<?php echo get_term_link($topic, 'spotlight-topic'); ?>" style="color: inherit;text-decoration: none;"><?php echo $topic->name; ?></a></h2>
									<div class="legal-data">
										<?php echo wpautop($topic->description); ?>
									</div>
								</div>
							</div>
							<?php 
							$topics_counter++;
							if($topics_counter % 3 === 0 && $topics_counter < $topics_total){ 
								echo '</div><div class="row">';
							}
							?>
						<?php endforeach; ?>
					
				</div>
			<?php endif; ?>
			<div class="row">
                <div class="col-md-12">
                    <div class="culinary-block">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/culinary-image.png" alt="culinary-image">
                        <div class="data-calinary">
                            <h2><?php _e('Culinary Wellness'); ?></h2>
                            <p><?php echo wpautop($hpage_text_1); ?></p>
                            <a href="<?php echo $hpage_link_recipes; ?>" class="btn btn-theme"><?php _e('Recipes'); ?></a>
                            <a href="<?php echo $hpage_link_skill; ?>" class="btn btn-theme"><?php _e('Skill Videos'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="culinary-block righ-flip">
                        <img src="<?php echo !empty($about_img) ? $about_img : get_template_directory_uri().'/images/cultivvate.png'; ?>" alt="<?php _e('Learn More About Us'); ?>">
                        <div class="data-calinary">
                            <h2><?php _e('Learn More About Us'); ?></h2>
                            <p><?php echo wpautop($learn_about_text); ?></p>
                            <a href="<?php echo $learn_about_link; ?>" class="btn btn-theme"><?php _e('Learn More'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
			<div class="data-with-post entry-content margin-20">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; endif; ?>    
</div>
<?php get_footer(); ?>