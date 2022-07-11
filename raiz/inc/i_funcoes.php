<?php

function mostraPublicacao($IdPublicacao)
{
  global $connection;
  $query = "SELECT * ";
  $query .= "FROM publicacao ";
  $query .= "WHERE IdPublicacao = " .  $IdPublicacao  . " ";
  $query .= "ORDER BY IdPublicacao";
  mysqli_set_charset($connection, "utf8");
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Query mostraPublicacao falhou." . $query);
  }

  $row = mysqli_fetch_assoc($result);

  /*   if ($_SESSION["ehAdmin"]) {
    echo "&nbsp;";
    echo "<a href='editaAutorPublicacao.php?IdPublicacao=" . $row["IdPublicacao"] . "'>" . retornaBotao("editar") . "</a>";
    echo "<a href='listaAutorPublicacao.php?msgDelIdPublicacao=" . $row['IdPublicacao'] . "' >" . retornaBotao("deletar") . "</a>";
  } */

  if ($row["PubArtigo"]) {
    echo "<span class='artigo'>" . $row["PubArtigo"] . "</span> In: ";
  }
  echo "<span class='titulo'>" . $row["PubTitulo"] . ". </span>";
  if ($row["PubLocal"]) {
    echo "<span class='local'> " . $row["PubLocal"] . ": </span>";
    echo "<span class='editora'> " . $row["PubEditora"] . ". </span>";
    if ($row["PubAno"]) {
      echo "<span class='ano'> " . $row["PubAno"] . ". </span>";
    } else {
      echo "Publicado em <span class='ano'> " . $row["PubDataDeAcesso"] . ". </span>";
    }
  }
  if ($row["PubUrl"]) {
    echo xpre("Disponível em") . " &#8249;<span class='url'>" . $row["PubUrl"] . "</span>&#8250;. ";
    echo xpre("Acessado em") .  " <span class='dataDeAcesso'>" . $row["PubDataDeAcesso"] . "</span>.";
  }
}

function retornaPublicacao($IdPublicacao)
{
  global $connection;
  $query = "SELECT * ";
  $query .= "FROM publicacao ";
  $query .= "WHERE IdPublicacao = " .  $IdPublicacao  . " ";
  mysqli_set_charset($connection, "utf8");
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Query mostraPublicacao falhou." . $query);
  }
  $row = mysqli_fetch_assoc($result);
  $publicacao = "";
  if ($row["PubArtigo"]) {
    $publicacao .= $row["PubArtigo"] . " In: ";
  }
  $publicacao .= $row["PubTitulo"] . ". ";
  return $publicacao;
}

function mostraCitacao($IdCitacao)
{
  global $connection;
  $query = "SELECT * ";
  $query .= "FROM citacao ";
  $query .= "WHERE IdCitacao = " . $IdCitacao . " ";
  $query .= "ORDER BY CitPg";
  mysqli_set_charset($connection, "utf8");
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Query mostraCitacao falhou: " . $query);
  }
  $row = mysqli_fetch_assoc($result);
  echo "<span class='citacao'>";
  if ($row["CitPg"]) {
    echo "<strong>" . xpre("Página") . ": </strong> " . $row["CitPg"] . "<br />";
  }
  if ($row["CitPosKindle"]) {
    echo "<strong>" . xpre("Pos. Kindle") . ": </strong> " . $row["CitPosKindle"] . "<br />";
  }
  echo "<strong>" . xpre("Citação") . ": </strong> <br /><span class='citacao'>" . $row["CitCitacao"] . "</span><br />";

  mostraReferenciaCurta($IdCitacao);


  if ($row["CitComentario"]) {
    echo "<strong>" . xpre("Comentário") . ": </strong><br /><span class='comentario'>" . $row["CitComentario"] . "</span><br />";
  }
  echo "<strong>" . xpre("Palavras-chave") . ": </strong>";
  mostraPalavrasDeCitacao($IdCitacao);
  echo "</span>";
  //echo "<hr>";
}

function retornaCitacao($IdCitacao)
{
  global $connection;
  $query = "SELECT * ";
  $query .= "FROM citacao ";
  $query .= "WHERE IdCitacao = " . $IdCitacao . " ";
  $query .= "ORDER BY CitPg";
  mysqli_set_charset($connection, "utf8");
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Query mostraCitacao falhou: " . $query);
  }
  $row = mysqli_fetch_assoc($result);

  $citacao =  substr($row["CitCitacao"], 0, 70) . "... ";
  return $citacao;
}

