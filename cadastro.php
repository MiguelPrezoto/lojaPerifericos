<!DOCTYPE html>
<html>
<head>
    <title>Cadastro - Loja Periféricos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require_once('conexao/minhafuncao.php');
iniciar();
titulo();
if ($_SESSION['nivel'] != "adm"){
    echo "<script>alert('Acesso restrito a administradores.');window.location.href='principal.php';</script>";
}
?>

<h2>Cadastro de Produto</h2>

<form name="cadastro" action="mostrar_cadastro.php" method="POST">
    <p><b>Nome:</b><br>
    <input type="text" name="fnome"></p>

    <p><b>Preço:</b><br>
    <input type="text" name="fpreco" placeholder="Ex: 99.90"></p>

    <p><b>Estoque:</b><br>
    <input type="text" name="festoque" placeholder="Ex: 10"></p>

    <p><b>Tipo:</b><br>
    <select name="ftipo">
        <option value="">Selecione um tipo</option>
        <option value="mouse">Mouse</option>
        <option value="teclado">Teclado</option>
        <option value="headset">Headset</option>
        <option value="monitor">Monitor</option>
        <option value="webcam">Webcam</option>
        <option value="mousepad">Mousepad</option>
        <option value="gabinete">Gabinete</option>
        <option value="placa-de-video">Placa de Vídeo</option>
        <option value="processador">Processador</option>
        <option value="memoria-ram">Memória RAM</option>
        <option value="ssd">SSD</option>
        <option value="fonte">Fonte</option>
    </select></p>

    <p><b>Descrição:</b><br>
    <input type="text" name="fdescricao"></p>

    <input type="submit" name="cadastrar" value="Cadastrar">
</form>

<div class="nav-buttons">
    <form action="pesquisa.php" method="POST">
        <input type="submit" name="nova" value="Ver Produtos">
    </form>
    <form action="fechar_sessao.php" method="POST">
        <input type="submit" name="sair" value="Logout">
    </form>
</div>

</div></body></html>
