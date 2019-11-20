<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.example.com
 * @since      1.0.0
 *
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/admin
 * @author     WholisticMatters <info@example.com>
 */
class Wholistic_Matters_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wholistic_Matters_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wholistic_Matters_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wholistic-matters-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wholistic_Matters_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wholistic_Matters_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wholistic-matters-admin.js', array( 'jquery' ), $this->version, true );
	}
	
	public function admin_menu() {
		//Leads submenu
		add_menu_page(
			'Wholistic Matters',
			'Wholistic Matters',
			'manage_options',
			'wholistic-matters-settings',
			null,
			'dashicons-admin-settings'
		);
		add_submenu_page( 'wholistic-matters-settings', esc_html__( 'Settings', 'wholistic-matters' ), esc_html__( 'Settings', 'wholistic-matters' ), 'manage_options', 'wholistic-matters-settings', array($this, 'settings_screen') );
	}
	
	public function settings_screen() {
		global $wp_settings_sections, $wp_settings_fields;
		$page = 'wholistic-matters';
		wp_enqueue_script( 'jquery-ui-accordion' );
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Wholistic Matters Settings', 'syndication-toolbox' ); ?></h2>

			<form action="options.php" method="post">

				<?php settings_fields( 'WM_settings' ); ?>
				
				<div class="wm_settings_accordion">
				<?php 
				//do_settings_sections( 'wholistic-matters' );
				if (  isset( $wp_settings_sections[$page] ) ){
					foreach ( (array) $wp_settings_sections[$page] as $section ) {
						echo "<div class=\"wm_settings_section\">\n";
						if ( $section['title'] )
							echo "<h2>{$section['title']}</h2>\n";

						if ( $section['callback'] )
							call_user_func( $section['callback'], $section );

						if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) )
							continue;
						echo '<div class="wm_settings_body">';
							echo '<table class="form-table">';
							do_settings_fields( $page, $section['id'] );
							echo '</table>';
						echo '</div>';
						echo "</div>\n";
					}
				}
				?>
				</div>

				<?php submit_button(); ?>
			</form>
		</div>
		<style>
		.wm_settings_section * {
			box-sizing: border-box;
		}
		.ui-accordion .ui-accordion-header {
				display: block;
			cursor: pointer;
			position: relative;
			margin: 2px 0 0 0;
			padding: 1em 1em 1.2em;
			min-height: 0;
			font-size: 100%;
		}
		.ui-accordion .ui-accordion-content {
			padding: 1em 2.2em;
			border-top: 0;
			overflow: auto;
		}
		.wm_settings_accordion {
		}

		.wm_settings_accordion .ui-accordion-content {
			background-color: #fff;
			width: 100%;
			color: #777;
			font-size: 0.875em;
			line-height: 1;
		}

		.wm_settings_accordion .ui-accordion-content > * {
			margin: 0;
			padding: 20px;
		}

		.wm_settings_accordion .ui-accordion-header {
			color: white;
			line-height: 1;
			display: block;
			font-size: 1.2em;
			width: auto;
		}

		.wm_settings_accordion .ui-accordion-header {
			background: rgba(39,48,56,1);
			background: -moz-linear-gradient(top, rgba(39,48,56,1) 0%, rgba(49,60,70,1) 100%);
			background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(39,48,56,1)), color-stop(100%, rgba(49,60,70,1)));
			background: -webkit-linear-gradient(top, rgba(39,48,56,1) 0%, rgba(49,60,70,1) 100%);
			background: -o-linear-gradient(top, rgba(39,48,56,1) 0%, rgba(49,60,70,1) 100%);
			background: -ms-linear-gradient(top, rgba(39,48,56,1) 0%, rgba(49,60,70,1) 100%);
			background: linear-gradient(to bottom, rgba(39,48,56,1) 0%, rgba(49,60,70,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#273038', endColorstr='#313c46', GradientType=0 );
		}
		.wm_settings_accordion + .submit {
			margin-top: 0;
		}
		.wm_settings_accordion + .submit > #submit {
			height: auto;
			padding: 0.5em 1em;
		}
		</style>
		<script type="text/javascript">
			jQuery(function($){
				$(".wm_settings_accordion").accordion({ header: "h2", autoHeight: true, heightStyle: "content" ,active: false, collapsible: true,  });
				//$(".wm_settings_accordion").last().accordion("option", "icons", false);
			});
		</script>
		<?php
	}
	
	public function register_settings() {
            
		register_setting( 'WM_settings', 'WM_settings', array($this, 'sanitize_settings') );
		
		add_settings_section( 'wm-section-0', 'Site Options', '', 'wholistic-matters' );
		add_settings_field( 'mpage_link_article', esc_html__( 'Articles Listing Page', 'wholistic-matters' ), array($this, 'mpage_link_article_callback'), 'wholistic-matters', 'wm-section-0' );
		add_settings_field( 'mpage_link_video', esc_html__( 'Videos Listing Page', 'wholistic-matters' ), array($this, 'mpage_link_video_callback'), 'wholistic-matters', 'wm-section-0' );
		add_settings_field( 'mpage_link_podcast', esc_html__( 'Podcast Episodes Listing Page', 'wholistic-matters' ), array($this, 'mpage_link_podcast_callback'), 'wholistic-matters', 'wm-section-0' );
		add_settings_field( 'mpage_link_resource', esc_html__( 'Resources Listing Page', 'wholistic-matters' ), array($this, 'mpage_link_resource_callback'), 'wholistic-matters', 'wm-section-0' );
		add_settings_field( 'wm_social_links', esc_html__( 'WM Social Links', 'wholistic-matters' ), array($this, 'wm_social_links_callback'), 'wholistic-matters', 'wm-section-0' );
		add_settings_field( 'interactive_tools_page', esc_html__( 'Interactive Tools Page (Parent Page)', 'wholistic-matters' ), array($this, 'interactive_tools_page_callback'), 'wholistic-matters', 'wm-section-0' );
		add_settings_field( 'gated_para', esc_html__( 'Gated Post CTA Paragraph', 'wholistic-matters' ), array($this, 'gated_para_callback'), 'wholistic-matters', 'wm-section-0' );
		add_settings_field( 'signup_para', esc_html__( 'Signup Popup Text', 'wholistic-matters' ), array($this, 'signup_para_callback'), 'wholistic-matters', 'wm-section-0' );

		add_settings_section( 'wm-section-1', 'Homepage Options', '', 'wholistic-matters' );
		add_settings_field( 'hpage_text_1', esc_html__( 'Culinary Wellness Paragraph', 'wholistic-matters' ), array($this, 'hpage_text_1_callback'), 'wholistic-matters', 'wm-section-1' );
		add_settings_field( 'hpage_link_recipes', esc_html__( 'Recipes Page Link', 'wholistic-matters' ), array($this, 'hpage_link_recipes_callback'), 'wholistic-matters', 'wm-section-1' );
		add_settings_field( 'hpage_link_skill', esc_html__( 'Skill Videos Page Link', 'wholistic-matters' ), array($this, 'hpage_link_skill_callback'), 'wholistic-matters', 'wm-section-1' );

		add_settings_field( 'hpage_text_2', esc_html__( 'Cultivate Paragraph', 'wholistic-matters' ), array($this, 'hpage_text_2_callback'), 'wholistic-matters', 'wm-section-1' );
		add_settings_field( 'hpage_link_visit', esc_html__( 'Cultivate Page Link', 'wholistic-matters' ), array($this, 'hpage_link_visit_callback'), 'wholistic-matters', 'wm-section-1' );

		add_settings_field( 'hpage_text_signup', esc_html__( 'Sign Up CTA Paragraph', 'wholistic-matters' ), array($this, 'hpage_text_signup_callback'), 'wholistic-matters', 'wm-section-1' );
		
		add_settings_section( 'wm-section-2', 'Culinary Wellness Page Options', '', 'wholistic-matters' );
		add_settings_field( 'chef_name', esc_html__( 'Chef\'s Name', 'wholistic-matters' ), array($this, 'chef_name_callback'), 'wholistic-matters', 'wm-section-2' );
		add_settings_field( 'chef_about', esc_html__( 'About Chef', 'wholistic-matters' ), array($this, 'chef_about_callback'), 'wholistic-matters', 'wm-section-2' );
		add_settings_field( 'chef_about_img', esc_html__( 'About Chef Image', 'wholistic-matters' ), array($this, 'chef_about_img_callback'), 'wholistic-matters', 'wm-section-2' );
		
		add_settings_section( 'wm-section-3', 'Spotlight Topics Page Options', '', 'wholistic-matters' );
		add_settings_field( 'learn_about_text', esc_html__( 'Learn About Us Text', 'wholistic-matters' ), array($this, 'learn_about_text_callback'), 'wholistic-matters', 'wm-section-3' );
		add_settings_field( 'learn_about_link', esc_html__( 'Learn About Us Link', 'wholistic-matters' ), array($this, 'learn_about_link_callback'), 'wholistic-matters', 'wm-section-3' );
		add_settings_field( 'learn_about_img', esc_html__( 'Learn About Us Image', 'wholistic-matters' ), array($this, 'learn_about_img_callback'), 'wholistic-matters', 'wm-section-3' );
		
		add_settings_section( 'wm-section-4', 'About Us Page Options', '', 'wholistic-matters' );
		add_settings_field( 'about_mission', esc_html__( 'Our Mission Section', 'wholistic-matters' ), array($this, 'about_mission_callback'), 'wholistic-matters', 'wm-section-4' );
		add_settings_field( 'about_values', esc_html__( 'Our Values Section', 'wholistic-matters' ), array($this, 'about_values_callback'), 'wholistic-matters', 'wm-section-4' );
		add_settings_field( 'about_education', esc_html__( 'Cont. Education Section', 'wholistic-matters' ), array($this, 'about_education_callback'), 'wholistic-matters', 'wm-section-4' );
		add_settings_field( 'about_partners', esc_html__( 'Our Partners Section', 'wholistic-matters' ), array($this, 'about_partners_callback'), 'wholistic-matters', 'wm-section-4' );
		
		add_settings_section( 'wm-section-5', 'My Account Page Options', '', 'wholistic-matters' );
		add_settings_field( 'bookmark_info', esc_html__( 'Bookmark Text', 'wholistic-matters' ), array($this, 'bookmark_info_callback'), 'wholistic-matters', 'wm-section-5' );
		
		add_settings_section( 'wm-section-6', 'Email Options', '', 'wholistic-matters' );
		add_settings_field( 'mail_config', esc_html__( 'Emails Settings', 'wholistic-matters' ), array($this, 'mail_config_callback'), 'wholistic-matters', 'wm-section-6' );
		add_settings_field( 'mail_var_info', esc_html__( 'Shared Template Variables', 'wholistic-matters' ), array($this, 'mail_var_info_callback'), 'wholistic-matters', 'wm-section-6' );
		add_settings_field( 'mail_content_footer', esc_html__( 'Emails Footer Template', 'wholistic-matters' ), array($this, 'mail_content_footer_callback'), 'wholistic-matters', 'wm-section-6' );
		add_settings_field( 'mail_content_contact', esc_html__( 'Contact Us Email Template', 'wholistic-matters' ), array($this, 'mail_content_contact_callback'), 'wholistic-matters', 'wm-section-6' );
		add_settings_field( 'mail_content_register', esc_html__( 'Register / Welcome Email Template', 'wholistic-matters' ), array($this, 'mail_content_register_callback'), 'wholistic-matters', 'wm-section-6' );
		add_settings_field( 'mail_content_reset', esc_html__( 'Reset Password Email Template', 'wholistic-matters' ), array($this, 'mail_content_reset_callback'), 'wholistic-matters', 'wm-section-6' );
	}
        
        //section 0
	public function mpage_link_article_callback() {
            $settings = Wholistic_Matters::get_settings();
            $value = ( isset( $settings['mpage_link_article'] ) && $settings['mpage_link_article'] ) ? intval($settings['mpage_link_article']) : 0;
            ?>
            <label >
                <?php wp_dropdown_pages( array( 'name' => 'WM_settings[mpage_link_article]', 'selected' => $value ) ); ?>
            </label>
            <?php
	}
	public function mpage_link_video_callback() {
            $settings = Wholistic_Matters::get_settings();
            $value = ( isset( $settings['mpage_link_video'] ) && $settings['mpage_link_video'] ) ? intval($settings['mpage_link_video']) : 0;
            ?>
            <label >
                <?php wp_dropdown_pages( array( 'name' => 'WM_settings[mpage_link_video]', 'selected' => $value ) ); ?>
            </label>
            <?php
	}
	public function mpage_link_podcast_callback() {
            $settings = Wholistic_Matters::get_settings();
            $value = ( isset( $settings['mpage_link_podcast'] ) && $settings['mpage_link_podcast'] ) ? intval($settings['mpage_link_podcast']) : 0;
            ?>
            <label >
                <?php wp_dropdown_pages( array( 'name' => 'WM_settings[mpage_link_podcast]', 'selected' => $value ) ); ?>
            </label>
            <?php
	}
	public function mpage_link_resource_callback() {
            $settings = Wholistic_Matters::get_settings();
            $value = ( isset( $settings['mpage_link_resource'] ) && $settings['mpage_link_resource'] ) ? intval($settings['mpage_link_resource']) : 0;
            ?>
            <label >
                <?php wp_dropdown_pages( array( 'name' => 'WM_settings[mpage_link_resource]', 'selected' => $value ) ); ?>
            </label>
            <?php
	}
	public function interactive_tools_page_callback() {
            $settings = Wholistic_Matters::get_settings();
            $value = ( isset( $settings['interactive_tools_page'] ) && $settings['interactive_tools_page'] ) ? intval($settings['interactive_tools_page']) : 0;
            ?>
            <label >
                <?php wp_dropdown_pages( array( 'name' => 'WM_settings[interactive_tools_page]', 'selected' => $value, 'hierarchical' => 1 ) ); ?>
            </label>
            <?php
	}
	
	public function wm_social_links_callback() {
            $settings = Wholistic_Matters::get_settings();
            $value = ( isset( $settings['wm_social_links'] ) && is_array($settings['wm_social_links']) ) ? $settings['wm_social_links'] : array('fb' => '', 'tw' => '', 'li' => '', 'insta' => '');
            ?>
            <label>
                <input type="text" name="WM_settings[wm_social_links][fb]" class="large-text code" value="<?php echo $value['fb']; ?>" placeholder="Facebook"/>
            </label>
            <label> 
                <input type="text" name="WM_settings[wm_social_links][tw]" class="large-text code" value="<?php echo $value['tw']; ?>" placeholder="Twitter"/>
            </label>
            <label>
                <input type="text" name="WM_settings[wm_social_links][li]" class="large-text code" value="<?php echo $value['li']; ?>" placeholder="LinkedIn"/>
            </label>
            <label> 
                <input type="text" name="WM_settings[wm_social_links][insta]" class="large-text code" value="<?php echo $value['insta']; ?>" placeholder="Instagram"/>
            </label>
            <?php
	}
	
	public function gated_para_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['gated_para'] ) && $settings['gated_para'] ) ? $settings['gated_para'] : '';
			
		?>
		<label>
                    <textarea name="WM_settings[gated_para]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
	public function signup_para_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['signup_para'] ) && $settings['signup_para'] ) ? $settings['signup_para'] : '';
			
		?>
		<label>
                    <textarea name="WM_settings[signup_para]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
        
        //section 1
	public function hpage_text_1_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['hpage_text_1'] ) && $settings['hpage_text_1'] ) ? $settings['hpage_text_1'] : '';
			
		$img = ( isset( $settings['cul_wellness_img'] ) && $settings['cul_wellness_img'] ) ? $settings['cul_wellness_img'] : '';
			
		?>
		<label>
                    <input type="text" name="WM_settings[cul_wellness_img]" class="large-text code" value="<?php echo $img; ?>" placeholder="Enter Section Image URL"/>
                    <textarea name="WM_settings[hpage_text_1]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
	
	public function hpage_link_recipes_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['hpage_link_recipes'] ) && $settings['hpage_link_recipes'] ) ? $settings['hpage_link_recipes'] : 0;
			
		?>
		<label>
			<input type="text" name="WM_settings[hpage_link_recipes]" class="large-text code" value="<?php echo $value; ?>" />
		</label>
		<?php
	}
	
	public function hpage_link_skill_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['hpage_link_skill'] ) && $settings['hpage_link_skill'] ) ? $settings['hpage_link_skill'] : 0;
			
		?>
		<label>
			<input type="text" name="WM_settings[hpage_link_skill]" class="large-text code" value="<?php echo $value; ?>" />
		</label>
                <hr>
		<?php
	}
        
	public function hpage_text_2_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['hpage_text_2'] ) && $settings['hpage_text_2'] ) ? $settings['hpage_text_2'] : '';
		$img = ( isset( $settings['cultivate_img'] ) && $settings['cultivate_img'] ) ? $settings['cultivate_img'] : '';
		?>
		<label>
                    <input type="text" name="WM_settings[cultivate_img]" class="large-text code" value="<?php echo $img; ?>" placeholder="Enter Section Image URL"/>
                    <textarea name="WM_settings[hpage_text_2]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
	
	public function hpage_link_visit_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['hpage_link_visit'] ) && $settings['hpage_link_visit'] ) ? $settings['hpage_link_visit'] : 0;
			
		?>
		<label >
			<input type="text" name="WM_settings[hpage_link_visit]" class="large-text code" value="<?php echo $value; ?>" />
		 </label><hr>
		<?php
	}
        
	public function hpage_text_signup_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['hpage_text_signup'] ) && $settings['hpage_text_signup'] ) ? $settings['hpage_text_signup'] : '';
			
		?>
		<label>
                    <textarea name="WM_settings[hpage_text_signup]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
        
	public function chef_name_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['chef_name'] ) && $settings['chef_name'] ) ? $settings['chef_name'] : '';
			
		?>
		<label>
            <input type="text" name="WM_settings[chef_name]" class="large-text code" value="<?php echo $value; ?>" />
		</label>
		<?php
	}
	
	public function chef_about_img_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['chef_about_img'] ) && $settings['chef_about_img'] ) ? $settings['chef_about_img'] : '';
			
		?>
		<label>
            <input type="text" name="WM_settings[chef_about_img]" class="large-text code" value="<?php echo $value; ?>" placeholder="Enter Image URL"/>
		</label>
		<?php
	}
	
	public function chef_about_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['chef_about'] ) && $settings['chef_about'] ) ? $settings['chef_about'] : '';
			
		?>
		<label>
                    <textarea name="WM_settings[chef_about]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
	
	public function learn_about_link_callback() {
            $settings = Wholistic_Matters::get_settings();
            $value = ( isset( $settings['learn_about_link'] ) && $settings['learn_about_link'] ) ? intval($settings['learn_about_link']) : 0;
            ?>
            <label >
                <?php wp_dropdown_pages( array( 'name' => 'WM_settings[learn_about_link]', 'selected' => $value ) ); ?>
            </label>
            <?php
	}
	
	public function learn_about_img_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['learn_about_img'] ) && $settings['learn_about_img'] ) ? $settings['learn_about_img'] : '';
			
		?>
		<label>
            <input type="text" name="WM_settings[learn_about_img]" class="large-text code" value="<?php echo $value; ?>" placeholder="Enter Image URL"/>
		</label>
		<?php
	}
	
	public function learn_about_text_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['learn_about_text'] ) && $settings['learn_about_text'] ) ? $settings['learn_about_text'] : '';
			
		?>
		<label>
			<textarea name="WM_settings[learn_about_text]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
	
	public function about_mission_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['about_mission'] ) && $settings['about_mission'] ) ? $settings['about_mission'] : array();
		$image = isset($value['image']) ? $value['image'] : '';
		$textarea = isset($value['textarea']) ? $value['textarea'] : '';
		?>
		<label>
			<input type="text" name="WM_settings[about_mission][image]" class="large-text code" value="<?php echo $image; ?>" placeholder="Enter Image URL"/>
		</label>
		<label>
			<textarea name="WM_settings[about_mission][textarea]" class="large-text code" rows="6"><?php echo $textarea; ?></textarea>
		</label>
		<?php
	}
	
	public function about_values_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['about_values'] ) && $settings['about_values'] ) ? $settings['about_values'] : array();
		$image = isset($value['image']) ? $value['image'] : '';
		$textarea = isset($value['textarea']) ? $value['textarea'] : '';
		?>
		<label>
			<input type="text" name="WM_settings[about_values][image]" class="large-text code" value="<?php echo $image; ?>" placeholder="Enter Image URL"/>
		</label>
		<label>
			<textarea name="WM_settings[about_values][textarea]" class="large-text code" rows="6"><?php echo $textarea; ?></textarea>
		</label>
		<?php
	}
	
	public function about_education_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['about_education'] ) && $settings['about_education'] ) ? $settings['about_education'] : array();
		$image = isset($value['image']) ? $value['image'] : '';
		$link = isset($value['link']) ? intval($value['link']) : 0;
		$textarea = isset($value['textarea']) ? $value['textarea'] : '';
		?>
		<label>
			<input type="text" name="WM_settings[about_education][image]" class="large-text code" value="<?php echo $image; ?>" placeholder="Enter Image URL"/>
		</label>
		<label>
			<?php wp_dropdown_pages( array( 'name' => 'WM_settings[about_education][link]', 'selected' => $link ) ); ?>
			<small>Select Cont. Education Page</small>
		</label>
		<label>
			<textarea name="WM_settings[about_education][textarea]" class="large-text code" rows="6"><?php echo $textarea; ?></textarea>
		</label>
		<?php
	}
	
	public function about_partners_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['about_partners'] ) && $settings['about_partners'] ) ? $settings['about_partners'] : array();
		$textarea = isset($value['textarea']) ? $value['textarea'] : '';
		$image = array();
		?>
		<label>
			<textarea name="WM_settings[about_partners][textarea]" class="large-text code" rows="6"><?php echo $textarea; ?></textarea>
		</label>
		 <small>Add upto 10 Partner Logos</small>
		 <?php for($i = 0; $i < 10; $i++){
			$image = isset($value['image'][$i]) ? $value['image'][$i] : '';
			?>
			<label>
				<input type="text" name="WM_settings[about_partners][image][<?php echo $i; ?>]" class="large-text code" value="<?php echo $image; ?>" placeholder="Enter Partner <?php echo ($i + 1); ?> Logo URL"/>
			</label>
		<?php
		 }
	}
	
	public function bookmark_info_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['bookmark_info'] ) && $settings['bookmark_info'] ) ? $settings['bookmark_info'] : '';
		?>
		<label>
			<textarea name="WM_settings[bookmark_info]" class="large-text code" rows="6"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
	
	public function mail_config_callback() {
		$settings = Wholistic_Matters::get_settings();
		$value = ( isset( $settings['mail_config'] ) && $settings['mail_config'] ) ? $settings['mail_config'] : array('from_name'=>'WholisticMatters', 'from_email'=>'noreply@wholisticmatters.com');
		$from_name = isset($value['from_name']) ? $value['from_name'] : '';
		$from_email = isset($value['from_email']) ? $value['from_email'] : '';
		?>
		<small>Email Sender Options</small>
		<label>
			<input type="text" name="WM_settings[mail_config][from_name]" class="large-text code" value="<?php echo $from_name; ?>" placeholder="Name for From Email Address"/>
			<input type="text" name="WM_settings[mail_config][from_email]" class="large-text code" value="<?php echo $from_email; ?>" placeholder="From Email Address"/>
		</label>
		<br>
		<br>
		<?php
	}
	public function mail_content_footer_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['mail_content_footer'] ) && $settings['mail_content_footer'] ) ? $settings['mail_content_footer'] : '';
               
		?>
		<label>
			<textarea name="WM_settings[mail_content_footer]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
	}
	public function mail_var_info_callback() {
		$common_vars = WMHelper::get_email_variables('common');
		$common_vars = array_map('strtoupper', $common_vars);
		echo '<p>These can be used in Email templates for Contact email / Welcome email / Forgot password etc below. Each template will also have specific dynamic variable available listed below their fields.</p>';
		echo '<small><b>Common Variables:</b> <br>#';echo implode('#, #', $common_vars).'#</small><br>';
		echo "<small><b>IF Conditional Tag:</b> <br><b>{IF?</b> your_condition_here <b>}</b> Content to show <b>{ENDIF}</b> E.g. {IF?#CONTACT_NAME# != ''} Name: #CONTACT_NAME# {ENDIF}</small><br>";
		echo "<small><b>IF-ELSE Conditional Tag:</b> <br><b>{IF?</b> your_condition_here <b>}</b> Content to show if condition eval to true <b>{ELSE}</b> content for else <b>{ENDIF}</b> E.g. {IF?#_WM_STATE# == 'OH'} from Ohio state {ELSE} not from Ohio {ENDIF}</small><br>";
                
	}
        
	public function mail_content_contact_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['mail_content_contact'] ) && $settings['mail_content_contact'] ) ? $settings['mail_content_contact'] : '';
		
		$variables = WMHelper::get_email_variables('contact');
		$variables = array_map('strtoupper', $variables);
		?>
		<label>
			<textarea name="WM_settings[mail_content_contact]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
		echo '<small><b>Template Specific Variables:</b> #';echo implode('#, #', $variables).'#</small><br>';
	}
        
	public function mail_content_register_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['mail_content_register'] ) && $settings['mail_content_register'] ) ? $settings['mail_content_register'] : '';
		$variables = WMHelper::get_email_variables('register');
		$variables = array_map('strtoupper', $variables);
		?>
		<label>
			<textarea name="WM_settings[mail_content_register]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
		echo '<small><b>Template Specific Variables:</b> #';echo implode('#, #', $variables).'#</small><br>';
				
	}
	
	public function mail_content_reset_callback() {

		$settings = Wholistic_Matters::get_settings();

		$value = ( isset( $settings['mail_content_reset'] ) && $settings['mail_content_reset'] ) ? $settings['mail_content_reset'] : '';
		$variables = WMHelper::get_email_variables('reset');
		$variables = array_map('strtoupper', $variables);
		?>
		<small ><span style="color:red;">Note</span>: Will send the reset email to 100 HCP & Non-HCP members at a time.<br> Configure the contents of Reset email below. Make sure to include #RESET_URL# custom variable to provide user with a link to generate new password!</small><br>
		<input type="submit" name="WM_settings[send_reset_mails]" class="button button-primary code" value="Send Reset Emails to HCP Members"/>
		<br>
		<br>
		<label>
			<textarea name="WM_settings[mail_content_reset]" class="large-text code" rows="10"><?php echo $value; ?></textarea>
		</label>
		<?php
		echo '<small><b>Template Specific Variables:</b> #';echo implode('#, #', $variables).'#</small><br>';
				
	}
	
	/**
	* Sanitize settings for DB
	*
	* @param  array $settings Array of settings.
	* @since  1.0
	*/
   function sanitize_settings( $settings ) {
	   if(isset($settings['send_reset_mails'])){
		   do_action('wm_send_reset_mails');
	   }
	   $new_settings = Wholistic_Matters::get_settings();
		$page_selection_options = array(
			'mpage_link_article', 
			'mpage_link_video', 
			'mpage_link_podcast', 
			'mpage_link_resource', 
			'interactive_tools_page', 
			'learn_about_link', 
		 ); //settings name/ids with value as Page ID
		 foreach ($page_selection_options as $option) {
			 if ( ! isset( $settings[$option] ) ) {
					  $new_settings[$option] = 0;
			  }else{
					  $new_settings[$option] = intval($settings[$option]);
			  }
		 }

		$textarea_options = array(
			'bookmark_info', 
			'learn_about_text', 
			'chef_about', 
			'signup_para', 
			'gated_para', 
			'hpage_text_1', 
			'hpage_text_2', 
			'hpage_text_signup'
		 ); 
		 foreach ($textarea_options as $option) {
			  if ( ! isset( $settings[$option] ) ) {
				  $new_settings[$option] = '';
			  }else{
				  $new_settings[$option] = sanitize_textarea_field($settings[$option]);
			  }
		 }
                 
		$html_options = array(
			'mail_content_reset', 
			'mail_content_register', 
			'mail_content_contact', 
			'mail_content_footer', 
		 ); 
		 foreach ($html_options as $option) {
			  if ( ! isset( $settings[$option] ) ) {
				  $new_settings[$option] = '';
			  }else{
				  $new_settings[$option] = wp_kses_post(balanceTags($settings[$option], true));
			  }
		 }
		 
		$text_options = array(
			'chef_name', 
		 ); 
		 foreach ($text_options as $option) {
			  if ( ! isset( $settings[$option] ) ) {
				  $new_settings[$option] = '';
			  }else{
				  $new_settings[$option] = sanitize_text_field($settings[$option]);
			  }
		 }
		 
		$url_options = array(
			'cultivate_img', 
			'cul_wellness_img', 
			'learn_about_img', 
			'chef_about_img', 
			'wm_social_links', 
			'hpage_link_recipes', 
			'hpage_link_skill', 
			'hpage_link_visit', 
		 ); 
		foreach ($url_options as $option) {
			 if ( ! isset( $settings[$option] ) ) {
				 $new_settings[$option] = '';
			 }else{
				 $new_settings[$option] = $settings[$option];
			 }
		}
		
		$array_options = array(
			'about_mission' => array(
				'image',
				'textarea',
			),
			'about_values' => array(
				'image',
				'textarea',
			),
			'about_education' => array(
				'image',
				'link',
				'textarea',
			),
			'about_partners' => array(
				'textarea',
				'image',
			),
			'mail_config' => array(
				'from_name',
				'from_email',
			),
		 ); 
		foreach ($array_options as $key => $options) {
			foreach ($options as $option) {
				if ( ! isset( $settings[$key][$option] ) ) {
					$new_settings[$key][$option] = '';
					
				}else{
					if(strpos($option, 'textarea') !== false){
						$new_settings[$key][$option] = sanitize_textarea_field($settings[$key][$option]);
					}else if(strpos($option, 'text') !== false || in_array($option, array('from_name'))){
						$new_settings[$key][$option] = sanitize_text_field($settings[$key][$option]);
					}else if(in_array($option, array('from_email'))){
						$new_settings[$key][$option] = sanitize_email($settings[$key][$option]);
					}else if(strpos($option, 'link') !== false){
						$new_settings[$key][$option] = intval($settings[$key][$option]);
					}else {
						$new_settings[$key][$option] = $settings[$key][$option];
					}
				}
				
			}
		}

	   return $new_settings;
   }
   
    public function safe_style_css( $styles ) {
        $styles[] = 'display';
        $styles[] = 'border-radius';
        return $styles;
    }
   /**
    * Adds hook for post delete - delete bookmark for those post
    */
    public function on_bookmarkpost_delete() {

           add_action( 'delete_post', array( $this, 'delete_bookmark' ), 10 );
    }

    /**
    * Delete bookmark on post delete
    *
    * @param type $postid
    */
    public function delete_bookmark( $post_id ) {
        global $wpdb;

        $bookmark_table = W_M_BOOKMARK_TBL;
        $wpdb->query( $wpdb->prepare( "DELETE FROM $bookmark_table WHERE object_id = %d", $post_id ) );
    }
	
    public function widgets_init(  ) {
        register_widget( 'WM_Tax_List_Widget' );
    }
    
    public function rename_post_formats( $translation, $text, $context, $domain ) {
		$names = array(
			'Standard'  => 'Article',
			'Audio'  => 'Podcast',
			'Link' => 'Resources (PDF Downloads)'
		);
		if ($context == 'Post format') {
			$translation = str_replace(array_keys($names), array_values($names), $text);
		}
		return $translation;
    }
	
    public function change_tax_object( ) {
		global $wp_taxonomies;
		$labels = &$wp_taxonomies['category']->labels;
		$labels->name = 'Key Topic';
		$labels->singular_name = 'Key Topic';
		$labels->add_new = 'Add Key Topic';
		$labels->add_new_item = 'Add Key Topic';
		$labels->edit_item = 'Edit Key Topic';
		$labels->new_item = 'Key Topic';
		$labels->view_item = 'View Key Topic';
		$labels->search_items = 'Search Key Topics';
		$labels->not_found = 'No Key Topics found';
		$labels->not_found_in_trash = 'No Key Topics found in Trash';
		$labels->all_items = 'All Key Topics';
		$labels->menu_name = 'Key Topics';
		$labels->name_admin_bar = 'Key Topic';
    }
	
    public function create_custom_taxonomies( ) {
        $labels = array(
			'name'                           => 'Spotlight Topics',
			'singular_name'                  => 'Spotlight Topic',
			'search_items'                   => 'Search Spotlight Topics',
			'all_items'                      => 'All Spotlight Topics',
			'edit_item'                      => 'Edit Spotlight Topic',
			'update_item'                    => 'Update Spotlight Topic',
			'add_new_item'                   => 'Add New Spotlight Topic',
			'new_item_name'                  => 'New Spotlight Topic Name',
			'menu_name'                      => 'Spotlight Topic',
			'view_item'                      => 'View Spotlight Topic',
			'popular_items'                  => 'Popular Spotlight Topic',
			'separate_items_with_commas'     => 'Separate spotlight topics with commas',
			'add_or_remove_items'            => 'Add or remove spotlight topics',
			'choose_from_most_used'          => 'Choose from the most used spotlight topics',
			'not_found'                      => 'No Spotlight Topic found'
		);

		register_taxonomy(
			'spotlight-topic',
			'post',
			array(
				'labels' => $labels,
				'hierarchical' => true,
				'show_ui' => true,  
				'show_in_rest' => false,
				'has_archive' => true,
				'rewrite' => array(
					'slug' => 'spotlight-topic', // This controls the base slug that will display before each term
					'with_front' => false // Don't display the category base before 
				),
			)
		);

		$labels = array(
			'name'                           => 'Practitioner Specialties',
			'singular_name'                  => 'Practitioner Specialty',
			'search_items'                   => 'Search Practitioner Specialties',
			'all_items'                      => 'All Practitioner Specialties',
			'edit_item'                      => 'Edit Practitioner Specialty',
			'update_item'                    => 'Update Practitioner Specialty',
			'add_new_item'                   => 'Add New Practitioner Specialty',
			'new_item_name'                  => 'New Practitioner Specialty Name',
			'menu_name'                      => 'Practitioner Specialty',
			'view_item'                      => 'View Practitioner Specialty',
			'popular_items'                  => 'Popular Practitioner Specialty',
			'separate_items_with_commas'     => 'Separate practitioner specialties with commas',
			'add_or_remove_items'            => 'Add or remove practitioner specialties',
			'choose_from_most_used'          => 'Choose from the most used practitioner specialties',
			'not_found'                      => 'No Practitioner Specialty found'
		);

		register_taxonomy(
			'practitioner-specialty',
			'post',
			array(
				'labels' => $labels,
				'hierarchical' => true,
				'show_ui' => true,  
				'show_in_rest' => false,
				'has_archive' => true,
				'rewrite' => array(
					'slug' => 'practitioner-specialty', // This controls the base slug that will display before each term
					'with_front' => false // Don't display the category base before 
				),
			)
		);
		
		
		$series_labels = array(
			'name'                       => __( 'Podcast Series', 'seriously-simple-podcasting' ),
			'singular_name'              => __( 'Series', 'seriously-simple-podcasting' ),
			'search_items'               => __( 'Search Series', 'seriously-simple-podcasting' ),
			'all_items'                  => __( 'All Series', 'seriously-simple-podcasting' ),
			'parent_item'                => __( 'Parent Series', 'seriously-simple-podcasting' ),
			'parent_item_colon'          => __( 'Parent Series:', 'seriously-simple-podcasting' ),
			'edit_item'                  => __( 'Edit Series', 'seriously-simple-podcasting' ),
			'update_item'                => __( 'Update Series', 'seriously-simple-podcasting' ),
			'add_new_item'               => __( 'Add New Series', 'seriously-simple-podcasting' ),
			'new_item_name'              => __( 'New Series Name', 'seriously-simple-podcasting' ),
			'menu_name'                  => __( 'Series', 'seriously-simple-podcasting' ),
			'view_item'                  => __( 'View Series', 'seriously-simple-podcasting' ),
			'popular_items'              => __( 'Popular Series', 'seriously-simple-podcasting' ),
			'separate_items_with_commas' => __( 'Separate series with commas', 'seriously-simple-podcasting' ),
			'add_or_remove_items'        => __( 'Add or remove Series', 'seriously-simple-podcasting' ),
			'choose_from_most_used'      => __( 'Choose from the most used Series', 'seriously-simple-podcasting' ),
			'not_found'                  => __( 'No Series Found', 'seriously-simple-podcasting' ),
			'items_list_navigation'      => __( 'Series list navigation', 'seriously-simple-podcasting' ),
			'items_list'                 => __( 'Series list', 'seriously-simple-podcasting' ),
		);

		$series_args = array(
			'public'       => true,
			'hierarchical' => true,
			'has_archive'	=> true,
			'rewrite'      => array( 'slug' =>  'series' , 'with_front' => false),
			'labels'       => $series_labels,
			'show_in_rest' => true,
		);

		register_taxonomy( 'series', 'post', $series_args );


        $course_categories_labels = array(
            'name'                       => __( 'Course Categories', 'course-categories' ),
            'singular_name'              => __( 'Course Category', 'course-categories' ),
            'search_items'               => __( 'Search Course Categories', 'course-categories' ),
            'all_items'                  => __( 'All Course Categories', 'course-categories' ),
            'parent_item'                => __( 'Parent Course Category', 'course-categories' ),
            'parent_item_colon'          => __( 'Parent Course Category:', 'course-categories' ),
            'edit_item'                  => __( 'Edit Course Category', 'course-categories' ),
            'update_item'                => __( 'Update Course Category', 'course-categories' ),
            'add_new_item'               => __( 'Add New Course Category', 'course-categories' ),
            'new_item_name'              => __( 'New Course Category Name', 'course-categories' ),
            'menu_name'                  => __( 'Course Categories', 'course-categories' ),
            'view_item'                  => __( 'View Course Category', 'course-categories' ),
            'popular_items'              => __( 'Popular Course Categories', 'course-categories' ),
            'separate_items_with_commas' => __( 'Separate course categories with commas', 'course-categories' ),
            'add_or_remove_items'        => __( 'Add or remove Course Category', 'course-categories' ),
            'choose_from_most_used'      => __( 'Choose from the most used Course Categories', 'course-categories' ),
            'not_found'                  => __( 'No Course Categories Found', 'course-categories' ),
            'items_list_navigation'      => __( 'Course Category list navigation', 'course-categories' ),
            'items_list'                 => __( 'Course Category list', 'course-categories' ),
        );

        $course_categories_args = array(
            'public'       => true,
            'hierarchical' => true,
            'has_archive'	=> true,
            'rewrite'      => array( 'slug' =>  'course-categories' , 'with_front' => false),
            'labels'       => $course_categories_labels,
            'show_in_rest' => true,
        );

        register_taxonomy( 'course-categories', 'courses', $course_categories_args );
    }
	
    public function create_custom_cpt( ) {
        // Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Events', 'Post Type General Name' ),
			'singular_name'       => _x( 'Event', 'Post Type Singular Name' ),
			'menu_name'           => __( 'Events' ),
			'parent_item_colon'   => __( 'Parent Events' ),
			'all_items'           => __( 'All Events' ),
			'view_item'           => __( 'View Event' ),
			'add_new_item'        => __( 'Add New Event' ),
			'add_new'             => __( 'Add New' ),
			'edit_item'           => __( 'Edit Event' ),
			'update_item'         => __( 'Update Event' ),
			'search_items'        => __( 'Search Events' ),
			'not_found'           => __( 'Not Found' ),
			'not_found_in_trash'  => __( 'Not found in Trash' ),
		);

		// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'Event' ),
			'description'         => __( 'Custom CPT to Manage Events.' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail'),
			'hierarchical' => false,
			'public'              => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'has_archive'         => 'events',
			'rewrite' => array('slug' => 'event-detail','with_front' => FALSE), /* you can specify its url slug */
		);

		// Registering your Custom Post Type
		register_post_type( 'wm_event', $args );
		
        // Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'News', 'Post Type General Name' ),
			'singular_name'       => _x( 'News', 'Post Type Singular Name' ),
			'menu_name'           => __( 'News' ),
			'parent_item_colon'   => __( 'Parent News' ),
			'all_items'           => __( 'All News' ),
			'view_item'           => __( 'View News' ),
			'add_new_item'        => __( 'Add New News' ),
			'add_new'             => __( 'Add New' ),
			'edit_item'           => __( 'Edit News' ),
			'update_item'         => __( 'Update News' ),
			'search_items'        => __( 'Search News' ),
			'not_found'           => __( 'Not Found' ),
			'not_found_in_trash'  => __( 'Not found in Trash' ),
		);

		// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'News' ),
			'description'         => __( 'Custom CPT to Manage News.' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail'),
			'hierarchical'		  => false,
			'public'              => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'has_archive'         => 'news',
			'rewrite' => array('slug' => 'news-detail','with_front' => FALSE), /* you can specify its url slug */
		);

		// Registering your Custom Post Type
		register_post_type( 'wm_news', $args );
		
		
        // Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Recipes', 'Post Type General Name' ),
			'singular_name'       => _x( 'Recipe', 'Post Type Singular Name' ),
			'menu_name'           => __( 'Recipes' ),
			'parent_item_colon'   => __( 'Parent Recipes' ),
			'all_items'           => __( 'All Recipes' ),
			'view_item'           => __( 'View Recipe' ),
			'add_new_item'        => __( 'Add New Recipe' ),
			'add_new'             => __( 'Add New' ),
			'edit_item'           => __( 'Edit Recipe' ),
			'update_item'         => __( 'Update Recipe' ),
			'search_items'        => __( 'Search Recipes' ),
			'not_found'           => __( 'Not Found' ),
			'not_found_in_trash'  => __( 'Not found in Trash' ),
		);

		// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'Recipes' ),
			'description'         => __( 'Custom CPT to Manage Recipes.' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail'),
			'hierarchical'		  => false,
			'public'              => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'has_archive'         => 'recipes',
			'rewrite' => array('slug' => 'recipe-detail','with_front' => FALSE), /* you can specify its url slug */
		);

		// Registering your Custom Post Type
		register_post_type( 'wm_recipe', $args );
		
		
        // Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Cooking Skills Videos', 'Post Type General Name' ),
			'singular_name'       => _x( 'Skill Video', 'Post Type Singular Name' ),
			'menu_name'           => __( 'Skills Videos' ),
			'parent_item_colon'   => __( 'Parent Cooking Videos' ),
			'all_items'           => __( 'All Cooking Skills Videos' ),
			'view_item'           => __( 'View Cooking Skills Video' ),
			'add_new_item'        => __( 'Add New Cooking Skills Video' ),
			'add_new'             => __( 'Add New' ),
			'edit_item'           => __( 'Edit Cooking Skills Video' ),
			'update_item'         => __( 'Update Cooking Skills Video' ),
			'search_items'        => __( 'Search Cooking Skills Videos' ),
			'not_found'           => __( 'Not Found' ),
			'not_found_in_trash'  => __( 'Not found in Trash' ),
		);

		// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'Skills Videos' ),
			'description'         => __( 'Custom CPT to Manage Cooking Skills Videos.' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail'),
			'taxonomies'		  => array('post_tag'),
			'hierarchical'		  => false,
			'public'              => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'has_archive'         => 'cooking-skills-videos',
			'rewrite' => array('slug' => 'cooking-skills-video','with_front' => FALSE), /* you can specify its url slug */
		);

		// Registering your Custom Post Type
		register_post_type( 'wm_skill_video', $args );
		
        // Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Herbs', 'Post Type General Name' ),
			'singular_name'       => _x( 'Herb', 'Post Type Singular Name' ),
			'menu_name'           => __( 'Herbs' ),
			'parent_item_colon'   => __( 'Parent Herb' ),
			'all_items'           => __( 'All Herbs' ),
			'view_item'           => __( 'View Herb' ),
			'add_new_item'        => __( 'Add New Herb' ),
			'add_new'             => __( 'Add New' ),
			'edit_item'           => __( 'Edit Herb' ),
			'update_item'         => __( 'Update Herb' ),
			'search_items'        => __( 'Search Herbs' ),
			'not_found'           => __( 'Not Found' ),
			'not_found_in_trash'  => __( 'Not found in Trash' ),
		);

		// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'Herbs' ),
			'description'         => __( 'Custom CPT to Manage Herbs (Tertiary Dataset - Herbal Medicinals).' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'		  => false,
			'public'              => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'has_archive'         => false,
			'rewrite' => array('slug' => 'herb-detail','with_front' => FALSE), /* you can specify its url slug */
		);

		// Registering your Custom Post Type
		register_post_type( 'wm_herb', $args );


        $labels = array(
            'name'                => _x( 'Clinical Practicum', 'Post Type General Name' ),
            'singular_name'       => _x( 'Clinical Practicum', 'Post Type Singular Name' ),
            'menu_name'           => __( 'Clinical Practicum' ),
            'parent_item_colon'   => __( 'Clinical Practicum' ),
            'all_items'           => __( 'All Clinical Practicum' ),
            'view_item'           => __( 'View Clinical Practicum' ),
            'add_new_item'        => __( 'Add New Clinical Practicum' ),
            'add_new'             => __( 'Add New' ),
            'edit_item'           => __( 'Edit Clinical Practicum' ),
            'update_item'         => __( 'Update Clinical Practicum' ),
            'search_items'        => __( 'Search Clinical Practicum' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        $args = array(
            'label'               => __( 'Clinical Practicum' ),
            'description'         => __( 'Custom CPT to Manage Clinical Practicum.' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail'),
            'hierarchical'		  => false,
            'public'              => true,
            'exclude_from_search' => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'has_archive'         => false,
            'rewrite' => array('slug' => 'clinical-practicum','with_front' => FALSE), /* you can specify its url slug */
        );

        // Registering your Custom Post Type
        register_post_type( 'clinical_practicum', $args );


        $labels = array(
            'name'                => _x( 'White Papers', 'Post Type General Name' ),
            'singular_name'       => _x( 'White Paper', 'Post Type Singular Name' ),
            'menu_name'           => __( 'White Papers' ),
            'parent_item_colon'   => __( 'Parent White Paper' ),
            'all_items'           => __( 'All White Papers' ),
            'view_item'           => __( 'View White Paper' ),
            'add_new_item'        => __( 'Add New White Paper' ),
            'add_new'             => __( 'Add New' ),
            'edit_item'           => __( 'Edit White Paper' ),
            'update_item'         => __( 'Update White Paper' ),
            'search_items'        => __( 'Search White Papers' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        $args = array(
            'label'               => __( 'White Papers' ),
            'description'         => __( 'Custom CPT to Manage White Papers.' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail'),
            'hierarchical'		  => false,
            'public'              => true,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'has_archive'         => false,
            'rewrite' => array('slug' => 'white-papers','with_front' => FALSE), /* you can specify its url slug */
        );

        // Registering your Custom Post Type
        register_post_type( 'white_papers', $args );


        $labels = array(
            'name'                => _x( 'Courses', 'Post Type General Name' ),
            'singular_name'       => _x( 'Course', 'Post Type Singular Name' ),
            'menu_name'           => __( 'Courses' ),
            'parent_item_colon'   => __( 'Parent Course' ),
            'all_items'           => __( 'All Courses' ),
            'view_item'           => __( 'View Course' ),
            'add_new_item'        => __( 'Add New Course' ),
            'add_new'             => __( 'Add New' ),
            'edit_item'           => __( 'Edit Course' ),
            'update_item'         => __( 'Update Course' ),
            'search_items'        => __( 'Search Courses' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        $args = array(
            'label'               => __( 'Courses' ),
            'description'         => __( 'Custom CPT to Manage Courses.' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail'),
            'hierarchical'		  => false,
            'public'              => true,
            'exclude_from_search' => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'has_archive'         => true,
            'rewrite' => array('slug' => 'courses','with_front' => FALSE), /* you can specify its url slug */
        );

        // Registering your Custom Post Type
        register_post_type( 'courses', $args );
    }
    
    //////////User Meta/////////////
	
    public function show_extra_profile_fields( $user  ) {
        print('<div id="poststuff" class="metabox-holder has-right-sidebar">
          <div id="tagsdiv-post_tag" class="postbox ">
            <h3 class="hndle"><span> '.__('Wholistic Matters Extra Profile Information', 'wholistic-matters').'</span></h3>
            <div class="inside">');
            
            print('<table class="form-table">');

            $meta_number = 0;
            $custom_meta_fields = WMHelper::get_custom_user_meta_fields();
            foreach ($custom_meta_fields as $meta_field_name => $meta_field) {
              $meta_number++;
              print('<tr>');
              print('<th><label for="' . $meta_field_name . '">' . $meta_field['label'] . '</label></th>');
              print('<td>');
              switch ($meta_field['type']) {
                  case 'checkbox':
                    print('<input type="checkbox" name="' . $meta_field_name . '" id="' . $meta_field_name . '" value="yes" class="regular-text" '. checked(get_user_meta($user->ID, $meta_field_name, true ), 'yes', false).'/><br />');
                    break;
                  case 'select':
                    print('<select name="' . $meta_field_name . '" id="' . $meta_field_name . '" >');
                    print('<option value="">Select</options>');
                    if(isset($meta_field['options']) && is_array($meta_field['options'])){
                        foreach ($meta_field['options'] as $opt_val => $opt_lbl) {
                            $opt_selected = '';
                            if(get_user_meta($user->ID, $meta_field_name, true ) == $opt_val){
                                $opt_selected = 'selected';
                            }
                            print('<option value="'.$opt_val.'" '.$opt_selected.'>'.$opt_lbl.'</options>');
                        }
                    }
                    print('</select>');
                    break;

                  default:
                    print('<input type="text" name="' . $meta_field_name . '" id="' . $meta_field_name . '" value="' . esc_attr( get_user_meta($user->ID, $meta_field_name, true ) ) . '" class="regular-text" /><br />');
                    break;
              }
              print('<span class="description"></span>');
              print('</td>');
              print('</tr>');
            }
            print('</table>');
        print('</div>');
        print('</div>');
    }
	
    public function save_extra_profile_fields( $user_id  ) {
        if (!current_user_can('edit_user', $user_id))
            return false;

        $custom_meta_fields = WMHelper::get_custom_user_meta_fields();
        foreach ($custom_meta_fields as $meta_field_name => $meta_field) {
          update_user_meta( $user_id, $meta_field_name, $_POST[$meta_field_name] );
        }
    }
	
    public function manage_users_custom_column( $value, $column_name, $id  ) {
        $meta_number = 0;
        $custom_meta_fields = WMHelper::get_custom_user_meta_fields();
        foreach ($custom_meta_fields as $meta_field_name => $meta_field) {
            $meta_number++;
            if( $column_name == ('wm-usercolumn-' . $meta_number) ) {
                return get_user_meta($id, $meta_field_name, true );
            }
        }
    }
	
    public function manage_users_columns( $defaults  ) {
        $meta_number = 0;
        $custom_meta_fields = WMHelper::get_custom_user_meta_fields();
        foreach ($custom_meta_fields as $meta_field_name => $meta_field) {
          $meta_number++;
          if(in_array($meta_field_name, array('_wm_hc_professional_type', '_wm_degrees')) ){
              continue;
          }
          $defaults['wm-usercolumn-' . $meta_number] = $meta_field['column'];
        }
        return $defaults;
    }
    
    public function wm_after_register( $post, $user_id  )
    {
        if(!is_wp_error($user_id))
        {
			$email_variables = array();
            $custom_meta_fields = WMHelper::get_custom_user_meta_fields();

            // Update user meta data
            foreach ($custom_meta_fields as $meta_field_name => $meta_field)
            {
				$email_variables[$meta_field_name] = '';
				$email_variables['label'.$meta_field_name] = $meta_field['label'];

				if('_wm_legal_agreement' == $meta_field_name)
				{
					$post[$meta_field_name] = 'yes';
				}

                if(!isset($post[$meta_field_name]))
                {
                    continue;
                }

				$meta_val = $post[$meta_field_name];
                $meta_val = is_array($meta_val) ? implode(',', $meta_val) : sanitize_text_field($meta_val);

                update_user_meta( $user_id, $meta_field_name, $meta_val );

				$email_variables[$meta_field_name] = $meta_val;
            }
			
			/*
			 * Send welcome email
			 */
            global $wp_roles;
			$adminBcc = get_option( 'admin_email' );
			$site_from = WMHelper::get_email_from_address();
			$email_variables['email'] = sanitize_user($post['email']);
			$email_variables['first_name'] = sanitize_text_field($post['first_name']);
			$email_variables['last_name'] = sanitize_text_field($post['last_name']);
			$user_role = isset($post['user_role']) && in_array(strtolower($post['user_role']), array('hcp', 'non-hcp')) ? strtolower($post['user_role']) : 'non-hcp';
			$email_variables['user_role_slug'] = $user_role;
			$email_variables['user_role'] = translate_user_role( $wp_roles->roles[ $user_role ]['name'] );
			$headers = "From: $site_from\r\n";
            $headers .= "cc: 'kmarker@standardprocess.com'\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
            $subject = __('Welcome to').' '.get_bloginfo('name');
//            if(!empty($adminBcc)){
//                $headers .= "Bcc: $adminBcc\r\n"; //comment this to stop bcc to admin
//            }
			$html_message = WMHelper::get_email_template('register', WMHelper::get_email_variables('register', $email_variables));

			wp_mail( $email_variables['email'], $subject, $html_message, $headers );
        }
    }
    
    public function wm_after_user_update( $post, $user_id, $updated_user_id  ) {
        if(!is_wp_error($updated_user_id)) {
            $custom_meta_fields = WMHelper::get_custom_user_meta_fields();
            foreach ($custom_meta_fields as $meta_field_name => $meta_field) {
                if(!isset($post[$meta_field_name])){
                    delete_user_meta($updated_user_id, $meta_field_name);
                }
                $meta_val = $post[$meta_field_name];
                $meta_val = is_array($meta_val) ? implode(',', $meta_val) : $meta_val;
                
                update_user_meta( $updated_user_id, $meta_field_name, $meta_val );
            }
        }
    }
	////
	public function manage_posts_pre_get_posts( $query  ) {
		global $pagenow;
		if ( ! is_admin() || 'edit.php' != $pagenow || ! $query->is_main_query() || 'post' != $query->get( 'post_type' ) )  {
			return;
		}

		$orderby = $query->get( 'orderby' );

		switch ( $orderby ) {
			case 'likes':
				$meta_query = array(
					'relation' => 'OR',
					array(
						'key' => '_wm_post_like_count',
						'compare' => 'NOT EXISTS', // see note above
					),
					array(
						'key' => '_wm_post_like_count',
					),
				);
				$query->set( 'meta_query', $meta_query );
				$query->set( 'orderby', 'meta_value' );
				break;
			case 'dislikes':
				$meta_query = array(
					'relation' => 'OR',
					array(
						'key' => '_wm_post_dislike_count',
						'compare' => 'NOT EXISTS', // see note above
					),
					array(
						'key' => '_wm_post_dislike_count',
					),
				);
				$query->set( 'meta_query', $meta_query );
				$query->set( 'orderby', 'meta_value' );
				break;
		}
	}
	public function manage_posts_columns( $columns ) {
		// save date to the variable
		$date = $columns['date'];
		// unset the 'date' column
		unset( $columns['date'] ); 
		$columns['likes'] = __( 'Likes' );
		$columns['dislikes'] = __( 'Dislikes' );
		$columns['date'] = $date; // set the 'date' column again, after the custom column
		return $columns;
	}
	public function manage_posts_sortable_columns( $columns ) {
		$columns['likes'] = 'likes';
		$columns['dislikes'] = 'dislikes';
		return $columns;
	}
	public function manage_posts_custom_column( $column, $post_id ) {
		switch ( $column ) {
			case 'likes' :
				$likes = get_post_meta( $post_id , '_wm_post_like_count' , true ); 
				if($likes){
					echo $likes;
				}
				break;
			case 'dislikes' :
				$dislikes = get_post_meta( $post_id , '_wm_post_dislike_count' , true ); 
				if($dislikes){
					echo $dislikes;
				}
				break;

		}
	}
	
	// REGISTER TERM META
    public function register_term_meta(  ) {
		//register term meta
        register_meta( 'term', 'wm_series_host', array($this, 'sanitize_term_meta_text') );
        register_meta( 'term', 'wm_series_soptify', array($this, 'sanitize_term_meta_url') );
        register_meta( 'term', 'wm_series_apple', array($this, 'sanitize_term_meta_url') );
        register_meta( 'term', 'wm_series_itunes', array($this, 'sanitize_term_meta_url') );
    }
	
	// SANITIZE DATA
    public function sanitize_term_meta_text ( $value ) {
		return sanitize_text_field ($value);
	}
    public function sanitize_term_meta_url ( $value ) {
		return esc_url($value);
	}
	// GETTER (will be sanitized) in WMHelper
	// ADD FIELD TO CATEGORY TERM PAGE
    public function series_add_form_fields (  ) {
		wp_nonce_field( basename( __FILE__ ), 'term_meta_text_nonce' ); 
		?>
		<div class="form-field">
			<label for="wm_series_host"><?php _e('Series Host Name:'); ?></label>
			<input type="text" name="wm_series_host" id="wm_series_host" value="" class="wm_series_host-field" />
		</div>
		<div class="form-field">
			<label for="wm_series_soptify"><?php _e('Spotify Link:'); ?></label>
			<input type="text" name="wm_series_soptify" id="wm_series_soptify" value="" class="wm_series_soptify-field" />
		</div>
		<div class="form-field">
			<label for="wm_series_apple"><?php _e('Apple Music Link:'); ?></label>
			<input type="text" name="wm_series_apple" id="wm_series_apple" value="" class="wm_series_apple-field" />
		</div>
		<div class="form-field">
			<label for="wm_series_itunes"><?php _e('iTunes Link:'); ?></label>
			<input type="text" name="wm_series_itunes" id="wm_series_itunes" value="" class="wm_series_itunes-field" />
		</div>
		<?php
	}
	// ADD FIELD TO CATEGORY EDIT PAGE
    public function series_edit_form_fields ( $term ) {
		$wm_series_host  = WMHelper::get_term_meta_text( $term->term_id, 'wm_series_host' );
		$wm_series_soptify  = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_soptify' );
		$wm_series_apple  = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_apple' );
		$wm_series_itunes  = WMHelper::get_term_meta_url( $term->term_id, 'wm_series_itunes' );
		
		$wm_series_host = !empty($wm_series_host) ? $wm_series_host : '';     
		$wm_series_soptify = !empty($wm_series_soptify) ? $wm_series_soptify : '';     
		$wm_series_apple = !empty($wm_series_apple) ? $wm_series_apple : '';     
		$wm_series_itunes = !empty($wm_series_itunes) ? $wm_series_itunes : '';     
		wp_nonce_field( basename( __FILE__ ), 'term_meta_text_nonce' );
		?>
		<tr class="form-field ">
			<th scope="row"><label for="wm_series_host"><?php _e('Series Host Name:'); ?></label></th>
			<td>
				<input type="text" name="wm_series_host" id="wm_series_host" value="<?php echo esc_attr( $wm_series_host ); ?>" class="wm_series_host-field" />
			</td>
		</tr>
		<tr class="form-field ">
			<th scope="row"><label for="wm_series_soptify"><?php _e('Spotify Link:'); ?></label></th>
			<td>
				<input type="text" name="wm_series_soptify" id="wm_series_soptify" value="<?php echo esc_attr( $wm_series_soptify ); ?>" class="wm_series_soptify-field" />
			</td>
		</tr>
		<tr class="form-field ">
			<th scope="row"><label for="wm_series_apple"><?php _e('Apple Music Link:'); ?></label></th>
			<td>
				<input type="text" name="wm_series_apple" id="wm_series_apple" value="<?php echo esc_attr( $wm_series_apple ); ?>" class="wm_series_apple-field" />
			</td>
		</tr>
		<tr class="form-field ">
			<th scope="row"><label for="wm_series_itunes"><?php _e('iTunes Link:'); ?></label></th>
			<td>
				<input type="text" name="wm_series_itunes" id="wm_series_itunes" value="<?php echo esc_attr( $wm_series_itunes ); ?>" class="wm_series_itunes-field" />
			</td>
		</tr>
	<?php
	}
	
    public function series_save_term_meta ( $term_id ) {
		// verify the nonce --- remove if you don't care
		if ( ! isset( $_POST['term_meta_text_nonce'] ) || ! wp_verify_nonce( $_POST['term_meta_text_nonce'], basename( __FILE__ ) ) )
			return;

		// get the values
		$wm_series_host_old  = WMHelper::get_term_meta_text( $term_id, 'wm_series_host' );
		$wm_series_host = isset( $_POST['wm_series_host'] ) ? $this->sanitize_term_meta_text( $_POST['wm_series_host'] ) : '';

		$wm_series_soptify_old  = WMHelper::get_term_meta_url( $term_id, 'wm_series_soptify' );
		$wm_series_soptify = isset( $_POST['wm_series_soptify'] ) ? $this->sanitize_term_meta_url( $_POST['wm_series_soptify'] ) : '';

		$wm_series_apple_old  = WMHelper::get_term_meta_url( $term_id, 'wm_series_apple' );
		$wm_series_apple = isset( $_POST['wm_series_apple'] ) ? $this->sanitize_term_meta_url( $_POST['wm_series_apple'] ) : '';

		$wm_series_itunes_old  = WMHelper::get_term_meta_url( $term_id, 'wm_series_itunes' );
		$wm_series_itunes = isset( $_POST['wm_series_itunes'] ) ? $this->sanitize_term_meta_url( $_POST['wm_series_itunes'] ) : '';
		
		// save the values
		if ( $wm_series_host_old && '' === $wm_series_host ) {
			delete_term_meta( $term_id, 'wm_series_host' );
		} else if ( $wm_series_host_old !== $wm_series_host ) {
			update_term_meta( $term_id, 'wm_series_host', $wm_series_host );
		}

		if ( $wm_series_soptify_old && '' === $wm_series_soptify ) {
			delete_term_meta( $term_id, 'wm_series_soptify' );
		} else if ( $wm_series_soptify_old !== $wm_series_soptify ) {
			update_term_meta( $term_id, 'wm_series_soptify', $wm_series_soptify );
		}

		if ( $wm_series_apple_old && '' === $wm_series_apple ) {
			delete_term_meta( $term_id, 'wm_series_apple' );
		} else if ( $wm_series_apple_old !== $wm_series_apple ) {
			update_term_meta( $term_id, 'wm_series_apple', $wm_series_apple );
		}

		if ( $wm_series_itunes_old && '' === $wm_series_itunes ) {
			delete_term_meta( $term_id, 'wm_series_itunes' );
		} else if ( $wm_series_itunes_old !== $wm_series_itunes ) {
			update_term_meta( $term_id, 'wm_series_itunes', $wm_series_itunes );
		}
	}
    ////////////
    
	public function custom_wpp_update_postviews( $postid  ) {  
		// Accuracy:
		//   10  = 1 in 10 visits will update view count. (Recommended for high traffic sites.)
		//   30 = 30% of visits. (Medium traffic websites)
		//   100 = Every visit. Creates many db write operations every request.

		$accuracy = get_post_meta($postid,'views_total', true) ? 30 : 100;

		if ( function_exists('wpp_get_views') && (mt_rand(0,100) < $accuracy) ) {
			// Remove or comment out lines that you won't be using!!
			update_post_meta( $postid, 'views_total',   wpp_get_views( $postid )            );
			//update_post_meta( $postid, 'views_daily',   wpp_get_views( $postid, 'daily' )   );
			update_post_meta( $postid, 'views_weekly',  wpp_get_views( $postid, 'weekly' )  );
			//update_post_meta( $postid, 'views_monthly', wpp_get_views( $postid, 'monthly' ) );
		}
	}
    public function wpp_query_where( $where, $options  ) {  
        if( isset($options['post_type']) ){
			global $wpdb;
			if(in_array('post_format_article', explode(',', $options['post_type'])) ){
				$where .= " AND ID NOT IN (
					SELECT p.ID FROM $wpdb->posts as p
					LEFT JOIN $wpdb->term_relationships as tr ON tr.object_id = p.ID
					LEFT JOIN $wpdb->term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
					WHERE p.post_status = 'publish' AND p.post_type = 'post' AND tt.taxonomy = 'post_format'
					GROUP BY p.ID
				  )";
			}else if(in_array('post_format_video', explode(',', $options['post_type'])) ){
				$where .= " AND ID IN (
					SELECT p.ID FROM $wpdb->posts as p
					LEFT JOIN $wpdb->term_relationships as tr ON tr.object_id = p.ID
					LEFT JOIN $wpdb->term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
					LEFT JOIN $wpdb->terms as t ON t.term_id = tt.term_id
					WHERE p.post_status = 'publish' AND p.post_type = 'post' AND tt.taxonomy = 'post_format' AND t.name = 'post-format-video'
					GROUP BY p.ID
				  )";
			}else if(in_array('post_format_audio', explode(',', $options['post_type'])) ){
				$where .= " AND ID IN (
					SELECT p.ID FROM $wpdb->posts as p
					LEFT JOIN $wpdb->term_relationships as tr ON tr.object_id = p.ID
					LEFT JOIN $wpdb->term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
					LEFT JOIN $wpdb->terms as t ON t.term_id = tt.term_id
					WHERE p.post_status = 'publish' AND p.post_type = 'post' AND tt.taxonomy = 'post_format' AND t.name = 'post-format-audio'
					GROUP BY p.ID
				  )";
			}else if(in_array('post_format_link', explode(',', $options['post_type'])) ){
				$where .= " AND ID IN (
					SELECT p.ID FROM $wpdb->posts as p
					LEFT JOIN $wpdb->term_relationships as tr ON tr.object_id = p.ID
					LEFT JOIN $wpdb->term_taxonomy as tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
					LEFT JOIN $wpdb->terms as t ON t.term_id = tt.term_id
					WHERE p.post_status = 'publish' AND p.post_type = 'post' AND tt.taxonomy = 'post_format' AND t.name = 'post-format-link'
					GROUP BY p.ID
				  )";
			}
        }
		return $where;
    }
    
    public function trackable_post_types( $post_types  ) {
        $track_these_post_types_only = array( 'post', 'page', 'wm_recipe', 'wm_skill_video' );	
		return $track_these_post_types_only;
    }
	
    public function show_user_likes(  $user  ) { ?>
        <table class="form-table">
		<tr>
			<th><label for="user_likes"><?php _e( 'You Like:', 'wholistic-matters' ); ?></label></th>
			<td>
			<?php
			$types = get_post_types( array( 'public' => true ) );
			$args = array(
			  'numberposts' => -1,
			  'post_type' => $types,
			  'meta_query' => array (
				array (
				  'key' => '_wm_user_liked',
				  'value' => $user->ID,
				  'compare' => 'LIKE'
				)
			  ) );		
			$sep = '';
			$like_query = new WP_Query( $args );
			if ( $like_query->have_posts() ) : ?>
			<p>
			<?php while ( $like_query->have_posts() ) : $like_query->the_post(); 
			echo $sep; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			<?php
			$sep = ' &middot; ';
			endwhile; 
			?>
			</p>
			<?php else : ?>
			<p><?php _e( 'You did not liked anything yet.', 'wholistic-matters' ); ?></p>
			<?php 
			endif; 
			wp_reset_postdata(); 
			?>
			</td>
		</tr>
	</table><?php
    }
	
    public function the_term_image_taxonomy( $taxonomy  ) {
        return array( 'spotlight-topic', 'practitioner-specialty', 'category', 'series' );
    }

    public function meta_boxes( $meta_boxes ) {
            $prefix = WM_META_PREFIX;
            //docs: https://docs.metabox.io/fields/
            $meta_boxes[] = array(
                    'id' => 'wm-page-metabox',
                    'title' => esc_html__( 'Additional Details', 'wholistic-matters' ),
                    'post_types' => array('page' ),
                    'context' => 'side',
                    'priority' => 'high',
                    'autosave' => 'false',
                    'fields' => array(
                            array(
								'id' => $prefix . 'is_premium',
								'name' => esc_html__( 'Is Premium Tool/Page?', 'wholistic-matters' ),
								'type' => 'checkbox',
								'desc' => 'Yes. Check to make this page accesible by HCP users only.',
								'std'  => 0,
                            ),
                    ),
            );
			
            $meta_boxes[] = array(
                    'id' => 'wm-post-metabox',
                    'title' => esc_html__( 'Additional Details', 'wholistic-matters' ),
                    'post_types' => array('post' ),
                    'context' => 'side',
                    'priority' => 'high',
                    'autosave' => 'false',
                    'fields' => array(
                            array(
								'id' => $prefix . 'is_premium',
								'name' => esc_html__( 'Is Premium?', 'wholistic-matters' ),
								'type' => 'checkbox',
								'desc' => 'Yes',
								'std'  => 0,
                            ),
                            array(
                                    'id' => $prefix . 'feature_spotlight',
                                    'name' => esc_html__( 'Featured in a Spotlight Topic', 'wholistic-matters' ),
                                    'type' => 'checkbox',
                                    'desc' => 'Yes',
                            ),
                            array(
                                    'id' => $prefix . 'feature_specialties',
                                    'name' => esc_html__( 'Featured in a Practitioner Specialties', 'wholistic-matters' ),
                                    'type' => 'checkbox',
                                    'desc' => 'Yes',
                            ),
                            array(
                                    'id' => $prefix . 'mins_to_read',
                                    'name' => esc_html__( 'Minutes to Read', 'wholistic-matters' ),
                                    'type' => 'text',
                                    //'step' => 'any',
                                    'placeholder' => 'No. of minutes e.g 5:20',
                            ),
                    ),
            );

            $meta_boxes[] = array(
                    'id' => 'wm-post-metabox-video',
                    'title' => esc_html__( 'Embed Video Details', 'wholistic-matters' ),
                    'post_types' => array('post','wm_skill_video' ),
                    'context' => 'normal',
                    'priority' => 'high',
                    'autosave' => 'false',
                    'fields' => array(
                            array(
                                    'id' => $prefix . 'embed_video',
                                    'name' => esc_html__( 'Embed Video using', 'wholistic-matters' ),
                                    'type' => 'radio',
                                    'std' => $prefix. 'embed_video1',
                                    // Array of 'value' => 'Label' pairs for radio options.
                                    // Note: the 'value' is stored in meta field, not the 'Label'
                                    'options' => array(
                                            $prefix. 'embed_video1' => 'External Video (Youtube, etc)',
                                            $prefix. 'embed_video2' => 'Internal Video (Self-Hosted)',
                                    ),
                                    // Show choices in the same line?
                                    'inline' => true,
                            ),
                            array(
                                    'id' => $prefix . 'embed_video1',
                                    'name' => esc_html__( 'External Video', 'wholistic-matters' ),
                                    'type' => 'oembed',
                                    'desc' => 'Enter Video URL (Youtube, Facebook, Vimeo, etc)',
                                    // Input size
                                    'size' => 50,
                                    //'not_available_string' => '',
                            ),
                            array(
                                    'id' => $prefix . 'embed_video2',
                                    'name' => esc_html__( 'Internal Video', 'wholistic-matters' ),
                                    'type' => 'video',
                                    // Maximum video uploads. 0 = unlimited.
                                    'max_file_uploads' => 1,

                                    // Delete videos from Media Library when remove it from post meta?
                                    // Note: it might affect other posts if you use same videos for multiple posts
                                    'force_delete'     => false,

                                    // Display the "Uploaded 1/3 videos" status
                                    'max_status'       => false,
                            ),
                            array(
                                    'id' => $prefix . 'mins_to_watch',
                                    'name' => esc_html__( 'Minutes to Watch', 'wholistic-matters' ),
                                    'type' => 'text',
                                    //'step' => 'any',
                                    'placeholder' => 'No. of minutes e.g 5:20',
                            ),
                    ),
            );

            $meta_boxes[] = array(
                    'id' => 'wm-post-metabox-link',
                    'title' => esc_html__( 'Embed PDF Details', 'wholistic-matters' ),
                    'post_types' => array('post', 'clinical_practicum', 'white_papers'),
                    'context' => 'normal',
                    'priority' => 'high',
                    'autosave' => 'false',
                    'fields' => array(
                            array(
                                    'id' => $prefix . 'embed_file',
                                    'name' => esc_html__( 'File', 'wholistic-matters' ),
                                    'type' => 'file_advanced',
                                    // Delete file from Media Library when remove it from post meta?
                                    // Note: it might affect other posts if you use same file for multiple posts
                                    'force_delete'     => false,

                                    // Maximum file uploads.
                                    'max_file_uploads' => 1,

                                    // File types.
                                    // 'mime_type'        => 'application,audio,video',

                                    // Do not show how many files uploaded/remaining.
                                    'max_status'       => false,
                            ),
                    ),
            );

            $meta_boxes[] = array(
                    'id' => 'wm-post-metabox-audio',
                    'title' => esc_html__( 'Embed Podcast Details', 'wholistic-matters' ),
                    'post_types' => array('post' ),
                    'context' => 'normal',
                    'priority' => 'high',
                    'autosave' => 'false',
                    'fields' => array(
//						array(
//								'id' => $prefix . 'podcast_host',
//								'name' => esc_html__( 'Podcast Host', 'wholistic-matters' ),
//								'type' => 'text',
//						),
						array(
								'id' => $prefix . 'podcast_file',
								'name' => esc_html__( 'Episode File', 'wholistic-matters' ),
								'desc' => esc_html__( "Supported formats: 'mp3', 'm4a', 'ogg', 'wav', 'wma'", 'wholistic-matters' ),
								'type' => 'file-input',
						),
						array(
								'id' => $prefix . 'podcast_file_ogg',
								'name' => esc_html__( 'Episode File (.ogg)', 'wholistic-matters' ),
								'desc' => esc_html__( 'Used as a fallback.', 'wholistic-matters' ),
								'type' => 'file-input',
						),
						array(
								'id' => $prefix . 'mins_to_listen',
								'name' => esc_html__( 'Episode Length', 'wholistic-matters' ),
								'type' => 'text',
								//'step' => 'any',
								'placeholder' => 'No. of minutes e.g 5:20',
						),
						array(
								'id' => $prefix . 'podcast_spotify',
								'name' => esc_html__( 'Spotify Link', 'wholistic-matters' ),
								'type' => 'text',
						),
						array(
								'id' => $prefix . 'podcast_apple',
								'name' => esc_html__( 'Apple Music Link', 'wholistic-matters' ),
								'type' => 'text',
						),
						array(
								'id' => $prefix . 'podcast_itunes',
								'name' => esc_html__( 'iTunes Link', 'wholistic-matters' ),
								'type' => 'text',
						),
						
                    ),
            );

            $meta_boxes[] = array(
                    'id' => 'wm-post-metabox-misc',
                    'title' => esc_html__( 'Misc Details', 'wholistic-matters' ),
                    'post_types' => array('post', 'wm_herb', 'clinical_practicum', 'white_papers'),
                    'context' => 'normal',
                    'priority' => 'default',
                    'autosave' => 'false',
                    'fields' => array(
                            array(
                                    'id' => $prefix . 'references',
                                    'name' => esc_html__( 'References', 'wholistic-matters' ),
                                    'type' => 'wysiwyg',
                                    // Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
                                    'raw'     => false,
                                    // Editor settings, see https://codex.wordpress.org/Function_Reference/wp_editor
                                    'options' => array(
                                            'textarea_rows' => 4,
                                            'media_buttons' => false,
                                            'teeny'         => true,
                                    ),
                            ),
                    ),
            );
			
			//Events
            $meta_boxes[] = array(
                    'id' => 'wm-post-metabox-misc',
                    'title' => esc_html__( 'Event Details', 'wholistic-matters' ),
                    'post_types' => array('wm_event' ),
                    'context' => 'normal',
                    'priority' => 'default',
                    'autosave' => 'false',
                    'fields' => array(
                            array(
								'id' => $prefix . 'event_date',
								'name' => esc_html__( 'Date', 'wholistic-matters' ),
								'type' => 'date',
								// Date picker options. See here http://api.jqueryui.com/datepicker
								'js_options' => array(
									//'dateFormat'      => 'yy-mm-dd',
									'showButtonPanel' => false,
								),
								// Display inline?
								'inline' => false,

								// Save value as timestamp?
								'timestamp' => true,

                            ),
                            array(
								'id' => $prefix . 'event_time',
								'name' => esc_html__( 'Time', 'wholistic-matters' ),
								'type' => 'time',
								// Time options, see here http://trentrichardson.com/examples/timepicker/
								'js_options' => array(
									'stepMinute'      => 1,
									'controlType'     => 'select',
									'showButtonPanel' => false,
									'oneLine'         => true,
								),
								// Display inline?
								'inline' => false,

                            ),
                            array(
								'id' => $prefix . 'event_time_zone',
								'name' => esc_html__( 'Event Timezone e.g. UTC or GMT etc.', 'wholistic-matters' ),
								'desc' => 'Optional. Default empty. The timezone where the event will take place. Can be any other text you want to display after the event time.',
								'type' => 'text',

                            ),
						
                            array(
								'id' => $prefix . 'event_learn_more',
								'name' => esc_html__( 'Learn More Link', 'wholistic-matters' ),
								'type' => 'text',
                            )
                    ),
            );
			
			$meta_boxes[] = array(
                    'id' => 'wm-recipe-metabox',
                    'title' => esc_html__( 'Recipe Details', 'wholistic-matters' ),
                    'post_types' => array('wm_recipe' ),
                    'context' => 'normal',
                    'priority' => 'default',
                    'autosave' => 'false',
                    'fields' => array(
						array(
								'id' => $prefix . 'mins_to_cook',
								'name' => esc_html__( 'Minutes to cook', 'wholistic-matters' ),
								'type' => 'number',
								'step' => 'any',
								'placeholder' => 'No. of minutes e.g 5. 60 & above value will be converted into hours + min on the frontend listings e.g. 125 => 2 hrs 5 mins',
						),
						array(
							'id'      => $prefix . 'recipie_ingredients',
							'name'    => esc_html__( 'Ingredients', 'wholistic-matters' ),
							'type'    => 'text_list',

							'clone' => true,

							// Options: array of Placeholder => Label for text boxes
							// Number of options are not limited
							'options' => array(
								'Ingredient 1'      => 'Name',
								'5g'				=> 'Description',
							),
						),
						array(
							'id' => $prefix . 'recipie_instructions',
							'name' => esc_html__( 'Instructions', 'wholistic-matters' ),
							'type' => 'wysiwyg',
							// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
							'raw'     => false,
							// Editor settings, see https://codex.wordpress.org/Function_Reference/wp_editor
							'options' => array(
								'textarea_rows' => 4,
								'media_buttons' => false,
								'teeny'         => true,
							),
						),
						array(
							'id' => $prefix . 'recipie_notes',
							'name' => esc_html__( 'Notes', 'wholistic-matters' ),
							'type' => 'wysiwyg',
							// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
							'raw'     => false,
							// Editor settings, see https://codex.wordpress.org/Function_Reference/wp_editor
							'options' => array(
								'textarea_rows' => 4,
								'media_buttons' => false,
								'teeny'         => true,
							),
						),
                    ),
            );
			
			$meta_boxes[] = array(
				'id' => 'wm-news-metabox',
				'title' => esc_html__( 'News Details (For External)', 'wholistic-matters' ),
				'post_types' => array( 'wm_news' ),
				'context' => 'normal',
				'priority' => 'default',
				'autosave' => 'false',
				'fields' => array(
					array(
							'id' => $prefix . 'news_source',
							'name' => esc_html__( 'External News Source', 'wholistic-matters' ),
							'type' => 'text',
							'desc' => esc_html__( 'Enter name of the external news source. Optional', 'wholistic-matters' ),
					),
					array(
							'id' => $prefix . 'news_external_link',
							'name' => esc_html__( 'External Link for News', 'wholistic-matters' ),
							'type' => 'url',
							'desc' => esc_html__( 'Leave Empty for Internal News article.', 'wholistic-matters' ),
					),
					
				),
            );
			
			$meta_boxes[] = array(
				'id' => 'wm-herb-metabox',
				'title' => esc_html__( 'Herb Details', 'wholistic-matters' ),
				'post_types' => array( 'wm_herb' ),
				'context' => 'normal',
				'priority' => 'default',
				'autosave' => 'false',
				'fields' => array(
					array(
							'id' => $prefix . 'herb_family',
							'name' => esc_html__( 'Family', 'wholistic-matters' ),
							'type' => 'text',
					),
					array(
							'id' => $prefix . 'herb_parts',
							'name' => esc_html__( 'Parts Used', 'wholistic-matters' ),
							'type' => 'text',
					),
					array(
							'id' => $prefix . 'herb_use',
							'name' => esc_html__( 'Used For', 'wholistic-matters' ),
							'type' => 'text',
					),
					
				),
            );

            return $meta_boxes;
    }
}
