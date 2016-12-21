<?php
require('authentication_confirmation.php'); // Certifica que o usuário está autenticado
include('Net/SSH2.php');                    // Inclui biblioteca para SSH
include('config.php');                      // Inclui informações de conexão ao BD e SSH Server

// Restaura a sessão
session_regenerate_id();                    

//Flag de validação de erro
$errflag = FALSE;

// Conexão ao Servidor MySQL
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

// Verifica se a conexão foi bem sucedida
if (!$con)
{
    die('Erro ao conectar ao servidor: ' . mysqli_error());
}

// Higieniza as entradas do usuário para evitar Shell Injection
$targetFile   = escapeshellarg($_POST['targetFile']);

// Variável para armazenar o servidor alvo
$targetServer = $_POST['targetServer'];

// Verifica se há entradas vazias
if ($targetServer == '' || $targetFile == '' || empty($targetServer) || empty($targetFile))
{
  $errmsg = 'Dados de pesquisa incompletos.';
  $errflag = TRUE;
}

//Se a flag de erro for verdadeira, redireciona para a página de pesquisade login
if ($errflag)
{
  $_SESSION['ERRMSG'] = $errmsg;
  session_write_close();
  header("location: /php/search-input.php");
  exit();
}

// Verifica qual foi o servidor selecionado pelo usuário
switch ($targetServer)
{
  case 'hdexterno':
    $_SESSION['path'] = "/mnt/hdextrno"; // Variável para armazenar o caminho onde estão salvas as gravações
    $_SESSION['targetAddress'] = "192.168.20.179"; // Variável para armazenar o IP do servidor alvo
    break;
  case 'storage01':
	$_SESSION['path'] = "/dados";
	$_SESSION['targetAddress'] = "192.168.20.179";
    break;
  case 'storage02':
	$_SESSION['path'] = "/dados";
	$_SESSION['targetAddress'] = "192.168.57.239";
    break;
  default:
    die('Erro ao selecionar servidor.');
}

// Estabelece conexão com o servidor escolhido ou retorna erro em caso de falha
$ssh = new Net_SSH2($_SESSION['targetAddress']);
if (!$ssh->login(SSH_USER, SSH_PASSWORD)) //$_SESSION['user']
{
  exit('Login Failed');
}

// Define intervalo com que são enviados os comandos ao servidor
$ssh->setTimeout(30);

// Pesquisa pelo arquivo alvo no servidor selecionado e desconecta
$command = 'cd '.$_SESSION['path'].'; find -L *'.$targetFile.'*';
$file = $ssh->exec($command);
$ssh->disconnect();

// Faz query de INSERT para criação de log de pesquisa
$qry = "INSERT INTO log (usuario, tipo, arquivos_afetados, ip_origem) 
VALUES ('".$_SESSION['user']."', 'pesquisa', '".$_POST['targetFile']."', '".$_SERVER['REMOTE_ADDR']."')";
			
mysqli_query($con, $qry) or die($qry . "<br/><br/>" . mysqli_error());	

if(strpos($file, 'find: ') !== FALSE)
{
	$_SESSION['ERRMSG'] = "A pesquisa não encontrou nenhuma gravação.";
	header("location: search-input.php");	
}
else
{
	// Quebra cada item do resultado da busca e salva em um array
	$file = explode("\n", $file);

	// Salva o array em uma variável de sessão para ser utilizado na página de seleção de gravações
	$_SESSION['file'] = $file;

	// Redireciona para a página de seleção de gravações
	header("location: select-file.php");
}
?>

