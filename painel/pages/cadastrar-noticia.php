<div class="box-content">
    <h2><i class="fa fa-pen"></i> Cadastrar Notícia</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $categoria_id = $_POST['categoria_id'];
                $titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $capa = $_FILES['capa'];
                if($titulo == '' || $conteudo == ''){
                    Painel::alert('erro','Campos vazios não são permitidos.');
                }else if($capa['tmp_name'] == ''){
                    Painel::alert('erro','Imagem precisa estar selecionada.');
                }else{
                    if(Painel::imagemValida($capa)){
                        $verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ?");
                        $verifica->execute(array($titulo,$categoria_id));
                        if($verifica->rowCount() == 0){
                            $imagem = Painel::uploadFile($capa);
                            $slug = Painel::generateSlug($titulo);
                            $arr = [
                                'categoria_id' => $categoria_id,
                                'data'=>date('Y-m-d'),
                                'titulo' => $titulo,
                                'conteudo' => $conteudo,
                                'capa' => $imagem,
                                'slug' => $slug,
                                'order_id' => '0',
                                'nome_tabela' => 'tb_site.noticias'
                            ];
                            if(Painel::insert($arr))
                                Painel::redirect(INCLUDE_PATH_PAINEL."cadastrar-noticia?sucesso");
                        }else{
                            Painel::alert('erro','Notícia com este título já existente.');
                        }
                    }else{
                        Painel::alert('erro','Imagem selecionada não é válida.');
                    }
                }
            }
            if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
                Painel::alert('sucesso','Notícia cadastrada com sucesso!');
            }
        ?>
        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
                <?php 
                    $categorias = Painel::selectAll('tb_site.categorias');
                    foreach($categorias as $key => $value){
                ?>    
                    <option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?php recoverPost('titulo'); ?>">
        </div>
        <div class="form-group">
            <label>Conteúdo:</label>
            <textarea class="tinymce" name="conteudo"><?php recoverPost('conteudo'); ?></textarea>
        </div>
        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="capa">
        </div>
        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_site.noticias">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</div>