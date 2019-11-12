<?php

if (!function_exists('WM_object_types')) {

        /**
         * Return post types list, if plain is true then send as plain array , else array as post type groups
         *
         * @param bool|false $plain
         *
         * @return array
         */
        function WM_object_types($plain = false)
        {
                $post_type_args = array(
                        'builtin' => array(
                                'options' => array(
                                        'public'   => true,
                                        '_builtin' => true,
                                        'show_ui'  => true,
                                ),
                                'label'   => esc_html__('Built in post types', 'wholistic-matters'),
                        )
                );

                $post_type_args = apply_filters('WM_post_types', $post_type_args);

                $output    = 'objects'; // names or objects, note names is the default
                $operator  = 'and'; // 'and' or 'or'
                $postTypes = array();

                foreach ($post_type_args as $postArgType => $postArgTypeArr) {
                        $types = get_post_types($postArgTypeArr['options'], $output, $operator);

                        if (!empty($types)) {
                                foreach ($types as $type) {
                                        $postTypes[$postArgType]['label']              = $postArgTypeArr['label'];
                                        $postTypes[$postArgType]['types'][$type->name] = $type->labels->name;
                                }
                        }
                }


                if ($plain) {
                        $plain_list = array();
                        if (isset($postTypes['builtin']['types'])) {

                                foreach ($postTypes['builtin']['types'] as $key => $name) {
                                        $plain_list[] = $key;
                                }
                        }

                        if (isset($postTypes['custom']['types'])) {

                                foreach ($postTypes['custom']['types'] as $key => $name) {
                                        $plain_list[] = $key;
                                }
                        }

                        return $plain_list;
                } else return $postTypes;
        }
}


