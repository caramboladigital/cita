<?php
include_once("inc/i_session.php");
include_once("inc/i_conectaDB.php");
include_once("inc/i_funcoes.php");
confirmacao_logado();
?>
<html>

<head>
    <meta charset="utf-8" />
    <title>Check-up do Banco de Dados</title>
    <?php include_once("inc/i_links.php"); ?>
</head>

<body>
    <div id="divGeral">
        <?php include_once("inc/i_topo.php"); ?>
        <h1>Check-up do Banco de Dados</h1>
        <div class="indent">
            <?php
            include_once("inc/i_listaSaudeDbAutorSemPublicacao.php");
            include_once("inc/i_listaSaudeDbPublicacaoSemAutor.php");
            include_once("inc/i_listaSaudeDbPublicacaoSemCitacao.php");
            include_once("inc/i_listaSaudeDbCitacaoSemPublicacao.php");
            include_once("inc/i_listaSaudeDbCitacaoSemPalavra.php");
            include_once("inc/i_listaSaudeDbPalavraSemCitacao.php");
            ?>
        </div>
    </div>


    <?php
    // SE VIER DO NADA, É LISTA
    // SE VIER COM GET, É PRA DELETAR O AUTOR
     if (empty(!$_GET)) {
        // echo "Tem GET sim";
        if (array_key_exists("msgDelIdAutor",$_GET)) {
            $elemento = "Autor: " . retornaAutor( $_GET[ 'msgDelIdAutor' ] );
            modal ($_GET[ 'msgDelIdAutor' ] , $elemento , "Você confirma que quer deletar este autor?", "commitDeleteAutor.php?IdAutor=", "listaSaudeDbCheckUp.php");
        }

        if (array_key_exists("msgDelIdPublicacao",$_GET)) {
            $elemento = "Publicação: " . retornaPublicacao( $_GET[ 'msgDelIdPublicacao' ] );
            modal ($_GET[ 'msgDelIdPublicacao' ] , $elemento , "Você confirma que quer deletar esta publicação?", "commitDeletePublicacao.php?IdPublicacao=", "listaSaudeDbCheckUp.php");
        }

        if (array_key_exists("msgDelIdCitacao",$_GET)) {
            $elemento = "Citação: " . retornaCitacao( $_GET[ 'msgDelIdCitacao' ] );
            modal ($_GET[ 'msgDelIdCitacao' ] , $elemento , "Você confirma que quer deletar esta citação?", "commitDeleteCitacao.php?IdCitacao=", "listaSaudeDbCheckUp.php");
        }

        if (array_key_exists("msgDelIdPalavra",$_GET)) {
            $elemento = "Palavra: " . retornaPalavra( $_GET[ 'msgDelIdPalavra' ] );
            modal ($_GET[ 'msgDelIdPalavra' ] , $elemento , "Você confirma que quer deletar esta palavra-chave?", "commitDeletePalavra.php?IdPalavra=", "listaSaudeDbCheckUp.php");
        }



    }
    include_once("inc/i_modal.php");
    ?>
</body>

</html>
<?php
include_once("inc/i_desconectaDB.php");
?>