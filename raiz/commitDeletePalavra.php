<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

$IdPalavra = $_GET[ 'IdPalavra' ];

$query1 = "DELETE FROM cit_pal ";
$query1 .= "WHERE IdPalavra = " . $IdPalavra;
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou.:" . $query1 );
}

$query3 = "DELETE FROM palavra ";
$query3 .= "WHERE IdPalavra = " . $IdPalavra;
$result3 = mysqli_query( $connection, $query3 );
if ( !$result3 ) {
    die( "3. Query falhou." );
}

$origem = $_GET[ 'origem' ];

header( "Location: " . $origem );
mysqli_free_result( $result3 );
include_once( "inc/i_desconectaDB.php" );
?>
