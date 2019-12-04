<?php
/**
 * Template part for displaying audio posts
 *
 */
global $post;
$meta_prefix = WM_META_PREFIX;
?>
<?php 
$rel_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wm-featured');
$rel_feat_image = $rel_feat_image !== false ? $rel_feat_image[0] : '';
if(!$rel_feat_image)
{
    $rel_feat_image = get_bloginfo('template_directory').'/images/article-thumbnail-placeholder.png';
}

$is_premium = rwmb_meta( $meta_prefix.'is_premium' ); 
$read_time = WMHelper::get_post_read_time($post->ID);
$post_date = get_the_date();
switch (get_post_format()) {
	case 'link':
		//$read_time = ''; //comment to display the content read time
		$pType = 'document';
		$pTypeLabel = 'Download';
		$iconLink = '<a href="'.get_the_permalink().'" class="icon-feature"><i class="icon-wrapp"><img src="'. get_template_directory_uri() .'/images/document-down.svg" alt="View"></i></a>';
		break;
	case 'video':
		$read_time = WMHelper::get_post_watch_time($post->ID);
		$pType = 'video';
		$pTypeLabel = 'Video';
		$iconLink = '<a href="'.get_the_permalink().'" class="icon-feature"><i class="icon-wrapp"><img src="'. get_template_directory_uri() .'/images/play-icon.svg" alt="Play"></i></a>';
		break;
	case 'audio':
		$read_time = WMHelper::get_post_listen_time($post->ID);
		$pType = 'audio';
		$pTypeLabel = 'Podcast';
		$iconLink = '<a href="'.get_the_permalink().'" class="icon-feature"><i class="icon-wrapp"><img src="'. get_template_directory_uri() .'/images/audio.svg" alt="Play"></i></a>';
		break;
	default:
		$pType = 'simple';
		$pTypeLabel = 'Article';
		$iconLink = '';

		break;
}
$post_type_name = get_post_type();
if($post_type_name != 'post'){
	$pt_obj = get_post_type_object( $post_type_name );
	$pTypeLabel = $pt_obj->labels->singular_name;
	$read_time = "";
	if($post_type_name == 'wm_recipe'){
		$read_time = WMHelper::get_post_cook_time($post->ID);
		$post_date = '';
	}
	if($post_type_name == 'wm_skill_video'){
		$read_time = WMHelper::get_post_watch_time($post->ID);
	}
}
?>
<div class="box-feature <?php echo esc_attr($pType); ?>">
	<div class="image-side">
		<a href="<?php the_permalink(); ?>">
		<img src="<?php echo $rel_feat_image;?>" alt="Feature Image: <?php echo esc_attr(get_the_title()); ?>">
		</a>
		<?php echo $iconLink; ?>
	</div>

	<div class="feature-data">
		<p class="h3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>

		<p><?php echo WM_get_post_excerpt( get_the_excerpt(), 150 ); ?></p>

		<span class="datetime"><?php echo $pTypeLabel; ?> <?php if(!empty($post_date)): ?>• <?php echo $post_date; ?> <?php endif; ?><?php if(!empty($read_time)): ?>• <?php echo $read_time; ?><?php endif; ?></span>

        <?php echo do_shortcode('[wm-bookmark-link]'); ?>

		<?php if($is_premium): ?>
			<span class="badge"><?php _e('PREMIUM'); ?></span>
            <div class="premium-info">
                <span class="premium-info-btn">i</span>
                <div class="premium-info-popup">
                    <h4>Join Our Community to Read Further</h4>
                    <p>This is a premium article created for our Healthcare Practitioner readers. Create a free account to continue reading and gain full access.</p>
                    <a href="#" class="btn signup_popup">Create a Free Account</a>
                </div>
            </div>
		<?php endif; ?>

	</div>

</div>