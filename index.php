<?php
	include("config.php");
	include("functions.php");
	session_start();
   
	if(!isset($_SESSION['login_user'])){
		header("location: login.php");
	}

	$obj_web = new web;
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
		<table class="table">
			<thead>
				<tr>
					<th>Team</th>
					<th>Total Students</th>
					<th>Current Score</th>
					<th>&nbsp;</th>
				</tr>
				<?php
				foreach ($obj_web->getTeams() as $key => $team) {
					?>
					<tr>
						<td><?=$team['name']?></td>
						<td>
							<?=$obj_web->totalStudentsOfTeam($team['id'])?>
						</td>
						<td>
							<?=$obj_web->totalScoreByStudentsOfTeam($team['id'])+1000?>
						</td>
						<td>
							<a class="btn btn-primary" href="students.php?team=<?=$team['id']?>">View Students</a>
							
						</td>
					</tr>
					<?php
				}
				?>
			</thead>
		</table>
	</div>

</body>
</html>