if (!function_exists('WM_show_bookmark_btn')):


    /**
     *
     */
    function WM_show_bookmark_btn($object_id = 0, $object_type = null, $show_count = 1, $extra_wrap_class = '', $skip_ids = '', $skip_roles = ''){
            
        //format the post skip ids
        if($skip_ids == ''){
                $skip_ids = array();
        }
        else{
                $skip_ids = explode(',', $skip_ids);
        }

        //format user roles
        if($skip_roles == ''){
                $skip_roles = array();
        }
        else{
                $skip_roles = explode(',', $skip_roles);
        }

        $current_user = wp_get_current_user();
        $user_id = $current_user->ID ;
        $loggedin = (intval($user_id) > 0)? 1: 0;

        if ($object_id == 0 || $object_type === null) return '';

        //check if there is skip post id option
        if(sizeof($skip_ids) > 0){
                if(in_array($object_id, $skip_ids)) return '';
        }

        //check if there is skip role option
        if(sizeof($skip_roles) > 0){
                //if(in_array($object_id, $skip_ids)) return '';
                $current_user_roles = is_user_logged_in()? $current_user->roles: array('guest');
                if(sizeof(array_intersect($skip_roles, $current_user_roles))> 0){
                        return '';
                }

        }



        do_action('WM_show_bookmark_btn');

        $bookmark_class = '';
        $bookmark_total = intval(WMHelper::getTotalBookmark($object_id));

        $bookmark_by_user = WMHelper::isBookmarkedUser($object_id, $user_id);

        if($bookmark_by_user) $bookmark_class = 'cbxwpbkmarktrig-marked';

        $show_count_html = '';
        if($show_count){
                $show_count_html = '(<i class="cbxwpbkmarktrig-count">'.$bookmark_total.'</i>)';
        }


        $cbxwpbkmark = '<a data-loggedin="'.intval($loggedin).'" data-type="' . $object_type . '" data-object_id="' . $object_id . '" class="cbxwpbkmarktrig '.$bookmark_class.' cbxwpbkmarktrig-button-addto" title="' . esc_html__('Bookmark This', 'wholistic-matters') . '" href="#"><span class="cbxwpbkmarktrig-label">' . esc_html__('Bookmark', 'wholistic-matters') .$show_count_html.'</span></a>';

        if($user_id == 0):
            $cbxwpbkmark .= ' <div  data-type="' . $object_type . '" data-object_id="' . $object_id . '" class="cbxwpbkmarkguestwrap" id="cbxwpbkmarkguestwrap-' . $object_id . '">';

            $login_url = wp_login_url();
            if(is_singular()){
                $login_url =  wp_login_url( get_permalink() );;
            }else{
                global $wp;
                //$login_url =  wp_login_url( home_url( $wp->request ) );;
                $login_url =  wp_login_url( home_url( add_query_arg(array(),$wp->request) ) );;
            }

            $cbxwpbkmark .= '<div class="cbxwpbkmarkguest-message">';
            $cbxwpbkmark .= '<a href="#" class="cbxwpbkmarkguesttrig_close"></a>';
            $cbxwpbkmark .= '<a class="cbxwpbkmarkguest-text" href="'.$login_url.'">'.esc_html__('Please login to bookmark','wholistic-matters').'</a>';
            $cbxwpbkmark .= '</div>';
            $cbxwpbkmark .= '</div>';
        else:
            $cbxwpbkmark .= ' <div  data-type="' . $object_type . '" data-object_id="' . $object_id . '" class="cbxwpbkmarklistwrap" id="cbxwpbkmarklistwrap-' . $object_id . '">
                 <span class="addto-head"><i class="cbxwpbkmarktrig_label">'.esc_html__('Click Category to Bookmark', 'wholistic-matters').'</i><i title="'. esc_html__('Close', 'wholistic-matters') .'"  data-object_id="' . $object_id . '" class="cbxwpbkmarktrig_close"></i></span>

                <div class="cbxwpbkmarkselwrap">
                    <div class="cbxlbjs cbxwpbkmark-lbjs">
                                                            <div class="cbxlbjs-searchbar-wrapper cbxlbjs-searchbar-wrapper-add">
                                                                    <input class="cbxlbjs-searchbar cbxlbjs-searchbar-add" placeholder="' . esc_html__('Search...', 'wholistic-matters') . '">
                                                                    <i class="cbxlbjs-searchbar-icon"></i>
                                                            </div>
                                                            <ul class="cbxlbjs-list cbxwpbkmarklist cbxwpbkmarklist-add" style="height: 205px;" data-type="' . $object_type . '" data-object_id="' . $object_id . '">
                                                            </ul>
                                                    </div>
                </div>
                <div class="cbxwpbkmarkmanageselwrap">
                    <div class="cbxlbjs-manage cbxwpbkmark-lbjs-manage">
                                                            <div class="cbxlbjs-searchbar-wrapper-manage">
                                                                    <input class="cbxlbjs-searchbar-manage" placeholder="' . esc_html__('Search...', 'wholistic-matters') . '">
                                                                    <i class="cbxlbjs-searchbar-icon"></i>
                                                            </div>
                                                            <ul class="cbxlbjs-list-manage cbxwpbkmarklist-manage" style="height: 205px;" data-type="' . $object_type . '" data-object_id="' . $object_id . '">
                                                            </ul>
                                                    </div>
                </div>

                <div class="cbxwpbkmarkaddnewcat">
                    <a class="cbxwpbkmarkaddnewcattrig" href="#">' . esc_html__('Add New Category', 'wholistic-matters') . '</a>
                    <a class="cbxwpbkmarkmanagecattrig" data-type="' . $object_type . '" data-object_id="' . $object_id . '" href="#">' . esc_html__('Manage Category', 'wholistic-matters') . '</a>
                    <div class="cbxwpbkmarclearfix"></div>
                    <div class="cbxwpbkmarkaddnewwrap">
                        <div class="cbxwpbkmarkaddnewinputwrap">
                            <input required placeholder="' . esc_html__('Type Category Name', 'wholistic-matters') . '" type="text" name="cbxwpbkmarkaddnewcatinput" class="cbxwpbkmarkaddnewcatinput" />
                        </div>

                        <div class="cbxwpbkmarkaddnewactionwrap">
                            <p class="cbxwpbkmarkaddnewaction_error"> </p>                                        
                            <div class="cbxwpbkmarkaddnewcatselect cbxbookmark-switch-field">
                              <input type="radio" id="cbxbookmarkswitch_left_' . $object_id . '" name="cbxbookmarkswitch_' . $object_id . '" value="1" checked/>
                              <label for="cbxbookmarkswitch_left_' . $object_id . '" title="' . esc_html__('Public Category', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-public"></span></label>
                              <input type="radio" id="cbxbookmarkswitch_right_' . $object_id . '" name="cbxbookmarkswitch_' . $object_id . '" value="0" />
                              <label for="cbxbookmarkswitch_right_' . $object_id . '" title="' . esc_html__('Private Category', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-private"></span></label>
                            </div>

                            <a  class="cbxwpbkmarkaddnewcatclose" href="#" title="' . esc_html__('Close', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-close"></span></a>
                            <a data-object_id="' . $object_id . '" class="cbxwpbkmarkaddnewcatcreate" href="#" title="' . esc_html__('Create Category', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-create"></span> Create</a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="cbxwpbkmarkmanagewrap">
                        <div class="cbxwpbkmarkmanageinputwrap">
                            <input required placeholder="' . esc_html__('Category Name', 'wholistic-matters') . '" type="text" name="cbxwpbkmarkmanagecatinput" class="cbxwpbkmarkmanagecatinput" />
                            <input required type="hidden" name="cbxwpbkmarkmanagecatid" class="cbxwpbkmarkmanagecatid" value="" />
                        </div>
                        <div class="cbxwpbkmarkmanageactionwrap">
                            <p class="cbxwpbkmarkmanageaction_error"> </p>
                            <div class="cbxwpbkmarkmanagecatselect cbxbookmarkmanage-switch-field">
                              <input type="radio" id="cbxbookmarkmanageswitch_left_' . $object_id . '" name="cbxbookmarkmanageswitch_' . $object_id . '" value="1" checked/>
                              <label for="cbxbookmarkmanageswitch_left_' . $object_id . '" title="' . esc_html__('Public Category', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-public"></span></label>
                              <input type="radio" id="cbxbookmarkmanageswitch_right_' . $object_id . '" name="cbxbookmarkmanageswitch_' . $object_id . '" value="0" />
                              <label for="cbxbookmarkmanageswitch_right_' . $object_id . '" title="' . esc_html__('Private Category', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-private"></span></label>
                            </div>

                            <a  class="cbxwpbkmarkmanagecatclose" href="#" title="' . esc_html__('Close', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-close"></span></a>
                            <a  class="cbxwpbkmarkmanagecatdelete" href="#" title="' . esc_html__('Delete', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-delete"></span></a>
                            <a data-object_id="' . $object_id . '" class="cbxwpbkmarkmanagecatcreate" href="#" title="' . esc_html__('Edit Catgory', 'wholistic-matters') . '"><span class="cbxwpbkmark-icon cbxwpbkmark-icon-create"></span> Update</a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <p class="cbxwpbkmarkloading" style="text-align: center;"><img src="' . plugins_url('../public/img/ajax-loader.gif', __FILE__) . '" alt="loading" title="' . esc_html__('loading categories', 'wholistic-matters') . '" /> </p>

              </div>
            ';

        endif;

        $cbxwpbkmark = '<div data-object_id="' . $object_id . '" class="cbxwpbkmarkwrap cbxwpbkmarkwrap-' . $object_type . ' '.$extra_wrap_class.'">' . $cbxwpbkmark . '</div>';
        
        return $cbxwpbkmark;
    }
