<!--
Author:W3layouts
Author URL:http://w3layouts.com
License:Creative Commons Attribution 3.0 Unported
License URL:http://creativecommons.org/licenses/by/3.0/
--> 

<!--Verifica se o usuário já está logado para evitar duplicação de login-->
<?php 
require('php/already-auth.php'); 
session_regenerate_id();
?> 

<!--Define o tipo de documento-->
<!DOCTYPE HTML>
<HTML>
   <HEAD>
      <!--Nome exibido na aba do navegador-->
      <TITLE >Portal</TITLE>
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
         <!--Logo-->
         <IMG ALT="Logo" SRC="/img/logo.png">
         <DIV CLASS="inset">
            <DIV CLASS="login-head">
               <H1></H1>
               <DIV CLASS="alert-close"> 
               </DIV>
            </DIV>
            <!--Formulário de Login-->
			<!--Ao ser enviado, redireciona para a página checklogin.php. No momento do envio, verifica se os termos de uso foram aceitos-->
            <FORM ID="form" METHOD="post" ACTION="/php/checklogin.php"
               ONSUBMIT="if(document.getElementById('agree').checked) { return true; } else { alert('Voce deve ler e aceitar os Termos de Uso para continuar.'); return false; }">
               <LI>
                  <!--Campo Login-->
                  <INPUT CLASS="text" NAME="username"
                     ONBLUR="if (this.value=='') {this.value='Acesso restrito a funcionários autorizados';}"
                     ONFOCUS="this.value='';" TYPE="text" VALUE="Acesso restrito a funcionários autorizados"><A CLASS=" icon user"
                     HREF="#"></A>
               </LI>
               <DIV CLASS="clear"> 
               </DIV>
               <LI>
                  <!--Campo Senha-->
                  <INPUT NAME="password"
                     ONBLUR="if (this.value=='') {this.value='Senha';}"
                     ONFOCUS="this.value='';" TYPE="password" VALUE="Senha"> 
                  <A CLASS="icon lock" HREF="#"></A> 
               </LI>
                  <!--Campo Termos de Uso-->
			   <LI CLASS="checkbox">
				  <INPUT TYPE="checkbox" NAME="checkbox" VALUE="check" ID="agree"/>Eu li e aceito os <A HREF="/pdf/Termos_de_Uso_Portinho.pdf">Termos de Uso</A>.  
               </LI>				  
               <!--Botão Entrar-->
               <DIV CLASS="submit">
               <INPUT ONCLICK="myFunction()" TYPE="submit" VALUE="Entrar"> 
               <H4><A HREF="/php/change-password.php">Alterar minha senha</A></H4>
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
               </DIV>
            </FORM>
         </DIV>
      </DIV>
      </DIV>
      <!---Footer--->
      <DIV CLASS="footer">
         <BR> 
		 <BR>		 
         <P>  
            Portinho Advogados - Sistema de Busca de Gravações 
         </P>
      </DIV>
      <!--Efeitos JavaScript-->
      <SCRIPT>
         var __links = document.querySelectorAll('a');
         function __linkClick(e) {    
			parent.window.postMessage(this.href, '*');
         };
         for (var i = 0, l = __links.length; i < l; i++) {    
			if ( __links[i].getAttribute('data-t') == '_blank' ) {
				__links[i].addEventListener('click', __linkClick, false);    
				}
			}
      </SCRIPT>   
      <SCRIPT SRC="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></SCRIPT>   
      <SCRIPT>$(document).ready(function(c) {
         $('.alert-close').on('click', function(c) {
             $('.message').fadeOut('slow', function(c) {
                 $('.message').remove();
				});
			});
        });
      </SCRIPT> 
   </BODY>
</HTML>