<?php
// Criar conexão com a DB
include_once( "inc/i_funcoes.php" );
include_once( "inc/i_conectaDB.php" );


$query1 = "INSERT INTO citacao (CitPg, CitPosKindle, CitCitacao, CitComentario, IdPublicacao ) ";
$query1 .= "VALUES ('"; 
$query1 .= $_POST[ 'CitPg' ] . "', '";
$query1 .= $_POST[ 'CitPosKindle' ] . "', '";
$query1 .= addslashes( $_POST[ 'CitCitacao' ] ) . "', '";
$query1 .= addslashes( $_POST[ 'CitComentario' ] ) . "', '";
$query1 .= $_POST[ 'IdPublicacao' ].  "'); ";

                                                                            
echo "Q1:". $query1 . "<br />";

mysqli_set_charset( $connection, "utf8" );
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou.");
}

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