endif;


if (!function_exists('WM_bookmarks_html')) {
        function WM_bookmarks_html($instance, $echo = false)
        {

                $limit   = isset($instance['limit']) ? intval($instance['limit']) : 10;
                $orderby = isset($instance['orderby']) ? esc_attr($instance['orderby']) : 'id';
                $order   = isset($instance['order']) ? esc_attr($instance['order']) : 'desc';
                $type    = isset($instance['type']) ? esc_attr($instance['type']) : ''; //object type(post types)


                $offset      = isset($instance['offset']) ? intval($instance['offset']) : 0;
                $catid       = isset($instance['catid']) ? intval($instance['catid']) : 0;
                $cattitle    = isset($instance['cattitle']) ? intval($instance['cattitle']) : 0; //Show category title
                $allowdelete = isset($instance['allowdelete']) ? intval($instance['allowdelete']) : 0;


                $userid_attr = isset($instance['userid']) ? intval($instance['userid']) : 0;

                $userid = 0;

                if ($userid_attr == 0) {
                        $userid = get_current_user_id(); //get current logged in user id
                } else {
                        $userid = $userid_attr;
                }


                if ($userid == 0 || (is_user_logged_in() && $userid != get_current_user_id())) {
                        $allowdelete = 0;
                        $privacy     = 1;
                }


                ob_start();
                ?>


                <?php
                if ($userid > 0) {

                        global $wpdb;

                        $object_types = WM_object_types(true); //get plain post type as array

                        $bookmark_table = W_M_BOOKMARK_TBL;

                        $cat_sql = '';

                        if ($catid != 0) {
                                $cat_sql = $wpdb->prepare(' AND cat_id = %d ', $catid);
                        }

                        if ($type == '') {
                                $param = array($userid, $offset, $limit);
                                $sql   = "SELECT *  FROM $bookmark_table  WHERE user_id = %d $cat_sql group by object_id  ORDER BY $orderby $order LIMIT %d, %d";
                        } else {
                                $param = array($userid, $type, $offset, $limit);
                                $sql   = "SELECT *  FROM $bookmark_table  WHERE user_id = %d $cat_sql AND object_type=%s group by object_id   ORDER BY $orderby $order LIMIT %d, %d";
                        }

                        $items = $wpdb->get_results($wpdb->prepare($sql, $param));


                        // checking If results are available
                        if ($items === null || sizeof($items) > 0) {

                                $post_types = get_post_types();

                                foreach ($items as $item) {

                                        if (in_array($item->object_type, $object_types)) {
                                                $action_html = ($allowdelete) ? '&nbsp; <a class="cbxbookmark-delete-btn cbxbookmark-post-delete" href="#" data-object_id="' . $item->object_id . '" data-object_type="' . $item->object_type . '" data-bookmark_id="' . $item->id . '"><span></span></a>' : '';
                                                echo '<li ><a href="' . get_permalink($item->object_id) . '">' . get_the_title($item->object_id) . '</a>' . $action_html . '</li>';

                                        } else {

                                        }

                                }
                        } else {

                                echo '<li>' . esc_html__('No bookmark found', 'wholistic-matters') . '</li>';

                        }
                } else {

                        $cbxbookmark_login_link = sprintf(__('Please <a href="%s">login</a> to view bookmarks', 'wholistic-matters'),
                                wp_login_url(get_permalink())
                        );

                        echo '<li>' . $cbxbookmark_login_link . '</li>';


                }

                ?>
                <?php

                $output = ob_get_clean();


                if ($echo) echo '<ul class="cbxwpbookmark-mylist">' . $output . '</ul>';
                else return $output;
        }
}


