<?php
    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        Painel::deletar('tb_site.categorias',$idExcluir);
        
        $noticias = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE categoria_id = ?");
        $noticias->execute(array($idExcluir));
        $noticias = $noticias->fetchAll();
        foreach($noticias as $key => $value){
            $imgDelete = $value['capa'];
            Painel::deleteFile($imgDelete);

        }
        $noticias = MySql::conectar()->prepare("DELETE FROM `tb_site.noticias` WHERE categoria_id = ?");
        $noticias->execute(array($idExcluir));

        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-categorias');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.categorias',$_GET['order'],$_GET['id']);
    }
    
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    $categorias = Painel::selectAll('tb_site.categorias',($paginaAtual-1)*$porPagina, $porPagina);
?>
<div class="box-content">
    <h2><i class="far fa-address-card"></i> Categorias Cadastradas</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td colspan="2" style="text-align: center;">Ações</td>
                <td colspan="2" style="text-align: center;">Ordenação</td>
            </tr>
            <?php
                foreach($categorias as $key => $value){
            ?>
                <tr>
                    <td><?php echo $value['nome']; ?></td>
                    <td style="text-align: center;"><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-categoria?id=<?php echo $value['id']; ?>"><i class="fas fa-edit"></i> Editar</a></td>
                    <td style="text-align: center;"><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-categorias?excluir=<?php echo $value['id']; ?>"><i class="fas fa-trash-alt"></i> Deletar</a></td>
                    <td style="text-align: center;"><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-categorias?order=up&id=<?php echo $value['id']; ?>"><i class="fas fa-arrow-up"></i></a></td>
                    <td style="text-align: center;"><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-categorias?order=down&id=<?php echo $value['id']; ?>"><i class="fas fa-arrow-down"></i></a></td>
                </tr>
            <?php } ?>
        </table>
    </div>        

    <div class="paginacao">
        <?php 
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.categorias')) / $porPagina);
            
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual)
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
                else
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
            }

        ?>
    </div>