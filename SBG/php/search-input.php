<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
--> 

<!--Obriga a checagem se o usuário já está autenticado para evitar fraude-->
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
--> 

<!--Obriga a checagem se o usuÃ¡rio jÃ¡ estÃ¡ autenticado para evitar fraude-->
<?php 
require('authentication_confirmation.php');
session_regenerate_id();
?> 

<!DOCTYPE HTML>
<HTML>
   <HEAD>
      <TITLE>Portal</TITLE>
      <LINK HREF="http://fonts.googleapis.com/css?family=Droid+Sans"
         REL="stylesheet" TYPE="text/css">
      <LINK HREF="/css/loginform.css" MEDIA="all" REL="stylesheet"
         TYPE="text/css" />
      <META CONTENT="text/html; charset=utf-8" HTTP-EQUIV="Content-Type" />
      <META CONTENT="width=device-width, initial-scale=1, maximum-scale=1"
         NAME="viewport">
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
            <FORM ACTION="search-file.php" ID="changePasswordForm" METHOD="post"
               NAME="changePasswordForm">
               <P CLASS="input-id" ALIGN="left">Buscar em:</P>
               <SELECT NAME="targetServer" REQUIRED>
			   <!--<OPTION VALUE="hdexterno">HD Externo</OPTION>-->
			   <!--<OPTION VALUE="storage01">Storage 01</OPTION>-->
			   <OPTION VALUE="storage02">Storage 02</OPTION>
			   <!--<OPTION VALUE="teste">Teste</OPTION>-->
			   </SELECT>
			   <BR>
			   <BR>
			   <BR>			   
               <P ALIGN="left" CLASS="input-id">ID ou telefone:</P>
               <LI>
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
         <P ALIGN="center">
            <BR> Portinho Advogados - Sistema de Busca de Gravações 
         </P>
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