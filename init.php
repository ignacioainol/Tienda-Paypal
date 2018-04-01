<?php

session_start();

try {
	$pdo = new PDO("mysql:host=localhost;dbname=db_paypal","root","root");
} catch (PDOException $error) {	
	exit('Error conectandose a la database');
}
