<?php
    session_start();

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) { 
        if ((isset( $_POST['registration_token']))) {
            if ( (!empty( $_POST['registration_token']))) {
                if ( (isset($_POST['txt-username'])) && (isset($_POST['txt-email']))  && 
                    (isset($_POST['txt-password'])) && (isset($_POST['country'])) && (isset($_POST['terms']))) {
                    if((!empty( $_POST['txt-username']) ) && (!empty( $_POST['txt-email']))
                        && (!empty( $_POST['txt-password'])) && (!empty( $_POST['country'])) && (!empty( $_POST['terms']))){
                            //set cookie to generate prefilled form 
                            setcookie('username', $_POST['txt-username'], time() + 60, "/"); // 1 minute
                            setcookie('email', $_POST['txt-email'], time() + 60, "/"); 
                            setcookie('password', $_POST['txt-password'], time() + 60, "/"); 
                            setcookie('country', $_POST['country'], time() + 60, "/");
                            setcookie('terms', $_POST['terms'], time() + 60, "/");
                            // setcookie('username', $_POST['txt-username'], time() + 60, "/", '.fangy.app', TRUE, TRUE); // 1 minute
                            // setcookie('email', $_POST['txt-email'], time() + 60, "/", '.fangy.app', TRUE, TRUE); 
                            // setcookie('password', $_POST['txt-password'], time() + 60, "/", '.fangy.app', TRUE, TRUE); 
                            // setcookie('country', $_POST['country'], time() + 60, "/", '.fangy.app', TRUE, TRUE);
                            // setcookie('terms', $_POST['terms'], time() + 60, "/", '.fangy.app', TRUE, TRUE);
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
                        
                        // create database if the database does not exist
                        create_database($servername, $username, $password, $dbname);
                        // create users table if the table does not exist
                        create_users_table($servername, $username, $password, $dbname);                        
                        //check if the user email exist in the database
                        if(!is_exist($servername, $username, $password, $dbname, $_POST['txt-username'], $_POST['txt-email'])){
                            //if the user does not exist, save the user to database and rederect to the login page, else stay in the registrationpage
                            if(save_user($servername,  $username, $password, $dbname, $_POST['txt-username'], $_POST['txt-email'], $_POST['txt-password'], $_POST['country'])){
                                setcookie('username', null, -1, "/"); 
                                setcookie('email', null, -1, "/"); 
                                setcookie('password', null, -1, "/"); 
                                setcookie('country', null, -1, "/");
                                setcookie('terms', null, -1, "/"); 
                                //redirect to a page
                                $url = "http://localhost/4ww3project/part_3/login.php?registered=true";
                                header('Location: ' .$url);  
                            }else{
                                $url = "http://localhost/4ww3project/part_3/part_3/registration.php";
                                header('Location: ' .$url);
                            }                                                   
                        }else{
                            $url = "http://localhost/4ww3project/part_3/registration.php";
                            header('Location: ' .$url);
                        }

                    }else{
                        $_SESSION['register_status_message'] = 'empty';
                        $url = "http://localhost/4ww3project/part_3/registration.php";
                        header('Location: ' .$url);
                    }                

                }else{
                    $_SESSION['register_status_message'] = 'empty';
                    $url = "http://localhost/4ww3project/part_3/registration.php";
                    header('Location: ' .$url);
                }     
            }else {
                echo 'empty_registration_token';
            }
    
        }else {
            echo 'invalid_registration_token';
        }
    }else {
        echo 'invalid_method';
    }

    //Create database if the database does not exist
    function create_database($servername, $username, $password, $dbname){ 
        $is_successful = false;
        try {
            //create connection
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);       
            //create a database if the database not exists
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            $stmt = $dbh->prepare($sql);
            if ($stmt->execute()) {
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

    //Create table if the table does not exist
    function create_users_table($servername, $username, $password, $dbname){ 
        $is_successful = false;           
        try { 
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //Check if the table exists
            $sql = "SHOW TABLES LIKE 'users'";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            //if not exists, create a table
            if($result === false){
                //Create a table
                $sql="CREATE TABLE users(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(100) NOT NULL,
                    email VARCHAR(100) NOT NULL UNIQUE,
                    pwd VARCHAR(100) NOT NULL,
                    country VARCHAR(100) NOT NULL,
                    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                if($dbh->query($sql)){//executing and verifying query
                    $is_successful = true;
                }else{
                    $_SESSION['register_status_message'] = 'database_create_table_error';
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

    //check if the given username or email exist in the database
    function is_exist($servername, $username, $password, $dbname, $input_username, $input_email){ 
        $is_exist = false;
        try {                 
            //Create connection  
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //Check if the email exist
            $sql = "SELECT email FROM users WHERE email = \"$input_email\"";
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute();
            if(($result == true) && ($stmt->rowCount() > 0)){
                $_SESSION['register_status_message'] = 'is_email_exist';
                $is_exist = true;
            }
            //Check if the username exist
            $sql = "SELECT email FROM users WHERE username = \"$input_username\"";
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute();
            if(($result == true) && ($stmt->rowCount() > 0)){
                $_SESSION['register_status_message'] = 'is_username_exist';
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


    //Insert the user's information to the database
    function save_user($servername,  $username, $password, $dbname, $input_username, $input_email, $input_password, $input_country){ 
        $is_successful = false;                       
        try {
            //Create connection  
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //Insert user data into users table
            $sql="INSERT INTO users(username, email, pwd, country) VALUES (\"$input_username\", \"$input_email\", \"$input_password\", \"$input_country\")";
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute();
            if($result){
                $is_successful = true;
            }else{
                $_SESSION['register_status_message'] = 'database_save_user_error';
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




?>

