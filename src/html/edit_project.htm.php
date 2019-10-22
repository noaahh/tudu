<form method="post">
    <div class="form-group">
        <label for="projectName">Name</label>
        <input value="<?= $projectName ?>" required type="text" name="projectName" class="form-control" placeholder="Enter project name">
    </div>
    <input type="submit" class="btn btn-primary float-left" style="margin-left: 10px" name="update" class="btn btn-primary" value="Update" />
</form>
<form method="post">
    <input class="btn btn-danger float-left" style="margin-left: 10px" type="submit" name="delete" value="Delete" />
</form>
