<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

$query3 = "UPDATE autor ";
$query3 .= "SET AutSobrenome = '".  filter_var( $_POST[ 'AutSobrenome' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', ";
$query3 .= "AutNome = '". filter_var( $_POST[ 'AutNome' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "' ";
$query3 .= "WHERE IdAutor = ". $_POST[ 'IdAutor' ] ;

//echo $query2;
mysqli_set_charset( $connection, "utf8" );
$result3 = mysqli_query( $connection, $query3 );
if ( !$result3 ) {
    die( "3. Query falhou:" . $query3 );
}

header( "Location: listaAutor.php?updIdAutor=sucesso" );

// 5. Close connection
include_once( "inc/i_desconectaDB.php" );
?>
