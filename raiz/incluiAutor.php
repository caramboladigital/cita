<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>

<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo xpre("Cadastra autor"); ?></title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); ?>
        <h1><?php echo xpre("Cadastra autor"); ?></h1>
        <div id="formAutor">
            <form action="commitCreateAutor.php" method="POST">
                <?php
                echo "<p>" . xpre("Sobrenome") . "</p>";
                echo "<input id='AutSobrenome' name='AutSobrenome' class='AutSobrenome' size='25' ><br/>";
                echo "<p>" . xpre("Nome") . "</p>";
                echo "<input id='AutNome' name='AutNome' class='AutNome' size='25' >";
                echo "<br /><br />";
                ?>
                <button  class="botao" type="submit" name="submit"><?php echo xpre("Cadastra novo autor"); ?></button>
            </form>
        </div>
    </div>
</body>

</html>


