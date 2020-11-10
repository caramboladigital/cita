<html>

<head>
    <meta charset="utf-8" />
    <title>Usuário</title>
</head>

<body>
    <div id="divGeral">
    <h2>Usuário</h2>

    
    <?php     
        $password =utf8_encode("admin");
        echo $password . "<br />";
        $hash = hash('sha256', $password);

    echo "hash:" . $hash;
?>




    </div>
</body>

</html>
<?php include_once( "inc/i_desconectaDB.php" ); ?>
