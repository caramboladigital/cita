<?php
    session_start();
	
	function logado() {
		return isset($_SESSION['IdUsuario']);
	}
	
	function confirmacao_logado() {
		if (!logado()) {
			header('Location: login.php');
		}
	}
?>
