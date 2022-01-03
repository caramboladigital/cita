<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>
<html>

<head>
  <meta charset="utf-8" />
  <title><?php echo xpre("Autores"); ?></title>
  <?php include_once("inc/i_links.php"); ?>
</head>

<body>
  <div id="divGeral">
    <?php include_once("inc/i_topo.php");  ?>
    <h1><?php echo xpre("Lista de autores"); ?></h1>
    <?php
    //$i = 0; // i = contador
    $query1 = "SELECT * ";
    $query1 .= "FROM autor ";
    $query1 .= "ORDER BY AutSobrenome ASC";
    mysqli_set_charset($connection, "utf8");
    $result1 = mysqli_query($connection, $query1);
    if (!$result1) {
      die("1. Query falhou.");
    }

    //
    // MONTA LISTA DE LETRAS INICIAL
    //
    $cadeiaLetras = "";
    while ($row1 = mysqli_fetch_assoc($result1)) {
      $novaLetraAutor = mb_substr($row1['AutSobrenome'], 0, 1, 'UTF-8');
        //
        // SE HOUVER ACENTO NA PRIMEIRA LETRA, TROCA POR LETRA NÃO ACENTUADA
        //
        $novaLetraAutor = tiraAcento($novaLetraAutor);
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
        //
        // SE HOUVER ACENTO NA PRIMEIRA LETRA, TROCA POR LETRA NÃO ACENTUADA
        //
        $novaLetraAutor = tiraAcento($novaLetraAutor);
      if ($ultLetraAutor != $novaLetraAutor) {
        echo "<div>";
        echo "<hr class='hrGrosso'>";
        echo "<h3 class='esq'><a id=" . $novaLetraAutor . "></a>" . $novaLetraAutor . "</h3>";
        echo "<a class='dir cima' href='#topo' >" . retornaBotao("cima") . "</a>";
        echo "</div>";
        echo "<hr class='clear'>";
        $ultLetraAutor = $novaLetraAutor;
      }

      //echo "<p>";
      if ($_SESSION["ehAdmin"]) {
        echo "&nbsp;";
        echo "<a href='editaAutor.php?IdAutor=" . $row1['IdAutor'] . "' >" . retornaBotao("editar") . "</a>";
        echo "<a href='listaAutor.php?msgDelIdAutor=" . $row1['IdAutor'] . "' >" . retornaBotao("deletar") . "</a>";
      }
      echo "<a href='listaCitacoesDeUmAutor.php?IdAutor=" . $row1['IdAutor'] . "' >" . retornaBotao("ver") . "</a>";
      //
      // MOSTRA AUTOR
      //
      mostraAutor($row1['IdAutor']);
      //echo " | ";
      echo "</p>";
    }
    mysqli_free_result($result1);
    ?>
  </div>
  <?php
  // SE VIER DO NADA, É LISTA
  // SE VIER COM GET, É PRA DELETAR O AUTOR

  if (empty(!$_GET)) {
    // echo "Tem GET sim";
    if (array_key_exists("msgDelIdAutor", $_GET)) {
      $elemento =  xpre("Autor") . ": " . retornaAutor($_GET['msgDelIdAutor']);
      modal($_GET['msgDelIdAutor'], $elemento, xpre("Você confirma que quer deletar este autor?"), "commitDeleteAutor.php?IdAutor=", "listaAutor.php");
    }
  }
  include_once("inc/i_modal.php");

  ?>
</body>

</html>
<?php

mysqli_free_result($result1);
include_once("inc/i_desconectaDB.php");
?>