if (!function_exists('WM_bookmark_folders_html')) {
        function WM_bookmark_folders_html($instance, $echo = false)
        {

                global $wpdb;

                $privacy    = isset($instance['privacy']) ? intval($instance['privacy']) : 1;
                $orderby    = isset($instance['orderby']) ? $instance['orderby'] : 'cat_name';
                $order      = isset($instance['order']) ? $instance['order'] : 'asc';
                $show_count = isset($instance['show_count']) ? intval($instance['show_count']) : 0;
                $display    = isset($instance['display']) ? intval($instance['display']) : 0;


                $allowedit = isset($instance['allowedit']) ? intval($instance['allowedit']) : 0;

                $userid  = 0;
                $user_id = isset($instance['userid']) ? intval($instance['userid']) : 0;

                $userid = $user_id;


                if ($userid == 0) {
                        $userid = get_current_user_id(); //get current logged in user id
                }

                if (is_user_logged_in() && $userid == get_current_user_id() && $allowedit) {
                        $allowedit = 1;
                } else {
                        $allowedit = 0;
                }


                //either
                if ($userid == 0 || ($user_id > 0 && $user_id != get_current_user_id())) $privacy = 1;


                ob_start();
                ?>

                <?php

                if ($userid > 0) {

                        $bookmark_category_table = W_M_BOOKMARK_CAT_TBL;
                        $bookmark_table         = W_M_BOOKMARK_TBL;


                        // Getting Current User ID
                        //$userid = get_current_user_id();

                        // Checking the Type of privacy
                        // 2 means -- ALL -- Public and private both options in widget area

                        $privacy_sql = '';
                        if ($privacy != 2) {
                                $privacy_sql = $wpdb->prepare(' AND privacy = %d ', $privacy);
                        }


                        // Executing Query
                        $items = $wpdb->get_results(
                                $wpdb->prepare("SELECT *  FROM  $bookmark_category_table WHERE user_id = %d  $privacy_sql   ORDER BY $orderby $order", $userid)
                        );


                        $user_bookmark_page_url = WM_mybookmark_page_url();

                        $list_data_attr = '';

                        // Checking for available results
                        if ($items != null || sizeof($items) > 0) {
                                if ($display == 0) {
                                        foreach ($items as $item) {

                                                $cat_pernalink   = $user_bookmark_page_url;
                                                $show_count_html = '';


                                                $action_html = ($allowedit) ? '<a href="#" class="cbxbookmark-edit-btn" ></a> <a class="cbxbookmark-delete-btn" href="#" data-id="' . $item->id . '"><span></span></a>' : '';

                                                if ($show_count == 1) {
                                                        $count_query    = "SELECT count(*) as totalobject from $bookmark_table where cat_id = %d";
                                                        $num 			= $wpdb->get_var($wpdb->prepare($count_query, $item->id));

                                                        $show_count_html = '<i>(' . number_format_i18n($num) . ')</i>';
                                                }



                                                if ($allowedit) {
                                                        $list_data_attr = ' class="cbxbookmark-mycat-item" data-privacy="' . $item->privacy . '"  data-id="' . $item->id . '" data-name="' . $item->cat_name . '" ';
                                                }

                                                $cat_pernalink = add_query_arg( array('cbxbmcatid' => $item->id),  $cat_pernalink);

                                                echo '<li ' . $list_data_attr . '> <a href="' . $cat_pernalink . '" class="cbxlbjs-item-widget" data-privacy="' . $item->privacy . '">' . $item->cat_name . '</a>' . $show_count_html . $action_html . '</li>';
                                        }
                                        echo '<li> <a href="' . $user_bookmark_page_url . '" class="cbxlbjs-item-widget" >' . esc_html__('All', 'wholistic-matters') . '</a></li>';
                                } elseif ($display == 1) {
                                        $selected_wpbmcatid = (isset($_REQUEST["cbxbmcatid"])) ? $_REQUEST["cbxbmcatid"] : "'all'";
                                        echo '<select id="cbxlbjs-item-widget_dropdown" class="cbxlbjs-item-widget_dropdown"><option value="-1">' . esc_html__('Select Category', 'wholistic-matters') . '</option>';
                                        foreach ($items as $item) {

                                                $cat_pernalink   = $user_bookmark_page_url;
                                                if (strpos($cat_pernalink, '?') !== false) {
                                                        $cat_pernalink = $cat_pernalink . '&';
                    } else {
                                                        $cat_pernalink = $cat_pernalink . '?';
                    }

                                                $show_count_html = '';

                                                if ($show_count == 1) {


                                                        $count_query    = "SELECT count(*) as totalobject from $bookmark_table where cat_id = %d";
                                                        $num 			= $wpdb->get_var($wpdb->prepare($count_query, $item->id));

                                                        $show_count_html = ' <i>(' . number_format_i18n($num) . ')</i>';
                                                }

                                                echo '<option  class="cbxlbjs-item-widget" value = ' . $item->id . ' data-privacy="' . $item->privacy . '"> ' . $item->cat_name . $show_count_html . '</option>';
                                        }
                                        echo '<option value=\'all\'>' . esc_html__('All', 'wholistic-matters') . '</option>';
                                        echo '</select>';
                                        echo '<script type=\'text/javascript\'>
                            (function() {
                                var dropdown = document.getElementById( "cbxlbjs-item-widget_dropdown" );
                                var wpbmpage_url = "' . $cat_pernalink . '";
                                var selected_cat = ' . $selected_wpbmcatid . ';

                                function onwpbmCatChange() {
                                    if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
                                        location.href = wpbmpage_url + "cbxbmcatid=" + dropdown.options[ dropdown.selectedIndex ].value;
                                    }else if( dropdown.options[ dropdown.selectedIndex ].value == "all"){
                                        location.href = wpbmpage_url;
                                    }
                                }

                                if(selected_cat > 0){
                                    dropdown.value = selected_cat;
                                }else{
                                    dropdown.options[0].value;
                                }

                                dropdown.onchange = onwpbmCatChange;
                            })();
                     </script>';
                                }

                        } else {
                                ?>
            <li><?php esc_html_e('No category found.', 'wholistic-matters'); ?> </li>
                                <?php
                        }
                } else {

                        $cbxbookmark_login_link = sprintf(__('Please <a href="%s">login</a> to view Category', 'wholistic-matters'),
                                wp_login_url($user_bookmark_page_url)
                        );

                        echo '<li>' . $cbxbookmark_login_link . '</li>';


                } ?>

                <?php

                $output = ob_get_clean();


                if ($echo) echo '<ul class="cbxbookmark-category-list">' . $output . '</ul>';
                else return $output;
        }
}

