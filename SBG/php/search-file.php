<?php
require('authentication_confirmation.php');
include('Net/SSH2.php');
include('config.php');
session_regenerate_id();

//Flag de ValidaÃ§Ã£o de Erro
$errflag = false;

//Higieniza os valores POST
$targetServer = $_POST['targetServer'];
$targetFile   = escapeshellarg($_POST['targetFile']);

//ValidaÃ§Ã£o das entradas
if ($targetServer == '' || $targetFile == '' || empty($targetServer) || empty
  ($targetFile))
{
  $errmsg = 'Dados de pesquisa incompletos.';
  $errflag = true;
}

//Se a flag de erro for verdadeira, redireciona para a pÃ¡gina de login
if ($errflag)
{

  $_SESSION['ERRMSG'] = $errmsg;
  session_write_close();
  header("location: /php/search-input.php");
  exit();
}

switch ($targetServer)
{
  //case 'hdexterno':
    //$path = "/folder/folder/"; //the path where the file is located
    //$targetAddress = "192.x.x.x";
    //break;
  case 'storage01':
	$_SESSION['path'] = "/dados";
    $targetAddress = "192.168.20.179";
	$_SESSION['targetAddress'] = $targetAddress;
    break;
  case 'storage02':
	$_SESSION['path'] = "/dados";
    $targetAddress = "192.168.57.239";
	$_SESSION['targetAddress'] = $targetAddress;
    break;
  //case 'teste':
    //$path = "/folder/folder/"; //the path where the file is located
    //$targetAddress = "192.x.x.x";
    //break;
  default:
    die('Erro ao selecionar servidor.');
}

// set up a connection to the server we chose or die and show an error
$ssh = new Net_SSH2($targetAddress);
if (!$ssh->login(SSH_USER, SSH_PASSWORD)) //$_SESSION['user']
{
  exit('Login Failed');
}

$ssh->setTimeout(30);
$command = 'cd '.$_SESSION['path'].'; find -L *'.$targetFile.'*';

$file = $ssh->exec($command);
$ssh->disconnect();
$file = explode("\n", $file);
$_SESSION['file'] = $file;
header("location: select-file.php");
?>

