<div class="float-left">
    <h1 class="h2"><?= $projectName ?></h1>
</div>

<?php
if (isset($_GET["projectId"])) {
    echo "<div class=\"float-right\">
            <form method=\"post\" class=\"float-right\">
                <input class=\"btn btn-primary\" type=\"submit\" name=\"edit\" value=\"Edit\"/>
            </form>
        </div>";
}
?>
<br>
<br>
<hr>
<div class="container">
    <div class="col-md-12">
        <div class="list-group">
            <?php
            if ($projectContent->num_rows > 0) {
                while ($row = $projectContent->fetch_assoc()) {
                    $taskId = $row["task_id"];
                    $taskName = $row["name"];
                    $taskDueDate = $row["due_date"];
                    $taskPriority = $row["priority"];

                    $editUrl = "index.php?" . pageKey . "=" . pageIdEditTask . "&taskId=$taskId";

                    echo "<a href=\"$editUrl\" class=\"list-group-item list-group-item-action flex-column align-items-start todo-list-gap\">";
                    echo "<div class=\"d-flex w-100 justify-content-between\">";
                    echo "<h5 class=\"mb-1\">$taskName</h5>";
                    echo "<small>$taskDueDate</small>";
                    echo "</div>";
                    echo "<h7>$taskPriority</h7>";
                    echo "</a>";
                    echo "<form method='post'><input type='hidden' name='taskId' value='$taskId'/><input class=\"btn btn-success btn-lg btn-block btn-sm\" name='Complete' value='Complete' type='submit' /></form>";
                }
            }
            ?>
        </div>
        <hr>
        <div class="list-group">
            <?php
            if ($projectCompleteContent->num_rows > 0) {
                while ($row = $projectCompleteContent->fetch_assoc()) {
                    $taskId = $row["task_id"];
                    $taskName = $row["name"];
                    $taskDueDate = $row["due_date"];
                    $taskPriority = $row["priority"];

                    echo "<div class=\"list-group-item flex-column align-items-start todo-list-gap todo-list-completed\">";
                    echo "<div class=\"d-flex w-100 justify-content-between\">";
                    echo "<h5 class=\"mb-1\">$taskName</h5>";
                    echo "<small>$taskDueDate</small>";
                    echo "</div>";
                    echo "<small>$taskPriority</small>";
                    echo "</div>";
                    echo "<form method='post'><input type='hidden' name='taskId' value='$taskId'/><input class=\"btn btn-secondary btn-lg btn-block btn-sm\" name='Incomplete' value='Incomplete' type='submit' /></form>";
                }
            }
            ?>
        </div>
    </div>
</div>


