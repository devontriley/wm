<?php /*Template Name: Homepage*/
global $post;
$meta_prefix = WM_META_PREFIX;
$wm_settings = Wholistic_Matters::get_settings();
$hpage_text_1 = ( isset( $wm_settings['hpage_text_1'] ) && $wm_settings['hpage_text_1'] ) ? $wm_settings['hpage_text_1'] : '';	
$hpage_link_recipes = ( isset( $wm_settings['hpage_link_recipes'] ) && $wm_settings['hpage_link_recipes'] ) ? $wm_settings['hpage_link_recipes'] : '#';
$hpage_link_skill = ( isset( $wm_settings['hpage_link_skill'] ) && $wm_settings['hpage_link_skill'] ) ? $wm_settings['hpage_link_skill'] : '#';

$hpage_text_2 = ( isset( $wm_settings['hpage_text_2'] ) && $wm_settings['hpage_text_2'] ) ? $wm_settings['hpage_text_2'] : '';		
$hpage_link_visit = ( isset( $wm_settings['hpage_link_visit'] ) && $wm_settings['hpage_link_visit'] ) ? $wm_settings['hpage_link_visit'] : '#';

$hpage_text_signup = ( isset( $wm_settings['hpage_text_signup'] ) && $wm_settings['hpage_text_signup'] ) ? $wm_settings['hpage_text_signup'] : '';		
            
get_header(); ?>

