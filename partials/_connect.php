<?php
    // connecting to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "fastpay";

    // creating an connection
    $conn = mysqli_connect($servername,$username,$password,$database);

    // Die if connection failed
    if (!$conn) {
        die ("Sorry we failed to connect to database : <br>" . mysqli_connect_error());
    }
    else {
        // echo "Connected to database!<br>";
    }            
?>