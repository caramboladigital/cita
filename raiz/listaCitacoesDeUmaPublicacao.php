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
      // 1.1 Busca publicações
      $query1 = "SELECT * ";
      $query1 .= "FROM publicacao ";
      $query1 .= "WHERE IdPublicacao =" . $IdPublicacao;
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
        $query2 = "SELECT IdAutor ";
        $query2 .= "FROM aut_pub ";
        $query2 .= "WHERE IdPublicacao = " .  $IdPublicacao;
        // echo "query2: " . $query2 . "<br />";
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

          // 3.1 Busca os dados do autor da publicação
          $query3 = "SELECT * ";
          $query3 .= "FROM autor ";
          $query3 .= "WHERE IdAutor = " . $row2["IdAutor"];
          // echo "query3: " . $query3 . "<br />";
          mysqli_set_charset($connection, "utf8");
          $result3 = mysqli_query($connection, $query3);
          if (!$result3) {
            die("3. Query falhou.");
          }
          // 3.2 Retorna os dados das publicações
          $row3 = mysqli_fetch_assoc($result3);
          mostraAutor($row3["IdAutor"]);
          echo ". ";
        }

        mostraPublicacao($row1["IdPublicacao"]);
        echo "</p><hr>";
        // Escreve autor e publicação

        echo "<a class='botao' href='incluiPalavraCitacao.php?IdPublicacao=" . $_GET['IdPublicacao'] . "'>CADASTRA NOVA CITAÇÃO</a>";
      }
      echo "<h2>". xpre("Citações") . "</h2>";
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

      // 1.2 Retorna os Ids dos autores das publicações
      while ($row4 = mysqli_fetch_assoc($result4)) {
        // 2.1 Busca cada autor com mesmo IdPub da publicacao
        $query5 = "SELECT IdPalavra ";
        $query5 .= "FROM cit_pal ";
        $query5 .= "WHERE IdCitacao = " . $row4["IdCitacao"];
        // echo "query2: " . $query2 . "<br />";
        mysqli_set_charset($connection, "utf8");
        $result5 = mysqli_query($connection, $query5);
        //echo "result2: " . $result2 . " / ";
        if (!$result5) {
          die("5. Query falhou.");
        }
        // BOTOES
        if ($_SESSION["ehAdmin"]) {
          echo "<a alt='editar' href='editaPalavraCitacao.php?IdCitacao=" . $row4['IdCitacao'] . "' ><img class='ico' width = '16px' height = 16px' title = 'editar' src = 'img/ico/editar.png'></a>";
          echo "<a alt='deletar' href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $IdPublicacao . "&msgDelIdCitacao=" . $row4['IdCitacao'] . "' ><img class='ico' width = '16px' height = 16px' title = 'deletar' src = 'img/ico/menos.png'></a>";
        }
        echo "<br />";

        // MONTA A LINHA

        mostraCitacao($row4["IdCitacao"]);
        echo "<hr>";
      }
      // 4. libera os dados retornados
      mysqli_free_result($result1);
      mysqli_free_result($result2);
      mysqli_free_result($result3);
      mysqli_free_result($result4);
      // mysqli_free_result( $result5 );
      // mysqli_free_result( $result6 );
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
// 5. Close connection
include_once("inc/i_desconectaDB.php");
?>