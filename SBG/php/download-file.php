<?php 
require('authentication_confirmation.php'); // Certifica que o usuário está autenticado
include('Net/SSH2.php');                    // Inclui biblioteca para SSH
include('config.php');                      // Inclui informações de conexão ao BD e SSH Server

// Ativa log em tempo real
//define('NET_SSH2_LOGGING', NET_SSH2_LOG_REALTIME);

// Restaura a sessão
session_regenerate_id();

// Declaração de Variáveis
$fileCount = 0;
$errflag = FALSE;

// Conexão ao Servidor MySQL
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

// Verifica se a conexão foi bem sucedida
if (!$con)
{
    die('Erro ao conectar ao servidor: ' . mysqli_error());
}

//Verifica se pelo menos uma gravação foi selecionada
if(empty($_POST['filecheck']))
{
	$errmsg  = 'Pelo menos uma gravação deve ser selecionada!';
    $errflag = TRUE;
}

//Caso flag de erro seja verdadeira, retorno mensagem de erro à página anterior
if($errflag)
{
	$_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: select-file.php");
    exit();
}

// Define tempo de timeout do PHP
set_time_limit(300);

// Estabelece conexão com o servidor escolhido ou retorna erro em caso de falha
$ssh = new Net_SSH2($_SESSION['targetAddress']);
if (!$ssh->login(SSH_USER, SSH_PASSWORD)) //$_SESSION['user']
{
	exit('Login Failed');
}

// Define intervalo com que são enviados os comandos ao servidor
$ssh->setTimeout(1);

// Apaga todos os arquivos da pasta do usuário para evitar acúmulo,
// visto que a pasta deve ser utilizada apenas para armazenamento
// das gravações selecionadas até o envio delas por e-mail
$command = "rm " . $_SESSION['userPath'] . "/* -f";
$ssh->exec($command);

// As gravações selecionadas são copiadas uma a uma para a pasta do usuário
foreach($_POST['filecheck'] as $file)
{
	$command = "cd " . $_SESSION['path'] . " && cp " . $file . " " . $_SESSION['userPath'] . "\n";
	$ssh->exec($command);
}

$downloaded = implode(", ", $_POST['filecheck']);

// Desconecta do servidor
$ssh->_disconnect(NET_SSH2_DISCONNECT_BY_APPLICATION);

// Para o script por 40s para aguardar copia das gravações
sleep(40);

// Estabelece conexão com o servidor escolhido ou retorna erro em caso de falha
$ssh = new Net_SSH2($_SESSION['targetAddress']); //$_SESSION['user']
if (!$ssh->login(SSH_USER, SSH_PASSWORD))
{
	exit('Login Failed');
}

// Define intervalo com que são enviados os comandos ao servidor
$ssh->setTimeout(1);

// Verifica se a quantidade de arquivos na pasta do usuário é igual a quantidade
// de arquivos selecionados na página anterior
$command = "ls " . $_SESSION['userPath'] . " | wc -l";
$fileCount = $ssh->exec($command);

// Caso a quantidade de arquivos seja igual, zipa todos e envia ao e-mail do usuário
if ((count($_POST['filecheck'])) == $fileCount)
{
	$command = 'cd ' . $_SESSION['userPath'] . '; zip gravacao.zip *.WAV *.vox && uuencode gravacao.zip gravacao.zip | mail -s "Arquivo de Gravação" ' . $_SESSION['userEmail'];
	$ssh->exec($command);
	
	// Faz query de INSERT para criação de log de pesquisa
	$qry = "INSERT INTO log (usuario, tipo, arquivos_afetados, ip_origem) VALUES ('".$_SESSION['user']."', 'download', '".$downloaded."', '".$_SERVER['REMOTE_ADDR']."')";
			
	mysqli_query($con, $qry) or die($qry . "<br/><br/>" . mysqli_error());	
	
	$_SESSION['ERRMSG'] = "As gravações foram enviadas ao seu e-mail!";
	header("location: search-input.php");
}
// Caso seja diferente, retorna erro
else
{
	$_SESSION['ERRMSG'] = "Erro ao enviar e-mail. Contate o administrador do sistema";
	header("location: search-input.php");
}

?>