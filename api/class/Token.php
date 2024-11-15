<?php
namespace App\Class;

class Token
{
    public function __construct()
    {
        $token = $this->getBearerToken();

        if ( ! $token || $token !== getenv('API_KEY')) {
            die('Invalid Request!. Valid token required.');
        } else {
            return;
        }
    }

    public function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    private function getAuthorizationHeader()
    {
        $headers = null;
        if ( isset($_SERVER['Authorization']) ) {
            $headers = trim($_SERVER["Authorization"]);
        }

        else if ( isset($_SERVER['HTTP_AUTHORIZATION']) ) {
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif ( function_exists('apache_request_headers') ) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if ( isset($requestHeaders['Authorization']) ) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        return $headers;
    }
}
