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
    $result = [];

    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) { 
        if ((isset( $_GET['name']))) {
            if ( (!empty( $_GET['name']))) {
                $name = $_GET['name'];
                $result = getObjectFromDatabaseByName($pdo, $name);

            }else {
                echo 'invalid links';
            }    
        }  else {
            echo 'invalid links';
        }
    }
    //closing the connection
    $pdo = null;

    //Get the object by the given id
    function getObjectFromDatabaseByName($pdo, $name){ 
        $result = [];
        try {
            $sql = "SELECT * FROM objects WHERE shopname like '%".$name."%'";
            $result = $pdo->query($sql);
        } catch (PDOException $e) {            
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $result;
    }
?>