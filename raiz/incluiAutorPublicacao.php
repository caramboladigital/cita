<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>

<html>

<head>
  <meta charset="utf-8" />
  <title><?php echo xpre("Cadastra publicação"); ?></title>
  <?php include_once("inc/i_links.php"); ?>
</head>

<body>
  <div id="divGeral">
    <?php
    include_once("inc/i_topo.php");
    ?>
    <div id="divBotao">
      <a class="botao" href="incluiAutor.php"><?php echo xpre("Cadastra novo autor"); ?></a>
    </div>
    <form action="commitCreateAutorPublicacao.php" method="POST">
      <div id="divAutor">
        <h3><?php echo xpre("Selecione o(s) autor(es)"); ?></h3>
        <?php
        $query1 = "SELECT * ";
        $query1 .= "FROM autor ";
        $query1 .= "ORDER BY AutSobrenome ASC";
        mysqli_set_charset($connection, "utf8");
        $result1 = mysqli_query($connection, $query1);
        // Testa query
        if (!$result1) {
          die("1. Query falhou.");
        }
        ?>
        <select multiple name="listAutor[]" id="listAutor" style="width:200px;" class="listAutor" size=20>
          <?php
          while ($row1 = mysqli_fetch_assoc($result1)) {
            echo "<option value = '" . $row1['IdAutor'] . "'>" . strtoupper($row1['AutSobrenome']) . ", " . $row1['AutNome'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div id="divPublicacao">
        <h3><?php echo xpre("Cadastra publicação"); ?></h3>
        <div id="formPublicacao">
          <p><?php echo xpre("Título") ?></p>
          <input id='PubTitulo' name='PubTitulo' class='PubTitulo' size='50'><br />
          <p><?php echo xpre("Local") ?></p>
          <input id='PubLocal' name='PubLocal' class='PubLocal' size='25'>
          <p><?php echo xpre("Editora")  ?></p>
          <input id='PubEditora' name='PubEditora' class='PubEditora' size='25'>
          <p><?php echo xpre("Ano")  ?></p>
          <input id='PubAno' name='PubAno' class='PubAno' size='5'>
          <p><?php echo xpre("URL")  ?></p>
          <input id='PubUrl' name='PubUrl' class='PubUrl' size='64'>
          <p><?php echo xpre("Data de acesso")  ?></p>
          <input id='PubDataDeAcesso' name='PubDataDeAcesso' class='PubDataDeAcesso' size='25'>
          <p><?php echo xpre("Artigo")  ?></p>
          <input id='PubArtigo' name='PubArtigo' class='PubArtigo' size='65'>
          <br /><br />
          <button class="botao" type="submit" name="submit"><?php echo xpre("Cadastra nova publicação"); ?></button>
        </div>
      </div>
    </form>
  </div>
</body>

</html>
<?php
// 5. Close connection
include_once("inc/i_desconectaDB.php");
?>