<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Autores</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>
<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); 
        if ($_SESSION["ehAdmin"]){
            echo "<a class='botao' href='incluiAutor.php'> CADASTRA NOVO AUTOR</a>";
        }
        ?>
        <h1>Autores</h1>
        <p>
            <?php
            $i = 0; // i = contador
            $query1 = "SELECT * ";
            $query1 .= "FROM autor ";
            $query1 .= "ORDER BY AutSobrenome ASC";
            mysqli_set_charset( $connection, "utf8" );
            $result1 = mysqli_query( $connection, $query1 );
            if ( !$result1 ) {
                die( "1. Query falhou." );
            }
            // 1.2 Retorna os Ids dos autores das publicações
            while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                if ($i>3){ 
                    echo "<br />";
                    $i=0;
                }
                $i++;
                // carrega lista SELECT
                //echo "<p>";
                if ($_SESSION["ehAdmin"]){
                    echo "&nbsp;";
                    echo "<a href='editaAutor.php?IdAutor=" . $row1[ 'IdAutor' ] . "' ><img class='ico' width = '16px' height = '16px' title = 'editar' src = 'img/ico/editar.png'></a>";
                    echo "<a href='listaAutor.php?msgDelIdAutor=" . $row1[ 'IdAutor' ] . "' ><img class='ico' width = '16px' height = '16px' title = 'deletar' src = 'img/ico/menos.png'></a>";
                }
                echo "<a href='listaCitacoesDeUmAutor.php?IdAutor=" . $row1[ 'IdAutor' ] . "' ><img class='ico' width = '16px' height = '16px' title = 'ver' src = 'img/ico/ver.png'></a>";
                mostraAutor($row1[ 'IdAutor' ]);
                echo " | ";
                //echo "</p>";
            }
            mysqli_free_result( $result1 );
        ?>
        </p>
    </div>
    <?php
    // SE VIER DO NADA, É LISTA
    // SE VIER COM GET, É PRA DELETAR O AUTOR
    
    if (empty(!$_GET)) {
        // echo "Tem GET sim";
        if (array_key_exists("msgDelIdAutor",$_GET)) {
            $elemento = "Autor: " . retornaAutor( $_GET[ 'msgDelIdAutor' ] );
            modal ($_GET[ 'msgDelIdAutor' ] , $elemento , "Você confirma que quer deletar este autor?", "commitDeleteAutor.php?IdAutor=", "listaAutor.php");
        }
    }
    include_once("inc/i_modal.php");

?>
</body>

</html>
<?php include_once( "inc/i_desconectaDB.php" );
?>
