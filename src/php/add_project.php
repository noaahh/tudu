<?php
/**
 * Adds a project
 */
$projectName = NULL;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectName = isset($_POST["projectName"]) ? sanitizeInput($_POST["projectName"]) : NULL;
    insertProject($conn, $_SESSION["userId"], $projectName);

    header("location: index.php");
}
