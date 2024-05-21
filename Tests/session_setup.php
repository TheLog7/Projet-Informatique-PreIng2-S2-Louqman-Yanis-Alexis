<?php
session_start();
function session_setup($key, $file)
{
    if($key == 1 || $key == 3){
        $_SESSION['mail'] = $file['mail'];
        $_SESSION['nom'] = $file['nom'];
        $_SESSION['mdp'] = $file['mdp'];
    }
    if($key == 2 || $key == 3){
        $_SESSION['genre'] = $file['genre'];
        $_SESSION['birthday'] = $file['birthday'];
        $_SESSION['ytb_video'] = $file['ytb_video'];
    }
}
