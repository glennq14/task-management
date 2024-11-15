<?php
require_once __DIR__ . '/loadenv.php';

use App\Lib\LoadEnv;

$env_file_path = realpath($appdir. '/.env');

if ( ! is_file( $env_file_path ) ) {
    die("Environment File is Missing.");
}

(new LoadEnv($env_file_path))->init();
