<?php
/* Save options & add admin options */
function mytheme_add_admin() {
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme.php&saved=true");
	die;
}
}
add_theme_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/framework/admin/style/functions.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/framework/admin/js/rm_script.js", false, "1.0");
wp_enqueue_script("mColorPicker", $file_dir."/framework/admin/js/mColorPicker.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
 
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":

break;

case 'select_page':
?>

<div class="rm_input rm_text">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<option value="">Select Page</option>  
<?php 
foreach ($value['options'] as $page){ ?>
	<option <?php if (get_option( $value['id'] ) == $page->ID) { echo 'selected="selected"'; } ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
<?php } ?>
</select>
<small><?php echo $value['desc']; ?></small>
</div>

<?php
break;
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To edit the settings of your website, use the options below.</p>

<?php break;
 
case 'text':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
 
<?php break;
case 'select_page':
?>

<div class="rm_input rm_text">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<option value="">Select Page</option>  
<?php 
foreach ($value['options'] as $page){ ?>
	<option <?php if (get_option( $value['id'] ) == $page->ID) { echo 'selected="selected"'; } ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
<?php } ?>
</select>
<small><?php echo $value['desc']; ?></small>
</div>

<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
	<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php break;

case "radio":
?>

<div class="rm_input rm_radio">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="<?php echo $value['value']; ?>" <?php if (get_option($value['id']) == $value['value'] || get_option($value['id']) == ""){echo 'checked="checked"';}?> /> <?php echo $value['desc2']; ?><br />
<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_2" type="radio" value="<?php echo $value['value2']; ?>" <?php if (get_option($value['id']) == $value['value2']){echo 'checked="checked"';}?> /> <?php echo $value['desc3']; ?>
<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php break;

case "layout":
?>

<div class="rm_input rm_radio_two">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<div class="layoutSelect">
<ul>
<li><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="<?php echo $value['value']; ?>" <?php if (get_option($value['id']) == $value['value'] || get_option($value['id']) == ""){echo 'checked="checked"';}?> /> <img src="<?php bloginfo('template_url'); ?>/framework/admin/images/twocol.gif" alt="Two Columns" /></li>
<li><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_2" type="radio" value="<?php echo $value['value2']; ?>" <?php if (get_option($value['id']) == $value['value2']){echo 'checked="checked"';}?> /> <img src="<?php bloginfo('template_url'); ?>/framework/admin/images/threecol.gif" alt="Two Columns" /></li>
<li><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_3" type="radio" value="<?php echo $value['value3']; ?>" <?php if (get_option($value['id']) == $value['value3']){echo 'checked="checked"';}?> /> <img src="<?php bloginfo('template_url'); ?>/framework/admin/images/fourcol.gif" alt="Four Columns" /></li>
<li><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_4" type="radio" value="<?php echo $value['value4']; ?>" <?php if (get_option($value['id']) == $value['value4']){echo 'checked="checked"';}?> /> <img src="<?php bloginfo('template_url'); ?>/framework/admin/images/fivecol.gif" alt="Five Columns" /></li>
<li><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_5" type="radio" value="<?php echo $value['value5']; ?>" <?php if (get_option($value['id']) == $value['value5']){echo 'checked="checked"';}?> /> <img src="<?php bloginfo('template_url'); ?>/framework/admin/images/onethirdcol.gif" alt="One Third - Two Thirds" /></li>
<li><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_6" type="radio" value="<?php echo $value['value6']; ?>" <?php if (get_option($value['id']) == $value['value6']){echo 'checked="checked"';}?> /> <img src="<?php bloginfo('template_url'); ?>/framework/admin/images/twothirdcol.gif" alt="Two Thirds - One Third" /></li>
<li><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_7" type="radio" value="<?php echo $value['value7']; ?>" <?php if (get_option($value['id']) == $value['value7']){echo 'checked="checked"';}?> /> <img src="<?php bloginfo('template_url'); ?>/framework/admin/images/twocoltwo.gif" alt="Two Fourth - One Half" /></li>
<li><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_8" type="radio" value="<?php echo $value['value8']; ?>" <?php if (get_option($value['id']) == $value['value8']){echo 'checked="checked"';}?> /> <img src="<?php bloginfo('template_url'); ?>/framework/admin/images/onecoltwo.gif" alt="One Half - Two Fourths" /></li>
</ul></div>
<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php break;
 
case 'color':
?>

<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" data-hex="true" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php

break; 
case "section":

$i++;

?>

<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/framework/admin/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="rm_options">

 
<?php break;
 
}
}
?>
 
<input type="hidden" name="action" value="save" />
</form>
</div>
</div>

<?php } ?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>