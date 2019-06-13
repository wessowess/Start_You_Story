<?php
try {
	$serveur = "localhost";
	$db = "start_your_story_db";
	$user = "root";
	$pwd = "";
	$conn_pdo = new PDO("mysql:host=$serveur;dbname=$db;charset=utf8", $user, $pwd);
	$conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage() . "<br>";
}