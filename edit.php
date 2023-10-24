<?php
	include 'database.php';

	$q_select = "select * from tasks where taskid = '".$_GET['id']."' ";
	$run_q_select = mysqli_query($conn, $q_select);
	$d = mysqli_fetch_object($run_q_select);

	if(isset($_POST['edit'])){

		$q_update = "update tasks set tasklabel = '".$_POST['task']."' where taskid = '".$_GET['id']."' ";
		$run_q_update = mysqli_query($conn, $q_update);


		header('Refresh:0; url=index.php');

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>To Do List</title>
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
		* {
			padding:0;
			margin:0;
			box-sizing: border-box;
		}
		body {
			font-family: 'Roboto', sans-serif;
			background-image: url('background (2).jpg');
			background-size: cover;

		}
		.container {
			width: 590px;
			height: 100vh;
			margin:0 auto;
		}
		.header {
			padding: 15px;
			color: #fff;
		}
		.header .title {
			display: flex;
			align-items: center;
			margin-bottom: 7px;
		}
		.header .title i {
			font-size: 24px;
			margin-right: 10px;
			color: #fff;
		}
		.header .title span {
			font-size: 18px;
		}
		.header .description {
			font-size: 13px;
		}
		.content {
			padding: 15px;
		}
		.card {
			background-color: #fff;
			padding:15px;
			border-radius: 5px;
			margin-bottom: 10px;
		}
		.input-control {
			width:100%;
			display: block;
			padding:0.5rem;
			font-size: 1rem;
			margin-bottom: 10px;
		}
		.text-right {
			text-align: right;
		}
		button {
			padding:0.5rem 1rem;
			font-size: 1rem;
			cursor: pointer;
			background: #4e54c8;  
			background: -webkit-linear-gradient(to right, #8f94fb, #4e54c8);  
			background: linear-gradient(to right, #8f94fb, #4e54c8); 
			color: #fff;
			border:1px solid;
			border-radius: 3px;
		}
		.task-item {
			display: flex;
			justify-content: space-between;
		}
		.text-orange {
			color: orange;
		}
		.text-red {
			color: red;
		}
		.task-item.done span {
			text-decoration: line-through;
			color: #ccc;
		}

		@media (max-width: 768px){
			.container {
				width: 100%;
			}
		}
	</style>
</head>
<body>

	<div class="container">
		
		<div class="header">
			
			<div class="title">
				<a href="index.php"><i class='bx bx-chevron-left'></i></a>
				<span>Back</span>
			</div>

			<div class="description">
				<?= date("l, d M Y") ?>
			</div>

		</div>

		<div class="content">
			
			<div class="card">
				
				<form action="" method="post">
					
					<input type="text" name="task" class="input-control" placeholder="Edit task" value="<?= $d->tasklabel ?>">

					<div class="text-right">
						<button type="submit" name="edit">Edit</button>
					</div>

				</form>

			</div>

		</div>

	</div>

</body>
</html>