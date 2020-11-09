<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>

<html>

<head>
    <meta charset="utf-8" />
    <title>Cadastra palavra-chave</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); ?>
        <h1>Cadastra palavra-chave</h1>
        <div id="FormPalavra">
            <form action="commitCreatePalavra.php" method="POST">
                <?php
                echo "<input id='PalPalavra' name='PalPalavra' class='PalPalavra' size='25' >";
                echo "<br /><br />";
                ?>
                <button class="botao" type="submit" name="submit">CADASTRA PALAVRA-CHAVE</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php
// 5. Close connection
include_once( "inc/i_desconectaDB.php" );
?>
