<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.example.com
 * @since      1.0.0
 *
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/public
 * @author     WholisticMatters <info@example.com>
 */
class Wholistic_Matters_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wholistic-matters-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		if (is_user_logged_in()) {
			$user_id = wp_get_current_user();
			$user_id = $user_id->ID;
		}

		wp_enqueue_script('jquery');
		// Now, enqueue the WP util script so we can use wp.template
		wp_enqueue_script('wp-util');

		wp_enqueue_script('bootstrap-bundle', plugin_dir_url(__FILE__) . 'js/bootstrap.bundle.min.js', array('jquery', 'wp-util'), '1.0.0', true);

		$category_template = '
                <div class="cbxbookmark-mycat-editbox">
                    <input class="cbxbmedit-catname" name="catname" value="##catname##" />                
                    <select class="cbxbmedit-privacy input-catprivacy" name="catprivacy">
                      <option value="1" title="' . esc_html__('Public Folder', 'wholistic-matters') . '">' . esc_html__('Public', 'wholistic-matters') . '</option>
                      <option value="0" title="' . esc_html__('Private Folder', 'wholistic-matters') . '">' . esc_html__('Private', 'wholistic-matters') . '</option>
                    </select>
                    <a href="#" class="cbxbookmark-btn cbxbookmark-cat-save">' . esc_html__('Update', 'wholistic-matters') . ' <span class="cbxbm_busy" style="display:none;"></span></a>
                    <a href="#" class="cbxbookmark-btn cbxbookmark-cat-close">' . esc_html__('Close', 'wholistic-matters') . '</a>
                </div>';

		wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wholistic-matters-public.js', array('jquery', 'wp-util'), $this->version, true);
		$js_translation = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce("wm-bookmark-nonce"),
			'cat_template' => json_encode($category_template),
			'category_delete_success' => esc_html__('Folder deleted successfully', 'wholistic-matters'),
			'category_delete_error' => esc_html__('Unable to delete the folder', 'wholistic-matters'),
			'areyousuretodeletecat' => esc_html__('Are you sure you want to delete this Bookmark Folder?', 'wholistic-matters'),
			'areyousuretodeletebookmark' => esc_html__('Are you sure you want to delete this Bookmark?', 'wholistic-matters'),
			'folder_removed_empty' => esc_html__('All Folders Removed', 'wholistic-matters'),
			'folder_not_found' => esc_html__('No folder found', 'wholistic-matters'),
			'bookmark_not_found' => esc_html__('No bookmark found for this folder', 'wholistic-matters'),
			'bookmark_failed' => esc_html__('Failed to Bookmark', 'wholistic-matters'),
			'bookmark_removed' => esc_html__('Bookmark Removed', 'wholistic-matters'),
			'bookmark_removed_empty' => esc_html__('All Bookmarks Removed', 'wholistic-matters'),
			'bookmark_removed_failed' => esc_html__('Bookmark Removed Failed', 'wholistic-matters'),
			'error_msg' => esc_html__('Error loading data. Response code = ', 'wholistic-matters'),
			'category_name_empty' => esc_html__('Folder name can not be empty', 'wholistic-matters'),
			'add_to_head_defult' => esc_html__('Click Folder to Bookmark', 'wholistic-matters'),
			'category_loaded_edit' => esc_html__('Click to Edit Folder', 'wholistic-matters'),
			//'category_loaded_add'        => esc_html__('Click Folder to Bookmark', 'wholistic-matters'),
			'max_cat_limit' => 0,
			'max_cat_limit_error' => esc_html__('Sorry, you reached the maximum category limit and to create one one, please delete unnecessary folders first', 'wholistic-matters'),
			'user_current_cat_count' => 0,
			'user_current_cats' => '',
			'user_can_create_cat' => 1,
