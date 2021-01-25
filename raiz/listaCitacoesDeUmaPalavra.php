<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();

?>
<html>

<head>
  <title><?php echo xpre("Lista citações de uma palavra-chave"); ?></title>
  <?php include_once("inc/i_links.php"); ?>
</head>

<body>
  <div id="divGeral">
    <?php include_once("inc/i_topo.php"); ?>
    <?php

    $ultPub = "";
    $IdPalavra =  $_GET['IdPalavra'];

    echo "<h1>" .  xpre("Palavra-chave") . ": " . retornaPalavra($IdPalavra) . "</h1>";

    $query1 = "SELECT IdCitacao ";
    $query1 .= "FROM cit_pal ";
    $query1 .= "WHERE IdPalavra = " . $IdPalavra;

    mysqli_set_charset($connection, "utf8");
    $result1 = mysqli_query($connection, $query1);

    if (!$result1) {
      die("1. Query falhou: " . $query1);
    }

    while ($row1 = mysqli_fetch_assoc($result1)) {

      $query2 = "SELECT IdPublicacao, IdCitacao ";
      $query2 .= "FROM citacao ";
      $query2 .= "WHERE IdCitacao =" . $row1["IdCitacao"] . " ";
      $result2 = mysqli_query($connection, $query2);
      if (!$result2) {
        die("2. Query falhou: " . $query2);
      }

      while ($row2 = mysqli_fetch_assoc($result2)) {

        $query3 = "SELECT * ";
        $query3 .= "FROM aut_pub ";
        $query3 .= "WHERE IdPublicacao = " . $row2["IdPublicacao"] . " ";
        $result3 = mysqli_query($connection, $query3);
        if (!$result3) {
          die("5. Query falhou." . $query3);
        }
        if ($ultPub != $row2["IdPublicacao"]) {
          echo "<p class='blocoPublicacao'>";
            mostraAutorDePublicacao($row2["IdPublicacao"]);
            // mostraAutor($row6["IdAutor"]);

          //
          // MOSTRA PUBLICACAO
          //
          mostraPublicacao($row2["IdPublicacao"]);
          echo "<p class='textoPequeno'><a href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $row2["IdPublicacao"] . "'>" . xpre("link para a publicação") . "</a></p>";
          $ultPub = $row2["IdPublicacao"];

        }
        echo "<hr>";
        if ($_SESSION["ehAdmin"]) {
          echo "<a href='editaPalavraCitacao.php?IdCitacao=" . $row1["IdCitacao"] . "' >" . retornaBotao("editar") . "</a>";
          echo "<a href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $row2["IdPublicacao"] . "&msgDelIdCitacao=" . $row1["IdCitacao"] . "' >" . retornaBotao("deletar") . "</a>";
        }
        echo "<br />";
        mostraCitacao($row1["IdCitacao"]);
      }
    }

    ?>

  </div>
</body>

</html>

<?php
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result3);
include_once("inc/i_desconectaDB.php");
?>