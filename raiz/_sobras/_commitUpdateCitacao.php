<?php
// Criar conexão com a DB
include_once( "funcoes.php" );
include_once( "inc/conectaDB.php" );

$query5 = "UPDATE citacao ";
$query5 .= "SET CitCitacao = '" . filter_var( $_POST[ 'CitCitacao' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', ";
$query5 .= "CitPg = '" . $_POST[ 'CitPg' ] . "', ";
$query5 .= "CitComentario = '" . filter_var( $_POST[ 'CitComentario' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "' ";
$query5 .= "WHERE IdCitacao = " . $_POST[ 'IdCitacao' ];
//echo "<br/> Query: " . $query5 . "<br />";
mysqli_set_charset( $connection, "utf8" );
$result5 = mysqli_query( $connection, $query5 );
if ( !$result5 ) {
  die( " Resultado: 5. Query falhou." );
}


//filter_var($_POST['CitCitacao'], FILTER_SANITIZE_MAGIC_QUOTES);

//echo "<br /> sem aspas: ". mysql_real_escape_string($row1[ "CitCitacao" ], $connection) ;


header( "Location: listaCitacao.php?alteracao=success" );


mysqli_free_result( $result5 );
desconectaDB();
?>