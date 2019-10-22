<?php
$projectName = NULL;

/**
 * When the user hits the update/delete button
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete
    if (array_key_exists('delete', $_POST)) {
        $projectId = sanitizeInput($_GET["projectId"]);

        removeProjectDependencies($conn, $projectId);
        deleteProject($conn, $projectId);
        header("location: index.php");
    }

    // Update
    if (array_key_exists('update', $_POST)) {
        $projectName = isset($_POST["projectName"]) ? sanitizeInput($_POST["projectName"]) : NULL;

        updateProject($conn, sanitizeInput($_GET["projectId"]), $projectName);
        header("location: index.php");
    }
}

/**
 * Fill the form with the task referenced in the GET parameter
 */
if (isset($_GET["projectId"])) {
    $projectId = sanitizeInput($_GET["projectId"]);

    /**
     * Checks if the project referenced in the GET parameter belongs to the user.
     * Otherwise the user will be redirected
     */
    if (isProjectOfUser($conn, $_SESSION["userId"], $projectId)) {
        $taskResult = getProjectById($conn, $_SESSION["userId"], $projectId);

        if ($taskResult->num_rows > 0) {
            $row = $taskResult->fetch_assoc();
            $projectName = $row["name"];
        }
    } else {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}

