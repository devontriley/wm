<?php 
// Define Directory Constants 

define('CADEN_FRAME', TEMPLATEPATH . '/framework');

define('CADEN_ADMIN', CADEN_FRAME . '/admin');

define('CADEN_FUNCTIONS', CADEN_FRAME . '/functions');

define('CADEN_JS', get_template_directory_uri() . '/js');

define('CADEN_INCLUDES', '/includes');


// Load Admin Options

require_once(CADEN_ADMIN . '/options.php');

// Load Admin Interface

require_once(CADEN_ADMIN . '/theme.php');

// Load Header Javascript Files

require_once(CADEN_FUNCTIONS . '/scripts.php');


define('WM_INCLUDES', TEMPLATEPATH . '/includes');

include_once(WM_INCLUDES . '/functions.php');

/*********************
LAUNCH THEME
Let's get everything up and running.
*********************/

function ccs_after_setup_theme() {
  // launching this stuff after theme setup
  WM_theme_support();
  
} /* end ahoy */
// let's get this party started
add_action( 'after_setup_theme', 'ccs_after_setup_theme' );
/*********************
THEME SUPPORT
*********************/
// Adding WP 3+ Functions & Theme Support
function WM_theme_support() {
	// wp thumbnails 
	add_theme_support( 'post-thumbnails' );
	// default thumb size
	set_post_thumbnail_size(180, 180, true);
	// rss thingy
	add_theme_support('automatic-feed-links');
	// post type supports
	add_post_type_support( 'page', 'excerpt' );
	
	// cleaning up excerpt
	add_filter( 'excerpt_more', 'WM_excerpt_more' );
	// cleaning up random code around images
	add_filter( 'the_content', 'WM_filter_ptags_on_images' );
	
	// adding post format support
	add_theme_support( 'post-formats',
		array(
//			'aside',             // title less blurb
//			'gallery',           // gallery of images
			'link',              // quick link to other site
//			'image',             // an image
//			'quote',             // a quick quote
//			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
//			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	/******************************************************************************
	*	Registering nav menus
	******************************************************************************/

	register_nav_menus(
		array(
			'primary' => __('Primary Menu')
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );
	
	//remove_filter('the_content', 'wpautop');

} /* end theme support */

/******************************************************************************
 *	Load Script Files
 ******************************************************************************/

function theme_scripts() {
	wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime());
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('popper-js', get_template_directory_uri()."/js/popper.min.js", NULL, '', true);
	wp_enqueue_script('bootstrap-js', get_template_directory_uri()."/js/bootstrap.js", array('popper-js'), '', true);
	wp_enqueue_script('jquery-validate', get_template_directory_uri()."/js/jquery.validate.js", NULL, '', true);
	wp_enqueue_script('owl-js', get_template_directory_uri()."/js/owl.carousel.js", NULL, '', true);
    wp_enqueue_script('js-cookie', get_template_directory_uri()."/js/js.cookie.js", NULL, '', true);
	wp_enqueue_script('main-js', get_template_directory_uri()."/build/js/index.min.js", NULL, '', true);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );


// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function WM_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
// Fixing the Read More in the Excerpts
// This removes the annoying […] to a Read More link
function WM_excerpt_more($more) {
   global $post;
   // edit here if you like
   return '...';
   //return '...  <a href="'. get_permalink($post->ID) . '" class="more-link button nice radius" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function WM_page_navi() {
  global $wp_query;
  $bignum = 999999999;
  if ( $wp_query->max_num_pages <= 1 )
    return;
  echo '<nav class="pagination">';
  echo paginate_links( array(
    'base'         => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
    'format'       => '',
    'current'      => max( 1, get_query_var('paged') ),
    'total'        => $wp_query->max_num_pages,
    'prev_text'    => '&larr;',
    'next_text'    => '&rarr;',
    'type'         => 'list',
    'end_size'     => 3,
    'mid_size'     => 3
  ) );
  echo '</nav>';
} /* end page navi */




//// Murtaza Code

function wm_pages_setup_( $meta_boxes ) {
	$prefix = 'wm-';

	$meta_boxes[] = array(
		'id' => 'pagehero',
		'title' => esc_html__( 'Pages Hero Banner Setings', 'metabox-online-generator' ),
		'post_types' => array('page','post' ),
		'context' => 'after_editor',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'cat_name',
				'type' => 'text',
				'name' => esc_html__( 'Category Name', 'metabox-online-generator' ),
				'desc' => esc_html__( 'In this field Add Hero banner Title', 'metabox-online-generator' ),
				'placeholder' => esc_html__( 'Category Name here', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'hero_title',
				'type' => 'text',
				'name' => esc_html__( 'Main Title', 'metabox-online-generator' ),
				'desc' => esc_html__( 'In this field Add Hero banner Title', 'metabox-online-generator' ),
				'placeholder' => esc_html__( 'Hero Title here', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'hero_dtl',
				'type' => 'textarea',
				'name' => esc_html__( 'Hero Banner Detail', 'metabox-online-generator' ),
			),
			array(
				'id' => $prefix . 'image_hero',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Image for Hero Banner', 'metabox-online-generator' ),
			),
		),
	);

	return $meta_boxes;
}
//add_filter( 'rwmb_meta_boxes', 'wm_pages_setup_' );




/// DEVON CODE

function render_newsletter_signup($attributes, $content = null) {
    $url = get_theme_root() . '/wholisticmatters/template-parts/newsletter-signup.php';

    ob_start(); ?>
    <div class="newsletter-shortcode">
        <?php include($url); ?>
    </div>
    <?php $content = ob_get_clean();
    return $content;
}
add_shortcode('wm-newsletter-signup', 'render_newsletter_signup');


function card_shortcode($atts , $content = null) {
    $a = shortcode_atts( array(
        'title' => ''
    ), $atts );

    ob_start(); ?>

    <div class="card">
        <div class="card-body">
            <p class="card-title h5"><?php echo $a['title'] ?></p>
            <p><?php echo $content ?></p>
        </div>
    </div>

    <?php $html = ob_get_clean();
    return $html;
}
add_shortcode( 'card', 'card_shortcode' );


function video_embed($atts, $content = null) {
    $a = shortcode_atts(array(
        'id' => ''
    ), $atts);
    $html = '<div class="video-embed embed-responsive embed-responsive-16by9"><iframe width="560" height="315" src="https://www.youtube.com/embed/'. $a['id'] .'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';

    return $html;
}

add_shortcode('video-embed', 'video_embed');


function podcast_embed($atts, $content = null) {
    $a = shortcode_atts(array(
        'id' => ''
    ), $atts);

    $podcast_file = WMHelper::get_podcast_url('mp3', $a['id']);
    $podcast_file_ogg = WMHelper::get_podcast_url('ogg', $a['id']);

    $terms = get_the_terms( $a['id'], 'series' );
    $term = array_pop($terms);

    $spotify = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_soptify' );
    $apple = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_apple' );
    $itunes = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_itunes' );

    $series_thumb = '';
    if ( $term->term_image ) {
        $series_thumb_data = wp_get_attachment_image_src( $term->term_image, 'wm-topic' );
        $series_thumb = isset($series_thumb_data[0]) ? $series_thumb_data[0] : $series_thumb;
    }

    ob_start(); ?>

    <div class="podcast-embed">
        <div class="album-block">
            <div class="sm-wrapp">
                <div class="album-data">
                    <div class="image-side-album" style="<?php echo 'background-image:url(\''. $series_thumb .'\');'?>">
                        <a href="<?php echo get_permalink($a['id']); ?>" class="stretched-link"></a>
                    </div>
                    <div class="content-side-album podcast-metadata">
                        <h2 class="entry-title"><?php echo get_the_title($a['id']); ?></h2>
                        <p><?php _e('Series:'); ?> <?php echo $term->name;  ?></p>
                        <p><?php _e('Host:'); ?> <?php echo WMHelper::get_term_meta_text( $term->term_id, 'wm_series_host' ); ?></p>
                        <span><a href="<?php echo $podcast_file; ?>" target="_blank"><?php _e('Download'); ?></a></span> <span>
						<ul>
							<li><?php _e('Find Us On:'); ?></li>
							<li><a href="<?php echo esc_attr($spotify); ?>" target="_blank" rel="noopener noreferrer"><?php _e('Spotify'); ?></a></li>
							<li><a href="<?php echo esc_attr($apple); ?>" target="_blank" rel="noopener noreferrer"><?php _e('Apple Music'); ?></a></li>
							<li><a href="<?php echo esc_attr($itunes); ?>" target="_blank" rel="noopener noreferrer"><?php _e('iTunes'); ?></a></li>
						</ul>
					</span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="audio-album">
            <?php echo do_shortcode('[audio mp3="'. $podcast_file .'" ogg="'. $podcast_file_ogg .'"][/audio]'); ?>
        </div>
    </div>

    <?php
    $html = ob_get_clean();
    return $html;
}
add_shortcode('podcast-embed', 'podcast_embed');


function article_embed($atts, $content = null) {
    $a = shortcode_atts(array(
        'id' => '',
        'header' => ''
    ), $atts);

    $post = get_post($a['id']);
    setup_postdata( $post );

    $pType = 'simple';
    $pTypeLabel = 'Article';
    $iconLink = '';

    $meta_prefix = WM_META_PREFIX;
    $post_thumbnail_id = get_post_thumbnail_id($a['id']);
    $rel_feat_image = wp_get_attachment_image_src($post_thumbnail_id, 'wm-featured');
    $rel_feat_image = $rel_feat_image !== false ? $rel_feat_image[0] : '';
    $is_premium = rwmb_meta( $meta_prefix.'is_premium' );
    $read_time = WMHelper::get_post_read_time($a['id']);
    $post_date = get_the_date(null, $a['id']);

    ob_start(); ?>

    <div class="article-embed">
        <p class="h4"><?php echo $a['header'] ?></p>

        <div class="box-feature <?php echo $pType; ?>">
            <div class="image-side">
                <a href="<?php echo get_the_permalink($a['id']); ?>">
                    <img src="<?php echo $rel_feat_image;?>" alt="Feature Image: <?php echo esc_attr(get_the_title($a['id'])); ?>">
                </a>
                <?php echo $iconLink; ?>
            </div>
            <div class="feature-data">
                <h2><a href="<?php echo get_the_permalink($a['id']); ?>"><?php echo get_the_title($a['id']); ?></a></h2>
                <p><?php echo WM_get_post_excerpt( get_the_excerpt($a['id']), 150 ); ?></p>
                <span class="datetime"><?php echo $pTypeLabel; ?> <?php if(!empty($post_date)): ?>• <?php echo $post_date; ?> <?php endif; ?><?php if(!empty($read_time)): ?>• <?php echo $read_time; ?><?php endif; ?></span>
                <?php echo do_shortcode('[wm-bookmark-link]'); ?>
                <?php if($is_premium): ?>
                    <span class="badge"><?php _e('PREMIUM'); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php
    $html = ob_get_clean();
    return $html;

    wp_reset_postdata();
}
add_shortcode('article-embed', 'article_embed');