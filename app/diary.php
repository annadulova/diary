<?php 
require('db.php');
session_start(); 
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <title>Tagebuch</title>
</head>
<body>
<!--Navigationsmenu-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/diary"><span class="glyphicon glyphicon-th"></span></a>
    </div>
	
	<?php
	if(isset($_SESSION["username"])){ 
		$uname = $_SESSION["username"]; 
		
		$query 		= "SELECT userID from `users` where username = '$uname' ;"; 
		$result 	= mysqli_query($conn,$query);
		$row   		= $result->fetch_assoc();
		$userID		= $row["userID"];
		
		$query2 	= "SELECT * from `diary` where userID = '$userID' ;"; 
		$result2 	= mysqli_query($conn,$query2);

		

		if(isset($_POST['submit'])) {
			
			echo $_REQUEST['diaryname'];
			echo $_REQUEST['newdiary'];
			echo $userID;
            
			$DiaryName = mysqli_real_escape_string($conn,$_REQUEST['diaryname']);
			$NewDiary = mysqli_real_escape_string($conn,$_REQUEST['newdiary']);
			$SaveDate 		= date("Y-m-d H:i:s");
			
			$query3 = "INSERT INTO `diary` (`userID`, `diaryname`, `date`, `diary`) VALUES ('$userID', '$DiaryName', '$SaveDate', '$NewDiary');"; 
			$result3 		= mysqli_query($conn,$query3);
			if($result3) {
				mysqli_close($conn); 
				header('Location: ./diary.php');
				
				/**
				echo "
				<div class='container text-center text-middle'>
					<h3>You are registered successfully.</h3>
				</div>";
				**/
			} else {
				echo "
				<div class='container text-center text-middle'>
					<h3>Error</h3>
					<br/>Please try once again <a href='./registration.php'>Registrieren</a>
				</div> ";
			} 
        }

		?>
		<ul class="nav navbar-nav">
			<li class="active"><a href="./feedback.php"><span class="glyphicon glyphicon-pencil"></span> Feedback</a></li>
		</ul>
	
		<ul class="nav navbar-nav navbar-right">
		  <li><a href="./logout.php"><span class="glyphicon glyphicon-log-in"></span> Abmelden</a></li>
		</ul>
	<?php 
	} else { $uname = ""; 
	header("Location: ./login.php");
	?>
	

    <ul class="nav navbar-nav navbar-right">
      <li><a href="./registration.php"><span class="glyphicon glyphicon-user"></span> Registrieren</a></li>
      <li><a href="./login.php"><span class="glyphicon glyphicon-log-in"></span> Anmelden</a></li>
    </ul>
	
<?php }?>

  </div>
</nav>

<div class="container text-center text-middle">

	<div class="row">
	  <div class="col-sm-9">
		<h1 >Herzlich willkommen, <?php echo $uname;?></h1>
		
		<?php
		if ($result2->num_rows > 0) {?>

			<table class="table ">
			  <thead>
				<tr>
					<th class="text-center" scope="col">Datum</th>
					<th class="text-center" scope="col">Name</th>
					<th class="text-center" scope="col">Inhalt</th>
				</tr>
			  </thead>
			  <tbody>
  
		<?php	while($row = $result2->fetch_assoc()) { 

				echo "<tr>";
				echo " <th scope='row'>" . $row["date"]. "</th>";
				echo " <td>" . $row["diaryname"] . "</td>";
				echo " <td class='text-left'>" . $row["diary"] . "</td>";
				echo "</tr>";
			}

		?>
			
				</tbody>
			</table>
	
		<?php } else { ?>
			<div class='text-center text-middle'>
				<h3>Noch nichts, bitte erstellen Sie jetzt ein</h3>
			</div>
		<?php } ?>
		</div>
	  <div class="col-sm-3">
		<form method="post">
			<h2>Neues Tagebuch</h2>
			<br/>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
					<input id="diaryname" type="text" class="form-control" name="diaryname" placeholder="Tagebuch Name" id="diaryname" required />
				</div>
				<br/>
				<!-- <label for="newdiary">New diary</label> -->
				<textarea class="form-control" id="newdiary" name="newdiary" rows="20" required ></textarea>
				<br/>
				<input type="submit" class="btn btn-primary btn-lg" name="submit">

			</div>
		</form>
	  
	  </div>
	</div>

</div>
</body>
</html>