if (!function_exists('WM_bookmark_popular_html')) {
        function WM_bookmark_popular_html($instance, $attr = array(), $echo = false)
        {

                global $wpdb;

                $limit      = isset($instance['limit']) ? intval($instance['limit']) : 10;
                $daytime    = isset($instance['daytime']) ? intval($instance['daytime']) : 0;
                $orderby    = isset($instance['orderby']) ? esc_attr($instance['orderby']) : 'object_id';
                $order      = isset($instance['order']) ? esc_attr($instance['order']) : 'desc';
                $type       = isset($instance['type']) ? esc_attr($instance['type']) : '';
                $show_count = isset($instance['show_count']) ? intval($instance['show_count']) : 1;
                $show_thumb = isset($instance['show_thumb']) ? intval($instance['show_count']) : 0;

                $ul_class = isset($attr['ul_class']) ? $attr['ul_class'] : '';
                $li_class = isset($attr['li_class']) ? $attr['li_class'] : '';


                $thumb_size = 'thumbnail';
                $thumb_attr = array();


                $daytime = (int)$daytime;
                ob_start();
                ?>

    <ul class="cbxwpbookmark-mostlist <?php echo $ul_class; ?>">
                        <?php

                                global $wpdb;

                                $bookmark_table = W_M_BOOKMARK_TBL;

                                // Getting Current User ID
                                $userid = get_current_user_id();
                                $time   = "";

                                $datetime = "";
                                if ($daytime != '0' || !empty($daytime)) {
                                        $time     = date('Y-m-d H:i:s', strtotime('-' . $daytime . ' day'));
                                        $datetime = " created_date > '$time' ";
                                }

                                $sql = '';

                                if ($type == '') {
                                        $param     = array($limit);
                                        $where_sql = ($datetime != '') ? ' WHERE ' : '';
                                        if ($orderby == 'object_type') {
                                                $sql = "SELECT count(object_id) as totalobject, object_id, object_type FROM  $bookmark_table $where_sql $datetime group by object_id order by $orderby $order,count(object_id) $order LIMIT %d";
                                        } elseif ($orderby == 'object_count') {
                                                $sql = "SELECT count(object_id) as totalobject, object_id, object_type FROM  $bookmark_table $where_sql $datetime group by object_id order by COUNT(object_id) $order LIMIT %d";
                                        } else {
                                                $sql = "SELECT count(object_id) as totalobject, object_id, object_type FROM  $bookmark_table $where_sql $datetime group by object_id order by $orderby $order LIMIT %d";
                                        }

                                } else {
                                        $param   = array($type, $limit);
                                        $and_sql = ($datetime != '') ? ' AND ' : '';
                                        if ($orderby == 'object_type') {
                                                $sql = "SELECT count(object_id) as totalobject, object_id, object_type FROM  $bookmark_table WHERE object_type = %s $and_sql $datetime group by object_id order by $orderby $order,count(object_id) $order LIMIT %d";
                                        } elseif ($orderby == 'object_count') {
                                                $sql = "SELECT count(object_id) as totalobject, object_id, object_type FROM  $bookmark_table WHERE object_type = %s $and_sql $datetime group by object_id order by count(object_id) $order LIMIT %d";
                                        } else {
                                                $sql = "SELECT count(object_id) as totalobject, object_id, object_type FROM  $bookmark_table WHERE object_type = %s $and_sql $datetime group by object_id order by $orderby $order LIMIT %d";
                                        }
                                }


                                $items = $wpdb->get_results(
                                        $wpdb->prepare($sql, $param)
                                );

                                // Checking for available results
                                if ($items != null || sizeof($items) > 0) {

                                        foreach ($items as $item) {

                                                $thumb_html = '';
                                                if ($show_thumb) {
                                                        if (has_post_thumbnail($item->object_id)) {
                                                                $thumb_html = get_the_post_thumbnail($item->object_id, $thumb_size, $thumb_attr);
                                                        } elseif (($parent_id = wp_get_post_parent_id($item->object_id)) && has_post_thumbnail($parent_id)) {
                                                                $thumb_html = get_the_post_thumbnail($parent_id, $thumb_size, $thumb_attr);
                                                        }
                                                }


                                                $show_count_html = ($show_count == 1) ? '<i>(' . $item->totalobject . ')</i>' : "";
                                                echo '<li class="cbxwpbookmark-widget-list ' . $li_class . '" >';
                                                echo '<a href="' . get_permalink($item->object_id) . '">';
                                                echo ($show_thumb) ? $thumb_html : '';
                                                echo get_the_title($item->object_id) . $show_count_html;
                                                echo '</a>';

                                                echo '</li>';

                                        }
                                } else {
                                        echo '<li class="cbxwpbookmark-widget-list ' . $li_class . '">' . esc_html__("No item found", "wholistic-matters") . '</li>';
                                }
                        ?>
    </ul>
                <?php

                $output = ob_get_clean();

                if ($echo) echo $output;
                else return $output;
        }//end method WM_bookmark_popular_html
}//end method exists WM_bookmark_popular_html


if(!function_exists('get_author_WM_url')){

        function get_author_WM_url($author_id = 0){
                $author_id = absint($author_id);
                if($author_id == 0) return '';
                $get_author_WM_url = WM_mybookmark_page_url();


                $get_author_WM_url = add_query_arg( 'userid', $author_id, $get_author_WM_url );

                return apply_filters('get_author_WM_url', $get_author_WM_url);

        }

}//end method exists get_author_WM_url

if(!function_exists('WM_mybookmark_page_url')){
    /**
     * Get mybookmark page url
     *
     * @return false|string
     */
    function WM_mybookmark_page_url(){
        $mybookmark_page_url = '#';
        if(is_user_logged_in()){
            $user = wp_get_current_user();
            $mybookmark_page_url = get_logged_in_url($user);
        }
        return apply_filters('WM_mybookmark_page_url', $mybookmark_page_url);
    }//end method WM_mybookmark_page_url
}//end method exists WM_mybookmark_page_url

