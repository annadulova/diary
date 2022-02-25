<?php
// Start the session
session_start();
?>
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
      <a class="navbar-brand" href="/diary"><span class="glyphicon glyphicon-th"></span></a>
    </div>
    <ul class="nav navbar-nav">
			<li class="active"><a href="./diary.php"><span class="glyphicon glyphicon-pencil"></span> Tagebuch</a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
	  <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> Abmelden</a></li>
	</ul>
  </div>
</nav>


<?php	
require('db.php');	


if(isset($_SESSION["username"])){ 
		$uname = $_SESSION["username"]; 

		$query 		= "SELECT userID from `users` where username = '$uname' ;"; 
		$result 	= mysqli_query($conn,$query);
		$row   		= $result->fetch_assoc();
		$userID		= $row["userID"];




    if (isset($_POST['subject'])) {
    if(isset($_POST['feedback'])) {
		


		$Subject 		= mysqli_real_escape_string($conn,$_POST['subject']); 
		$Feedback 		= mysqli_real_escape_string($conn,$_POST['feedback']);
		
		$query = "INSERT INTO `feedback` (`userID`, `subject`, `feedback`) VALUES ('$userID','$Subject', '$Feedback');"; 
		$result 		= mysqli_query($conn,$query);
			
		if($result) {
			echo "
			<div class='container text-center text-middle'>
				<h3>Erfolgreich abgesendet</h3>
				
			</div>";
		} else {
			echo "
			<div class='container text-center text-middle'>
				<h3>Error</h3>
				<br/>Bitte versuchen Sie nochmal <a href='./feedback.php'>feedback</a>
			</div> ";
		}  
		$conn->close();
    }
} else { 
}	}
?>	
	

<!-- Central Container -->
<div class="container text-center text-middle">
	<div class="login">
	
	
		<?php
		require('db.php');
		session_start();

		# var_dump($_POST);
	
		 
		if (isset($_POST['username'])){

			$UserName = mysqli_real_escape_string($conn,$_REQUEST['username']);
		
			$query = "SELECT * FROM `users` WHERE username='$UserName'";
			$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
			$rows = mysqli_num_rows($result);
				if($rows==1){
					$_SESSION['username'] = $UserName;
					header("Location: ./diary.php");
				}else{
					echo "
					<div class='form'>
						<h3>Username is incorrect.</h3>
						<br/>Click here to <a href='./login.php'>Anmelden</a>
					</div>";
			if($result) {
				echo "
				<div class='container text-center text-middle'>
					<h3>Erfolgreich abgesendet</h3>
					<br/>Click here to start <a href='./login.php'>Anmelden</a>
				</div>";
			} else {
				echo "
				<div class='container text-center text-middle'>
					<h3>Error</h3>
					<br/>Bitte versuchen Sie nochmal <a href='./login.php'>Anmelden</a>
				</div> ";
		}  
		$conn->close();
			}
		}else{ ?> 
		
		


		<!-- Feedbackformular  -->
		
		<form action="" method="post" name="feedback" >
		<br/><br/><br/><br/><br/><br/><br/>
			<h2>Feedback</h2>
			
			<div class="form-group">
				
				<br/>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					<input id="subject" type="subject" class="form-control" name="subject" placeholder="Thema" id="thm" required />
				</div>
				<br/>
				<div class="input-group">
			
				</div>
				<textarea class="form-control" id="feedback" name="feedback" placeholder="Ihre Nachricht" rows="3" required ></textarea>
				<br/>

				<button type="submit" class="btn btn-default" name="submit" >Absenden</button>
				
				<br><br>
			</div>
		</form>
		
	<?php } 	?>
	</div>
</div>
</body>
</html>
	

	


