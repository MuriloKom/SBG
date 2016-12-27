<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
--> 

<!--Define o tipo de documento-->
<!DOCTYPE HTML>
<HTML>
  <HEAD>
	<!--Nome exibido na aba do navegador-->
    <TITLE>SBG - Alteração de Senha</TITLE>
	<!--Busca fonte para o texto-->
    <LINK HREF="http://fonts.googleapis.com/css?family=Droid+Sans"
      REL="stylesheet" TYPE="text/css">
	<!--Adiciona o arquivo loginform.css que contém os estilos utilizados-->
    <LINK HREF="/css/loginform.css" MEDIA="all" REL="stylesheet"
      TYPE="text/css" />
	<!--Compatibilidade com caracteres especiais-->	 
    <META CONTENT="text/html; charset=utf-8" HTTP-EQUIV="Content-Type" />
  </HEAD>
  <BODY ONLOAD="setFocus()">
    <!--Caixa de Login-->
    <DIV CLASS="message warning">
      <BR> 
      <DIV CLASS="inset">
        <DIV CLASS="login-head">
          <H1>Alteração de Senha</H1>
          <DIV CLASS="alert-close"> 
          </DIV>
        </DIV>
		<!--Formulário de alteração de senha. Ao ser enviado, redireciona para a página "save-password.php"-->	 
        <FORM ACTION="save-password.php" ID="changePasswordForm" METHOD="post"
          NAME="changePasswordForm">
          <P CLASS="input-id" ALIGN="left">Login</P>
          <LI>
			<!--Campo Login-->	 
            <INPUT NAME="login" ONBLUR="if (this.value=='') {this.value='Login';}"
              ONFOCUS="this.value='';" TYPE="text" VALUE="Login"><P CLASS=" icon user"> </P>
          </LI>
          <DIV CLASS="clear"> 
          </DIV>
          <P ALIGN="left" CLASS="input-id">Senha Atual</P>
          <LI>
			<!--Campo Senha Atual-->	 
            <INPUT NAME="oldpass"
              ONBLUR="if (this.value=='') {this.value='Login';}"
              ONFOCUS="this.value='';" TYPE="password" VALUE="Nova Senha"><P CLASS=" icon user"> </P>
          </LI>
          <DIV CLASS="clear"> 
          </DIV>
          <P ALIGN="left" CLASS="input-id">Nova Senha</P>
          <LI>
			<!--Campo Nova Senha-->	 
            <INPUT NAME="newpass"
              ONBLUR="if (this.value=='') {this.value='Senha';}"
              ONFOCUS="this.value='';" TYPE="password" VALUE="Nova Senha"> 
            <P CLASS="icon lock"> </P> 
          </LI>
          <DIV CLASS="clear"> 
          </DIV>
          <P ALIGN="left" CLASS="input-id">Confirmar Nova
            Senha
          </P>
          <LI>
			<!--Campo Confirmar Nova Senha-->	 
            <INPUT NAME="newpassconf"
              ONBLUR="if (this.value=='') {this.value='Senha';}"
              ONFOCUS="this.value='';" TYPE="password" VALUE="Nova Senha"> 
            <P CLASS="icon lock" > </P> 
          </LI>
          <DIV CLASS="submit">
			<!--Botão "Alterar"-->	 
            <INPUT ONCLICK="myFunction()" TYPE="submit" VALUE="Alterar">
            <H4 class="sair"><A HREF="/index.php">Voltar</A></H4>
            <BR> 
          </DIV>
          <DIV CLASS="clear"> 
          </DIV>
          <BR>
		  <!--Se variável ERRMSG estiver setada, mostra a mensagem de erro armazenada nela-->
          <?PHP
            session_start();
            session_regenerate_id();
            if(isset($_SESSION['ERRMSG'])) {
            echo '<p align="center" CLASS="errmsg">'.$_SESSION['ERRMSG'].'</p>';
            }
            unset($_SESSION['ERRMSG']);
            session_write_close();
            ?>
        </FORM>
      </DIV>
    </DIV>
    </DIV>
    <!---Footer--->
    <DIV CLASS="footer-cp">
      <P>  
        Portinho Advogados - Sistema de Busca de Gravações 
	    <BR>
		Design by W3layouts
      </P>
    </DIV>
  </BODY>
</HTML>