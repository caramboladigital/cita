<?php
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");


$query3 = "INSERT INTO autor (AutSobrenome, AutNome) ";
$query3 .= "VALUES ('" . strtoupper($_POST['AutSobrenome']) . "', '" . $_POST['AutNome'] . "'); ";
// echo $query3 . "<br />";
mysqli_set_charset($connection, "utf8");
$result3 = mysqli_query($connection, $query3);
if (!$result3) {
  die("3. Query falhou.");
}

header("Location: listaAutor.php?creIdAutor=sucesso");

mysqli_free_result($result3);

// 5. Close connection
include_once("inc/i_desconectaDB.php");
