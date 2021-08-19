<?php
    if(isset($_GET['loggout'])){
        Painel::loggout();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Painel de controle</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css" rel="stylesheet">
</head>
<body>
    <div class="menu">
        <div class="menu-wraper">
            <div class="box-usuario">
                <?php
                    if($_SESSION['img'] == ''){ 
                ?>
                    <div class="avatar-usuario">
                        <i class="fa fa-user"></i>
                    </div>
                <?php }else{ ?>
                    <div class="imagem-usuario">
                        <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['img']; ?>">
                    </div>
                <?php } ?>

                <div class="nome-usuario">
                    <p><?php echo $_SESSION['nome']; ?></p>
                    <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
                </div>
            </div>
            <div class="itens-menu">
                <h2>Cadastro</h2>
                <a <?php selecionadoMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-depoimento">Cadastrar Depoimento</a>
                <a <?php selecionadoMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-servico">Cadastrar Serviço</a>
                <a <?php selecionadoMenu('cadastrar-slide'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-slide">Cadastrar Slide</a>
                <h2>Gestão</h2>
                <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-depoimentos">Listar Depoimentos</a>
                <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos">Listar Serviços</a>
                <a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides">Listar Slides</a>
                <h2>Administração do Painel</h2>
                <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-usuario">Editar Usuário</a>
                <a <?php selecionadoMenu('adicionar-usuario'); verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>adicionar-usuario">Adicionar Usuário</a>
                <h2>Configuração Geral</h2>
                <a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-site">Editar Site</a>
                <h2>Gestão de Notícias</h2>
                <a <?php selecionadoMenu('cadastrar-categoria'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-categoria">Cadastrar Categoria</a>
                <a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-categorias" href="">Gerenciar Categorias</a>
                <a <?php selecionadoMenu('cadastrar-noticia'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-noticia" href="">Cadastrar Notícia</a>
                <a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-noticias" href="">Gerenciar Notícias</a>
            </div>
        </div>
    </div>
    <header>
        <div class="center">
            <div class="menu-btn">
                <i class="fa fa-bars"></i>
            </div>
            <div class="btn-home">
            </div>
            <div class="loggout">
                <a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a; padding: 15px 15px" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>"><i class="fa fa-home"></i><span> Página Inicial</span></a>
                <div style="padding: 0 20px; display: inline;"></div>
                <a href="<?php echo INCLUDE_PATH_PAINEL; ?>?loggout"><i class="fa fa-sign-out-alt"></i><span> Sair</span></a>
            </div>
            <div class="clear"></div>
        </div>
    </header>
    <div class="content">

    <?php Painel::carregarPagina(); ?>
        
    </div>
    <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/jquery.mask.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL; ?>js/main.js"></script>
    <script src="https://cdn.tiny.cloud/1/z00ltxl8omt9g2tsiitdeanr65426nnhd07cwbp6viktk8ag/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'.tinymce',
            plugins: 'image',
            height: 300
            });
    </script>
</body>
</html>