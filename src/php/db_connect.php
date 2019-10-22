<?php
define("dbServerAddress", "localhost");
define("dbUsername", "root");
define("dbPassword", "");
define("dbName", "tudu");

$conn = getDbConnection();

/**
 * @return mysqli The established DB connection
 */
function getDbConnection()
{
    $conn = new mysqli(dbServerAddress, dbUsername, dbPassword, dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}