<?php
// Criar conexão com a DB
include_once( "funcoes.php" );
include_once( "inc/conectaDB.php" );
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Edita citações</title>
</head>

<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="estilos.css" media="screen" />

<body>
    <div id="divGeral">
        <?php 
            include_once( "inc/i_topo.php" );
        ?>
        <h1>Edição da citação</h1>
        <div id="editaCitacao">
        <?php
            $IdCitacao = $_GET[ 'IdCitacao' ];
            //echo $IdPublicacao;
            $query4 = "SELECT * ";
            $query4 .= "FROM citacao ";
            $query4 .= "WHERE IdCitacao =" . $IdCitacao;
            // echo "<br />Q4: " . $query4 . "<br / >";
            mysqli_set_charset($connection,"utf8");
            $result4 = mysqli_query( $connection, $query4 );
             if ( !$result4 ) {
                  die( "4. Query falhou." );
            } 
            $row4 = mysqli_fetch_assoc( $result4 );
        ?>
        <form action="commitUpdateCitacao.php" method="POST">
            <h3>Citação</h3>
            <input id="IdCitacao" type="hidden" name="IdCitacao" class="IdCitacao" size="0" value="<?php echo $row4[ 'IdCitacao' ] ?>">
            <textarea rows="10" cols="80" id="CitCitacao" name="CitCitacao" class="CitCitacao"><?php echo $row4[ 'CitCitacao' ] ?></textarea>
            <h3>Página</h3>
            <input id="CitPg" name="CitPg" class="CitPg" size="8" value="<?php echo $row4[ 'IdCitacao' ] ?>">
            <h3>Comentário</h3>
            <textarea rows="10" cols="80" id="CitComentario" name="CitComentario" class="CitComentario" size="50"><?php echo $row4[ 'CitComentario' ] ?></textarea>;
            <br /><br />
            <button class="botao" type="submit" name="submit">ALTERA CITAÇÃO</button>
        </form>

        </div>
    </div>
</body>

</html>
<?php
include_once( "inc/i_desconectaDB.php" );
?>
