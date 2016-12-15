<?php
//Inicia a sessÃ£o
session_start();
//Verifica se a variÃ¡vel SESS_MEMBER_ID estÃ¡ setada ou nÃ£o
if (empty($_SESSION['SESS_MEMBER_ID']))
{
  $errmsg = 'Acesso negado.';
  $_SESSION['ERRMSG'] = $errmsg;
  session_write_close();
  header("location: index.php");
  exit();
}

?>