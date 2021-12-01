<?php
    include 'inc/search.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , user-scalable = no">
    <!-- Metadata for mobile user saves the page -->
    <title>Search Result - Seek Coffee</title>
    <link rel="apple-touch-icon-precomposed" href="img/icon.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="192x192" href="img/icon.png">
    <!-- <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>    -->
	<!-- Goolge fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<!-- External style -->
	<link rel="stylesheet" href="assets/css/style.css">
  <!-- Leaflet CSS file -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
 integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
 crossorigin=""/>
  <!-- Leaflet JavaScript file -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
  <!-- External JavaScript -->
  <script type="text/javascript" src="assets/js/searchmap.js"></script>
</head>

<body onload="Initalize()">
  <div class="container">
		<!-- Begin Header and menu
	================================================== -->
    <div class="placeholder">
      <div class="header" style="background-image: url('img/title-pic copy.jpg'); background-repeat: no-repeat;">
        <div class="header-inner">
          <div class="header-side">
            <h1 class="header-side-title">Seek Coffee</h1>
            <h6 class="header-side-description">find your coffee shop</h6>
          </div>
        </div>
		<nav class="nav-bar">
                    <ul class="nav-ul">
                        <li class="nav-li"><a href="index.php" class="nav-link active">Home</a></li>
                        <li class="nav-li"><a href="submission_object.php" class="nav-link">Submission</a></li>
                        <li class="nav-li"><a href="registration.php" class="nav-link">Registration</a></li>
                        <li class="nav-li"><a href="login.php" class="nav-link">Login</a></li>
                        <li class="nav-li"><a href="search.php" class="nav-link">Search</a></li>
                    </ul>
                </nav>
      </div>
    </div>
		<!-- End Header and menu
	================================================== -->

    <main>
      <header class="welcome-section">
        <h2 class="title">Search Result for <?php echo $name ?></h2>
      </header>

			<!-- Sample Objects -->
			<div class="search-obj-container">
				<?php foreach($result as $row) { ?>
					<div class="search-objects">
						<a class="img-ref" href="individual_object.php">
							<!-- img with no copy right, from https://unsplash.com/photos/XtUd5SiX464 -->
							<img src= <?php $row['image_url_key'] ?> class="sample-img" alt="Coffee Shop Picture"/>
						</a>
						<div class="description">
							<h4 class="des-title"> <?php echo $row['shopname'] ?> </h4>
							<p class="des-text"> <?php echo $row['shop_description'] ?> </p>
							<div class="rating-container">
									<div class="rating">
											<!-- a star icon with filling -->
											<span>
													<i class="fa fa-star" aria-hidden="true"></i>
											</span>
											<span>
													<i class="fa fa-star" aria-hidden="true"></i>
											</span>
											<span>
													<i class="fa fa-star" aria-hidden="true"></i>
											</span>
											<span>
													<i class="fa fa-star" aria-hidden="true"></i>
											</span>
											<!-- a star icon with half filling -->
											<span>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
											</span>
									</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>

				<!-- map
			================================================== -->
			<div class="search-map" itemscope itemtype="https://schema.org/Place">
        <div id="search-map-id" class="search-map" ></div>
        <!-- microdata - geo coordinates of the place   -->
        <div itemprop="geo" itemscope itemtype="https://schema.org/GeoCoordinates"></div>
			</div>
    </main>

		<!-- End of page
	================================================== -->
		<div class="end-of-page">
			<div class="end-of-page-text">
				<p> Didn't find your loved one? <a href="submission_object.php">Add it!</a></p>
			</div>
		</div>
	</div>

		<footer>
			<hr>
  		<p>Page created by: Haoyang Tao, Fang Ye</p>
  		<p>Contact information: <a href="mailto:taoh4@mcmaster.ca">click this</a>.</p>
		</footer>
</body>

</html>
