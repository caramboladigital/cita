<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

    // ATUALIZA CITAÇÃO

    $query1 = "UPDATE citacao ";
    $query1 .= "SET CitPg = '".  $_POST[ 'CitPg' ] . "', ";
    $query1 .= "CitPosKindle = '".  $_POST[ 'CitPosKindle' ] . "', ";
    $query1 .= "CitCitacao = '". filter_var( $_POST[ 'CitCitacao' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', ";
    $query1 .= "CitComentario = '".  filter_var( $_POST[ 'CitComentario' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "' ";
    $query1 .= "WHERE IdCitacao = " . $_POST[ 'IdCitacao' ] ;
    
    echo "Q1:". $query1 . "<br />";

    mysqli_set_charset( $connection, "utf8" );
    $result1 = mysqli_query( $connection, $query1 );
    if ( !$result1 ) {
        die( "1. Query falhou."  . $query1 );
    }

    // APAGA TODOS AS ASSOCIAÇÕES ENTRE PALAVRA E CITAÇÃO
    
    $query2 = "DELETE FROM cit_pal ";
    $query2 .= "WHERE IdCitacao = " . $_POST[ 'IdCitacao' ];
    echo "Q2: " . $query2 . "<br />";
    $result2 = mysqli_query( $connection, $query2 );
    if ( !$result2 ) {
        die( "2. Query falhou." );
    }

    // INSERE NOVAS ASSOCIAÇÕES ENTRE PALAVRA E CITAÇÃO

    foreach ($_POST['listPalavra'] as $id) {
        $query3 = "INSERT INTO cit_pal (IdCitacao, IdPalavra) ";
        $query3 .= "VALUES ('" . $_POST[ 'IdCitacao' ] . "' , '" . $id . "'); ";
        echo "Q3: " . $query3 . "<br />";
        mysqli_set_charset($connection,"utf8");
        $result3 = mysqli_query( $connection, $query3 );
        if ( !$result2 ) {
            die( "3. Query falhou." );
        }
    }   


header( "Location: listaAutorPublicacao.php?alteracao=sucesso" );


mysqli_free_result( $result1 );
mysqli_free_result( $result2 );
mysqli_free_result( $result3 );

include_once( "inc/i_desconectaDB.php" );
?>
