<?php
$projectContent = $projectCompleteContent = $projectName = NULL;

/**
 * When the user hits the update/delete button
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update
    if (array_key_exists('edit', $_POST)) {
        $url = "index.php?" . pageKey . "=" . pageIdEditProject . "&projectId=" . sanitizeInput($_GET['projectId']);
        header("location: $url");
    }

    if (array_key_exists('Complete', $_POST)) {
        $taskId = sanitizeInput($_POST["taskId"]);
        if (isTaskOfUser($conn, $_SESSION["userId"], $taskId)) {
            completeTask($conn, $taskId);
        }
    }

    if (array_key_exists('Incomplete', $_POST)) {
        $taskId = sanitizeInput($_POST["taskId"]);
        if (isTaskOfUser($conn, $_SESSION["userId"], $taskId)) {
            incompleteTask($conn, $taskId);
        }
    }
}

/**
 * Gets project content
 */
if (isset($_GET["projectId"])) {
    $projectId = sanitizeInput($_GET["projectId"]);
    $projectData = getProjectById($conn, $_SESSION["userId"], $projectId);
    $projectName = $projectData["name"];

    $projectContent = getTasksFromProject($conn, $_SESSION["userId"], $projectId);
    $projectCompleteContent = getCompleteTasksFromProject($conn, $_SESSION["userId"], $projectId);
} else {
    $projectName = "Inbox";
    $projectContent = getInboxTasks($conn, $_SESSION["userId"]);
    $projectCompleteContent = getCompleteInboxTasks($conn, $_SESSION["userId"]);
}