<div class="box-content">
    <h2><i class="fa fa-pen"></i> Cadastrar Slide</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];
                if($nome == ''){
                    Painel::alert('erro','Campos vazios não são permitidos.');
                }else{
                    if(Painel::imagemValida($imagem) == false){
                        Painel::alert('erro','O tamanho ou formato especificado não está correto<br>(max: 1000px / formatos: jpeg, jpg, png)');
                    }else{
                        include('../classes/lib/WideImage.php');
                        $imagem = Painel::uploadFile($imagem);
                        //WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
                        //WideImage::load('pic.jpg')->crop('center', 'center', 90, 50)->output('png');
                        $arr = ['nome'=>$nome,'slide'=>$imagem,'order_id'=>'0','nome_tabela'=>'tb_site.slides'];
                        Painel::insert($arr);
                        Painel::alert('sucesso','Slide cadastrado com sucesso!');
                    }
                }
            }
        ?>
        <div class="form-group">
            <label>Nome do slide</label>
            <input type="text" name="nome">
        </div>
        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem">
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</div>