<?php
    // File includes key and secret of amazon S3 buckets 
    include 'env.php';
    // PDO object 
    include 'pdo.php';
    //Include the SDK using the ZIP file run the SDK
    include 'assets/aws/aws-autoloader.php';
    use Aws\S3\S3Client;
    use Aws\S3\Exception\S3Exception;
    // AWS bucket name
    $bucketName = '4ww3projectbucket';
    //Define variable for prefill form and errors
    $shopname = '';
    $description = '';
    $latitude = '';
    $longitude = '';
    $image = '';
    $video = '';
    $errors = [];
    // check if the user input is empty, if not, save the object information to database
    if ((isset($_POST['txt-shopname'])) && (isset($_POST['txt-description']))  && 
        (isset($_POST['txt-latitude'])) && (isset($_POST['txt-longitude'])) && (isset($_FILES['image-upload'])) && (isset($_FILES['video-upload']))) {
        if((!empty( $_POST['txt-shopname']) ) && (!empty( $_POST['txt-description']))
            && (!empty( $_POST['txt-latitude'])) && (!empty( $_POST['txt-longitude'])) && (!empty($_FILES['image-upload'])) && (!empty( $_FILES['video-upload']))){
            $shopname = htmlentities($_POST['txt-shopname']);
            $description = htmlentities($_POST['txt-description']);
            $latitude = htmlentities($_POST['txt-latitude']);
            $longitude = htmlentities($_POST['txt-longitude']);       
            //check if the table and object exist in the database
            if((create_objects_table($pdo)) && (!is_exist($pdo, $shopname))){
                //if the object does not exist, save the object to database and rederect to the login page, else stay in the registration page
                if(save_object($pdo, $shopname, $description, $latitude, $longitude)){
                    $object_id = get_object($pdo, $shopname, $latitude, $longitude);                    
                    //redirect to a page
                    // $url = "http://localhost/4ww3project/part_3/individual_object.php?id=$object_id";
                    $url = "https://fangy.app/4ww3project/part_3/individual_object.php?id=$object_id";
                    
                    header('Location: ' .$url);  
                }                                              
            }
        }else{
            $errors['object_submission_status_message'] = 'empty';
        }
    }else{
        $errors['object_submission_status_message'] = 'empty';
    }
    //closing the connection
    $pdo = null;        

    //Create table if the table does not exist
    function create_objects_table($pdo){ 
        //variable for if the table exist or is created successfully
        $is_successful = false;           
        try {
            //Check if the table exists
            // $sql = "SELECT * FROM objects LIMIT 1";
            $sql = "SHOW TABLES LIKE 'objects'";
            $stmt = $pdo ->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            //if not exists, create a table
            if($result === false){
                //Create a table
                $sql="CREATE TABLE objects(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    shopname VARCHAR(100) NOT NULL UNIQUE,
                    shop_description VARCHAR(300) NOT NULL,
                    latitude DOUBLE NOT NULL,
                    longitude DOUBLE NOT NULL,
                    image_url_key VARCHAR(100) NOT NULL,
                    video_url_key VARCHAR(100) NOT NULL,
                    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                //executing and verifying query
                if($pdo->query($sql)){
                    $is_successful = true;
                }else{
                    GLOBAL $errors;
                    $errors['object_submission_status_message'] = 'database_create_table_error';
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

    //check if the given object(with same shopname) exist in the database
    function is_exist($pdo, $shopname){ 
        $is_exist = false;      
        try {
            //Query if the object by the given shop name
            $stmt = $pdo->prepare('SELECT * FROM `objects` WHERE `shopname` = :shopname ');
            $stmt->bindValue(':shopname', $shopname);
            $result = $stmt->execute();
            //Check if the object exists
            if(($result == true) && ($stmt->rowCount() > 0)){
                GLOBAL $errors;
                $errors['object_submission_status_message'] = 'is_object_exist';
                $is_exist = true;            
            }
            $stmt = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $is_exist;
    }

    //Insert the objec to the database
    function save_object($pdo, $shopname, $description, $latitude, $longitude){ 
        //variable to check if the object is saved in the database successfully
        $is_successful = false;
        GLOBAL $bucketName;
        GLOBAL $IAM_KEY;
        GLOBAL $IAM_SECRET;     
        //Create a S3Client
        $s3 = new S3Client([
            'region'  => 'us-east-2',
            'version' => 'latest',
            'credentials' => [
                'key'    => $IAM_KEY,
                'secret' => $IAM_SECRET,
            ]
        ]);
        //Hash the filename using SHAS256 hashing algorithm
        //Generate a random prefix for the key of file
        $random_name = bin2hex(random_bytes(10));
        $keyNameOfImage = $random_name . basename($_FILES['image-upload']['name']); 
        $keyNameOfVideo = $random_name . basename($_FILES['video-upload']['name']);
        // Temp file location
        $fileImage = $_FILES["image-upload"]['tmp_name'];
        $fileVideo = $_FILES["video-upload"]['tmp_name'];
        //Upload image and video to S3
        try{
            //Upload the image 
            $s3->putObject([
            'Bucket' => $bucketName,
            'Key'    => $keyNameOfImage,
            'SourceFile' => $fileImage,  
            ]);
            //Upload the video 
            $s3->putObject([
                'Bucket' => $bucketName,
                'Key'    => $keyNameOfVideo,
                'SourceFile' => $fileVideo,  
                ]);
            
            //Save the object to database    
            //Insert the data into the objects table
            $sql="INSERT INTO objects(shopname, shop_description, latitude, longitude, image_url_key, video_url_key) 
                VALUES (:shopname, :shopdescription, :latitude, :longitude, :keyNameOfImage, :keyNameOfVideo)";
            $stmt = $pdo->prepare($sql);
            $values = [':shopname' => $shopname, ':shopdescription' => $description, ':latitude' => $latitude, ':longitude' => $longitude, ':keyNameOfImage' => $keyNameOfImage, ':keyNameOfVideo' => $keyNameOfVideo];
            $result = $stmt->execute($values);
            if($result){
                  $is_successful = true;
            }else{
                GLOBAL $errors;
                $errors['object_submission_status_message'] = 'database_save_object_error';
            }
            $stmt = null;      
        }catch(S3Exception $e){
            echo $e->getMessage();
            die();
        }catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }                    
        return $is_successful;
    } 
    
    //Insert the objec to the database
    function get_object($pdo, $shopname, $latitude, $longitude){ 
        $object_id = -1;
        try {
            //query the object
            $sql = "SELECT * FROM objects WHERE shopname = :shopname AND latitude = :latitude AND longitude = :longitude";
            $stmt = $pdo->prepare($sql);
            $values = [':shopname' => $shopname, ':latitude' => $latitude, ':longitude' => $longitude];
            $result = $stmt->execute($values);
            if($result){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $object_id = $row['id'];
            }
            $stmt = null;              
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $object_id; 
    }  

?>

