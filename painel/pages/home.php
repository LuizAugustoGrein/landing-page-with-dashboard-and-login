<?php

    $usuariosOnline = Painel::listarUsuariosOnline();

    $visitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
    $visitasTotais->execute();
    $visitasTotais = $visitasTotais->rowCount();

    $visitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
    $visitasHoje->execute(array(date('Y-m-d')));
    $visitasHoje = $visitasHoje->rowCount();

?>
<div class="box-content w100">
    <h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA; ?></h2>
    <div class="box-metricas">
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Usuários Online</h2>
                <p><?php echo count($usuariosOnline); ?></p>
            </div>
        </div>
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Total de Visitas</h2>
                <p><?php echo $visitasTotais; ?></p>
            </div>
        </div>
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Visitas Hoje</h2>
                <p><?php echo $visitasHoje; ?></p>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="box-content w100">
    <h2><i class="fa fa-globe"></i> Visitantes da Página Online</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div>
            <div class="col">
                <span>Última Ação</span>
            </div>
            <div class="clear"></div>
        </div>
        <?php
            foreach($usuariosOnline as $key => $value){ 
        ?>
            <div class="row">
                <div class="col">
                    <span><?php echo $value['ip']; ?></span>
                </div>
                <div class="col">
                    <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])); ?></span>
                </div>
                <div class="clear"></div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="box-content w100">
    <h2><i class="fa fa-user"></i> Usuários do Painel</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>Nome</span>
            </div>
            <div class="col">
                <span>Cargo</span>
            </div>
            <div class="clear"></div>
        </div>
        <?php
            $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
            $usuariosPainel->execute();
            $usuariosPainel = $usuariosPainel->fetchAll();

            foreach($usuariosPainel as $key => $value){ 

        ?>
            <div class="row">
                <div class="col">
                    <span><?php echo $value['user']; ?></span>
                </div>
                <div class="col">
                    <span><?php echo pegaCargo($value['cargo']); ?></span>
                </div>
                <div class="clear"></div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="clear"></div>