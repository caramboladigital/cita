<div id="topo">
  <div id="logoCitacoes"><a href="index.php"><img src="img/logo-cita.png"></a></div>
  <!-- <div id="logoCarambola"><img src="img/logo-carambola.png"></div> -->
</div>
<script>
  /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
</script>
<div class="menu">
  <div id="myTopnav" class="topnav">
    <a href="index.php"><?php echo xpre("Busca por palavra-chave"); ?></a>
    <?php
    if ($_SESSION["ehAdmin"]) {
      echo "<a href='incluiAutorPublicacao.php'>" . xpre("Nova publicação") . "</a>";

    }
    ?>
    <div class="dropdown">
      <button class="dropbtn"><?php echo xpre("Listas"); ?>
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="listaAutorPublicacao.php"><?php echo xpre("Lista publicações"); ?></a>
        <a href="listaAutor.php"><?php echo xpre("Lista autores"); ?></a>
        <a href="listaPalavra.php"><?php echo xpre("Lista palavras-chave"); ?></a>
      </div>
    </div>
    <?php
    if ($_SESSION["ehAdmin"]) {
      echo "<a href='listaSaudeDbCheckUp.php'>CHECK UP DB</a>";
    }
    ?>
    <a href="logout.php">LOGOUT</a>
    <span style="float:left;margin-top:10px"> | </span>
    <a class="menuLang" href="mudaLingua.php?UsuLingua=ptBR">ptBR</a>
    <a class="menuLang" href="mudaLingua.php?UsuLingua=enGB">enGB</a>
    <a class="menuLang" href="mudaLingua.php?UsuLingua=esES">esES</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
  </div>
</div>

<div id="divUsuario">
  <?php
  echo xpre("usuário")  . ": " . $_SESSION["UsuNome"];
  ?>
</div>
<div class="espaco30"></div>