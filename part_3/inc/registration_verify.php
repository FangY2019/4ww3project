<?php
    include 'pdo.php';
    $input_username = '';
    $input_email = '';
    $input_password = '';
    $input_confirmed_password = '';
    $input_country = '';
    $input_terms = false;
    $errors = [];

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) { 
        if ((isset( $_POST['registration_token']))) {
            if ( (!empty( $_POST['registration_token']))) {
                if ( (isset($_POST['txt-username'])) && (isset($_POST['txt-email']))  && (isset($_POST['txt-password'])) &&
                    (isset($_POST['txt-confirm-password'])) && (isset($_POST['country'])) && (isset($_POST['terms']))) {
                    if((!empty( $_POST['txt-username']) ) && (!empty( $_POST['txt-email'])) && (!empty( $_POST['txt-password']))
                        && (!empty( $_POST['txt-confirm-password'])) && (!empty( $_POST['country'])) && (!empty( $_POST['terms']))){
                        $input_username = htmlentities($_POST['txt-username']);
                        $input_email = htmlentities($_POST['txt-email']);
                        $input_password = htmlentities($_POST['txt-password']);
                        $input_confirmed_password = htmlentities($_POST['txt-confirm-password']);
                        $input_country = htmlentities($_POST['country']);
                        $input_terms = htmlentities($_POST['terms']);
                        
                        // create database if the database does not exist
                        create_database($pdo, $dbname);
                        // create users table if the table does not exist
                        create_users_table($pdo);                        
                        //check if the user email exist in the database
                        if(!is_exist($pdo, $input_username, $input_email)){
                            //save the user to database and rederect to the login page
                            if(save_user($pdo, $input_username, $input_email, $input_password, $input_country)){
                                //redirect to a page
                                $url = "http://localhost/4ww3project/part_3/login.php?registered=true";
                                header('Location: ' .$url);  
                            }                                               
                        }                        
                    }else{
                        $errors['register_status_message'] = 'empty';
                    }                

                }else{
                    $errors['register_status_message'] = 'empty';
                }     
            }else {
                echo 'empty_registration_token';
            }
    
        }else {
            echo 'invalid_registration_token';
        }
    }
    //closing the connection
    $pdo = null;

    //Create database if the database does not exist
    function create_database($pdo, $dbname){ 
        $is_successful = false;
        try {    
            //create a database if the database not exists
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute()) {
                $is_successful = true;                        
            }
            $stmt = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $is_successful;                      
    }

    //Create table if the table does not exist
    function create_users_table($pdo){ 
        $is_successful = false;         
        try { 
            //Check if the table exists
            $sql = "SHOW TABLES LIKE 'users'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            //if not exists, create a table
            if($result === false){
                //Create a table
                $sql="CREATE TABLE users(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    salt CHAR(40) NOT NULL,
                    passwordhash CHAR(64) NOT NULL,
                    country VARCHAR(100) NOT NULL,
                    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                if($pdo->query($sql)){//executing and verifying query
                    $is_successful = true;
                }else{
                    GLOBAL $errors;
                    $errors['register_status_message'] = 'database_create_table_error';
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

    //check if the given username or email exist in the database
    function is_exist($pdo, $input_username, $input_email){ 
        $is_exist = false;
        try {                 
            //Check if the email exist
            $sql = "SELECT email FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $values = [':email' => $input_email];
            $result = $stmt->execute($values);
            if(($result == true) && ($stmt->rowCount() > 0)){
                GLOBAL $errors;
                $errors['register_status_message'] = 'is_email_exist';
                $is_exist = true;
            }
            //Check if the username exist
            $sql = "SELECT email FROM users WHERE username = \"$input_username\"";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();
            if(($result == true) && ($stmt->rowCount() > 0)){
                GLOBAL $errors;
                $errors['register_status_message'] = 'is_username_exist';
                $is_exist = true;
            }
            // print($is_exist);
            // print_r( $errors);
            // exit();
            $stmt = null;       
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $is_exist;
    }


    //Insert the user's information to the database
    function save_user($pdo, $input_username, $input_email, $input_password, $input_country){         
        $is_successful = false;               
        try {
            //Hash the password using SHAS256 hashing algorithm
            $salt = bin2hex(random_bytes(20));
            $passwordhash = hash('sha256', $input_password . $salt);
            //Insert user data into users table
            // $sql="INSERT INTO users(username, email, salt, passwordhash, country) VALUES (\"$input_username\", \"$input_email\", \"$salt\", \"$passwordhash\", \"$input_country\")";
            $sql="INSERT INTO users(username, email, salt, passwordhash, country) VALUES (:username, :email, :salt, :passwordhash, :country)";
            $stmt = $pdo->prepare($sql);
            $values=[':username' => $input_username, ':email' => $input_email, ':salt' => $salt, ':passwordhash'=> $passwordhash, ':country' => $input_country];
            $result = $stmt->execute($values);
            if($result){
                $is_successful = true;
            }else{
                GLOBAL $errors;
                $errors['register_status_message'] = 'database_save_user_error';
            }
            $stmt = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $is_successful;
    }      

?>

