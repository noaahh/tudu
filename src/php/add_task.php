<?php
$taskName = $taskPriority = $taskProject = $taskDueDate = $taskComment = NULL;

/**
 * Stores the data after a POST request
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskName = isset($_POST["taskName"]) ? $_POST["taskName"] : NULL;
    $taskPriority = isset($_POST["taskPriority"]) ? sanitizeInput($_POST["taskPriority"]) : NULL;
    $taskProject = isset($_POST["taskProject"]) ? sanitizeInput($_POST["taskProject"]) : NULL;
    $taskDueDate = isset($_POST["taskDueDate"]) ? sanitizeInput($_POST["taskDueDate"]) : NULL;
    $taskComment = isset($_POST["taskComment"]) ? sanitizeInput($_POST["taskComment"]) : NULL;

    // When the Inbox project is selected
    if ($taskProject == -1) {
        $taskProject = NULL;
    }

    // Checks for a valid date
    if (!validateDate($taskDueDate)) {
        $taskDueDate = NULL;
    }

    // Inserts task into db
    insertTask($conn, $_SESSION["userId"], $taskName, $taskPriority, $taskProject, $taskDueDate, $taskComment);

    // Redirect
    $url = "index.php";
    if ($taskProject != NULL) {
        $url = "index.php?" . pageKey . "=" . pageIdInbox . "&projectId=$taskProject";
    }

    header("location: $url");
}
