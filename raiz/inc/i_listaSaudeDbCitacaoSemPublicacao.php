<h3><?php echo xpre("Lista citações sem publicação"); ?></h3>
<?php
$queryCSPu1 = "SELECT * ";
$queryCSPu1 .= "FROM citacao ";
//$queryCSPu1 .= "WHERE IdPublicacao = ''";
mysqli_set_charset($connection,"utf8");
$resultCSPu1 = mysqli_query( $connection, $queryCSPu1 );
if ( !$result1 ) {
    die( "1. Query falhou: " . $queryCSPu1 . "<br />" );
}

while ( $rowCSPu1 = mysqli_fetch_assoc( $resultCSPu1 ) ) {
  $query2 = "SELECT COUNT(IdPublicacao) ";
  $query2 .= "FROM publicacao ";
  $query2 .= "WHERE IdPublicacao =". $rowCSPu1["IdPublicacao"];
  mysqli_set_charset($connection,"utf8");
  $result2 = mysqli_query( $connection, $query2 );
  if ( !$result2 ) {
      die( "2. Query falhou: " . $query2 . "<br />" );
  }
  $row2 = mysqli_fetch_assoc( $result2 );
  $nString = implode( $row2 );
  $nNumero = intval($nString);

  if ($nNumero == 0) {
      echo xpre("Citação").": <br /><strong>" . $rowCSPu1[ "CitCitacao" ] .  "</strong><br />".  xpre("não tem nenhuma publicação!") .  "<br />";
      echo "<a class='botao' href='listaSaudeDbCheckUp.php?msgDelIdCitacao=" . $rowCSPu1[ "IdCitacao" ] . "'>". xpre("Deleta citação") . "</a>";
      
      echo "<hr>";
  }
}
?>