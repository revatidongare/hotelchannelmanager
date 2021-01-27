<?php 
	$user='root';
	$pass='';
     $dbname='hotel_db';
	
$conn = new PDO('mysql:host=localhost;dbname=hotel_db', $user, $pass);
	if (!$conn) {
		die("Connection failed: " . $conn->connect_error);
	}
  	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  	?>