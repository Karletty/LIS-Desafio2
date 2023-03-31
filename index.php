<?php
include_once 'Core/config.php';
include_once 'Core/error404.php';

session_start();

$url = $_SERVER['REQUEST_URI'];
define('BASEPATH', true);

$url = explode('/', $url);

$controller = (empty($url[2]) ? 'Products' : $url[2]) . 'Controller';
$fileController = 'Controller/' . $controller . '.php';


if (!is_file($fileController)) {
      renderError404View();
      exit;
}

spl_autoload_register(function ($classname) {
      include_once 'Controller/' . $classname . '.php';
});

$contr = new $controller;
$method = empty($url[3]) ? "index" : $url[3];

if (!method_exists($contr, $method)) {
      renderError404View();
      exit;
}

$param = empty($url[4]) ? "" : $url[4];

$contr->$method($param);
