<?php 

    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "phppos";

    $conn = mysqli_connect($host,$user,$pass,$dbname);

    if(!$conn)
    {
        echo"Error connecting";
    }

?>