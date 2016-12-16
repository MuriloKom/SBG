<?php
// Inicia a sessão
session_start();

// Verifica se a variável SESS_MEMBER_ID está setada ou não. Caso não, retorna acesso negado
if (empty($_SESSION['SESS_MEMBER_ID']))
{
  $errmsg = 'Acesso negado.';
  $_SESSION['ERRMSG'] = $errmsg;
  session_write_close();
  header("location: index.php");
  exit();
}

?>