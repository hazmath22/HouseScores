<?php
	include("config.php");
	include("functions.php");
	session_start();

	$vArray = [];

	$obj_web = new web;
   
	

	//var_dump($obj_web->totalScoreAllTeam());

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="assets/css/stylelead.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
	<title>Leaderboard</title>
</head>

<body>

	<div class="chart">
		<ul class="numbers">
			<li><span>100%</span></li>
			<li><span>50%</span></li>
			<li><span>0%</span></li>
		</ul>
		
		<ul class="bars">
			<?php
			foreach ($obj_web->getTeams() as $key => $team) {
				?>
				<li>
					<a href="top-students.php?team=<?=$team['id']?>"><div  class="barj chart_bg<?=$team['id']?>" data-percentage="<?=round((($obj_web->totalScoreByStudentsOfTeam($team['id'])+1000) / ($obj_web->totalScoreAllTeam()+3000)) * 100,0)?>"></div></a>
					<span><?=$team['name']?></span>
				</li>
				<style type="text/css">
				.bars .chart_bg<?=$team['id']?> {
					background: #<?=$team['background']?>;
				}
				.bars .chart_bg<?=$team['id']?>:hover{
					background: #<?=$team['background_hover']?>;
				}
				</style>
				<?php
			}
			?>
			<!-- <li><div class="barj" data-percentage="10"></div><span>Jinnah</span></li>
			<li><div class="bari" data-percentage="20"></div><span>Iqbal</span></li>
			<li><div class="barsir" data-percentage="30"></div><span>Sir Syed</span></li> -->
		</ul>
	</div>
	
	<script src="assets/js/scores.js"></script>

</body>
</html>
