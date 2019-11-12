<?php
/*
Bootstrap 4.0.0-alpha2 nav walker extension class
=================================================
Add this to your `functions.php`
*/
class bootstrap_4_walker_nav_menu extends Walker_Nav_menu {
    private $is_divider = false;
	
    function start_lvl( &$output, $depth = 0, $args = array() ){ // ul
        $indent = str_repeat("\t",$depth); // indents the outputted HTML
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $def_classes = "dropdown-menu$submenu depth_$depth";
		if(is_user_logged_in() && current_user_can('hcp')){
			$def_classes .= ' is_hcp_user';
		}
        if($depth > 0){
//            $this_menu = $args->menu; // Slug of the Menu we're calling
//            $margs = array(
//                'post_type'              => 'nav_menu_item', // this must be nav_menu_item
//                'post_status'            => 'publish', // make sure we're not calling any unpublished menu items
//                'nopaging'               => true
//            );
//            $nav_items = wp_get_nav_menu_items($this_menu, $margs); // Get Navigation Items.
//            foreach ($nav_items as $item) {
//                $is_divider = get_post_meta($item->ID, 'menu-item-divider_field', true);
//                if($is_divider == 'yes'){
//                    $def_classes = 'divider-submenu';
//                }
//            }
			if($this->is_divider !== false){
				$def_classes = 'divider-submenu';
			}
        }
        $output .= "\n$indent<ul class=\"$def_classes\">\n";
    }
  
    function end_lvl( &$output, $depth = 0, $args = array() ){ // ul
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent  = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";
        if($depth > 0){
//            $this_menu = $args->menu; // Slug of the Menu we're calling
//            $margs = array(
//                'post_type'              => 'nav_menu_item', // this must be nav_menu_item
//                'post_status'            => 'publish', // make sure we're not calling any unpublished menu items
//                'nopaging'               => true
//            );
//            $nav_items = wp_get_nav_menu_items($this_menu, $margs); // Get Navigation Items. 
//			
//            foreach ($nav_items as $item) {
//                $is_divider = get_post_meta($item->ID, 'menu-item-divider_field', true); 
//                if($is_divider == 'yes'){
//                    $output .= '</div>';
//                }
//            }
			if($this->is_divider !== false){
				$output .= '</div>';
			}
        }
		$this->is_divider = false;
    }
  
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // li a span
        
        $indent = ( $depth ) ? str_repeat("\t",$depth) : '';

        $is_divider = get_post_meta($item->ID, 'menu-item-divider_field', true);
        $is_link = get_post_meta($item->ID, 'menu-item-show_as_link', true);
        $is_megamenu = get_post_meta($item->ID, 'menu-item-megamenu', true); 
        $li_attributes = '';
        $class_names = $value = '';
    
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        $classes[] = ( $args->walker->has_children || $is_megamenu == 'yes' ) ? 'dropdown' : '';
        $classes[] = ( is_active_sidebar( 'mega-menu-widget-area-' . $item->ID ) ) ? 'full' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if( $depth && $args->walker->has_children && $is_divider != 'yes'){
            $classes[] = 'dropdown-menu';
        }
        if( $is_link == 'yes'){
            $classes[] = 'menulink';
        }
        
        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';
        
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        if($is_divider != 'yes'){
            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
        }
        $attributes .= ' id="' . esc_attr('nav_dropdown_'.$item->ID) . '"';
        
        if($is_divider == 'yes' && $depth > 0 ){
            $attributes .= ' class="nav-divider-item"';
        }else{
            $attributes .= ( $args->walker->has_children || $is_megamenu == 'yes' ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';
        }
		$attributes = apply_filters('wm_nav_menu_link_attributes', $attributes, $item, $args);
        
        $arg_before = $args->before;
        $arg_after = $args->after;
        if($is_divider == 'yes' && $depth > 0 ){
			$this->is_divider = true;
			$div_block_classes = 'divider-block'; 
			//if(is_user_logged_in() && current_user_can('hcp')){
				//$div_block_classes .= ' is_hcp_user';
			//}
            $arg_before = '<div class="'.$div_block_classes.'">'.$args->before;
        }
        $item_output = $arg_before;
        if($is_divider == 'yes' && $depth > 0){
            $item_output .= '<h4' . $attributes . '>'.apply_filters( 'the_title', $item->title, $item->ID ) .'</h4>';
        }else{
            $item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
        }
        $item_output .= $arg_after;
        
        if ( $is_megamenu == 'yes' ) {
            ob_start();
            dynamic_sidebar( 'mega-menu-widget-area-' . $item->ID );
            $megamenu_content = ob_get_contents();
            ob_clean();
            $item_output .= '<div class="dropdown-menu" aria-labelledby="nav_dropdown_'.$item->ID.'">'.$megamenu_content.'</div>';
        }
        
        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    
    }
    
}
