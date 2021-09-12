<?php
include_once( "inc/i_session.php" );
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );
confirmacao_logado(); 
?>
<html>

<head>
    <meta charset="utf-8" />
    <title><?php echo xpre("Busca"); ?></title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>
<body>
    <div id="divGeral">
        <?php include_once( "inc/i_topo.php" ); ?>
        <h1><?php echo xpre("Resultado da busca"); ?></h1>
        <?php 
        $termo =  $_POST['expressaoBusca']; 
        ?>
        <h2><?php echo xpre("Termo") . ": <em>" . $termo . "</em>"; ?></h2>
        <p>
            <?php
            $query1 = "SELECT * ";
            $query1 .= "FROM citacao ";
            $query1 .= "WHERE CitCitacao LIKE '%" . $termo . "%' ";
            //$query1 .= "ORDER BY IdCitacao ASC";
            mysqli_set_charset( $connection, "utf8" );
            $result1 = mysqli_query( $connection, $query1 );
            if ( !$result1 ) {
                die( "1. Query falhou: " . $query1 );
            } 
            if (mysqli_num_rows($result1) == 0){
              echo xpre("A busca não resultou em nada.");
            }

            // 1.2 Retorna os Ids dos autores das publicações
            while ( $row1 = mysqli_fetch_assoc( $result1 ) ) {
                echo "<p class='blocoPublicacao'>";
                mostraAutorDePublicacao( $row1["IdPublicacao"] );
                //echo ". ";
                mostraPublicacao( $row1["IdPublicacao"] );
                echo "</p><hr>";
                echo "<p>";
                if ($_SESSION["ehAdmin"]) {
                  echo "<a href='editaPalavraCitacao.php?IdCitacao=" . $row1['IdCitacao'] . "' >" . retornaBotao("editar") . "</a>";
                  echo "<a href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $row1["IdPublicacao"] . "&msgDelIdCitacao=" . $row1['IdCitacao'] . "' >" . retornaBotao("deletar") . "</a>";
                  echo "<br />";
                }

                mostraCitacao($row1[ 'IdCitacao' ]);
                echo "</p>";
                //echo "<hr>";

            }
            mysqli_free_result( $result1 );
        ?>
        </p>
    </div>
    <?php
   
?>
</body>

</html>
<?php include_once( "inc/i_desconectaDB.php" );
?>
