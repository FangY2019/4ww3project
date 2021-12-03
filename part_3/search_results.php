<?php
	session_start();
    include 'inc/search.php';
	include 'inc/header.php';
	include 'inc/footer.php';
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

<body onload='Initalize(<?php echo json_encode($rows) ?>)'>
  <div class="container">
		<!-- Begin Header and menu
	================================================== -->
    <div class="placeholder">
		<div class="placeholder">
			<?php echo $header ?>
		</div>
    </div>
		<!-- End Header and menu
	================================================== -->

    <main>
      <header class="welcome-section">
    	<h2 class="title">Search Result for <?php echo $name ?></h2>
      </header>
	  <div class="search-obj-container">
			<?php foreach($rows as $row) { ?>
				<div class="search-objects">
					<a class="img-ref" href= <?php echo "individual_object.php?id=".$row['id'] ?>>
						<!-- img with no copy right, from https://unsplash.com/photos/XtUd5SiX464 -->
						<img src= <?php echo 'https://4ww3projectbucket.s3.us-east-2.amazonaws.com/' .$row['image_url_key'] ?> class="sample-img" alt="Coffee Shop Picture"/>
					</a>
					<div class="description">
						<h4 class="des-title"> <?php echo $row['shopname'] ?> </h4>
						<p class="des-text"> <?php echo $row['shop_description'] ?> </p>
						<div class="rating-container">
							<div class="rating">
								<?php 
								$total = 0;
								for ($i=1; $i<=$row['rating'];$i++) { 
									$total++;
									?>
										<!-- a star icon with filling -->
										<span>
											<i class="fa fa-star" aria-hidden="true"></i>
										</span>
									<?php
									if($row['rating'] - $i < 1 && $row['rating'] - $i > 0){
										$total++;
										?>
										<!-- a star icon with half filling -->
										<span>
											<i class="fa fa-star-half-o" aria-hidden="true"></i>
										</span>
									<?php
									}?>
								<?php 
								}
								for ($i=$total; $i<5;$i++) { ?>
									<span>
										<i class="fa fa-star-o" aria-hidden="true"></i>
									</span>
								<?php 
								} ?>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
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

	<div class="footerpage"> <?php echo $footer?></div>
</body>

</html>
