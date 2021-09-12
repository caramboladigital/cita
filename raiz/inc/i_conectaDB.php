<?php
$dbhost = "localhost";

//  DB teste
$dbuser = "root";
$dbpass = "";
$dbname = "carambol_citacoes";

global $connection;
$connection = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname );
if ( mysqli_connect_errno() ) {
    die( "Conexão com a DB falhou: " . mysqli_connect_errno() );
}
