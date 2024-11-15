<?php
require_once __DIR__ . '/loadenv.php';

use App\Lib\LoadEnv;

$env_file_path = $_SERVER['DOCUMENT_ROOT'] . '.env';

(new LoadEnv($env_file_path))->init();
