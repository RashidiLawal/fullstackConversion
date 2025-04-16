
<?php
// Database configuration
const DB_HOST = 'localhost';
const DB_USER = 'root'; // default XAMPP MySQL username
const DB_PASS = '';  // Default XAMPP MySQL password is empty
const DB_NAME = 'places_app';

// Application configuration
const SITE_URL = 'http://localhost/places-app/public';
const APP_NAME = 'Places App';

// Session configuration
session_start();

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
 