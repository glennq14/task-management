<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/pages/template/header.php';
$levels = importancies();
$statuses = statuses();
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-center">
            <h1 class="text-center">Task Management</h1>
            <form method="post" name="taskForm">
                <h3>View</h3>
                <div class="form-control">
                    <label>Name:</label>
                    <?php echo $tasks->data->name ?>
                </div>
                <div class="form-control">
                    <label>Description:</label>
                    <em><?php echo $tasks->data->description ?></em>
                </div>
                <div class="form-control">
                    <label for="Level">Importancy: </label>
                    <?php echo importancies($tasks->data->level); ?>
                </div>
                <div class="form-control">
                    <label for="Status">Status:</label>
                    <?php echo statuses($tasks->data->status) ?>
                </div>
                <div class="form-control">
                    <a href="../" class="btn btn-primary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'pages/template/footer.php';
?>