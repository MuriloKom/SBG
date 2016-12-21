<?php

// Inicia a sessão
session_start();

// Inclui detalhes da conexÃ£o com o BD e SSH Server
include('config.php');

// Flag de validação de erro
$errflag = FALSE;

// Conexão ao Servidor MySQL
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

// Verifica se a conexão foi bem sucedida
if (!$con)
{
    die('Erro ao conectar ao servidor: ' . mysqli_error());
}

// Higieniza as entradas do usuário para evitar SQL Injection
$login    = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);

// Verifica se há entradas vazias
if ($login == '' || $password == '' || empty($login) || empty($password))
{
    $errmsg  = 'Todos os campos devem ser preenchidos!';
    $errflag = TRUE;
}

// Se a flag de erro for verdadeira, redireciona para a página de login
if ($errflag)
{
    $_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: /index.php");
    exit();
}

// Query de autenticação do usuário 
$qry = "SELECT * FROM usuarios WHERE usuario = '" . $login . "' AND senha = AES_ENCRYPT('" . $password . "','" . DB_AES_KEYSTRING . "')";
$result = mysqli_query($con, $qry) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);

// Verifica se a query foi bem sucedida
if ($result)
{
	// Verifica se query encontrou apenas um resultado (usuário)
    if (mysqli_num_rows($result) == 1)
    {
        // Verifica se usuário está ativo      
        if (stripslashes($row['flag_ativo_inativo']))
        {
			// Verifica se é primeiro acesso do usuário. Caso seja, redireciona para a página de alteração de senha
			// Caso não seja primeiro acesso, atribui as variáveis de sessão e redireciona para a página inicial do sistema
            if (!stripslashes($row['flag_primeiro_acesso']))
            {
				// Faz query de INSERT para criação de log de acesso ao sistema
				$qry = "INSERT INTO log (usuario, tipo, arquivos_afetados, ip_origem) VALUES ('".$login."', 'acesso', 0, '".$_SERVER['REMOTE_ADDR']."')";
			
				mysqli_query($con, $qry) or die($qry . "<br/><br/>" . mysqli_error());
				
				//Atribui variáveis de sessão que serão usadas pelo sistema
                session_regenerate_id();
				// ID único de sessão do usuário
                $_SESSION['SESS_MEMBER_ID'] = $row['id'];
				// Variável para armazenar o usuário
                $_SESSION['user']           = $login;
				// Variável para armazenar o e-mail do usuário
                $_SESSION['userEmail']      = stripslashes($row['email']);
                // Variável para armazenar o caminho para pasta do usuário nos servidores
                $_SESSION['userPath']       = "/var/tmp/" . stripslashes($row['usuario']);
				// Finaliza escrita da sessão
                session_write_close();
                header("location:search-input.php");
                exit();
            }
			// Caso seja primeiro acesso, redireciona para alteração de senha
            else
            {
                header("location: change-password.php");
                exit();
            }
        }
		// Caso usuário esteja inativo, retorna mensagem à tela de login
        else
        {
            $errmsg             = 'Usuário inativo.';
            $_SESSION['ERRMSG'] = $errmsg;
            session_write_close();
            header("location: /index.php");
            exit();
        }
    }
	// Caso query encontre mais de um resultado, retorna falha, pois usuários devem ser únicos
	// Caso query não encontre resultado, retorna usuário não encontrado
    else
    {
        $errmsg             = 'Usuário ou senha incorretos.';
        $_SESSION['ERRMSG'] = $errmsg;
        session_write_close();
        header("location: /index.php");
        exit();
    }
}
// Caso a execução da query falhe, para o programa e retorna erro
else
{ 
    die("Query failed");
}

?>