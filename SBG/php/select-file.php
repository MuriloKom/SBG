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
    <TITLE>Selecionar</TITLE>
	<!--Link com JQuery-->
    <SCRIPT type="text/javascript">
      document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js' type='text/javascript'>\<\/script>");
    </SCRIPT>
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
    <DIV CLASS="item-select-warning">
      <BR> 
      <DIV CLASS="inset">
        <DIV CLASS="login-head">
          <H1>Seleção de Gravações</H1>
          <DIV CLASS="alert-close"> 
          </DIV>
        </DIV>
		<!--Formulário de seleção de gravações. Ao ser enviado, redireciona para a página "download-file.php"-->
        <FORM ACTION="download-file.php" ID="changePasswordForm" METHOD="post"
          NAME="changePasswordForm">
          <P CLASS="input-id" ALIGN="left">Selecione as gravações que deseja:</P>
		  <!--Seleção de Gravações-->
          <DIV CLASS="item-select">
            <OL>
              <?PHP
                session_regenerate_id();
                $i = 0;
                while(!empty($_SESSION['file'][$i])) 
                {
                echo '<LI><INPUT CLASS="single-checkbox" TYPE="checkbox" NAME="filecheck[]" VALUE="'.$_SESSION['file'][$i].'"/>'.$_SESSION['file'][$i].'</LI>';
                $i++;
                }
                ?>
            </OL>
          </DIV>
          <H4 CLASS="info-text"> Obs: é possível selecionar no máximo 5 gravações por vez.</H4>
          <BR>
          <DIV CLASS="submit">
			<!--Botão Enviar por e-mail-->
            <INPUT ONCLICK="myFunction()" TYPE="submit" VALUE="Enviar por e-mail"> 
            <H4 CLASS="sair"><A HREF="search-input.php">Voltar</A></H4>
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
	<!--Efeitos JQuery-->
    <SCRIPT>
      jQuery(function(){
      var max = 5;
      var checkboxes = $('input[type="checkbox"]');
      
      checkboxes.change(function(){
      var current = checkboxes.filter(':checked').length;
      checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
      });
      });
    </SCRIPT>
  </BODY>
</HTML>