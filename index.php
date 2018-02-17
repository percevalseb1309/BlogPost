<?php
define('ENVIRONMENT', 'development'); // development|production
define('BASE_FOLDER', 'BlogPost/'); // project folder if exists
define('BASE_URL', 'http://'.$_SERVER["SERVER_NAME"].'/'.BASE_FOLDER);
define('DEFAULT_CONTROLLER', 'Home');

require_once(__DIR__. '/vendor/autoload.php');

require_once('framework/Autoloader.php'); 
use \OC\BlogPost\Framework\Autoloader;
Autoloader::register(); 

use \OC\BlogPost\Framework\App;

$app = new App();