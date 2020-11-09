<?php
$dbhost = "localhost";

//  DB teste
$dbuser = "root";
$dbpass = "";
$dbname = "cita-teste";

// DB local COMPLETO
//$dbuser = "citacoes";
//$dbpass = "PtNs06#vs";
//$dbname = "citacoes";

// DB remoto COMPLETO
//$dbuser = "carambol_citacoes";
//$dbpass = "PtNs06vs";
//$dbname = "carambol_citacoes";

global $connection;
$connection = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname );
if ( mysqli_connect_errno() ) {
    die( "Conexão com a DB falhou: " . mysqli_connect_errno() );
}
?>

