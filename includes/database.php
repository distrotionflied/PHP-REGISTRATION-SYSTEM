<?php

$hostname = $env['DB_HOST'];
$username = $env['DB_USER'];
$password = $env['DB_PASS'];
$dbName   = $env['DB_NAME'];

$conn = new mysqli($hostname, $username, $password, $dbName);

function getConnection(): mysqli
{
    global $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// database functions ต่างๆ
require_once DATABASES_DIR . '/students.php';
require_once DATABASES_DIR . '/courses.php';
require_once DATABASES_DIR . '/enrollment.php';
require_once DATABASES_DIR . '/data-relation.php';