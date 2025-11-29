<?php
// Database connection configuration template
// Rename this file to 'db.php' and update with your actual credentials

$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database_name";

$dbcon = mysqli_connect($servername, $username, $password, $database);

if (!$dbcon) {
  die("Connection failed: " . mysqli_connect_error());
}

// UTF-8 support for international characters
mysqli_set_charset($dbcon, "utf8mb4");

// Sanitize user input to prevent SQL injection
function escape_input($dbcon, $input)
{
  return isset($input) ? mysqli_real_escape_string($dbcon, $input) : '';
}
