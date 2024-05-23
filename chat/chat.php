<?php
    session_start();
    if(isset($_POST['send']) && $_POST['send']==true)
	{
      // Code pour sauvegarder et envoyer le chat
      $msgs = fopen("data.txt", "a");
      $data="<b>".$_SESSION['username'].':</b> '.$_POST['msg']."<br>";
      fwrite($msgs,$data);
      fclose($msgs);
      $msgs = fopen("data.txt", "r");
      echo fread($msgs,filesize("data.txt"));
      fclose($msgs);
    } else if(isset($_POST['get']) && $_POST['get']==true)
	{
      // Code pour envoyer l'historique du chat à l'utilisateur
      $msgs = fopen("data.txt", "r");
      echo fread($msgs,filesize("data.txt"));
      fclose($msgs);
    } else if(isset($_POST['clear']) && $_POST['clear']==true)
	{
      // Code pour effacer l'historique des chats
      $msgs = fopen("data.txt", "w");
      $data="<b>".$_SESSION['username']."</b> a effacé l'historique du chat.<br>";
      fwrite($msgs,$data);
      fclose($msgs);
    }