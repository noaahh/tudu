<div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Hello, <?php echo $userFirstName . " " . $userLastName; ?></h1>
        <p>On this page you can see your personal like the number of completed tasks and your karma score.</p>
    </div>
</div>

<div class="container">
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Tasks</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title"><?= $userCountTasks ?></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Completed tasks</li>
                </ul>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Karma</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title"><?= $userKarma ?></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Karma points</li>
                </ul>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Projects</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title"><?= $userCountProjects ?></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Active projects</li>
                </ul>
            </div>
        </div>
    </div>
