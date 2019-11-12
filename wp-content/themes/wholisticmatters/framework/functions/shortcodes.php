<?php

// Remove Randomly Generated Paragraph & newline tags
function remove_wpautop($content) { 
    $content = do_shortcode( shortcode_unautop($content) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}

/*###################################################
# GALLERY SHORTCODE
###################################################*/
add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = apply_filters('gallery_style', "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
				margin-top: 25px;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 2px;
                text-align: center;
                width: {$itemwidth}%;           
			}
            #{$selector} img {

            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->
        <div id='$selector' class='gallery galleryid-{$id}'>");

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        /* Add the image. */
		$img_lnk = wp_get_attachment_image_src($id, 'full');
		$img_lnk = $img_lnk[0];

		$img_src = wp_get_attachment_image_src( $id, $size );
		$img_src = $img_src[0];
		
		$img_alt = wptexturize( esc_html($attachment->post_excerpt) );
		
		if ( $img_alt == null )
			$img_alt = $attachment->post_title;
		switch($lightboxtitle){
			case 'caption':
				$lightbox_title = wptexturize( esc_html($attachment->post_excerpt) );
				break;
			case 'title':
				$lightbox_title = $attachment->post_title;
				break;
			case 'none':
			default:
				$lightbox_title = '';
		}
		$img_class = apply_filters( 'gallery_img_class', (string) 'gallery-image' ); // Available filter: gallery_img_class
		$img_rel = 'group-' . $post->ID;
		$image  =  '<img src="' . $img_src . '" alt="' . $img_alt . '" class="' . $img_class . ' attachment-' . $size . '" />';
		
		if(isset( $attr['link'] ) && 'file' == $attr['link']){
			$image = '<a href="' . $img_lnk . '" rel="prettyPhoto[gal]">'.$image.'</a>';
		}else{
			$image = '<a href="' . $img_lnk . '" rel="prettyPhoto[gal]">'.$image.'</a>';
		}
		
		$output .= '<div class="gallery-item">';
		$output .= $image;
		$output .= '</div>';
	}
	
	$output .= '</div>';

    return $output;
}

/*###################################################
# LIGHTBOX SHORTCODE
###################################################*/
function image_lightbox ( $atts, $content = null) {
	extract(shortcode_atts(array(
		'link'		=> '',
		'title' 	=> '',
		), $atts));
		
		$out = "<a href=\"" .$link. "\" rel=\"prettyPhoto\" title=\"" .$title. "\" alt=\"" .$title. "\">" .remove_wpautop($content). "</a>";
		
		return $out;
}
add_shortcode('lightbox', 'image_lightbox');

/*###################################################
# LIST SHORTCODES
###################################################*/
function list_styles ( $atts, $content = null) {
	extract(shortcode_atts(array(
		'style'		=> '',
		), $atts));
		
		$out = "<div class=\"list_".$style."\">".remove_wpautop($content)."</div>";
		
		return $out;
}
add_shortcode('list', 'list_styles');


/*###################################################
# BUTTON SHORTCODES
###################################################*/
function caden_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '',
		'color'     => '',
		'size'      => '',
		'type'		=> '',
    ), $atts));

	if($type == "") {
		$out = "<a href=\"" .$link. "\" class=\"button b_" .$color. " b_" .$size. "\">" .remove_wpautop($content). "</a>";
	} else {
		$out = "<div class=\"button b_" .$color. " b_" .$size. "\">" .remove_wpautop($content). "</div>";
	}
    
    return $out;
}
add_shortcode('button', 'caden_button');


/*###################################################
# Toggle Shortcode
###################################################*/
function theme_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle"><h4 class="toggle_title">' . $title . '</h4><div class="toggle_content">' . remove_wpautop($content) . '</div></div>';
}
add_shortcode('toggle', 'theme_shortcode_toggle');



/*###################################################
# Highlight Shortcodes
###################################################*/
function caden_highlight( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'color'     => '',
    ), $atts));

	return '<span class="highlight_' .$color. '">' .do_shortcode($content). '</span>';
}
add_shortcode('highlight', 'caden_highlight');



/*###################################################
# Blockquote Shortcodes
###################################################*/
function caden_blockquote( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'align'     => '',
		'cite'		=> '',
    ), $atts));

	if($align == "") {
		return '<blockquote class="block">' .do_shortcode($content). '<br /><cite>- ' .$cite. '</cite></blockquote>';
	}  else {
		return '<blockquote class="align'.$align.'">' .do_shortcode($content). '</blockquote>';
	}
}
add_shortcode('blockquote', 'caden_blockquote');



