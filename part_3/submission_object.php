<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , user-scalable = no">
    <!-- Metadata for mobile user saves the page -->
    <title>Submit Coffee Shop - Seek Coffee</title>
    <link rel="apple-touch-icon-precomposed" href="img/icon.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="192x192" href="img/icon.png">
    <!-- <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>    -->
    <!-- Goolge fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <!-- External style -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- External javascript -->
    <script type="text/javascript" src="assets/js/form_validation_submission.js"></script>
</head>

<body>
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
        <!-- End Header and menue
	================================================== -->

        <!-- Begin Body content
	================================================== -->
    <section>
            <div class="form-container">          

                <!-- when user click the submit button, it will call validateObjectSubmissionForm to validate the form first -->
                <form id="form-object-submission" autocomplete="off" onsubmit="return validateObjectSubmissionForm()" method="post" action="php_process/submission_save.php">
                    <div>
                        <h3>Submit a New Coffee Shop </h3>
                    </div>

                    <!-- If there is errors when the user submit the objects, show the error message -->
                    <?php
                        if(isset($_SESSION['object_submission_status_message'])){
                            if(!empty($_SESSION['object_submission_status_message'])){
                                $msg = "";
                                if($_SESSION['object_submission_status_message']=='database_create_table_error'){
                                    $msg = "Database Error: can not create table";
                                }else if($_SESSION['object_submission_status_message']=='database_save_object_error'){
                                    $msg = "Database Error: can not save objects";
                                }else if($_SESSION['object_submission_status_message']=='is_object_exist'){
                                    $msg = "The object exists in the system";
                                }                                  
                                //clear the message
                                $_SESSION['object_submission_status_message'] = ''; 
                                //show the error message
                                echo '<div style="color: red">'.$msg.'</div>';
                            }
                        }
                    ?> 
                    <!-- prefill the form if the user choose remember me -->
                    <?php
                            $shopname = '';
                            $description = '';
                            $latitude = '';
                            $longitude = '';
                            if((isset($_GET['txt-shopname'])) && (isset($_GET['txt-description']))){
                                 $shopname = $_GET['txt-shopname'];
                                 $description = $_GET['txt-description'];
                                 $latitude = $_GET['txt-latitude'];
                                 $longitude = $_GET['txt-longitude'];
                            }
                    ?>

                    <!-- input shopname -->
                    <div class="form-group-lable-and-input">
                        <label>Name of Coffee Shop</label>
                        <input autocomplete="txt-shopname" type="text" id="txt-shopname" autofocus="" name="txt-shopname" value="<?php echo $shopname; ?>">
                        <div id="shopname-error"></div>
                    </div>
                    <!-- input description -->
                    <div class="form-group-lable-and-input">
                        <label>Description</label>
                        <div><textarea autocomplete="txt-description" id="txt-description" name="txt-description" 
                                placeholder="e.g. A great coffee shop in Hamilton downtown"><?php echo $description; ?></textarea></div>
                         <div id="description-error"></div>
                    </div>

                    <div class="form-group-lable-and-input ">
                        <!-- users can get their coordinates by clicking the button or enter the number by themself
                            If user click the button (Get your coordinates), it will call the getCoordinates() function to get the coordinate through Geolocation API.
                         -->
                        <label>Location</label> <span class="get-geolocation" onclick="getCoordinates()"> Get your coordinates</span>
                        <div class="flex-left">
                            <!-- input latitude -->
                            <div>
                                <label>Latitude:</label>
                                <input autocomplete="txt-latitude" type="text" id="txt-latitude" name="txt-latitude" value="<?php echo $latitude; ?>"
                                    placeholder="e.g. 44.00000">
                                
                            </div>
                            <!-- input longitude -->
                            <div>
                                <label>Longitude:</label>
                                <input autocomplete="txt-longitude" type="text" id="txt-longitude" name="txt-longitude" value="<?php echo $longitude; ?>"
                                    placeholder="e.g. -70.00000">
                            </div>
                        </div>
                        <div id="geolocation-error"></div>
                    </div>
                    <!-- input image -->
                    <div class="form-group-lable-and-input flex-left">
                        <label>Upload Image</label>
                        <input type="file" id="image-upload" name="image-upload">                        
                    </div>
                    <div id="image-error"></div>
                    <!-- input video -->
                    <div class="form-group-lable-and-input flex-left">
                        <label>Upload Video</label>
                        <input type="file" id="video-upload" name="video-upload">                        
                    </div>
                    <div id="video-error"></div>

                    <div>
                        <input class="btn" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </section>
        <!-- End Body content
	================================================== -->
    </div>


    <!-- Begin Footer
	================================================== -->
    <footer>
        <hr>
        <p>Page created by: Haoyang Tao, Fang Ye</p>
        <p>Contact information: <a href="mailto:taoh4@mcmaster.ca">click this</a>.</p>
    </footer>
    <!-- End Footer
	================================================== -->
</body>

</html>