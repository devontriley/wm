<?php

class WM_Tax_List_Widget extends WP_Widget {

    /**
     * Administrative settings.
     *
     * @since	2.3.3
     * @var		array
     */
    private $admin_options = array();

    public function __construct(){

        // Create the widget
        parent::__construct(
            'WM_Tax_List_Widget',
            'WM Taxonomy Terms List',
            array(
                'classname'		=>	'wm_tax_terms_list',
                'description'	=>	__( 'Display a Taxonomy Terms List. To be used for Megamenu Sidebar.' )
            )
        );

    }

    /**
     * Outputs the content of the widget.
     *
     * @since	1.0.0
     * @param	array	args		The array of form elements
     * @param	array	instance	The current instance of the widget
     */
    public function widget( $args, $instance ){
       $wm_settings = Wholistic_Matters::get_settings();
        //echo "\n" . $before_widget . "\n";

        $title = ( isset( $instance[ 'title' ] ) ) ? $instance['title']  : '';
        $tax = ( isset( $instance[ 'tax' ] ) ) ? $instance['tax']  : 'category'; 
        $link = ( isset( $instance[ 'link' ] ) ) ? $instance['link']  : ''; 
        $link_lbl = ( isset( $instance[ 'link_lbl' ] ) && !empty($instance[ 'link_lbl' ]) ) ? $instance['link_lbl']  : 'View All'; 
        
        $title = apply_filters( 'widget_title', $instance['title'] );
//        $titleHtml = $before_title . $title . $after_title;
        $titleHtml =  $title;
        //taxonomies
        $taxonomies = array($tax);
        ?>
        <?php foreach ($taxonomies as $tax) : ?>
            <?php if($tax == 'media_base'): ?>
                <?php 
                $page_articles = ( isset( $wm_settings['mpage_link_article'] ) && $wm_settings['mpage_link_article'] ) ? get_permalink(intval($wm_settings['mpage_link_article'])) : '#';
                $page_videos = ( isset( $wm_settings['mpage_link_video'] ) && $wm_settings['mpage_link_video'] ) ? get_permalink(intval($wm_settings['mpage_link_video'])) : '#';
                $page_podcasts = ( isset( $wm_settings['mpage_link_podcast'] ) && $wm_settings['mpage_link_podcast'] ) ? get_permalink(intval($wm_settings['mpage_link_podcast'])) : '#';
                $page_resources = ( isset( $wm_settings['mpage_link_resource'] ) && $wm_settings['mpage_link_resource'] ) ? get_permalink(intval($wm_settings['mpage_link_resource'])) : '#';
                $titleHtml = !empty($title) ? $titleHtml : __('Media Base');
                ?>
				<h3 data-wm-plugin="collapse" data-target="#nav-<?php echo esc_attr($tax); ?>" class="wm_megamenu_toggle show"><?php echo $titleHtml; ?></h3>
				<div id="nav-<?php echo esc_attr($tax); ?>" class="block-dropdown">
                    <ul>
						<li><h3><?php echo $titleHtml; ?></h3></li>
                        <li><a href="<?php echo $page_articles; ?>"><?php _e('Articles'); ?></a></li>
                        <li><a href="<?php echo $page_videos; ?>"><?php _e('Videos'); ?></a></li>
                        <li><a href="<?php echo $page_podcasts; ?>"><?php _e('Podcasts'); ?></a></li>
                        <li><a href="<?php echo $page_resources; ?>"><?php _e('Resources'); ?></a></li>
                    </ul>
                </div>
            <?php continue; ?>
            <?php endif; ?>
            <?php 
            $tax_data = get_taxonomy($tax); 
            $tax_labels = $tax_data->labels; 
            $tax_args = array(
                'orderby'    => 'name',
                'hide_empty' => 0
            );
            if($tax == 'category'){
                $tax_args['number'] = 5;
            }else if($tax == 'spotlight-topic'){
                $tax_args['number'] = 9;
            }else if($tax == 'practitioner-specialty'){
                $tax_args['number'] = 8;

            }
            $wm_terms = get_terms( $tax, $tax_args );
            if ( ! empty( $wm_terms ) && ! is_wp_error( $wm_terms ) ): 
                $wm_term_counter = 0;
                $wm_terms_count = count($wm_terms);
                $titleHtml = !empty($title) ? $titleHtml : $tax_labels->name;
            ?>
				<h3 data-wm-plugin="collapse" data-target="#nav-<?php echo esc_attr($tax); ?>" class="wm_megamenu_toggle show"><?php echo $titleHtml; ?></h3>
                <div id="nav-<?php echo esc_attr($tax); ?>" class="block-dropdown <?php if($tax == 'spotlight-topic'): ?>double-block<?php endif;?>">
                    <ul>
						<li><h3><?php echo $titleHtml; ?></h3></li>
                        <?php 
                        foreach ( $wm_terms as $key => $wm_term ): 
                            if ( $tax == 'category' && $wm_term->term_id == 1 ){
                                continue; // skip 'uncategorized'
                            }
                            $wm_term_counter++;
                            if ( $tax == 'spotlight-topic' && $wm_terms_count > 5 && $wm_term_counter > 5 ){
                                break; // skip 'uncategorized'
                            }
                            unset($wm_terms[$key]);
                            ?>
                            <li><a href="<?php echo get_term_link($wm_term, $tax)?>"><?php echo $wm_term->name; ?></a></li>
                        <?php endforeach; ?>
                        <?php // if( in_array($tax, array('category', 'spotlight-topic')) && $wm_terms_count <= 5 && !empty($link) ): ?>
                        <?php if( ( $tax == 'spotlight-topic' && $wm_terms_count <= 5 && !empty($link)) || ($tax != 'spotlight-topic' && !empty($link)) ): ?>
                            <li><a href="<?php echo $link; ?>" class="more"><?php echo $link_lbl;?></a></li>
                        <?php endif; ?>
                    </ul>
                    <?php if($tax == 'spotlight-topic' && $wm_terms_count > 5): ?>
                        <ul>
							<li><h3>&nbsp;</h3></li>
                            <?php 
                            foreach ( $wm_terms as $wm_term ): ?>
                            <li><a href="<?php echo get_term_link($wm_term, $tax)?>"><?php echo $wm_term->name; ?></a></li>
                            <?php endforeach; ?>
                            <?php if( !empty($link) ): ?>
                            <li><a href="<?php echo $link; ?>" class="more"><?php echo $link_lbl;?></a></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php
        //echo "\n" . $after_widget . "\n";

    }

