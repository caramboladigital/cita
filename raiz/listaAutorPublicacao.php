<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>
<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo xpre("Publicações"); ?></title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>
<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" );
            if ($_SESSION["ehAdmin"]){
                echo "<a class='botao' href='incluiAutorPublicacao.php'>" . xpre("Cadastra nova publicação") ."</a>";
            }
        ?>
        <h1><?php echo xpre("Lista de publicações"); ?></h1>
        <div id="listaPub">
            <?php
            $query1 = "SELECT * ";
            $query1 .= "FROM autor ";
            $query1 .= "ORDER BY AutSobrenome ASC";
            mysqli_set_charset( $connection, "utf8" );
            $result1 = mysqli_query( $connection, $query1 );
            //echo "1. Query: " . $query1 . "<br />";
            if ( !$result1 ) {
                die( "1. Query falhou:" . $query1 );
            }
            while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                $query2 = "SELECT * ";
                $query2 .= "FROM aut_pub ";
                $query2 .= "WHERE IdAutor = " . $row1[ "IdAutor" ];
                $result2 = mysqli_query( $connection, $query2 );
                //echo "2. Query: " . $query2 . "<br />";
                if ( !$result2 ) {
                    die( "2. Query falhou:" . $query2 );
                }
                while ( $row2 = mysqli_fetch_assoc( $result2 ) ) {

                    // AQUI POSSO IMPRIMIR PULICACAO

                    $query3 = "SELECT * ";
                    $query3 .= "FROM publicacao ";
                    $query3 .= "WHERE IdPublicacao = " . $row2[ "IdPublicacao" ];
                    $result3 = mysqli_query( $connection, $query3 );
                    //echo "3. Query: " . $query3 . "<br />";
                    if ( !$result3 ) {
                        die( "3. Query falhou:" . $query3 );
                    }
                    $row3 = mysqli_fetch_assoc( $result3 );

                    // 2.1 Busca cada autor com mesmo IdPubublicacao da publicacao
                    $query4 = "SELECT * ";
                    $query4 .= "FROM aut_pub ";
                    $query4 .= "WHERE IdPublicacao = " . $row3[ "IdPublicacao" ] . " ";
                    $result4 = mysqli_query( $connection, $query4 );
                    //echo "4. Query: " . $query4 . "<br />";
                    if ( !$result4 ) {
                        die( "4. Query falhou:" . $query4 );
                    }

                    echo "<p>";
                    if ($_SESSION["ehAdmin"]){
                        echo "&nbsp;";
                        echo "<a href='editaAutorPublicacao.php?IdPublicacao=" . $row3[ 'IdPublicacao' ] . "' ><img class='ico' width = '16px' height = '16px' title = 'editar' src = 'img/ico/editar.png'></a>";
                        echo "<a href='listaAutorPublicacao.php?msgDelIdPublicacao=" . $row3[ 'IdPublicacao' ] . "' ><img class='ico' width = '16px' height = '16px' title = 'deletar' src = 'img/ico/menos.png'></a>";
                    }
                    echo "<a href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $row3[ 'IdPublicacao' ] . "' ><img class='ico' width = '16px' height = '16px' title = 'ver' src = 'img/ico/ver.png'></a>";
                    while ( $row4 = mysqli_fetch_assoc( $result4 ) ) {
                        mostraAutor( $row4[ "IdAutor" ] );
                        echo ". ";
                    }
                    mostraPublicacao( $row3[ "IdPublicacao" ] );
                    echo "</p>";
                }

            }
            ?>
        </div>
    </div>
    
    
        <?php
    // SE VIER DO NADA, É LISTA
    // SE VIER COM GET, É PRA DELETAR O AUTOR
    
    if (empty(!$_GET)) {
        // echo "Tem GET sim";
        if (array_key_exists("msgDelIdPublicacao",$_GET)) {
            $elemento = "Publicação: " . retornaPublicacao( $_GET[ 'msgDelIdPublicacao' ] );
            modal ($_GET[ 'msgDelIdPublicacao' ] , $elemento , "Você confirma que quer deletar esta publicação?", "commitDeletePublicacao.php?IdPublicacao=", "listaAutorPublicacao.php");
        }
    }


    include_once("inc/i_modal.php");
    ?>

</body>

</html>
<?php
// 5. Close connection
include_once( "inc/i_desconectaDB.php" );
?>
