<?php
	include("config.php");
	include("functions.php");
	session_start();

	$vArray = [];

	$obj_web = new web;
   
	if(!isset($_SESSION['login_user'])){
		header("location: login.php");
	}

	if(isset($_GET['team'])){
		$getTeamID = $_GET['team'];
		$getTeam = $obj_web->getTeamById($getTeamID);
	}
	
	if(isset($_GET['student'])){
		$getStudentID = $_GET['student'];
		$getStudent = $obj_web->getStudentById($getStudentID);
	}
	if(!isset($getTeamID) || $getTeam == 0 AND !isset($getStudentID) || $getStudent == 0){
		header("location: students.php");
	}

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$team_id = mysqli_real_escape_string($db,$_POST['team_id']);
		$classtype_id = mysqli_real_escape_string($db,$_POST['classtype_id']);
		$roll_number = mysqli_real_escape_string($db,$_POST['roll_number']);
		$student_name = mysqli_real_escape_string($db,$_POST['student_name']);
		$house = mysqli_real_escape_string($db,$_POST['house']);

		if($classtype_id == ''){
			$vArray['validation_classtype_id'] = "Class Type field is required!";
		}
		if($roll_number == ''){
			$vArray['validation_roll_number'] = "Roll number field is required!";
		}
		if($student_name == ''){
			$vArray['validation_student_name'] = "Student Name field is required!";
		}

		if(sizeof($vArray) == 0) {
			$sql = "UPDATE students SET classtype_id='".$classtype_id."', roll_number='".$roll_number."', student_name='".$student_name."', house='".$house."' WHERE id='".$getStudentID."'";
			
			if ($db->query($sql) === TRUE) {
			  $vArray['success'] = "Student updated successfully!";
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
		<form action="editstudent.php?student=<?=$getStudentID?>" method="post">
			<div class="row">
				<div class="col-md-6">
					<label for="classtype_id" class="form-label">Class Types</label>
					<select class="form-control" name="classtype_id">
						<option value="">-- Select --</option>
						<?php foreach ($obj_web->getClassTypes() as $key => $classType) {
							?>
							<option value="<?=$classType['id']?>" <?php if($classType['id'] == $getStudent['classtype_id']) {echo 'selected';}else{echo '';} ?>><?=$classType['class_type']?></option>
							<?php
						} ?>
					</select>
					<div style="margin-top: 5px;">		
						<?php if(isset($vArray['validation_classtype_id'])) {
							?>
							<div class="alert alert-danger" role="alert">
							<?=$vArray['validation_classtype_id'];?>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="roll_number" class="form-label">Roll Number</label>
					<input type="text" class="form-control" name="roll_number" id="roll_number" value="<?=$getStudent['roll_number']?>">
					<div style="margin-top: 5px;">		
						<?php if(isset($vArray['validation_roll_number'])) {
							?>
							<div class="alert alert-danger" role="alert">
							<?=$vArray['validation_roll_number'];?>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="student_name" class="form-label">Student Name</label>
					<input type="text" class="form-control" name="student_name" id="student_name" value="<?=$getStudent['student_name']?>">
					<div style="margin-top: 5px;">		
						<?php if(isset($vArray['validation_student_name'])) {
							?>
							<div class="alert alert-danger" role="alert">
							<?=$vArray['validation_student_name'];?>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="house" class="form-label">House</label>
					<input type="text" class="form-control" name="house" id="house" value="<?=$getStudent['house']?>">
					<div style="margin-top: 5px;">		
						<?php if(isset($vArray['validation_house'])) {
							?>
							<div class="alert alert-danger" role="alert">
							<?=$vArray['validation_house'];?>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
			<br>
			<input type="hidden" class="form-control" name="team_id" id="team_id" value="<?=$getStudent['team_id']?>">
		  	<div class="row">
		  		<div class="col-md-12">
					<button type="submit" class="btn btn-success">Update</button>
					<a href="students.php" class="btn btn-danger">Back to Students</a>
				</div>
		  	</div>	
		</form>
	</div>

</body>
</html>
