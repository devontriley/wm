<?php

/**
 * The core plugin helper class.
 *
 * This is used to define static methods
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    wholistic-matters
 * @subpackage wholistic-matters/includes
 */
class WMHelper{

	public static function get_current_path(){
		global $wp;
		$current_path = isset($wp->request) && !empty($wp->request) ? $wp->request : '/member-account';
		return $current_path;
	}

	public static function get_current_url(){
		$current_path = self::get_current_path();
		return site_url($current_path);
	}

	/**
	 * Get total bookmark for any post id
	 *
	 * @param $object_id
	 *
	 * @return integer
	 */
	public static function getTotalBookmark($object_id = 0){

		global $wpdb;
		$bookmark_table = W_M_BOOKMARK_TBL;

		if($object_id == 0){
			global $post;
			$object_id = $post->ID;
		}

		$query = "SELECT count(DISTINCT user_id) as count FROM $bookmark_table WHERE object_id= %d GROUP BY object_id ";

		$count = $wpdb->get_var($wpdb->prepare($query, $object_id));
		return ($count === null)? 0:  intval($count);

	}


	/**
	 * Get total bookmark count for any category id
	 *
	 * @param $object_id
	 *
	 * @return integer
	 */
	public static function getTotalBookmarkByCategory($cat_id){

		global $wpdb;
		$bookmark_table = W_M_BOOKMARK_TBL;

		if($cat_id == 0){
			return 0;
		}

		//$query = "SELECT count(DISTINCT user_id) as count FROM $bookmark_table WHERE cat_id= %d GROUP BY object_id ";
		//$count = $wpdb->get_var($wpdb->prepare($query, $cat_id));

		$query     = "SELECT count(*) as count from $bookmark_table where cat_id = %d";
		$count     = $wpdb->get_var($wpdb->prepare($query, $cat_id));


		return ($count === null)? 0:  intval($count);

	}




	/**
	 * Is a post bookmarked at least once
	 *
	 * @param int $object_id
	 *
	 * @return book
	 */
	public static function isBookmarked($object_id = 0){
		if($object_id == 0){
			global $post;
			$object_id = $post->ID;
		}

		$total_count = intval(WMHelper::getTotalBookmark($object_id));

		return ($total_count > 0)? true: false;
	}

	/**
	 * Is Bookmarked by User
	 *
	 * @param int    $object_id
	 * @param string $user_id
	 *
	 * @return bool
	 */
	public static function isBookmarkedUser($object_id = 0, $user_id = ''){

		if($object_id == 0){
			global $post;
			$object_id = $post->ID;
		}

		//if still object id
		if(intval($object_id) == 0) return false;

		if($user_id == ''){
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID ;
		}

		//if user id not found or guest user
		if(intval($user_id) == 0) return false;

		global $wpdb;
		$bookmark_table = W_M_BOOKMARK_TBL;

		$query = "SELECT count(DISTINCT user_id) as count FROM $bookmark_table WHERE object_id= %d AND user_id = %d GROUP BY object_id ";

		$count = $wpdb->get_var($wpdb->prepare($query, $object_id, $user_id));
		if($count !== null && intval($count) > 0) return true;
		else return false;
	}

	public static function isBookmarkInFolder($object_id = 0, $user_id = '', $folder_id = 0){

		if(intval($folder_id) == 0) return false;

		if($object_id == 0){
			global $post;
			$object_id = $post->ID;
		}

		//if still object id
		if(intval($object_id) == 0) return false;

		if($user_id == ''){
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID ;
		}

		//if user id not found or guest user
		if(intval($user_id) == 0) return false;

		global $wpdb;
		$bookmark_table = W_M_BOOKMARK_TBL;

		$query = "SELECT count(DISTINCT user_id) as count FROM $bookmark_table WHERE object_id= %d AND user_id = %d AND cat_id = %d GROUP BY object_id ";

		$count = $wpdb->get_var($wpdb->prepare($query, $object_id, $user_id, $folder_id));
		if($count !== null && intval($count) > 0) return true;
		else return false;
	}

	/**
	 * Get bookmark category  information by id
	 *
	 * @param $catid
	 *
	 * @return array|null|object|void
	 */
	public static function getBookmarkCategoryById($catid){

		if(intval($catid) == 0) return array();



		global $wpdb;
		$bookmark_folder_table = W_M_BOOKMARK_CAT_TBL;
		$bookmark_table         = W_M_BOOKMARK_TBL;

		$category = $wpdb->get_row(
			$wpdb->prepare("SELECT *  FROM  $bookmark_folder_table WHERE id = %d", $catid),
			ARRAY_A
		);

		return ($category === null)? array(): $category;
	}

	public static function getBookmarksByUser($object_id = 0, $user_id = ''){
		if($object_id == 0){
			global $post;
			$object_id = $post->ID;
		}

		//if still object id
		if(intval($object_id) == 0) return false;

		if($user_id == ''){
			$current_user = wp_get_current_user();
			$user_id = $current_user->ID ;
		}

		//if user id not found or guest user
		if(intval($user_id) == 0) return false;

		global $wpdb;
		$bookmark_table = W_M_BOOKMARK_TBL;

		$query = "SELECT * FROM $bookmark_table WHERE object_id= %d AND user_id = %d";
		$bookmarks= $wpdb->get_results(
			$wpdb->prepare($query, $object_id, $user_id),
			ARRAY_A
		);

		return ($bookmarks === null)? array(): $bookmarks;
	}

