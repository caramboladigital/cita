<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>
<html>

<head>
  <title><?php echo xpre("Lista citações de uma publicação"); ?></title>
  <?php include_once("inc/i_links.php"); ?>
</head>

<body>
  <div id="divGeral">
    <?php include_once("inc/i_topo.php"); ?>
    <h1><?php echo xpre("Lista citações de uma publicação"); ?></h1>
    <div id="listaPub">
      <?php
      //$IdPublicacao =  1;
      $IdPublicacao = $_GET['IdPublicacao'];

        echo "<p class='blocoPublicacao'>";
        mostraAutorDePublicacao($IdPublicacao);
      //
      // MOSTRA PUBLICACAO
      //
      mostraPublicacao($IdPublicacao);
      echo "<p class='textoPequeno'><a href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $IdPublicacao . "'>" . xpre("link para a publicação") . "</a></p><hr>";

        // Escreve autor e publicação
        if ($_SESSION["ehAdmin"]) {
          echo "<a class='botao' href='incluiPalavraCitacao.php?IdPublicacao=" . $IdPublicacao . "'>" . xpre("Cadastra nova citação") . "</a>";
        }
      echo "<h2>" . xpre("Citações") . "</h2>";
      //
      //  CITACÕES
      //
      // 1.1 Busca citacoes
      $query4 = "SELECT * ";
      $query4 .= "FROM citacao ";
      $query4 .= "WHERE IdPublicacao =" .  $IdPublicacao . " ";
      $query4 .= "ORDER BY ABS(CitPg) ASC";

      // echo "query4: " . $query4 . "<br />";
      mysqli_set_charset($connection, "utf8");
      $result4 = mysqli_query($connection, $query4);
      // Testa query
      if (!$result4) {
        die("4. Query falhou.");
      }
      while ($row4 = mysqli_fetch_assoc($result4)) {
        // BOTOES
        if ($_SESSION["ehAdmin"]) {
          echo "<a href='editaPalavraCitacao.php?IdCitacao=" . $row4['IdCitacao'] . "' >" . retornaBotao("editar") . "</a>";
          echo "<a href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $IdPublicacao . "&msgDelIdCitacao=" . $row4['IdCitacao'] . "' >" . retornaBotao("deletar") . "</a>";
        }
        echo "<br />";
        mostraCitacao($row4["IdCitacao"]);
        echo "<hr>";
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
      mysqli_free_result($result4);

include_once("inc/i_desconectaDB.php");
?>