<?php
    $server="localhost";
    $username="root";
    $pass="";
    $db="e-notes";
    
    $conn=mysqli_connect($server,$username,$pass,$db);
//     if (!$conn) {
//         die("failed to connect : ".mysqli_connect_error());
//     }else{
//         echo "connected";
//     }
// ?>