<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
--> 

<!--Verifica se usuário já está logado-->
<?php 
require('authentication_confirmation.php');
session_regenerate_id();
?> 

<!--Define o tipo de documento-->
<!DOCTYPE HTML>
<HTML>
  <HEAD>
	<!--Nome exibido na aba do navegador-->
    <TITLE>SBG - Busca de Gravações</TITLE>
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
          <H1>Busca de Gravações</H1>
          <DIV CLASS="alert-close"> 
          </DIV>
        </DIV>
		<!--Formulário de Busca de Gravações. Ao ser enviado, redireciona para a página "search-file.php"-->	 
        <FORM ACTION="search-file.php" ID="changePasswordForm" METHOD="post"
          NAME="changePasswordForm">
          <P CLASS="input-id" ALIGN="left">Buscar em:</P>
		  <!--Lista suspensa para seleção do servidor-->	 
          <SELECT NAME="targetServer" REQUIRED>
            <OPTION VALUE="hdexterno">HD Externo</OPTION>
            <OPTION VALUE="storage01">Storage 01</OPTION>
            <OPTION VALUE="storage02">Storage 02</OPTION>
          </SELECT>
          <BR>
          <BR>
          <BR>			   
          <P ALIGN="left" CLASS="input-id">ID ou telefone:</P>
          <LI>
			<!--Campo ID ou Telefone-->	 
            <INPUT NAME="targetFile"
              ONFOCUS="this.value='';" TYPE="text"><A CLASS=" icon user"
              HREF="#"></A>
          </LI>
          <DIV CLASS="submit">
            <INPUT ONCLICK="myFunction()" TYPE="submit" VALUE="Pesquisar"> 
            <H4 class="sair"><A HREF="logout.php">Sair</A></H4>
          </DIV>
          <DIV CLASS="clear"> 
          </DIV>
          <BR>
		  <!--Se variável ERRMSG estiver setada, mostra a mensagem de erro armazenada nela-->
          <?PHP
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
    </DIV>
    <!--Efeitos JavaScript-->
    <SCRIPT>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</SCRIPT>
    <SCRIPT SRC="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></SCRIPT>
    <SCRIPT>$(document).ready(function(c) {
      $('.alert-close').on('click', function(c){
      	$('.message').fadeOut('slow', function(c){
        		$('.message').remove();
      	});
      });
      });
        
    </SCRIPT> 
  </BODY>
</HTML>