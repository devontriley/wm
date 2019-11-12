<?php

function testimonial() {
	register_post_type( 'testimoniala',
		array(
			'labels' => array(
			'name' => __('Testimonials'),
			'singular_name' => __('Testimonial'),
			'add_new_item' => __('Add New Testimonial'),
            'edit_item' => __('Edit Testimonial'),
            'new_item' => __('Add New Testimonial'),
            'view_item' => __('View Testimonial'),
		),
		'public' => true,
		'supports' => array( 'title','page-attributes','editor'),
		'capability_type' => 'post',
		)
	);
}
add_action('init', 'testimonial');?>