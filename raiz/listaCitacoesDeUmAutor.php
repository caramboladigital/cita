<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>
<html>

<head>
  <title><?php echo xpre("Lista citações de um autor"); ?></title>
  <?php include_once("inc/i_links.php"); ?>
</head>

<body>
  <div id="divGeral">
    <?php include_once("inc/i_topo.php"); ?>
    <h1><?php echo xpre("Lista citações de um autor"); ?></h1>
    <div id="listaPub">
      <?php
      $IdAutor = $_GET['IdAutor'];
      // 1.1 Busca publicações
      $query1 = "SELECT * ";
      $query1 .= "FROM aut_pub ";
      $query1 .= "WHERE IdAutor =" . $IdAutor;
      //$query1 .= "ORDER BY PubTitulo ASC";
      mysqli_set_charset($connection, "utf8");
      $result1 = mysqli_query($connection, $query1);

      // echo "query1: " . $query1 . "<br />";

      // Testa query
      if (!$result1) {
        die("1. Query falhou.");
      }
      // 1.2 Retorna os Ids dos autores das publicações
      while ($row1 = mysqli_fetch_assoc($result1)) {
        // 2.1 Busca cada autor com mesmo IdPub da publicacao
        $query2 = "SELECT * ";
        $query2 .= "FROM publicacao ";
        $query2 .= "WHERE IdPublicacao = " .  $row1["IdPublicacao"];
        //echo "query2: " . $query2 . "<br />";
        mysqli_set_charset($connection, "utf8");
        $result2 = mysqli_query($connection, $query2);
        //echo "result2: " . $result2 . " / ";
        if (!$result2) {
          die("2. Query falhou.");
        }
        // MONTA A LINHA
        echo "<p class='blocoPublicacao'>";
        // 2.2 Retorna os dados dos autores
        while ($row2 = mysqli_fetch_assoc($result2)) {

          mostraAutorDePublicacao($row1["IdPublicacao"]);
        }

        mostraPublicacao($row1["IdPublicacao"]);
        echo "</p><hr>";

        echo "<a class='botao' href='incluiPalavraCitacao.php?IdPublicacao=" . $row1["IdPublicacao"] . "'>" . xpre("Cadastra nova citação") . "</a>";

        echo "<h2>" . xpre("Citações") . "</h2>";
        //
        //  CITACÕES
        //
        // 1.1 Busca citacoes
        $query4 = "SELECT * ";
        $query4 .= "FROM citacao ";
        $query4 .= "WHERE IdPublicacao = " .  $row1["IdPublicacao"] . " ";
        $query4 .= "ORDER BY ABS(CitPg) ASC";

        //echo "query4: " . $query4 . "<br />";
        mysqli_set_charset($connection, "utf8");
        $result4 = mysqli_query($connection, $query4);
        // Testa query
        if (!$result4) {
          die("4. Query falhou.");
        }

        // 1.2 Retorna os Ids dos autores das publicações
        while ($row4 = mysqli_fetch_assoc($result4)) {
          // BOTOES
          if ($_SESSION["ehAdmin"]) {
            echo "<a href='editaPalavraCitacao.php?IdCitacao=" . $row4['IdCitacao'] . "' >" . retornaBotao("editar") . "</a>";
            echo "<a href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $row1["IdPublicacao"] . "&msgDelIdCitacao=" . $row4['IdCitacao'] . "' >" . retornaBotao("deletar") . "</a>";
          }
          echo "<br />";
          mostraCitacao($row4["IdCitacao"]);
          echo "<hr>";
        }
      }

      ?>
    </div>
  </div>

  <?php
  // SE VIER DO NADA, É LISTA
  // SE VIER COM GET, É PRA DELETAR A PALAVRA-CHAVE

  if (empty(!$_GET)) {
    // echo "Tem GET sim";
    if (array_key_exists("msgDelIdCitacao", $_GET)) {
      $elemento =  xpre("Citação") . ": " . retornaCitacao($_GET['msgDelIdCitacao']);
      modal($_GET['msgDelIdCitacao'], $elemento, xpre("Você confirma que quer deletar esta citação?"), "commitDeleteCitacao.php?IdCitacao=", "listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $IdPublicacao);
    }
  }

  include_once("inc/i_modal.php");
  ?>

</body>

</html>
<?php
// 4. libera os dados retornados
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result4);
include_once("inc/i_desconectaDB.php");
?>