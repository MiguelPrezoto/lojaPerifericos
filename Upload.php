<?php
session_start();
if (!($_SESSION['log'] == "ativo" && $_SESSION['nivel'] == "adm")) {
    echo "<script>alert('Acesso negado.');window.location.href='index.php';</script>";
    exit;
}

$pid = isset($_POST['produto_id']) && is_numeric($_POST['produto_id']) ? intval($_POST['produto_id']) : 0;
if ($pid === 0) {
    echo "<script>alert('Produto inválido.');window.location.href='pesquisa.php';</script>";
    exit;
}

if (isset($_FILES['arquivo']['name']) && $_FILES['arquivo']['error'] == 0) {
    $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
    $nome        = $_FILES['arquivo']['name'];
    $extensao    = strtolower(pathinfo($nome, PATHINFO_EXTENSION));

    if (in_array($extensao, ['jpg', 'jpeg', 'gif', 'png'])) {
        $novoNome = uniqid(time()) . '.' . $extensao;
        $destino  = 'imagens/' . $novoNome;

        if (move_uploaded_file($arquivo_tmp, $destino)) {
            require_once('conexao/conexao.php');
            $mysql = new BancodeDados();
            $mysql->conecta();
            $sqlstring = "UPDATE tbproduto SET imagem='$novoNome' WHERE id=$pid";
            $query = @mysqli_query($mysql->con, $sqlstring);
            $mysql->fechar();

            if ($query) {
                echo "<script>alert('Imagem enviada com sucesso!');window.location.href='pesquisa.php';</script>";
            } else {
                echo "<script>alert('Imagem salva mas não vinculada ao produto.');window.location.href='pesquisa.php';</script>";
            }
        } else {
            echo "<script>alert('Erro ao salvar o arquivo. Verifique as permissões da pasta imagens/.');window.location.href='pesquisa.php';</script>";
        }
    } else {
        echo "<script>alert('Formato inválido. Use jpg, jpeg, gif ou png.');window.history.go(-1);</script>";
    }
} else {
    echo "<script>alert('Nenhum arquivo enviado.');window.history.go(-1);</script>";
}
?>
