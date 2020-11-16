<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

$query1 = "INSERT INTO publicacao (PubTitulo, PubLocal, PubEditora, PubAno, PubUrl, PubDataDeAcesso, PubArtigo ) ";
$query1 .= "VALUES ('"; 
$query1 .= filter_var( $_POST[ 'PubTitulo' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', '";
$query1 .= filter_var( $_POST[ 'PubLocal' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', '";
$query1 .= filter_var( $_POST[ 'PubEditora' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', '";
$query1 .= $_POST[ 'PubAno' ].  "', '";
$query1 .= filter_var( $_POST[ 'PubUrl' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', '";
$query1 .= filter_var( $_POST[ 'PubDataDeAcesso' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "', '";
$query1 .= filter_var( $_POST[ 'PubArtigo' ], FILTER_SANITIZE_MAGIC_QUOTES ) . "'); "; 
                                                                            
echo "Q3:". $query1 . "<br />";
mysqli_set_charset( $connection, "utf8" );
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou.");
}


    // INSERE NOVAS ASSOCIAÇÕES ENTRE AUTOR E PUBLICACAO


$last_id = mysqli_insert_id($connection);
echo "LAST ID: " . $last_id . "<br />";


foreach ($_POST['listAutor'] as $id) {
    $query2 = "INSERT INTO aut_pub ( IdPublicacao , IdAutor) ";
    $query2 .= "VALUES ('" . $last_id . "' , '" . $id . "'); ";
    echo "Q2: " . $query2 . "<br />";
    mysqli_set_charset($connection,"utf8");
    $result2 = mysqli_query( $connection, $query2 );
    if ( !$result2 ) {
        die( "2. Query falhou." );
    }
} 



header( "Location: listaAutorPublicacao.php?alteracao=success" );

mysqli_free_result($result1);
mysqli_free_result($result2);

include_once( "inc/i_desconectaDB.php" );
?>
