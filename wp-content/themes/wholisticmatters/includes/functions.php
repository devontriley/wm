<?php
if(!defined('WM_META_PREFIX')){
	define( 'WM_META_PREFIX', '_wm_' );
}
include_once(WM_INCLUDES . '/bs4_nav_walker.php');

if ( ! isset( $content_width ) ) {
	$content_width = 770;
}

function WM_get_current_path(){
	global $wp;
	$current_path = isset($wp->request) && !empty($wp->request) ? $wp->request : '/member-account';
	return $current_path;
}

function WM_get_current_url(){
	$current_path = WM_get_current_path();
	return site_url($current_path);
}

function WM_after_setup_theme() {
    /*
    Register Navbar
    */
    register_nav_menus( 
        array( 
            'primary' =>  __('Primary Menu') ,
            'footer' =>  __('Footer Menu') 
        ) 
    );
    
    add_image_size( 'wm-featured', 180, 160, true );
    add_image_size( 'wm-topic', 377, 275, true );
}
add_action( 'after_setup_theme', 'WM_after_setup_theme' );

function WM_widgets_init() {
    $location = 'primary';
    $locations = get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
        $menu = get_term( $locations[ $location ], 'nav_menu' );
        if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
            foreach ( $items as $item ) {
                $is_megamenu = get_post_meta($item->ID, 'menu-item-megamenu', true); 
                if ( $is_megamenu == 'yes' ) {
                    register_sidebar( array(
                        'id'   => 'mega-menu-widget-area-' . $item->ID,
                        'name' => $item->title . ' - Mega Menu',
                        'description'   => __('Add contents to '.$item->title .' menu item.'),
                        'before_widget' => '<div id="%1$s" class="menuwidget block-dropdown %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h3 class="menuwidget_title">',
                        'after_title'   => '</h3>'
                    ) );
                }
            }
        }
    }
}
add_action( 'widgets_init', 'WM_widgets_init' );

function WM_mime_types($mime_types){
    // New allowed mime types.
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types['svgz'] = 'image/svg+xml';
    $mime_types['doc'] = 'application/msword'; 
    $mime_types['mp3'] = 'audio/mpeg';
    $mime_types['wav'] = 'audio/wav';
    $mime_types['ogg'] = 'audio/ogg';
    return $mime_types;
}
add_filter('upload_mimes', 'WM_mime_types', 1, 1);

function WM_get_post_excerpt( $post_content = false, $count = 150 ) {
	global $post;
	if( $post_content === false ){
		$post_content = $post->post_content;
	}
	if( strlen($post_content) > $count ){
		$post_content = substr($post_content, 0, $count );
		$post_content = substr($post_content, 0, strrpos($post_content, " "));
		$post_content = $post_content.'...';
	}
	return $post_content;
}


/**
 * Add an HTML class to MediaElement.js container elements to aid styling.
 *
 * Extends the core _wpmejsSettings object to add a new feature via the
 * MediaElement.js plugin API.
 */
