<?php

// Inicia a sessão
session_start();

// Inclui detalhes da conexÃ£o com o BD e SSH Server
include('config.php');

// Flag de Validação de Erro
$errflag = false;

// Conexão ao Servidor MySQL
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

// Verifica se a conexão foi bem sucedida
if (!$con)
{
    die('Erro ao conectar ao servidor: ' . mysqli_error($con));
}

// Higieniza as entradas do usuário para evitar SQL Injection
$login       = mysqli_real_escape_string($con, $_POST['login']);
$oldpass     = mysqli_real_escape_string($con, $_POST['oldpass']);
$newpass     = mysqli_real_escape_string($con, $_POST['newpass']);
$newpassconf = mysqli_real_escape_string($con, $_POST['newpassconf']);

// Verifica se há entradas vazias
if ($login == '' || $oldpass == '' || $newpass == '' || $newpassconf == '')
{
    $errmsg  = 'Todos os campos devem ser preenchidos!';
    $errflag = true;
}

// Se a flag de erro for verdadeira, redireciona para a página de alteração de senha
if ($errflag)
{
    $_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: /php/change-password.php");
    exit();
}

// Verifica se os campos "Nova Senha" e "Confirmar Nova Senha" são iguais
if ($newpass == $newpassconf)
{
    // Query de autenticação do usuário   
    $qry    = "SELECT * FROM usuarios WHERE usuario='" . $login . "' AND senha = AES_ENCRYPT('" . $oldpass . "','" . DB_AES_KEYSTRING . "')";
    $result = mysqli_query($con, $qry);
    $row    = mysqli_fetch_array($result);
    
    // Verifica se a query foi bem sucedida    
    if ($result)
    {
		// Verifica se query encontrou apenas um resultado (usuário)
        if (mysqli_num_rows($result) == 1)
        {
            // Verifica se a nova senha é igual a antiga (deve ser DIFERENTE, obrigatoriamente)
            if ($newpass == $oldpass)
            {
                $errmsg             = 'A nova senha deve ser diferente da antiga!';
                $_SESSION['ERRMSG'] = $errmsg;
                session_write_close();
                header("location: /php/change-password.php");
                exit();
            }
			// Caso diferente, procede com a atualização da senha no BD
            else 
			{
			// Faz query de UPDATE para atualização da senha
            $qry = "UPDATE usuarios SET senha = AES_ENCRYPT('" . $newpass . "',
			'" . DB_AES_KEYSTRING . "') WHERE usuario='" . $login . "'";
			
            mysqli_query($qry) or die($qry . "<br/><br/>" . mysqli_error());
			
			// Faz query de UPDATE para alteração da flag de primeiro acesso para 0
            $qry = "UPDATE usuarios SET flag_primeiro_acesso = 0 WHERE usuario =
			'" . $login . "'";
			
            mysqli_query($qry) or die($qry . "<br/><br/>" . mysqli_error());
			
			//Salva mensagem de alteração de senha, encerra a escrita de sessão e redireciona para a tela de login
            $errmsg             = 'Senha alterada com sucesso!';
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
            $errmsg             = 'Usuário não localizado. Verifique suas credenciais.';
            $_SESSION['ERRMSG'] = $errmsg;
            session_write_close();
            header("location: /php/change-password.php");
            exit();
        }
    }
	// Caso a execução da query falhe, para o programa e retorna erro
    else
    {
        die("Query failed");
    }
}
// Se os campos "Nova Senha" e "Confirmar Nova Senha" forem diferentes, retorna erro à tela de alteração de senha
else
{
    $errmsg             = 'Os campos "Nova Senha" e "Confirmar Nova Senha" devem ser iguais!';
    $_SESSION['ERRMSG'] = $errmsg;
    session_write_close();
    header("location: /php/change-password.php");
    exit();
}

?> 