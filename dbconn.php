<?php

$servername = "localhost";
$username = "eu_p_pro";
$password = "sC==f-s2ET7Cff";
$dbname = "eu_p_pro";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->query("SET NAMES UTF8");
?>