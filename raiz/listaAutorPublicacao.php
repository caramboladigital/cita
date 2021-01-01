<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>
<html>

<head>
  <meta charset="utf-8" />
  <title><?php echo xpre("Publicações"); ?></title>
  <?php include_once("inc/i_links.php"); ?>
</head>

<body>
  <div id="divGeral">
    <?php include_once("inc/i_topo.php");  ?>
    <h1><?php echo xpre("Lista de publicações"); ?></h1>
    <div id="listaPub">
      <?php

      $query1 = "SELECT * ";
      $query1 .= "FROM aut_pub ";
      $query1 .= "LEFT JOIN autor ";
      $query1 .= "ON aut_pub.IdAutor = autor.IdAutor ";
      $query1 .= "ORDER BY autor.AutSobrenome ";
      $result1 = mysqli_query($connection, $query1);
      //echo "2. Query: " . $query1 . "<br />";
      if (!$result1) {
        die("2. Query falhou:" . $query1);
      }

      //
      // MONTA LISTA DE LETRAS INICIAL
      //
      $cadeiaLetras = "";
      while ($row1 = mysqli_fetch_assoc($result1)) {
        $novaLetraAutor = mb_substr($row1['AutSobrenome'], 0, 1, 'UTF-8');
        if ($cadeiaLetras != $novaLetraAutor) {
          echo "<span class='cadeiaLetras'><a href='#" . $novaLetraAutor . "'>" . $novaLetraAutor . "</a></span> . ";
          $cadeiaLetras = $novaLetraAutor;
        }
      }

      //
      // RESETA ARRAY DO RESULT PARA INÍCIO
      //
      mysqli_data_seek($result1, 0);
      $ultLetraAutor = "";
      while ($row1 = mysqli_fetch_assoc($result1)) {
        echo "<p>";
        //
        //  GERA ÍNDICE E LINKS ÂNCORA
        //
        $novaLetraAutor = mb_substr($row1['AutSobrenome'], 0, 1, 'UTF-8');
        if ($ultLetraAutor != $novaLetraAutor) {
          echo "<hr class='hrGrosso'>";
          echo "<div>";
          echo "<h3 class='esq'><a id=" . $novaLetraAutor . "></a>" . $novaLetraAutor . "</h3>";
          echo "<a class='dir cima' href='#topo' ><img class='ico' width = '16px' height = '16px' title = 'para cima' src = 'img/ico/cima.png'></a>";
          echo "</div>";
          echo "<hr class='clear'>";
          $ultLetraAutor = $novaLetraAutor;
        }

        if ($_SESSION["ehAdmin"]) {
          echo "&nbsp;";
          echo "<a href='editaAutorPublicacao.php?IdPublicacao=" . $row1['IdPublicacao'] . "' >" . retornaBotao("editar") . "</a>";
          echo "<a href='listaAutorPublicacao.php?msgDelIdPublicacao=" . $row1['IdPublicacao'] . "' >" . retornaBotao("deletar") . "</a>";
        }
        echo "<a alt='editar' href='listaCitacoesDeUmaPublicacao.php?IdPublicacao=" . $row1['IdPublicacao'] . "' >" . retornaBotao("ver") . "</a>";


        mostraAutorDePublicacao($row1["IdPublicacao"]);
        // echo ". ";
        mostraPublicacao($row1["IdPublicacao"]);
        echo "</p>";
      }
      ?>
    </div>
  </div>


  <?php
  // SE VIER DO NADA, É LISTA
  // SE VIER COM GET, É PRA DELETAR O AUTOR

  if (empty(!$_GET)) {
    // echo "Tem GET sim";
    if (array_key_exists("msgDelIdPublicacao", $_GET)) {
      $elemento =  xpre("Publicação") . ": " . retornaPublicacao($_GET['msgDelIdPublicacao']);
      modal($_GET['msgDelIdPublicacao'], $elemento, xpre("Você confirma que quer deletar esta publicação?"), "commitDeletePublicacao.php?IdPublicacao=", "listaAutorPublicacao.php");
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