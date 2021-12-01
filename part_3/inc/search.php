<?php
    include 'pdo.php';

    $name = '';
    $stars = 0;   
    $shop_name = []; 
    $description = [];
    $latitude = [];
    $longitude = [];
    $image_url = [];
    $video_url = [];
    $avg_ranking = [];

    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) { 
        if ((isset( $_GET['name']))) {
            if ( (!empty( $_GET['name']))) {
                echo "test";
            }else {
                echo 'invalid links';
            }    
        }  else {
            echo 'invalid links';
        }
    }
    //closing the connection
    $pdo = null;

?>