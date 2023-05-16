<!--======================== (  SISTEMA - MONSAT (2018) - VERSION 1.4   )=============================-->

<!doctype html>
<html lang="pt-BR">
<head>
    
    <!--============================== (    DESENVOLVEDOR DO SISTEMA   )===========================================-->

    <meta name="author" content="Stevan Jackson Pires de Andrade "/>

	<meta charset="utf-8">
	<title>BPTECH - Sistema de Chamados</title>
	<link rel="shortcut icon" type="image/x-icon" href="./images/ICON.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/estilos.css">
    <meta name="robots" content="noindex, nofollow">
</head>
<body>
<div class="linha-top"></div>
<div class="login <?php if(isset($_GET['login_errado'])){ echo 'errologin'; } else if(isset($_GET['logout'])){ echo 'logout'; }?>">
<div class="login-img">
    <img src="images/logo.png" width="310" height="100" alt="" />
</div>
<form method="post" action="inc/validacao.php" >
    <div class="field-login">
        <label for="login">Usuário</label>
        <input class="input-login" type="text" name="usuario" />
    </div>
    <div class="field-login">
        <label for="senha">Senha</label>
        <input class="input-login" type="password" name="senha" />
    </div>
    <input type="submit" value="entrar" class="submit submit-login"/>
</form>

<?php if(isset($_GET['erro'])){?><div class="adaviso"><p id="msg_erro_login">Login e/ou senha inválidos.</p></div><?php }?>
<?php if(isset($_GET['logout'])){?><div class="adaviso adaviso2"><p>Você fez logout agora.</p></div><?php }?>
<?php if(isset($_GET['horario'])){?><div class="adaviso"><p>Você não tem permissão para acessar o sistema agora.</p></div><?php }?>
</div>

</body>
</html>
