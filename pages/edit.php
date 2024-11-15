<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/pages/template/header.php';
$levels = importancies();
$status = statuses();
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-center">
            <h1 class="text-center">Task Management</h1>
            <form method="post" name="taskForm">
                <h3>Edit</h3>
                <div class="form-control">
                    <label>Name:</label>
                    <input 
                        name="name" 
                        type="text" 
                        placeholder="Enter name" 
                        class="form-input" 
                        required value="<?php echo $tasks->data->name ?>"
                    >
                </div>
                <div class="form-control">
                    <label>Description:</label>
                    <textarea name="description" class="form-input" required rows="5"><?php echo $tasks->data->description ?></textarea>
                </div>
                <div class="form-control">
                    <label for="Level">Importancy: </label>
                    <select id="Level" name="level" class="form-select">
                        <?php foreach($levels as $key => $val) : ?>
                        <option value="<?php echo $key ?>" <?php echo ($key == $tasks->data->level)?'selected':'' ?>><?php echo $val ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="Status">Status:</label>
                    <select id="Status" name="status" class="form-select">
                    <?php foreach($status as $key => $val) : ?>
                        <option value="<?php echo $key ?>" <?php echo ($key == $tasks->data->status)?'selected':'' ?>><?php echo $val ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-control">
                    <a href="../" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="action" value="edit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . 'pages/template/footer.php';
?>