<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>
<html>

<head>
    <title>Lista de citações de um autor</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); ?>
        <h1>Lista de citações de um autor</h1>
        <h2>Publicação</h2>
        <div id="listaPub">
            <?php
            $IdAutor = $_GET[ 'IdAutor' ];
            // 1.1 Busca publicações
            $query1 = "SELECT * ";
            $query1 .= "FROM aut_pub ";
            $query1 .= "WHERE IdAutor =" . $IdAutor;
            //$query1 .= "ORDER BY PubTitulo ASC";
            mysqli_set_charset( $connection, "utf8" );
            $result1 = mysqli_query( $connection, $query1 );

            // echo "query1: " . $query1 . "<br />";

            // Testa query
            if ( !$result1 ) {
                die( "1. Query falhou." );
            }
            // 1.2 Retorna os Ids dos autores das publicações
            while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                // 2.1 Busca cada autor com mesmo IdPub da publicacao
                $query2 = "SELECT * ";
                $query2 .= "FROM publicacao ";
                $query2 .= "WHERE IdPublicacao = " .  $row1[ "IdPublicacao" ] ;
                //echo "query2: " . $query2 . "<br />";
                mysqli_set_charset( $connection, "utf8" );
                $result2 = mysqli_query( $connection, $query2 );
                //echo "result2: " . $result2 . " / ";
                if ( !$result2 ) {
                    die( "2. Query falhou." );
                }
                // MONTA A LINHA
                echo "<p class='blocoPublicacao'>";
                // 2.2 Retorna os dados dos autores
                while ( $row2 = mysqli_fetch_assoc( $result2 ) ) {

                    // 3.1 Busca os dados do autor da publicação
                    $query3 = "SELECT * ";
                    $query3 .= "FROM autor ";
                    $query3 .= "WHERE IdAutor = " . $IdAutor ;
                    // echo "query3: " . $query3 . "<br />";
                    mysqli_set_charset( $connection, "utf8" );
                    $result3 = mysqli_query( $connection, $query3 );
                    if ( !$result3 ) {
                        die( "3. Query falhou." );
                    }
                    // 3.2 Retorna os dados das publicações
                    $row3 = mysqli_fetch_assoc( $result3 );
                    
                    mostraAutor( $IdAutor );
                }
               echo ". ";
                mostraPublicacao( $row1[ "IdPublicacao" ]);
                echo "</p><hr>";
                
                // echo "<a class='botao' href='incluiPalavraCitacao.php?IdPublicacao=" . $_GET[ 'IdPublicacao' ]. "'>CADASTRA NOVA CITAÇÃO</a>";


                echo "<h2>Citações</h2>";
                //
                //  CITACÕES
                //
                // 1.1 Busca citacoes
                $query4 = "SELECT * ";
                $query4 .= "FROM citacao ";
                $query4 .= "WHERE IdPublicacao = " .  $row1[ "IdPublicacao" ] . " ";
                $query4 .= "ORDER BY ABS(CitPg) ASC";

                //echo "query4: " . $query4 . "<br />";
                mysqli_set_charset( $connection, "utf8" );
                $result4 = mysqli_query( $connection, $query4 );
                // Testa query
                if ( !$result4 ) {
                    die( "4. Query falhou." );
                }

                // 1.2 Retorna os Ids dos autores das publicações
                while ( $row4 = mysqli_fetch_assoc( $result4 ) ) {
                    // BOTOES
                    if ($_SESSION["ehAdmin"]){
                        echo "<a alt='editar' href='editaPalavraCitacao.php?IdCitacao=" . $row4[ 'IdCitacao' ] . "' ><img class='ico' width = '16px' height = 16px' src = 'img/ico/editar.png'></a>";
                        echo "<a alt='deletar' href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $row1[ "IdPublicacao" ] . "&msgDelIdCitacao=" . $row4[ 'IdCitacao' ] . "' ><img class='ico' width = '16px' height = 16px' src = 'img/ico/menos.png'></a>";
                    }
                    echo "<br />";
                    mostraCitacao( $row4[ "IdCitacao" ] );

                }

            }
            // 4. libera os dados retornados
            mysqli_free_result( $result1 );
            mysqli_free_result( $result2 );
            mysqli_free_result( $result3 );
            mysqli_free_result( $result4 );
            // mysqli_free_result( $result5 );
            // mysqli_free_result( $result6 );
            ?>
        </div>
    </div>

    <?php
    // SE VIER DO NADA, É LISTA
    // SE VIER COM GET, É PRA DELETAR A PALAVRA-CHAVE
    
    if (empty(!$_GET)) {
        // echo "Tem GET sim";

        if (array_key_exists("msgDelIdCitacao",$_GET)) {
            echo "<div id='myModal' class='modal'>";
                echo "<div class='modal-content'>";
                    echo "<span class='close'>&times;</span>";
                    echo $row1[ $_GET[ 'msgDelIdCitacao' ] ];      
                    //mostraAutor($_GET[ 'preDelIdAutor' ]);
                    echo "<p>Você confirma que quer deletar a citação ?</p>";
                    echo "<br />";
                    echo "<a class='botao' href='commitDeleteCitacao.php?IdPublicacao=" . $IdPublicacao . "&IdCitacao=" . $_GET[ 'msgDelIdCitacao' ] ."'>SIM</a>";
                    echo "<a class='botao' href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=". $IdPublicacao.  "'>NÃO</a>"; 
                echo "</div>";
            echo "</div>";
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
