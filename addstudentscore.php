<?php
	include("config.php");
	include("functions.php");
	session_start();

	$vArray = [];

	$obj_web = new web;
   
	if(!isset($_SESSION['login_user'])){
		header("location: login.php");
	}

	$getTeamID = $_GET['team'];
	$getStudentID = $_GET['student'];
	
	$getTeam = $obj_web->getTeamById($getTeamID);
	$getStudent = $obj_web->getStudentById($getStudentID);
	if(!isset($getTeamID) || $getTeam == 0 AND !isset($getStudentID) || $getStudent == 0){
		header("location: students.php");
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$team_id = mysqli_real_escape_string($db,$_POST['team_id']);
		$score = mysqli_real_escape_string($db,$_POST['score']);

		if(is_numeric($score) == false){
			$vArray['validation_score'] = "Score value is not valid!";
		} else {
			$sql = "INSERT INTO student_scores (score, team_id, student_id) VALUES ('".$score."', '".$getTeamID."', '".$getStudentID."')";
			
			if ($db->query($sql) === TRUE) {
			  $vArray['success'] = "Score saved successfully!";
			  // var_dump($_POST['team_id']);
			  header( "refresh:1;url=students.php?team=$team_id" );
			} else {
			  echo "Error: " . $sql . "<br>" . $db->error;
			}
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<script src="https://kit.fontawesome.com/f35b0ea4f2.js" crossorigin="anonymous"></script>
<title>Houses Score</title>
	<style>
		.navbar{
			width:100%;
			background-color:#C42023;
			overflow:auto;
		}
		.navbar a{
			float:left;
			text-align:center;
			padding:15px;
			color:white;
			text-decoration:none;
			font-size:20px;
			
		}
		.navbar a:hover {
			background-color:black;
		}
		.active{
			background-color: black;
		}
		@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
	</style>
</head>

<body>
	<div class="navbar">
		<a href="Home.html"><i class="fas fa-home"></i>Home</a>
		<a href="leaderboard.html"><i class="fas fa-chart-line"></i> Leaderboard </a>
		<a href="">Upcoming Events</a>
		<a href="logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a>
	</div>

	<div class="container">
		<?php if(isset($vArray['success'])) {
			?>
			<div class="alert alert-success" role="alert">
			<?=$vArray['success'];?>
			</div>
			<?php
		} ?>
		<form action="addstudentscore.php?team=<?=$getTeamID?>&student=<?=$getStudentID?>" method="post">
			<div class="row">
				<div class="col-md-6">
					<label for="score" class="form-label">Score</label>
					<input type="text" class="form-control" name="score" id="score">
					<div style="margin-top: 5px;">		
						<?php if(isset($vArray['validation_score'])) {
							?>
							<div class="alert alert-danger" role="alert">
							<?=$vArray['validation_score'];?>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
			<br>
			<input type="hidden" class="form-control" name="team_id" id="team_id" value="<?=$getTeam['id']?>">
		  	<div class="row">
		  		<div class="col-md-12">
					<button type="submit" class="btn btn-success">Add</button>
					<a href="students.php" class="btn btn-danger">Back to Students</a>
				</div>
		  	</div>	
		</form>
	</div>

</body>
</html>
