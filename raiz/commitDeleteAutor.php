<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

$IdAutor = $_GET[ 'IdAutor' ];

$query1 = "DELETE FROM aut_pub ";
$query1 .= "WHERE IdAutor = " . $IdAutor;
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou.:" . $query1 );
}

$query3 = "DELETE FROM autor ";
$query3 .= "WHERE IdAutor = " . $IdAutor;
$result3 = mysqli_query( $connection, $query3 );
if ( !$result3 ) {
    die( "3. Query falhou." );
}

$origem = $_GET[ 'origem' ];

header( "Location: " . $origem );

mysqli_free_result( $result1 );
mysqli_free_result( $result3 );

include_once( "inc/i_desconectaDB.php" );
