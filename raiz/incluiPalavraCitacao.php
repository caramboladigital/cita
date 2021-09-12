<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>

<html>

<head>
    <meta charset="utf-8" />
    <title>Cadastra citação</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php 
            $IdPublicacao = $_GET[ 'IdPublicacao' ];
        ?>
        <?php include_once( "inc/i_topo.php" ); ?>
        <?php 
            echo "<hr>";
            mostraPublicacao($IdPublicacao);
            echo "<hr>";
        ?>
        <div id="divBotao">
            <a class="botao" href="incluiPalavra.php">CADASTRA NOVA PALAVRA-CHAVE</a>
        </div>

        <form action="commitCreatePalavraCitacao.php" method="POST">
            <div id="divPalavra">
                <h3>Lista de palavras-chave</h3>
                <?php
                $query1 = "SELECT * ";
                $query1 .= "FROM palavra ";
                //$query1 .= "WHERE IdPub =". $arg;
                $query1 .= "ORDER BY PalPalavra ASC";
                mysqli_set_charset( $connection, "utf8" );
                $result1 = mysqli_query( $connection, $query1 );
                // Testa query
                if ( !$result1 ) {
                    die( "1. Query falhou." );
                }
                ?>
                <select multiple name="listaPalavra[]" id="listaPalavra" class="listaPalavra" size=20>
                    <?php
                    while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                        echo "<option value = '" . $row1[ 'IdPalavra' ] . "'>" . $row1[ 'PalPalavra' ] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div id="divCitacao">
                <h3>Cadastra citação</h3>
                <div id="formCitacao">
                    <input id="IdCitacao" type="hidden" name="IdCitacao" class="IdCitacao" size="0" >
                    <?php
                        echo "<input id='IdPublicacao' type='hidden' name='IdPublicacao' class='IdPublicacao' size='0' ";
                        echo "value=" . $IdPublicacao . " >";
                    ?>
                    <div id="blocoCitPg">
                      <p>Página:</p>
                      <input id="CitPg" name="CitPg" class="CitPg" size="5" >
                    </div>
                    <div id="blocoCitPosKindle">
                      <p>Pos. Kindle:</p>
                      <input id="CitPosKindle" name="CitPosKindle" class="CitPosKindle" size="5" >
                    </div></br>
                    <div id="blocoCitacao">
                      <p>Citação:</p>
                      <textarea rows="10" cols="80" id="CitCitacao" name="CitCitacao" class="CitCitacao"></textarea>
                    </div>
                    <p>Comentário:</p>
                    <textarea rows="10" cols="80" id="CitComentario" name="CitComentario" class="CitComentario" size="50"></textarea>
                    <br /><br />
                    <button class="botao" type="submit" name="submit">CADASTRA CITAÇÃO</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
<?php
// 5. Close connection
include_once( "inc/i_desconectaDB.php" );
?>
