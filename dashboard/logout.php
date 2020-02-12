<?php
	ob_start();
	session_start();
	unset($_SESSION['s_id']);
	//unset($_SESSION[$conf_hash_name]['username']);
	//unset($_SESSION[$conf_hash_name]['password']);
	session_unset();
	session_destroy();
	header('Location: ../index.php');
	exit;
?>