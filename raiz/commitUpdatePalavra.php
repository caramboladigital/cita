<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

$query3 = "UPDATE palavra ";
$query3 .= "SET PalPalavra = '". addslashes( $_POST[ 'PalPalavra' ] ) . "' ";
$query3 .= "WHERE IdPalavra = ".$_POST[ 'IdPalavra' ];
//echo "3. Query:" . $query3 . "<br/>";
mysqli_set_charset($connection,"utf8");
$result3 = mysqli_query( $connection, $query3 );
if ( !$result3 ) {
    die( "3. Query falhou." );
}

header( "Location: listaPalavra.php?alteracao=success" );


mysqli_free_result( $result3 );


include_once( "inc/i_desconectaDB.php" );

?>