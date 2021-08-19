<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        $selectImagem = MySql::conectar()->prepare("SELECT slide FROM `tb_site.slides` WHERE id = ?");
        $selectImagem->execute(array($_GET['excluir']));
        $imagem = $selectImagem->fetch()['slide'];
        Painel::deleteFile($imagem);
        Painel::deletar('tb_site.slides',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-slides');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.slides',$_GET['order'],$_GET['id']);
    }
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;

    $slides = Painel::selectAll('tb_site.slides',($paginaAtual-1)*$porPagina, $porPagina);
?>
<div class="box-content">
    <h2><i class="far fa-address-card"></i> Slides Cadastrados</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td style="text-align: center;">Imagem</td>
                <td colspan="2" style="text-align: center;">Ações</td>
                <td colspan="2" style="text-align: center;">Ordenação</td>
            </tr>
            <?php
                foreach($slides as $key => $value){
            ?>
                <tr>
                    <td><?php echo $value['nome']; ?></td>
                    <td style="text-align: center;"><img style="height: 70px; width: auto;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['slide']; ?>"></td>
                    <td style="text-align: center;"><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-slide?id=<?php echo $value['id']; ?>"><i class="fas fa-edit"></i> Editar</a></td>
                    <td style="text-align: center;"><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?excluir=<?php echo $value['id']; ?>"><i class="fas fa-trash-alt"></i> Deletar</a></td>
                    <td style="text-align: center;"><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?order=up&id=<?php echo $value['id']; ?>"><i class="fas fa-arrow-up"></i></a></td>
                    <td style="text-align: center;"><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides?order=down&id=<?php echo $value['id']; ?>"><i class="fas fa-arrow-down"></i></a></td>
                </tr>
            <?php } ?>
        </table>
    </div>        

    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.slides')) / $porPagina);
            
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
                else
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
            }

        ?>
    </div>

</div>