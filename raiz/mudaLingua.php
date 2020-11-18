<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Opção de língua</title>
    <?php include_once("inc/i_links.php"); ?>
</head>

<body>
    <div id="divGeral">
        <?php include_once("inc/i_topo.php"); ?>
        <h1>Opção de língua</h1>
        <div id="editaPalavra">

            <?php

            $UsuLingua = $_GET['UsuLingua'];
            echo "lingua: " .  $UsuLingua;
            
            $query1 = "UPDATE usuario ";
            $query1 .= "SET UsuLingua = '".   $UsuLingua . "' ";
            $query1 .= "WHERE IdUsuario = ". $_SESSION["IdUsuario"] ;
            mysqli_set_charset($connection, "utf8");
            $result1 = mysqli_query($connection, $query1);
            if (!$result1) {
                die("1. Query falhou.");
            }
            $_SESSION["UsuLingua"] = $UsuLingua;  
            
            //$row1 = mysqli_fetch_assoc($result1);

            header( "Location: index.php" );

            
            ?>
            
        </div>
</body>

</html>

<?php 

mysqli_free_result( $result1 );

include_once("inc/i_desconectaDB.php");

?>