function mostraReferenciaCurta($IdCitacao)
{
  global $connection;

  $autor = "";

  $query1 = "SELECT * ";
  $query1 .= "FROM citacao ";
  $query1 .= "WHERE IdCitacao = " . $IdCitacao . " ";
  mysqli_set_charset($connection, "utf8");
  $result1 = mysqli_query($connection, $query1);
  if (!$result1) {
    die("Query mostraSobrenome1 falhou: " . $query1);
  }
  $row1 = mysqli_fetch_assoc($result1);

  $pg = $row1["CitPg"];

  $query2 = "SELECT * ";
  $query2 .= "FROM publicacao ";
  $query2 .= "WHERE IdPublicacao = " . $row1["IdPublicacao"];
  mysqli_set_charset($connection, "utf8");
  $result2 = mysqli_query($connection, $query2);
  if (!$result2) {
    die("Query mostraPublicacao falhou: " . $query2);
  }

  $row2 = mysqli_fetch_assoc($result2);
  $ano = $row2["PubAno"];

  $query3 = "SELECT * ";
  $query3 .= "FROM aut_pub ";
  $query3 .= "WHERE IdPublicacao = " . $row1["IdPublicacao"];
  mysqli_set_charset($connection, "utf8");
  $result3 = mysqli_query($connection, $query3);
  if (!$result3) {
    die("Query mostraAut_pub falhou: " . $query3);
  }
  $i = 1;
  $autores = "";

  while ($row3 = mysqli_fetch_assoc($result3)) {
    $query4 = "SELECT AutSobrenome ";
    $query4 .= "FROM autor ";
    $query4 .= "WHERE IdAutor = " . $row3["IdAutor"];
    mysqli_set_charset($connection, "utf8");
    $result4 = mysqli_query($connection, $query4);
    if (!$result4) {
      die("Query mostraAutor falhou: " . $query4);
    }
    $row4 = mysqli_fetch_assoc($result4);

    // 
    // LOOP PARA CONTAGEM DE AUTORES
    //
    $r = mysqli_num_rows($result3);
    $rn = intval($r); // total dos autores
    //echo implode($row4);
    //echo "<br/>rn:" . $rn;
    //echo "<br/>i:" . $i; // índice do autor corrente

    if ($i == 1) {
      $autores = "(" . implode($row4);
    } else if ($i == 2 and $rn == 2) {
      $autores = $autores . " e " . implode($row4);
    } else {
      $autores = $autores . "; " . implode($row4);
    }
    $i++;
  }


  echo $autores . ", ";
  if ($ano) {
    echo $ano;
  } else

  if ($row2["PubUrl"]) {
    echo " online";
  }
  if ($pg) {
    echo ", p. " . $pg;
  }
  echo ") <br/>";
  mysqli_free_result($result1);
  mysqli_free_result($result2);
  mysqli_free_result($result3);
  mysqli_free_result($result4);
}


function mostraAutor($IdAutor)
{
  global $connection;
  $query = "SELECT * ";
  $query .= "FROM autor ";
  $query .= "WHERE IdAutor = " . $IdAutor . " ";
  $query .= "ORDER BY IdAutor";
  mysqli_set_charset($connection, "utf8");
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Query mostraAutor falhou: " . $query);
  }
  $row = mysqli_fetch_assoc($result);
  echo "<span class='sobrenome'>" . $row["AutSobrenome"] .  "</span>";
  if ($row["AutNome"]) {
    echo ", <span class='nome'>" . $row["AutNome"] . "</span>";
  } else {
    //echo " ";
  }
}

function mostraAutorDePublicacao($IdPublicacao)
{
  global $connection;
  $query1 = "SELECT IdAutor ";
  $query1 .= "FROM aut_pub ";
  $query1 .= "WHERE IdPublicacao = " . $IdPublicacao . " ";
  mysqli_set_charset($connection, "utf8");
  $result1 = mysqli_query($connection, $query1);

  if (!$result1) {
    die("Query 1: " . $query1);
  }
  while ($row1 = mysqli_fetch_assoc($result1)) {
    mostraAutor($row1["IdAutor"]);
    echo ". ";
  }
}


function retornaAutor($IdAutor)
{
  global $connection;
  $query = "SELECT * ";
  $query .= "FROM autor ";
  $query .= "WHERE IdAutor = " . $IdAutor . " ";
  mysqli_set_charset($connection, "utf8");
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Query mostraAutor falhou: " . $query);
  }
  $row = mysqli_fetch_assoc($result);

  $autor  = $row["AutSobrenome"];
  if ($row["AutNome"]) {
    $autor .= ", " . $row["AutNome"];
  }
  return $autor;
}


