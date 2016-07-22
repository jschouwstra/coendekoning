<?php


if( $_SERVER['SERVER_NAME'] !== '127.0.0.1' ) {

	//Production server login
	// define('DB_SERVER', 'srv042063.webreus.net');
	define('DB_SERVER', 'localhost');
	// define('DB_USERNAME', 'cjdekoning');
	define('DB_USERNAME', 'c13044jelle_dev');
	define('DB_PASSWORD', 'GpXir5_3');
	// define('DB_PASSWORD', 'ZuwjW=aiTq');
	define('DB_DATABASE', '4924_coendekonincom_website');
	// define('DB_DATABASE', 'coendekonincom_website');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	if (mysqli_connect_errno()){
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

}
else {
	//Development server login
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'coen');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	if (mysqli_connect_errno()){
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
}


?>