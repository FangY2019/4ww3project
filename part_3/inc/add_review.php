<?php
    include 'pdo.php';

    // check if the input is empty, if not, save the review information to database
    if ((isset($_POST['object-id'])) && (isset($_POST['username']))  && 
        (isset($_POST['ranking'])) && (isset($_POST['comments']))) {
        if((!empty( $_POST['object-id']) ) && (!empty( $_POST['username'])) && (!empty( $_POST['comments']))){
            $object_id = htmlentities($_POST['object-id']);
            $username = htmlentities($_POST['username']);
            $ranking = htmlentities($_POST['ranking']);
            $comments = htmlentities($_POST['comments']);  
            if(create_review_table($pdo)){
                //if save the review to database successfully, refresh the page
                if(save_review($pdo, $object_id, $username, $ranking, $comments)){
                    // $url = "http://localhost/4ww3project/part_3/individual_object.php?id=$object_id";
                    $url = "https://fangy.app/4ww3project/part_3/individual_object.php?id=$object_id";
                    header('Location: ' .$url);  
                }                                              
            }
        }else{
            echo 'Error: Ivalid review submission1';
        }
    }else{
        echo 'Error: Ivalid review submission2';
    }
    //closing the connection
    $pdo = null;           


    //Create the review table if the table does not exist
    function create_review_table($pdo){ 
        //variable for if the table exist or is created successfully
        $is_successful = false;           
        try {
            //Check if the table exists
            $sql = "SHOW TABLES LIKE 'review'";
            $stmt = $pdo ->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            if($result === false){
                //Create a table
                $sql="CREATE TABLE review(
                    review_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    object_id INT(6) UNSIGNED NOT NULL REFERENCES objects(id),
                    username VARCHAR(100) NOT NULL REFERENCES users(username),
                    ranking INT(6) NOT NULL,
                    comments VARCHAR(300) NOT NULL,
                    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                //executing and verifying query
                if($pdo->query($sql)){
                    $is_successful = true;
                }else{
                    echo "Error: fail to create a review table!";
                 }  
            }else{
                $is_successful = true;
            }
            $stmt = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $is_successful;
    }  

    //Insert the review to the database
    function save_review($pdo, $object_id, $username, $ranking, $comments){ 
        //variable to check if the review is saved in the database successfully
        $is_successful = false;
        try{
            //Save the review to database    
            //Insert the data into the review table
            $sql="INSERT INTO review(object_id, username, ranking, comments) 
                VALUES (:object_id, :username, :ranking, :comments)";
            $stmt = $pdo->prepare($sql);
            $values = [':object_id' => $object_id, ':username' => $username, ':ranking' => $ranking, ':comments' => $comments];
            $result = $stmt->execute($values);
            if($result){
                  $is_successful = true;
            }else{
                echo 'Error: fail to save the review in database!';
            }
            $stmt = null;      
        }catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }                    
        return $is_successful;
    }
?>

