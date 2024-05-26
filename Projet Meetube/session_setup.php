<?php
session_start();
function session_setup($key, $file)
{
    if($key == 1 || $key == 3){
        $_SESSION['mail'] = $file['mail'];
        $_SESSION['name'] = $file['name'];
        $_SESSION['password'] = $file['password'];
        $_SESSION['sub'] = $file['sub'];
    }
    if($key == 2 || $key == 3){
        $_SESSION['genre'] = $file['genre'];
        $_SESSION['birthday'] = $file['birthday'];
        $_SESSION['age'] = $file ['age'];
        $_SESSION['ytb_video'] = $file['ytb_video'];
        $_SESSION['work'] = $file['work'];
        $_SESSION['address'] = $file['address'];
        $_SESSION['height'] = $file['height'];
        $_SESSION['weight'] = $file['weight'];
        $_SESSION['eyes'] = $file['eyes'];
        $_SESSION['situation'] = $file['situation'];
        $_SESSION['hairs'] = $file['hairs'];
        $_SESSION['wish'] = $file['wish'];
    }
    if ($key == 3 && isset($file['active_conv'])){
        $_SESSION['active_conv'] = $file['active_conv'];
    }
    if ($key == 3 && isset($file['visits'])){
        $_SESSION['visits'] = $file['visits'];
    }
}
