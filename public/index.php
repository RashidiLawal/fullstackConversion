<?php
require_once '../config/config.php';
require_once '../config/database.php';

// Simple router
$request = $_SERVER['REQUEST_URI'];
$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$path = str_replace($basePath, '', $request);

// Remove query string if present
$path = strtok($path, '?');

// Authentication check
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Route handling
switch ($path) {
    case '/':
        if (isLoggedIn()) {
            require '../src/users/pages/users.php';
        } else {
            header('Location: /auth');
        }
        break;
        
    case '/auth':
        if (!isLoggedIn()) {
            require '../src/users/pages/auth.php';
        } else {
            header('Location: /');
        }
        break;
        
    case '/places/new':
        if (isLoggedIn()) {
            require '../src/places/pages/new_place.php';
        } else {
            header('Location: /auth');
        }
        break;
        
    case (preg_match('/^\/(\d+)\/places$/', $path, $matches) ? true : false):
        $userId = $matches[1];
        require '../src/places/pages/user_places.php';
        break;
        
    case (preg_match('/^\/places\/(\d+)$/', $path, $matches) ? true : false):
        $placeId = $matches[1];
        if (isLoggedIn()) {
            require '../src/places/pages/update_place.php';
        } else {
            header('Location: /auth');
        }
        break;
        
    default:
        http_response_code(404);
        require '../src/shared/components/404.php';
        break;
}