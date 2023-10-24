<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task_id']) && isset($_POST['is_done'])) {
        $taskID = $_POST['task_id'];
        $isDone = $_POST['is_done'];

        $q_update_status = "UPDATE tasks SET taskdone = $isDone WHERE taskid = $taskID";
        $run_q_update_status = mysqli_query($conn, $q_update_status);

        if ($run_q_update_status) {
            echo 'Status task updated successfully.';
        } else {
            echo 'Failed to update task status.';
        }
    } else {
        echo 'Required data not found.';
    }
} else {
    echo 'Invalid request method.';
}
?>
