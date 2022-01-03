<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

$IdPublicacao = $_GET[ 'IdPublicacao' ];

// DELETA RELAÇÃO EM aut_pub

$query1 = "DELETE FROM aut_pub ";
$query1 .= "WHERE IdPublicacao = " . $IdPublicacao;
//echo "Q1:" .  $query1 . "<br />";
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou :" . $query1 );
}

// DELETA RELAÇÃO EM cit_pal

$query3 = "SELECT * ";
$query3 .= "FROM citacao ";
$query3 .= "WHERE IdPublicacao = " . $IdPublicacao;
//echo "Q3:" .  $query3 . "<br />";
$result3 = mysqli_query( $connection, $query3 );
if ( !$result3 ) {
    die( "3. Query falhou:" . $query3 );
}
while ( $row3 = mysqli_fetch_assoc( $result3 ) ) {
    $query3a = "DELETE FROM cit_pal ";
    $query3a .= "WHERE IdCitacao = " .  $row3[ 'IdCitacao' ];
    //echo "Q3a:" .  $query3a . "<br />";
    $result3a = mysqli_query( $connection, $query3a );

    if ( !$result3a ) {
        die( "3a. Query falhou.  . $query3" );
    }
}

// DELETA CITAÇÕES

$query2 = "DELETE FROM citacao ";
$query2 .= "WHERE IdPublicacao = " . $IdPublicacao;
//echo "Q2:" .  $query2 . "<br />";
$result2 = mysqli_query( $connection, $query2 );
if ( !$result2 ) {
    die( "2. Query falhou :" . $query2 );
}

// DELETA PUBLICAÇÃO

$query4 = "DELETE FROM publicacao ";
$query4 .= "WHERE IdPublicacao = " . $IdPublicacao;
//echo "Q4:" .  $query4 . "<br />";
$result4 = mysqli_query( $connection, $query4 );
if ( !$result4 ) {
    die( "4. Query falhou." );
}

$origem = $_GET[ 'origem' ];

header( "Location: " . $origem );

//mysqli_free_result( $result2 );
include_once( "inc/i_desconectaDB.php" );
?>
