<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <title>Diary</title>
</head>
<body>
<!--Navigationsmenu-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/diary">Tagebuch</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="/diary"><span class="glyphicon glyphicon-log-in"></span> Anmelden</a></li>
    </ul>
  </div>
</nav>

<!-- Central Container -->
<div class="container text-center text-middle">
	<div class="login">
		<?php
		require('db.php');
		session_start();

		# var_dump($_POST);
		if (isset($_POST['username'])){

			$UserName = mysqli_real_escape_string($conn,$_REQUEST['username']);
			$Password = mysqli_real_escape_string($conn,$_REQUEST['password']);
			
			$query = "SELECT * FROM `users` WHERE username='$UserName' and password='$Password'";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
			$rows = mysqli_num_rows($result);
				if($rows==1){
					$_SESSION['username'] = $UserName;
					header("Location: ./diary.php");
				}else{
					echo "
					<div class='form'>
						<h3>Username/password is incorrect.</h3>
						<br/>Click here to <a href='./login.php'>Anmelden</a>
					</div>";
			}
		}else{ ?>

		<!-- Anmeldeformular  -->
		<form action="" method="post" name="login" >
		<br/><br/><br/><br/><br/><br/><br/>
			<h2>Anmeldung</h2>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input type="text" name="username" class="form-control" placeholder="Name" id="usr" required />
				</div>
				<br/>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="password" type="password" class="form-control" name="password" placeholder="Password" id="pwd" required />
				</div>
				<br/>

				<button type="submit" class="btn btn-default" name="submit" >Anmelden</button>
				<br/><br/>
				<p>Noch nicht registriert? <a href='registration.php'>Zur Registration</a></p>
			</div>
		</form>
		
	<?php } ?>
	</div>
</div>
</body>
</html>

