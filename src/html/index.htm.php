<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A simple lightweight Todo application">
    <meta name="author" content="Noah Leuenberger">
    <title>Tudu</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <link href="style/styles.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Tudu</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#logoutModal">Logout</button>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <span data-feather="home"></span>
                            Inbox
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?<?= pageKey ?>=<?= pageIdAddTask ?>">
                            <span data-feather="plus"></span>
                            Add task
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?<?= pageKey ?>=<?= pageIdAddProject ?>">
                            <span data-feather="plus"></span>
                            Add project
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?<?= pageKey ?>=<?= pageIdStats ?>">
                            <span data-feather="book"></span>
                            Stats
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Projects</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <?php
                    $projects = getAllProjectByUser($conn, $_SESSION["userId"]);
                    if ($projects->num_rows > 0) {
                        while ($row = $projects->fetch_assoc()) {
                            $name = $row["name"];
                            $id = $row["project_id"];

                            $url = "index.php?" . pageKey . "=" . pageIdProject . "&projectId=$id";
                            echo "<li class=\"nav-item\">";
                            echo "<a class=\"nav-link\" href=\"$url\">";
                            echo "<span data-feather=\"file-text\"></span>";
                            echo "$name";
                            echo "</a>";
                            echo "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <div class="col-md-12">
                    <?php include($content); ?>
                </div>
            </div>
        </main>

    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="php/logout.php" class="btn btn-primary">Yes</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

</body>
</html>
