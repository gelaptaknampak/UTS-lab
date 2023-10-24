<?php
    require "database.php";
    require "session.php"; // Pastikan session sudah dimulai di atas

if (isset($_SESSION['ID_user'])) {
    $ID_user = $_SESSION['ID_user'];
    
    // Sekarang Anda memiliki $ID_user yang bisa digunakan saat memasukkan data ke tabel tasks
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To Do List</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url('background (2).jpg');
            background-size: cover;
            font-family: 'Roboto', sans-serif;
            padding: 10px;
        }

        .container {
            width: 100%;
            max-width: 90%;
            margin: 0 auto;
            padding: 10px;
            border: 3px solid #ccc;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
        }

        .header-content {
            text-align: center;
            color: white;
        }

        .header .title {
            display: flex;
            align-items: center;
            margin-bottom: 7px;
        }

        .header .title i {
            font-size: 24px;
            margin-right: 10px;
        }

        .header .title span {
            font-size: 24px;
        }

        .header .description {
            font-size: 16px;
        }

        .header-actions a {
        text-decoration: none;
        padding: 10px;
        }

        .header-actions a button {
            background-color: #ccc; /* Warna abu-abu */
            color: #333; /* Warna teks */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s; /* Efek transisi warna latar belakang */
        }

        .header-actions a button:hover {
            background-color: #999; /* Warna latar belakang saat tombol dihover */
        }

        .content {
            padding: 15px;
        }

        .card {
            background-color: #fff;
            padding: 15px;
            height: 120px;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .addcard {
            background-color: #fff;
            padding: 15px;
            max-width: 50%;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .addcard input[type="text"] {
            width: 70%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            outline: none;
        }

        .addcard button {
            width: 25%;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            background: #4e54c8;
            color: white;
            border: none;
            border-radius: 5px;
            outline: none;
        }

        #showAddCard {
            position: fixed;
            z-index: 999;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 24px;
            text-align: center;
            line-height: 40px;
            background-color: #4e54c8;
            color: white;
            border: none;
            cursor: pointer;
            right: 20px;
            bottom: 20px;
        }

        #showAddCard:hover {
            background-color: #3b42a3;
        }

        .input-control {
            width: 100%;
            display: block;
            padding: 0.5rem;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .text-right {
            text-align: right;
        }

        button {
            padding: 5px;
            font-size: 1rem;
            cursor: pointer;
            background: #4e54c8;
            color: white;
            border: 1px solid;
            border-radius: 3px;
        }

        .task-item {
            display: flex;
            justify-content: space-between;
            opacity: 1;
        }

        .text-orange {
            color: orange;
        }

        .text-red {
            color: red;
        }

        .task-item.done {
            opacity: 0.6;
        }

        .task-item.done span {
            text-decoration: line-through;
            color: #ccc;
        }

        @media screen and (max-width: 1000px) {
            body {
                background-image: url('Frame 10.png'); /* Saya asumsikan nama file gambar adalah 'Frame 10.png' */
            }
        }
    </style>
</head>
<body>
<div class="header-actions">

<?php
  if (isset($_SESSION['ID_user'])) {
      $userID = $_SESSION['ID_user'];
      echo '<a href="logout.php"><button class="btn btn-primary" data-aos="fade-down">Logout</button></a>';
  } else {
      // Pengguna belum login
      echo '<a href="login.php"><button class="btn btn-primary" data-aos="fade-down">Login</button></a>';
  }
?>

</div>
<div class="header">
    <div class="header-content">
        <div class="title">
            <a href="index.php" style="text-decoration: none; color: white; text-align:center;">
                <strong>To Do List</strong>
            </a>
        </div>
        <div class="description">
            <?= date("l, d M Y") ?>
        </div>
    </div>
</div>
<center>
<div class="addcard">
            <form action="" method="post">
                <input type="text" name="task" class="input-control" placeholder="Add task">
                <div class="text-right">
                    <button type="submit" name="add">Add</button>
                </div>
            </form>
</div>
</center>
<div class="container">
    <div class="content">

        <?php
        include 'database.php';

        if (isset($_POST['add'])) {
            $taskLabel = $_POST['task'];
            $q_insert = "INSERT INTO tasks (tasklabel, taskdone, taskstatus, ID_user) VALUES ('$taskLabel', 0, 'Not yet started', $ID_user)";
            $run_q_insert = mysqli_query($conn, $q_insert);

            if ($run_q_insert) {
                echo '<script type="text/javascript">window.location.replace("index.php");</script>';
            } else {
                die('Query error: ' . mysqli_error($conn));
            }
        }

        $q_select = "SELECT * FROM tasks WHERE ID_user = $ID_user ORDER BY taskdone ASC, taskid DESC";
        $run_q_select = mysqli_query($conn, $q_select);

        if (!$run_q_select) {
            die('Query error: ' . mysqli_error($conn));
        }

        if (isset($_GET['delete'])) {
            $taskID = $_GET['delete'];
            $q_delete = "DELETE FROM tasks WHERE taskid = '$taskID'";
            $run_q_delete = mysqli_query($conn, $q_delete);

            echo '<script type="text/javascript">window.location.replace("index.php");</script>';
        }

        if (isset($_GET['done'])) {
            $taskID = $_GET['done'];
            $q_update = "UPDATE tasks SET taskdone = NOT taskdone WHERE taskid = '$taskID'";
            $run_q_update = mysqli_query($conn, $q_update);

            echo '<script type="text/javascript">window.location.replace("index.php");</script>';
        }
        ?>

        <?php
        if (mysqli_num_rows($run_q_select) > 0) {
            while ($r = mysqli_fetch_array($run_q_select)) {
                ?>
                <div class="card">
                <div class="task-item <?= $r['taskdone'] ? 'done' : '' ?>" data-task-id="<?= $r['taskid'] ?>">
                    <div>
                    <input type="checkbox" class="done-checkbox" data-task-id="<?= $r['taskid'] ?>" data-is-done="<?= $r['is_done'] ?>" <?= $r['is_done'] ? 'checked' : '' ?>>
                    <span><?= $r['tasklabel'] ?> (Status: <span class="task-status"><?= $r['taskstatus'] ?></span>)</span>
                        </div>
                        <div>
                            <form action="" method="post">
                                <select name="status" class="input-control">
                                    <option value="Not yet started" <?= $r['taskstatus'] == 'Not yet started' ? 'selected' : '' ?>>Not yet started</option>
                                    <option value="In progress" <?= $r['taskstatus'] == 'In progress' ? 'selected' : '' ?>>In progress</option>
                                    <option value="Waiting on" <?= $r['taskstatus'] == 'Waiting on' ? 'selected' : '' ?>>Waiting on
                                    </option>
                                    <option value="Completed" <?= $r['taskstatus'] == 'Completed' ? 'selected' : '' ?>>Completed
                                    </option>
                                </select>
                                <input type="hidden" name="task_id" value="<?= $r['taskid'] ?>">
                              
                            <button type="submit" name="update_status" class="update-status-button">Update Status</button>

                            </form>
                            <a href="edit.php?id=<?= $r['taskid'] ?>" class="text-orange" title="Edit">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="?delete=<?= $r['taskid'] ?>" class="text-red" title="Remove"
                               onclick="return confirm('Are you sure ?')">
                                <i class="bx bx-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div>Belum ada task</div>
            <?php
        }
        ?>

        <?php
        if (isset($_POST['update_status'])) {
            if (isset($_POST['task_id']) && isset($_POST['status'])) {
                $taskID = $_POST['task_id'];
                $taskStatus = $_POST['status'];

                $q_update_status = "UPDATE tasks SET taskstatus = '$taskStatus' WHERE taskid = '$taskID'";
                $run_q_update_status = mysqli_query($conn, $q_update_status);

                if ($run_q_update_status) {
                    echo '<script type="text/javascript">window.location.replace("index.php");</script>';
                } else {
                    die('Query error: ' . mysqli_error($conn));
                }
            }
        }
        ?>
    </div>
</div>
<button id="showAddCard">+</button>
<script type="text/javascript">
    const checkboxes = document.querySelectorAll('.done-checkbox');

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const taskID = this.getAttribute('data-task-id');
        const isDone = this.checked;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_status.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        const data = `task_id=${taskID}&is_done=${isDone ? 1 : 0}`;
        xhr.send(data);


            xhr.addEventListener('load', function () {
                if (xhr.status === 200) {
                    console.log('Status task successfully updated.');

                    if (isDone) {
                        
                        const parent = taskItem.parentNode;
                        parent.removeChild(taskItem);
                        parent.appendChild(taskItem);

                       
                        taskItem.classList.remove('done');
                        taskItem.style.opacity = '1';
                        taskStatusElement.textContent = 'Not yet started';
                    } else {
                        
                    }
                } else {
                    console.error('Failed to update task status.');
                }
            });
        });
    });
</script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        const addCardButton = document.getElementById("showAddCard");
        const addCardForm = document.querySelector(".addcard");

        // Sembunyikan elemen `.addcard` awalnya
        addCardForm.style.display = "none";

        addCardButton.addEventListener("click", function () {
            // Toggle visibilitas elemen `.addcard` saat tombol + diklik
            if (addCardForm.style.display === "none") {
                addCardForm.style.display = "block";
            } else {
                addCardForm.style.display = "none";
            }
        });
    });
</script>

</body>
</html>
