<?php
include_once( "inc/i_funcoes.php" );
include_once( "inc/i_conectaDB.php" );
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Usuário</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">


    </div>
    <?php
    if (empty(!$_GET)) {
        // echo "Tem GET sim";
        if (array_key_exists("r",$_GET)) {
            $r = $_GET ['r'];
           // echo "r: " . $r . "<br />";
            if ($r == "loginfalhou"){
                // msg falha login
                $msg = "<p>Seu login falhou! Tente novamente</p>";
            } 
        } 
    } else {
            // msg faça login
            $msg = "<p>Você precisa se identificar <br />antes de usar o sistema</p>";
    }
    echo "<div id='myModal' class='modal'>";
        echo "<div class='modal-content'>";
            echo "<div id='divLogin'>";
            echo "<div id='logoCitacoes'><img src='img/logo-citacoes.png'></a></div>";
            echo "<div class='espaco30'></div>";
            echo "<h2>Login</h2>";
            echo $msg;
            echo "<hr>";
                echo "<form action='verificaLogin.php' method='POST'>";
                    echo "<p>Usuário: </p>";
                    echo "<input id='usuario' name='usuario' class='usuario' size='25' ><br/>";
                    echo "<p>Senha: </p>";
                    echo "<input type='password' id='senha' name='senha' class='senha' size='25' >";
                    echo "<br /><br />";
                    echo "<button class='botao' type='submit' name='submit'>LOGIN</button>";
                echo "</form>";
            echo "</div>"; // fecho divLogin
        echo "</div>"; // fecho modal-content
    echo "</div>"; // fecho myModal
    ?>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        //var btn = document.getElementsByClassName("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        //function myFunction() {
        //    modal.style.display = "block";
        //}

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>
</body>

</html>
<?php include_once( "inc/i_desconectaDB.php" ); ?>
