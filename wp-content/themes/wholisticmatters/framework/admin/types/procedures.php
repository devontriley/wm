<?php

function procedure() {
	register_post_type( 'procedure',
		array(
			'labels' => array(
			'name' => __('Procedure'),
			'singular_name' => __('Policy'),
			'add_new_item' => __('Add New Procedure'),
            'edit_item' => __('Edit Procedure'),
            'new_item' => __('Add New Procedure'),
            'view_item' => __('View Procedure'),
		),
		'public' => true,
		'supports' => array( 'title','page-attributes'),
		'capability_type' => 'post',
		)
	);
}
add_action('init', 'procedure');?>