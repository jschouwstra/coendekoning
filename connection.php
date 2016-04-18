<?php


if( $_SERVER['SERVER_NAME'] !== '127.0.0.1' ) {

	//Production server login
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'cjdekoning');
	define('DB_PASSWORD', 'ZuwjW=aiTq');
	define('DB_DATABASE', 'coendekonincom_website');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	// //Test server login
	// define('DB_SERVER', 'localhost');
	// define('DB_USERNAME', 'jelleschouwstra');
	// define('DB_PASSWORD', 'EB.*+_}xhWzv');
	// define('DB_DATABASE', 'jellesch_coen');
	// $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
}
else {
	//Development server login
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'coen');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
}


?>