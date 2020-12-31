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
    <?php include_once("inc/i_topo.php");
    /*         if ($_SESSION["ehAdmin"]){
            echo "<a class='botao' href='incluiAutor.php'>" . xpre("Cadastra novo autor") . "</a>";
        } */
    ?>
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
          echo "<div>";
          echo "<hr class='hrGrosso'>";
          echo "<h3 class='esq'><a id=" . $novaLetraAutor . "></a>" . $novaLetraAutor . "</h3>";
          echo "<a class='dir cima' href='#topo' ><img class='ico' width = '16px' height = '16px' title = 'para cima' src = 'img/ico/cima.png'></a>";
          echo "</div>";
          echo "<hr class='clear'>";
          $ultLetraAutor = $novaLetraAutor;
        }

        //echo "<p>";
        if ($_SESSION["ehAdmin"]) {
          echo "&nbsp;";
          echo "<a href='editaAutor.php?IdAutor=" . $row1['IdAutor'] . "' ><img class='ico' width = '16px' height = '16px' title = 'editar' src = 'img/ico/editar.png'></a>";
          echo "<a href='listaAutor.php?msgDelIdAutor=" . $row1['IdAutor'] . "' ><img class='ico' width = '16px' height = '16px' title = 'deletar' src = 'img/ico/menos.png'></a>";
        }
        echo "<a href='listaCitacoesDeUmAutor.php?IdAutor=" . $row1['IdAutor'] . "' ><img class='ico' width = '16px' height = '16px' title = 'ver' src = 'img/ico/ver.png'></a>";
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
<?php include_once("inc/i_desconectaDB.php");
?>