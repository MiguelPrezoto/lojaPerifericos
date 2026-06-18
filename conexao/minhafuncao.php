<?php
session_start();
if ($_SESSION['log'] != "ativo"){
    echo "<script>alert('Precisa estar logado para acessar o conteúdo');window.location.href='index.php';</script>";
}

function iniciar(){
    echo "<link rel='stylesheet' href='style.css'>";
    echo "<body>";
}

function titulo(){
    $nome  = $_SESSION['nome'];
    $nivel = $_SESSION['nivel'];
    $label = ($nivel == "adm") ? "administrador" : "usuário";
    $imagem = ($nivel == "adm") ? "conexao/icone.jpg" : "conexao/icone2.jpg";

    echo "<div class='header'>";
    echo "  <div class='header-logo'>Loja</div>";
    echo "  <div class='header-center'>";
    echo "    <h1>$nome</h1>";
    echo "    <p>$label</p>";
    echo "  </div>";
    echo "</div>";
    echo "<div class='container'>";
}
?>
