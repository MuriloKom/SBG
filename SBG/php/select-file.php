<?php 
require('authentication_confirmation.php');
session_regenerate_id();
?> 

<!DOCTYPE HTML>
<HTML>
   <HEAD>
      <TITLE>Selecionar</TITLE>
      <LINK HREF="http://fonts.googleapis.com/css?family=Droid+Sans"
         REL="stylesheet" TYPE="text/css">
      <LINK HREF="/css/loginform.css" MEDIA="all" REL="stylesheet"
         TYPE="text/css" />
      <META CONTENT="text/html; charset=utf-8" HTTP-EQUIV="Content-Type" />
   </HEAD>
   <BODY ONLOAD="setFocus()">
      <!--Caixa de Login-->
      <DIV CLASS="item-select-warning">
         <BR> 
         <DIV CLASS="inset">
            <DIV CLASS="login-head">
               <H1>Seleção de Gravações</H1>
               <DIV CLASS="alert-close"> 
               </DIV>
            </DIV>
            <FORM ACTION="download-file.php" ID="changePasswordForm" METHOD="post"
               NAME="changePasswordForm">
               <P CLASS="input-id" ALIGN="left">Selecione as gravações que deseja:</P>
			   <DIV CLASS="item-select">
				<OL>
				<?PHP
				 session_regenerate_id();
				 $i = 0;
				 while(!empty($_SESSION['file'][$i])) 
				 {
				 echo '<LI><INPUT TYPE="checkbox" NAME="filecheck[]" VALUE="'.$_SESSION['file'][$i].'"/>'.$_SESSION['file'][$i].'</LI>';
				 $i++;
				 }
				?>
				</OL>
			   </DIV>
			   <DIV CLASS="submit">
               <INPUT ONCLICK="myFunction()" TYPE="submit" VALUE="Enviar por e-mail"> 
               <H4 CLASS="sair"><A HREF="search-input.php">Voltar</A></H4>
               <DIV CLASS="clear"> 
               </DIV>
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