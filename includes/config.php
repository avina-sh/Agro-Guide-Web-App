<?php
    session_start();

    $timezone = date_default_timezone_set("Asia/Kolkata");

    $con = mysqli_connect("localhost", "root", "", "farmers");

    if (mysqli_connect_errno()){
        "Connection Failed :"  . mysqli_connect_errno();
    }

?>