<?php
    session_start();
    ?>
    <html>
    <head>
      <link rel="stylesheet" href="style_chat.css" />
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/1.1.9/js/libs/jquery-1.10.2.min.js"></script>
    </head>
    <body>
    <div class='header'>
      <h1>
        Page de chat
      </h1>
    </div>
    <div class='framechat'>
    <!-- Vérifier si l'utilisateur est connecté ou non -->
    <?php if(isset($_POST['receive'])) { ?>
    <div id='result'></div>
    <div class='chatbody'>
      <form method="post" onsubmit="return lancerlechat();">
      <input type='text' name='chat' id='msgbox' placeholder="Tapez votre message ICI" />
      <input type='submit' name='send' id='send' class='btn btn-send' value='Envoyer' />
      <input type='button' name='clear' class='btn btn-clear' id='clear' value='X' title="Effacer la discussion" />
    </form>
    <script>
    // Fonction Javascript pour soumettre le nouveau chat entré par l'utilisateur
    function lancerlechat(){
        if($('#chat').val()=='' || $('#msgbox').val()=='') return false;
        $.ajax({
          url:'chat.php',
          data:{
              msg:$('#msgbox').val(),
              receive:"<?php echo $_POST['receive'] ?>",
              send:true
          },
          method:'post',
          success:function(data){
			// Récupérer les enregistrements du chat et les ajouter à div avec id=result
            $('#result').html(data); 
			//Effacer la boîte de dialogue après une soumission réussie
            $('#msgbox').val(''); 
			// Ramener la barre de défilement au bas dans le cas où le chat est longue
            document.getElementById('result').scrollTop=document.getElementById('result').scrollHeight; 
          }
        })
        return false;
    };
    // Fonction permettant de vérifier à tout moment si quelqu'un a soumi un nouveau chat.
    setInterval(function(){
      $.ajax({
          url:'chat.php',
          data:{
              get:true,
              receive:"<?php echo $_POST['receive'] ?>"
          },
          method:'post',
          success:function(data){
            $('#result').html(data);
          }
      })
    },1000);
    // Fonction d'accès à l'historique des chats
    $(document).ready(function(){
      $('#clear').click(function(){
        if(!confirm('Êtes-vous sûr de vouloir effacer le chat?'))
          return false;
        })
    })
    </script>
    <?php } else { ?>
    <div class='controlepanel'>
      <form method="post" id="myForm">
        <input type='text' class='input-user' placeholder="Entrez le mail du destinataire" name='receive' />
        <input type='submit' class='btn btn-user' value='Démarrer le chat' />
      </form>
    </div>
    <?php } ?>
    </div>
    </body>
    </html>