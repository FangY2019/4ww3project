<?php
    include 'pdo.php';
    //ini_set("display_errors", 0);

    $test = 123;
    $name = '';
    $rows = [];

    if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) { 
        $name = $_GET['name'];
        if($name == NULL){
            $name='';
        }
        $rating = $_GET['stars'];
        $result = getObjectFromDatabaseByName($pdo, $name);
        foreach($result as $row) {
            $average_rank = getAvgRank($pdo, $row['id']);
            if($average_rank >= $rating) {
                $row['rating'] = $average_rank;
                $rows[] = $row;
            }
        }
        //print_r($rows);
        
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

    //Get the average ranking by the given id
    function getAvgRank($pdo, $object_id){ 
        $avg_rank = 0;
        try {
            //Check if the email exist
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
        if($avg_rank==NULL){
            $avg_rank=0;
        }
        return $avg_rank;
    }
?>