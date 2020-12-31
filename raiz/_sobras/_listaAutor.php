<?php
// Criar conexão com a DB

include_once( "funcoes.php" );
include_once( "inc/conectaDB.php" );
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Autores</title>
</head>

<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="estilos.css" media="screen" />

<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); ?>
        <a class="botao" href="incluiAutor.php"> CADASTRA NOVO AUTOR</a>
        <h1>Lista de autores</h1>
        <p>
        <?php
            $i = 0; // i = contador
            $query1 = "SELECT * ";
            $query1 .= "FROM autor ";
            $query1 .= "ORDER BY AutSobrenome ASC";
            mysqli_set_charset( $connection, "utf8" );
            $result1 = mysqli_query( $connection, $query1 );
            if ( !$result1 ) {
                die( "1. Query falhou." );
            }
            // 1.2 Retorna os Ids dos autores das publicações
            while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                if ($i>3){ 
                    echo "<br />";
                    $i=0;
                }
                $i++;
                // carrega lista SELECT
                //echo "<p>";
                echo "<a href='editaAutor.php?IdAutor=" . $row1[ 'IdAutor' ] . "' ><img class='ico' width = '16px' height = '16px' src = 'img/ico/editar.png'></a>";
                echo "<a href='deletaAutor.php?IdAutor=" . $row1[ 'IdAutor' ] . "' ><img class='ico' width = '16px' height = '16px' src = 'img/ico/menos.png'></a>";
                mostraAutor($row1[ 'IdAutor' ]);
                //echo "</p>";
            }
            mysqli_free_result( $result1 );
        ?>
        </p>
    </div>
</body>

</html>
<?php include_once( "inc/i_desconectaDB.php" );
?>
