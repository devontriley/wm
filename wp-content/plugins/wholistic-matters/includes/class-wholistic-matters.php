<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.example.com
 * @since      1.0.0
 *
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/includes
 * @author     WholisticMatters <info@example.com>
 */
class Wholistic_Matters {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wholistic_Matters_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'W_M_VERSION' ) ) {
			$this->version = W_M_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wholistic-matters';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wholistic_Matters_Loader. Orchestrates the hooks of the plugin.
	 * - Wholistic_Matters_i18n. Defines internationalization functionality.
	 * - Wholistic_Matters_Admin. Defines all hooks for the admin area.
	 * - Wholistic_Matters_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wholistic-matters-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wholistic-matters-i18n.php';
                
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/menu-item-custom-fields.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wholistic-matters-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wholistic-matters-public.php';
                
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets.php';

		$this->loader = new Wholistic_Matters_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wholistic_Matters_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wholistic_Matters_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		
		$plugin_admin = new Wholistic_Matters_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_taxonomies' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_custom_cpt' );
		$this->loader->add_action( 'init', $plugin_admin, 'change_tax_object' );
		
		$this->loader->add_action( 'init', $plugin_admin, 'register_term_meta' );
		$this->loader->add_action( 'series_add_form_fields', $plugin_admin, 'series_add_form_fields' );
		$this->loader->add_action( 'series_edit_form_fields', $plugin_admin, 'series_edit_form_fields' );
		// SAVE TERM META (on term edit & create)
		$this->loader->add_action( 'edit_series', $plugin_admin, 'series_save_term_meta' );
		$this->loader->add_action( 'create_series', $plugin_admin, 'series_save_term_meta' );
		
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
                
		$this->loader->add_action( 'widgets_init', $plugin_admin, 'widgets_init' );
                
		$this->loader->add_action('admin_init', $plugin_admin, 'on_bookmarkpost_delete');
		$this->loader->add_action('rwmb_meta_boxes', $plugin_admin, 'meta_boxes');
		
		$this->loader->add_filter('gettext_with_context', $plugin_admin, 'rename_post_formats', 10, 4);
		$this->loader->add_filter('manage_posts_columns', $plugin_admin, 'manage_posts_columns');
		$this->loader->add_filter('manage_edit-post_sortable_columns', $plugin_admin, 'manage_posts_sortable_columns');
		$this->loader->add_action('manage_posts_custom_column', $plugin_admin, 'manage_posts_custom_column', 10, 2);
		$this->loader->add_action('pre_get_posts', $plugin_admin, 'manage_posts_pre_get_posts');
                
                //user meta
		$this->loader->add_action('show_user_profile', $plugin_admin, 'show_extra_profile_fields');
		$this->loader->add_action('edit_user_profile', $plugin_admin, 'show_extra_profile_fields');
		$this->loader->add_action('personal_options_update', $plugin_admin, 'save_extra_profile_fields');
		$this->loader->add_action('edit_user_profile_update', $plugin_admin, 'save_extra_profile_fields');
		$this->loader->add_action('manage_users_custom_column', $plugin_admin, 'manage_users_custom_column', 15, 3);
		$this->loader->add_action('manage_users_columns', $plugin_admin, 'manage_users_columns', 15, 1);
                
		$this->loader->add_action('wm_after_register', $plugin_admin, 'wm_after_register', 10, 2);
		$this->loader->add_action('wm_after_user_update', $plugin_admin, 'wm_after_user_update', 10, 3);
                
		$this->loader->add_filter('wpp_trackable_post_types', $plugin_admin, 'trackable_post_types');
		//$this->loader->add_filter('wpp_query_join', $plugin_admin, 'wpp_query_join', 10, 2);
		$this->loader->add_filter('wpp_query_where', $plugin_admin, 'wpp_query_where', 10, 2);
		$this->loader->add_filter('taxonomy-term-image-taxonomy', $plugin_admin, 'the_term_image_taxonomy');
		
		$this->loader->add_action('wpp_post_update_views', $plugin_admin, 'custom_wpp_update_postviews');
		
		//load more Archive Tabs
		$this->loader->add_action('show_user_profile', $plugin_public, 'show_user_likes');
		$this->loader->add_action('edit_user_profile', $plugin_public, 'show_user_likes');
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wholistic_Matters_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		$this->loader->add_action( 'init', $plugin_public, 'public_init' );
		$this->loader->add_action( 'template_redirect', $plugin_public, 'template_redirect' );
		$this->loader->add_action( 'wp_head', $plugin_public, 'wp_head' , 99 );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'wp_footer' );
		
		$this->loader->add_filter( 'safe_style_css', $plugin_public, 'safe_style_css', 10, 1 );
               
		//email wp
		$this->loader->add_filter( 'wp_mail_from', $plugin_public, 'wp_mail_from');
		$this->loader->add_filter( 'wp_mail_from_name', $plugin_public, 'wp_mail_from_name');
		$this->loader->add_action( 'wm_send_reset_mails', $plugin_public, 'wm_send_reset_mails');

        //login
		$this->loader->add_action( 'login_form_login', $plugin_public, 'redirect_to_custom_login' );
		$this->loader->add_filter( 'authenticate', $plugin_public, 'maybe_redirect_at_authenticate', 101, 3 );
		$this->loader->add_action( 'wp_logout', $plugin_public, 'redirect_after_logout' );
		$this->loader->add_filter( 'login_redirect', $plugin_public, 'redirect_after_login', 10, 3 );
		//$this->loader->add_filter( 'login_form_middle', $plugin_public, 'login_form_middle', 10, 2 );
		//$this->loader->add_filter( 'login_form_bottom', $plugin_public, 'login_form_bottom', 10, 2 );

        $this->loader->add_action( 'wp_login', $plugin_public, 'patch_ss_trackingid', 11, 2 );
		
		//register
		$this->loader->add_action( 'login_form_register', $plugin_public, 'redirect_to_custom_register' );
		$this->loader->add_action( 'login_form_register', $plugin_public, 'do_register_user' );
		
		//reset/lost password hooks
		$this->loader->add_action( 'login_form_lostpassword', $plugin_public, 'redirect_to_custom_lostpassword' );
		$this->loader->add_action( 'login_form_lostpassword', $plugin_public, 'do_password_lost' );
		$this->loader->add_action( 'login_form_rp', $plugin_public, 'redirect_to_custom_resetpass' );
		$this->loader->add_action( 'login_form_resetpass', $plugin_public, 'redirect_to_custom_resetpass' );
		$this->loader->add_action( 'login_form_rp', $plugin_public, 'do_password_reset' );
		$this->loader->add_action( 'login_form_resetpass', $plugin_public, 'do_password_reset' );
		        
		///Boojmarks ajax funcs
		$this->loader->add_action('wp_ajax_wm_add_category', $plugin_public, 'add_category');
		$this->loader->add_action('wp_ajax_wm_add_folder', $plugin_public, 'add_folder');
		
		$this->loader->add_action('wp_ajax_wm_edit_category', $plugin_public, 'edit_category');
		$this->loader->add_action('wp_ajax_wm_edit_folder', $plugin_public, 'edit_folder');
		// Delete Category from Front Admin
		$this->loader->add_action('wp_ajax_wm_delete_bookmark_category', $plugin_public, 'delete_bookmark_category');
		//$this->loader->add_action('wp_ajax_nopriv_wm_delete_bookmark_category', $plugin_public, 'delete_bookmark_category');
		// Update Category from Front User Admin
		$this->loader->add_action('wp_ajax_wm_update_bookmark_category', $plugin_public, 'update_bookmark_category');
		// Delete Category from Front Admin (delete_bookmark_post)
		$this->loader->add_action('wp_ajax_wm_delete_bookmark_post', $plugin_public, 'delete_bookmark_post');
		//find all boomkark category by loggedin user ajax hook
		$this->loader->add_action('wp_ajax_wm_find_category', $plugin_public, 'find_category');
		//add bookmark for loggedin user ajax hook
		$this->loader->add_action('wp_ajax_wm_add_bookmark', $plugin_public, 'add_bookmark');
		//loadmore bookmark ajax
		$this->loader->add_action('wp_ajax_wm_bookmark_loadmore', $plugin_public, 'bookmark_loadmore');
		$this->loader->add_action('wp_ajax_wm_load_my_bookmarks', $plugin_public, 'load_my_bookmarks');
		$this->loader->add_action('wp_ajax_nopriv_wm_load_my_bookmarks', $plugin_public, 'load_my_bookmarks');
		
		//like/dislike : https://github.com/JonMasterson/WordPress-Post-Like-System
		$this->loader->add_action('wp_ajax_process_simple_like', $plugin_public, 'process_simple_like');
		$this->loader->add_action('wp_ajax_nopriv_process_simple_like', $plugin_public, 'process_simple_like');
		
		//contact form
		$this->loader->add_action('wp_ajax_wm_contact_form', $plugin_public, 'process_contact_form');
		$this->loader->add_action('wp_ajax_nopriv_wm_contact_form', $plugin_public, 'process_contact_form');
		
		//herbs
		$this->loader->add_action('wp_ajax_wm_load_herbs', $plugin_public, 'process_load_herbs');
		$this->loader->add_action('wp_ajax_nopriv_wm_load_herbs', $plugin_public, 'process_load_herbs');
		
		//load more Archive Tabs
		$this->loader->add_action('wp_ajax_wm_load_more_archive', $plugin_public, 'load_more_archive');
		$this->loader->add_action('wp_ajax_nopriv_wm_load_more_archive', $plugin_public, 'load_more_archive');
		
		//search
		$this->loader->add_action('pre_get_posts', $plugin_public, 'search_query');
		$this->loader->add_action('query_vars', $plugin_public, 'search_query_vars');
		$this->loader->add_action('posts_join', $plugin_public, 'search_join', 10, 2 );
		$this->loader->add_action('posts_where', $plugin_public, 'search_where', 10, 2 );
		//$this->loader->add_action('posts_groupby', $plugin_public, 'search_groupby', 10, 2 );
		$this->loader->add_action('posts_distinct', $plugin_public, 'search_distinct');
		$this->loader->add_action('wp_ajax_wm_load_more_search', $plugin_public, 'load_more_search');
		$this->loader->add_action('wp_ajax_nopriv_wm_load_more_search', $plugin_public, 'load_more_search');

		// Mailchimp ajax
        $this->loader->add_action('wp_ajax_wm_mc_put_contact', $plugin_public, 'mc_put_contact');
        $this->loader->add_action('wp_ajax_nopriv_wm_mc_put_contact', $plugin_public, 'mc_put_contact');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wholistic_Matters_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	
	public static function get_settings() {
		$defaults = [
			'login_page'       => 0,
			'register_page'    => 0,
			'forgot_pass_page' => 0,
		];

		$settings = get_option( 'WM_settings', array() );
		$settings = wp_parse_args( $settings, $defaults );

		return $settings;
	}

}
