<!DOCTYPE html>
<html>
<head>
    <title>Produtos - Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<?php
require_once('conexao/minhafuncao.php');
iniciar();
titulo();
if ($_SESSION['log'] != "ativo"){
    echo "<script>alert('Precisa estar logado.');window.location.href='index.php';</script>";
}
?>

<h2>Lista de Produtos</h2>

<div class="nav-buttons">
    <form action="cadastro.php" method="POST">
        <input type="submit" value="Cadastrar Novo Produto">
    </form>
</div>

<form action="" method="POST">
    <p><b>Buscar por tipo:</b><br>
    <input type="text" name="textobusca" style="max-width:200px">
    <input type="submit" name="buscar" value="Buscar" style="margin-top:0; display:inline-block; width:auto">
    </p>
</form>

<?php
require_once('conexao/conexao.php');
$mysql = new BancodeDados();
$mysql->conecta();

if(isset($_POST['buscar']) && !empty($_POST['textobusca'])){
    $pbusca = $_POST['textobusca'];
    $sqlstring = "select * from tbproduto where tipo='$pbusca'";
} else {
    $sqlstring = 'select * from tbproduto order by nome';
}
$query = @mysqli_query($mysql->con, $sqlstring);

echo "<table>";
echo "<tr>
    <th>Imagem</th>
    <th>Nome</th>
    <th>Tipo</th>
    <th>Descrição</th>
    <th>Preço</th>
    <th>Estoque</th>
    <th>Status</th>
    <th>Upload</th>
    <th>Deletar</th>
    <th>Alterar Tipo</th>
    <th>Alterar Status</th>
</tr>";

while($dados = mysqli_fetch_array($query)){
    $id     = base64_encode($dados['id']);
    $idRaw  = $dados['id'];
    $imagem = $dados['imagem'];

    if($imagem && file_exists('imagens/' . $imagem)){
        $imgHtml = "<img src='imagens/$imagem' width='50' height='50' style='object-fit:cover;'>";
    } else {
        $imgHtml = "<span style='font-size:10px;color:#555;text-transform:uppercase;letter-spacing:1px;'>sem foto</span>";
    }

    echo "<tr>";
    echo "<td>$imgHtml</td>";
    echo "<td><b>".$dados['nome']."</b></td>";
    echo "<td>".$dados['tipo']."</td>";
    echo "<td>".$dados['descricao']."</td>";
    echo "<td>R$ ".number_format($dados['preco'], 2, ',', '.')."</td>";
    echo "<td>".$dados['estoque']."</td>";
    echo "<td>".$dados['status']."</td>";
    echo "<td><a href='Uploadphp.php?id=$idRaw'><img src='alterar.jpg' width='28px' height='28px' title='Upload de imagem'></a></td>";
    echo "<td><a href='apagar.php?id=$idRaw'><img src='deleta.png' width='28px' height='28px'></a></td>";
    echo "<td><a href='alteratipo.php?id=$id'><img src='alterar.jpg' width='28px' height='28px'></a></td>";
    echo "<td><a href='alterastatus.php?id=$id'><img src='alterar.jpg' width='28px' height='28px'></a></td>";
    echo "</tr>";
}
echo "</table>";
$mysql->fechar();
?>

<br><a href="cadastro.php">← Voltar ao cadastro</a>

</div></body></html>
