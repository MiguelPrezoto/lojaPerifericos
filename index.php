<!DOCTYPE html>
<html>
<head>
    <title>Login - Loja Periféricos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-wrapper">
    <div class="login-box">
        <div class="login-header">
            <h1>Loja Periféricos</h1>
            <p>acesso ao sistema</p>
        </div>
        <div class="login-body">
            <form action="entrada.php" method="post" enctype="multipart/form-data">
                <label for="login">Login</label>
                <input type="text" name="login" id="login">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha">
                <input type="submit" name="Cadastrar" value="Entrar →">
            </form>
            <p style="margin-top:16px; font-size:11px; text-align:center;">
                <a href="cadastro_usuario.php" style="color:#888; text-transform:uppercase; letter-spacing:1px;">Não tem conta? Cadastre-se</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
