<?php

/**

 * Registering meta boxes

 *

 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)

 * All the definitions of meta boxes are listed below with comments, please read them carefully.

 * Note that each validation method of the Validation Class MUST return value instead of boolean as before

 *

 * You also should read the changelog to know what has been changed

 *

 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html

 *

 */



/********************* BEGIN EXTENDING CLASS ***********************/



/**

 * Extend RW_Meta_Box class

 * Add field type: 'taxonomy'

 */

class RW_Meta_Box_Taxonomy extends RW_Meta_Box {

	

	function add_missed_values() {

		parent::add_missed_values();

		

		// add 'multiple' option to taxonomy field with checkbox_list type

		foreach ($this->_meta_box['fields'] as $key => $field) {

			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {

				$this->_meta_box['fields'][$key]['multiple'] = true;

			}

		}

	}

	

	// show taxonomy list

	function show_field_taxonomy($field, $meta) {

		global $post;

		

		if (!is_array($meta)) $meta = (array) $meta;

		

		$this->show_field_begin($field, $meta);

		

		$options = $field['options'];

		$terms = get_terms($options['taxonomy'], $options['args']);

		

		// checkbox_list

		if ('checkbox_list' == $options['type']) {

			foreach ($terms as $term) {

				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";

			}

		}

		// select

		else {

			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";

		

			foreach ($terms as $term) {

				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";

			}

			echo "</select>";

		}

		

		$this->show_field_end($field, $meta);

	}

}



/********************* END EXTENDING CLASS ***********************/



/********************* BEGIN DEFINITION OF META BOXES ***********************/



// prefix of meta keys, optional

// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';

// you also can make prefix empty to disable it

$prefix = 'cg_';



$meta_boxes = array();

$meta_boxes[] = array(

	'id' => 'boxs',

	'title' => 'Policy 3 Column Text boxes',

	'pages' => array('policies'),

	'fields' => array(

		array(

			'name' => 'Text box 1',

			'id' => 'box_1',

			'desc' => 'Please enter Text for Box 1 in this box.',

			'type' => 'textarea'),			// radio box	

		array(

			'name' => 'Text box 2',

			'id' => 'box_2',

			'desc' => 'Please enter Text for Box 2 in this box.',

			'type' => 'textarea'),
			
		array(

			'name' => 'Text box 3',

			'id' => 'box_3',

			'desc' => 'Please enter Text for Box 3 in this box.',

			'type' => 'textarea'),

		),	

);

$meta_boxes[] = array(

	'id' => 'p_link',

	'title' => 'Link to relevant Store Page',

	'pages' => array('policies'),

	'fields' => array(

		array(

			'name' => 'Link To Store',

			'id' => 'p-link',

			'desc' => 'Pleae Enter Store link in this field',

			'type' => 'text'),			// radio box	

		)

);
$meta_boxes[] = array(

	'id' => 'heading_circle',

	'title' => 'Policy Item Background Circle Color.',

	'pages' => array('policies'),

	'fields' => array(
		array(
			'name' => 'Which Color Do you want to use with this item?',
			'id' => 'head_color',
			'type' => 'radio',						// radio box
			'options' => array(						// array of key => value pairs for radio options
				'or' => 'Orange',
				'br' => 'Brown',
				'bl' => 'Blue',
				'gr' => 'Green',
				'lm' => 'Lime',
				
			),
			'std' => 'or',
		),
		),
);



$meta_boxes[] = array(

	'id' => 'boxs11',

	'title' => 'Procedure 3 Column Text boxes',

	'pages' => array('procedure'),

	'fields' => array(

		array(

			'name' => 'Text box 1',

			'id' => 'box_4',

			'desc' => 'Please enter Text for Box 1 in this box.',

			'type' => 'textarea'),			// radio box	

		array(

			'name' => 'Text box 2',

			'id' => 'box_5',

			'desc' => 'Please enter Text for Box 2 in this box.',

			'type' => 'textarea'),
			
		array(

			'name' => 'Text box 3',

			'id' => 'box_6',

			'desc' => 'Please enter Text for Box 3 in this box.',

			'type' => 'textarea'),

		),	

);

$meta_boxes[] = array(

	'id' => 'pr_link',

	'title' => 'Link to relevant Store Page',

	'pages' => array('procedure'),

	'fields' => array(

		array(

			'name' => 'Link To Store',

			'id' => 'pr-link',

			'desc' => 'Pleae Enter Store link in this field',

			'type' => 'text'),			// radio box	

		)

);
$meta_boxes[] = array(

	'id' => 'heading_circles',

	'title' => 'Procedure Item Background Circle Color.',

	'pages' => array('procedure'),

	'fields' => array(
		array(
			'name' => 'Which Color Do you want to use with this item?',
			'id' => 'head_color_pr',
			'type' => 'radio',						// radio box
			'options' => array(						// array of key => value pairs for radio options
				'or' => 'Orange',
				'br' => 'Brown',
				'bl' => 'Blue',
				'gr' => 'Green',
				'lm' => 'Lime',
				
			),
			'std' => 'or',
		),
		),
);
foreach ($meta_boxes as $meta_box) {

	$my_box = new RW_Meta_Box_Taxonomy($meta_box);

}



/********************* END DEFINITION OF META BOXES ***********************/



/********************* BEGIN VALIDATION ***********************/



/**

 * Validation class

 * Define ALL validation methods inside this class

 * Use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)

 */

class RW_Meta_Box_Validate {

	function check_name($text) {

		if ($text == 'Anh Tran') {

			return 'He is Rilwis';

		}

		return $text;

	}

}



/********************* END VALIDATION ***********************/

?>
