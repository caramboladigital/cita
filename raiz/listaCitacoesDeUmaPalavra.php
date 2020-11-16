<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 

?>
<html>

<head>
    <title>Citações por publicação</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php 
            include_once( "inc/i_topo.php" );
        ?>
        <div class="espaco30"></div>
        <?php
        $ultPub = "";
        $IdPalavra =  $_GET[ 'IdPalavra' ];
        $query1 = "SELECT * ";
        $query1 .= "FROM palavra ";
        $query1 .= "WHERE IdPalavra = " . $IdPalavra;

        //echo "query1: " . $query1 . "<br />";
        mysqli_set_charset( $connection, "utf8" );
        $result1 = mysqli_query( $connection, $query1 );

        if ( !$result1 ) {
            die( "1. Query falhou:" . $query1 );
        }

        while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {

            echo "<h1> Citações para a palavra-chave: " . $row1 [ "PalPalavra" ] . "</h1>";

            $query2 = "SELECT * ";
            $query2 .= "FROM cit_pal ";
            $query2 .= "WHERE IdPalavra = " . $IdPalavra;
            mysqli_set_charset( $connection, "utf8" );
            $result2 = mysqli_query( $connection, $query2 );

            if ( !$result2 ) {
                die( "2. Query falhou.". $query2 );
            }

            while ( $row2 = mysqli_fetch_assoc( $result2 ) ) {

                $query3 = "SELECT * ";
                $query3 .= "FROM citacao ";
                $query3 .= "WHERE IdCitacao =" . $row2 [ "IdCitacao" ];
                $result3 = mysqli_query( $connection, $query3 );
                if ( !$result3 ) {
                    die( "3. Query falhou." . $query3);
                }

                while ( $row3 = mysqli_fetch_assoc( $result3 ) ) {

                    $query4 = "SELECT * ";
                    $query4 .= "FROM publicacao ";
                    $query4 .= "WHERE IdPublicacao = " .  $row3[ "IdPublicacao" ] . " ";
                    $query4 .= "ORDER BY PubTitulo;" ;

                    mysqli_set_charset( $connection, "utf8" );
                    $result4 = mysqli_query( $connection, $query4 );
                    if ( !$result4 ) {
                        die( "4. Query falhou." . $query4);
                    }

                    while ( $row4 = mysqli_fetch_assoc( $result4 ) ) {

                        $query5 = "SELECT * ";
                        $query5 .= "FROM aut_pub ";
                        $query5 .= "WHERE IdPublicacao = " . $row4[ "IdPublicacao" ];
                        $result5 = mysqli_query( $connection, $query5 );
                        if ( !$result5 ) {
                            die( "5. Query falhou." . $query5);
                        }
                        if ( $ultPub != $row4["IdPublicacao"] ) {
                            echo "<p class='blocoPublicacao'>";
                            while ( $row5 = mysqli_fetch_assoc( $result5 ) ) {
                                $query6 = "SELECT * ";
                                $query6 .= "FROM autor ";
                                $query6 .= "WHERE IdAutor =" .  $row5[ "IdAutor" ];
                                mysqli_set_charset( $connection, "utf8" );
                                $result6 = mysqli_query( $connection, $query6 );
                                if ( !$result6 ) {
                                    die( "6. Query falhou.". $query6 );
                                }
                                $row6 = mysqli_fetch_assoc( $result6 );
                                //
                                // MOSTRA AUTOR
                                //
                                mostraAutor($row5[ "IdAutor" ]);
                                echo ". ";
                            }
                                //
                                // MOSTRA PUBLICACAO
                                //
                            mostraPublicacao( $row4[ "IdPublicacao" ] );
                            //echo "</p>";
                            $ultPub = $row4["IdPublicacao"];
                        }
                    }

                    echo "</p><hr>";

                    if ($_SESSION["ehAdmin"]){
                      echo "<a alt='editar' href='editaPalavraCitacao.php?IdCitacao=" . $row2 [ "IdCitacao" ] . "' ><img class='ico' width = '16px' height = 16px' title = 'editar' src = 'img/ico/editar.png'></a>";
                      echo "<a alt='deletar' href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $row3[ "IdPublicacao" ] . "&msgDelIdCitacao=" . $row2 [ "IdCitacao" ] . "' ><img class='ico' width = '16px' height = 16px' title = 'deletar' src = 'img/ico/menos.png'></a>";
                  }
                  echo "<br />";
                  //
                  // MOSTRA CITACAO
                  //
                  mostraCitacao($row3 [ "IdCitacao" ]);
                    
                //
                // MOSTRA PALAVRAS
                //
                  mostraPalavrasDeCitacao ( $row3[ "IdCitacao" ] );
                 // echo "</p>";
                }

            }
        }
        ?>
        <?php
?>
    </div>
</body>

</html>

<?php
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result3);
mysqli_free_result($result4);
mysqli_free_result($result5);
mysqli_free_result($result6);

include_once( "inc/i_desconectaDB.php" );
?>
