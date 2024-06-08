<?php
ob_start();
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Database Configuration
$dbhost = 'localhost';
$dbname = 'fyp';
$dbuser = 'root';
$dbpass = '';

// define('PRODUCT_VERSION', '1.0.0');


//Database Connection
try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	// echo 'database not connect';
	echo "Connection Error: " . $exception->getMessage();
	die();
}

// Trace General Setting
$setting_statement = $pdo->prepare('SELECT * FROM tbl_settings');
$setting_statement->execute();
// $count = $statement->rowCount();
$setting_statement_results = $setting_statement->fetch();
// Trace General Setting

// SMTP
$smtp_statement = $pdo->prepare('SELECT * FROM tbl_smtp');
$smtp_statement->execute();
$smtp_statement_results = $smtp_statement->fetch();
// SMTP

// Paypal
 
// Paypal

session_start();
?>