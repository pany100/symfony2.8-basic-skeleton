<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

use Symfony\Component\HttpFoundation\Request;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../app/bootstrap.php.cache';
if ( isset($_SERVER['SERVER_ADDR']) && ($_SERVER['SERVER_ADDR'] == '127.0.0.1')) {
  $kernel = new AppKernel('local', true); //Change to to true to debug mode
} else {
  switch ($_SERVER['BASE']) {
    case '/lpaniagua/sony_dev':
      $kernel = new AppKernel('development', true);
      break;
    default:
      $kernel = new AppKernel('prod', false);
  }  
}
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
