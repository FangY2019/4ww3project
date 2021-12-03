<?php
    include 'pdo.php';
    // variables for the attributesof a coffee shop
    $object_id = 0;
    $shopname = '';
    $description = '';
    $latitude = 0;
    $longitude = 0;
    $image_url = '';
    $video_url = '';
    $avg_ranking = 0;
    // a list of reviews for a object
    $reviews = [];

    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) { 
        if ((isset( $_GET['id']))) {
            if ( (!empty( $_GET['id']))) {
                //get the object id
                $object_id = htmlentities($_GET['id']); 
                //query the object from database 
                $object = getObjectFromDatabase($pdo, $object_id);
                //assign the vlaue to the variables
                $shopname = $object['shopname'];
                $description = $object['shop_description'];
                $latitude = $object['latitude'];
                $longitude = $object['longitude'];
                $image_url = 'https://4ww3projectbucket.s3.us-east-2.amazonaws.com/' . $object['image_url_key'];
                $video_url = 'https://4ww3projectbucket.s3.us-east-2.amazonaws.com/' . $object['video_url_key'];
                $avg_ranking = getAvgRank($pdo, $object_id);
                $reviews = getReviews($pdo, $object_id);                                     
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
    function getObjectFromDatabase($pdo, $object_id){ 
        $object = [];
        try {
            $sql = "SELECT * FROM objects WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $values = [':id' => $object_id];
            $result = $stmt->execute($values);       
            if($result){
                $object = $stmt->fetch(PDO::FETCH_ASSOC);
            }else{
                echo 'The object does not exist!';
                exit();
            }
            $stmt = null;
        } catch (PDOException $e) {            
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $object;
    }

    //Get the average ranking by the given id
    function getAvgRank($pdo, $object_id){ 
        $avg_rank = 0;
        try {
            $sql = "SELECT AVG(ranking) AS avg_ranking FROM review WHERE `object_id` = :objectid";
            $stmt = $pdo->prepare($sql);
            $values = [':objectid' => $object_id];
            $result = $stmt->execute($values);       
            if($result){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $avg_rank = $row['avg_ranking'];
            }
            $stmt = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $avg_rank;
    }

    //Get the list of reviews by the given id
    function getReviews($pdo, $object_id){ 
        $reviews = [];
        try {
            $sql = "SELECT * FROM review WHERE `object_id` = :objectid";
            $stmt = $pdo->prepare($sql);
            $values = [':objectid' => $object_id];
            $result = $stmt->execute($values);       
            if($result){
                $reviews = $stmt->fetchAll();
             }
            $stmt = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $reviews;
    }

?>

