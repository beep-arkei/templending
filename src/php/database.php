<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "lendingdb";
    $conn = "";

    $conn = mysqli_connect($db_server, 
                            $db_user, 
                            $db_pass, 
                            $db_name);
    if($conn){
        echo "Connected to database";
    }
    else{
        echo "Failed to connect to database";
    }
?>