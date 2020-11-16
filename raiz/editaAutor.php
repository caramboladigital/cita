<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>
<html>

<head>
  <meta charset="utf-8" />
  <title>Edita autor</title>
  <?php include_once("inc/i_links.php"); ?>
</head>

<body>
  <div id="divGeral">
    <?php
    include_once("inc/i_topo.php");
    ?>
    <h1>Edita autor</h1>
    <div id="editaAutor">
      <?php
      $IdAutor = $_GET['IdAutor'];

      //echo $IdPublicacao;

      $query2 = "SELECT * ";
      $query2 .= "FROM autor ";
      $query2 .= "WHERE IdAutor =" . $IdAutor;
      // echo "<br />Q4: " . $query4 . "<br / >";
      mysqli_set_charset($connection, "utf8");
      $result2 = mysqli_query($connection, $query2);
      if (!$result2) {
        die("2. Query falhou.");
      }

      $row2 = mysqli_fetch_assoc($result2);
      ?>
      <form action="commitUpdateAutor.php" method="POST">
        <?php
        echo "<h3>Sobrenome</h3>";
        echo "<input id='IdAutor' type= 'hidden' name='IdAutor' class='IdAutor' size='0' value= '" . $row2["IdAutor"] . "' >";
        echo "<input id='AutSobrenome' name='AutSobrenome' class='AutSobrenome' size='50' value= '" . $row2["AutSobrenome"] . "' >";
        echo "<h3>Nome</h3>";
        echo "<input id='AutNome' name='AutNome' class='AutNome' size='50' value= '" . $row2["AutNome"] . "' >";
        echo "<br /><br />";
        ?>
        <button class="botao" type="submit" name="submit">ALTERA AUTOR</button>
      </form>

    </div>
  </div>
</body>

</html>

<?php 

mysqli_free_result( $result2 );

include_once("inc/i_desconectaDB.php");

?>