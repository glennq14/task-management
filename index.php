<?php
include_once 'pages/template/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-center">
            <h1>Task Management</h1>
            <a href="pages/add.php" class="btn btn-primary">Create</a>
            <br /><br />
            <?php if ($apiResponse) : ?>
            <div class="<?php echo $apiResponse->status ?>"><?php echo $apiResponse->message?></div>
            <?php endif; ?>
            <table id="taskList" class="table">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="40%">Name</th>
                        <th width="15%">Importancy</th>
                        <th width="15%">status</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($tasks->data as $task) :
                            $level = importancies($task->level);
                    ?>
                    <tr>
                        <td><?php echo $task->id ?></td>
                        <td><?php echo $task->name ?></td>
                        <td><span class="<?php echo strtolower($level) ?>"><?php echo $level ?></span></td>
                        <td><?php echo statuses($task->status) ?></td>
                        <td class="actions text-center">
                            <a href="pages/view.php?id=<?php echo $task->id ?>" class="view">View</a>
                            <a href="pages/edit.php?id=<?php echo $task->id ?>" class="edit">Edit</a>
                            <a href="?id=<?php echo $task->id ?>&action=delete" 
                                class="delete" 
                                onclick="javascript: return confirm_before_delete(<?php echo $task->id ?>, '<?php echo $task->name?>');"
                                >
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once 'pages/template/footer.php';
?>