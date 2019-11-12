<?php
header('Access-Control-Allow-Origin: *');

class APIRequest {
    function __construct() {
        $this->api_key = getenv('MC_API_KEY');
//        $this->method = $_GET['method'];
//        $this->url = $_GET['url'];
//        $this->data = $_GET['data'];

        $this->method = "PUT";
        $this->url = "https://us16.api.mailchimp.com/3.0/lists/b70bf5059b/members/0b5e9bc08f15acf6a5697b926cedcc94";
        $this->data = array(
            'email_address' => 'devon@known-creative.com',
            'merge_fields' => array(
                'FNAME' => 'its wooorking'
            )
        );

        // Filter request type
        $data = $this->get_curl_request();

        // Return json string to ajax
        echo json_encode($data);
    }

//    function filter_request() {
//        $data = new stdClass();
//
//        switch($this->request_type) {
//            case 'get_contacts':
//                $data->contacts = $this->get_curl_request( $this->build_url('get_contacts') );
//                break;
//            case 'get_contact_by_email':
//                $data->contact = $this->get_curl_request( $this->build_url('get_contact_by_email') );
//                break;
//            case 'get_contact_search' :
//                $data->contacts = $this->get_curl_request( $this->build_url('get_contact_search') );
//                break;
//            case 'get_table_rows_by_id':
//                $data->rows = $this->get_curl_request( $this->build_url('get_table_rows_by_id') );
//                break;
//            case 'get_global_search':
//                $search = $this->get_curl_request( $this->build_url('get_global_search') );
//                $contacts = $this->get_curl_request( $this->build_url('get_contact_search') );
//                if( json_decode($search)->total > 0) {
//                    $data->search = $search;
//                }
//                if( json_decode($contacts)->total > 0) {
//                    $data->contacts = $contacts;
//                }
//                break;
//            case 'get_route_with_filters':
//                $routes = $this->get_curl_request($this->build_url('get_route_with_filters') );
//                if(json_decode($routes)->total > 0) {
//                    $data->routes = $routes;
//                }
//                break;
//        }
//
//        return $data;
//    }

    function get_curl_request() {
        $data_string = json_encode($this->data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSLVERSION, 4);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

//    function build_url($type) {
//        $url = 'https://api.hubapi.com';
//        $options = $this->options;
//
//        switch($type) {
//            case 'get_contacts':
//                $url .= '/contacts/v1/lists/all/contacts/all';
//                break;
//            case 'get_contact_by_email':
//                $url .= '/contacts/v1/contact/email/' . $this->email . '/profile';
//                break;
//            case 'get_table_rows_by_id':
//                $url .= '/hubdb/api/v2/tables/' . $this->table_id . '/rows';
//                break;
//            case 'get_global_search':
//                $url .= '/contentsearch/v2/search';
//                break;
//            case 'get_contact_search':
////                unset($options['term']);
//                $url .= '/contacts/v1/search/query/';
//                break;
//            case 'get_route_with_filters':
//                $url .= '/hubdb/api/v2/tables/' . $this->table_id . '/rows';
//                break;
//        }
//
//        $options = ($options) ? http_build_query($options) : NULL;
//
//        $url .= (!is_null($options)) ? '?' . $options . '&' : '?';
//        $url .= 'hapikey=' . $this->api_key;
//
//        return $url;
//    }
}

$apiData = new APIRequest;
?>