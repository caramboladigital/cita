<?php
// Criar conexão com a DB
include_once( "funcoes.php" );
include_once( "inc/conectaDB.php" );


echo "PUBLICAÇÃO:  " . $_POST[ 'IdPublicacao' ] . "<br />"; 

    //
    // INSERE CITAÇÃO 
    //

$query1 = "INSERT INTO citacao (CitPg, CitCitacao, CitComentario, IdPublicacao ) ";
$query1 .= "VALUES ('"; 
$query1 .= $_POST[ 'CitPg' ] . "', '";
$query1 .= filter_var( $_POST[ 'CitCitacao' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', '";
$query1 .= filter_var( $_POST[ 'CitComentario' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', '";
$query1 .= $_POST[ 'IdPublicacao' ].  "'); ";

                                                                            
echo "Q1:". $query1 . "<br />";
mysqli_set_charset( $connection, "utf8" );
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou.");
}
    //
    // INSERE NOVAS ASSOCIAÇÕES ENTRE AUTOR E PUBLICACAO
    //

$last_id = mysqli_insert_id($connection);
echo "LAST ID: " . $last_id . "<br />";


foreach ($_POST['listPalavra'] as $id) {
    $query2 = "INSERT INTO cit_pal ( IdCitacao , IdPalavra) ";
    $query2 .= "VALUES ('" . $last_id . "' , '" . $id . "'); ";
    echo "Q2: " . $query2 . "<br />";
    mysqli_set_charset($connection,"utf8");
    $result2 = mysqli_query( $connection, $query2 );
    if ( !$result2 ) {
        die( "2. Query falhou." );
    }
} 

header( "Location: listaAutorPublicacao.php?alteracao=sucesso" );


mysqli_free_result( $result1 );
mysqli_free_result( $result2 );

include_once( "inc/i_desconectaDB.php" );
?>
