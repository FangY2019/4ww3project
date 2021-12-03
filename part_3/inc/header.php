<?php
$submissionMenue = '';
$registrationMenu = '';
$loginMenu = '';
$logOutMenu = '';

//If the user login , hidden the Registration and Login; else, hidden Submission and Logout
if(isset($_SESSION['valid'])){
    $submissionMenue = "<li class=\"nav-li\"><a href=\"submission_object.php\" class=\"nav-link\">Submission</a></li>";
    $registrationMenu = '';
    $loginMenu = '';
    $logOutMenu = "<li class=\"nav-li\"><a href=\"logout.php\" class=\"nav-link\">Logout</a></li>";
}else{
    $submissionMenue = '';
    $registrationMenu = "<li class=\"nav-li\"><a href=\"registration.php\" class=\"nav-link\">Registration</a></li>";
    $loginMenu = "<li class=\"nav-li\"><a href=\"login.php\" class=\"nav-link\">Login</a></li>";
    $logOutMenu = '';
}

$header = 
"<div class=\"header\" style=\"background-image: url('img/title-pic copy.jpg'); background-repeat: no-repeat;\">
    <div class=\"header-inner\">
        <div class=\"header-side\">
        <h1 class=\"header-side-title\">Seek Coffee</h1>
        <h6 class=\"header-side-description\">find your coffee shop</h6>
        </div>
    </div>
    <nav class=\"nav-bar\">
        <ul class=\"nav-ul\">
        <li class=\"nav-li\"><a href=\"index.php\" class=\"nav-link\">Home</a></li>
        <li class=\"nav-li\"><a href=\"search.php?name=&stars=\" class=\"nav-link\">Search</a></li>" .
        $submissionMenue .
        $registrationMenu .
        $loginMenu .
        $logOutMenu .    
        "</ul>
    </nav> 
</div>"

?>