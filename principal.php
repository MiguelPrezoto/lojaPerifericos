<!DOCTYPE html>
<html>
<head>
    <title>Loja Periféricos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<?php
require_once('conexao/minhafuncao.php');
iniciar();
titulo();
?>

<h2>Produtos Disponíveis</h2>

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
    <th>Comprar</th>
</tr>";

while($dados = mysqli_fetch_array($query)){
    if($dados['status'] == "liberado"){
        $id     = base64_encode($dados['id']);
        $imagem = $dados['imagem'];

        if($imagem && file_exists('imagens/' . $imagem)){
            $imgHtml = "<img src='imagens/$imagem' width='60' height='60' style='object-fit:cover;'>";
        } else {
            $imgHtml = "<span style='font-size:10px;color:#555;text-transform:uppercase;letter-spacing:1px;'>sem foto</span>";
        }

        echo "<tr>";
        echo "<td>$imgHtml</td>";
        echo "<td><b>".$dados['nome']."</b></td>";
        echo "<td>".$dados['tipo']."</td>";
        echo "<td>".$dados['descricao']."</td>";
        echo "<td>R$ ".number_format($dados['preco'], 2, ',', '.')."</td>";
        echo "<td><a href='comprar.php?id=$id'><img src='comprar.png' width='28px' height='28px'></a></td>";
        echo "</tr>";
    }
}
echo "</table>";
$mysql->fechar();
?>

<br>
<form action="fechar_sessao.php" method="POST" style="background:none;box-shadow:none;padding:0;border:none;">
    <input type="submit" name="sair" value="Logout">
</form>

</div></body></html>
