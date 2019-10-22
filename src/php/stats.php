<?php
/**
 * Gets stats of the current user
 */
$userFirstName = $userLastName = $userKarma = $userCountTasks = $userCountProjects = NULL;

$userResult = getUserById($conn, $_SESSION["userId"]);
$userFirstName = $userResult["first_name"];
$userLastName = $userResult["last_name"];
$userKarma = $userResult["karma"];

$userCountTasks = getCountOfTasksByUser($conn, $_SESSION["userId"]);
$userCountProjects = getCountOfProjectsByUser($conn, $_SESSION["userId"]);