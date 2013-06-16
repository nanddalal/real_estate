<?php
	session_start();
	if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Insert Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="../css/bootstrap.css" rel="stylesheet">
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		</style>
		<link href="../css/bootstrap-responsive.css" rel="stylesheet">

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../ico/apple-touch-icon-114-precomposed.png">
			<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../ico/apple-touch-icon-72-precomposed.png">
										<link rel="apple-touch-icon-precomposed" href="../ico/apple-touch-icon-57-precomposed.png">
																	 <link rel="shortcut icon" href="../ico/favicon.png">
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="index.php">Unwala Estates</a>
					<div class="nav-collapse collapse">
						<?php
							if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
								echo "
								<p class='navbar-text pull-right'>
									Logged in as <a href='admin.php' class='navbar-link'>" . $_SESSION['username'] . "</a>
								</p>
								";
							} else {
								echo "
								<p class='navbar-text pull-right'>
									<a href='login.php' class='navbar-link'>Login</a>
								</p>
								";
							}
						?>
						<ul class="nav">
							<li><a href="/real_estate/index.php">Home</a></li>
							<li><a href="/real_estate/about.php">About</a></li>
							<li><a href="/real_estate/contact.php">Contact</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">

			<h1>Testing</h1>
			<p>Added the following new estate:<br>
			<?php
				$estate_name = $_GET["estate_name"];
				$estate_location = $_GET["estate_location"];
				$estate_size = $_GET["estate_size"];
				$estate_price = $_GET["estate_price"];
				$estate_description = $_GET["estate_description"];
				echo "Name: " . $estate_name . "<br>";
				echo "Location: " . $estate_location . "<br>";
				echo "Size: " . $estate_size . "<br>";
				echo "Price: " . $estate_price . "<br>";
				echo "Description: " . $estate_description . "<br>";
			?>
			</p>
			<?php
				include_once "connect.php";
				$new_estate = sprintf("INSERT INTO estates (name, location, size, price, description) 
					VALUES ('%s', '%s', '%d', '%d', '%s');",
					mysql_real_escape_string($estate_name),
					mysql_real_escape_string($estate_location),
					mysql_real_escape_string($estate_size),
					mysql_real_escape_string($estate_price),
					mysql_real_escape_string($estate_description));
				mysql_query($new_estate);
				mysql_close($con);
			?>

			<form action="admin.php">
			<button type="submit" class="btn btn-primary">Back to Admin</button>
			</form>

			<hr>
			
			<!-- FOOTER -->
			<footer>
				<p class="pull-right"><a href="#">Back to top</a></p>
				<p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
			</footer>

		</div> <!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>

	</body>
</html>
