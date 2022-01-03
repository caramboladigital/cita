<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

$IdCitacao = $_GET[ 'IdCitacao' ];
//$IdPublicacao = $_GET[ 'IdPublicacao' ];

//echo "Publi: ". $IdPublicacao;

// DELETA RELAÇÃO EM cit_pal

$query3a = "DELETE FROM cit_pal ";
$query3a .= "WHERE IdCitacao = " .  $IdCitacao;
$result3a = mysqli_query( $connection, $query3a );
if ( !$result3a ) {
    die( "3a. Query falhou.  . $query3" );
}
//}
// DELETA CITAÇÃO

$query2 = "DELETE FROM citacao ";
$query2 .= "WHERE IdCitacao = " . $IdCitacao;
//echo "Q2:" .  $query2 . "<br />";
$result2 = mysqli_query( $connection, $query2 );
if ( !$result2 ) {
    die( "2. Query falhou :" . $query2 );
}

$origem = $_GET[ 'origem' ];

header( "Location: " . $origem );

//mysqli_free_result( $result2 );
include_once( "inc/i_desconectaDB.php" );
?>
