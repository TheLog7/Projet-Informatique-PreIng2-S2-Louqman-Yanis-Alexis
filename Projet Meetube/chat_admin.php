<?php
    session_start();
    if($_SESSION['sub'] != 2){
        header("Location:profil.php");
    }
    $users = json_decode(file_get_contents('./Comptes/users.json'), true);
    if (!isset($_SESSION['name'])) {
        header("Location: index.php");
        exit;
    }
    if(isset($_POST['sender'])){
        $_SESSION['sender_seen'] = $_POST['sender'];
    }
    if(isset($_POST['change_sender']) || isset($_POST['profil'])){
        unset($_SESSION['sender_seen']);
    }
    if (isset($_POST['profil'])) {
        header("Location: profil.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="chat_admin.css">
        <title>Chat Administrateur</title>
        <link rel="icon" href="icon_titre.ico" type="image/gif">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/1.1.9/js/libs/jquery-1.10.2.min.js"></script>
    </head>
    <body class="body-light">
        <input type="checkbox" id="on">
        <label for="on" class="theme"></label>
        <div class="container">
            <div class='header'>
                <div class='page-chat'>
                    <h1 id="moving-text">
                        &nbsp;&nbsp;&nbsp;Page Admin
                    </h1>
                </div>
            </div>
            <div class='framechat'>
                <?php if(isset($_SESSION['sender_seen']) && isset($_POST['receive'])) {
                ?>
                <div id='result'>
                    <script>
                        function effacermessage(id){
                            $.ajax({
                                url:'remove_admin.php',
                                data:{
                                    receive:"<?php echo $_POST['receive'] ?>",
                                    sender:"<?php echo $_SESSION['sender_seen'] ?>",
                                    id:id
                                },
                                method:'POST',
                            })
                            return false;
                        };
                    </script>
                </div>
                <div class='chatbody'>
                    <form method="post" action="">
                        <input type='submit' name='clear' class='btn btn-clear' id='clear' value='Changer de destinataire' />
                        <input type='submit' id="start-chat" class='btn btn-user' value="Changer l'expediteur" name="change_sender"/>
                        <input type='submit' id="start-chat" class='btn btn-user' value="Votre profil" name="profil"/>
                    </form>
                    <script>
                        setInterval(function(){
                            $.ajax({
                                url:'chat_admin_print.php',
                                data:{
                                    get:true,
                                    receive:"<?php echo $_POST['receive'] ?>",
                                    sender:"<?php echo $_SESSION['sender_seen'] ?>"
                                },
                                method:'post',
                                success:function(data){
                                    $('#result').html(data);
                                }
                            })
                        },1000);
                    </script>
                    <?php }
                    elseif (isset($_SESSION['sender_seen'])){
                        $active_conv = json_decode(file_get_contents('./Comptes/'.$_SESSION['sender_seen'].'.json'),true);
                        if(isset($active_conv['active_conv'])){
                            $active_conv = $active_conv['active_conv'];
                        }
                        else{
                            $active_conv = [];
                        }
                    ?>
                        <div class='controlepanel'>
                            <form method="post" id="myForm">
                                <select name="receive" class='input-user' id="start-mail">
                                    <?php foreach ($active_conv as $keys => $values){
                                        foreach ($values as $mail => $name){?>
                                            <option value="<?php echo $mail?>"> <?php echo $name ?> </option>
                                        <?php }} ?>
                                </select>
                                <?php if($active_conv != []){ ?>
                                <input type='submit' id="start-chat" class='btn btn-user' value='Démarrer le chat' />
                                <?php  }?>
                                <input type='submit' id="start-chat" class='btn btn-user' value="Changer l'expediteur" name="change_sender"/>
                            </form>
                            <form method="post" id="myForm">
                                <input type='submit' id="start-chat" class='btn btn-user' value="Votre profil" name="profil"/>
                            </form>
                        </div>
                    <?php }
                    else { ?>
                        <div class='controlepanel'>
                            <form method="post" id="myForm">
                                <select name="sender" class='input-user' id="start-mail">
                                <?php foreach ($users as $keys => $values){ ?>
                                    <option value="<?php echo $values['mail']?>"> <?php echo $values['name'] ?> </option>
                                <?php } ?>
                                </select>
                                <input type='submit' id="start-chat" class='btn btn-user' value='Choisir cet expéditeur' />
                            </form>
                            <form method="post" id="myForm">
                                <input type='submit' id="start-chat" class='btn btn-user' value="Votre profil" name="profil"/>
                            </form>
                        </div>
                    <?php } ?>
                    </div>
            </div>
        </div>
        <script src="script_chat_admin.js"></script>
    </body>