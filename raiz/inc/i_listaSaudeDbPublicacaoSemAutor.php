<h3>Lista publicações sem autor</h3>
<?php
$query1 = "SELECT * ";
$query1 .= "FROM publicacao ";
mysqli_set_charset($connection,"utf8");
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou: " . $query1 . "<br />" );
}
while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
    $query2 = "SELECT COUNT(IdPublicacao) ";
    $query2 .= "FROM aut_pub ";
    $query2 .= "WHERE IdPublicacao =". $row1["IdPublicacao"];
    mysqli_set_charset($connection,"utf8");
    $result2 = mysqli_query( $connection, $query2 );
    if ( !$result2 ) {
        die( "2. Query falhou: " . $query2 . "<br />" );
    }
    $row2 = mysqli_fetch_assoc( $result2 );
    $nString = implode( $row2 );
    $nNumero = intval($nString);

    //echo $nString . "<br />";

    // echo "Autor " . $row1[ "AutSobrenome" ] . "tem " . $nString . " obras relacionadas. <br />";
    if ($nNumero == 0) {
      echo "Publicação <strong>" . $row1[ "PubTitulo" ] .  "</strong> não tem nenhum autor! <br />";
      echo "<a class='botao' href='listaSaudeDbCheckUp.php?msgDelIdPublicacao=" . $row1[ "IdPublicacao" ] . "'>DELETA PUBLICAÇÃO</a>";  
      echo "<hr>";
    }
}
mysqli_free_result( $result1 );
mysqli_free_result( $result2 );
?>

