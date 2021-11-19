<?php
    session_start();

    $input_username = '';
    $input_password = '';
    $rememberme = false;
    $errors = [];

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) { 
        if ((isset( $_POST['login_token']))) {
            if ( (!empty( $_POST['login_token']))) {
                if ((isset($_POST['txt-username'])) && (isset($_POST['txt-password']))) {
                    if ((!empty($_POST['txt-username']))) {
                        $input_username = htmlentities($_POST['txt-username']);
                        if ((!empty($_POST['txt-password']))) {                      
                            $input_password = htmlentities($_POST['txt-password']);
                            if(isset($_POST['lblrememberme']) && !empty( $_POST['lblrememberme'])){
                                $rememberme = true;
                            }
                            //database variables
                            //local server
                            $servername = 'localhost';                   
                            $username = 'root';
                            $password = '';
                            $dbname = '4ww3_project';

                            // //aws server 
                            // $servername = '3.142.111.3:3306';
                            // $username = 'root';
                            // $password = 'YEfang2021';
                            // $dbname = '4ww3_project'; 
                            
                    
                            //check if the user email exist in the database
                            if(login($input_username, $input_password)){
                                $_SESSION['username'] = $input_username;
                                $_SESSION['valid'] = true;
                                $lblrememberme = '0';
                                if(isset($_POST['lblrememberme'])){
                                    if(!empty( $_POST['lblrememberme'])){
                                        setcookie('rememberme', '1', time() + (86400 * 30), "/"); //86400 = 30days
                                        setcookie('username', $input_username, time() + (86400*30), "/");
                                    }else{
                                        setcookie('rememberme', null, -1, "/"); //86400 = 30days
                                        setcookie('username', null, -1, "/");
                                    }
                                }else{
                                    setcookie('rememberme', null, -1, "/"); //86400 = 30days
                                    setcookie('username', null, -1, "/");
                                }                            
                                //redirect to a page
                                $url = "http://localhost/4ww3project/part_3/index.php";
                                header('Location: ' .$url);
                            }
                            //invalid user name and password, login failed
                            else{                        
                                $errors['login_status_message'] = 'invalid';
                            }
                        }
                        //empty password
                        else{                     
                            $errors['login_status_message'] = 'empty';
                        } 
                    }
                    //empty username
                    else{                     
                        $errors['login_status_message'] = 'empty';
                    } 
                }
                //empty input
                else{                
                    $errors['login_status_message'] = 'empty';
                    // print_r($_POST);
                    // exit();
                }     
            }else {
                echo 'empty_login_token';
            }
    
        }  else {
            echo 'invalid_login_token';
        }
    }else {
        echo 'invalid_method';
    }

    //Check if the given username and password match a record in the database
    function login($input_username, $input_password){ 
        $is_successful = false;
        GLOBAL $servername;  
        GLOBAL $dbname;
        GLOBAL $username;
        GLOBAL $password;                 
        try {
            //Create connection  
            $dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            //Check if the email exist
            $sql = "SELECT pwd FROM users WHERE username = \"$input_username\"";
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute();
            if($result){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row['pwd'] === $input_password){
                    $is_successful = true;
                }
            }
            //closing the connection
            $stmt = null;
            $dbh = null;
        } catch (PDOException $e) {
            GLOBAL $errors;
            $errors['status_message'] = 'invalid';
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $is_successful;
    }

?>