	/**
	 * Get the user roles for voting purpose
	 *
	 * @param string $useCase
	 *
	 * @return array
	 */
	public static function user_roles($plain = true, $include_guest = false)
	{
		global $wp_roles;

		if (!function_exists('get_editable_roles')) {
			require_once(ABSPATH . '/wp-admin/includes/user.php');

		}

		$userRoles = array();
		if($plain){
			foreach (get_editable_roles() as $role => $roleInfo) {
				$userRoles[$role] = $roleInfo['name'];
			}
			if($include_guest){
				$userRoles['guest'] = esc_html__("Guest", 'wholistic-matters');
			}
		}
		else{
			$userRoles_r = array();
			foreach (get_editable_roles() as $role => $roleInfo) {
				$userRoles_r[$role] = $roleInfo['name'];
			}

			$userRoles = array(
				'Registered' => $userRoles_r,
			);

			if($include_guest){
				$userRoles['Anonymous'] =  array(
					'guest' => esc_html__("Guest", 'wholistic-matters')
				);
			}
		}

		return apply_filters('wm_bookmark_userroles', $userRoles, $plain, $include_guest);
	}

	/**
	 * Get all the registered image sizes along with their dimensions
	 *
	 * @global array $_wp_additional_image_sizes
	 *
	 * @link http://core.trac.wordpress.org/ticket/18947 Reference ticket
	 *
	 * @return array $image_sizes The image sizes
	 */
	public static function get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$default_image_sizes = get_intermediate_image_sizes();

		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
			$image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
			$image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}

		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		return apply_filters('wm_bookmark_all_thumbnail_sizes', $image_sizes);
	}



	/**
	 * Well textual format for available image sizes
	 *
	 * @return array
	 */
	public static function get_all_image_sizes_formatted() {
		$image_sizes  = WMHelper::get_all_image_sizes();
		$image_sizes_arr  = array();

		foreach($image_sizes  as $key => $image_size){
			$width 		= (isset($image_size['width']) && intval($image_size['width']) > 0)? intval($image_size['width']): esc_html__('Unknown', 'wholistic-matters');
			$height		= (isset($image_size['height']) && intval($image_size['height']) > 0)? intval($image_size['height']): esc_html__('Unknown', 'wholistic-matters');
			$proportion = (isset($image_size['crop']) && intval($image_size['crop']) == 1)? esc_html__('Proportional', 'wholistic-matters'): '';
			if($proportion != '') $proportion = ' - '.$proportion;
			$image_sizes_arr[$key] = $key.'('.$width.'x'.$height.')'.$proportion;
		}

		return apply_filters('wm_bookmark_all_thumbnail_sizes_formatted', $image_sizes_arr);
	}

	/**
	 * Get all  core tables list
	 */
	public static function getAllDBTablesList(){
		global $wpdb;

		$bookmark = W_M_BOOKMARK_TBL;
		$cattable = W_M_BOOKMARK_CAT_TBL;

		$table_names = array();
		$table_names['Bookmarks Table']     = $bookmark;
		$table_names['Bookmark Folders Table'] = $cattable;


		return apply_filters('wm_bookmark_table_list', $table_names);
	}

	/**
	 * List all global option name with prefix wm_bookmark_
	 */
	public static function getAllOptionNames(){
		global  $wpdb;

		$prefix = 'wm_bookmark_';
		$option_names = $wpdb->get_results("SELECT * FROM {$wpdb->options} WHERE option_name LIKE '{$prefix}%'", ARRAY_A);

		return apply_filters('wm_bookmark_option_names', $option_names);
	}

	/**
	 * return one or more recent post
	 */
	public static function getRecentPosts($type, $args = array()){
		$p_args = array(
			'post_type' => 'post',
			'posts_per_page' => 1,
			'post_status' => 'publish',
			'orderby' => 'date', // date?
		);
		$p_args = array_merge($p_args, $args);
		if( in_array($type, array('article', 'post', 'default')) ){
			$p_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
						'post-format-aside',
						'post-format-audio',
						'post-format-chat',
						'post-format-gallery',
						'post-format-image',
						'post-format-link',
						'post-format-quote',
						'post-format-status',
						'post-format-video'
				),
				'operator' => 'NOT IN' //only default format
			);
		}
		if( in_array($type, array('video', 'videos')) ){
			$p_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-video'
				),
				'operator' => 'IN'
			);
		}
		if(  in_array($type, array('audio', 'podcast'))  ){
			$p_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-audio'
				),
				'operator' => 'IN'
			);
		}
		if( in_array($type, array('link', 'document', 'pdf', 'download')) ){
			$p_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-link'
				),
				'operator' => 'IN'
			);
		}

		$p_posts  = new WP_Query( $p_args );
		return $p_posts;
	}

	/**
	 * return all featured post in a topic
	 */
	public static function getFeaturedPosts($tax_term = null, $args = array()){
		if(!$tax_term){
			$tax_term = get_queried_object();
		}
		$meta_prefix = WM_META_PREFIX;
		$feat_args = array(
			'post_type' => 'post',
			'posts_per_page' => 5,
			'post_status' => 'publish',
			'orderby' => 'date', // date?
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key'     => $meta_prefix.'feature_spotlight',
					'value'   => '1',
					'compare' => '='
				),
				array(
					'key'     => $meta_prefix.'feature_specialties',
					'value'   => '1',
					'compare' => '='
				)
			),
			'tax_query' => array(
				array(
					'taxonomy' => $tax_term->taxonomy,
					'field' => 'term_id',
					'terms' =>  array($tax_term->term_id)
				)
			)
		);
		$feat_args = array_merge($feat_args, $args);
		if( $tax_term->taxonomy == 'spotlight-topic'){
			$feat_args['meta_query'] = array(
				array(
					'key'     => $meta_prefix.'feature_spotlight',
					'value'   => '1',
					'compare' => '='
				)
			);
		}
		if( $tax_term->taxonomy == 'practitioner-specialty'){
			$feat_args['meta_query'] = array(
				array(
					'key'     => $meta_prefix.'feature_specialties',
					'value'   => '1',
					'compare' => '='
				)
			);
		}
		$feat_posts  = new WP_Query( $feat_args );
		return $feat_posts;
	}

	public static function getPosts($type = 'all', $args = array(), $tax_term = null){
		if(!$tax_term && is_archive()){
			$tax_term = get_queried_object();
		}
		$meta_prefix = WM_META_PREFIX;
		$default_posts_per_page = get_option( 'posts_per_page' );
		$posts_per_page = $default_posts_per_page > 0 ? absint($default_posts_per_page) : 10;
		$p_args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
			'post_status' => 'publish',
			'orderby' => 'date', // date?
		);
		$p_args = array_merge($p_args, $args);
		if(isset($args['post_type'])){
			$p_args['post_type'] = $args['post_type'];
		}
		if(isset($args['paged'])){
			$p_args['paged'] = absint($args['paged']);
		}
		if($type == 'all' && $tax_term && isset($tax_term->taxonomy)){
			$p_args['tax_query'] = array(
				array(
					'taxonomy' => $tax_term->taxonomy,
					'field' => 'term_id',
					'terms' =>  array($tax_term->term_id)
				)
			);
		}else{
			if($tax_term  && isset($tax_term->taxonomy)){
				$p_args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => $tax_term->taxonomy,
						'field' => 'term_id',
						'terms' =>  array($tax_term->term_id)
					)
				);
			}

			if( in_array($type, array('article', 'post', 'default')) ){
				$p_args['tax_query'][] = array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array(
							'post-format-aside',
							'post-format-audio',
							'post-format-chat',
							'post-format-gallery',
							'post-format-image',
							'post-format-link',
							'post-format-quote',
							'post-format-status',
							'post-format-video'
					),
					'operator' => 'NOT IN' //only default format
				);
			}
			if( in_array($type, array('video', 'videos')) ){
				$p_args['tax_query'][] = array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array(
						'post-format-video'
					),
					'operator' => 'IN'
				);
			}
			if(  in_array($type, array('audio', 'podcast'))  ){
				$p_args['tax_query'][] = array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array(
						'post-format-audio'
					),
					'operator' => 'IN'
				);
			}
			if( in_array($type, array('link', 'document', 'pdf', 'download')) ){
				$p_args['tax_query'][] = array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array(
						'post-format-link'
					),
					'operator' => 'IN'
				);
			}
		}
