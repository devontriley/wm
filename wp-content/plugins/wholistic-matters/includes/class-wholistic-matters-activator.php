<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.example.com
 * @since      1.0.0
 *
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/includes
 * @author     WholisticMatters <info@example.com>
 */
class Wholistic_Matters_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
            global $wpdb;
            $charset_collate = $wpdb->get_charset_collate();
            // charset_collate Defination

            $bookmark = W_M_BOOKMARK_TBL;
            $cattable = W_M_BOOKMARK_CAT_TBL;


            //  bookmark Table Created

            $sql = "CREATE TABLE $bookmark (
          `id` mediumint(9) NOT NULL AUTO_INCREMENT,
          `object_id` int(11) NOT NULL,
          `object_type` varchar(60) NOT NULL DEFAULT 'post',
          `cat_id` int(11) NOT NULL,
          `user_id` int(11) NOT NULL,
          `created_date`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `modyfied_date` TIMESTAMP NOT NULL ,
          PRIMARY KEY (`id`)) $charset_collate;";


            //  category Table Created

            $sql .= "CREATE TABLE $cattable (
          `id` mediumint(9) NOT NULL AUTO_INCREMENT,
           `cat_name` varchar(55) NOT NULL,
           `user_id` bigint(20) unsigned NOT NULL,
           `privacy` tinyint(2) NOT NULL DEFAULT '1',
           `created_date`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
           `modyfied_date` TIMESTAMP NOT NULL ,
           PRIMARY KEY (`id`))  $charset_collate;";


            require_once( ABSPATH . "wp-admin/includes/upgrade.php" );

            //ob_start();
            dbDelta( $sql );
            //ob_clean();

			
            //Caps
            $common_caps = array(
                    'read' => false, // disable wp admin
                    //'edit_bookmarks' => true,
            );

            $hcp_caps = array(
                    'biodigital_library' => true,
                    'clinical_practice_support' => true,
            );
            $hcp_caps = array_merge($common_caps, $hcp_caps);

            add_role('hcp', __('Healthcare Practitioners'), $hcp_caps);
            add_role('non-hcp', __('Nutrition Enthusiast'), $common_caps);

            //Member Pages
            $page_definitions = [
                    'member-login' => [
                      'title' => __( 'Sign In', 'wholistic-matters' ),
                      'content' => '[wm-login]'
                    ],
                    'member-account' => [
                      'title' => __('Your Account', 'wholistic-matters'),
                      'content' => '[wm-account]'
                    ],
                    'member-register' => [
                      'title' => __('Register', 'wholistic-matters'),
                      'content' => '[wm-register]'
                    ],
                    'member-password-lost' => [
                      'title' => __('Forgot Your Password?', 'wholistic-matters'),
                      'content' => '[wm-lostpassword]'
                    ],
                    'member-password-reset' => [
                      'title' => __('Pick a New Password', 'wholistic-matters'),
                      'content' => '[wm-resetpass]'
                    ]
            ];
            foreach($page_definitions as $slug => $page) {
                    $query = new WP_Query(['pagename' => $slug]);
                    if(!$query->have_posts()) {
                            wp_insert_post([
                              'post_content' => $page['content'],
                              'post_name' => $slug,
                              'post_title' => $page['title'],
                              'post_status' => 'publish',
                              'post_type' => 'page',
                              'ping_status' => 'closed',
                              'comment_status' => 'closed'
                            ]);
                    }
            }
			
			//
			if( !get_option('_wm_quick_save_folder_id') ){
				$wpdb->query("DELETE FROM $cattable WHERE cat_name LIKE 'Quick Save'");
				$wpdb->query($wpdb->prepare("INSERT INTO $cattable ( cat_name, user_id, privacy ) VALUES ( %s, %d, %d )", array(
							__('Quick Save', 'wholistic-matters'),
							0,
							0
				)));
				$defaultFolderId = $wpdb->insert_id;

				add_option('_wm_quick_save_folder_id', $defaultFolderId);
			}
	}

}
