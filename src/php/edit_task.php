<?php
$taskName = $taskPriority = $taskProject = $taskDueDate = $taskComment = NULL;

/**
 * When the user hits the update/delete button
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete
    if (array_key_exists('delete', $_POST)) {
        deleteTask($conn, sanitizeInput($_GET["taskId"]));
        header("location: index.php");
    }

    // Update
    if (array_key_exists('update', $_POST)) {
        $taskName = isset($_POST["taskName"]) ? sanitizeInput($_POST["taskName"]) : NULL;
        $taskPriority = isset($_POST["taskPriority"]) ? sanitizeInput($_POST["taskPriority"]) : NULL;
        $taskProject = isset($_POST["taskProject"]) ? sanitizeInput($_POST["taskProject"]) : NULL;
        $taskDueDate = isset($_POST["taskDueDate"]) ? sanitizeInput($_POST["taskDueDate"]) : NULL;
        $taskComment = isset($_POST["taskComment"]) ? sanitizeInput($_POST["taskComment"]) : NULL;

        if (!validateDate($taskDueDate) || $taskDueDate === "0000-00-00") {
            $taskDueDate = NULL;
        }

        updateTask($conn, $_GET["taskId"], $taskName, $taskPriority, $taskProject, $taskDueDate, $taskComment);
        header("location: index.php");
    }
}

/**
 * Fill the form with the task referenced in the GET parameter
 */
if (isset($_GET["taskId"])) {
    $taskId = sanitizeInput($_GET["taskId"]);

    /**
     * Checks if the task referenced in the GET parameter belongs to the user.
     * Otherwise the user will be redirected
     */
    if (isTaskOfUser($conn, $_SESSION["userId"], $taskId)) {
        $taskResult = getTaskById($conn, $_SESSION["userId"], $taskId);

        if ($taskResult->num_rows > 0) {
            $row = $taskResult->fetch_assoc();

            // Fill the task data
            $taskName = $row["name"];
            $taskPriority = $row["priority"];
            $taskProject = $row["project"];
            $taskDueDate = $row["due_date"];
            $taskComment = $row["comment"];

            // Conversion of the NULL project to -1 (form)
            if (empty($taskProject) || is_null($taskProject)) {
                $taskProject = -1;
            }
        }
    } else {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}