/*###################################################
# Image Shortcodes
###################################################*/
function caden_imagealign( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'align'     => '',
    ), $atts));

	return '<div class="image' .$align. '">' .do_shortcode($content). '</div>';
}
add_shortcode('image', 'caden_imagealign');



/*###################################################
# Styled Boxes Shortcodes
###################################################*/

// Error styled box
function caden_errorbox( $atts, $content = null ) {
	return '<div class="error"><img src="' .get_template_directory_uri(). '/images/erroricon.gif" class="icon" />' . do_shortcode($content) . '</div>';
}
add_shortcode('error', 'caden_errorbox');

// Success styled box
function caden_successbox( $atts, $content = null ) {
	return '<div class="success"><img src="' .get_template_directory_uri(). '/images/successicon.gif" class="icon" />' . do_shortcode($content) . '</div>';
}
add_shortcode('success', 'caden_successbox');

// Info styled box
function caden_infobox( $atts, $content = null ) {
	return '<div class="info"><img src="' .get_template_directory_uri(). '/images/infoicon.gif" class="icon" />' . do_shortcode($content) . '</div>';
}
add_shortcode('info', 'caden_infobox');

// Note box
function caden_notebox( $atts, $content = null ) {
	return '<div class="note"><img src="' .get_template_directory_uri(). '/images/noteicon.gif" class="icon" />' . do_shortcode($content) . '</div>';
}
add_shortcode('note', 'caden_notebox');



/*###################################################
# Typography Shortcodes
###################################################*/

function caden_dropcap( $atts, $content = null ) {
    return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'caden_dropcap');

function caden_dropcap_two( $atts, $content = null ) {
    return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2', 'caden_dropcap_two');



/*###################################################
# Column Shortcodes
###################################################*/

function caden_onethird( $atts, $content = null ) {
	return '<div class="one_third">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_third', 'caden_onethird');

function caden_onethirdlast( $atts, $content = null ) {
	return '<div class="one_third last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_third_last', 'caden_onethirdlast');

// One half
function caden_onehalf( $atts, $content = null) {
	return '<div class="one_half">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_half', 'caden_onehalf');

// One half last
function caden_onehalflast( $atts, $content = null) {
	return '<div class="one_half last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_half_last', 'caden_onehalflast');

// One fourth column shortcode 
function caden_onefourth( $atts, $content = null) {
	return '<div class="one_fourth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_fourth', 'caden_onefourth');

// One fourth column last shortcode 
function caden_onefourthlast( $atts, $content = null) {
	return '<div class="one_fourth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_fourth_last', 'caden_onefourthlast');

// Three fourth
function caden_threefourth( $atts, $content = null) {
	return '<div class="three_fourth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('three_fourths', 'caden_threefourth');

// Three fourth last
function caden_threefourthlast( $atts, $content = null) {
	return '<div class="three_fourth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('three_fourths_last', 'caden_threefourthlast');

// Two thirds column shortcode 
function caden_twothirds( $atts, $content = null) {
	return '<div class="two_third">' . remove_wpautop($content) . '</div>';
}
add_shortcode('two_thirds', 'caden_twothirds');

// Two thirds column shortcode 
function caden_twothirdslast( $atts, $content = null) {
	return '<div class="two_third last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('two_thirds_last', 'caden_twothirdslast');


// One fifth
function caden_onefifth( $atts, $content = null) {
	return '<div class="one_fifth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_fifth', 'caden_onefifth');

// One fifth last
function caden_onefifthlast( $atts, $content = null) {
	return '<div class="one_fifth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_fifth_last', 'caden_onefifthlast');

// Two fifth
function caden_twofifth( $atts, $content = null) {
	return '<div class="two_fifth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('two_fifths', 'caden_twofifth');

// Two fifth last
function caden_twofifthlast( $atts, $content = null) {
	return '<div class="two_fifth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('two_fifths_last', 'caden_twofifthlast');

// Three fifth
function caden_threefifth( $atts, $content = null) {
	return '<div class="three_fifth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('three_fifths', 'caden_threefifth');

// Three fifth last
function caden_threefifthlast( $atts, $content = null) {
	return '<div class="three_fifth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('three_fifths_last', 'caden_threefifthlast');

// Four firths
function caden_fourfifth( $atts, $content = null) {
	return '<div class="four_fifth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('four_fifths', 'caden_fourfifth');

// Four firths last
function caden_fourfifthlast( $atts, $content = null) {
	return '<div class="four_fifth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('four_fifths_last', 'caden_fourfifthlast');

// One sixth
function caden_onesixth( $atts, $content = null) {
	return '<div class="one_sixth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_sixth', 'caden_onesixth');

// One sixth last
function caden_onesixthlast( $atts, $content = null) {
	return '<div class="one_sixth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_sixth_last', 'caden_onesixthlast');

?>