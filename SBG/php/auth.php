 <?php
//Inicia a sessão
session_start();
//Verifica se a variável SESS_MEMBER_ID está setada ou não
if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
    header("location: index.php");
    exit();
}
?> 