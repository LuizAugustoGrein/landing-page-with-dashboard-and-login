<div class="box-content">
    <h2><i class="fa fa-pen"></i> Cadastrar Categoria</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                if($nome == ''){
                    Painel::alert('erro','Campos vazios não são permitidos.');
                }else{
                    $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ?");
                    $verificar->execute(array($_POST['nome']));
                    if($verificar->rowCount() == 0){
                        $slug = Painel::generateSlug($nome);
                        $arr = ['nome'=>$nome,'slug'=>$slug,'order_id'=>'0','nome_tabela'=>'tb_site.categorias'];
                        Painel::insert($arr);
                        Painel::alert('sucesso','Categoria cadastrada com sucesso!');
                    }else{
                        Painel::alert('erro','Categoria já existente.');
                    }
                }
            }
        ?>
        <div class="form-group">
            <label>Nome da categoria:</label>
            <input type="text" name="nome">
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</div>