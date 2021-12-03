<?php

    session_start();

    //Remove session varibales;
    unset($_SESSION['username']);
    unset($_SESSION['valid']);

    $url ="http://localhost/4ww3project/part_3/index.php";
    header('Location: ' .$url);
?>