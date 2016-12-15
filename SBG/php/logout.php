<?php
//Inicia a sessão
session_start();
//Limpa as variáveis da sessão
unset($_SESSION['SESS_MEMBER_ID']);
$errmsg             = 'Você foi deslogado com sucesso.';
$_SESSION['ERRMSG'] = $errmsg;
session_write_close();
header("location: /index.php");
exit();
?> 
