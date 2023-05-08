<?php
	include("config.php");
	include("functions.php");
	session_start();
   
	if(!isset($_SESSION['login_user'])){
		header("location: login.php");
	}

	$obj_web = new web;

	if(isset($_GET['team'])){
		$getTeamID = $_GET['team'];
		$getTeam = $obj_web->getTeamById($getTeamID);
	}
	if(!isset($getTeamID) || $getTeam == 0){
		$teams = $obj_web->getTeams();
	} else {
		$teams = $obj_web->getTeamsById($getTeam['id']);
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
		<a href="index.php"><i class="fas fa-home"></i>Home</a>
		<a href="leaderboard.php"><i class="fas fa-chart-line"></i> Leaderboard </a>
		<a href="calendar.html">Upcoming Events</a>
		<a href="logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a>
	</div>

	<div class="container">

		<?php
		foreach ($teams as $key => $team) {
			?>
			<h2><?=$team['name']?></h2>
			<?php
			foreach ($obj_web->getClassTypes() as $key => $type) {
				?>
				<table class="table">
					<thead>
						<tr class="bg-primary" style="background: #<?=$team['background']?>">
							<th colspan="5"><?=$type['class_type']?></th>
							<th width="100">
								<a class="btn btn-primary btn-block" href="addstudent.php?team=<?=$team['id']?>">Add Student</a>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($obj_web->getStudentsByTeamIdAndClassTypeId($team['id'],$type['id'])){
							?>					
							<tr class="bg-primary" style="background: #<?=$team['background']?>">
								<th>Roll#</th>
								<th>Student Name</th>
								<th>House</th>
								<th>Scores</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</tr>
							<?php
							foreach ($obj_web->getStudentsByTeamIdAndClassTypeId($team['id'],$type['id']) as $key => $student) {
							?>
							<tr>
								<td width="120"><?=$student['roll_number']?></td>
								<td width="250"><?=$student['student_name']?></td>
								<td><?=$student['house']?></td>
								<td width="100">
									<?=$obj_web->totalScoreByStudent($student['id'])?>
								</td>
								<td width="100">
									<a class="btn btn-info btn-block" href="editstudent.php?team=<?=$team['id']?>&student=<?=$student['id']?>">Edit Student</a>
								</td>
								<td>
									<a class="btn btn-danger btn-block" href="addstudentscore.php?team=<?=$team['id']?>&student=<?=$student['id']?>">Add Score</a>
								</td>
							</tr>
							<?php
							}
						}
						?>
					</tbody>
				</table>
				<?php
			}
		}
		?>
	</div>

</body>
</html>
