<?php
    include_once( "inc/i_session.php" );
    include_once( "inc/i_conectaDB.php" );
    include_once( "inc/i_funcoes.php" );
?>
<html>

<head>
    <title>Verifica Login</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
        <?php 
        include_once( "inc/i_topo.php" );
        $usuario = $_POST[ 'usuario' ];
        $hash = hash('sha256', $_POST[ 'senha' ]);        
        
        $query1 = "SELECT * ";
        $query1 .= "FROM usuario ";
        $query1 .= "WHERE UsuUsuario = '" . $usuario . "'";

        mysqli_set_charset( $connection, "utf8" );
        $result1 = mysqli_query( $connection, $query1 );
        if ( !$result1 ) {
            die( "1. Query falhou:" . $query1 );
        }
        $row1 = mysqli_fetch_assoc( $result1 );
        
        if ($row1["UsuUsuario"]){
           echo "usuario combina! <br />" ; 
            if ($hash == $row1["UsuHash"]){
                echo "hash também combina!<br />";
                echo "aqui devo definir a sessão logada!<br />";
                $_SESSION["IdUsuario"] = $row1["IdUsuario"];
                $_SESSION["UsuUsuario"] = $row1["UsuUsuario"];
                $_SESSION["UsuNome"] = $row1["UsuNome"];
                $_SESSION["UsuNivel"] = $row1["UsuNivel"];
                $_SESSION["UsuLingua"] = $row1["UsuLingua"];                
                if ($row1["UsuNivel"] == 1) {
                  $_SESSION["ehAdmin"] = TRUE;
                } else {
                  $_SESSION["ehAdmin"] = FALSE;
                }
                //echo "Usuário: " . $_SESSION["UsuUsuario"] . "<br />";
                //echo "Língua: " . $_SESSION["UsuLingua"]  . "<br />";
                header('Location: index.php?r=loginrolou');
            } else {
                echo "hash não combina!<br />";
                echo "Já para a praia dos quase famosos!<br />"; 
                header('Location: login.php?r=loginfalhou');
            }
        } else {
            echo "usuario não combina! <br />" ; 
            header('Location: login.php?r=loginfalhou');
        }

        ?>

   
    </div>
</body>

</html>
<?php
// 5. Close connection
include_once( "inc/i_desconectaDB.php" );
?>
