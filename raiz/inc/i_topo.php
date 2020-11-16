<div id="topo">
  <div id="logoCitacoes"><a href="buscaPorPalavra.php"><img src="img/logo-cita.png"></a></div>
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
  <div class="topnav" id="myTopnav">
    <a href="index.php">BUSCA POR PALAVRA-CHAVE</a>
    <?php
    if ($_SESSION["ehAdmin"]) {
      echo "<a href='incluiAutorPublicacao.php'>NOVA PUBLICAÇÃO</a>";
    }
    ?>
    <div class="dropdown">
      <button class="dropbtn">LISTAS
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="listaAutorPublicacao.php">LISTA PUBLICAÇÕES</a>
        <a href="listaAutor.php">LISTA AUTORES</a>
        <a href="listaPalavra.php">LISTA PALAVRAS-CHAVE</a>
      </div>
    </div>
    <?php
    if ($_SESSION["ehAdmin"]) {
      echo "<a href='listaSaudeDbCheckUp.php'>CHECK UP DB</a>";
    }
    ?>
    <a href="logout.php">LOGOUT</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
  </div>
</div>

<div id="divUsuario">
  <?php
  echo "usuário: " . $_SESSION["UsuNome"];
  ?>
</div>
<div class="espaco30"></div>