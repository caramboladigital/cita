<?php

// Este é a página de busca

include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

confirmacao_logado(); 

?>
<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo xpre("Busca"); ?></title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>
<body>
<div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); ?>
        <h1><?php echo xpre("Busca"); ?></h1>
        <div id="formAutor">
            <form action="resultadoBusca.php" method="POST">
                <?php
                echo "<p>" . xpre("Buscar por") . "</p>";
                echo "<input id='expressaoBusca' name='expressaoBusca' class='expressaoBusca' size='25' ><br/>";
                echo "<br />";
                ?>
                <button  class="botao" type="submit" name="submit"><?php echo xpre("Buscar"); ?></button>
            </form>
        </div>
    </div>
</body>

</html>
<?php include_once( "inc/i_desconectaDB.php" );
?>
