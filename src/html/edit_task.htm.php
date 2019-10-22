<form method="post">
    <div class="form-group">
        <label for="taskName">Name</label>
        <input value="<?= $taskName ?>" required type="text" name="taskName" class="form-control"
               placeholder="Enter task name">
    </div>
    <div class="form-group">
        <label for="taskPriority">Priority</label>
        <select required name="taskPriority" class="form-control">
            <?php
            $priorities = getAllPriorities($conn);
            if ($priorities->num_rows > 0) {
                while ($row = $priorities->fetch_assoc()) {
                    $priorityId = $row["priority_id"];
                    $priorityName = $row["name"];
                    $priorityValue = $row["value"];

                    if ($priorityId === $taskPriority) {
                        echo "<option selected value='$priorityId'> $priorityName</option>";
                    } else {
                        echo "<option value='$priorityId'> $priorityName</option>";
                    }
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="taskProject">Project</label>
        <select name="taskProject" class="form-control">
            <?php
            $projects = getAllProjects($conn, $_SESSION["userId"]);
            if ($projects->num_rows > 0) {
                while ($row = $projects->fetch_assoc()) {
                    $projectId = $row["project_id"];
                    $projectName = $row["name"];

                    if ($projectId === $taskProject) {
                        echo "<option selected value='$projectId'>$projectName</option>";
                    } else {
                        echo "<option value='$projectId'>$projectName</option>";
                    }
                }
            }

            if ($taskProject === -1) {
                echo "<option selected value=\"\">Inbox</option>";
            } else {
                echo "<option value=\"\">Inbox</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="dueDate">Due date</label>
        <input value="<?= $taskDueDate ?>" type="date" name="taskDueDate" class="form-control">
    </div>
    <div class="form-group">
        <label for="taskComment">Comment</label>
        <textarea rows="5" name="taskComment" class="form-control" placeholder="You can enter a comment"><?= $taskComment ?></textarea>
    </div>
    <input type="submit" class="btn btn-primary float-left" style="margin-left: 10px" name="update" class="btn btn-primary" value="Update" />
</form>
<form method="post">
    <input class="btn btn-danger float-left" type="submit" style="margin-left: 10px" name="delete" value="Delete" />
</form>
