<?php

// get the URI request
$request_uri = explode('?', $_SERVER['REQUEST_URI'],2);

switch ($request_uri[0]) {
    //home page
    case '/':
        require '../views/home.php';
        break;
    //about page
    case '/about.php':
        require '../views/about.php';
        break;
    //anyother request
    default:
        header('HTTP/1.0 404 Not Found');
        require '../views/404.php';
        break;

}

// do a switch case about url