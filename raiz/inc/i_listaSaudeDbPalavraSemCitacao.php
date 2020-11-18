<h3><?php echo xpre("Lista palavras-chave sem citação"); ?></h3>
<?php
$query1 = "SELECT * ";
$query1 .= "FROM palavra ";
//$query1 .= "ORDER BY AutSobrenome ASC";
mysqli_set_charset($connection,"utf8");
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou: " . $query1 . "<br />" );
}
while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
    $query2 = "SELECT COUNT(IdPalavra) ";
    $query2 .= "FROM cit_pal ";
    $query2 .= "WHERE IdPalavra =". $row1["IdPalavra"];
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
      echo xpre("Palavra-chave") . ": <strong>" . $row1[ "PalPalavra" ] .  "</strong> ".  xpre("não está vinculada a nenhuma citação!") ."<br />";
      echo "<a class='botao' href='listaSaudeDbCheckUp.php?msgDelIdPalavra=" . $row1[ "IdPalavra" ] . "'>". xpre("Deleta palavra-chave"). "</a>";
      echo "<hr>";
    }
}
mysqli_free_result( $result1 );
mysqli_free_result( $result2 );
?>