<!DOCTYPE html>
<html>
<head>
    <title>Confirmação de Cadastro</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
session_start();
if ($_SESSION['log'] == "ativo"){
    $pnome     = $_POST['fnome'];
    $ptipo     = $_POST['ftipo'];
    $pdescricao= $_POST['fdescricao'];
    $ppreco    = $_POST['fpreco'];
    $pestoque  = $_POST['festoque'];
    $pidcad    = $_SESSION['id'];

    if (empty($pnome) || empty($ptipo) || empty($pdescricao)){
        echo "<script>alert('Preencha todos os campos e selecione um tipo válido.');window.location.href='cadastro.php'</script>";
    } else {
        require_once('conexao/minhafuncao.php');
        iniciar();
        titulo();
?>

<h2>Confirmação de cadastro</h2>

<div style="border:1.5px solid #2a2a2a; padding:20px; margin-bottom:20px;">
    <p style="margin-bottom:10px; font-size:13px;"><span style="font-size:10px; text-transform:uppercase; letter-spacing:2px; color:#ccc;">Nome</span><br><?php echo $pnome; ?></p>
    <p style="margin-bottom:10px; font-size:13px;"><span style="font-size:10px; text-transform:uppercase; letter-spacing:2px; color:#ccc;">Tipo</span><br><?php echo $ptipo; ?></p>
    <p style="margin-bottom:10px; font-size:13px;"><span style="font-size:10px; text-transform:uppercase; letter-spacing:2px; color:#ccc;">Descrição</span><br><?php echo $pdescricao; ?></p>
    <p style="margin-bottom:10px; font-size:13px;"><span style="font-size:10px; text-transform:uppercase; letter-spacing:2px; color:#ccc;">Preço</span><br>R$ <?php echo $ppreco; ?></p>
    <p style="margin-bottom:10px; font-size:13px;"><span style="font-size:10px; text-transform:uppercase; letter-spacing:2px; color:#ccc;">Estoque</span><br><?php echo $pestoque; ?></p>
    <p style="font-size:13px;"><span style="font-size:10px; text-transform:uppercase; letter-spacing:2px; color:#ccc;">Cadastrado por</span><br><?php echo $_SESSION['nome']; ?></p>
</div>

<?php
        require_once('conexao/conexao.php');
        $mysql = new BancodeDados();
        $mysql->conecta();
        $sqlstring = "insert into tbproduto(nome,tipo,descricao,preco,estoque,id_cadastrou,status)
                      values('$pnome','$ptipo','$pdescricao','$ppreco','$pestoque','$pidcad','verificar')";
        $query = @mysqli_query($mysql->con, $sqlstring);
        if($query){
            echo "<script>alert('Cadastro efetuado com sucesso!')</script>";
        } else {
            echo "<script>alert('Não foi possível cadastrar.');window.location.href='cadastro.php'</script>";
        }
        $mysql->fechar();
?>

<div class="nav-buttons">
    <form action="pesquisa.php" method="POST">
        <input type="submit" name="nova" value="Ver Produtos">
    </form>
    <form action="Uploadphp.php" method="POST">
        <input type="submit" name="imagens" value="Upload de Imagem">
    </form>
    <form action="fechar_sessao.php" method="POST">
        <input type="submit" name="sair" value="Logout">
    </form>
</div>

</div></body></html>
<?php
    }
} else {
    echo "<script>alert('Você não estava logado, faça o login primeiro.');window.location.href='index.php';</script>";
}
?>
