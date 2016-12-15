<?php
//Inicia a sessão
session_start();
//Verifica se a variável SESS_MEMBER_ID está setada ou não
if (!empty($_SESSION['SESS_MEMBER_ID']))
{
  header("location: php/already-logged.php");
  exit();
}

?>