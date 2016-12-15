<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include('config.php');
//Start session
session_start();
echo'<html xmlns="http://www.w3.org/1999/xhtml">';
echo'<LINK HREF="/css/loginform.css" MEDIA="all" REL="stylesheet" TYPE=
  "text/css" />';
echo'<meta charset=utf-8> <!--Compatibilidade com caracteres especiais-->';
echo'<META name="viewport" content="width=device-width, initial-scale=1">';
echo'<head>';
echo'<title>Autenticação</title>';
echo'</head>';
echo'<body>';

//Conexão ao Servidor MYSQL
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!$con)
{
  die('Erro ao conectar ao servidor: '.mysqli_error($con));
}

$qry = "SELECT nome FROM usuarios WHERE id = ".$_SESSION['SESS_MEMBER_ID'];
$result = mysqli_query($con, $qry)or die($qry."<br/><br/>".mysqli_error($con));

$nomeUsuario = mysqli_fetch_array($result);
$nomeUsuario = stripslashes($nomeUsuario['nome']);

echo'<p align="center">&nbsp;</p>';
echo'<h1 align="center" CLASS="sysmsg">Você já está conectado como
  '.$nomeUsuario.'.</h4>';
echo'<p align="center" CLASS="sysmsg">Clique <a href="/php/search-input.php">aqui</a> para buscar gravações ou <a href="logout.php">aqui</a> para sair.</p>';
echo'</body>';
echo'</html>';
?>