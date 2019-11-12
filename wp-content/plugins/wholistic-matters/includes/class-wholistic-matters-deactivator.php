<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.example.com
 * @since      1.0.0
 *
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wholistic_Matters
 * @subpackage Wholistic_Matters/includes
 * @author     WholisticMatters <info@example.com>
 */
class Wholistic_Matters_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		remove_role('hcp');
		remove_role('non-hcp');
	}

}
