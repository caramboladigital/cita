<?php

function mostraPublicacao( $IdPublicacao ) {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM publicacao ";
    $query .= "WHERE IdPublicacao = " .  $IdPublicacao  . " ";
    mysqli_set_charset( $connection, "utf8" );
    $result = mysqli_query( $connection, $query );
    if ( !$result ) {
        die( "Query mostraPublicacao falhou.". $query );
    }

    $row = mysqli_fetch_assoc( $result );

    if ( $row[ "PubArtigo" ] ) {
        echo "<span class='artigo'>" . $row[ "PubArtigo" ] . "</span> In: ";
    }
    echo "<span class='titulo'>" . $row[ "PubTitulo" ] . ". </span>";
    if ( $row[ "PubLocal" ] ) {
        echo "<span class='local'> " . $row[ "PubLocal" ] . ": </span>";
        echo "<span class='editora'> " . $row[ "PubEditora" ] . ". </span>";
        if ( $row[ "PubAno" ] ) {
            echo "<span class='ano'> " . $row[ "PubAno" ] . ". </span>";
        } else {
            echo "Publicado em <span class='ano'> " . $row[ "PubDataDeAcesso" ] . ". </span>";
        }
    }
    if ( $row[ "PubUrl" ] ) {
        echo "Disponível em &#8249;<span class='url'>" . $row[ "PubUrl" ] . "</span>&#8250;. ";
        echo "Acessado em <span class='dataDeAcesso'>" . $row[ "PubDataDeAcesso" ] . "</span>.";
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

function mostraCitacao( $IdCitacao ) {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM citacao ";
    $query .= "WHERE IdCitacao = " . $IdCitacao . " ";
    $query .= "ORDER BY CitPg";
    mysqli_set_charset( $connection, "utf8" );
    $result = mysqli_query( $connection, $query );
    if ( !$result ) {
        die( "Query mostraCitacao falhou: ". $query );
    }
    $row = mysqli_fetch_assoc( $result );
    echo "<span class='citacao'>";
    if ( $row[ "CitPg" ] ) {
        echo "<strong>Página: </strong> " . $row[ "CitPg" ] . "<br />";
    }
    echo "<strong>Citação:</strong> <br /><span class='citacao'>" . $row[ "CitCitacao" ] . "</span><br />";
    if ( $row[ "CitComentario" ] ) {
        echo "<strong>Comentário: </strong><br /><span class='comentario'>" . $row["CitComentario"] . "</span><br />";
    }
    echo "<strong>Palavras-chave: </strong>";             
    mostraPalavrasDeCitacao ( $IdCitacao );
    echo "</span>";
    echo "<hr>";
}

function retornaCitacao( $IdCitacao ) {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM citacao ";
    $query .= "WHERE IdCitacao = " . $IdCitacao . " ";
    $query .= "ORDER BY CitPg";
    mysqli_set_charset( $connection, "utf8" );
    $result = mysqli_query( $connection, $query );
    if ( !$result ) {
        die( "Query mostraCitacao falhou: ". $query );
    }
    $row = mysqli_fetch_assoc( $result );

    $citacao =  substr( $row[ "CitCitacao" ], 0, 70) . "... ";
    return $citacao;
}



function mostraAutor( $IdAutor ) {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM autor ";
    $query .= "WHERE IdAutor = " . $IdAutor . " ";
    mysqli_set_charset( $connection, "utf8" );
    $result = mysqli_query( $connection, $query );
    if ( !$result ) {
        die( "Query mostraAutor falhou: ". $query );
    }
    $row = mysqli_fetch_assoc( $result );
    echo "<span class='sobrenome'>" . $row[ "AutSobrenome" ].  "</span>";
    if ( $row[ "AutNome" ] ) {
        echo ", <span class='nome'>" . $row[ "AutNome" ] . "</span>";
    } else {
      //echo " ";
    }

}

function mostraAutorDePublicacao( $IdPublicacao ) {
  global $connection;
  $query1 = "SELECT IdAutor ";
  $query1 .= "FROM aut_pub ";
  $query1 .= "WHERE IdPublicacao = " . $IdPublicacao . " ";
  mysqli_set_charset( $connection, "utf8" );
  $result1 = mysqli_query( $connection, $query1 );

  if ( !$result1 ) {
      die( "Query 1: ". $query1 );
  }
  while ($row1 = mysqli_fetch_assoc( $result1 ) ) {
    mostraAutor( $row1[ "IdAutor" ]);
    echo ". ";
  }
}


function retornaAutor( $IdAutor ) {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM autor ";
    $query .= "WHERE IdAutor = " . $IdAutor . " ";
    mysqli_set_charset( $connection, "utf8" );
    $result = mysqli_query( $connection, $query );
    if ( !$result ) {
        die( "Query mostraAutor falhou: ". $query );
    }
    $row = mysqli_fetch_assoc( $result );

    $autor  = $row[ "AutSobrenome" ] ;
    if ( $row[ "AutNome" ] ) {
        $autor .= ", " . $row[ "AutNome" ] ;
    } 
    return $autor;
}


function mostraPalavra( $IdPalavra ) {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM palavra ";
    $query .= "WHERE IdPalavra = " . $IdPalavra . " ";
    mysqli_set_charset( $connection, "utf8" );
    $result = mysqli_query( $connection, $query );
    if ( !$result ) {
        die( "Query mostraPalavra falhou: ". $query );
    }
    $row = mysqli_fetch_assoc( $result );
    echo "<span class='palavra'>" . $row[ "PalPalavra" ] . "</span>";
}

function retornaPalavra( $IdPalavra ) {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM palavra ";
    $query .= "WHERE IdPalavra = " . $IdPalavra . " ";
    mysqli_set_charset( $connection, "utf8" );
    $result = mysqli_query( $connection, $query );
    if ( !$result ) {
        die( "Query mostraPalavra falhou: ". $query );
    }
    $row = mysqli_fetch_assoc( $result );
    return $row[ "PalPalavra" ];
}


function mostraPalavrasDeCitacao ( $IdCitacao ) {
    global $connection;
    $query1 = "SELECT * ";
    $query1 .= "FROM cit_pal ";
    $query1 .= "WHERE IdCitacao = " . $IdCitacao;
    mysqli_set_charset( $connection, "utf8" );
    $result1 = mysqli_query( $connection, $query1 );

    if ( !$result1 ) {
        die( "Query 1: ". $query1 );
    }
    while ($row1 = mysqli_fetch_assoc( $result1 ) ) {
        $query2 = "SELECT * ";
        $query2 .= "FROM palavra ";
        $query2 .= "WHERE IdPalavra = " . $row1 ["IdPalavra" ] . " " ;
        $query2 .= "ORDER BY PalPalavra ASC";
        mysqli_set_charset( $connection, "utf8" );
        $result2 = mysqli_query( $connection, $query2 );
        if ( !$result2 ) {
            die( "Query 2: ". $query2 );
        }
        $row2 = mysqli_fetch_assoc( $result2 );

        echo "<span class='palavra'><a href='listaCitacoesDeUmaPalavra.php?IdPalavra=" . $row2[ 'IdPalavra' ] . "'>" . $row2[ 'PalPalavra' ] . "</a></span> | ";
    }
}




function confirmaLogin() {
    if (!isset($_SESSION['IdUsuario'])) {
        //header('Location: login.php');
        echo "sessão não definida";
    } 
}


function modal($id, $elemento , $msg, $apaga, $volta) {
    echo "<div id='myModal' class='modal'>";
        echo "<div class='modal-content'>";
            echo "<span class='close'>&times;</span>";
            echo "<p><strong>" . $elemento . "</strong></p>";
            echo "<p>" . $msg . "</p>";
            echo "<br />";
            echo "<a class='botao' href='" . $apaga . $id . "&origem=" . $volta . "'>SIM</a>";
            echo "<a class='botao' href='" . $volta .       "'>NÃO</a>";
        echo "</div>";
    echo "</div>";
}




function xpre($texto) {
  global $connection;

  /*
  $lang = "";
  $query0 = "SELECT * ";
  $query0 .= "FROM usuario ";
  $query0 .= "WHERE IdUsuario = '" . $_SESSION["IdUsuario"]  . "'";
  mysqli_set_charset( $connection, "utf8" );
  $result0 = mysqli_query( $connection, $query0 );
  $row0 = mysqli_fetch_assoc( $result0 );
  if ( !$result0 ) {
      //echo $texto;
  } else {
      //$lang = $row0 [ $lang ];
  }
*/

//include_once( "inc/i_session.php" );

  $query1 = "SELECT * ";
  $query1 .= "FROM lingua ";
  $query1 .= "WHERE ptBR = '" . $texto . "' ";
  mysqli_set_charset( $connection, "utf8" );
  $result1 = mysqli_query( $connection, $query1 );
  //$row1 = mysqli_fetch_assoc( $result1 );

  //echo  

 $lang = $_SESSION["UsuLingua"];
  
  if ( !$result1 ) {
      echo " deu erro na tradução! <br />";
  } else {
      $row1 = mysqli_fetch_assoc( $result1 ); 
      $traducao = $row1 [ $lang ];

      echo $traducao;
  }
  
}

