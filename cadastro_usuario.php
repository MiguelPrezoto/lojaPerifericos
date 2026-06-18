<!DOCTYPE html>
<html>
<head>
    <title>Criar Conta - Loja Periféricos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-wrapper">
    <div class="login-box">
        <div class="login-header">
            <h1>Criar Conta</h1>
            <p>preencha os dados abaixo</p>
        </div>
        <div class="login-body">
            <?php
            session_start();
            if(isset($_POST['cadastrar'])){
                $pnome  = trim($_POST['fnome']);
                $plogin = trim($_POST['flogin']);
                $psenha = trim($_POST['fsenha']);
                $pconf  = trim($_POST['fconfsenha']);

                if(empty($pnome) || empty($plogin) || empty($psenha) || empty($pconf)){
                    echo "<p style='color:#e63946; font-size:12px; margin-bottom:14px;'>Preencha todos os campos.</p>";
                } elseif($psenha !== $pconf){
                    echo "<p style='color:#e63946; font-size:12px; margin-bottom:14px;'>As senhas não coincidem.</p>";
                } elseif(strlen($psenha) < 4){
                    echo "<p style='color:#e63946; font-size:12px; margin-bottom:14px;'>A senha deve ter pelo menos 4 caracteres.</p>";
                } else {
                    require_once('conexao/conexao.php');
                    $mysql = new BancodeDados();
                    $mysql->conecta();

                    $check = @mysqli_query($mysql->con, "SELECT id FROM tbusuario WHERE login='$plogin'");
                    if(mysqli_num_rows($check) > 0){
                        echo "<p style='color:#e63946; font-size:12px; margin-bottom:14px;'>Este login já está em uso.</p>";
                    } else {
                        $sql = "INSERT INTO tbusuario (login, senha, nome, nivel) VALUES ('$plogin','$psenha','$pnome','usuario')";
                        $query = @mysqli_query($mysql->con, $sql);
                        if($query){
                            echo "<script>alert('Conta criada com sucesso! Faça o login.');window.location.href='index.php';</script>";
                        } else {
                            echo "<p style='color:#e63946; font-size:12px; margin-bottom:14px;'>Erro ao criar conta. Tente novamente.</p>";
                        }
                    }
                    $mysql->fechar();
                }
            }
            ?>
            <form method="POST" action="">
                <label>Nome completo</label>
                <input type="text" name="fnome">
                <label>Login</label>
                <input type="text" name="flogin">
                <label>Senha</label>
                <input type="password" name="fsenha">
                <label>Confirmar senha</label>
                <input type="password" name="fconfsenha">
                <input type="submit" name="cadastrar" value="Criar Conta →">
            </form>
            <p style="margin-top:16px; font-size:11px; text-align:center;">
                <a href="index.php" style="color:#888; text-transform:uppercase; letter-spacing:1px;">← Voltar ao login</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