    /**
     * Generates the administration form for the widget.
     *
     * @since	1.0.0
     * @param	array	instance	The array of keys and values for the widget.
     */
    public function form( $instance ){
        $title = ( isset( $instance[ 'title' ] ) ) ? $instance['title']  : '';
        $tax = ( isset( $instance[ 'tax' ] ) ) ? $instance['tax']  : 'category'; 
        $link = ( isset( $instance[ 'link' ] ) ) ? $instance['link']  : ''; 
        $link_lbl = ( isset( $instance[ 'link_lbl' ] ) ) ? $instance['link_lbl']  : 'View All'; 
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'tax' ); ?>"><?php _e( 'Taxonomy/Type:' ); ?></label> 
            <select id="<?php echo $this->get_field_id('tax'); ?>" name="<?php echo $this->get_field_name('tax'); ?>"  >
                <option <?php selected( $tax, 'category'); ?> value="category">Key Topics</option>
                <option <?php selected( $tax, 'spotlight-topic'); ?> value="spotlight-topic">Spotlight Topics</option> 
                <option <?php selected( $tax, 'media_base'); ?> value="media_base">Media Base (Type)</option>   
                <option <?php selected( $tax, 'practitioner-specialty'); ?> value="practitioner-specialty">Practitioner Specialty</option>   
            </select>
        </p>
<!--        <p>
            <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'View All Link:' ); ?></label> 
            <?php //wp_dropdown_pages( array( 'name' => $this->get_field_name('tax'), 'selected' => $link ) ); ?>
        </p>-->
        <p>
            <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'View All Link:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" placeholder="<?php echo __('Leave this empty to remove View All link.'); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'link_lbl' ); ?>"><?php _e( 'View All Link\'s Label:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'link_lbl' ); ?>" name="<?php echo $this->get_field_name( 'link_lbl' ); ?>" type="text" value="<?php echo esc_attr( $link_lbl ); ?>">
        </p>
        <?php

    }

    /**
     * Processes the widget's options to be saved.
     *
     * @since	1.0.0
     * @param	array	new_instance	The previous instance of values before the update.
     * @param	array	old_instance	The new instance of values to be generated via the update.
     * @return	array	instance		Updated instance.
     */
    public function update( $new_instance, $old_instance ){

        
        $instance['title'] = htmlspecialchars( stripslashes_deep(strip_tags( $new_instance['title'] )), ENT_QUOTES );
        $instance['tax'] = $new_instance['tax'];
        $instance['link'] = $new_instance['link'];
        $instance['link_lbl'] = $new_instance['link_lbl'];

        return $instance;

    }

} // end class 
