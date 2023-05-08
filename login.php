<?php
	include("config.php");
	session_start();

	$vArray = [];

	if(isset($_SESSION['login_user'])){
		header("location: index.php");
	} else {
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			// username and password sent from form 

			$myusername = mysqli_real_escape_string($db,$_POST['username']);
			$mypassword = mysqli_real_escape_string($db,$_POST['password']); 

			$result = mysqli_query($db,"SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'");
			$row = mysqli_fetch_array($result);

			$count = mysqli_num_rows($result);

			// If result matched $myusername and $mypassword, table row must be 1 row

			if($count == 1) {
				$_SESSION['login_user'] = $myusername;
				header("location: index.php");
			} else {
				$vArray['invalid_creads'] = "Your Login Username or Password is invalid!";
			}
		}
	}
?>

<!doctype html>
<html>
<head>
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
<meta charset="UTF-8">
<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<script src="https://kit.fontawesome.com/f35b0ea4f2.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="assets/css/loginstyle.css">
</head>

<body>
<div class="navbar">
		<a href="Home.html"><i class="fas fa-home"></i>Home</a>
		<a href="leaderboard.php"><i class="fas fa-chart-line"></i> Leaderboard </a>
		<a href="calendar.html">Upcoming Events</a>
		<a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
	</div>
	<div class="container">
        <div class="row">
        	<div class="col-md-4"></div>
        	<div class="col-md-4">
        		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	        		<div class="loginbox">
						<h1>Login</h1>
						<?php if(isset($vArray['invalid_creads'])) {
							?>
							<div class="alert alert-danger" role="alert">
							<?=$vArray['invalid_creads'];?>
							</div>
							<?php
						} ?>
						<div class="text">
							<i class="far fa-user"></i>
							<input type="text" placeholder="Enter Username" name="username" value="">
						</div>
						<div class="text">
							<i class="fas fa-lock"></i>
							<input type="password" placeholder="Enter Password" name="password" value="">
						</div>
						<input class="button" type="submit" value="Login">	
					</div>
				</form>
        	</div>
        	<div class="col-md-4"></div>
        </div>
    </div>

</body>
</html>