<div class="box-content">
    <h2><i class="fa fa-pen"></i> Cadastrar Depoimento</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                if(Painel::insert($_POST)){
                    Painel::alert('sucesso','Depoimento cadastrado com sucesso!');
                }else{
                    Painel::alert('erro','Campos vazios não são permitidos.');
                }
            }
        ?>
        <div class="form-group">
            <label>Nome da pessoa:</label>
            <input type="text" name="nome">
        </div>
        <div class="form-group">
            <label>Depoimento:</label>
            <textarea name="depoimento"></textarea>
        </div>
        <div class="form-group">
            <label>Data:</label>
            <input formato="data" type="text" name="data">
        </div>
        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_site.depoimentos">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</div>