//			'default_folder_id' => is_user_logged_in() ? get_user_meta($user_id, '_wm_quick_save_folder_id', true) : 0,
			'default_folder_id' => is_user_logged_in() ? get_option('_wm_quick_save_folder_id') : 0,
			'folder_max_char' => 55,
			'guest_warning' => esc_html__('Please login to add bookmarks', 'wholistic-matters'),
			'like' => __( 'Like', 'wholistic-matters' ),
			'unlike' => __( 'Unlike', 'wholistic-matters' )
		);

		$js_translation = apply_filters('wm_bookmark_public_jsvar', $js_translation);

		wp_localize_script($this->plugin_name, 'wm_bookmark', $js_translation);
		wp_enqueue_script($this->plugin_name);
	}

	public function wp_footer() {
		if (!is_user_logged_in()) {
			ob_start();
			include plugin_dir_path(dirname(__FILE__)) . 'public/partials/access_popup.php';
			$contents = ob_get_contents();
			ob_end_clean();
			//Signup Popup
			echo do_shortcode('[wm-register display="popup"]');
			//Login Popup
			echo do_shortcode('[wm-login display="popup"]');
		} else {
			if (!is_page('member-account')) {
				ob_start();
				include plugin_dir_path(dirname(__FILE__)) . 'public/partials/bookmark_popup.php';
				$contents = ob_get_contents();
				ob_end_clean();
			}
			include_once plugin_dir_path(dirname(__FILE__)) . "public/partials/bookmark-templates.php";
		}
		echo $contents;
		if ( !is_user_logged_in() || current_user_can('non-hcp') ) {
			ob_start();
			include plugin_dir_path(dirname(__FILE__)) . 'public/partials/access_tools_popup.php';
			$contents = ob_get_contents();
			ob_end_clean();
			echo $contents;
		}
	}

	public function template_redirect() {
//		global $reg_errors;
//		$reg_errors = new WP_Error;
		$this->do_update_user();

		$myAccountPage = get_page_by_path('member-account');
		if (is_page($myAccountPage->ID)) {
			if (!is_user_logged_in()) {
				$login_url = $this->get_login_url();
				$login_url = add_query_arg('redirect_to', get_permalink($myAccountPage), $login_url);
				wp_redirect($login_url);
				exit;
			}
		}
	}

	public function wp_head() {
		if (current_user_can('hcp') || current_user_can('non-hcp')) {
			add_filter('show_admin_bar', '__return_false');
			echo '<style type="text/css" media="screen">
				html { margin-top: 0 !important; }
				* html body { margin-top: 0 !important; }
			</style>';
		}
	}

	public function public_init() {
		if (is_admin() && !defined('DOING_AJAX') && ( current_user_can('hcp') || current_user_can('non-hcp') )) {
			wp_redirect(site_url());
			exit;
		}

		// Register new shortcodes
		add_shortcode('wm-login', [$this, 'render_login_form']);
		add_shortcode('wm-register', [$this, 'render_register_form']);
		add_shortcode('wm-lostpassword', [$this, 'render_lostpassword_form']);
		add_shortcode('wm-resetpass', [$this, 'render_resetpass_form']);
		add_shortcode('wm-account', [$this, 'render_account_form']);

		add_shortcode('wm-bookmark-link', array($this, 'render_bookmark_link'));
		//bookmark button using shortcode
		add_shortcode('wm-bookmark-btn', array($this, 'render_bookmark_btn'));
		//show bookmark list using shortcode
		add_shortcode('wm-bookmarks', array($this, 'render_bookmarks')); //my bookmarks   synced with widget code
		//show boomark categories using shortcode
		add_shortcode('wm-bookmark-folders', array($this, 'render_bookmark_folders'));
		//show most bookmarked posts using shortcode
		add_shortcode('wm-bookmarks-popular', array($this, 'render_bookmark_popular'));
		
		///like/dislike
		add_shortcode('wm-like', array($this, 'render_wm_like_cb'));
	}

	/**
	 * Redirect user to custom login page rather than wp-login.php
	 */
	function redirect_to_custom_login() {
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$redirect_to = isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : null;

			if (is_user_logged_in()) {
				$this->redirect_logged_in_user($redirect_to);
				exit;
			}

			$login_url = $this->get_login_url();
			if (!empty($redirect_to)) {
				$login_url = add_query_arg('redirect_to', $redirect_to, $login_url);
			}

			wp_redirect($login_url);
			exit;
		}
	}

    /**
     * Send PATCH request to SharpSpring to get _ss_tk cookie trackingID
     * This allows life of the lead to track user actions
     */
    public function ss_http_request( $req_type, $ss_method, $ss_params ) {
        //$ss_requestID = session_id();
        $ss_requestID = 0;
        $ss_data = array(
            'method' => $ss_method,
            'params' => $ss_params,
            'id' => $ss_requestID
        );
        $ss_queryString = http_build_query(array('accountID' => 'A662D5370627A757CCAA97C546A49AE7', 'secretKey' => '17C77D0FBCC6E84F839CBF2DED01CD12'));
        $ss_url = "http://api.sharpspring.com/pubapi/v1/?$ss_queryString";
        $ss_data = json_encode($ss_data);

        $ss_ch = curl_init($ss_url);

        curl_setopt($ss_ch, CURLOPT_CUSTOMREQUEST, $req_type);
        curl_setopt($ss_ch, CURLOPT_POSTFIELDS, $ss_data);
        curl_setopt($ss_ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ss_ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($ss_data),
            'Expect: '
        ));

        $ss_result = curl_exec($ss_ch);
        curl_close($ss_ch);

        return $ss_result;
    }

    /**
     * @return string - SS tracking cookie or empty
     */
    public function get_ss_trackingid() {
        if (isset($_COOKIE['__ss_tk'])) {
            return $_COOKIE['__ss_tk'];
        }
        return '';
    }

    /**
     * Returns SS user by email
     * Returns false if user not found
     * @param $email
     * @return bool
     */
    public function get_ss_user( $email ) {
        $response = json_decode($this->ss_http_request( 'POST', 'getLeads', array('where' => array('emailAddress' => $email)) ));

        if(count($response->result->lead) > 0)
        {
            return $response->result->lead[0]->id;
        }

        return false;
    }

    /**
     * Create SS user
     * Returns user ID or false
     * @param $user
     * @return bool
     */
    public function create_ss_user( $user )
    {
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        $email = $user->data->user_email;
        $ss_trackingid = $this->get_ss_trackingid();
        $ss_params = array(
            'objects' => array(
                array(
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'emailAddress' => $email,
                    'trackingID' => $ss_trackingid,
                    'opted_in_5ce59317c4c09' => '1'
                )
            )
        );
        $response = json_decode($this->ss_http_request( 'POST', 'createLeads', $ss_params ));

        if($response->result->creates[0]->success)
        {
            return $response->result->creates[0]->id;
        }

        return false;
    }

    /**
     * Fired when user logs in
     * Create user if none is found and updates SS tracking ID
     * @param $user_login
     * @param $user
     */
    public function patch_ss_trackingid($user_login, $user, $userID = null)
    {
        $user_id = $userID ? $userID : $user->ID;
        $userObj = $user ? $user : get_user_by('id', $user_id);
        $user_email = $userObj->data->user_email;
        $ss_trackingid = $this->get_ss_trackingid();
        // Get SS user id
        $ss_user_id = $this->get_ss_user($user_email);

        // Create new SS user if none is found
        if(!$ss_user_id)
        {
            $this->create_ss_user($userObj);
            return;
        }

        $params = array(
            'objects' => array(
                array(
                    'id' => $ss_user_id,
                    'trackingID' => $ss_trackingid,
                    'opted_in_5ce59317c4c09' => '1'
                )
            )
        );

        // Update existing lead with SS tracking ID
        $this->ss_http_request( 'POST', 'updateLeadsV2', $params);

        return;
    }

	/**
	 * Redirects the user to the custom registration page instead
	 * of wp-login.php?action=register.
	 */
	public function redirect_to_custom_register() {
		if ('GET' == $_SERVER['REQUEST_METHOD']) {
			if (is_user_logged_in()) {
				$this->redirect_logged_in_user();
			} else {
				wp_redirect($this->get_register_url());
			}
			exit;
		}
	}

	/**
	 * Redirects the user to the custom "Forgot your password?" page instead of
	 * wp-login.php?action=lostpassword.
	 */
	public function redirect_to_custom_lostpassword() {
		if ('GET' == $_SERVER['REQUEST_METHOD']) {
			if (is_user_logged_in()) {
				$this->redirect_logged_in_user();
				exit;
			}
			wp_redirect($this->get_lostpassword_url());
			exit;
		}
	}

	/**
	 * Redirects to the custom password reset page, or the login page
	 * if there are errors.
	 */
	public function redirect_to_custom_resetpass() {
		if ('GET' == $_SERVER['REQUEST_METHOD']) {
			// Verify key / login combo
			$user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);
			if (!$user || is_wp_error($user)) {
				$redirect_url = $this->get_login_url();
				if ($user && $user->get_error_code() === 'expired_key') {
					$redirect_url = add_query_arg('login_error', 'expiredkey', $redirect_url);
				} else {
					$redirect_url = add_query_arg('login_error', 'invalidkey', $redirect_url);
				}
				wp_redirect($redirect_url);
				exit;
			}

			$redirect_url = $this->get_resetpass_url();
			$redirect_url = add_query_arg('login', esc_attr($_REQUEST['login']), $redirect_url);
			$redirect_url = add_query_arg('key', esc_attr($_REQUEST['key']), $redirect_url);

			wp_redirect($redirect_url);
			exit;
		}
	}

	/**
	 * Redirects the user to the correct page depending on whether or not admin
	 *
	 * @param string $redirect_to An optional redirect_to URL for admin users
	 */
	private function redirect_logged_in_user($redirect_to = null) {
		$user = wp_get_current_user();
		if (empty($redirect_to)) {
			$redirect_to = isset($_REQUEST['redirect_to']) && !empty($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : false;
		}
		if (user_can($user, 'manage_options')) {
			if ($redirect_to) {
				wp_safe_redirect($redirect_to);
			} else {
				wp_redirect(admin_url());
			}
		} else {
			if ($redirect_to) {
				wp_safe_redirect($redirect_to);
			} else {
				wp_redirect($this->get_logged_in_url($user));
			}
		}
		exit;
	}

	/**
	 * Returns the URL to which the user should be redirected after the (successful) login.
	 *
	 * @param string           $redirect_to           The redirect destination URL.
	 * @param string           $requested_redirect_to The requested redirect destination URL passed as a parameter.
	 * @param WP_User|WP_Error $user                  WP_User object if login was successful, WP_Error object otherwise.
	 *
	 * @return string Redirect URL
	 */
	public function redirect_after_login($redirect_to, $requested_redirect_to, $user) {
		$redirect_url = home_url();

		if (!isset($user->ID)) {
			return $redirect_url;
		}

		if (user_can($user, 'manage_options')) {
			// Use the redirect_to parameter if one is set, otherwise redirect to admin dashboard.
			if ($requested_redirect_to == '') {
				$redirect_url = admin_url();
			} else {
				$redirect_url = $requested_redirect_to;
			}
		} else {
			// Non-admin users always go to their account page after login
			$redirect_url = $this->get_logged_in_url($user);
			if (!empty($redirect_to)) {
				$redirect_url = $redirect_to;
			}
		}

		return wp_validate_redirect($redirect_url, home_url());
	}

	/**
	 * Redirect the user after authentication if there were any errors.
	 *
	 * @param Wp_User|Wp_Error  $user       The signed in user, or the errors that have occurred during login.
	 * @param string            $username   The user name used to log in.
	 * @param string            $password   The password used to log in.
	 *
	 * @return Wp_User|Wp_Error The logged in user, or error information if there were errors.
	 */
	function maybe_redirect_at_authenticate($user, $username, $password) {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (is_wp_error($user)) {
				$error_codes = join(',', $user->get_error_codes());

				$login_url = $this->get_login_url();
				$login_url = add_query_arg('login_error', $error_codes, $login_url);
				wp_redirect($login_url);
				exit;
			}
		}
		return $user;
	}

	/**
	 * Redirect to custom login page after user has been logged out
	 */
	public function redirect_after_logout() {
		$redirect_url = $this->get_login_url();
		$redirect_url = add_query_arg('logged_out', 'true', $redirect_url);
		wp_safe_redirect($redirect_url);
		exit;
	}

	/**
	 * Handles the registration of a new user.
	 *
	 * Used through the action hook "login_form_register" activated on wp-login.php
	 * when accessed through the registration action.
	 */
	public function do_register_user() {
		if ('POST' == $_SERVER['REQUEST_METHOD'])
		{
			$redirect_url = $this->get_register_url();

			if(!get_option('users_can_register'))
			{
				$redirect_url = add_query_arg('register-errors', 'closed', $redirect_url);
			}

			else if(empty($_POST['foobar']))
			{
				$email = sanitize_user($_POST['email']);
				$first_name = sanitize_text_field($_POST['first_name']);
				$last_name = sanitize_text_field($_POST['last_name']);
				$password = esc_attr($_POST['password']);
				$user_role = isset($_POST['user_role']) && in_array(strtolower($_POST['user_role']), array('hcp', 'non-hcp')) ? strtolower($_POST['user_role']) : 'non-hcp';
				$hunniepot = $_POST['hunniepot'];

				// Register user
				$user_id = $this->register_user($email, $password, $first_name, $last_name, $user_role, $hunniepot); // returns user id

				if (is_wp_error($user_id))
				{
					$errors = join(',', $user_id->get_error_codes());
					$redirect_url = add_query_arg('register-errors', $errors, $redirect_url);
				}

				else {
					do_action('wm_after_register', $_POST, $user_id);
					$redirect_url = $this->get_login_url();
					$redirect_url = add_query_arg('registered', $email, $redirect_url);

					// Create SS user
                    $this->patch_ss_trackingid(null, null, $user_id);

                    // Add user to Mailchimp newsletter list
                    $this->mc_put_contact(array(
                        "email_address" => $email,
                        "status_if_new" => "subscribed",
                        "status" => "subscribed",
                        "merge_fields" => array(
                            "FNAME" => $first_name,
                            "LNAME" => $last_name
                        )
                    ), false);
				}
			}

			wp_redirect($redirect_url);

			exit;
		}
	}

	public function do_update_user() {
		if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['wm_account_update']) && is_user_logged_in()) {
			$user_id = get_current_user_id();
			$redirect_url = $this->get_logged_in_url($user_id);
			if (empty($_POST['foobar'])) {
				$email = sanitize_email($_POST['email']);
				$password = esc_attr($_POST['password']);

				$result = $this->update_user($email, $password);
				if (is_wp_error($result)) {
					$errors = join(',', $result->get_error_codes());
					$redirect_url = add_query_arg('update-errors', $errors, $redirect_url);
				} else {
					do_action('wm_after_user_update', $_POST, $user_id, $result);
//				if(!empty($_POST['password'])){
//					wp_destroy_current_session();
//					wp_clear_auth_cookie();
//					$redirect_login_url = $this->get_login_url();
//					$redirect_url = add_query_arg('redirect_to', $redirect_url, $redirect_login_url);
//				}else{
					$redirect_url = add_query_arg('updated', 'yes', $redirect_url);
//				}
				}
			}
			wp_redirect($redirect_url);
			exit;
		}
	}

	/**
	 * Initiates password reset
	 */
	public function do_password_lost() {
		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			$errors = $this->send_retrieve_password_email($_POST);
			if (is_wp_error($errors)) {
				$redirect_url = $this->get_lostpassword_url();
				$redirect_url = add_query_arg('errors', join(',', $errors->get_error_codes()), $redirect_url);
			} else {
				$redirect_url = $this->get_login_url();
				$redirect_url = add_query_arg('checkemail', 'confirm', $redirect_url);
			}
			wp_redirect($redirect_url);
			exit;
		}
	}
	
	public function send_retrieve_password_email($post) {
		$errors = new WP_Error();

		if ( empty( $post['user_login'] ) || ! is_string( $post['user_login'] ) ) {
			$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or email address.'));
		} elseif ( strpos( $post['user_login'], '@' ) ) {
			$user_data = get_user_by( 'email', trim( wp_unslash( $post['user_login'] ) ) );
			if ( empty( $user_data ) )
				$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
		} else {
			$login = trim($post['user_login']);
			$user_data = get_user_by('login', $login);
		}

		if ( $errors->get_error_code() )
			return $errors;

		if ( !$user_data ) {
			$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.'));
			return $errors;
		}

		// Redefining user_login ensures we return the right case in the email.
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;
		$key = get_password_reset_key( $user_data );

		if ( is_wp_error( $key ) ) {
			return $key;
		}
		
		//**Send Welcome Email**//
		$email_variables = array();
		$adminBcc = get_option( 'admin_email' );
		$site_from = WMHelper::get_email_from_address();
		$email_variables['email'] = $user_email;
		$email_variables['first_name'] = $user_data->first_name;
		$email_variables['last_name'] = $user_data->last_name;
		$user_role = isset($user_data->roles) && in_array('hcp', $user_data->roles) ? 'hcp' : 'non-hcp';
		global $wp_roles;
		$email_variables['user_role_slug'] = $user_role;
		$email_variables['user_role'] = translate_user_role( $wp_roles->roles[ $user_role ]['name'] );
		$email_variables['reset_url'] = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' );

		$headers = "From: $site_from\r\n";
		if(!empty($adminBcc)){
			$headers .= "Bcc: $adminBcc\r\n"; //comment this to stop bcc to admin
		}
        $headers .= "cc: 'kmarker@standardprocess.com'\r\n"; //comment this to stop cc to kara
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		/* translators: Password reset email subject. %s: Site name */
		$subject = sprintf( __( '%s | Reset your Password' ), get_option( 'blogname' ) );
		$html_message = WMHelper::get_email_template('reset', WMHelper::get_email_variables('reset', $email_variables));
		if( !wp_mail( $user_email, $subject, $html_message, $headers ) ){ ////send to user & bcc to admin
			$errors->add('emailnotsent', __('Email not sent because of an issue with the server configuration.'));
			return $errors;
		}
		return true;
	}

	public function wm_send_reset_mails() {
		echo('You can <a href="'.admin_url( 'admin.php?page=wholistic-matters-settings' ).'">Click here</a> to stop the process(will be able to continue from where you left) & go back to settings.<br>(Test Mode - only sending emails to hardcoded emails & 10 at a time)<br><br>');
		echo 'Starting sending emails: <br><br>';
		$reset_meta_key = '_wm_reset_email_sent';
		//update_user_meta( 6, $reset_meta_key, '1' );
		//delete_user_meta(6, $reset_meta_key);
//		$users = get_users(array(
//			'role__in' => array('hcp','non-hcp'),
//            //'role_in' => array('administrator'),
//			'fields' => array('ID', 'user_email'),
//			'meta_query' => array(
//				array(
//					'key' => $reset_meta_key,
//					'value' => '1',
//					'compare' => 'NOT EXISTS'
//				),
//			),
//			'number' => 100,
//			'orderby' => 'ID', //TODO: for demo only
//			'order' => 'DESC' //TODO: for demo only
//		));

        $users = get_users(array(
            'include' => array(3831, 3842, 3832, 3330, 440),
            'fields' => array('ID', 'user_email')
        ));

		print_r($users);



		foreach ( $users as $user ) {
            //TODO: uncomment this to enable testing
			/*if( !in_array($user->user_email, array('dev@knowncreative.co')) ){
				echo 'Skipping Email Sending to: <b>'.$user->user_email.'</b> (Test Mode)<br>';
				update_user_meta( $user->ID, $reset_meta_key, '1' );
				continue; 
			}*/

			$data = array('user_login' => $user->user_email);

			$errors = $this->send_retrieve_password_email($data);

			if (is_wp_error($errors))
			{
				$message = $errors->get_error_message();
				echo 'Error sending email to: <b>'.$user->user_email.'</b> with error message: '.$message.'<br>';
				delete_user_meta($user->ID, $reset_meta_key);
			}
			else
            {
				echo 'Email sent to: <b>'. $user->user_email.'</b><br>';
				update_user_meta( $user->ID, $reset_meta_key, '1' );
			}
		}
		echo '<script type="text/javascript">setTimeout(function(){ location.reload(true); }, 10000);var wm_counter = 10; setInterval(function(){ if(wm_counter == 0){return;} wm_counter--; document.getElementById(\'wm_countdown\').innerHTML = wm_counter; }, 1000);</script>';
		die('<br>Finish Sending Reset Emails to current batch!<br><br>Next batch will be processed in <span id="wm_countdown">10</span>s');
	}
	/**
	 * Resets the user's password if the password reset form was submitted.
	 */
	public function do_password_reset() {
		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			$rp_key = $_REQUEST['rp_key'];
			$rp_login = $_REQUEST['rp_login'];

			$user = check_password_reset_key($rp_key, $rp_login);

			if (!$user || is_wp_error($user)) {
				$redirect_url = $this->get_login_url();
				if ($user && $user->get_error_code() === 'expired_key') {
					$redirect_url = add_query_arg('login_error', 'expiredkey', $redirect_url);
				} else {
					$redirect_url = add_query_arg('login_error', 'invalidkey', $redirect_url);
				}
				wp_redirect($redirect_url);
				exit;
			}

			if (isset($_POST['pass1'])) {
				if ($_POST['pass1'] != $_POST['pass2']) {
					// Passwords don't match
					$redirect_url = $this->get_resetpass_url();
					$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
					$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
					$redirect_url = add_query_arg('error', 'password_reset_mismatch', $redirect_url);

					wp_redirect($redirect_url);
					exit;
				}

				if (empty($_POST['pass1'])) {
					// Password is empty
					$redirect_url = $this->get_resetpass_url();

					$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
					$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
					$redirect_url = add_query_arg('error', 'password_reset_empty', $redirect_url);

					wp_redirect($redirect_url);
					exit;
				}
				
				$pass_validation = $this->validatePassword($_POST['pass1']);
				if ( is_wp_error($pass_validation) ) {
					$redirect_url = $this->get_resetpass_url();
					$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
					$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
					$redirect_url = add_query_arg('error', join(',', $pass_validation->get_error_codes()), $redirect_url);
					wp_redirect($redirect_url);
					exit;
				}

				// Parameter checks OK, reset password
				reset_password($user, $_POST['pass1']);
				
				if(isset($user->ID)) {
					$updated_user_id = $user->ID;
					$custom_meta_fields = WMHelper::get_custom_user_meta_fields();
					foreach ($custom_meta_fields as $meta_field_name => $meta_field) {
						if(!isset($post[$meta_field_name])){
							continue;
						}
						$meta_val = $_POST[$meta_field_name];
						$meta_val = is_array($meta_val) ? implode(',', $meta_val) : sanitize_text_field($meta_val);

						update_user_meta( $updated_user_id, $meta_field_name, $meta_val );
					}
				}
				
				$redirect_url = $this->get_login_url();
				$redirect_url = add_query_arg('password', 'changed', $redirect_url);
				wp_redirect($redirect_url);
			} else {
				echo "Invalid request.";
			}

			exit;
		}
	}

	private function update_user($email, $password) {
		$user_id = get_current_user_id();
		$errors = new WP_Error();
		// Email address is used as both username and email. It is also the only
		// parameter we need to validate
		if (!is_email($email)) {
			$errors->add('email', $this->get_error_message('email'));
			return $errors;
		}
		if (email_exists($email) != $user_id) {
			$errors->add('email_exists', $this->get_error_message('email_exists'));
			return $errors;
		}
		if(!empty($password)){ //validate only if new pass is entered
			$pass_validation = $this->validatePassword($password);
			if ( is_wp_error($pass_validation) ) {
				return $pass_validation;
			}
		}

		$user_data = array(
			'ID' => $user_id,
			'user_email' => $email,
			'user_pass' => $password,
		);
		$user = wp_update_user($user_data);
		return $user;
	}
	/**
	 * Validates and then completes the new user signup process if all went well.
	 *
	 * @param string $email         The new user's email address
	 * @param string $first_name    The new user's first name
	 * @param string $last_name     The new user's last name
	 *
	 * @return int|WP_Error         The id of the user that was created, or error if failed.
	 */
	private function register_user($email, $password, $first_name, $last_name, $user_role, $hunniepot) {
		global $wpdb;
		$errors = new WP_Error();

		// Email address is used as both username and email. It is also the only
		// parameter we need to validate
		if (!is_email($email)) {
			$errors->add('email', $this->get_error_message('email'));
			return $errors;
		}

		if (username_exists($email) || email_exists($email)) {
			$errors->add('email_exists', $this->get_error_message('email_exists'));
			return $errors;
		}
		
		$pass_validation = $this->validatePassword($password);
		if ( is_wp_error($pass_validation) ) {
			return $pass_validation;
		}

		if($hunniepot !== '')
        {
            return $errors;
        }

		$user_data = array(
			'user_login' => $email,
			'user_email' => $email,
			'user_pass' => $password,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'nickname' => $first_name,
			'role' => $user_role
		);

		$user_id = wp_insert_user($user_data);

		return $user_id;
	}
	
	private function validatePassword($Password) {
		$errors = new WP_Error();
		//#### Check it's greater than 6 Characters
		if (strlen($Password) < 8) {
			$errors->add('password_short', $this->get_error_message('password_short'));
			return $errors;
		}

		//#### Test password has uppercase and lowercase letters
		if (preg_match("/^(?=.*[a-z])(?=.*[A-Z]).+$/", $Password) !== 1) {
			$errors->add('password_case', $this->get_error_message('password_case'));
			return $errors;
		}

		//#### Test password has mix of letters and numbers
		if (preg_match("/^((?=.*[a-z])|(?=.*[A-Z]))(?=.*\d).+$/", $Password) !== 1) {
			$errors->add('password_alphanumeric', $this->get_error_message('password_alphanumeric'));
			return $errors;
		}

		//#### Password looks good
		return true;
	}

	/**
	 * Finds and returns a matching error message for the given error code.
	 *
	 * @param string $error_code    The error code to look up.
	 *
	 * @return string               An error message.
	 */
	private function get_error_message($error_code) {
		switch ($error_code) {
			case 'empty_username':
				return __('Email was blank', 'wholistic-matters');
			case 'empty_password':
				return __('Password was blank', 'wholistic-matters');

			case 'invalid_username':
				return __(
						"We don't have any users with that email address. Maybe you used a different one when signing up?", 'wholistic-matters'
				);

			case 'incorrect_password':
				$err = __(
						"The password you entered wasn't quite right. <a href='%s'>Did you forget your password</a>?", 'wholistic-matters'
				);
				return sprintf($err, wp_lostpassword_url());

            case 'hunniepot':
                return __("The hunniepot was filled");

			// Registration errors

			case 'existing_user_email':
				return __('Sorry, that email address is already used!', 'wholistic-matters');

			case 'email':
				return __('The email address you entered is not valid.', 'wholistic-matters');

			case 'email_exists':
				return __('An account exists with this email address.', 'wholistic-matters');

			case 'closed':
				return __('Registering new users is currently not allowed.', 'wholistic-matters');

			// Lost password

			case 'empty_username':
				return __('You need to enter your email address to continue.', 'wholistic-matters');

			case 'invalid_email':
			case 'invalidcombo':
				return __('There are no users registered with this email address.', 'wholistic-matters');

			// Reset password

			case 'expiredkey':
			case 'invalidkey':
				return __('The password reset link you used is not valid anymore.', 'wholistic-matters');

			case 'password_reset_mismatch':
				return __("The two passwords you entered don't match.", 'wholistic-matters');

			case 'password_reset_empty':
				return __("Sorry, we don't accept empty passwords.", 'wholistic-matters');
			case 'password_short':
				return __("Password is too short, please use at least 8 characters or more.", 'wholistic-matters');
			case 'password_case':
				return __("Password does not contain a mix of uppercase & lowercase characters.", 'wholistic-matters');
			case 'password_alphanumeric':
				return __("Password does not contain a mix of letters and numbers.", 'wholistic-matters');

			default:
				break;
		}
		return __('An unknown error occurred. Please try again later.', 'wholistic-matters');
	}

	/**
	 * A shortcode for rendering the login form.
	 *
	 * @param array $attributes Shortcode attributes
	 * @param string $content The text content for shortcode. Not used
	 *
	 * @return string The shortcode output
	 */
	public function render_login_form($attributes, $content = null) {
		$default_attributes = ['display' => '', 'show_title' => false];
		$attributes = shortcode_atts($default_attributes, $attributes);
		$is_popup = isset($attributes['display']) && in_array(trim(strtolower($attributes['display'])), array('popup', 'modal'));
		if (is_user_logged_in() && !$is_popup) {
			$account_page_url = $this->get_logged_in_url(wp_get_current_user());
			$redir = '<script>window.location.href = "' . $account_page_url . '";</script>';
			echo $redir;
			return sprintf(__('You are already signed in. %s', 'wholistic-matters'), wp_loginout('', false));
		}

		$attributes['redirect'] = '';
		if (isset($_REQUEST['redirect_to'])) {
			$attributes['redirect'] = wp_validate_redirect($_REQUEST['redirect_to'], $attributes['redirect']);
		}else{
			$attributes['redirect'] = $this->get_logged_in_url(wp_get_current_user()); //default to account page
		}

		//add error messages
		$errors = [];
		if (isset($_REQUEST['login_error'])) {
			$error_codes = explode(',', $_REQUEST['login_error']);
			if(count($error_codes) > 0){
				foreach ($error_codes as $code) {
					$errors[] = $this->get_error_message($code);
				}
			}
		}
		$attributes['errors'] = $errors;

		//add other various messages
		$attributes['registered'] = isset($_REQUEST['registered']);
		$attributes['lost_password_sent'] = isset($_REQUEST['checkemail']) && $_REQUEST['checkemail'] == 'confirm';
		$attributes['logged_out'] = isset($_REQUEST['logged_out']) && isset($_REQUEST['logged_out']) && $_REQUEST['logged_out'] == true;
		$attributes['password_updated'] = isset($_REQUEST['password']) && $_REQUEST['password'] == 'changed';

		return $this->get_template_html('login_form', $attributes);
	}

	/**
	 * A shortcode for rendering the new user registration form
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_register_form($attributes, $content = null) {
		$default_attributes = array('display' => '', 'show_title' => false);
		$attributes = shortcode_atts($default_attributes, $attributes);
		$is_popup = isset($attributes['display']) && in_array(trim(strtolower($attributes['display'])), array('popup', 'modal'));
		$attributes['errors'] = [];


		if (isset($_REQUEST['register-errors'])) {
			$error_codes = explode(',', $_REQUEST['register-errors']);
			foreach ($error_codes as $code) {
				$attributes['errors'][] = $this->get_error_message($code);
			}
		}

		if (is_user_logged_in() && !$is_popup) {
			$account_page_url = $this->get_logged_in_url(wp_get_current_user());
			$redir = '<script>window.location.href = "' . $account_page_url . '";</script>';
			echo $redir;
			return __('You are already signed in.', 'wholistic-matters');
		} elseif (!get_option('users_can_register')) {
			return __('Registering new users is currently not allowed.', 'wholistic-matters');
		} else {
			return $this->get_template_html('register_form', $attributes);
		}
	}

	/**
	 * A shortcode for rendering the form used to initiate the password reset.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_lostpassword_form($attributes, $content = null) {
		$default_attributes = ['show_title' => false];
		$attributes = shortcode_atts($default_attributes, $attributes);

		// Retrieve possible errors from request parameters
		$attributes['errors'] = [];
		if (isset($_REQUEST['errors'])) {
			$error_codes = explode(',', $_REQUEST['errors']);

			foreach ($error_codes as $error_code) {
				$attributes['errors'][] = $this->get_error_message($error_code);
			}
		}

		if (is_user_logged_in()) {
			$account_page_url = $this->get_logged_in_url(wp_get_current_user());
			$redir = '<script>window.location.href = "' . $account_page_url . '";</script>';
			echo $redir;
			return __('You are already signed in.', 'wholistic-matters');
		} else {
			return $this->get_template_html('lostpassword_form', $attributes);
		}
	}

	/**
	 * A shortcode for rendering the form used to reset a user's password.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_resetpass_form($attributes, $content = null) {
		// Parse shortcode attributes
		$default_attributes = array('show_title' => false);
		$attributes = shortcode_atts($default_attributes, $attributes);

		if (is_user_logged_in()) {
			$account_page_url = $this->get_logged_in_url(wp_get_current_user());
			$redir = '<script>window.location.href = "' . $account_page_url . '";</script>';
			echo $redir;
			return __('You are already signed in.', 'wholistic-matters');
		} else {
			if (isset($_REQUEST['login']) && isset($_REQUEST['key'])) {
				$attributes['login'] = $_REQUEST['login'];
				$attributes['key'] = $_REQUEST['key'];

				// Error messages
				$errors = array();
				if (isset($_REQUEST['error'])) {
					$error_codes = explode(',', $_REQUEST['error']);

					foreach ($error_codes as $code) {
						$errors [] = $this->get_error_message($code);
					}
				}
				$attributes['errors'] = $errors;

				return $this->get_template_html('resetpass_form', $attributes);
			} else {
				return '<br/><br/><p class="alert alert-danger">' . __('Invalid password reset link.', 'wholistic-matters') . '</p><br/><br/>';
			}
		}
	}

	/**
	 * A shortcode for rendering the user's account details.
	 *
	 * @param  array   $attributes  Shortcode attributes.
	 * @param  string  $content     The text content for shortcode. Not used.
	 *
	 * @return string  The shortcode output
	 */
	public function render_account_form($attributes, $content = null) {
		// Parse shortcode attributes
		$default_attributes = array('show_title' => false);
		$attributes = shortcode_atts($default_attributes, $attributes);

		if (!is_user_logged_in()) {
			return __('You must be logged in to view this page.', 'wholistic-matters');
		} else {
			if (isset($_REQUEST['update-errors'])) {
				$error_codes = explode(',', $_REQUEST['update-errors']);
				foreach ($error_codes as $code) {
					$attributes['errors'][] = $this->get_error_message($code);
				}
			}
			if (isset($_REQUEST['updated'])) {
				$attributes['updated'] = __('Profile updated successfully!', 'wholistic-matters');
			}
			//$this->do_update_user();
			$user = get_current_user_id();
			$attributes['user'] = $user;
			return $this->get_template_html('account_form', $attributes);
		}
	}

	public function get_template_html($template_name, $attributes = null) {
		if (!$attributes) {
			$attributes = array();
		}
		ob_start();

		/**
		 * Hook preceeding login template output.
		 *
		 * @since 1.0.0
		 *
		 */
		do_action('wm_before_' . $template_name);

		/**
		 * Filter to load custom template
		 *
		 * @since 1.0.0
		 *
		 * @param string  $template Path to template.
		 *
		 */
		require(apply_filters('wm_' . $template_name, 'partials/' . $template_name . '.php'));

		/**
		 * Hook following login template output.
		 *
		 * @since 1.0.0
		 *
		 */
		do_action('wm_after_' . $template_name);

		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	/**
	 * Get custom login url
	 *
	 * @return string Custom login URL
	 */
	public function get_login_url() {
		//TODO: Write settings page that takes pages and use their IDs
		/**
		 * Filter to get custom login url
		 *
		 * @since 1.0.0
		 *
		 */
		return apply_filters('wm_login_url', home_url('member-login'));
	}

	/**
	 * Get custom register url
	 *
	 * @return string Custom register URL
	 */
	public function get_register_url() {
		//TODO: Write settings page that takes pages and use their IDs
		/**
		 * Filter to get custom register url
		 *
		 * @since 1.0.0
		 *
		 */
		return apply_filters('wm_register_url', home_url('member-register'));
	}

	/**
	 * Get url for logged in users
	 *
	 * @return string The logged in redirect URL
	 */
	public function get_logged_in_url($user) {
		//TODO: Write settings page that takes pages and use their IDs
		/**
		 * Filter to get custom logged in url
		 *
		 * @since 1.0.0
		 *
		 */
		return apply_filters('wm_logged_in_url', home_url('member-account'), $user);
	}

	/**
	 * Get url for lostpassword
	 *
	 * @return string The lostpassword form URL
	 */
	public function get_lostpassword_url() {
		//TODO: Write settings page that takes pages and use their IDs
		/**
		 * Filter to get custom lostpassword url
		 *
		 * @since 1.0.0
		 *
		 */
		return apply_filters('wm_lostpassword_url', home_url('member-password-lost'));
	}

	/**
	 * Get url for resetpass
	 *
	 * @return string The resetpass form URL
	 */
	public function get_resetpass_url() {
		//TODO: Write settings page that takes pages and use their IDs
		/**
		 * Filter to get custom resetpass url
		 *
		 * @since 1.0.0
		 *
		 */
		return apply_filters('wm_resetpass_url', home_url('member-password-reset'));
	}

	/**
	 *
	 * @global type $wpdb
	 */
	public function find_category() {
		global $wpdb;

		check_ajax_referer('wm-bookmark-nonce', 'security');

		$category_table = W_M_BOOKMARK_CAT_TBL;
		$bookmark_table = W_M_BOOKMARK_TBL;
		$user_id = get_current_user_id(); //get the current logged in user id
		$object_id = intval($_POST['object_id']);
		$object_type = isset($_POST['object_type']) ? esc_attr($_POST['object_type']) : 'post'; //post, page, user, product, any thing custom

		$cats_by_user = $wpdb->get_results($wpdb->prepare("SELECT * FROM $category_table WHERE user_id = %d", array($user_id)), ARRAY_A);
		$post_in_cats_t = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT cat_id FROM $bookmark_table WHERE object_type = %s AND user_id = %d AND object_id = %d", array(
					$object_type,
					$user_id,
					$object_id
				)), ARRAY_A
		);

		//
		$post_in_cats = array();
		foreach ($post_in_cats_t as $cat) {
			$post_in_cats[] = $cat['cat_id'];
		}

		foreach ($cats_by_user as &$row) {
			if (in_array($row['id'], $post_in_cats)) {
				$row['incat'] = 1;
			} else {
				$row['incat'] = 0;
			}
		}


		$bookmark_total = WMHelper::getTotalBookmark($object_id);
		$bookmark_by_user = WMHelper::isBookmarkedUser($object_id);

		$message = array();
		//code 1 = category found
		//code 0 = category not found

		$cats_by_user = apply_filters('wm_bookmark_user_cats_found', $cats_by_user, $user_id, $object_id, $object_type);

		if ($cats_by_user != null) {

			$message['code'] = 1;

			$message['msg'] = esc_html__('Categories loaded', 'wholistic-matters');
			if ($cats_by_user !== false) {
				$message['cats'] = json_encode($cats_by_user);
			}
		} else {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Folder not found, create one.', 'wholistic-matters');
		}

		$message['bookmark_count'] = $bookmark_total;
		$message['bookmark_byuser'] = ($bookmark_by_user) ? 1 : 0;

		echo json_encode($message);

		wp_die();
	}

	public function render_bookmark_link($attr) {
		// Checking Available Parameter
		global $post;

		$attr = shortcode_atts(
				array(
			'object_id' => $post->ID,
			'object_type' => $post->post_type,
			'folder_id' => '',
			'bookmark_id' => '',
				), $attr
		);
		extract($attr);
		$bookmarked_class = 'bookmarked';
		if (!empty($attr['object_id']) && empty($attr['bookmark_id'])) {
			if (!WMHelper::isBookmarkedUser($attr['object_id'])) {
				$bookmarked_class = '';
			}
		}
        //echo '<a href="#." class="js_wm_to_bookmark wm_svg_dark_bookmark_btn ' . $bookmarked_class . '" data-folder_id="' . $attr['folder_id'] . '" data-object_id="' . $attr['object_id'] . '" data-bookmark_id="' . $attr['bookmark_id'] . '" data-object_type="' . $attr['object_type'] . '">' . file_get_contents(get_stylesheet_directory_uri() . '/images/Bookmark.svg') . '<span>' . __('Bookmark', 'wholistic-matters') . '</span></a>';

       echo '<a href="#." class="js_wm_to_bookmark wm_svg_dark_bookmark_btn ' . $bookmarked_class . '" data-folder_id="' . $attr['folder_id'] . '" data-object_id="' . $attr['object_id'] . '" data-bookmark_id="' . $attr['bookmark_id'] . '" data-object_type="' . $attr['object_type'] . '"><img src="' . get_stylesheet_directory_uri() . '/images/Bookmark.svg' . '" alt="Bookmark" /><span>' . __('Bookmark', 'wholistic-matters') . '</span></a>';
	}

	public function render_bookmark_btn($attr) {
		// Checking Available Parameter
		global $post;

		$attr = shortcode_atts(
				array(
			'object_id' => $post->ID,
			'object_type' => $post->post_type,
			'show_count' => 1,
			'extra_wrap_class' => '',
			'skip_ids' => '',
			'skip_roles' => '' //example 'administrator, editor, author, contributor, subscriber'
				), $attr
		);

		extract($attr);
		echo WM_show_bookmark_btn($object_id, $object_type, $show_count, $extra_wrap_class, $skip_ids, $skip_roles);
	}

	/**
	 * Bookmarked Posts attributes used for user edit panel
	 *
	 * @param $attr
	 */
	public function render_bookmarks($attr) {

		// Checking Available Parameter
		global $wpdb;
		$cbxwpbookmrak_table = W_M_BOOKMARK_TBL;


		$current_user_id = get_current_user_id();
		$attr = shortcode_atts(
				array(
			'userid' => $current_user_id,
			'order' => 'desc',
			'orderby' => 'id', // id, object_type
			'limit' => 10,
			'offset' => 0,
			'type' => '',
			'loadmore' => 1, //this is shortcode only params
			'catid' => 0, //category id
			'cattitle' => 1, //show category title,
			'catcount' => 1, //show item count per category
			'allowdelete' => 0
				), $attr
		);

		//if the url has cat id (cbxbmcatid get param) thenm use it or try it from shortcode
		$attr['catid'] = (isset($_GET['cbxbmcatid']) && $_GET['cbxbmcatid'] != null) ? intval($_GET['cbxbmcatid']) : intval($attr['catid']);



		//if the shortcode page linked with user id
		if (isset($_GET['userid']) && absint($_GET['userid']) > 0) {
			$attr['userid'] = absint($_GET['userid']);
		}

		if ($attr['userid'] == '' || $attr['userid'] == 0)
			$attr['userid'] = $current_user_id;


		extract($attr);


		$show_loadmore_html = '';
		$loadmore_busy_icon = '';

		$wpbm_ajax_icon = plugins_url('wholistic-matters/public/img/busy.gif');

		$cat_sql = '';
		if ($catid != 0) {
			$cat_sql = $wpdb->prepare(' AND cat_id = %d ', $catid);
		}

		if ($type == '') {
			$param = array($userid);
			$sql = "select count(*) as totalobject FROM $cbxwpbookmrak_table  WHERE user_id = %d $cat_sql group by object_id  ORDER BY $orderby $order";
		} else {
			$param = array($userid, $type);
			$sql = "select count(*) as totalobject FROM $cbxwpbookmrak_table  WHERE user_id = %d $cat_sql AND object_type=%s group by object_id   ORDER BY $orderby $order";
		}

		$num = $wpdb->get_results($wpdb->prepare($sql, $param));
		$total_page = ceil((int) count($num) / $limit);

		$extra_css_class = '';
		if ($attr['loadmore'] == 1 && $total_page > 1) {
			$extra_css_class = 'wmbookmark-mylist-sc-more';
			$offset += $limit;
			$loadmore_busy_icon = '<span data-busy="0" class="cbxwpbm_ajax_icon">' . esc_html__('Loading ...', 'wholistic-matters') . '<img src = "' . $wpbm_ajax_icon . '"/></span>';
			$show_loadmore_html = '<p class="cbxbookmark-more-wrap"><a href="#" class="cbxbookmark-more" data-cattitle="' . $cattitle . '" data-order="' . $order . '" data-orderby="' . $orderby . '"  data-userid="' . $userid . '" data-limit="' . $limit . '" data-offset="' . $offset . '" data-catid="' . $catid . '" data-totalpage="' . $total_page . '" data-currpage="1" data-allowdelete="' . intval($allowdelete) . '">' . esc_html__('Load More', 'wholistic-matters') . '</a>' . $loadmore_busy_icon . '</p>';
		}

		$category_title = '';



		if (intval($cattitle)) {

			if ($catid == 0) {
				$category_title = '<h4 class="wmbookmark-mylist-cattitle">' . esc_html__('All Bookmarks', 'wholistic-matters') . '</h4>';
			} else {

				$cat_info = WMHelper::getBookmarkCategoryById(intval($catid));

				$catcount_html = '';
				if ($catcount) {
					$cat_bookmark_count = WMHelper::getTotalBookmarkByCategory($catid);
					$catcount_html = '<i>(' . number_format_i18n($cat_bookmark_count) . ')</i>';
				}



				if (is_array($cat_info) && sizeof($cat_info) > 0) {
					$category_title = '<h4 class="wmbookmark-mylist-cattitle">' . $cat_info['cat_name'] . $catcount_html . '</h4>';
				}
			}
		}

		echo '<div class="wmbookmark-mylist-wrap">' . $category_title . '<ul class="wmbookmark-mylist wmbookmark-mylist-sc ' . $extra_css_class . '" >' . WM_bookmarks_html($attr) . '</ul>' . $show_loadmore_html . '</div>';
	}

	/**
	 * Bookmark Loadmore ajax hook
	 */
	public function bookmark_loadmore() {
		check_ajax_referer('wm-bookmark-nonce', 'security');
		$instance = array();
		$message = array();

		if (isset($_POST['limit']) && $_POST['limit'] != null) {
			$instance['limit'] = intval($_POST['limit']);
		}

		if (isset($_POST['offset']) && $_POST['offset'] != null) {
			$instance['offset'] = intval($_POST['offset']);
		}

		if (isset($_POST['catid']) && $_POST['catid'] != 0) {
			$instance['catid'] = intval($_POST['catid']);
		}

		if (isset($_POST['userid']) && $_POST['userid'] != 0) {
			$instance['userid'] = intval($_POST['userid']);
		}

		if (isset($_POST['order']) && $_POST['order'] != null) {
			$instance['order'] = esc_attr($_POST['order']);
		}

		if (isset($_POST['orderby']) && $_POST['orderby'] != null) {
			$instance['orderby'] = esc_attr($_POST['orderby']);
		}

		$instance['allowdelete'] = intval($_POST['allowdelete']);

		if (function_exists('WM_bookmarks_html') && WM_bookmarks_html($instance, false)) {
			$message['code'] = 1;
			$message['data'] = WM_bookmarks_html($instance, false);
		} else {
			$message['code'] = 0;
		}

		echo json_encode($message);
		wp_die();
	}

	/**
	 * Bookmark Load ajax hook
	 */
	public function load_my_bookmarks() {
		global $wpdb, $post;
		check_ajax_referer('wm-bookmark-nonce', 'security');
		$message = array();
		$posts_by_folder = array();
		if (is_user_logged_in()) {
			$folder_table = W_M_BOOKMARK_CAT_TBL;
			$bookmark_table = W_M_BOOKMARK_TBL;

			$user_id = get_current_user_id(); //get the current logged in user id
			$folder_search = isset($_POST['search']) && !empty($_POST['search']) ? sanitize_text_field($_POST['search']) : false;
			if ($folder_search) {
				$folders_sql = "SELECT * FROM $folder_table WHERE user_id = %d AND cat_name LIKE '%%%s%%' ORDER BY id ASC";
				$folders_by_user = $wpdb->get_results($wpdb->prepare($folders_sql, array($user_id, $folder_search)), ARRAY_A);
			} else {
				$folders_sql = "SELECT * FROM $folder_table WHERE user_id = %d ORDER BY id ASC";
				$folders_by_user = $wpdb->get_results($wpdb->prepare($folders_sql, array($user_id)), ARRAY_A);
			}
			$posts_in_folders = $wpdb->get_results($wpdb->prepare("SELECT * FROM $bookmark_table WHERE user_id = %d", array($user_id)), ARRAY_A);
			$quick_links_id = get_option('_wm_quick_save_folder_id');
			$quick_links_sql = "SELECT * FROM $folder_table WHERE user_id = 0 AND id = %d";
			$quick_links_folder = $wpdb->get_results($wpdb->prepare($quick_links_sql, $quick_links_id), ARRAY_A);
			$folders_by_user = array_merge($quick_links_folder, $folders_by_user);
			$meta_prefix = WM_META_PREFIX;
			foreach ($folders_by_user as $folder) {
				$folder_data = array();
				$folder_data['id'] = $folder['id'];
				$folder_data['folder_name'] = $folder['cat_name'];
				$folder_data['privacy'] = $folder['privacy'];
				$folder_data['bookmark_items'] = array();
				foreach ($posts_in_folders as $post_item) {
					if ($post_item['cat_id'] == $folder['id']) {
						$post = get_post($post_item['object_id']);
						setup_postdata($post);
						$post_taxs = get_post_taxonomies($post_item['object_id']);
						$post_tax = in_array('category', $post_taxs) ? 'category' : current($post_taxs);
						$read_time = WMHelper::get_post_read_time($post_item['object_id']);
						$is_premium = rwmb_meta( $meta_prefix.'is_premium' ); 
						switch (get_post_format()) {
							case 'link':
								$pType = 'document';
								$pTypeLabel = 'Download';
								break;
							case 'video':
								$read_time = WMHelper::get_post_watch_time($post_item['object_id']);
								$pType = 'video';
								$pTypeLabel = 'Video';
								break;
							case 'audio':
								$read_time = WMHelper::get_post_listen_time($post_item['object_id']);
								$pType = 'audio';
								$pTypeLabel = 'Podcast';
								break;
							default:
								$pType = 'simple';
								$pTypeLabel = 'Article';
								break;
						}
						$post_type_name = get_post_type($post_item['object_id']);
						if($post_type_name != 'post'){
							$pt_obj = get_post_type_object( $post_type_name );
							$pTypeLabel = $pt_obj->labels->singular_name;
							$read_time = "";
							if($post_type_name == 'wm_recipe'){
								$read_time = WMHelper::get_post_cook_time($post_item['object_id']);
							}
							if($post_type_name == 'wm_skill_video'){
								$read_time = WMHelper::get_post_watch_time($post_item['object_id']);
							}
						}
						$folder_data['bookmark_items'][] = array(
							'folder_id' => $post_item['cat_id'],
							'object_id' => $post_item['object_id'],
							'object_type' => $post_type_name,
							'bookmark_id' => $post_item['id'],
							'item_type' => $pType,
							'item_type_label' => $pTypeLabel,
							'item_image' => wp_get_attachment_image_url(get_post_thumbnail_id($post_item['object_id']), 'wm-featured'),
							'item_title' => get_the_title($post_item['object_id']),
							'item_link' => get_permalink($post_item['object_id']),
							'item_desc' => WM_get_post_excerpt(get_the_excerpt($post_item['object_id']), 150),
							'item_author' => get_the_author(),
							'item_date' => get_the_date('', $post_item['object_id']),
							'item_length' => $read_time,
							'is_premium' => $is_premium == 1 ? 'yes' : 'no',
						);
						wp_reset_postdata();
					}
				}
				$folder_data['count'] = count($folder_data['bookmark_items']);
				$posts_by_folder[] = $folder_data;
			}
			if (count($posts_by_folder) > 0) {
				$message['code'] = 1;
				$message['data'] = $posts_by_folder;
			} else {
				$message['code'] = 0;
			}
		} else {
			$message['code'] = -1;
		}

		echo json_encode($message);
		wp_die();
	}

	/**
	 * Shows any user's bookmarked categories using shortcode
	 *
	 * @param $attr
	 *
	 * @return string
	 */
	public function render_bookmark_folders($attr) {

		$attr = shortcode_atts(
				array(
			'userid' => get_current_user_id(),
			'order' => "asc", //possible values  title, id
			'orderby' => "cat_name",
			'privacy' => 2,
			'show_count' => 0,
			'display' => 0, //0 = list  1= dropdown,
			'allowedit' => 0
				), $attr
		);

		$output = (intval($attr['display']) == 0) ? '<ul class="cbxbookmark-category-list cbxbookmark-category-list-sc">' : '';
		$output .= WM_bookmark_folders_html($attr);
		$output .= (intval($attr['display']) == 0) ? '</ul>' : '';

		return $output;
	}

	public function render_bookmark_popular($attr) {
		$attr = shortcode_atts(
				array(
			'limit' => 10,
			'daytime' => 0, // 0 means all time,  any numeric values as days
			'orderby' => 'object_id',
			'order' => 'desc',
			'type' => '', //db col name object_type,  post types eg, post, page, any custom post type
			'show_count' => 0,
			'show_thumb' => 0,
			'ul_class' => 'product_list_widget',
			'li_class' => ''
				), $attr
		);

		$style_attr = array(
			'ul_class' => $attr['ul_class'],
			'li_class' => $attr['li_class']
		);

		return '<div class="cbxbmmostlisting cbxbmmostlisting-sc">' . WM_bookmark_popular_html($attr, $style_attr) . '</div>';
	}
	
	

	/**
	 *  Add new category
	 *
	 */
	public function add_category() {
		check_ajax_referer('wm-bookmark-nonce', 'security');
		global $wpdb;

		$category_table = W_M_BOOKMARK_CAT_TBL;
		$bookmark_table = W_M_BOOKMARK_TBL;

		$cat_name = sanitize_text_field($_POST['cat_name']);
		$cat_privacy = intval($_POST['privacy']);
		$object_id = intval($_POST['object_id']);
		$object_type = isset($_POST['object_type']) ? esc_attr($_POST['object_type']) : 'post'; //post, page, user, product, any thing custom

		$cat_id = 0;

		$user_id = get_current_user_id(); //get the current logged in user id

		$message = array();



		$sql = $wpdb->prepare("SELECT id FROM $category_table WHERE cat_name = %s and user_id = %d", $cat_name, $user_id);
		$duplicate = $wpdb->get_var($sql);


		if (intval($duplicate) > 0) {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Folder with same name already exists!', 'wholistic-matters');
		} else {

			$return = $wpdb->query($wpdb->prepare("INSERT INTO $category_table ( cat_name, user_id, privacy ) VALUES ( %s, %d, %d )", array(
						$cat_name,
						$user_id,
						$cat_privacy
			)));



			if ($return !== false) {

				$cat_id = $wpdb->insert_id; //get the newly created category id

				$cats_by_user = $wpdb->get_results($wpdb->prepare("SELECT * FROM $category_table WHERE user_id = %d", array($user_id)), ARRAY_A);

				$post_in_cats_t = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT cat_id FROM $bookmark_table WHERE object_type = %s AND  user_id = %d AND object_id = %d", array(
							$object_type,
							$user_id,
							$object_id
						)), ARRAY_A);


				$post_in_cats = array();
				foreach ($post_in_cats_t as $cat) {
					$post_in_cats[] = $cat['cat_id'];
				}

				foreach ($cats_by_user as &$row) {
					if (in_array($row['id'], $post_in_cats)) {
						$row['incat'] = 1;
					} else {
						$row['incat'] = 0;
					}
				}

				$message['code'] = 1;
				$message['msg'] = esc_html__('Folder created successfully!', 'wholistic-matters');
				if ($cats_by_user !== false) {
					$message['cats'] = json_encode($cats_by_user);
				} else {
					$message['cats'] = 0;
				}

				do_action('cbxbookmark_category_added', $cat_id, $user_id);
			} else {
				$message['code'] = 0;
				$message['msg'] = esc_html__('Folder creation failed or database query failed!', 'wholistic-matters');
			}
		}

		echo json_encode($message);

		wp_die();
	}

	/**
	 *  Add new category
	 *
	 */
	public function add_folder() {
		check_ajax_referer('wm-bookmark-nonce', 'security');
		global $wpdb;

		$category_table = W_M_BOOKMARK_CAT_TBL;
		$bookmark_table = W_M_BOOKMARK_TBL;

		$cat_name = sanitize_text_field($_POST['cat_name']);
		$cat_privacy = 0; //private

		$cat_id = 0;

		$user_id = get_current_user_id(); //get the current logged in user id

		$message = array();

		$sql = $wpdb->prepare("SELECT id FROM $category_table WHERE cat_name = %s and user_id = %d", $cat_name, $user_id);
		$message['sql'] = $sql;

		$duplicate = $wpdb->get_var($sql);

		if (intval($duplicate) > 0) {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Folder with same name already exists!', 'wholistic-matters');
		} else {
			$return = $wpdb->query($wpdb->prepare("INSERT INTO $category_table ( cat_name, user_id, privacy ) VALUES ( %s, %d, %d )", array(
						$cat_name,
						$user_id,
						$cat_privacy
			)));
			if ($return !== false) {
				$cat_id = $wpdb->insert_id; //get the newly created category id

				$cats_by_user = $wpdb->get_results($wpdb->prepare("SELECT * FROM $category_table WHERE user_id = %d", array($user_id)), ARRAY_A);

				$message['code'] = 1;
				$message['msg'] = esc_html__('Folder created successfully!', 'wholistic-matters');
				if ($cats_by_user !== false) {
					$message['folders_count'] = count($cats_by_user);
				} else {
					$message['folders_count'] = 0;
				}

				do_action('wm_bookmark_folder_added', $cat_id, $user_id);
			} else {
				$message['code'] = 0;
				$message['msg'] = esc_html__('Folder creation failed or database query failed!', 'wholistic-matters');
			}
		}
		echo json_encode($message);
		wp_die();
	}

	/**
	 *  Edit a Folder (From bookmark popup panel)
	 *
	 */
	public function edit_category() {
		check_ajax_referer('wm-bookmark-nonce', 'security');
		global $wpdb;
		$message = array();

		$category_table = W_M_BOOKMARK_CAT_TBL;
		$bookmark_table = W_M_BOOKMARK_TBL;

		$cat_name = sanitize_text_field($_POST['cat_name']);
		$cat_id = intval($_POST['cat_id']);
		$cat_privacy = intval($_POST['privacy']);
		$object_id = intval($_POST['object_id']);
		$object_type = isset($_POST['object_type']) ? esc_attr($_POST['object_type']) : 'post'; //post, page, user, product, any thing custom

		$user_id = get_current_user_id(); //get the current logged in user id

		$sql = $wpdb->prepare("SELECT id FROM $category_table WHERE cat_name = %s AND id != %d AND user_id = %d", $cat_name, $cat_id, $user_id);
		$duplicate = $wpdb->get_var($sql);


		if ($cat_name == '') {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Folder name can not be empty', 'wholistic-matters');
		} else if ($cat_id == 0) {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Folder id missing, are you cheating?', 'wholistic-matters');
		} else if (intval($duplicate) > 0) {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Another Folder with same name already exists!', 'wholistic-matters');
		} else {
			// Update Query
			$update = $wpdb->update(
					$category_table, array(
				'cat_name' => $cat_name, // string
				'privacy' => $cat_privacy // integer (number)
					), array(
				'id' => $cat_id,
				'user_id' => $user_id
					), array(
				'%s', // value1
				'%d' // value2
					), array(
				'%d',
				'%d'
					)
			);


			if ($update !== false) {

				$cats_by_user = $wpdb->get_results($wpdb->prepare("SELECT * FROM $category_table WHERE user_id = %d", array($user_id)), ARRAY_A);

				$post_in_cats_t = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT cat_id FROM $bookmark_table WHERE object_type = %s AND  user_id = %d AND object_id = %d", array(
							$object_type,
							$user_id,
							$object_id
						)), ARRAY_A);


				$post_in_cats = array();
				foreach ($post_in_cats_t as $cat) {
					$post_in_cats[] = $cat['cat_id'];
				}

				foreach ($cats_by_user as &$row) {
					if (in_array($row['id'], $post_in_cats)) {
						$row['incat'] = 1;
					} else {
						$row['incat'] = 0;
					}
				}

				$message['code'] = 1;
				$message['msg'] = esc_html__('Folder updated successfully!', 'wholistic-matters');
				if ($cats_by_user !== false) {
					$message['cats'] = json_encode($cats_by_user);
				} else {
					$message['cats'] = 0;
				}

				do_action('cbxbookmark_category_edit', $cat_id, $user_id, $cat_name);
			} else {
				$message['code'] = 0;
				$message['msg'] = esc_html__('Folder edit failed or database query failed!', 'wholistic-matters');
			}
		}

		echo json_encode($message);

		wp_die();
	}

	/**
	 *  Edit a folder
	 *
	 */
	public function edit_folder() {
		check_ajax_referer('wm-bookmark-nonce', 'security');
		global $wpdb;
		$message = array();

		$category_table = W_M_BOOKMARK_CAT_TBL;
		$bookmark_table = W_M_BOOKMARK_TBL;

		$cat_name = sanitize_text_field($_POST['cat_name']);
		$cat_id = intval($_POST['cat_id']);
		$cat_privacy = isset($_POST['privacy']) ? intval($_POST['privacy']) : 0;

		$user_id = get_current_user_id(); //get the current logged in user id

		$sql = $wpdb->prepare("SELECT id FROM $category_table WHERE cat_name = %s AND id != %d AND user_id = %d", $cat_name, $cat_id, $user_id);
		$duplicate = $wpdb->get_var($sql);


		if ($cat_name == '') {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Folder name can not be empty', 'wholistic-matters');
		} else if ($cat_id == 0) {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Folder id missing, are you cheating?', 'wholistic-matters');
		} else if (intval($duplicate) > 0) {
			$message['code'] = 0;
			$message['msg'] = esc_html__('Another Folder with same name already exists!', 'wholistic-matters');
		} else {
			// Update Query
			$update = $wpdb->update(
					$category_table, array(
				'cat_name' => $cat_name, // string
				'privacy' => $cat_privacy // integer (number)
					), array(
				'id' => $cat_id,
				'user_id' => $user_id
					), array(
				'%s', // value1
				'%d' // value2
					), array(
				'%d',
				'%d'
					)
			);


			if ($update !== false) {

				$cats_by_user = $wpdb->get_results($wpdb->prepare("SELECT * FROM $category_table WHERE user_id = %d", array($user_id)), ARRAY_A);

				$message['code'] = 1;
				$message['msg'] = esc_html__('Folder updated successfully!', 'wholistic-matters');
				if ($cats_by_user !== false) {
					$message['folders_count'] = count($cats_by_user);
				} else {
					$message['folders_count'] = 0;
				}

				do_action('wm_bookmark_category_edit', $cat_id, $user_id, $cat_name);
			} else {
				$message['code'] = 0;
				$message['msg'] = esc_html__('Folder edit failed or database query failed!', 'wholistic-matters');
			}
		}

		echo json_encode($message);

		wp_die();
	}

	/**
	 * Update Folder(fromt user edit panel)
	 *
	 */
	public function update_bookmark_category() {

		check_ajax_referer('wm-bookmark-nonce', 'security');
		if (isset($_POST)) {
			global $wpdb;

			$data = array();

			$cat_name = esc_attr($_POST['catname']);
			$cat_id = intval($_POST['id']);
			$privacy = intval($_POST['privacy']);
			$user_id = get_current_user_id();

			// Folder Table with database Prefix
			$bookmarkcategory_table = W_M_BOOKMARK_CAT_TBL;

			// Update Query
			$update = $wpdb->update(
					$bookmarkcategory_table, array(
				'cat_name' => $cat_name, // string
				'privacy' => $privacy // integer (number)
					), array(
				'id' => $cat_id,
				'user_id' => $user_id
					), array(
				'%s', // value1
				'%d' // value2
					), array(
				'%d',
				'%d'
					)
			);

			if ($update !== false) {

				do_action('cbxbookmark_category_edit', $cat_id, $user_id, $cat_name);

				$data['msg'] = esc_html__("Data Updated Successfully", "wholistic-matters");
				$data['flag'] = 1;
				$data['catname'] = $cat_name;
				$data['privacy'] = $privacy;
			} else {

				$data['msg'] = esc_html__("Update Failed", "wholistic-matters");
				$data['flag'] = 0;
			}

			echo $data = json_encode($data);
		}
		wp_die();
	}

	/**
	 *
	 * Delete Folder
	 */
	public function delete_bookmark_category() {
		check_ajax_referer('wm-bookmark-nonce', 'security');
		$message = array();

		global $wpdb;

		if (isset($_POST) && intval($_POST['id']) > 0) {
			$cat_id = intval($_POST['id']);

			$bookmarkcategory_table = W_M_BOOKMARK_CAT_TBL;
			$bookmark_table = W_M_BOOKMARK_TBL;

			$user_id = get_current_user_id();
//			$defaut_folder = get_user_meta($user_id, '_wm_quick_save_folder_id', true);
			$defaut_folder = get_option('_wm_quick_save_folder_id');
			if (!empty($defaut_folder) && $defaut_folder == $cat_id) {
				$delete_category = false;
				$message['msg'] = esc_html__("Can not delete the Default folder!", "wholistic-matters");
			} else {
				$delete_category = $wpdb->delete($bookmarkcategory_table, array('id' => $cat_id, 'user_id' => $user_id), array('%d', '%d'));
				if ($delete_category !== false) {
					//deleted successfully
					$message['msg'] = 0;

					do_action('wm_bookmark_category_deleted', $cat_id, $user_id);
					//now delete any bookmark entry for that category
					$delete_bookmark = $wpdb->delete($bookmark_table, array('cat_id' => $cat_id, 'user_id' => $user_id), array('%d', '%d'));

					if (isset($_POST['object_id'])) {
						$object_id = intval($_POST['object_id']);
						$object_type = isset($_POST['object_type']) ? esc_attr($_POST['object_type']) : 'post'; //post, page, user, product, any thing custom

						$cats_by_user = $wpdb->get_results($wpdb->prepare("SELECT * FROM $bookmarkcategory_table WHERE user_id = %d", array($user_id)), ARRAY_A);

						$post_in_cats_t = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT cat_id FROM $bookmark_table WHERE object_type = %s AND  user_id = %d AND object_id = %d", array(
									$object_type,
									$user_id,
									$object_id
								)), ARRAY_A);

						$post_in_cats = array();
						foreach ($post_in_cats_t as $cat) {
							$post_in_cats[] = $cat['cat_id'];
						}

						foreach ($cats_by_user as &$row) {
							if (in_array($row['id'], $post_in_cats)) {
								$row['incat'] = 1;
							} else {
								$row['incat'] = 0;
							}
						}
						$message['cats'] = json_encode($cats_by_user);
					}
				} else {
					$message['msg'] = 1;
				}
			}
		} else {
			$message['msg'] = esc_html__("No data available", "wholistic-matters");
		}
		echo json_encode($message);
		wp_die();
	}

	/**
	 * Add Bookmark to database     *
	 *
	 */
	public function add_bookmark() {
		global $wpdb;

		check_ajax_referer('wm-bookmark-nonce', 'security');

		$user_id = get_current_user_id();
		$cat_id = intval($_POST['cat_id']);
		$object_id = intval($_POST['object_id']);

		$object_type = isset($_POST['object_type']) ? esc_attr($_POST['object_type']) : 'post'; //post, page or any custom post and later any object type

		$bookmark_table = W_M_BOOKMARK_TBL;
		$duplicate = $wpdb->get_var($wpdb->prepare("SELECT id FROM $bookmark_table WHERE object_type = %s AND object_id = %d AND cat_id = %d AND user_id = %d", array(
					$object_type,
					$object_id,
					$cat_id,
					$user_id
		)));

		$message = array();


		if (intval($duplicate) > 0) {

			//already exists, so remove
			$return = $wpdb->query($wpdb->prepare("DELETE FROM $bookmark_table WHERE object_type = %s AND object_id = %d AND cat_id = %d AND user_id = %d", array(
						$object_type,
						$object_id,
						$cat_id,
						$user_id
			)));
			if ($return !== false) {
				$message['code'] = 1; //operation success
				$message['msg'] = esc_html__('Bookmark removed!', 'wholistic-matters');
				$message['operation'] = 0;
				$bookmark_id = $duplicate;

				do_action('wm_bookmark_bookmark_removed', $bookmark_id, $user_id, $object_id, $object_type);
			} else {
				$message['code'] = 0; //operation failed
				$message['msg'] = esc_html__('Bookmark remove failed!', 'wholistic-matters');
			}
		} else {
			//doesn't exists, so add
			$return = $wpdb->query($wpdb->prepare("INSERT INTO $bookmark_table ( object_id, object_type, cat_id, user_id ) VALUES ( %d,%s, %d, %d )", array(
						$object_id,
						$object_type,
						$cat_id,
						$user_id
			)));
			if ($return !== false) {
				$message['code'] = 1; //db operation success
				$message['msg'] = esc_html__('Bookmark added!', 'wholistic-matters');
				$message['operation'] = 1;

				$bookmark_id = $wpdb->insert_id;

				do_action('wm_bookmark_bookmark_added', $bookmark_id, $user_id, $object_id, $object_type);
			} else {
				$message['code'] = 0; //db operation failed
				$message['msg'] = esc_html__('Bookmark add failed', 'wholistic-matters');
			}
		}

		$bookmark_total = WMHelper::getTotalBookmarkByCategory($cat_id);
		$bookmark_by_user = WMHelper::isBookmarkedUser($object_id);
		$message['bookmark_count'] = $bookmark_total;
		$message['bookmark_byuser'] = ($bookmark_by_user) ? 1 : 0;

		echo json_encode($message);
		wp_die();
	}

	/**
	 * Delete bookmarked Post
	 */
	public function delete_bookmark_post() {

		global $wpdb;
		$data = array();

		check_ajax_referer('wm-bookmark-nonce', 'security');

		if (isset($_POST)) {


			$folder_id = intval($_POST['folder_id']);
			$bookmark_id = intval($_POST['bookmark_id']);
			$object_id = intval($_POST['object_id']);
			$object_type = isset($_POST['object_type']) ? esc_attr($_POST['object_type']) : 'post'; //post, page or any custom post and later any object type


			$bookmark_table = W_M_BOOKMARK_TBL;

			$user_id = get_current_user_id();
			if ($folder_id && $folder_id > 0) {
				$delete_bookmark = $wpdb->delete($bookmark_table, array(
					'id' => $bookmark_id,
					'cat_id' => $folder_id,
					'object_id' => $object_id,
					'user_id' => $user_id
						), array('%d', '%d'));
			} else {
				$delete_bookmark = $wpdb->delete($bookmark_table, array(
					'object_id' => $object_id,
					'user_id' => $user_id
						), array('%d', '%d'));
			}

			if ($delete_bookmark !== false) {
				$data['msg'] = 0;

				do_action('wm_bookmark_removed', $bookmark_id, $user_id, $object_id, $object_type);
			} else {

				$data['msg'] = 1;
			}
		} else {

			$data['msg'] = esc_html__("No data available", "wholistic-matters");
		}
		echo json_encode($data);
		wp_die();
	}

	/**
	 * Load more Archive posts
	 */
	public function load_more_archive() {
		check_ajax_referer('wm-bookmark-nonce', 'security');

		if (isset($_POST))
		{
			$pargs = array();

			if(isset($_POST['params']))
			{
				$params = $_POST['params'];
				$post_type = isset($params['post_type']) ? sanitize_text_field($params['post_type']) : 'post';
				$order = isset($params['order']) ? sanitize_text_field($params['order']) : 'ASC';
				$taxonomy = isset($params['taxonomy']) ? sanitize_text_field($params['taxonomy']) : false;
				$term_id = isset($params['term_id']) ? intval($params['term_id']) : false;
				
				if(isset($params['meta_query']) && is_array($params['meta_query'])){
					$pargs['meta_query'] = $params['meta_query'];
				}
				if(isset($params['term_query']) && is_array($params['term_query'])){
					$pargs['term_query'] = $params['term_query'];
				}
				if(isset($params['orderby'])){
					$pargs['orderby'] = sanitize_text_field($params['orderby']);
				}
				if(isset($params['meta_key'])){
					$pargs['meta_key'] = sanitize_text_field($params['meta_key']);
				}
				if(isset($params['meta_value'])){
					$pargs['meta_value'] = sanitize_text_field($params['meta_value']);
				}
			}else{
				$post_type = sanitize_text_field($_POST['post_type']);
				$order = sanitize_text_field($_POST['order']);
				$taxonomy = sanitize_text_field($_POST['taxonomy']);
				$term_id = intval($_POST['term_id']);
			}

			$page = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
			$type = strtolower(sanitize_text_field($_POST['type']));

			$terms = array();
			$tax_term = new stdClass;
			$tax_term->taxonomy = '';
			$tax_term->term_id = '';

			if (!empty($term_id) && !empty($term_id)) {
				$tax_term->taxonomy = $taxonomy;
				$tax_term->term_id = $term_id;
				$posts = WMHelper::getPosts($type, array('paged' => $page, 'post_type' => $post_type, 'order' => $order), $tax_term);
			} else if ((empty($term_id) || $term_id == 0) && (!empty($taxonomy) && $taxonomy == 'series')) {
				$terms = WMHelper::getSeries(array('paged' => $page, 'order' => $order));
			} else {
				$def_args = array('paged' => $page, 'post_type' => $post_type, 'order' => $order);
				$pargs = array_merge($def_args, $pargs);
				$posts = WMHelper::getPosts($type, $pargs);
			}

			$next_page = $page + 1;

			ob_start();

			if (isset($terms['terms'])) {
				if ($terms['total'] > 0):
					?>
					<?php foreach ($terms['terms'] as $series_term): ?>
						<?php WMHelper::get_template_part('template-parts/post/archive', 'series', array('series_term' => $series_term)); ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php if ($terms['pages'] > 1 && $next_page <= $terms['pages']): ?>      
					<div class="text-center margin-40 wm_loadmore_archive_all">
						<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-tax="series" data-load-tab="series" data-load-order="<?php echo esc_attr($order); ?>" data-load-page="<?php echo $next_page; ?>"><?php _e('Load More'); ?></a>
					</div>
				<?php
				endif;
			}else {
				if ($posts->have_posts()):
					while ($posts->have_posts()) : $posts->the_post();
						get_template_part('template-parts/post/archive', 'item');
					endwhile;
					wp_reset_postdata();
				endif;
				if ($posts->max_num_pages > 1 && $next_page <= $posts->max_num_pages):
					?>      
					<div class="text-center margin-40 wm_loadmore_archive_all">
						<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_archive" data-load-term="<?php echo $tax_term->term_id; ?>" data-load-tax="<?php echo esc_attr($tax_term->taxonomy); ?>" data-load-tab="<?php echo esc_attr(strtolower($type)); ?>" data-load-order="<?php echo esc_attr($order); ?>" data-load-page="<?php echo $next_page; ?>" data-params="<?php echo htmlspecialchars(json_encode($params), ENT_QUOTES, 'UTF-8'); ?>"><?php _e('Load More'); ?></a>
					</div>
				<?php
				endif;
			}

			$contents = ob_get_contents();
			ob_end_clean();
		}
		echo ($contents);
		wp_die();
	}

	/**
	 * Load more Herbs posts
	 */
	public function process_load_herbs() {
		check_ajax_referer('wm-bookmark-nonce', 'security');

		if (isset($_REQUEST)) {
			$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
			$keyword = isset($_REQUEST['keyword']) ? sanitize_text_field($_REQUEST['keyword']) : '';

			
			$pArgs = array('paged' => $page, 'post_type' => 'wm_herb','orderby' => 'title','order' => 'ASC'); 
			$pArgs['posts_per_page'] = apply_filters('wm_herb_posts_per_page', 18);
			
			if ( !empty($keyword) ) {
				$tempArgs = $pArgs;
				$pArgs['post__in'] = array();
				///search in meta
				$tempArgs['meta_query'] = array(
					'relation' => 'OR',
					array(
						'key' => WM_META_PREFIX.'herb_family',
						'value' => $keyword,
						'compare' => 'LIKE'
					),

					array(
						'key' => WM_META_PREFIX.'herb_use',
						'value' => $keyword,
						'compare' => 'LIKE'
					)
				);
				$posts = WMHelper::getAllPosts($tempArgs);
				$meta_q_ids = wp_list_pluck( $posts->posts, 'ID' );
				$pArgs['post__in'] =  array_merge($pArgs['post__in'], $meta_q_ids); //post found matching meta
				
				//search by keyword
				unset($tempArgs['meta_query']);
				$tempArgs['s'] = $keyword;
				$posts = WMHelper::getAllPosts($tempArgs);
				$search_q_ids = wp_list_pluck( $posts->posts, 'ID' );
				$pArgs['post__in'] =  array_merge($pArgs['post__in'], $search_q_ids); //posts found with name
				$pArgs['post__in'] = count($pArgs['post__in']) > 0 ? array_unique($pArgs['post__in']) : array(0); //array(0) i.e nothing found
			}
			//print_r($pArgs);
			$posts = WMHelper::getAllPosts($pArgs);
			
			$next_page = $page + 1;

			$contents = array();
			$ind = 0;
			if ($posts->have_posts()):
				while ($posts->have_posts()) : $posts->the_post();
					ob_start();
					get_template_part('template-parts/post/archive', 'herb');
					$contents[$ind]['html'] = ob_get_clean();
					$ind++;
				endwhile;
				wp_reset_postdata();
			else:
				ob_start();
				?>
				<div class="col-sm-12">
					<div class="herbal-box text-center" style="padding: 1rem;">
						<h5><?php _e('No Herb Found'); ?></h5>
						<p><?php _e('Please try a different keyword.'); ?></p>
					</div>
				</div>
				<?php
				$contents[0]['html'] = ob_get_clean();
			endif;
			ob_start();
			if ($posts->max_num_pages > 1 && $next_page <= $posts->max_num_pages):
				?>      
				<div class="text-center margin-40 wm_loadmore_herbs" style="clear: both;width: 100%;">
					<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_herbs_link js_wm_loadmore_herbs" data-keyword="<?php echo esc_attr($keyword); ?>" data-page="<?php echo $next_page; ?>" ><?php _e('Load More'); ?></a>
				</div>
			<?php
			endif;
			$load_link = ob_get_clean();
			$response = array('load_link' => $load_link, 'data' => $contents, 'total' => $posts->found_posts);

		}
		echo json_encode($response);
		wp_die();
	}

	/**
	 * Load more Search posts
	 */
	public function load_more_search() {
		check_ajax_referer('wm-bookmark-nonce', 'security');

		if (isset($_REQUEST)) {
			$params = $_REQUEST['params'];
			$page = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 1;
			$type = isset($_REQUEST['type']) ? strtolower(sanitize_text_field($_REQUEST['type'])) : 'all';

			
			$tax_query = array();
			$pArgs = array('paged' => $page, 'is_wm_search' => true); //is_wm_search used to fire same pre_get_posts hook that is used for main search
//			$pArgs['paged'] = 1;
			$pArgs['posts_per_page'] = apply_filters('wm_search_posts_per_page', 50);
			if (isset($params['post_type']) && count($params['post_type']) > 0) {
				$pArgs['post_type'] = $params['post_type'];
			}
			
			if ( isset($params['s']) ) {
				$pArgs['s'] = sanitize_text_field($params['s']);
			}
			
			if( in_array('post', $params['post_type']) ){
				
				if (isset($params['cat']) && count($params['cat']) > 0) {
					//$pArgs['category_name'] = implode(',', $params['cat']);
					$tax_query[] = array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $params['cat'],
					);
				}
				
				if (isset($params['spotlight-topic']) && count($params['spotlight-topic']) > 0) {
					$tax_query[] = array(
						'taxonomy' => 'spotlight-topic',
						'field' => 'slug',
						'terms' => $params['spotlight-topic'],
					);
				}
				
				if (isset($params['media']) && count($params['media']) > 0) {
					$sel_p_formats = $params['media'];
					$tax_query[] = WMHelper::getPostFormatQuery($sel_p_formats);
				}
			}
			if (count($tax_query) > 1) {
				$tax_query['relation'] = 'OR'; // or  Docs: Logic - [Search term] within [Cardio-Metabolic Control] OR [Digestive Health] OR {Spotlight Topic] OR is an [Article] OR [Video]
			}
			
			
			if (count($tax_query) > 0) {
				$pArgs['tax_query'] = $tax_query;
			}
			
			$tempArgs = $pArgs;
			$pArgs['post__in'] = array();
			if( in_array('wm_recipe', $params['post_type']) || in_array('wm_skill_video', $params['post_type']) ){
				$nonPArgs = $tempArgs;
				if(isset($nonPArgs['tax_query']))
					unset($nonPArgs['tax_query']);
				$nonPArgs['post_type'] = array('wm_recipe', 'wm_skill_video');
				$posts = WMHelper::getAllPosts($nonPArgs);
				$non_post_ids = wp_list_pluck( $posts->posts, 'ID' );
				$pArgs['post__in'] =  array_merge($pArgs['post__in'], $non_post_ids);
			}
			
			if( in_array('post', $params['post_type']) ){
				$postArgs = $tempArgs;
				$postArgs['post_type'] = array('post');
				$posts = WMHelper::getAllPosts($postArgs);
				$posts_ids = wp_list_pluck( $posts->posts, 'ID' );
				$pArgs['post__in'] =  array_merge($pArgs['post__in'], $posts_ids);
			}
			
			if( !empty($params['s']) && (in_array('post', $params['post_type']) || in_array('wm_skill_video', $params['post_type'])) ){
				$tagsArgs = $tempArgs;
				unset($tagsArgs['s']);
				unset($tagsArgs['tax_query']);
				$tagsArgs['post_type'] = array('post', 'wm_skill_video');
				//  load the terms using LIKE
				$termSlugs = get_terms(array(
					'taxonomy' => 'post_tag',
					'name__like' => sanitize_text_field($params['s']),
					'fields' => 'slugs'
				));
				if(count($termSlugs)){
					$tagsArgs['tax_query'] = array(
						array(
							'taxonomy' => 'post_tag',
							'field' => 'slug',
							'terms' => $termSlugs,
						)
					);
					$posts = WMHelper::getAllPosts($tagsArgs);
					$tag_post_ids = wp_list_pluck( $posts->posts, 'ID' );
					$pArgs['post__in'] =  array_merge($pArgs['post__in'], $tag_post_ids);
				}
			}
			
			$pArgs['post__in'] = count($pArgs['post__in']) > 0 ? array_unique($pArgs['post__in']) : array(0); //array(0) i.e nothing found
			unset($pArgs['s']);
			unset($pArgs['tax_query']);
			$posts = WMHelper::getAllPosts($pArgs);
			//print_r($pArgs);
			
			$next_page = $page + 1;

			$contents = array();
			$ind = 0;
			if ($posts->have_posts()):
				while ($posts->have_posts()) : $posts->the_post();
					$key = '';
					if( get_post_type() == 'post' ){
						if(!has_post_format(array('link', 'audio', 'video'), get_the_ID())){
							$key = 'article';
						}else if(has_post_format(array('audio'), get_the_ID())){
							$key = 'audio';
						}else if(has_post_format(array('video'), get_the_ID())){
							$key = 'video';
						}else if(has_post_format(array('link'), get_the_ID())){
							$key = 'link';
						}
					}else{
						$key = get_post_type();
					}
					ob_start();
					get_template_part('template-parts/post/archive', 'item');
					$contents[$ind]['html'] = ob_get_clean();
					$contents[$ind]['type'] = $key;
					$ind++;
				endwhile;
				wp_reset_postdata();
			endif;
			ob_start();
			if ($posts->max_num_pages > 1 && $next_page <= $posts->max_num_pages):
				?>      
				<div class="text-center margin-40 wm_loadmore_archive_all">
					<a href="#." class="btn btn-theme-fix btn-gray wm_loadmore_archive_link js_wm_loadmore_search" data-load-tab="<?php echo esc_attr(strtolower($type)); ?>" data-load-page="<?php echo $next_page; ?>" data-params="<?php echo htmlspecialchars(json_encode($_REQUEST['wm_s_query']), ENT_QUOTES, 'UTF-8'); ?>"><?php _e('Load More'); ?></a>
				</div>
			<?php
			endif;
			$load_link = ob_get_clean();
			$response = array('load_link' => $load_link, 'data' => $contents, 'total' => $posts->found_posts);

		}
		echo json_encode($response);
		wp_die();
	}

	public function search_query_vars($query_vars) {
		$query_vars[] = 'is_wm_search';
		return $query_vars;
	}
	
	/**
	* Join posts and postmeta tables
	*/
	public function search_join($join, $query) {
		global $wpdb;
		if ( !is_admin() && (( is_main_query() && is_search() ) || isset( $query->query_vars['is_wm_search'] )) ) {    
			$join .=' LEFT JOIN `'.$wpdb->postmeta. '` ON `'. $wpdb->posts . '`.ID = `' . $wpdb->postmeta . '`.post_id ';
//			$join .= " LEFT JOIN
//                (
//                    `{$wpdb->term_relationships}`
//                    INNER JOIN
//                        `{$wpdb->term_taxonomy}` ON `{$wpdb->term_taxonomy}`.term_taxonomy_id = `{$wpdb->term_relationships}`.term_taxonomy_id
//                    INNER JOIN
//                        `{$wpdb->terms}` ON `{$wpdb->terms}`.term_id = `{$wpdb->term_taxonomy}`.term_id
//                )
//                ON `{$wpdb->posts}`.ID = `{$wpdb->term_relationships}`.object_id ";

		}
		return $join;
	}
	/**
	* Modify the search query with posts_where
	*/
	//https://wordpress.stackexchange.com/questions/170140/wp-query-with-two-post-types-but-requiring-category-on-only-one-of-those-post-t
	public function search_where($where, $query) {
		global $wpdb;
		if ( !is_admin() && (( is_main_query() && is_search() ) || isset( $query->query_vars['is_wm_search'] )) ) {
//			$where = preg_replace(
//				"/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
//				"(".$wpdb->posts.".post_title LIKE $1) OR (`{$wpdb->postmeta}`.meta_value LIKE $1)  OR (`{$wpdb->term_taxonomy}`.taxonomy IN( 'post_tag' ) AND `{$wpdb->terms}`.name LIKE $1)", $where );
			$where = preg_replace(
				"/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
				"(".$wpdb->posts.".post_title LIKE $1) OR (`{$wpdb->postmeta}`.meta_value LIKE $1)", $where );

		}
		return $where;
	}
	/**
	* Prevent duplicates
	*/
	public function search_groupby($groupby, $query) {
		global $wpdb;
        if ( !is_admin() && (( is_main_query() && is_search() ) || isset( $query->query_vars['is_wm_search'] )) ) {
            $groupby = "`{$wpdb->posts}`.ID";
        }
        return $groupby;
	}
	/**
	* Prevent duplicates
	*/
	public function search_distinct($where) {
		global $wpdb;
		if ( !is_admin() && (( is_main_query() && is_search() ) || isset( $query->query_vars['is_wm_search'] )) ) {
			return "DISTINCT";
		}
		return $where;
	}
	
	public function search_query($query) {
		if (!is_admin() && $query->is_main_query() && $query->is_search()) {
			$sel_p_types = isset($_REQUEST['post_type']) && is_array($_REQUEST['post_type']) ? array_map('sanitize_text_field', $_REQUEST['post_type']) : array();
			$sel_p_formats = isset($_REQUEST['media']) && is_array($_REQUEST['media']) ? array_map('sanitize_text_field', $_REQUEST['media']) : array();
			$sel_key_topics = isset($_REQUEST['key_topic']) && is_array($_REQUEST['key_topic']) ? array_map('sanitize_text_field', $_REQUEST['key_topic']) : array();
			$sel_spotlight_topics = isset($_REQUEST['spotlight_topic']) && is_array($_REQUEST['spotlight_topic']) ? array_map('sanitize_text_field', $_REQUEST['spotlight_topic']) : array();
			//$p_types = get_query_var('post_type');
			//$p_format = get_query_var('post_format');
			if (count($sel_p_formats) > 0 && !in_array('post', $sel_p_types)) {
				$sel_p_types[] = 'post';
			} else if (empty($sel_p_types)) { //if no post type selected...then search in all possible post types
				$sel_p_types[] = 'post';
				//$sel_p_types[] = 'wm_event';
				$sel_p_types[] = 'wm_recipe';
				$sel_p_types[] = 'wm_skill_video';
			}
			//unset( $query->query['post_type'] );
			$query->query['post_type'] = $sel_p_types;
			$query->set('post_type', $sel_p_types);
			//unset( $query->query['post_format'] );
			$tax_query = array();
			
			if (in_array('post', $sel_p_types)) {
				if (count($sel_key_topics) > 0) {
					//$pArgs['category_name'] = implode(',', $params['cat']);
					$tax_query[] = array(
						'taxonomy' => 'category',
						'field' => 'slug',
						'terms' => $sel_key_topics,
					);
				}
				
				if (count($sel_spotlight_topics) > 0) {
					$tax_query[] = array(
						'taxonomy' => 'spotlight-topic',
						'field' => 'slug',
						'terms' => $sel_spotlight_topics,
					);
				}
				
				if (count($sel_p_formats) > 0) {
					$tax_query[] = WMHelper::getPostFormatQuery($sel_p_formats);
				}
				
				if (count($tax_query) > 1) {
					$tax_query['relation'] = 'OR'; // or  Docs: Logic - [Search term] within [Cardio-Metabolic Control] OR [Digestive Health] OR {Spotlight Topic] OR is an [Article] OR [Video]
				}

				if (count($tax_query) > 0) {
					$query->set('tax_query', $tax_query);
				}
			}
			if (count($sel_p_types) == 1 && !in_array('post', $sel_p_types)) {
				unset($query->query['cat']);
				unset($query->query_vars['cat']);
				unset($query->query['spotlight-topic']);
				unset($query->query_vars['spotlight-topic']);
			}
			$query->set('posts_per_page', 1); // we are using custom ajax search results
			//print_r($tax_query);
			$search_query = array();
			$search_query['s'] = $query->query['s'];
			$search_query['post_type'] = $sel_p_types;
			$search_query['cat'] = $sel_key_topics;
			$search_query['spotlight-topic'] = $sel_spotlight_topics;
			$search_query['media'] = $sel_p_formats;
			$_REQUEST['wm_s_query'] = $search_query; //for ajax pagination
			
		}
		if( isset( $query->query_vars['is_wm_search'] ) && isset($_POST['params'])){
			$params = $_POST['params'];
			$_REQUEST['wm_s_query'] = $params; //for ajax pagination
		}
	}
	
	public function render_wm_like_cb($attr) {
		$title = '';
		if(isset($attr['title'])){
			$title = $attr['title'];
		}
		return WMHelper::get_simple_likes_button( get_the_ID(), $title );
	}
	
	public function process_simple_like() {
		// Security
		$nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;
		if ( !wp_verify_nonce( $nonce, 'simple-likes-nonce' ) ) {
			exit( __( 'Not permitted', 'wholistic-matters' ) );
		}
		// Base variables
		$post_id = ( isset( $_REQUEST['post_id'] ) && is_numeric( $_REQUEST['post_id'] ) ) ? $_REQUEST['post_id'] : '';
		$sl_action = ( isset( $_REQUEST['sl_action'] ) && in_array( $_REQUEST['sl_action'], array('like','dislike') ) ) ? $_REQUEST['sl_action'] : '';
		if ( $post_id != '' && $sl_action != '' ) {
			$like_count = get_post_meta( $post_id, "_wm_post_like_count", true );
			$like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
			$dislike_count = get_post_meta( $post_id, "_wm_post_dislike_count", true );
			$dislike_count = ( isset( $dislike_count ) && is_numeric( $dislike_count ) ) ? $dislike_count : 0;
			
			if(!WMHelper::already_liked($post_id)){ //record interaction 
				if ( is_user_logged_in() ) { // user is logged in
					$user_id = get_current_user_id();
					$post_users = WMHelper::post_user_likes( $user_id, $post_id );
					if ( $post_users ) {
						update_post_meta( $post_id, '_wm_post_like_user_ids', $post_users );
					}
				} else { // user is anonymous
					$user_ip = WMHelper::sl_get_ip();
					$post_users = WMHelper::post_ip_likes( $user_ip, $post_id );
					// Update Post
					if ( $post_users ) {
						update_post_meta( $post_id, "_wm_post_like_user_IP", $post_users );
					}
				}
				if($sl_action == 'like'){
					$like_count += 1;
				}else if($sl_action == 'dislike'){
					$dislike_count += 1;
				}

				update_post_meta( $post_id, "_wm_post_like_count", $like_count );
				update_post_meta( $post_id, "_wm_post_dislike_count", $dislike_count );
				update_post_meta( $post_id, "_wm_post_like_modified", date( 'Y-m-d H:i:s' ) );

				$response['msg'] = '<span class="sl-count">'.__('Thank you for your feedback!').'</span>';
				$response['code'] = 1;
			}else{
				$response['msg'] = '<span class="sl-count">'.__('Feedback already recieved for this post!').'</span>';
				$response['code'] = 0;
			}
			wp_send_json( $response );
		}
    }

    public function process_contact_form() {
        // Security
        check_ajax_referer('wm-bookmark-nonce', 'security');

        $response = array();
        $email = ( isset( $_REQUEST['email'] ) && !empty($_REQUEST['email']) ) ? sanitize_email($_REQUEST['email']) : false;
        $u_subject = ( isset( $_REQUEST['subject'] ) && !empty($_REQUEST['subject']) ) ? sanitize_text_field($_REQUEST['subject']) : '';
        $contactName = ( isset( $_REQUEST['contactName'] ) && !empty($_REQUEST['contactName']) ) ? sanitize_text_field($_REQUEST['contactName']) : '';
        $message = ( isset( $_REQUEST['message'] ) && !empty($_REQUEST['message']) ) ? sanitize_textarea_field($_REQUEST['message']) : '';
        if($email === false){
                $response['msg'] = __('Invalid Email');
                $response['success'] = 0;
                wp_send_json( $response );
        }

        $honeypot = $_REQUEST['wm_message2'];
        if ( $honeypot != "" ) {
			$response['msg'] = __('Not Allowed');
			$response['success'] = 0;
			wp_send_json( $response );
        }

        $adminBcc = get_option( 'admin_email' );
        $from = WMHelper::get_email_from_address();
        //$user_subject = !empty($u_subject) ? $u_subject.' | ' : '';
        //$subject = __('New Contact Form submission') . ' | ' . $user_subject . get_bloginfo('name');
        $headers = "From: $from\r\n";
		if(!empty($adminBcc)){
			$headers .= "Bcc: $adminBcc\r\n"; //comment this to stop bcc to admin
		}
        $headers .= "cc: 'kmarker@standardprocess.com'\r\n"; //comment this to stop cc to kara
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";
        //$headers .= "Reply-To: $email\r\n";
        //$headers.= "X-Priority: 1\r\n";
		$subject = __('Thank you for contacting us') . ' | ' . get_bloginfo('name');
		$variables = array(
			"name"=> $contactName,
			"email"=> $email,
			"subject"=> $u_subject,
			"message"=> $message,
			);
		$html_message = WMHelper::get_email_template('contact', WMHelper::get_email_variables('contact', $variables));
		
        if ( wp_mail( $email, $subject, $html_message, $headers ) ) { ////send to user & bcc to admin
			$response['msg'] = __('Thank you for contacting us. We will be in touch with you shortly regarding your inquiry.');
			$response['success'] = 1;
        } else {
            $response['msg'] = __('Error while sending email!');
            $response['success'] = 0;
        }
        wp_send_json( $response );
    }
	
    public function wp_mail_from($original_email_address) {
        return WMHelper::get_email_from_address('email');
    }
    public function wp_mail_from_name($original_email_from) {
        return WMHelper::get_email_from_address('name');
    }

    /*
     * MAILCHIMP API
     *
     */

    public function mc_put_contact($data = null, $ajax = true)
    {
        if($ajax)
        {
            check_ajax_referer('wm-bookmark-nonce', 'security');

            $data = $_POST['data'];
            $email = $_POST['email'];
        }
        else
        {
            $email = $data['email_address'];
        }

        $method = 'PUT';
        $url = 'https://us16.api.mailchimp.com/3.0/lists/3fb54e83d5/members/' . md5($email);
        $apiKey = getenv('MC_API_KEY');
        $userpwstr = "devon:" . $apiKey;

        $data_string = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSLVERSION, 4);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        curl_setopt($ch, CURLOPT_USERPWD, $userpwstr);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        $result = curl_exec($ch);
        curl_close($ch);

        if($ajax)
        {
            echo json_encode($result);

            die();
        }
    }

}
