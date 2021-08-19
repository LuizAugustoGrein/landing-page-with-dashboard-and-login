<?php 
    include('config.php');
    Site::updateUsuarioOnline();
    Site::contador();
    $infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
    $infoSite->execute();
    $infoSite = $infoSite->fetch();

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $infoSite['titulo']; ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="<?php echo INCLUDE_PATH;?>estilo/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descrição do meu Website">
    <meta name="keyword" content="palavras-chaves,do,meu,site">
    <link rel="icon" href="<?php echo INCLUDE_PATH ?>favicon.ico">
    <meta charset="utf-8">
</head>
<body>

    <base base="<?php echo INCLUDE_PATH; ?>">

    <?php
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        switch($url){
            case 'depoimentos':
                echo '<target target="depoimentos">';
                break;
            case 'servicos':
                echo '<target target="servicos">';
                break;
        }
    ?>

    <div class="sucesso">Formulário enviado com sucesso!</div>
    <div class="erro">Algo deu errado, tente novamente mais tarde.</div>
    <div class="overlay-loading">
        <img src="<?php echo INCLUDE_PATH ?>images/ajax-loader.gif" alt="">
    </div>
    <header>
        <div class="center">
            <div class="logo left"><a href="<?php echo INCLUDE_PATH;?>">Logomarca</a></div>
            <nav class="desktop right">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>noticias">Notícias</a></li>
                    <li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
                </ul>
            </nav>
            <nav class="mobile right">
                <div class="botao-menu-mobile">
                    <i class="fas fa-bars"></i>
                </div>
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>noticias">Notícias</a></li>
                    <li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
    </header>

    <div class="container-principal">
    <?php
        if(file_exists('pages/'.$url.'.php')){
            include('pages/'.$url.'.php');
        }else{
            if($url != 'depoimentos' && $url != 'servicos'){
                $urlPar = explode('/',$url)[0];
                if($urlPar != 'noticias'){
                    $pagina404 = true;
                    include('pages/404.php');
                }else{
                    include('pages/noticias.php');
                }
            }else{
                include('pages/home.php');
            }
        }
    ?>
    </div>

    <footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'?>>
        <div class="center">
            <p>Todos os direitos reservados</p>
        </div>
    </footer>
    <script src="<?php echo INCLUDE_PATH;?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH;?>js/constants.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyD04DooRsYis99PjZndLIUnHmbkVPv-7-s"></script>
    <script src="<?php echo INCLUDE_PATH;?>js/map.js"></script>
    <script src="<?php echo INCLUDE_PATH;?>js/script.js"></script>

    <?php 
        if(is_array($url) && strstr($url[0],'noticias') !== false){
    ?>
        <script>
            $(function(){
                $('select').change(function(){
                    location.href = include_path + "noticias/" + $(this).val();
                })
            })
        </script>
    <?php } ?>
    <?php 
        if($url == 'home' || $url == 'depoimentos' || $url='servicos'){ 
    ?>
        <script src="<?php echo INCLUDE_PATH;?>js/slider.js"></script>
    <?php }?>
	<!--<script src="<?php echo INCLUDE_PATH; ?>js/exemplo.js"></script>-->
    <script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
</body>
</html>