<?php
    session_start();
    include 'inc/submission_save.php';
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
            <div class="placeholder">
                <?php echo $header ?>
            </div>
        </div>
        <!-- End Header and menue
	================================================== -->

        <!-- Begin Body content
	================================================== -->
    <section>
            <div class="form-container">          

                <!-- when user click the submit button, it will call validateObjectSubmissionForm to validate the form first -->
                <form id="form-object-submission" autocomplete="off" onsubmit="return validateObjectSubmissionForm()" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div>
                        <h3>Submit a New Coffee Shop </h3>
                    </div>

                    <!-- If there is errors when the user submit the objects, show the error message -->
                    <?php
                        if(array_key_exists('object_submission_status_message', $errors)){
                            $msg = "";
                            if($errors['object_submission_status_message']=='database_create_table_error'){
                                 $msg = "Database Error: fail to create table";
                            }else if($errors['object_submission_status_message']=='database_save_object_error'){
                                $msg = "Database Error: fail to save objects";
                            }else if($errors['object_submission_status_message']=='is_object_exist'){
                                $msg = "The object exists in the system";
                            }                                  
                            //show the error message
                            echo '<div style="color: red">'.$msg.'</div>';

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
    <div class="footerpage"> <?php echo $footer?></div>
    <!-- End Footer
	================================================== -->
</body>

</html>