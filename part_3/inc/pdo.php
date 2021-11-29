<?php

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

    // Declair a PDO object
    $pdo = NULL;
    // Connection inside a try/catch block
    try
    {
        // PDO object creation
        $pdo= new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch (PDOException $e )
    {
        //If there is an error, throw an exception
        echo 'Database connection failed.';
        die();
    }
?>