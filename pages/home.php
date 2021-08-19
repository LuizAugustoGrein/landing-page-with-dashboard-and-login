<section class="banner-container">
    <div class="banner-single" style="background-image: url('<?php echo INCLUDE_PATH; ?>images/bg-form.jpg');"></div>
    <div class="banner-single" style="background-image: url('<?php echo INCLUDE_PATH; ?>images/bg-form2.jpg');"></div>
    <div class="banner-single" style="background-image: url('<?php echo INCLUDE_PATH; ?>images/bg-form3.jpg');"></div>
    <div class="overlay"></div>
    <div class="center">
    
        <form class="ajax-form" method="post">
            <h2>Qual o seu melhor e-mail?</h2>
            <input type="email" name="email" required>
            <input type="hidden" name="identificador" value="form_home">
            <input type="submit" name="acao" value="Cadastrar!">
        </form>
    </div>
    <div class="bullets"></div>
</section>

<section class="descricao-autor">
    <div class="center">
        <div class="w100 left">
            <h2 class="text-center"><img src="<?php echo INCLUDE_PATH;?>images/foto.jpg"><?php echo $infoSite['nome_autor']; ?></h2>
            <p><?php echo $infoSite['descricao']; ?></p>
        </div>
        <div class="clear"></div>
    </div>
</section>

<section class="especialidades">
    <div class="center">
        <h2 class="title">Minhas Especialidades</h2>
        <div class="w33 left box-especialidade">
            <h3><i class="<?php echo $infoSite['icone1']; ?>"></i></h3>
            <h4><?php echo $infoSite['titulo1']; ?></h4>
            <p><?php echo $infoSite['descricao1']; ?></p>
        </div>
        <div class="w33 left box-especialidade">
            <h3><i class="<?php echo $infoSite['icone2']; ?>"></i></h3>
            <h4><?php echo $infoSite['titulo2']; ?></h4>
            <p><?php echo $infoSite['descricao2']; ?></p>
        </div>
        <div class="w33 left box-especialidade">
            <h3><i class="<?php echo $infoSite['icone3']; ?>"></i></h3>
            <h4><?php echo $infoSite['titulo3']; ?></h4>
            <p><?php echo $infoSite['descricao3']; ?></p>
        </div>
        <div class="clear"></div>
    </div>
</section>

<section class="extras">
    <div class="center">
        <div id="depoimentos" class="w50 left depoimentos-container">
            <h2 class="title">Depoimentos dos nossos clientes</h2>
            <?php 
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.depoimentos` ORDER BY order_id ASC LIMIT 3");
                $sql->execute();
                $depoimentos = $sql->fetchAll();
                foreach($depoimentos as $key => $value){
            ?>
                <div class="depoimento-single">
                    <p class="depoimento-descricao"><?php echo $value['depoimento']; ?></p>
                    <p class="nome-autor"><?php echo ($value['nome']." - ".$value['data']); ?></p>
                </div>
            <?php } ?>
        </div>
        <div id="servicos" class="w50 left servicos-container">
            <h2 class="title">Serviços</h2>
            <div class="servicos">
                <ul>
                    <?php
                        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.servicos` ORDER BY order_id ASC LIMIT 3");
                        $sql->execute();
                        $servicos = $sql->fetchAll();
                        foreach($servicos as $key => $value){
                    ?>
                        <li><?php echo $value['servico']; ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</section>