//		if($type == 'popular'){
//			if(!isset($p_args['paged'])){
//				$p_args['paged'] = 1;
//			}
//			$posts = new WPP_Query( array('range' => 'all', 'order_by' => 'views', 'limit' => $p_args['posts_per_page'], 'offset' => (($p_args['paged'] - 1) * $p_args['posts_per_page']), 'post_type' => $p_args['post_type']) );
//			$popular_ids = array();
//			if(count($posts) > 0){
//				foreach ($posts as $p) {
//					$popular_ids[] = $p->ID;
//				}
//			}
//			if(count($popular_ids) > 0){
//				$p_args['post__in '] = $popular_ids;
//				$p_args['orderby  '] = 'none';
//			}else{
//				$p_args['post__in '] = array(0);
//			}
//			$posts  = new WP_Query( $p_args );
//		}else{
			$posts  = new WP_Query( $p_args );
		//}
		return $posts;
	}

	public static function getAllPosts($args = array()){
		//$meta_prefix = WM_META_PREFIX;
		$default_posts_per_page = get_option( 'posts_per_page' );
		$posts_per_page = $default_posts_per_page > 0 ? absint($default_posts_per_page) : 10;
		$p_args = array(
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
			'post_status' => 'publish',
			'orderby' => 'date', // date?
		);
		$p_args = array_merge($p_args, $args);

		if(isset($args['paged'])){
			$p_args['paged'] = absint($args['paged']);
		}
		$posts  = new WP_Query( $p_args );
		return $posts;
	}
	public static function getSearchInitPosts($type = "all", $params){
		$tax_query = array();
		$pArgs = array('paged' => 1);
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

			if(in_array($type, array('article', 'video', 'audio', 'link'))){
				$params['wm_media'] = array($type);
			}

			if (isset($params['wm_media']) && count($params['wm_media']) > 0) {
				$sel_p_formats = $params['wm_media'];
				$tax_query[] = WMHelper::getPostFormatQuery($sel_p_formats);
			}
		}

		if (count($tax_query) > 1) {
			$tax_query['relation'] = 'OR'; // or  Docs: Logic - [Search term] within [Cardio-Metabolic Control] OR [Digestive Health] OR {Spotlight Topic] OR is an [Article] OR [Video]
		}

		if (count($tax_query) > 0) {
			$pArgs['tax_query'] = $tax_query;
		}
		$posts = WMHelper::getAllPosts($pArgs);
		return $posts;
	}

	public static function getPostFormatQuery($post_formats){
		$ptype_query = array();

		if (count($post_formats) > 1) {
			$ptype_query['relation'] = 'OR';
		}

		if (in_array('article', $post_formats)) {
			$ptype_query[] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-aside',
					'post-format-audio',
					'post-format-chat',
					'post-format-gallery',
					'post-format-image',
					'post-format-link',
					'post-format-quote',
					'post-format-status',
					'post-format-video'
				),
				'operator' => 'NOT IN' //only default format
			);
		}
		if (in_array('video', $post_formats)) {
			$ptype_query[] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-video'
				),
				'operator' => 'IN'
			);
		}
		if (in_array('audio', $post_formats)) {
			$ptype_query[] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-audio'
				),
				'operator' => 'IN'
			);
		}
		if (in_array('link', $post_formats)) {
			$ptype_query[] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-link'
				),
				'operator' => 'IN'
			);
		}

		if (count($post_formats) > 1) {
			return $ptype_query;
		}else{
			return $ptype_query[0];
		}
	}

	public static function getTerms($args = array()){
		$default_posts_per_page = get_option( 'posts_per_page' );
		$per_page = $default_posts_per_page > 0 ? absint($default_posts_per_page) : 10;
		$taxonomy = isset($args['taxonomy']) ? $args['taxonomy'] : 'post_tag';
		$total_count = count( get_terms( array(
			'taxonomy' => $taxonomy,
			'hide_empty' => false,
		) ));
		$paged = 1;
		$offset = $per_page * ( $paged - 1);

		$p_args = array(
			'taxonomy' => $taxonomy,
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC'
		);
		if(isset($args['orderby'])){
			$p_args['orderby'] = $args['orderby'];
		}
		if(isset($args['order'])){
			$p_args['order'] = $args['order'];
		}
		if(isset($args['paged'])){
			$paged = absint($args['paged']);
			$offset = $per_page * ( $paged - 1);
			$p_args['offset'] = $offset;
			$p_args['number'] = $per_page;
		}else if(isset($args['number']) && !isset($args['paged'])){
			$p_args['number'] = absint($args['number']);
		}else{
			$p_args['offset'] = $offset;
			$p_args['number'] = $per_page;
		}
		$terms = get_terms( $p_args );
		return array('terms' => $terms, 'total' => $total_count, 'pages' => ceil( $total_count / $per_page ));
	}

	public static function getSeries($args = array()){
		$default_posts_per_page = get_option( 'posts_per_page' );
		$per_page = $default_posts_per_page > 0 ? absint($default_posts_per_page) : 10;
		$total_count = count( get_terms( array(
			'taxonomy' => 'series',
			'hide_empty' => false,
		) ));
		$paged = 1;
		$offset = $per_page * ( $paged - 1);

		$p_args = array(
			'taxonomy' => 'series',
			'hide_empty' => false,
			'orderby'    => 'ID',
			'order'      => 'DESC'
		);
		if(isset($args['orderby'])){
			$p_args['orderby'] = $args['orderby'];
		}
		if(isset($args['order'])){
			$p_args['order'] = $args['order'];
		}
		if(isset($args['paged'])){
			$paged = absint($args['paged']);
			$offset = $per_page * ( $paged - 1);
			$p_args['offset'] = $offset;
			$p_args['number'] = $per_page;
		}else if(isset($args['number']) && !isset($args['paged'])){
			$p_args['number'] = absint($args['number']);
		}else{
			$p_args['offset'] = $offset;
			$p_args['number'] = $per_page;
		}
		$terms = get_terms( $p_args );
		return array('terms' => $terms, 'total' => $total_count, 'pages' => ceil( $total_count / $per_page ));
	}

