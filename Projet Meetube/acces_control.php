<?php
    session_start();
    $error = 1;
    if (!isset($_SESSION['mail'])){
        $error = 0;
        header("Location:index.php");
    }
