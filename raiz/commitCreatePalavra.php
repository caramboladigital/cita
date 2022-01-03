<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

// aqui vai uma observação

$query3 = "INSERT INTO palavra (PalPalavra) ";
$query3 .= "VALUES ('" . $_POST[ 'PalPalavra' ] . "'); ";
//echo $query3 . "<br />";
mysqli_set_charset($connection,"utf8");
$result3 = mysqli_query( $connection, $query3 );
if ( !$result3 ) {
    die( "3. Query falhou." );
    header( "Location: listaPalavra.php?alteracao=falha" );
} else {
    header( "Location: listaPalavra.php?palavra=" . $_POST[ 'PalPalavra' ] );
}

mysqli_free_result( $result3 );


// 5. Close connection
include_once( "inc/i_desconectaDB.php" );
?>