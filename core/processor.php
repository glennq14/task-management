<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "loader.php";
require_once "curl.php";

$url = getenv('APP_URL');

if ( isset($_POST['action']) || isset($_GET['action']) ) {
    $response = "";
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                unset($_POST['action']);
                $response = request('/task', 'POST', $_POST);
                break;
            case 'edit':
                unset($_POST['action']);
                $response = request('/task/' . $_GET['id'], 'PUT', $_POST);
                break;
        }
    } else {
        if ( $_GET['action'] == 'delete' && isset($_GET['id']) ) {
            $response = request('/task/' . $_GET['id'], 'DELETE', $_POST);
        }
    }

    //saving api response to session
    session_start();
    $_SESSION['API_RESPONSE'] = $response;
    header("Location: {$url}");
}

if ( isset($_GET['id']) ) {
    $tasks = request('/task/' . $_GET['id'], 'GET');
} else {
    $apiResponse = null;
    if ( isset($_SESSION['API_RESPONSE']) ) {

        //populate api response to session
        session_start();
        $apiResponse = $_SESSION['API_RESPONSE'];
        session_destroy();
    }
    
    $tasks = request('/task', 'GET');
}
