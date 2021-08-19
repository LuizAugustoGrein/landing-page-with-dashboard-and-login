<?php

    // INICIA SESSÃO
    session_start();

    // DEFINE FUSO HORÁRIO
    date_default_timezone_set('America/Sao_Paulo');
    
    // CARREGA CLASSES DO PHP MAILER
    $autoload = function($class){
        if($class == 'Email'){
            require_once('classes/phpmailer/src/PHPMailer.php');
            require_once('classes/phpmailer/src/SMTP.php');
            require_once('classes/phpmailer/src/Exception.php');
        }
        include('classes/'.$class.'.php');
    };
    spl_autoload_register($autoload);

    // CONSTANTES DE DIRETÓRIO DOS ARQUIVOS
    define('INCLUDE_PATH','http://localhost/projetos/2%20-%20Curso%20Desenvolvimento%20Web/1%20-%20PROJETOS/Projeto_01/');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
    define('BASE_DIR_PAINEL',__DIR__.'/painel');

    // CONSTANTE PARA O PAINEL DE CONTROLE
    define('NOME_EMPRESA','Grein Systems');

    // CONECTAR COM O BANCO DE DADOS
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','projeto_01');

    // FUNCÕES DO PAINEL
    function pegaCargo($indice){
        return Painel::$cargos[$indice];
    }

    function selecionadoMenu($par){
        //<i class="fa fa-angle-double-right"></i>
        $url = explode('/',@$_GET['url'])[0];
        if($url == $par){

            echo 'class="menu-active"';
        }
    }

    function verificaPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
            echo 'style="display:none;"';
        }
    }

    function verificaPermissaoPagina($permissao){
        if($_SESSION['cargo'] >= $permissao){
            return;
        }else{
            include('painel/pages/permissao-negada.php');
            die();
        }
    }

    function recoverPost($post){
        if(isset($_POST[$post])){
            echo $_POST[$post];
        }
    }

?>