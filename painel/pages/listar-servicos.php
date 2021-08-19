<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        Painel::deletar('tb_site.servicos',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.servicos',$_GET['order'],$_GET['id']);
    }
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    
    $servicos = Painel::selectAll('tb_site.servicos',($paginaAtual-1)*$porPagina, $porPagina);
?>
<div class="box-content">
    <h2><i class="far fa-address-card"></i> Serviços Cadastrados</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Serviço</td>
                <td colspan="2" style="text-align: center;">Ações</td>
                <td colspan="2" style="text-align: center;">Ordenação</td>
            </tr>
            <?php
                foreach($servicos as $key => $value){
            ?>
                <tr>
                    <td><?php echo $value['servico']; ?></td>
                    <td style="text-align: center;"><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-servico?id=<?php echo $value['id']; ?>"><i class="fas fa-edit"></i> Editar</a></td>
                    <td style="text-align: center;"><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?excluir=<?php echo $value['id']; ?>"><i class="fas fa-trash-alt"></i> Deletar</a></td>
                    <td style="text-align: center;"><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?order=up&id=<?php echo $value['id']; ?>"><i class="fas fa-arrow-up"></i></a></td>
                    <td style="text-align: center;"><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos?order=down&id=<?php echo $value['id']; ?>"><i class="fas fa-arrow-down"></i></a></td>
                </tr>
            <?php } ?>
        </table>
    </div>       
    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.servicos')) / $porPagina);
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
                else
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
            }
        ?>
    </div>

</div>