<?php
include 'database.php';

if (isset($_POST['task_id']) && isset($_POST['is_done'])) {
    $taskID = $_POST['task_id'];
    $isDone = $_POST['is_done'];

    $q_update = "UPDATE tasks SET taskdone = $isDone WHERE taskid = $taskID";
    $run_q_update = mysqli_query($conn, $q_update);

    if ($run_q_update) {
        echo 'Task status updated successfully.';
    } else {
        echo 'Failed to update task status.';
    }
} else {
    echo 'Invalid request.';
}
?>