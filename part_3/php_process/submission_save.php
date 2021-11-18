<?php
// start the session
session_start();
    // check if the user input is empty, if not, save the object information to database, set values for different eroor througn session
    if ((isset($_POST['txt-shopname'])) && (isset($_POST['txt-description']))  && 
        (isset($_POST['txt-latitude'])) && (isset($_POST['txt-longitude'])) && (isset($_POST['image-upload'])) && (isset($_POST['video-upload']))) {
        if((!empty( $_POST['txt-shopname']) ) && (!empty( $_POST['txt-description']))
            && (!empty( $_POST['txt-latitude'])) && (!empty( $_POST['txt-longitude'])) && (!empty($_POST['image-upload'])) && (!empty( $_POST['video-upload']))){
            
            //database variables
            //local server
            $servername = 'localhost';                   
            $username = 'root';
            $password = '';
            $dbname = '4ww3_project';
            $url = 'http://localhost/4ww3project/part_3/';

            // //aws server 
            // $servername = '3.142.111.3:3306';
            // $username = 'root';
            // $password = 'YEfang2021';
            // $dbname = '4ww3_project';  
            // $url = 'https://fangy.app/4ww3project/part_3/';
            
            //check if the table and object exist in the database
            echo "create_objects_table: ";
            print(create_objects_table($servername, $username, $password, $dbname));
            echo "<br/>";
            echo "<br/>";
            echo "is_exist: ";
            print(is_exist($servername, $username, $password, $dbname, $_POST['txt-shopname']));
            echo "<br/>";
            echo "<br/>";
            // exit();
            if((create_objects_table($servername, $username, $password, $dbname)) && (!is_exist($servername, $username, $password, $dbname, $_POST['txt-shopname']))){
                //if the object does not exist, save the object to database and rederect to the login page, else stay in the registrationpage
                if(save_object($servername,  $username, $password, $dbname, $_POST['txt-shopname'], $_POST['txt-description'], $_POST['txt-latitude'], $_POST['txt-longitude'], $_POST['image-upload'], $_POST['video-upload'])){
                    $object_id = get_object($servername, $username, $password, $dbname, $_POST['txt-shopname'], $_POST['txt-latitude'], $_POST['txt-longitude']);
                    //redirect to a page
                    $url =$url . "individual_object.php?id=$object_id";
                    header('Location: ' .$url);  
                }else{
                    $url =$url . "submission_object.php?txt-shopname={$_POST['txt-shopname']}&txt-description={$_POST['txt-description']}&txt-latitude={$_POST['txt-latitude']}&txt-longitude={$_POST['txt-longitude']}";
                    header('Location: ' .$url);
                }                                                   
            }else{                          
                $url =$url . "submission_object.php?txt-shopname={$_POST['txt-shopname']}&txt-description={$_POST['txt-description']}&txt-latitude={$_POST['txt-latitude']}&txt-longitude={$_POST['txt-longitude']}";
                header('Location: ' .$url);
            }

        }else{
            $_SESSION['object_submission_status_message'] = 'empty';
            $url =$url . "submission_object.php?txt-shopname={$_POST['txt-shopname']}&txt-description={$_POST['txt-description']}&txt-latitude={$_POST['txt-latitude']}&txt-longitude={$_POST['txt-longitude']}";
            header('Location: ' .$url);
        }                

    }else{
        $_SESSION['object_submission_status_message'] = 'empty';
        $url =$url . "submission_object.php?txt-shopname={$_POST['txt-shopname']}&txt-description={$_POST['txt-description']}&txt-latitude={$_POST['txt-latitude']}&txt-longitude={$_POST['txt-longitude']}";
        header('Location: ' .$url);
    }            


    //Create table if the table does not exist
    function create_objects_table($servername, $username, $password, $dbname){ 
        //variable for if the table exist or is created successfully
        $is_successful = false;             
        try {
            //Create connection  
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //Check if the table exists
            // $sql = "SELECT * FROM objects LIMIT 1";
            $sql = "SHOW TABLES LIKE 'objects'";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            // echo "type of result: ";
            // print(gettype($result));
            // echo "<br/>type of stmt: ";
            // print(gettype($stmt));
            // echo "<br/>";
            // echo "<br/>";
            //if not exists, create a table
            if($result === false){
                //Create a table
                $sql="CREATE TABLE objects(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    shopname VARCHAR(100) NOT NULL,
                    shop_description VARCHAR(300) NOT NULL UNIQUE,
                    latitude DOUBLE NOT NULL,
                    longitude DOUBLE NOT NULL,
                    url_image VARCHAR(100) NOT NULL,
                    url_video VARCHAR(100) NOT NULL,
                    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                //executing and verifying query
                if($dbh->query($sql)){
                    $is_successful = true;
                }else{
                    $_SESSION['object_submission_status_message'] = 'database_create_table_error';
                 }  
            }else{
                $is_successful = true;
            }
            //closing the connection
            $stmt = null;
            $dbh = null; 
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $is_successful;
    }

    //check if the given object(with same shopname) exist in the database
    function is_exist($servername, $username, $password, $dbname, $shopname){ 
        $is_exist = false;        
        try {
            //Create connection  
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //Query if the object by the given shop name
            $stmt = $dbh->prepare('SELECT * FROM `objects` WHERE `shopname` = :shopname ');
            $stmt->bindValue(':shopname', $shopname);
            $result = $stmt->execute();
            // echo "type of result: ";
            // print(gettype($result));
            // echo "<br/>type of stmt: ";
            // print(gettype($stmt));
            // echo "<br/>";
            // echo "<pre>";
            // print_r($stmt);
            // echo "<br/>";
            // echo "<br/>object exist - condition: ";
            // print(($result == true) && ($stmt->rowCount() > 0));
            //Check if the object exists
            if(($result == true) && ($stmt->rowCount() > 0)){
                $_SESSION['object_submission_status_message'] = 'is_object_exist';
                $is_exist = true;            
            }
            //closing the connection
            $stmt = null;
            $dbh = null; 
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $is_exist;
    }


    //Insert the objec to the database
    function save_object($servername,  $username, $password, $dbname, $shopname, $description, $latitude, $longitude, $url_image, $url_video){ 
        //variable to check if the object is saved in the database successfully
        $is_successful = false;                    
        try {
            //Create connection  
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //Insert the data into the objects table
            $sql="INSERT INTO objects(shopname, shop_description, latitude, longitude, url_image, url_video) 
                VALUES (\"$shopname\", \"$description\", \"$latitude\", \"$longitude\", \"$url_image\", \"$url_video\")";
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute();
            // $stmt = $dbh->prepare('SELECT * FROM `objects` WHERE `shopname` = :shopname ');
            // $stmt->bindValue(':shopname', $shopname);
            if($result){
                  $is_successful = true;
            }else{
                $_SESSION['object_submission_status_message'] = 'database_save_object_error';
            }
            //closing the connection
            $stmt = null;
            $dbh = null;                
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }                    
        return $is_successful;
    } 
    
    //Insert the objec to the database
    function get_object($servername,  $username, $password, $dbname, $shopname, $latitude, $longitude){ 
        $object_id = -1;
        try {
            //Create connection  
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //query the object
            $sql = "SELECT * FROM objects WHERE shopname = \"$shopname\" AND latitude = \"$latitude\" AND longitude = \"$longitude\"";
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute();
            if($result){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $object_id = $row['id'];
            }
            //closing the connection
            $stmt = null;
            $dbh = null;                
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $object_id; 
    }  

?>

