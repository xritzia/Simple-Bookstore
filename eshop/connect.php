<?php
// Database connection
DEFINE ('DB_USER', 'bookadmin');
DEFINE ('DB_PASSWORD', 'kod12345');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'bookdb');

$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
?>