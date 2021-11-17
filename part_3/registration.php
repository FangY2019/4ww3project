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
                                    <li class="nav-li"><a class="nav-link">Login</a></li>
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
            <div class="form-container" >
                <!-- when user click the submit button, it will call validateRegistrationForm to validate the form first -->
                <form class="registration-form" id="form-registration" autocomplete="off" onsubmit="return validateRegistrationForm()">
                    <div>
                        <h3>Create New Account</h3>
                    </div>
                    <div class="form-group-lable-and-input">
                        <label>User Name </label>
                        <input autocomplete="txt-username" type="text" id="txt-username" autofocus="">
                    </div>
                    <div class="form-group-lable-and-input">
                        <label>Email </label>
                        <input autocomplete="txt-email" type="text" id="txt-email">
                    </div>
                    <div class="form-group-lable-and-input">
                        <label>Password </label>
                        <input autocomplete="txt-password" type="password" id="txt-password">
                    </div>
                    <div class="form-group-lable-and-input">
                        <label>Comfirm Password </label>
                        <input autocomplete="txt-confirm-password" type="password" id="txt-confirm-password">
                    </div>
                    <!-- a check box for choose the country -->
                    <div class="form-group-lable-and-input">
                        <label>Country </label>
                        <select class="select-box">
                            <option value="Canada">Canada</option>
                            <option value="USA">USA</option>
                        </select>
                    </div>
                    <div class="form-group-lable-and-input">
                        <div id="user-agreement">
                            <input class="checkbox" type="checkbox" name="terms">
                            Check here to indicate that you have read and agree to TY's
                            <a class="legal-link" href="#">terms of Service </a> "nd acknowledge
                            TY's
                            <a class="legal-link" href="#"> Privacy Policy </a>.
                        </div>
                    </div>

                    <div>
                        <input class="btn" type="submit" value="Submit">
                        <p class="message">Already have account? <a
                                href="registration.php">&nbsp;Log
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
    <footer>
        <hr>
        <p>Page created by: Haoyang Tao, Fang Ye</p>
        <p>Contact information: <a href="mailto:taoh4@mcmaster.ca">click this</a>.</p>
    </footer>
    <!-- End Footer
	================================================== -->
</body>

</html>