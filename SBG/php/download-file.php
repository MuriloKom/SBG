<?php 
require ('authentication_confirmation.php');
include ('net/SSH2.php');
include ('config.php');
// define('NET_SSH2_LOGGING', NET_SSH2_LOG_REALTIME);
session_regenerate_id();

//Declaração de Variáveis
$fileCount = 0;

set_time_limit(300);

$ssh = new Net_SSH2($_SESSION['targetAddress']);
if (!$ssh->login(SSH_USER, SSH_PASSWORD)) //$_SESSION['user']
	{
	exit('Login Failed');
	}

$ssh->setTimeout(1);
$command = "rm " . $_SESSION['userPath'] . "/* -f";
$ssh->exec($command);

foreach($_POST['filecheck'] as $file)
	{
	$command = "cd " . $_SESSION['path'] . " && cp " . $file . " " . $_SESSION['userPath'] . "\n";
	$ssh->exec($command);
	}

$ssh->_disconnect(NET_SSH2_DISCONNECT_BY_APPLICATION);

sleep(40);

$ssh = new Net_SSH2($_SESSION['targetAddress']); //$_SESSION['user']
if (!$ssh->login(SSH_USER, SSH_PASSWORD))
	{
	exit('Login Failed');
	}

$ssh->setTimeout(1);
$command = "ls " . $_SESSION['userPath'] . " | wc -l";
$fileCount = $ssh->exec($command);

if ((count($_POST['filecheck'])) == $fileCount)
	{
	$command = 'cd ' . $_SESSION['userPath'] . '; zip gravacao.zip *.WAV *.vox && uuencode gravacao.zip gravacao.zip | mail -s "Arquivo de Gravação" ' . $_SESSION['userEmail'];
	$ssh->exec($command);
	$_SESSION['ERRMSG'] = "As gravações foram enviadas ao seu e-mail!";
	header("location: search-input.php");
	}
  else
	{
	$_SESSION['ERRMSG'] = "Erro ao enviar e-mail. Contate o administrador do sistema";
	header("location: search-input.php");
	}

?>

