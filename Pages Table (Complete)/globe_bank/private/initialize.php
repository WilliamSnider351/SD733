<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start(); // output buffering is turned on

// Assign file paths to PHP constants
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Define the root URL dynamically based on current script location
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

// Database credentials - adjust these if your setup is different
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");  // Change if your MySQL password is different
define("DB_NAME", "globe_bank");

// Connect to database and store connection in $db variable
$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check connection and stop script if it fails
if (!$db) {
  die("Database connection failed: " . mysqli_connect_error());
}

// Include additional functions
require_once('functions.php');
?>
