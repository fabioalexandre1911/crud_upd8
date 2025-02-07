<?php
session_start();
session_destroy(); // Finaliza a sessão
header('Location: login.php'); // Redireciona para a tela de login
exit;
?>