<?php
  session_start();
	include 'inc/header.php';
	include 'inc/footer.php';
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0 , user-scalable = no">
  <!-- Metadata for mobile user saves the page -->
  <title>Search - Seek Coffee</title>
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
  <!-- External JavaScript -->
  <script type="text/javascript" src="assets/js/pass_param.js"></script>
</head>

<body>
  <!-- Begin Header and menu
================================================== -->
  <div class="container">
    <div class="placeholder">
      <?php echo $header ?>
    </div>
  </div>
  <!-- End Header and menu
	================================================== -->

  <main>
    <div class="form-container">
      <form class="registration-form" method="get" action="search_results.php" name="form"> 
        <div>
          <h3>Search!</h3>
        </div>
        <div class="search-bar">
          <label>Name: </label>
          <input type="text" id="name" name="name"/>
        </div>

        <!-- Drop down menu, filter of stars
							================================================== -->
        <div class="form-group-lable-and-input">
          <label>Stars: </label>
          <select class="select-box" id="stars" name="stars">
            <option value="-1">All</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>

        <input type='hidden' value="false" name="local">

        <!-- search button
							================================================== -->
        <div class="btn-padding">
            <input class="btn" type="submit" value="Search All">
        </div>
        <div class="btn-padding">
          <input class="btn" type="submit" value="Search Around Me" onclick="document.forms['form'].local.value='true'">
        </div>
      </form>
    </div>

  </main>
  <div class="end-of-page">
    <div class="end-of-page-text">
      <!-- If it is a valid session, direct user to object submission page, else, to login page -->
				<p> Didn't find your loved one? <a href= <?php if(isset($_SESSION['valid'])){echo "submission_object.php";}else {echo "login.php";}?>> Add it!</a></p>
    </div>
  </div>
</div>

<div class="footerpage"> <?php echo $footer?></div>
</body>

</html>
