<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>

<html>

<head>
    <meta charset="utf-8" />
    <title>Edita publicação</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php 
            include_once( "inc/i_topo.php" );
        ?>
        <form action="commitUpdateAutorPublicacao.php" method="POST">
            <div id="divAutor">
                <a class="botao" href="incluiAutor.php">CADASTRA NOVO AUTOR</a>
                <h2>Lista de autores</h2>
                <?php

                $query1 = "SELECT * ";
                $query1 .= "FROM autor ";
                $query1 .= "ORDER BY AutSobrenome ASC";
                mysqli_set_charset( $connection, "utf8" );
                $result1 = mysqli_query( $connection, $query1 );
                if ( !$result1 ) {
                    die( "1. Query falhou." );
                }
                //
                $IdPublicacao = $_GET[ 'IdPublicacao' ];

                ?>
                <select multiple name="listAutor[]" id="listAutor" style="width:200px;" class="listAutor" size=20>
                    <?php
                    while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                        echo "<option ";
                        $query2 = "SELECT IdAutor ";
                        $query2 .= "FROM aut_pub ";
                        $query2 .= "WHERE IdPublicacao =" . $IdPublicacao;
                        mysqli_set_charset( $connection, "utf8" );
                        $result2 = mysqli_query( $connection, $query2 );
                        if ( !$result2 ) {
                            die( "2. Query falhou." );
                        }
                        while ($row2 = mysqli_fetch_assoc( $result2 ) ){
                            //echo "Resultado de Q2: ". $row2 [ 'IdAutor' ] ; 
                            if ($row2 [ 'IdAutor' ] == $row1[ 'IdAutor' ] ) {
                                echo " selected='selected' ";
                            }
                        }
                        echo "value = '" . $row1[ 'IdAutor' ] . "'>" . strtoupper($row1[ 'AutSobrenome' ]) . ", " . $row1[ 'AutNome' ] . "</option>";
                    }
                     ?>
                </select>
            </div>
            <div id="divPublicacao">
                <?php

                $query4 = "SELECT * ";
                $query4 .= "FROM publicacao ";
                $query4 .= "WHERE IdPublicacao =" . $IdPublicacao;
                mysqli_set_charset( $connection, "utf8" );
                $result4 = mysqli_query( $connection, $query4 );
                if ( !$result4 ) {
                    die( "4. Query falhou." );
                }
                $row4 = mysqli_fetch_assoc( $result4 );
                ?>
                <?php
                    echo "<h3>Publicação</h3>";
                    echo "<input id='IdPublicacao' type= 'hidden' name='IdPublicacao' class='IdPublicacao' size='0' value= '". $row4[ "IdPublicacao" ] . "' >";
                    echo "<p>Título: </p>";
                    echo "<input id='PubTitulo' name='PubTitulo' class='PubTitulo' size='50'  value= '". $row4[ "PubTitulo" ] . "' >";
                    echo "<p>Local: </p>";
                    echo "<input id='PubLocal' name='PubLocal' class='PubLocal' size='25'  value= '". $row4[ "PubLocal" ] . "' >";
                    echo "<p>Editora: </p>";
                    echo "<input id='PubEditora' name='PubEditora' class='PubEditora' size='25' value= '". $row4[ "PubEditora" ] . "' >";
                    echo "<p>Ano: </p>";
                    echo "<input id='PubAno' name='PubAno' class='PubAno' size='25' value= '". $row4[ "PubAno" ] . "' >";
                    echo "<p>URL: </p>";
                    echo "<input id='PubUrl' name='PubUrl' class='PubUrl' size='64'value= '". $row4[ "PubUrl" ] . "' >";
                    echo "<p>Data de Acesso: </p>";
                    echo "<input id='PubDataDeAcesso' name='PubDataDeAcesso' class='PubDataDeAcesso' size='25' value= '". $row4[ "PubDataDeAcesso" ] . "' >";
                    echo "<p>Artigo: </p>";
                    echo "<input id='PubArtigo' name='PubArtigo' class='PubArtigo' size='64' value= '". $row4[ "PubArtigo" ] . "' >";
                    echo "<br /><br />";
                ?>
                <button class="botao" type="submit" name="submit">ALTERA PUBLICAÇÃO</button>
            </div>
        </form>
    </div>
</body>

</html>
<?php 

mysqli_free_result( $result1 );
mysqli_free_result( $result2 );
mysqli_free_result( $result4 );

include_once("inc/i_desconectaDB.php");

?>