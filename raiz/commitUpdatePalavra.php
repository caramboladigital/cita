<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

$query3 = "UPDATE palavra ";
$query3 .= "SET PalPalavra = '". filter_var( $_POST[ 'PalPalavra' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "' ";
$query3 .= "WHERE IdPalavra = ".$_POST[ 'IdPalavra' ];
//echo "3. Query:" . $query3 . "<br/>";
mysqli_set_charset($connection,"utf8");
$result3 = mysqli_query( $connection, $query3 );
if ( !$result3 ) {
    die( "3. Query falhou." );
}

header( "Location: listaPalavra.php?alteracao=success" );

?>