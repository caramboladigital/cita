<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Edita palavra-chave</title>
    <?php include_once("inc/i_links.php"); ?>
</head>

<body>
    <div id="divGeral">
        <?php include_once("inc/i_topo.php"); ?>
        <h1>Edita palavra-chave</h1>
        <div id="editaPalavra">

            <?php

            $IdPalavra = $_GET['IdPalavra'];

            $query2 = "SELECT * ";
            $query2 .= "FROM palavra ";
            $query2 .= "WHERE IdPalavra =" . $IdPalavra;
            // echo "<br />Q4: " . $query4 . "<br / >";
            mysqli_set_charset($connection, "utf8");
            $result2 = mysqli_query($connection, $query2);
            if (!$result2) {
                die("2. Query falhou.");
            }
            $row2 = mysqli_fetch_assoc($result2);
            ?>
            <form action="commitUpdatePalavra.php" method="POST">
                <?php
                echo "<input id='IdPalavra' type= 'hidden' name='IdPalavra' class='IdPalavra' size='0' value= '" . $row2["IdPalavra"] . "' >";
                echo "<input id='PalPalavra' name='PalPalavra' class='PalPalavra' size='50' value= '" . $row2["PalPalavra"] . "' >";
                echo "<br /><br />";
                ?>
                <button class="botao" type="submit" name="submit">ALTERA PALAVRA-CHAVE</button>
            </form>

        </div>
</body>

</html>