<?php 

$themename = "Theme Options";

$shortname = "t";



/* Get Pages into a drop-down list */

$pages_list = get_pages();

$getpagnav = array();

foreach($pages_list as $apage) {

	$getpagnav[$apage->ID] = $apage->post_title;

}



$options = array (

 

array( "name" => $themename." Options",

	"type" => "title"),



array( "name" => "General",

	"type" => "section"),

array( "type" => "open"),



array(	"name" => "Phone Number",

	"desc" => "Please Enter phone Number in this box.",	

	"id" => "phone",

	"type" => "text"),
	





	

	array( "type" => "close"),
	
	


);
?>