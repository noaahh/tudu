<?php
/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @param $projectId ID of the project
 * @return array|null The result set of the query
 */
function getProjectById($conn, $userId, $projectId)
{
    $query = "SELECT * FROM project
                WHERE project.user = $userId AND project.project_id = $projectId";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    return $data;
}

/**
 * @param $conn Db connection
 * @param $userId ID of the user
 * @return mixed The result set of the query
 */
function getInboxTasks($conn, $userId)
{
    $query = "SELECT task.task_id, task.name, priority.name AS priority, task.user, task.due_date, task.done
                FROM task
                INNER JOIN priority ON task.priority = priority.priority_id
                WHERE task.user = $userId AND task.done = FALSE AND task.project IS NULL
                ORDER BY task.due_date, priority.value";

    if ($result = $conn->query($query) === FALSE) {
        die("Query 'getInboxTasks' failed");
    }

    return $conn->query($query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @return mixed The result set of the query
 */
function getCompleteInboxTasks($conn, $userId)
{
    $query = "SELECT task.task_id, task.name, priority.name AS priority, task.user, task.due_date, task.done
                FROM task
                INNER JOIN priority ON task.priority = priority.priority_id
                WHERE task.user = $userId AND task.done = TRUE AND task.project IS NULL
                ORDER BY task.due_date, priority.value";

    if ($result = $conn->query($query) === FALSE) {
        die("Query 'getCompleteInboxTasks' failed");
    }

    return $conn->query($query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @param $projectId OD of the project
 * @return mixed The result set of the query
 */
function getTasksFromProject($conn, $userId, $projectId)
{
    $query = "SELECT task.task_id, task.name, priority.name AS priority, task.user, task.due_date, task.done, task.comment
                FROM project
                INNER JOIN task ON task.project = project.project_id
                INNER JOIN priority ON task.priority = priority.priority_id
                WHERE project.user = $userId AND task.user = $userId AND project.project_id = $projectId AND task.done = FALSE
                ORDER BY task.due_date, priority.value";

    if ($result = $conn->query($query) === FALSE) {
        die("Query 'getTasksFromProject' failed");
    }

    return $conn->query($query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @param $projectId ID of the project
 * @return mixed The result set of the query
 */
function getCompleteTasksFromProject($conn, $userId, $projectId)
{
    $query = "SELECT task.task_id, task.name, priority.name AS priority, task.user, task.due_date, task.done, task.comment
                FROM project
                INNER JOIN task ON task.project = project.project_id
                INNER JOIN priority ON task.priority = priority.priority_id
                WHERE project.user = $userId AND task.user = $userId AND project.project_id = $projectId AND task.done = TRUE
                ORDER BY task.due_date, priority.value";

    if ($result = $conn->query($query) === FALSE) {
        die("Query 'getCompleteTasksFromProject' failed");
    }

    return $conn->query($query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @param $taskId ID of the task
 * @return bool True when the task belongs to the referenced user
 */
function isTaskOfUser($conn, $userId, $taskId)
{
    $query = "SELECT * FROM task WHERE task_id = $taskId AND user = $userId";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        return true;
    }

    return false;
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @param $projectId ID of the project
 * @return bool True when the project belongs to the referenced user
 */
function isProjectOfUser($conn, $userId, $projectId)
{
    $query = "SELECT * FROM project WHERE project_id = $projectId AND user = $userId";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        return true;
    }

    return false;
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @param $taskId ID of the task
 * @return mixed The referenced task
 */
function getTaskById($conn, $userId, $taskId)
{
    $query = "SELECT task.name, task.priority, task.project, task.due_date, task.comment
                FROM task
                WHERE task.task_id = $taskId AND task.user = $userId";

    if ($result = $conn->query($query) === FALSE) {
        die("Query 'getTaskById' failed");
    }

    return $conn->query($query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @return array|null The referenced user
 */
function getUserById($conn, $userId)
{
    $query = "SELECT *
                FROM user
                WHERE user_id = $userId";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @return mixed The count of tasks by user
 */
function getCountOfTasksByUser($conn, $userId)
{
    $query = "SELECT COUNT(task_id) AS total
                FROM task
                WHERE user = $userId";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @return mixed The count of projects of the referenced user
 */
function getCountOfProjectsByUser($conn, $userId)
{
    $query = "SELECT COUNT(project_id) AS total
                FROM project
                WHERE user = $userId";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

/**
 * @param $conn DB connection
 * @return mixed Query result set with all priorities
 */
function getAllPriorities($conn)
{
    $query = "SELECT * FROM priority";

    if ($result = $conn->query($query) === FALSE) {
        die("Query 'getAllPriorities' failed");
    }

    return $conn->query($query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @return mixed Query result set with all projects
 */
function getAllProjects($conn, $userId)
{
    $query = "SELECT * FROM project WHERE user = $userId";

    if ($result = $conn->query($query) === FALSE) {
        die("Query 'getAllProjects' failed");
    }

    return $conn->query($query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @param $taskName Name of the task
 * @param $taskPriority Priortiy of the task
 * @param $taskProject Project of the task
 * @param $taskDueDate Due date of the task
 * @param $taskComment Comment of the task
 */
function insertTask($conn, $userId, $taskName, $taskPriority, $taskProject, $taskDueDate, $taskComment)
{
    $query = "INSERT INTO task (name, priority, project, due_date, user, comment)
                VALUES ('$taskName', '$taskPriority', '$taskProject', '$taskDueDate', '$userId', '$taskComment')";

    if ($taskProject == NULL) {
        $query = "INSERT INTO task (name, priority, due_date, user, comment)
                VALUES ('$taskName', '$taskPriority', '$taskDueDate', '$userId', '$taskComment')";
    }

    if ($taskDueDate == NULL) {
        $query = "INSERT INTO task (name, priority, project, user, comment)
                VALUES ('$taskName', '$taskPriority', '$taskProject', '$userId', '$taskComment')";
    }

    if ($taskDueDate == NULL && $taskProject == NULL) {
        $query = "INSERT INTO task (name, priority, user, comment)
                VALUES ('$taskName', '$taskPriority', '$userId', '$taskComment')";
    }

    mysqli_query($conn, $query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @param $projectName Name of the project
 */
function insertProject($conn, $userId, $projectName)
{
    $query = "INSERT INTO project (name, user)
                VALUES ('$projectName', '$userId')";

    mysqli_query($conn, $query);
}

/**
 * @param $conn DB connection
 * @param $taskId ID of the task
 * @param $taskName Name of the task
 * @param $taskPriority Priority of the task
 * @param $taskProject Project of the task
 * @param $taskDueDate Due date of the task
 * @param $taskComment Comment of the task
 */
function updateTask($conn, $taskId, $taskName, $taskPriority, $taskProject, $taskDueDate, $taskComment)
{
    $query = "UPDATE task
                SET name = '$taskName', priority = '$taskPriority', project = '$taskProject', due_date = '$taskDueDate', comment = '$taskComment'
                WHERE task_id = $taskId";

    if ($taskProject == NULL) {
        $query = "UPDATE task
                SET name = '$taskName', priority = '$taskPriority', due_date = '$taskDueDate', comment = '$taskComment', project = NULL
                WHERE task_id = $taskId";
    }

    if ($taskDueDate == NULL) {
        $query = "UPDATE task
                SET name = '$taskName', priority = '$taskPriority', project = '$taskProject', comment = '$taskComment', due_date = NULL
                WHERE task_id = $taskId";
    }

    if ($taskDueDate == NULL && $taskProject == NULL) {
        $query = "UPDATE task
                SET name = '$taskName', priority = '$taskPriority', comment = '$taskComment', project = NULL, due_date = NULL
                WHERE task_id = $taskId";
    }

    mysqli_query($conn, $query);
}

/**
 * @param $conn DB connection
 * @param $projectId ID of the project
 * @param $projectName Name of the project
 */
function updateProject($conn, $projectId, $projectName)
{
    $query = "UPDATE project
                SET name = '$projectName'
                WHERE project_id = $projectId";

    mysqli_query($conn, $query);
}

/**
 * @param $conn DB connection
 * @param $projectId ID of the project
 */
function removeProjectDependencies($conn, $projectId)
{
    $query = "UPDATE task
                SET project = NULL
                WHERE project = $projectId";

    mysqli_query($conn, $query);
}

/**
 * @param $conn DB connection
 * @param $taskId ID of the task
 */
function deleteTask($conn, $taskId)
{
    $query = "DELETE FROM task WHERE task_id = $taskId;";
    mysqli_query($conn, $query);
}

/**
 * @param $conn Db connection
 * @param $projectId ID of the project
 */
function deleteProject($conn, $projectId)
{
    $query = "DELETE FROM project WHERE project_id = $projectId;";
    mysqli_query($conn, $query);
}

/**
 * @param $conn DB connection
 * @param $userId ID of the user
 * @return mixed Query result with all projects
 */
function getAllProjectByUser($conn, $userId)
{
    $query = "SELECT * FROM project WHERE project.user = $userId";

    if ($result = $conn->query($query) === FALSE) {
        die("Query 'getAllProjectByUser' failed");
    }

    return $conn->query($query);
}

/**
 * @param $conn DB connection
 * @param $taskId ID of the task
 */
function completeTask($conn, $taskId)
{
    $query = "UPDATE task
                SET done = 1
                WHERE task_id = $taskId";
    mysqli_query($conn, $query);

    $query = "SELECT user.karma, user.user_id
                FROM task
                INNER JOIN user ON task.user = user.user_id
                WHERE task.task_id = $taskId";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    $userId = $data["user_id"];
    $karma = $data['karma'];
    $karma = $karma + 10;

    $query = "UPDATE user
                SET karma = '$karma'
                WHERE user_id = $userId";
    mysqli_query($conn, $query);
}

/**
 * @param $conn DB connection
 * @param $taskId ID of the task
 */
function incompleteTask($conn, $taskId)
{
    $query = "UPDATE task
                SET done = 0
                WHERE task_id = $taskId";

    mysqli_query($conn, $query);
}