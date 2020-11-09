<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 

?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Busca por palavra-chave</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); ?>
        
        <h1><?php echo expressao("Busca por palavra-chave" , "enEN") ?></h1>
        <p>Palavra (X) | X = número de vezes que a palavra foi associada a uma citação.</p>
        <p>
        <?php
            $query1 = "SELECT * ";
            $query1 .= "FROM palavra ";
            $query1 .= "ORDER BY PalPalavra ASC";
            //echo "query1:" . $query1 . "<br />";
            mysqli_set_charset($connection,"utf8");
            $result1 = mysqli_query( $connection, $query1 );
            if ( !$result1 ) {
                die( "1. Query falhou." );
            }
            while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                $query2 = "SELECT COUNT(IdPalavra) ";
                $query2 .= "FROM cit_pal ";
                $query2 .= "WHERE IdPalavra =". $row1["IdPalavra"];
                //echo "query2:" . $query2 . "<br />";
                mysqli_set_charset($connection,"utf8");
                $result2 = mysqli_query( $connection, $query2 );
                if ( !$result2 ) {
                    die( "2. Query falhou." );
                }
                $row2 = mysqli_fetch_assoc( $result2 );
                $nString = implode( $row2 );
                $nNumero = intval($nString);
                if ($nNumero< 5) {
                $tamFonte = "16";
                } elseif ( $nNumero>= 5 and $nNumero< 15){
                    $tamFonte = "19";                
                } elseif ( $nNumero>= 15 and $nNumero< 25){
                    $tamFonte = "22";                
                } elseif ( $nNumero >= 25 ){
                    $tamFonte = "25";   
                }
                echo "<a style='font-size:" . $tamFonte . "' href='listaCitacoesDeUmaPalavra.php?IdPalavra=" . $row1[ 'IdPalavra' ] . "' >" . $row1[ 'PalPalavra' ] . " (" . $nString . ")</a> | ";
            }
            mysqli_free_result( $result1 );
            mysqli_free_result( $result2 );
        ?>
        </p>
    </div>
</body>

</html>
<?php include_once( "inc/i_desconectaDB.php" ); ?>
