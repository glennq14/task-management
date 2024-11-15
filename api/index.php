<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$appdir =  __DIR__;
require_once $appdir  .  '/lib/loader.php';
require_once $appdir  .  '/lib/functions.php';
require_once $appdir  .  '/lib/includes.php';

use App\Class\Task;
use App\Class\Token;

check_URI();
(new Token());
(new Task())->start();