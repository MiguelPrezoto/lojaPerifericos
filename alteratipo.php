<!DOCTYPE html>
<html>
<head>
    <title>Alterar Tipo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Alterar Tipo do Produto</h2>

<form name="tipo" action="" method="POST">
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
    <input type="submit" name="btipo" value="Alterar">
</form>

<a href="cadastro.php">← Voltar</a>
</div>
</body>
</html>

<?php
if(isset($_POST["btipo"])) {
    if(isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))){
        $id = base64_decode($_GET['id']);
    } else {
        header('Location: cadastro.php');
    }
    require_once('conexao/conexao.php');
    $mysql = new BancodeDados();
    $mysql->conecta();
    $ptipo = $_POST['ftipo'];
    if(empty($ptipo)){
        echo "<script>alert('Selecione um tipo válido.');window.history.go(-1)</script>";
    } else {
        $sqlstring = "update tbproduto set tipo='$ptipo' where id=$id";
        $query = @mysqli_query($mysql->con, $sqlstring);
        if($query){
            echo "<script>alert('Tipo alterado com sucesso!');window.location.href='cadastro.php'</script>";
        } else {
            echo "<script>alert('Não foi possível alterar o tipo.');window.location.href='cadastro.php'</script>";
        }
    }
    $mysql->fechar();
}
?>
