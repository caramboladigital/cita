<?php
include_once( "inc/i_conectaDB.php" );
include_once( "inc/i_funcoes.php" );

		session_start();
		
		$_SESSION = array();
		
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}

		session_destroy();
		
		header('Location: login.php');
?>

<?php include_once( "inc/i_desconectaDB.php" ); ?>
