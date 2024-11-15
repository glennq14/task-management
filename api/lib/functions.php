<?php

function debug($param) {
    echo "<pre>";
    var_dump($param);
    exit;
}

function pr($param) {
    echo "<pre>";
    print_r($param);
    exit;
}

function header_json_encode($data)
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}

function is_api_on_request() {
    // pr($_REQUEST);
}

function require_files ($dir) {
    if ( $hundle = opendir($dir) ) {
        while (false !== ($file = readdir($hundle)) ) {
            if ( 
                $file != '.'
                && $file != '..'
                && $file != 'index.php'
            ) {
                require_once $dir . '/' . $file;
            }
        }
        closedir($hundle);
    }
}

function check_URI() {
    $uri = explode('/', $_SERVER['REQUEST_URI']);

    if ( 
        $uri[1] !== 'api' 
        || (isset($uri[2]) && $uri[2] == '')
    ) {
        die('Invalid request!');
    }
}

function get_put_form_data() {
    $put       = [];
    $formData  = json_encode(file_get_contents('php://input'));
    $key       = substr($formData, 1, 52);
    $accParams = explode($key, $formData); 
    array_shift($accParams);
    // array_pop($accParams);
    foreach ( $accParams as $item ) {
        $start = ' name=\"';
        $end   = '\"\r\n\r\n';
        
        // get the key
        $start_pos  = strpos($item, $start) + strlen($start);
        $end_pos    = strpos($item, $end);
        $key        = substr($item, $start_pos, ($end_pos - $start_pos));

        //get the value
        $endValue   = '\r\n';
        $value = substr($item, $end_pos + strlen($end), -strlen($endValue));
        if ( strpos($value, $endValue) ) {
            $val = explode($endValue, $value);
            $value = $val[0];
        }
        $put[$key]  = $value;
    }
    return $put;
}