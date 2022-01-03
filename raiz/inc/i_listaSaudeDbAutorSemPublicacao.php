
<h3><?php echo xpre("Lista autores sem publicação"); ?></h3>
<?php
$query1 = "SELECT * ";
$query1 .= "FROM autor ";
mysqli_set_charset($connection,"utf8");
$result1 = mysqli_query( $connection, $query1 );
if ( !$result1 ) {
    die( "1. Query falhou: " . $query1 . "<br />" );
}
while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
    $query2 = "SELECT COUNT(IdAutor) ";
    $query2 .= "FROM aut_pub ";
    $query2 .= "WHERE IdAutor =". $row1["IdAutor"];
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
        echo xpre("Autor") . " <strong>";
        mostraAutor($row1[ "IdAutor" ]);
        //. $row1[ "AutSobrenome" ] . ", " .  $row1[ "AutNome" ] .  
        echo "</strong> " . xpre("não tem nenhuma publicação!") . "<br />";
        //echo "<a class='botao' href='deletaAutor.php?IdAutor=". $row1[ "IdAutor" ] . "'>DELETA AUTOR</a>";
        echo "<a class='botao' href='listaSaudeDbCheckUp.php?msgDelIdAutor=" . $row1[ "IdAutor" ] . "'>" . xpre("Deleta autor") . "</a>";
        echo "<hr>";
    }
}
mysqli_free_result( $result1 );
mysqli_free_result( $result2 );
?>



