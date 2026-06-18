<!DOCTYPE html>
<html>
<head>
    <title>Upload de Imagem</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
session_start();
if (!($_SESSION['log'] == "ativo" && $_SESSION['nivel'] == "adm")) {
    echo "<script>alert('Você não tem acesso permitido.');window.location.href='cadastro.php';</script>";
    exit;
}
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Produto inválido.');window.location.href='pesquisa.php';</script>";
    exit;
}
$pid = intval($_GET['id']);

require_once('conexao/minhafuncao.php');
iniciar();
titulo();
?>

<h2>Upload de imagem do produto</h2>

<div style="border:1.5px solid #2a2a2a; padding:20px; margin-bottom:20px;">
    <p style="font-size:13px; margin-bottom:16px;">
        <span style="font-size:10px; text-transform:uppercase; letter-spacing:2px; color:#ccc;">Produto ID</span><br>
        #<?php echo $pid; ?>
    </p>
    <form method="post" enctype="multipart/form-data" action="Upload.php">
        <input type="hidden" name="produto_id" value="<?php echo $pid; ?>">
        <label>Selecione uma imagem (jpg, jpeg, gif, png)</label>
        <input name="arquivo" type="file" style="color:#f0ede6; margin-bottom:14px;">
        <br>
        <input type="submit" value="Enviar">
    </form>
</div>

<div class="nav-buttons">
    <form action="pesquisa.php" method="POST">
        <input type="submit" value="← Voltar">
    </form>
</div>

</div></body></html>
