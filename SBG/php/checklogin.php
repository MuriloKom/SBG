<?php

// Inicia a sessÃ£o

session_start();

// Inclui detalhes da conexÃ£o com o BD

include ('config.php');

// Flag de ValidaÃ§Ã£o de Erro

$errflag = false;

// ConexÃ£o ao Servidor MYSQL

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if (!$con)
	{
	die('Erro ao conectar ao servidor: ' . mysqli_error());
	}

// Higieniza os valores POST

$login    = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);

// ValidaÃ§Ã£o das entradas

if ($login == '' || $password == '' || empty($login) || empty($password))
	{
	$errmsg = 'Todos os campos devem ser preenchidos!';
	$errflag = true;
	}

// Se a flag de erro for verdadeira, redireciona para a pÃ¡gina de login

if ($errflag)
	{
	$_SESSION['ERRMSG'] = $errmsg;
	session_write_close();
	header("location: /index.php");
	exit();
	}

// Cria query de autenticaÃ§Ã£o no BD

$qry = "SELECT * FROM usuarios WHERE usuario = '".$login."' AND senha = AES_ENCRYPT('".$password."','".DB_AES_KEYSTRING."')";
$result = mysqli_query($con, $qry) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);

// Verifica se a query foi bem sucedida ou nÃ£o

if ($result)
	{

	// Login OK

	if (mysqli_num_rows($result) == 1)
		{

		// Verifica se usuÃ¡rio estÃ¡ ativo ou nÃ£o

		if (stripslashes($row['flag_ativo_inativo']))
			{

			// Verifica se Ã© primeiro acesso

			if (!stripslashes($row['flag_primeiro_acesso']))
				{
				session_regenerate_id();
				$_SESSION['SESS_MEMBER_ID'] = $row['id'];
				$_SESSION['user'] = $login;
				$_SESSION['userEmail'] = stripslashes($row['email']);
				$userPath = "/var/tmp/" . stripslashes($row['usuario']);
				$_SESSION['userPath'] = $userPath;
				session_write_close();
				header("location:search-input.php");
				exit();
				}
			  else
				{
				header("location: change-password.php");
				exit();
				}
			}
		  else
			{
			$errmsg = 'Usuário ou senha incorretos.';
			$_SESSION['ERRMSG'] = $errmsg;
			session_write_close();
			header("location: /index.php");
			exit();
			}
		}
	  else
		{
		$errmsg = 'Usuário ou senha incorretos.';
		$_SESSION['ERRMSG'] = $errmsg;
		session_write_close();
		header("location: /index.php");
		exit();
		}
	}
  else
	{
	$errmsg = 'Usuário ou senha incorretos.';
	$_SESSION['ERRMSG'] = $errmsg;
	session_write_close();
	header("location: /index.php");
	exit();
	}

?>