<div class="boxed <?php if(!is_user_logged_in()): echo 'pb-0'; endif; ?>">
        <!---Boxed-->
        <div class="container">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php 
			$feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wp-topic');
			$feat_image = $feat_image !== false ? $feat_image[0] : '';
			?>
            <div class="main_banner pos_right">
                <div class="row">
                    <div class="col-md-7">
                        <div class="banner_desc_container">
                                <?php the_title( '<h1 class="banner_heading">', '</h1>' ); ?>
                                <div class="banner_desc"><?php the_content(); ?></div>
                            <?php if(!is_user_logged_in()): ?>
                                <a class="cta_filled signup_popup" href="<?php echo esc_url(wp_registration_url()); ?>">Sign Up</a> 
                            <?php endif; ?> 
                            <a class="cta_bordered" href="<?php echo site_url('/about'); ?>">More About Us</a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="featured_image">
                            <img src="<?php echo $feat_image; ?>" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
			<?php endwhile; endif; ?> 
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <?php 
                    $feat_posts  = new WP_Query( array(
                        'post_type' => 'post',
                        'numberposts' => 5,
                        'post_status' => 'publish',
                        'orderby' => 'date', // date?
                        'meta_query' => array( //only default format
                                'relation' => 'OR',
                                array(                
                                    'key'     => $meta_prefix.'feature_spotlight',
                                    'value'   => '1',
                                    'compare' => '='
                                ),
                                array(                
                                    'key'     => $meta_prefix.'feature_specialties',
                                    'value'   => '1',
                                    'compare' => '='
                                )
                        )
                    ) ); 
                    ?>
                    <?php if( $feat_posts->have_posts()  ):  ?>
                        <h2 class="section_heading"><?php _e('Featured Content'); ?></h2>
                        <br>
                        <?php while ( $feat_posts->have_posts() ) : $feat_posts->the_post(); ?>
							<?php get_template_part( 'template-parts/post/archive', 'item' ); ?>
                        <?php endwhile;?>
                    <?php wp_reset_postdata();  ?>
                    <?php endif; ?>

                </div>
                <div class="col-md-12 col-lg-5 articles-secton">
                    <div class="article-block">
                         <?php if (function_exists('wpp_get_mostpopular')): ?>
                        <div class="head-section">
                            <h2>Trending Articles</h2>
                        </div>
                        <div class="body-section">
                           <?php
                                $args = array(
                                    'post_format' => 1,
                                    'limit' => 5,
                                    'stats_date' => 1,
                                    'stats_author' => 1,
                                    'range' => 'all',//last24hours
                                    'post_type' => 'post,post_format_article',
                                    'wpp_start' => '<ul class="wm-wpp-trending">',
                                    'post_html' => '<li class="box-article">'
                                    . '<span class="numbers"></span>'
                                    . '<span>{title} <br> <i class="wm-trending-meta">{author} • {date}</i></span>'
                                    . '</li>'
                                );
                                wpp_get_mostpopular($args);
                            ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <?php
            //Key Topics Slider
            $key_topics = get_terms( 'category', array(
                'orderby'    => 'name',
                'hide_empty' => 1
            ) );
            if ( ! empty( $key_topics ) && ! is_wp_error( $key_topics ) ):  ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="key_topics">
                        <h2 class="section_heading"><?php _e('Key Topics'); ?></h2>
                        <div class="owl-carousel owl-theme">
                            <?php  
                            foreach ( $key_topics as $key_topic ): 
                                if ( $key_topic->term_id == 1 )
                                    continue; // skip 'uncategorized'
                                $key_topic_image = ''; //default/fallback key top image
                                if ( $key_topic->term_image ) {
                                    $key_topic_image = wp_get_attachment_image( $key_topic->term_image, 'wm-topic' );
                                }
                                ?>
                                <div class="item">
                                    <a href="<?php echo get_term_link($key_topic, 'category')?>"><?php echo $key_topic_image; ?></a>
                                    <h2><a href="<?php echo get_term_link($key_topic, 'category')?>"><?php echo $key_topic->name; ?></a></h2>
                                    <p><?php echo $key_topic->description; ?></p>
                                </div>
                             <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php
            //Spotlight Topics Slider
            $key_topics = get_terms( 'spotlight-topic', array(
                'orderby'    => 'name',
                'hide_empty' => 0
            ) );
            if ( ! empty( $key_topics ) && ! is_wp_error( $key_topics ) ):  ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="key_topics">
                        <h2 class="section_heading"><?php _e('Spotlight Topics'); ?></h2>
                        <div class="owl-carousel owl-theme">
                            <?php  
                            foreach ( $key_topics as $key_topic ): 
                                if ( $key_topic->term_id == 1 )
                                    continue; // skip 'uncategorized'
                                $key_topic_image = ''; //default/fallback key top image
                                if ( $key_topic->term_image ) {
                                    $key_topic_image = wp_get_attachment_image( $key_topic->term_image, 'wm-topic' );
                                }
                                ?>
                                <div class="item">
                                    <a href="<?php echo get_term_link($key_topic, 'spotlight-topic')?>"><?php echo $key_topic_image; ?></a>
                                    <h2><a href="<?php echo get_term_link($key_topic, 'spotlight-topic')?>"><?php echo $key_topic->name; ?></a></h2>
                                    <p><?php echo $key_topic->description; ?></p>
                                </div>
                             <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="culinary-block">
                        <img src="<?php echo bloginfo('template_directory'); ?>/images/color_of_food.jpg" alt="Color of Food">
                        <div class="data-calinary">
                            <h2>The Color of Food</h2>
                            <p>The Color of Food series is designed to improve understanding of the significance of phytonutrient and nutrient gaps, the GAE connection, the whole food advantage, and the role of specialty crops and the Farm Bill to provide the tools needed to make conscious decisions about our health and the health of the people around us.</p>
                            <a href="<?php echo bloginfo('url'); ?>/interactive-tools/clinical-practice-support/#Color" class="btn btn-theme">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="culinary-block righ-flip">
                        <img src="<?php echo $wm_settings['cultivate_img']; ?>" alt="cultivvate">
                        <div class="data-calinary">
                            <h2><?php _e('Podcast Series'); ?></h2>
                            <p><?php echo wpautop($hpage_text_2); ?></p>
                            <a href="<?php echo $hpage_link_visit; ?>" class="btn btn-theme"><?php _e('Listen Now'); ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="culinary-block">
                        <img src="<?php echo $wm_settings['cul_wellness_img']; ?>" alt="culinary-image">
                        <div class="data-calinary">
                            <h2><?php _e('Culinary Wellness'); ?></h2>
                            <p><?php echo wpautop($hpage_text_1); ?></p>
                            <a href="<?php echo $hpage_link_recipes; ?>" class="btn btn-theme"><?php _e('Recipes'); ?></a>
                            <a href="<?php echo $hpage_link_skill; ?>" class="btn btn-theme"><?php _e('Skill Videos'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(!is_user_logged_in()): ?>
            <div class="account">
                <div class="account-box">
                    <h2><?php _e('Create an Account & Gain Full Access'); ?></h2>
                    <p><?php echo wpautop($hpage_text_signup); ?></p>
                    <a class="btn btn-theme signup_popup" href="<?php echo esc_url(wp_registration_url()); ?>">Sign Up</a>
                </div>
            </div>
        <?php endif; ?>

    </div>
    
<?php get_footer(); ?>