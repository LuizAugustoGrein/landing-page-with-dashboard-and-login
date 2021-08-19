<?php 
    $site = Painel::select('tb_site.config',false);
?>
<div class="box-content">
    <h2><i class="fa fa-pen"></i> Editar Configurações do Site</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                if(Painel::update($_POST,true)){
                    Painel::alert('sucesso','Configuração editada com sucesso!');
                    $site = Painel::select('tb_site.config',false);
                }else{
                    Painel::alert('erro','Campos vazios não são permitidos.');
                }
            }
        ?>
        <div class="form-group">
            <label>Título do site:</label>
            <input type="text" name="titulo" value="<?php echo $site['titulo']; ?>">
        </div>
        <div class="form-group">
            <label>Nome do autor:</label>
            <input type="text" name="nome_autor" value="<?php echo $site['nome_autor']; ?>">
        </div>
        <div class="form-group">
            <label>Descrição do autor:</label>
            <textarea name="descricao"><?php echo $site['descricao']; ?></textarea>
        </div>
        <?php 
            for($i = 1; $i <= 3; $i++){ 
        ?>
            <div class="form-group">
                <label>Ícone de especialidade <?php echo $i ?>:</label>
                <input type="text" name="icone<?php echo $i ?>" value="<?php echo $site['icone'.$i]; ?>">
            </div>
            <div class="form-group">
                <label>Título de especialidade <?php echo $i ?>:</label>
                <input type="text" name="titulo<?php echo $i ?>" value="<?php echo $site['titulo'.$i]; ?>">
            </div>
            <div class="form-group">
                <label>Descrição de especialidade <?php echo $i ?>:</label>
                <input type="text" name="descricao<?php echo $i ?>" value="<?php echo $site['descricao'.$i]; ?>">
            </div>
        <?php } ?>
        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.config">
            <input type="submit" name="acao" value="Editar">
        </div>
    </form>
</div>