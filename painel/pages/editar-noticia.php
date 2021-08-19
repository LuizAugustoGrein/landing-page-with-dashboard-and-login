<?php

    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
    }else{
        Painel::alert('erro','Você precisa passar o parâmetro ID!');
        die();
    }

?>

<div class="box-content">
    <h2><i class="fa fa-pen"></i> Editar Notícia</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $capa = $_FILES['capa'];
                $capa_atual = $_POST['capa_atual'];
                $verifica = MySql::conectar()->prepare("SELECT id FROM `tb_site.noticias` WHERE titulo = ? and categoria_id = ? and id != ?");
                $verifica->execute(array($titulo,$_POST['categoria_id'],$id));
                if($verifica->rowCount() == 0){
                    if($capa['name'] != ''){
                        if(Painel::imagemValida($capa)){
                            Painel::deleteFile($capa_atual);
                            $capa = Painel::uploadFile($capa);
                            $slug = Painel::generateSlug($titulo);
                            $arr = ['titulo'=>$titulo,'categoria_id'=>$_POST['categoria_id'],'conteudo'=>$conteudo,'capa'=>$capa,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
                            Painel::update($arr);
                            $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
                            Painel::alert('sucesso','Notícia alterada com sucesso junto com a imagem!');
                        }else{
                            Painel::alert('erro','O tamanho ou formato especificado não está correto<br>(max: 1000px / formatos: jpeg, jpg, png)');
                        }
                    }else{
                        $capa = $capa_atual;
                        $slug = Painel::generateSlug($titulo);
                        $arr = [
                            'titulo'=>$titulo,
                            'categoria_id'=>$_POST['categoria_id'],
                            'data'=>date('Y-m-d'),
                            'conteudo'=>$conteudo,
                            'capa'=>$capa,
                            'slug'=>$slug,
                            'id'=>$id,
                            'nome_tabela'=>'tb_site.noticias'];
                        Painel::update($arr);
                        $noticia = Painel::select('tb_site.noticias','id = ?',array($id));
                        Painel::alert('sucesso','Notícia alterada com sucesso!');
                    }
                }else{
                    Painel::alert('erro','Notícia com este título já existente.');
                }
            }
        ?>
        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
                <?php 
                    $categorias = Painel::selectAll('tb_site.categorias');
                    foreach($categorias as $key => $value){
                ?>    
                    <option <?php if($value['id'] == @$noticia['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?php echo $noticia['titulo']; ?>">
        </div>
        <div class="form-group">
            <label>Conteúdo:</label>
            <textarea class="tinymce" name="conteudo"><?php echo $noticia['conteudo']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Capa:</label>
            <input type="file" name="capa">
            <input type="hidden" name="capa_atual" value="<?php echo $noticia['capa']; ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Alterar!">
        </div>
    </form>
</div>