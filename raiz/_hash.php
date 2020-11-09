<?php
// Criar conexão com a DB
include_once( "funcoes.php" );
include_once( "inc/conectaDB.php" );
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Usuário</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
    <h2>Usuário</h2>

    
    <form action="#" method="POST">
        <?php
                echo "<p>Usuário: </p>";
                echo "<input id='UsuUsuario' name='UsuUsuario' class='UsuUsuario' size='25' ><br/>";
                echo "<p>Senha: </p>";
                echo "<input type='password' id='Senha' name='Senha' class='Senha' size='25' >";
                echo "<br /><br />";
        ?>
        <button class="botao" type="submit" name="submit">CADASTRA NOVO AUTOR</button>
    </form>

    <?php     
        $password =utf8_encode("blabla");
        echo $password;
        $hash = hash('sha256', $password);

    echo "hash:" . $hash;
?>




    </div>
</body>

</html>
<?php include_once( "inc/i_desconectaDB.php" ); ?>
