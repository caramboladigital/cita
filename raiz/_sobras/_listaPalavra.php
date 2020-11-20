<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>
<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo xpre("Palavras-chave"); ?></title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); 
/*             if ($_SESSION["ehAdmin"]){
                echo "<a class='botao' href='incluiPalavra.php'>" . xpre("Cadastra nova palavra-chave") . "</a>";
            } */
        ?>
        <h1><?php echo xpre("Lista de palavras-chave"); ?></h1>
        <?php
        $i = 0; // i = contador
        $query1 = "SELECT * ";
        $query1 .= "FROM palavra ";
        $query1 .= "ORDER BY PalPalavra ASC";
        mysqli_set_charset($connection,"utf8");
        $result1 = mysqli_query( $connection, $query1 );
        if ( !$result1 ) {
            die( "1. Query falhou." );
        }
        echo "<p>";
        
        while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
            $query2 = "SELECT COUNT(IdPalavra) ";
            $query2 .= "FROM cit_pal ";
            $query2 .= "WHERE IdPalavra =". $row1["IdPalavra"];
            //echo "query2:" . $query2 . "<br />";
            mysqli_set_charset($connection,"utf8");
            $result2 = mysqli_query( $connection, $query2 );
            if ( !$result2 ) {
                die( "2. Query falhou." );
            }
            $row2 = mysqli_fetch_assoc( $result2 );
            $nString = implode( $row2 );
            $nNumero = intval($nString);
            if ($i>2){ 
                echo "<br />";
                $i=0;
            }
            $i++;
            if ($_SESSION["ehAdmin"]){
                echo "&nbsp;";
                echo "<a href='editaPalavra.php?IdPalavra=" . $row1[ 'IdPalavra' ]. "' ><img class='ico' width = '16px' height = '16px' title = 'editar' src = 'img/ico/editar.png'></a >";
                echo "<a href='listaPalavra.php?msgDelIdPalavra=" . $row1[ 'IdPalavra' ] . "' ><img class='ico' width = '16px' height = '16px' title = 'deletar' src = 'img/ico/menos.png'></a>";
            }
            echo "<a href='listaCitacoesDeUmaPalavra.php?IdPalavra=" . $row1[ 'IdPalavra' ] . "' ><img class='ico' width = '16px' height = '16px' title = 'ver' src = 'img/ico/ver.png'></a>";
            mostraPalavra ( $row1[ 'IdPalavra' ]) ;
            echo " (" . $nString . ")</a> | ";
        }
        echo "</p>";
        mysqli_free_result( $result1 );
        ?>
    </div>
    <?php
    // SE VIER DO NADA, É LISTA
    // SE VIER COM GET, É PRA DELETAR A PALAVRA-CHAVE

    if (empty(!$_GET)) {
        // echo "Tem GET sim";
        if (array_key_exists("msgDelIdPalavra",$_GET)) {
            $elemento =  xpre("Palavra-chave") . ": " . retornaPalavra( $_GET[ 'msgDelIdPalavra' ] );
            modal ($_GET[ 'msgDelIdPalavra' ] , $elemento , xpre("Você confirma que quer deletar esta palavra-chave?") , "commitDeletePalavra.php?IdPalavra=", "listaPalavra.php");
        }
    }
    include_once("inc/i_modal.php");
    ?>
</body>

</html>
<?php
include_once( "inc/i_desconectaDB.php" );
?>
