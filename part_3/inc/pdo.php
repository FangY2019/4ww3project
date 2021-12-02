<?php
    //EC2 database variables
    $servername = 'ec2-3-142-111-3.us-east-2.compute.amazonaws.com';              
    $username = 'admin';
    $password = 'Mysql@1234';
    $dbname = '4ww3_project';

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