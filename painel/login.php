<?php
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
        $sql->execute(array($user,$password));
        if($sql->rowCount() == 1){
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['img'] = $info['img'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['cargo'] = $info['cargo'];
            header('Location: '.INCLUDE_PATH_PAINEL);
            die();
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel de controle</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo INCLUDE_PATH_PAINEL;?>css/style.css" rel="stylesheet">
</head>
<body>
    <div class="box-login">
        <?php
            if(isset($_POST['acao'])){
                $user = $_POST['user'];
                $password = $_POST['password'];
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
                $sql->execute(array($user,$password));
                if($sql->rowCount() == 1){
                    //Logamos com sucesso!
                    $info = $sql->fetch();
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    $_SESSION['img'] = $info['img'];
                    $_SESSION['nome'] = $info['nome'];
                    $_SESSION['cargo'] = $info['cargo'];
                    if(isset($_POST['lembrar'])){
                        setcookie('lembrar',true,time()+(60*60*24),'/');
                        setcookie('user',$user,time()+(60*60*24),'/');
                        setcookie('password',$password,time()+(60*60*24),'/');
                    }
                    header('Location: '.INCLUDE_PATH_PAINEL);
                    die();
                }else{
                    echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
                }
            }
        ?>
        <h2>Efetue o login:</h2>
        <form method="post">
            <input type="text" name="user" placeholder="Usuário..." required>
            <input type="password" name="password" placeholder="Senha..." required>
            <div class="form-group-login left">
                <input type="submit" name="acao" value="Logar!">
            </div>
            <div class="form-group-login right">
                <label>Lembrar-me</label>
                <input type="checkbox" name="lembrar">
            </div>
            <div class="clear"></div>
        </form>
    </div>
</body>
</html>