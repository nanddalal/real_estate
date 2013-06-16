<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Estate Page</title>
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
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About</a></li>
							<li><a href="contact.php">Contact</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">
			<?php
				include_once "connect.php";
				$query = sprintf("SELECT * FROM estates WHERE name='%s' LIMIT 1;", $_GET['name']);
				$result = mysql_query($query);
				if (!$result) {
					$message  = 'Invalid query: ' . mysql_error() . "\n";
					$message .= 'Whole query: ' . $query;
					die($message);
				}
				$row = mysql_fetch_assoc($result);
				mysql_free_result($result);
			?>
			<h1><?php echo $row['name'] ?></h1>
			<fieldset>
				<legend>Details</legend>
				<div class="row">
					<div class="span8">
						<div class="row">
							<div class="span2 lightblue">
								<label>Estate Name</label>
								<p class="lead"><?php echo $row['name'] ?></p>
							</div><!--/span-->
							<div class="span2 lightblue">
								<label>Estate Location</label>
								<p class="lead"><?php echo $row['location'] ?></p>
							</div><!--/span-->
							<div class="span2 lightblue">
								<label>Estate Size</label>
								<p class="lead"><?php echo $row['size'] ?></p>
							</div><!--/span-->
							<div class="span2 lightblue">
								<label>Estate Price</label>
								<p class="lead"><?php echo $row['price'] ?></p>
							</div><!--/span-->
						</div>
					</div><!--/span-->
				</div><!--/row-->
			</fieldset>
			<fieldset>
				<legend>Description</legend>
				<div class="row">
					<div class="span8">
						<div class="row">
							<div class="span8 lightblue">
								<label>Estate Description</label>
								<p class="lead"><?php echo $row['description'] ?></p>
							</div><!--/span-->
						</div>
					</div><!--/span-->
				</div><!--/row-->
			</fieldset>

<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide">
	<div class="carousel-inner">
	<?php
	if ($handle = opendir($row['name'])) {
		$first = true;
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				$entry = $row['name'] . "/" . $entry;
				if ($first) {
					echo "
					<div class='item active'>
						<img src='" . $entry . "' alt=''>
						<div class='container'>
						<div class='carousel-caption'>
							<h1>Example headline.</h1>
							<p class='lead'>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						</div>
						</div>
					</div>
					";
					$first = false;
				} else {
					echo "
					<div class='item'>
						<img src='" . $entry . "' alt=''>
						<div class='container'>
						<div class='carousel-caption'>
							<h1>Example headline.</h1>
							<p class='lead'>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						</div>
						</div>
					</div>
					";
				}
			}
		}
		closedir($handle);
	}
	?>
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->

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
