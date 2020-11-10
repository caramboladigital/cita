<h3>Lista citações sem palavra-chave</h3>
<?php
$query1 = "SELECT * ";
$query1 .= "FROM citacao ";
//$query1 .= "ORDER BY AutSobrenome ASC";
mysqli_set_charset($connection,"utf8");
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou: " . $query1 . "<br />" );
}
while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
    $query2 = "SELECT COUNT(IdCitacao) ";
    $query2 .= "FROM cit_pal ";
    $query2 .= "WHERE IdCitacao =". $row1["IdCitacao"];
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
        //. $row1[ "AutSobrenome" ] . ", " .  $row1[ "AutNome" ] .  
      echo "Citação: <br /><strong>" . substr( $row1[ "CitCitacao" ], 0, 70) . "... " . "</strong><br /> não tem relação com nenhuma publicação! <br />";
      echo "<a class='botao' href='listaSaudeDbCheckUp.php?msgDelIdCitacao=" . $row1[ "IdCitacao" ] . "'>DELETA CITAÇÃO</a>";
      echo "<hr>";
    }
}
mysqli_free_result( $result1 );
mysqli_free_result( $result2 );
?>