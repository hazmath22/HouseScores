<?php
	include("config.php");
	include("functions.php");
	session_start();
   
	

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
<title>Top Scores</title>
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
body{
	background:linear-gradient(
		rgba(0,0,0,0.5),
		rgba(0,0,0,0.5)),

	url('Images/lcas.jpg');
	background-size: cover;
		)

	

	}
	h2{
		color:white;
	}
	th{
		color:black;
	}
	td{
		color:white;
	}
	</style>

</head>

<body>
	<div class="navbar">
		<a href="Home.html"><i class="fas fa-home"></i>Home</a>
		<a href="leaderboard.php"><i class="fas fa-chart-line"></i> Leaderboard </a>
		<a href="calendar.html">Upcoming Events</a>
		<a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
	</div>
<div class="oof">
	<div class="container">
		

		<?php
		foreach ($teams as $key => $team) {
			?>
			<table align="center">
			<tr>
				<td style="width: 300px;  "><h2 style="color:#D4AF37" >Current Total Score:</h2></td>

		<td style=" text-align: center; "><h2 style=" color:#D4AF37"><?=$obj_web->totalScoreByStudentsOfTeam($team['id']) + 1000 ?></h2></td>
	</tr>
	</table>
	<h2 align="center">Top 5 Students</h2>
			<h2><?=$team['name']?></h2>
			<?php
			foreach ($obj_web->getClassTypes() as $key => $type) {
				?>
				<table class="table">
					<thead>
						<tr class="bg-primary" style="background: #<?=$team['background']?>">
							<th colspan="4"><?=$type['class_type']?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($obj_web->getStudentsByTeamIdAndClassTypeIdHighestScores($team['id'],$type['id'])){
							?>					
							<tr class="bg-primary" style="background: #<?=$team['background']?>">
								<th>Roll#</th>
								<th>Student Name</th>
								<th>House</th>
								<th>Scores</th>
							</tr>
							<?php
							foreach ($obj_web->getStudentsByTeamIdAndClassTypeIdHighestScores($team['id'],$type['id']) as $key => $student) {
							?>
							<tr>
								<td width="120"><?=$student['roll_number']?></td>
								<td width="250"><?=$student['student_name']?></td>
								<td><?=$student['house']?></td>
								<td width="100">
									<?=$student['score']?>
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
</div>
</body>
</html>
