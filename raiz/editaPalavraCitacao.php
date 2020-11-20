<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>

<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo xpre("Edita citação"); ?></title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php 
            include_once( "inc/i_topo.php" );
        ?>
        <form action="commitUpdatePalavraCitacao.php" method="POST">
            <div id="divPalavra">
                <div class="espaco30"></div>
                <a class="botao" href="incluiPalavra.php"><?php echo xpre("Cadastra nova palavra-chave"); ?></a>
                <h2><?php echo xpre("Edita citação"); ?></h2>
                <?php

                $query1 = "SELECT * ";
                $query1 .= "FROM palavra ";
                $query1 .= "ORDER BY PalPalavra ASC";
                mysqli_set_charset( $connection, "utf8" );
                $result1 = mysqli_query( $connection, $query1 );
                if ( !$result1 ) {
                    die( "1. Query falhou: " . query1 . "<br />" );
                }
                //
                $IdCitacao = $_GET[ 'IdCitacao' ];

                ?>
                <select multiple name="listPalavra[]" id="listPalavra" style="width:200px;" class="listPalavra" size=20>
                    <?php
                    while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                        echo "<option ";
                        $query2 = "SELECT IdPalavra ";
                        $query2 .= "FROM cit_pal ";
                        $query2 .= "WHERE IdCitacao =" . $IdCitacao;
                        mysqli_set_charset( $connection, "utf8" );
                        $result2 = mysqli_query( $connection, $query2 );
                        if ( !$result2 ) {
                            die( "2. Query falhou: " . query2 . "<br />" );
                        }
                        while ($row2 = mysqli_fetch_assoc( $result2 ) ){
                            //echo "Resultado de Q2: ". $row2 [ 'IdAutor' ] ; 
                            if ($row2 [ 'IdPalavra' ] == $row1[ 'IdPalavra' ] ) {
                                echo " selected='selected' ";
                            }
                        }
                        echo "value = '" . $row1[ 'IdPalavra' ] . "'>" . $row1[ 'PalPalavra' ] . "</option>";
                    }
                     ?>
                </select>
            </div>
            <div id="divPublicacao">
                <?php
                $query4 = "SELECT * ";
                $query4 .= "FROM citacao ";
                $query4 .= "WHERE IdCitacao =" . $IdCitacao;
                mysqli_set_charset( $connection, "utf8" );
                $result4 = mysqli_query( $connection, $query4 );
                if ( !$result4 ) {
                    die( "4. Query falhou." );
                }
                $row4 = mysqli_fetch_assoc( $result4 );
                ?>

                <input id="IdCitacao" type="hidden" name="IdCitacao" class="IdCitacao" size="0" value="<?php echo $row4[ 'IdCitacao' ] ?>">
                <p><?php echo xpre("Página"); ?></p>
                <input id="CitPg" name="CitPg" class="CitPg" size="8" value="<?php echo $row4[ 'CitPg' ] ?>">
                <p><?php echo xpre("Citação"); ?></p>
                <textarea rows="10" cols="80" id="CitCitacao" name="CitCitacao" class="CitCitacao"><?php echo $row4[ 'CitCitacao' ] ?></textarea>
                <p><?php echo xpre("Comentário"); ?></p>
                <textarea rows="10" cols="80" id="CitComentario" name="CitComentario" class="CitComentario" size="50"><?php echo $row4[ 'CitComentario' ] ?></textarea>
                <button class="botao" type="submit" name="submit"><?php echo xpre("Altera citação"); ?></button>
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