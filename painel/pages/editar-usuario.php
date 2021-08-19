<div class="box-content">
    <h2><i class="fa fa-pen"></i> Editar Usuário</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];
                $usuario = new Usuario();
                if($imagem['name'] != ''){
                    //Existe o Upload de imagem
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile($imagem_atual);
                        $imagem = Painel::uploadFile($imagem);
                        if($usuario->atualizarUsuario($nome,$senha,$imagem)){
                            $_SESSION['nome'] = $nome;
                            $_SESSION['password'] = $senha;
                            $_SESSION['img'] = $imagem;
                            Painel::alert('sucesso','Atualizado com sucesso!');
                        }else{
                            Painel::alert('erro','Ocorreu um erro ao atualizar.');
                        }
                    }else{
                        Painel::alert('erro','O formato da imagem ou tamanho não é valido.');
                    }
                }else{
                    $imagem = $imagem_atual;
                    if($usuario->atualizarUsuario($nome,$senha,$imagem)){
                        $_SESSION['nome'] = $nome;
                        $_SESSION['password'] = $senha;
                        $_SESSION['img'] = $imagem;
                        Painel::alert('sucesso','Usuário alterado com sucesso!');
                    }else{
                        Painel::alert('erro','Ocorreu um erro ao atualizar.');
                    }
                }
            }
        ?>
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" required value="<?php echo $_SESSION['password']; ?>">
        </div>
        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img'] ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Alterar">
        </div>
    </form>
</div>