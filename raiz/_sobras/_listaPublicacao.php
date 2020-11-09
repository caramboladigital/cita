<?php
// Criar conexão com a DB
include_once( "funcoes.php" );
include_once( "inc/conectaDB.php" );
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Lista publicações</title>
</head>

<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="estilos.css" media="screen" />

<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); ?>
        <h1>Publicações</h1>
        <a class="botao" href="criaPublicacao.php"> CADASTRA NOVA PUBLICAÇÃO</a>
        <h2>Lista de publicações</h2>

        <?php
            $query1 = "SELECT * ";
            $query1 .= "FROM publicacao ";
            //$query .= "WHERE IdPublicacao = * ";
            $query1 .= "ORDER BY PubTitulo ASC";
            mysqli_set_charset( $connection, "utf8" );
            $result1 = mysqli_query( $connection, $query1 );
            if ( !$result1 ) {
                die( "Query falhou." );
            }
            while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                echo "<p>";
                echo "<a href='editaPublicacao.php?IdPublicacao=". $row1[ 'IdPublicacao' ] . "' ><img class='ico' width = '16px' height = '16px' src = 'img/ico/editar.png'></a>";
                echo "<a href='deletaPublicacao.php?IdPublicacao=". $row1[ 'IdPublicacao' ] . "&PubTitulo=".$row1[ "PubTitulo" ] . "' ><img class='ico' width = '16px' height = '16px' src = 'img/ico/menos.png'></a>";
                mostraPublicacao( $row1["IdPublicacao"] );
                echo "</p>";
            }
        ?>
        <?php
        mysqli_free_result( $result1 );
        ?>
    </div>
</body>

</html>
<?php
// 5. Close connection
include_once( "inc/i_desconectaDB.php" );
?>
