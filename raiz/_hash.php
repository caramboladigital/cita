<html>

<head>
    <meta charset="utf-8" />
    <title>Cadastra usuário</title>
    <?php include_once( "inc/i_links.php" ); ?>
</head>

<body>
    <div id="divGeral">
    <h2>Usuário</h2>

    
    <?php     
        $password =utf8_encode("pitonisa");
        echo $password . "<br />";
        $hash = hash('sha256', $password);

    echo "hash:" . $hash;
    ?>

    </div>
</body>

</html>
