<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();

?>
<html>

<head>
  <meta charset="utf-8" />
  <title><?php echo xpre("Busca por palavra-chave"); ?></title>
  <?php include_once("inc/i_links.php"); ?>
</head>

<body>
  <div id="divGeral">
    <?php include_once("inc/i_topo.php"); ?>

    <h1><?php echo xpre("Busca por palavra-chave"); ?></h1>
    <p><?php echo xpre("Palavra (X) | X = número de vezes que a palavra foi associada a uma citação."); ?></p>
    <p class="textoP">Alternar para <a href="index.php">visualização tipo nuvem de chips</a></p>
    <hr>
    
      <?php
      $query1 = "SELECT * ";
      $query1 .= "FROM palavra ";
      $query1 .= "ORDER BY PalPalavra ASC";
      //echo "query1:" . $query1 . "<br />";
      mysqli_set_charset($connection, "utf8");
      $result1 = mysqli_query($connection, $query1);
      if (!$result1) {
        die("1. Query falhou.");
      }
      while ($row1 = mysqli_fetch_assoc($result1)) {
        $query2 = "SELECT COUNT(IdPalavra) ";
        $query2 .= "FROM cit_pal ";
        $query2 .= "WHERE IdPalavra =" . $row1["IdPalavra"];
        //echo "query2:" . $query2 . "<br />";
        mysqli_set_charset($connection, "utf8");
        $result2 = mysqli_query($connection, $query2);
        if (!$result2) {
          die("2. Query falhou.");
        }
        $row2 = mysqli_fetch_assoc($result2);
        $nString = implode($row2);
        $nNumero = intval($nString);
        $tamanhoDaFonte = 12+intval(3* sqrt($nNumero));
        echo "<a class='chip2' href='listaCitacoesDeUmaPalavra.php?IdPalavra=" . $row1['IdPalavra'] . "'>";
        echo "<div class='chip2-palavra' style='font-size: " . $tamanhoDaFonte . "'>" . $row1['PalPalavra'] . "</div>";
        echo "<div class='chip2-numero'>" . $nString . "</div> ";
        echo "</a> ";
      }
      
      mysqli_free_result($result1);
      mysqli_free_result($result2);
      ?>
    
  </div>
</body>

</html>
<?php include_once("inc/i_desconectaDB.php"); ?>