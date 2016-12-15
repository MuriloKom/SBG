
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
	die('Erro ao conectar ao servidor: ' . mysqli_error($con));
	}

// Higieniza os valores POST

$login       = mysqli_real_escape_string($con, $_POST['login']);
$oldpass     = mysqli_real_escape_string($con, $_POST['oldpass']);
$newpass     = mysqli_real_escape_string($con, $_POST['newpass']);
$newpassconf = mysqli_real_escape_string($con, $_POST['newpassconf']);

// ValidaÃ§Ã£o das entradas

if ($login == '' || $oldpass == '' || $newpass == '' || $newpassconf == '')
	{
	$errmsg = 'Todos os campos devem ser preenchidos!';
	$errflag = true;
	}

// Se a flag de erro for verdadeira, redireciona para a pÃ¡gina de login

if ($errflag)
	{
	$_SESSION['ERRMSG'] = $errmsg;
	session_write_close();
	header("location: /php/change-password.php");
	exit();
	}

if ($newpass == $newpassconf)
	{

	// Cria query de autenticaÃ§Ã£o no BD

	$qry = "SELECT * FROM usuarios WHERE usuario='" . $login . "' AND senha = AES_ENCRYPT('" . $oldpass . "','" . DB_AES_KEYSTRING . "')";
	$result = mysqli_query($con, $qry);
	$row = mysqli_fetch_array($result);

	// Verifica se a query foi bem sucedida ou nÃ£o

	if ($result)
		{
		if (mysqli_num_rows($result) == 1)
			{

			// Credenciais OK
			// Grava o registro de alteraÃ§Ã£o de senha BD

			if ($newpass == $oldpass)
				{
				$errmsg = 'A nova senha deve ser diferente da antiga!';
				$_SESSION['ERRMSG'] = $errmsg;
				session_write_close();
				header("location: /php/change-password.php");
				exit();
				}

			$qry = "UPDATE usuarios SET senha = AES_ENCRYPT('" . $newpass . "',
        '" . DB_AES_KEYSTRING . "') WHERE usuario='" . $login . "'";
			mysqli_query($qry) or die($qry . "<br/><br/>" . mysqli_error());
			$qry = "UPDATE usuarios SET flag_primeiro_acesso = 0 WHERE usuario =
        '" . $login . "'";
			mysqli_query($qry) or die($qry . "<br/><br/>" . mysqli_error());
			$errmsg = 'Senha alterada com sucesso!';
			$_SESSION['ERRMSG'] = $errmsg;
			session_write_close();
			header("location: /index.php");
			exit();
			}
		  else
			{

			// Erro no Login

			$errmsg = 'Usuário não localizado. Verifique suas credenciais.';
			$_SESSION['ERRMSG'] = $errmsg;
			session_write_close();
			header("location: /php/change-password.php");
			exit();
			}
		}
	  else
		{
		die("Query failed");
		}
	}
  else
	{
	$errmsg = 'Os campos "Nova Senha" e "Confirmar Nova Senha" devem ser iguais!';
	$_SESSION['ERRMSG'] = $errmsg;
	session_write_close();
	header("location: /php/change-password.php");
	exit();
	}

?>