add_action( 'wp_print_footer_scripts', 'WM_mejs_add_container_class' );
function WM_mejs_add_container_class() {
	if ( ! wp_script_is( 'mediaelement', 'done' ) ) {
		return;
	}
	?>
	<script>
	(function() {
		var settings = window._wpmejsSettings || {};
		settings.features = settings.features || mejs.MepDefaults.features;
		settings.features.push( 'exampleclass' );
		MediaElementPlayer.prototype.buildexampleclass = function( player ) {
			player.container.addClass( 'mytheme-mejs-container' );
		};
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'WM_theme_footer_scripts' );
function WM_theme_footer_scripts() {
	if ( wp_style_is( 'wp-mediaelement', 'enqueued' ) ) {
		wp_enqueue_style( 'wm-player', get_template_directory_uri() . '/css/custom-player.css', array(
			'wp-mediaelement',
		), '1.0' );
	}
}

/*Change menu-order*/
add_filter( 'custom_menu_order', 'WM_submenu_order' );
function WM_submenu_order( $menu_ord ) 
{
    global $submenu;

    // Enable the next line to see all menu orders
    //echo '<pre>'.print_r($submenu,true).'</pre>';

    $arr = array();
    $tagItem = false;
    foreach ($submenu['edit.php'] as $priority => $submenuItem) {
        if($submenuItem[1] == 'manage_post_tags'){
            $tagItem = $submenuItem;
            continue;
        }
        $arr[$priority] = $submenuItem;
    }
    $arr[99] = $tagItem;     //my original order was 5,10,15,16,17,18
    $submenu['edit.php'] = $arr;

    return $menu_ord;
}

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
		/* translators: Category archive title. 1: Category name */
		$title = sprintf( __( '%s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		/* translators: Tag archive title. 1: Tag name */
		$title = sprintf( __( '%s' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		/* translators: Author archive title. 1: Author name */
		$title = sprintf( __( '%s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		/* translators: Yearly archive title. 1: Year */
		$title = sprintf( __( '%s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
	} elseif ( is_month() ) {
		/* translators: Monthly archive title. 1: Month name and year */
		$title = sprintf( __( '%s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
	} elseif ( is_day() ) {
		/* translators: Daily archive title. 1: Date */
		$title = sprintf( __( '%s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Downloads', 'post format archive title' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Podcasts', 'post format archive title' );
		} 
	} elseif ( is_post_type_archive() ) {
		/* translators: Post type archive title. 1: Post type name */
		$title = sprintf( __( '%s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
	} else {
		$title = __( 'Archives' );
	}
 
    return $title;
});


add_action('wm_floating_links', 'WM_floating_social_links');
function WM_floating_social_links(){
	?>
	<div class="floating-icons addthis_toolbox addthis_default_style">
		<a class="addthis_button_facebook"><img src="<?php bloginfo('template_url'); ?>/images/fb.svg" alt="fb.svg"></a>
		<a class="addthis_button_twitter"><img src="<?php bloginfo('template_url'); ?>/images/twitter.svg" alt="twitter.svg"></a>
		<a class="addthis_button_linkedin"><img src="<?php bloginfo('template_url'); ?>/images/linkedin.svg" alt="linkedin.svg"></a>
		<?php echo do_shortcode('[wm-bookmark-link]'); ?>
	</div>
	<?php
}

add_action('wm_single_share', 'WM_wm_single_share_links');
function WM_wm_single_share_links(){
	global $post;
	?>
	<?php echo do_shortcode('[wm-bookmark-link]'); ?>
	<a href="#." data-toggle="popover"  data-trigger="focus" data-placement="right" data-target="#wm_single_share"><img src="<?php echo get_template_directory_uri(); ?>/images/Share-Icon.svg" alt="bookmark"> <span>Share</span></a>
	<div id="wm_single_share" style="display:none;">
		<div class="wm_single_share_links addthis_toolbox addthis_default_style">
			<!--
			<a class="addthis_button_facebook"><?php echo file_get_contents( get_stylesheet_directory_uri() . '/images/fb.svg' ); ?></a>
			<a class="addthis_button_twitter"><?php echo file_get_contents( get_stylesheet_directory_uri() . '/images/twitter.svg' ); ?></a>
			<a class="addthis_button_linkedin"><?php echo file_get_contents( get_stylesheet_directory_uri() . '/images/linkedin.svg' ); ?></a>
			-->
            <a class="addthis_button_facebook"><img src="<?php echo get_stylesheet_directory_uri() . '/images/fb.svg' ?>" alt="Facebook" /></a>
            <a class="addthis_button_twitter"><img src="<?php echo get_stylesheet_directory_uri() . '/images/twitter.svg' ?>" alt="Twitter" /></a>
            <a class="addthis_button_linkedin"><img src="<?php echo get_stylesheet_directory_uri() . '/images/linkedin.svg' ?>" alt="Linkedin" /></a>
			<a href="<?php echo get_the_permalink($post); ?>" class="js_wm_copy_link link-primary"><?php _e('Copy Link'); ?></a>
		</div>
	</div>
    <div style="display: none;">
        <?php print_r($fbIcon); ?>
    </div>
	<?php
}

add_filter( 'body_class', 'WM_restrict_the_content_class' );
function WM_restrict_the_content_class( $classes ) {
	global $post;
	if(isset($post->ID)){
		$meta_prefix = WM_META_PREFIX;
		$is_premium = rwmb_meta( $meta_prefix.'is_premium' , array(), $post->ID); 
		if( is_singular() && !is_user_logged_in() && $is_premium ) {
			$classes[] = 'wm_is_premium';
		}
		
		//add slug as class
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
    return $classes;
}
function WM_restrict_the_content() {
	global $post;
	if(isset($post->ID)){
		$meta_prefix = WM_META_PREFIX;
		$is_premium = rwmb_meta( $meta_prefix.'is_premium' , array(), $post->ID); 
		if( is_singular() && is_main_query() && !is_user_logged_in() && $is_premium ) {
			$settings = Wholistic_Matters::get_settings();
			$gated_para = ( isset( $settings['gated_para'] ) && $settings['gated_para'] ) ? $settings['gated_para'] : '';
			ob_start();
			?>
			<div class="wm_gated_content">
				<div class="sm-wrapp summary">
					<h5 class="wm_gated_content_title"><?php _e('Join Our Community to Read Further'); ?></h5>
					<div class="wm_gated_content_text"><?php echo wpautop($gated_para); ?></div>
					<a class="cta_filled signup_popup" href="<?php echo esc_url(wp_registration_url()); ?>">Sign Up</a> 
				</div>
			</div>
			<?php
			$new_content = ob_get_clean();
			echo $new_content;
		}	
	}	
}
add_action('wm_gated_content', 'WM_restrict_the_content');
function WM_parse_the_content($content) {
	global $post;
	if(!get_post_format($post->ID) && is_single()){
		$meta_prefix = WM_META_PREFIX;
		$is_premium = rwmb_meta( $meta_prefix.'is_premium' , array(), $post->ID); 
		if( !is_user_logged_in() && $is_premium ) {
			return strip_shortcodes($content);
		}	
	}	
	return $content;
}
add_filter('the_content', 'WM_parse_the_content');


/**
 * Adds a responsive embed wrapper around oEmbed content
 * @param  string $html The oEmbed markup
 * @param  string $url  The URL being embedded
 * @param  array  $attr An array of attributes
 * @return string       Updated embed markup
 */
function WM_responsive_embed($output, $data, $url) {
    return $output!=='' ? '<div class="embed-container">'.$output.'</div>' : '';
}
// Filters the oEmbed process to run the responsive_embed() function
add_filter('oembed_dataparse', 'WM_responsive_embed', 10, 3);
	
////
function WM_replace_permalink( $link )
{
	global $post;
    $is_premium = get_post_meta( $post->ID, WM_META_PREFIX.'is_premium', TRUE );
	if( $is_premium && (!is_user_logged_in() || current_user_can('non-hcp'))  && get_post_type($post) == 'page' ){
		$link  = add_query_arg('is_premium','1', $_SERVER['http_referrer']);
	}
    return $link;
}
add_filter( 'the_permalink', 'WM_replace_permalink', 10, 1 );

add_filter( 'wm_nav_menu_link_attributes', 'WM_add_menu_atts', 10, 3 );
function WM_add_menu_atts( $atts, $item, $args )
{
	$page_id = get_post_meta( $item->ID, '_menu_item_object_id', TRUE );
	if( $page_id && get_post_type($page_id) == 'page' ){
		$is_premium = get_post_meta( $page_id, WM_META_PREFIX.'is_premium', TRUE );
		if( $is_premium && (!is_user_logged_in() || current_user_can('non-hcp')) ){ //if a user is not loggedin or has a role of non-hcp
			$atts .= ' data-is_premium="1"';
		}
	}
	return $atts;
}
add_action( 'template_redirect', 'WM_redirect_user_to_page' );
function WM_redirect_user_to_page()
{
	global $post;
    $is_premium = get_post_meta( $post->ID, WM_META_PREFIX.'is_premium', TRUE );
	if(is_page() && $is_premium && (!is_user_logged_in() || current_user_can('non-hcp')) ){
		$wm_settings = Wholistic_Matters::get_settings();
		$interactive_tools_page = ( isset( $wm_settings['interactive_tools_page'] ) && $wm_settings['interactive_tools_page'] ) ? intval($wm_settings['interactive_tools_page']) : 0;
		$redirectUrl = $interactive_tools_page > 0 ? get_permalink($interactive_tools_page) : site_url('/');
		$link  = add_query_arg('is_premium','1', $redirectUrl);
		wp_redirect( $link );
        exit;
	}
}

function WM_custom_youtube_querystring( $html, $url, $args ) {
	if(strpos($html, 'youtube') !== FALSE) {
		$args = [
			'rel' => 0,
			'controls' => 1,
			'showinfo' => 0,
			'modestbranding' => 1,
		];
		$params = '?feature=oembed&';
		foreach($args as $arg => $value){
			$params .= $arg;
			$params .= '=';
			$params .= $value;
			$params .= '&';
		}
		$result = str_replace( '?feature=oembed', $params, $html );
	}
	return $result;
}
add_filter('oembed_result', 'WM_custom_youtube_querystring', 10, 3);
 


//mail debuggings code
function WM_wp_mail_failed( $error ) {
	$time = date( "F jS Y, H:i", time()+25200 );
    $ban = "#$time\r\n".print_r($error,1)."\r\n"; 
    $file = get_stylesheet_directory() . '/includes/errors.txt'; 
    $open = fopen( $file, "a" ); 
    $write = fputs( $open, $ban ); 
    fclose( $open );
}
//add_action('wp_mail_failed', 'WM_wp_mail_failed');
	
//ToDo if user manual activation is required to allow login
//function wpse_293904_authenticate( $user, $username, $password ) {
//  $user_status = get_custom_user_status_from_username( $username );
//  if( ! $user_status ) {
//    $error = new WP_Error();
//    $error->add( 403, 'Oops. Some error message.' );
//    return $error;
//  }
//  return $user;
//}
//add_filter( 'authenticate', 'wpse_293904_authenticate', 20, 3 );