function mostraPalavra($IdPalavra)
{
  global $connection;
  $query = "SELECT * ";
  $query .= "FROM palavra ";
  $query .= "WHERE IdPalavra = " . $IdPalavra . " ";
  mysqli_set_charset($connection, "utf8");
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Query mostraPalavra falhou: " . $query);
  }
  $row = mysqli_fetch_assoc($result);
  echo "<span class='palavra'>" . $row["PalPalavra"] . "</span>";
}

function retornaPalavra($IdPalavra)
{
  global $connection;
  $query = "SELECT * ";
  $query .= "FROM palavra ";
  $query .= "WHERE IdPalavra = " . $IdPalavra . " ";
  mysqli_set_charset($connection, "utf8");
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die("Query mostraPalavra falhou: " . $query);
  }
  $row = mysqli_fetch_assoc($result);
  return $row["PalPalavra"];
}


function mostraPalavrasDeCitacao($IdCitacao)
{
  global $connection;
  $query1 = "SELECT * ";
  $query1 .= "FROM cit_pal ";
  $query1 .= "WHERE IdCitacao = " . $IdCitacao;
  mysqli_set_charset($connection, "utf8");
  $result1 = mysqli_query($connection, $query1);

  if (!$result1) {
    die("Query 1: " . $query1);
  }
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $query2 = "SELECT * ";
    $query2 .= "FROM palavra ";
    $query2 .= "WHERE IdPalavra = " . $row1["IdPalavra"] . " ";
    $query2 .= "ORDER BY PalPalavra ASC";
    mysqli_set_charset($connection, "utf8");
    $result2 = mysqli_query($connection, $query2);
    if (!$result2) {
      die("Query 2: " . $query2);
    }
    $row2 = mysqli_fetch_assoc($result2);

    echo "<span class='palavra'><a href='listaCitacoesDeUmaPalavra.php?IdPalavra=" . $row2['IdPalavra'] . "'>" . $row2['PalPalavra'] . "</a></span> | ";
  }
}

function confirmaLogin()
{
  if (!isset($_SESSION['IdUsuario'])) {
    //header('Location: login.php');
    echo "sessão não definida";
  }
}

function modal($id, $elemento, $msg, $apaga, $volta)
{
  echo "<div id='myModal' class='modal'>";
  echo "<div class='modal-content'>";
  echo "<span class='close'>&times;</span>";
  echo "<p><strong>" . $elemento . "</strong></p>";
  echo "<p>" . $msg . "</p>";
  echo "<br />";
  echo "<a class='botao' href='" . $apaga . $id . "&origem=" . $volta . "'>" . xpre("Sim") . "</a>";
  echo "<a class='botao' href='" . $volta .       "'>" . xpre("Não") . "</a>";
  echo "</div>";
  echo "</div>";
}

function xpre($texto)
{
  global $connection;

  $query1 = "SELECT * ";
  $query1 .= "FROM lingua ";
  $query1 .= "WHERE ptBR = '" . $texto . "' ";
  mysqli_set_charset($connection, "utf8");
  $result1 = mysqli_query($connection, $query1);

  $lang = $_SESSION["UsuLingua"];

  if (!$result1) {
    echo " deu erro na tradução! <br />";
  } else {
    $row1 = mysqli_fetch_assoc($result1);
    $traducao = $row1[$lang];
    return $traducao;
  }
}

function tiraAcento($letra)
{
  switch ($letra) {
    case "À":
      return "A";
      break;
    case "Á":
      return "A";
      break;
    case "É":
      return "E";
      break;
    case "Í":
      return "I";
      break;
    case "Ó":
      return "O";
      break;
    case "Ú":
      return "U";
      break;
    case "Ã":
      return "A";
      break;
    case "Õ":
      return "O";
      break;
    case "á":
      return "A";
      break;
    case "é":
      return "E";
      break;
    case "í":
      return "I";
      break;
    case "ó":
      return "O";
      break;
    case "ú":
      return "U";
      break;
    default:
      return $letra;
      break;
  }
}

function retornaBotao($funcao)
{
  switch ($funcao) {
    case "editar":
      return "<img class='ico' width = '20px' height = '20px' title = '" . xpre("editar") . "' src = 'img/ico/editar.svg'>";
      break;
    case "deletar":
      return "<img class='ico' width = '20px' height = '20px' title = '" . xpre("deletar") . "' src = 'img/ico/apagar.svg'>";
      break;
    case "ver":
      return "<img class='ico' width = '20px' height = '20px' title = '" . xpre("ver") . "' src = 'img/ico/ver.svg'>";
      break;
    case "cima":
      return "<img class='ico' width = '20px' height = '20px' title = '" . xpre("para cima") . "' src = 'img/ico/cima.svg'>";
      break;
  }
}
