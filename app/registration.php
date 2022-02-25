<!DOCTYPE html>
<html lang="de">
<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/diary"><span class="glyphicon glyphicon-th"></span></a>
    </div>
	<ul class="nav navbar-nav navbar-right">
      <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Anmelden</a></li>
    </ul>
  </div>
</nav>

<?php
require('db.php');
if (isset($_POST['username'])) {
    if(isset($_POST['diaryname'])) {

		$UserName 		= mysqli_real_escape_string($conn,$_POST['username']); 
		$Email 			= mysqli_real_escape_string($conn,$_POST['email']);
		$Password 		= mysqli_real_escape_string($conn,$_POST['email']);
		$PhoneNumber 	= mysqli_real_escape_string($conn,$_POST['phonenumber']);
		$DiaryName 		= mysqli_real_escape_string($conn,$_POST['diaryname']);
		$RegDate 		= date("Y-m-d H:i:s");

		$query = "INSERT INTO `users` (`username`, `email`, `password`, `regdate`, `phonenumber`) VALUES ('$UserName', '$Email', '$Password', '$RegDate', '$PhoneNumber');"; 
		$result 		= mysqli_query($conn,$query);

		if($result) {
			echo "
			<div class='container text-center text-middle'>
				<h3>Erfolgreich registriert</h3>
				<br/>Click here to start <a href='./login.php'>Anmelden</a>
			</div>";
		} else {
			echo "
			<div class='container text-center text-middle'>
				<h3>Error</h3>
				<br/>Bitte versuchen Sie nochmal <a href='./registration.php'>Registrieren</a>
			</div> ";
		}  
		$conn->close();
    }
} else { ?>

	<div class="container text-center text-middle">
		<br /><br /><br /><br /><br /><br />
		<form name="registration" action="" method="post">
			<div class="form-group">
				<h1>Registrierung</h1>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input class="form-control" type = "username" name ="username" placeholder="username" required />
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					<input class="form-control" type="email" name="email" placeholder="Email" required />
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input class="form-control" type="password" name="password" placeholder="Password" required />
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
					<input class="form-control" type = "int" name = "phonenumber" placeholder="Telefonnummer" required />
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-modal-window"></i></span>
					<input class="form-control" type = "text" name = "diaryname" placeholder="Tagebuch Name" />
				</div>
				<br/>
				<button type="submit" class="btn btn-default" name="submit" >Registrieren</button>
			</div>
		</form>
	</div>
<?php } ?>
</body>
</html>