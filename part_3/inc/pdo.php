<?php
    // File includes EC2 database variables 
    include 'env.php';

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