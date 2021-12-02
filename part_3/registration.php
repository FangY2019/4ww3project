<?php
    include 'inc/registration_verify.php';
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
    <title>Registration - Seek Coffee</title>
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
    <script type="text/javascript" src="assets/js/form_validation_registration.js"></script>
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
            <div class="form-container" >
                <!-- when user click the submit button, it will call validateRegistrationForm to validate the form first -->
                <form class="registration-form" id="form-registration" autocomplete="off" onsubmit="return validateRegistrationForm()"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div>
                        <h3>Create New Account</h3>
                    </div>

                    <!-- If there is errors when the user registers in the system, show the error message -->
                    <?php
                            if(array_key_exists('register_status_message', $errors)){
                                $msg = "";
                                if($errors['register_status_message']=='database_create_table_error'){
                                    $msg = "Database Error: can not create table";
                                }else if($errors['register_status_message']=='database_save_user_error'){
                                    $msg = "Database Error: can not save users";
                                }else if($errors['register_status_message']=='is_username_exist'){
                                    $msg = "The username has been used";
                                }else if($errors['register_status_message']=='is_email_exist'){
                                    $msg = "The email address has been used";
                                }                                    
                                //clear the message
                                // unset($error['register_status_message']);
                                echo '<div style="color: red">'.$msg.'</div>';
                            }
                    ?> 

                    <div class="form-group-lable-and-input">
                        <label  for="txt-username">User Name </label>
                        <input autocomplete="txt-username" type="text" id="txt-username" autofocus="" name="txt-username"
                                value = "<?php echo $input_username; ?>" >
                        <span style="font-size: 10px;">* Contain at least 6 character</span>
                        <div id="username-error"></div>
                    </div>
                    <div class="form-group-lable-and-input">
                        <label for="txt-email">Email </label>
                        <input autocomplete="txt-email" type="text" id="txt-email" name="txt-email"
                                value = "<?php  echo $input_email; ?>">
                        <div id="email-error"></div>
                    </div>
                    <div class="form-group-lable-and-input">
                        <label>Password </label>
                        <input autocomplete="txt-password" type="password" id="txt-password"  name="txt-password"
                                value = "<?php  echo $input_password; ?>" >
                                <span style="font-size: 10px;">* Contains at least 6 chars,with at least one lowercase and one uppercase letter</span>
                        <div id="password-error"></div>    
                    </div>
                    <div class="form-group-lable-and-input">
                        <label>Comfirm Password </label>
                        <input autocomplete="txt-confirm-password" type="password" id="txt-confirm-password" name="txt-confirm-password"
                                value = "<?php  echo $input_confirmed_password; ?>">
                        <div id="confirm-password-error"></div>
                    </div>
                    <!-- a check box for choose the country -->
                    <div class="form-group-lable-and-input">
                        <label>Country </label>
                        <select class="select-box" name="country">
                            <option value="Canada" <?php if($input_country == "Canada") {echo 'selected';} ?>>Canada</option>
                            <option value="USA" <?php if($input_country == "USA") {echo 'selected';} ?>>USA</option>
                        </select>
                    </div>
                    <div class="form-group-lable-and-input">
                        <div id="user-agreement">
                            <input class="checkbox" type="checkbox" name="terms" 
                                    <?php if($input_terms){echo 'checked="checked"';}?>>
                            Check here to indicate that you have read and agree to Seek Coffee's
                            <a class="legal-link" href="#">terms of Service </a> and acknowledge
                            Seek Coffee's
                            <a class="legal-link" href="#"> Privacy Policy </a>.
                            <div id="terms-error"></div>
                        </div>
                    </div>

                    <div>
                        <input type="hidden" name="registration_token" value="registration_token" />
                        <input class="btn" type="submit" value="Submit">
                        <p class="message">Already have account? <a
                                href="login.php">&nbsp;Log
                                in</a></p>
                        
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