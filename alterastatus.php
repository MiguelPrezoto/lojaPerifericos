<!DOCTYPE html>
<html>
<head>
    <title>Alterar Status</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h2>Alterar Status do Produto</h2>

<form name="status" action="" method="POST">
    <p><b>Status:</b><br>
    <select name="fstatus">
        <option value="liberado">Liberado</option>
        <option value="bloqueado">Bloqueado</option>
        <option value="verificar">Verificar</option>
        <option value="banido">Banido</option>
    </select></p>
    <input type="submit" name="bstatus" value="Alterar">
</form>

<a href="cadastro.php">← Voltar</a>
</div>
</body>
</html>

<?php
if(isset($_POST["bstatus"])) {
    if(isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))){
        $id = base64_decode($_GET['id']);
    } else {
        header('Location: cadastro.php');
    }
    require_once('conexao/conexao.php');
    $mysql = new BancodeDados();
    $mysql->conecta();
    $pstatus = $_POST['fstatus'];
    $sqlstring = "update tbproduto set status='$pstatus' where id=$id";
    $query = @mysqli_query($mysql->con, $sqlstring);
    if($query){
        echo "<script>alert('Status alterado com sucesso!');window.location.href='cadastro.php'</script>";
    } else {
        echo "<script>alert('Não foi possível alterar o status.');window.location.href='cadastro.php'</script>";
    }
    $mysql->fechar();
}
?>
