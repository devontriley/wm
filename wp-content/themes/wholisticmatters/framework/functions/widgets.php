<?php
/**
 * Recent Posts Widget
 */
class recentwidget extends WP_Widget {
    /** constructor */
    function recentWidget() {
        parent::WP_Widget(false, $name = 'Anaheim - Coupon');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );		
        $title = apply_filters('widget_title', $instance['title']);	
		
?>
		<?php //echo $before_widget; ?>
		<?php //if ( $title ) echo $title; ?>
		        	<a href="<?php echo $title; ?>" target="_blank"><img style="border:0;" src="<?php bloginfo('template_url'); ?>/images/coupon-home.png" width="174" height="307" /></a>
		<?php //echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		
	}
	
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }

} // class FooWidget
add_action('widgets_init', create_function('', 'return register_widget("recentwidget");'));





/**
 * Popular Posts Class
 */
class popularwidget extends WP_Widget {
    /** constructor */
    function popularWidget() {
        parent::WP_Widget(false, $name = 'Her - Popular Posts');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $query = array('showposts' => 4, 'nopaging' => 0, 'orderby'=> 'comment_count', 'post_status' => 'publish', 'caller_get_posts' => 1);
        $r = new WP_Query($query);
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="thumbnail-list">
<?php  while ($r->have_posts()) : $r->the_post(); ?>
			<li>
            <?php if (has_post_thumbnail() ): ?>
				<a class="thumbnail" href="<?php echo get_permalink() ?>" title="<?php the_title();?>">
					<?php the_post_thumbnail(array(60,60),array('title'=>get_the_title(),'alt'=>get_the_title())); ?>
				</a>
            <?php endif;//end has_post_thumbnail ?>
            
			<span class="thumbnail_list_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></span>
		
			<div class="clearboth"></div>
			</li>
<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_query();

		endif;
	}

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }

} // class FooWidget
add_action('widgets_init', create_function('', 'return register_widget("popularwidget");'));


/*
Flickr Widget
*/
class flickrwidget extends WP_Widget {
	function flickrWidget() {
		parent::WP_Widget(false, $name = 'Her - Flickr Widget');
	}
	
	function widget($args, $instance) {
		extract ( $args );
		global $wpdp;
		$title = apply_filters('widget_title', $instance['title']);
		$settings = get_option("widget_flickrwidget");

		$id = $settings['id'];
		$number = $settings['number'];
	
		echo $args['before_widget'];
		if ( $title ) echo $before_title . $title . $after_title;
		?>

        <div id="flickr">
            <div class="wrap">
                <div class="fix"></div>
                <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>        
                <div class="fix"></div>
            </div>
        </div>
        
		<?php
		echo $args['after_widget'];
	}
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
	
	/** @see WP_Widget::form */
    function form($instance) {				
	$title = esc_attr($instance['title']); ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
    <?php
    $settings = get_option("widget_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));

		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';
    
	}
}
add_action('widgets_init', create_function('', 'return register_widget("flickrwidget");'));

?>