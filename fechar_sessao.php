<!-- Professora CÈlia Regina Bueno Figueira
  Etec de Po·
 salvar como fechar_sessao.php -->
<?php
session_start();
	if ($_SESSION['log'] == "ativo"){
        session_destroy();
		session_unset();
		session_start();
		$_SESSION['log']="desativo";

echo"<script language='javascript' type='text/javascript'>
alert('Muito Obrigado pela visita');window.location.href='index.php';</script>";
}
else {
echo"<script language='javascript' type='text/javascript'>
alert('Voc√™ n√£o estava logado, fa√ßa o login primeiro');
window.location.href='index.php';</script>";
}

?>
