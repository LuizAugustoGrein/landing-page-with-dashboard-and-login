<?php

    include('../config.php');

    $data = [];

    $assunto = 'Nova mensagem no site!';
    $corpo = '';
    foreach($_POST as $key => $value){
        $corpo.=ucfirst($key).": ".$value;
        $corpo.="<hr>";
    }
    $info = array('assunto'=>$assunto,'corpo'=>$corpo);
    $mail = new Email('greinsystems.com.br','testes@greinsystems.com.br','Luiz!45612379382','Luiz Augusto Grein');
    $mail->addAdress('contato@greinsystems.com.br','Contato - Grein Systems');
    $mail->formatarEmail($info);
    if($mail->enviarEmail()){
        $data['sucesso'] = true;
    }else{
        $data['erro'] = true;
    }

    die(json_encode($data));

?>