/**
 * Like get_template_part() but lets you pass args to the template file
 * Args are available in the template as $args array.
 * Args can be passed in as url parameters, e.g 'key1=value1&key2=value2'.
 * Args can be passed in as an array, e.g. ['key1' => 'value1', 'key2' => 'value2']
 * Filepath is available in the template as $file string.
 * @param string      $slug The slug name for the generic template.
 * @param string|null $name The name of the specialized template.
 * @param array       $args The arguments passed to the template
 */
	public static function get_template_part( $slug, $name = null, $args = array() ) {
		if ( isset( $name ) && $name !== 'none' ) $slug = "{$slug}-{$name}.php";
		else $slug = "{$slug}.php";
		$dir = get_template_directory();
		$file = "{$dir}/{$slug}";

		ob_start();
		$args = wp_parse_args( $args );
		$slug = $dir = $name = null;
		require( $file );
		echo ob_get_clean();
	}
	public static function get_term_meta_text( $term_id, $term_key ) {
		$value = get_term_meta( $term_id, $term_key, true );
		$value = sanitize_text_field( $value );
		return $value;
	}
	public static function get_term_meta_url( $term_id, $term_key ) {
		$value = get_term_meta( $term_id, $term_key, true );
		$value = esc_url( $value );
		return $value;
	}

	/**
	* Utility to test if the post is already liked
	*/
	public static function already_liked( $post_id ) {
	   $post_users = NULL;
	   $user_id = NULL;
	   if ( is_user_logged_in() ) { // user is logged in
		   $user_id = get_current_user_id();
		   $post_meta_users =  get_post_meta( $post_id, "_wm_post_like_user_ids" );
		   if ( count( $post_meta_users ) != 0 ) {
			   $post_users = $post_meta_users[0];
		   }
	   } else { // user is anonymous
		   $user_id = self::sl_get_ip();
		   $post_meta_users =  get_post_meta( $post_id, "_wm_post_like_user_IP" );
		   if ( count( $post_meta_users ) != 0 ) { // meta exists, set up values
			   $post_users = $post_meta_users[0];
		   }
	   }
	   if ( is_array( $post_users ) && in_array( $user_id, $post_users ) ) {
		   return true;
	   } else {
		   return false;
	   }
   } // already_liked()

	/**
	* Output the like button
	*/
	public static function get_simple_likes_button( $post_id, $title = '' ) {
		$output = '';
		if ( self::already_liked( $post_id ) ) {
			return $output; //if already interacted then no need to display again
		}
		$nonce = wp_create_nonce( 'simple-likes-nonce' ); // Security

		$post_id_class = esc_attr( ' sl-button-' . $post_id );

		$class = '';
		$icon_like = self::get_unliked_icon();
		$icon_dislike = self::get_liked_icon();
		// Loader
		$loader = '<span id="sl-loader"></span>';
		// Liked/Unliked Variables

		$output = '<div class="sl-wrapper">';
		if(!empty($title)){
			$output .= '<h4>'.$title.'</h4>';
		}
		//Like
		$action_class = esc_attr( ' like' );
		//$count = self::get_like_count( $like_count );
		$title = __( 'Like', 'wholistic-matters' );
		$icon = $icon_like;
		$output .= '<a href="#" class="sl-button' . $post_id_class . $class . $action_class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '"  title="' . $title . '">' . $icon . '</a>';

		//Dislike
		$action_class = esc_attr( ' dislike' );
		$title = __( 'Dislike', 'wholistic-matters' );
		$icon = $icon_dislike;
		$output .= '<a href="#" class="sl-button' . $post_id_class . $class . $action_class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '"  title="' . $title . '">' . $icon . '</a>';

		$output .=  $loader . '</div>';
		return $output;
	} // get_simple_likes_button()

	/**
	* Utility retrieves post meta user likes (user id array),
	* then adds new user id to retrieved array
	*/
	public static function post_user_likes( $user_id, $post_id ) {
		$post_users = '';
		$post_meta_users = get_post_meta( $post_id, "_wm_post_like_user_ids" );
		if ( count( $post_meta_users ) != 0 ) {
			$post_users = $post_meta_users[0];
		}
		if ( !is_array( $post_users ) ) {
			$post_users = array();
		}
		if ( !in_array( $user_id, $post_users ) ) {
			$post_users['user-' . $user_id] = $user_id;
		}
		return $post_users;
	} // post_user_likes()

	/**
	* Utility retrieves post meta ip likes (ip array),
	* then adds new ip to retrieved array
	*/
	public static function post_ip_likes( $user_ip, $post_id ) {
		$post_users = '';
		$post_meta_users =  get_post_meta( $post_id, "_wm_post_like_user_IP" );
		// Retrieve post information
		if ( count( $post_meta_users ) != 0 ) {
			$post_users = $post_meta_users[0];
		}
		if ( !is_array( $post_users ) ) {
			$post_users = array();
		}
		if ( !in_array( $user_ip, $post_users ) ) {
			$post_users['ip-' . $user_ip] = $user_ip;
		}
		return $post_users;
	} // post_ip_likes()

	/**
	* Utility to retrieve IP address
	*/
	public static function sl_get_ip() {
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
		}
		$ip = filter_var( $ip, FILTER_VALIDATE_IP );
		$ip = ( $ip === false ) ? '0.0.0.0' : $ip;
		return $ip;
	} // sl_get_ip()

	/**
	* Utility returns the button icon for "like" action
	*/
	public static function get_liked_icon() {
		/* If already using Font Awesome with your theme, replace svg with: <i class="fa fa-heart"></i> */
		//$icon = '<span class="sl-icon">'.file_get_contents( get_stylesheet_directory_uri() . '/images/unlike.svg' ).'</span>';
        $icon = '<span class="sl-icon"><img src="'. get_stylesheet_directory_uri() . '/images/unlike.svg' .'" alt="Like" /></span>';
		return $icon;
	} // get_liked_icon()

	/**
	 * Utility returns the button icon for "unlike" action
	 */
	public static function get_unliked_icon() {
		/* If already using Font Awesome with your theme, replace svg with: <i class="fa fa-heart-o"></i> */
		//$icon = '<span class="sl-icon">'.file_get_contents( get_stylesheet_directory_uri() . '/images/like.svg' ).'</span>';
        $icon = '<span class="sl-icon"><img src="'. get_stylesheet_directory_uri() . '/images/like.svg' .'" alt="Unlike" /></span>';
		return $icon;
	} // get_unliked_icon()

	/**
	* Utility function to format the button count,
	* appending "K" if one thousand or greater,
	* "M" if one million or greater,
	* and "B" if one billion or greater (unlikely).
	* $precision = how many decimal points to display (1.25K)
	*/
	public static function sl_format_count( $number ) {
		$precision = 2;
		if ( $number >= 1000 && $number < 1000000 ) {
			$formatted = number_format( $number/1000, $precision ).'K';
		} else if ( $number >= 1000000 && $number < 1000000000 ) {
			$formatted = number_format( $number/1000000, $precision ).'M';
		} else if ( $number >= 1000000000 ) {
			$formatted = number_format( $number/1000000000, $precision ).'B';
		} else {
			$formatted = $number; // Number is less than 1000
		}
		$formatted = str_replace( '.00', '', $formatted );
		return $formatted;
	} // sl_format_count()

	/**
	* Utility retrieves count plus count options,
	* returns appropriate format based on options
	*/
	public static function get_like_count( $like_count, $post_id = false) {
		$like_text = __( '', 'wholistic-matters' );
		if ( is_numeric( $like_count ) && $like_count > 0 ) {
			$number = self::sl_format_count( $like_count );
			$suffix = ($like_count > 1) ? __( 'people liked this', 'wholistic-matters' ) : __( 'person liked this', 'wholistic-matters' );
			$number = $number . ' ' . $suffix;
			if( $post_id && self::already_liked( $post_id ) ){
				$number = self::sl_format_count( ($like_count - 1) ); // sub current user
				$suffix = (($like_count - 1) > 1) ? __( 'other people liked this', 'wholistic-matters' ) : __( 'other person liked this', 'wholistic-matters' );
				$number = __( 'You and', 'wholistic-matters' ). ' ' .$number . ' ' . $suffix;
				if(($like_count - 1) == 0){
					$number = __( 'You liked this', 'wholistic-matters' );
				}
			}
		} else {
			$number = $like_text;
		}
		$count = '<span class="sl-count">' . $number . '</span>';
		return $count;
	} // get_like_count()

	//////
	public static function get_podcast_url($type = 'any', $post_id = 0) {
		global $post;
		if($post_id === 0){
			$post_id = $post->ID;
		}
		if($type == 'ogg'){
			$podcast_file = rwmb_meta( WM_META_PREFIX.'podcast_file_ogg', array(), $post_id );
		} else {
			$podcast_file = rwmb_meta( WM_META_PREFIX.'podcast_file', array(), $post_id );
		}
		$podcast_file_url = is_int($podcast_file) || ctype_digit($podcast_file) ? wp_get_attachment_url(intval($podcast_file)) : $podcast_file;
		return $podcast_file_url;
	}
	public static function get_post_read_time($post_id = 0) {
		global $post;
		if($post_id === 0){
			$post_id = $post->ID;
		}
		$read_time = rwmb_meta(WM_META_PREFIX . 'mins_to_read', array(), $post_id);
		$read_time = !empty($read_time) ? rtrim(strip_tags($read_time), 'min') : '1';
		$read_time .= ' ' . __('min read');
		if (empty(rwmb_meta(WM_META_PREFIX . 'mins_to_read')) && shortcode_exists('rt_reading_time')) {
			$read_time = do_shortcode('[rt_reading_time postfix="min read" postfix_singular="min read"]');
		}
		return $read_time;
	}

	public static function get_post_watch_time($post_id = 0) {
		global $post;
		if($post_id === 0){
			$post_id = $post->ID;
		}
		$watch_time = rwmb_meta(WM_META_PREFIX . 'mins_to_watch', array(), $post_id);
		$watch_time = !empty($watch_time) ? rtrim(strip_tags($watch_time), 'min') : '1';
		$watch_time .= ' ' . __('min watch');
		return $watch_time;
	}

	public static function get_post_cook_time($post_id = 0) {
		global $post;
		if($post_id === 0){
			$post_id = $post->ID;
		}
		$cook_time = rwmb_meta(WM_META_PREFIX . 'mins_to_cook', array(), $post_id);
		$cook_time = !empty($cook_time) ? rtrim(strip_tags($cook_time), 'min') : 1;
		$cook_time = __('ready in').' '.self::renderMinutes($cook_time);
		return $cook_time;
	}

	public static function get_post_listen_time($post_id = 0) {
		global $post;
		if($post_id === 0){
			$post_id = $post->ID;
		}
		$ep_length = rwmb_meta(WM_META_PREFIX . 'mins_to_listen', array(), $post_id);
		$ep_length = !empty($ep_length) ? rtrim(strip_tags($ep_length), 'min') : '1';
		$ep_length .= ' '.__('min');
		return $ep_length;
	}
	public static function renderMinutes($minutes) {
		$format = '%d hrs %d min';
		if ($minutes < 1) {
			return '0 min';
		}
		if ($minutes < 60) {
			return $minutes.' min';
		}
		$hours = floor($minutes / 60);
		$minutes = ($minutes % 60);
		if($hours < 2){
			$format = '%d hour %d min';
		}
		if($minutes == 0){
			$format = '%d hrs';
			if($hours < 2){
				$format = '%d hour';
			}
			return sprintf($format, $hours);
		}
		return sprintf($format, $hours, $minutes);
	}
	///////
	public static function get_email_from_address($part = '') {
		$settings = Wholistic_Matters::get_settings();
		$value = ( isset( $settings['mail_config'] ) && $settings['mail_config'] ) ? $settings['mail_config'] : array('from_name'=>'WholisticMatters', 'from_email'=>'noreply@wholisticmatters.com');
		$from_name = isset($value['from_name']) ? $value['from_name'] : '';
		$from_email = isset($value['from_email']) ? $value['from_email'] : '';
		if(strtolower($part) == 'name'){
			return $from_name;
		}else if(strtolower($part) == 'email'){
			return $from_email;
		}
		//return 'WholisticMatters <noreply@wholisticmatters.com>';
		return !empty($from_name) ? "{$from_name} <{$from_email}>" : "{$from_email}";
	}

	public static function get_email_variables($context = '', $valArray = array()) {
		if(empty($context)) { return array(); }
		$values = array();
		switch ($context) {
			case 'common':
				$variables = array(
                    "site_url"=> 'site_url', //for var -to- value mappings
					"site_name"=> 'site_name',
                    );
				break;
			case 'contact':
				$variables = array(
                    "contact_name"=> 'name', //for var -to- value mappings
                    "contact_email"=> 'email',
                    "contact_subject"=> 'subject',
                    "contact_message"=> 'message',
                    );
				break;
			case 'register':
				$variables = array(
                    "user_email"=> 'email', //for var -to- value mappings
                    "user_first_name"=> 'first_name',
                    "user_last_name"=> 'last_name',
                    "user_role_slug"=> 'user_role_slug',
                    "user_role"=> 'user_role',
                    );
				$custom_meta_fields = self::get_custom_user_meta_fields();
				foreach ($custom_meta_fields as $meta_field_name => $meta_field) {
					$variables[$meta_field_name] = $meta_field_name;
					$variables['label'.$meta_field_name] = 'label'.$meta_field_name;
				}
				break;
			case 'reset':
				$variables = array(
                    "user_email"=> 'email', //for var -to- value mappings
                    "user_first_name"=> 'first_name',
                    "user_last_name"=> 'last_name',
                    "user_role_slug"=> 'user_role_slug',
                    "user_role"=> 'user_role',
                    "reset_url"=> 'reset_url',
                    );
				break;
		}
		if(empty($valArray)){
			return array_keys($variables); //for admin settings to display available Vars
		}
		foreach ($variables as $var => $val_key) {
			$values[$var] = isset($valArray[$val_key]) ? $valArray[$val_key] : '';
		}
		return $values;
	}

	public static function parse_email_template($content, $variable, $replacement) {
		// IF - ELSE - ENDIF
		preg_match_all('/\{IF\?(.*?)\}[\s]*?(.*)[\s]*?(\{ELSE\}[\s]*?(.*?)[\s]*?)\{ENDIF\}/is', $content, $regs, PREG_PATTERN_ORDER);
		for ($i = 0; $i < count($regs[0]); $i++) {
			$condition = str_replace('#'.strtoupper($variable).'#', "'".$replacement."'", $regs[1][$i], $rep_count);
			$trueval   = $regs[2][$i];
			$falseval  = (isset($regs[4][$i])) ? $regs[4][$i] : false;
			if($rep_count > 0){
				$res = eval('return ('. $condition .');');
				if ($res===true) {
					$content = str_replace($regs[0][$i],$trueval,$content);
				} else {
					$content = str_replace($regs[0][$i],$falseval,$content);
				}
			}
		}

		// IF - ENDIF
		preg_match_all('/\{IF\?(.*?)\}[\s]*?(.*)[\s]*?{ENDIF\}/is', $content, $regs, PREG_PATTERN_ORDER);
		for ($i = 0; $i < count($regs[0]); $i++) {
			$condition = str_replace('#'.strtoupper($variable).'#', "'".$replacement."'", $regs[1][$i], $rep_count);
			$trueval   = $regs[2][$i];
			if($rep_count > 0){
				$res = eval('return ('.$condition.');');
				if ($res===true) {
					$content = str_replace($regs[0][$i],$trueval,$content);
				} else {
					$content = str_replace($regs[0][$i],'',$content);
				}
			}
		}

		// Vars
		$content = str_replace('#'.strtoupper($variable).'#', $replacement, $content);
		return $content;
	}

	public static function get_email_template($part, $variables = array()) {
		if(empty($part || !file_exists( W_M_PATH.'public/partials/email/'. rtrim($part, '.php').'.php' ))){
			return false;
		}
		$wm_settings = Wholistic_Matters::get_settings();
		$mail_footer = ( isset( $wm_settings['mail_content_footer'] ) && $wm_settings['mail_content_footer'] ) ? $wm_settings['mail_content_footer'] : '';
		$part = rtrim($part, '.php');
		$mail_content = '';
		$common_vars = WMHelper::get_email_variables('common', array(
			"site_url"=> site_url('/'),
			"site_name"=> get_bloginfo('name') ,
		));
		ob_start();
		include_once W_M_PATH.'public/partials/email/header.php';
		$mail_content = ( isset( $wm_settings['mail_content_'.$part] ) && $wm_settings['mail_content_'.$part] ) ? $wm_settings['mail_content_'.$part] : '';
		$variables = array_merge($common_vars, $variables);
		foreach($variables as $key => $value){
			$mail_content = self::parse_email_template($mail_content, $key, $value);
			$mail_footer = self::parse_email_template($mail_footer, $key, $value);
		}

		//include_once W_M_PATH.'public/partials/email/'.$part.'.php';
		include_once W_M_PATH.'public/partials/email/default.php';
		include_once W_M_PATH.'public/partials/email/footer.php';
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}

	public static function get_custom_user_meta_fields() {
		$custom_meta_fields = array();
		$custom_meta_fields['_wm_newsletter'] = array(
			'label' => __('Receive the latest WholisticMatters News', 'wholistic-matters'),
			'column' => __('Newsletter', 'wholistic-matters'),
			'type' => 'checkbox',
		);
		$custom_meta_fields['_wm_legal_agreement'] = array(
			'label' => __('I agree to the Terms & Conditions', 'wholistic-matters'),
			'column' => __('Terms & Conditions / Privacy Policy', 'wholistic-matters'),
			'type' => 'checkbox',
			'required' => true,
		);
		$custom_meta_fields['_wm_hc_professional_type'] = array(
			'label' => __('Healthcare Professional Type', 'wholistic-matters'),
			'column' => __('HCP Type', 'wholistic-matters'),
			'type' => 'select',
			'options' => array(
				'Nutritionist' => __('Nutritionist', 'wholistic-matters'),
				'Chiropractor' => __('Chiropractor', 'wholistic-matters'),
				'Medical Doctor' => __('Medical Doctor', 'wholistic-matters'),
				'Acupuncturist' => __('Acupuncturist', 'wholistic-matters'),
				'Naturopath' => __('Naturopath', 'wholistic-matters'),
				'Osteopath' => __('Osteopath', 'wholistic-matters'),
				'Nurse/Nurse Practitioner' => __('Nurse/Nurse Practitioner', 'wholistic-matters'),
				'Dietitian' => __('Dietitian', 'wholistic-matters'),
				'Health Coach' => __('Health Coach', 'wholistic-matters'),
				'Herbalist' => __('Herbalist', 'wholistic-matters'),
				'Veterinarian' => __('Veterinarian', 'wholistic-matters'),
				'Other Healthcare Practitioner' => __('Other Healthcare Practitioner', 'wholistic-matters'),
			)
		);
		$custom_meta_fields['_wm_degrees'] = array(
			'label' => __('Degrees / Certifications', 'wholistic-matters'),
			'column' => __('Degrees', 'wholistic-matters'),
			'type' => 'text',
		);
		$custom_meta_fields['_wm_city'] = array(
			'label' => __('City', 'wholistic-matters'),
			'column' => __('City', 'wholistic-matters'),
			'type' => 'text',
		);
		$custom_meta_fields['_wm_state'] = array(
			'label' => __('State', 'wholistic-matters'),
			'column' => __('State', 'wholistic-matters'),
			'type' => 'select',
			'options' => array(
				'AL' => 'Alabama',
				'AK' => 'Alaska',
				'AZ' => 'Arizona',
				'AR' => 'Arkansas',
				'CA' => 'California',
				'CO' => 'Colorado',
				'CT' => 'Connecticut',
				'DE' => 'Delaware',
				'DC' => 'Washington DC',
				'FL' => 'Florida',
				'GA' => 'Georgia',
				'HI' => 'Hawaii',
				'ID' => 'Idaho',
				'IL' => 'Illinois',
				'IN' => 'Indiana',
				'IA' => 'Iowa',
				'KS' => 'Kansas',
				'KY' => 'Kentucky',
				'LA' => 'Louisiana',
				'ME' => 'Maine',
				'MD' => 'Maryland',
				'MA' => 'Massachusetts',
				'MI' => 'Michigan',
				'MN' => 'Minnesota',
				'MS' => 'Mississippi',
				'MO' => 'Missouri',
				'MT' => 'Montana',
				'NE' => 'Nebraska',
				'NV' => 'Nevada',
				'NH' => 'New Hampshire',
				'NJ' => 'New Jersey',
				'NM' => 'New Mexico',
				'NY' => 'New York',
				'NC' => 'North Carolina',
				'ND' => 'North Dakota',
				'OH' => 'Ohio',
				'OK' => 'Oklahoma',
				'OR' => 'Oregon',
				'PA' => 'Pennsylvania',
				'PR' => 'Puerto Rico',
				'RI' => 'Rhode Island',
				'SC' => 'South Carolina',
				'SD' => 'South Dakota',
				'TN' => 'Tennessee',
				'TX' => 'Texas',
				'UT' => 'Utah',
				'VT' => 'Vermont',
				'VI' => 'Virgin Islands',
				'VA' => 'Virginia',
				'WA' => 'Washington',
				'WV' => 'West Virginia',
				'WI' => 'Wisconsin',
				'WY' => 'Wyoming',
			)
		);
		return $custom_meta_fields;
	}
}
