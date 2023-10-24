<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="register.css">

	<title>Register Form </title>
</head>
<body style="background-image: url(Background.jpg)">
    <div class="container">
    <form action="prosesuser.php" method="POST">
        <h2>Sign Up</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama_depan" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Daftar">
    </form>
    </div>
</body>
</html>
