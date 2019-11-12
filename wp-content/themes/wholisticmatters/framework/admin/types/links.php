<?php

function anaheimlinks() {
	register_post_type( 'anaheim-links',
		array(
			'labels' => array(
			'name' => __('Anaheim Links'),
			'singular_name' => __('Anaheim Link'),
			'add_new_item' => __('Add New Link'),
            'edit_item' => __('Edit Link'),
            'new_item' => __('Add New Link'),
            'view_item' => __('View Link'),
		),
		'public' => true,
		'supports' => array( 'title', 'thumbnail', 'page-attributes'),
		'capability_type' => 'post',
		)
	);
}
add_action('init', 'anaheimlinks');

register_taxonomy('links_category','anaheim-links',array(
	'hierarchical' => true,
	'labels' => array(
		'name' => _x( 'Links', 'taxonomy general name' ),
		'singular_name' => _x( 'Links Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Links' ),
		'popular_items' => __( 'Popular Links' ),
		'all_items' => __( 'All Links' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Links' ), 
		'update_item' => __( 'Update Links' ),
		'add_new_item' => __( 'Add New Links' ),
		'new_item_name' => __( 'New Links Name' ),
		'separate_items_with_commas' => __( 'Separate Links with commas' ),
		'add_or_remove_items' => __( 'Add or remove Links' ),
		'choose_from_most_used' => __( 'Choose from the most used Links' )
	),
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => false,
));

add_action('do_meta_boxes', 'links_image_box');

function links_image_box() {
	remove_meta_box( 'postimagediv', 'anaheim-links', 'side' );
	add_meta_box('custompostimagediv', __('Add Logo Here'), 'post_thumbnail_meta_box', 'anaheim-links', 'normal', 'high');

}
?>