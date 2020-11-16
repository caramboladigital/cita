<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

    // ATUALIZA PUBLICAÇÃO

    $query1 = "UPDATE publicacao ";
    $query1 .= "SET PubTitulo = '".  filter_var( $_POST[ 'PubTitulo' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', ";
    $query1 .= "PubLocal = '". filter_var( $_POST[ 'PubLocal' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', ";
    $query1 .= "PubEditora = '".  filter_var( $_POST[ 'PubEditora' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', ";
    $query1 .= "PubAno = '". $_POST[ 'PubAno' ] . "', ";
    $query1 .= "PubUrl = '".  filter_var( $_POST[ 'PubUrl' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', ";
    $query1 .= "PubDataDeAcesso = '". $_POST[ 'PubDataDeAcesso' ] . "', ";
    $query1 .= "PubArtigo = '".  filter_var( $_POST[ 'PubArtigo' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "' ";
    $query1 .= "WHERE IdPublicacao = " . $_POST[ 'IdPublicacao' ] ;
    mysqli_set_charset( $connection, "utf8" );
    $result1 = mysqli_query( $connection, $query1 );
    if ( !$result1 ) {
        die( "1. Query falhou."  . $query1 );
    }

    // APAGA TODOS AS ASSOCIAÇÕES ENTRE AUTOR E PUBLICACAO
    
    $query2 = "DELETE FROM aut_pub ";
    $query2 .= "WHERE IdPublicacao = " . $_POST[ 'IdPublicacao' ];
    echo "QUERY2: " . $query2 . "<br />";
    $result2 = mysqli_query( $connection, $query2 );
    if ( !$result2 ) {
        die( "2. Query falhou." );
    }

    // INSERE NOVAS ASSOCIAÇÕES ENTRE AUTOR E PUBLICACAO

    foreach ($_POST['listAutor'] as $id) {
        $query3 = "INSERT INTO aut_pub (IdPublicacao, IdAutor) ";
        $query3 .= "VALUES ('" . $_POST[ 'IdPublicacao' ] . "' , '" . $id . "'); ";
        echo "QUERY3: " . $query3 . "<br />";
        mysqli_set_charset($connection,"utf8");
        $result3 = mysqli_query( $connection, $query3 );
        if ( !$result2 ) {
            die( "3. Query falhou." );
        }
    }   
    //echo "autores: " . $_POST[ 'listAutor' ];


    header( "Location: listaAutorPublicacao.php?alteracao=success" );

    mysqli_free_result( $result1 );
    mysqli_free_result( $result2 );
    mysqli_free_result( $result3 );

    include_once( "inc/i_desconectaDB.php" );
?>
