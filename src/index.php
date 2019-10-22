<?php
session_start();
include("php/db_connect.php");
include("php/database_helper.php");
include("php/helper.php");

// Constants
define("pageKey", "id");
define("pageIdProject", "project");
define("pageIdEditProject", "editProject");
define("pageIdAddTask", "addTask");
define("pageIdEditTask", "editTask");
define("pageIdAddProject", "addProject");
define("pageIdTaskDone", "done");
define("pageIdLogin", "login");
define("pageIdRegister", "register");
define("pageIdStats", "stats");

// Key which indicates a reference to a specific site
$pageKey = NULL;

// Redirection to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $pageKey = isset($_REQUEST[pageKey]) ? $_REQUEST[pageKey] : NULL;

    // Register page and the login page are allowed
    if ($pageKey !== pageIdLogin && $pageKey !== pageIdRegister) {
        $pageKey = pageIdLogin;
    }
} else {
    $pageKey = isset($_REQUEST[pageKey]) ? $_REQUEST[pageKey] : NULL;
}

/**
 * Switch for the page ID's
 */
$content = NULL;
switch ($pageKey) {
    default:
    case pageIdProject:
        include("php/project.php");
        $content = "html/project.htm.php";
        break;
    case pageIdAddTask:
        include("php/add_task.php");
        $content = "html/add_task.htm.php";
        break;
    case pageIdEditTask:
        include("php/edit_task.php");
        $content = "html/edit_task.htm.php";
        break;
    case pageIdAddProject:
        include("php/add_project.php");
        $content = "html/add_project.htm.php";
        break;
    case pageIdEditProject:
        include("php/edit_project.php");
        $content = "html/edit_project.htm.php";
        break;
    case pageIdTaskDone:
        include("php/done_task.php");
        $content = "html/inbox.htm.php";
        break;
    case pageIdRegister:
        include("php/register.php");
        include("html/register.htm.php");
        break;
    case pageIdLogin:
        include("php/login.php");
        include("html/login.htm.php");
        break;
    case pageIdStats:
        include("php/stats.php");
        $content = "html/stats.htm.php";
        break;
}

// Possible sites when no user is logged in
if ($pageKey != pageIdRegister && $pageKey != pageIdLogin) {
    include("html/index.htm.php");
}