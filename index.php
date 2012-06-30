<?php

/**
 * Corte de imagem com PHP
 *
 * @author Fernando Moreira <fernando@fernandomoreiraweb.com>
 */
 
if(isset ($_POST['acao']) && $_POST['acao']=='Enviar'){
    function cortar_thumb($tipo, $dir, $thumb, $largura, $altura, $corte=0){
        if(!list($w, $h) = getimagesize($tipo)) return "Tipo de imagem não suportado! 1";
            $img = imagecreatefromjpeg($tipo);

            // resize
            if($corte)
            {
                if($w < $largura or $h < $altura) return "A foto está muito pequena! 1";
                    $ratio = max($largura/$w, $altura/$h);
                    $h = $altura / $ratio;
                    $x = ($w - $largura / $ratio) / 2;
                    $w = $largura / $ratio;
            }
            else
            {
                if($w < $largura and $h < $altura) return "A foto está muito pequena! 2";
                    $ratio = min($largura/$w, $altura/$h);
                    $largura = $w * $ratio;
                    $altura = $h * $ratio;
                    $x = 0;
            }

            $nova = imagecreatetruecolor($largura, $altura);
            imagecopyresampled($nova, $img, 0, 0, $x, 0, $largura, $altura, $w, $h);
            imagejpeg($nova, "$dir$thumb");
            
        return true;
    }

    $picture  = $_FILES['foto'];
    $pasta    = 'thumb/';
    
    $extensao = strtolower(strrchr($picture['name'],"."));

    $nome_img = "thumb/img_orig$extensao";
    $nome_tmb = "200x200-".md5(uniqid('200x200'))."$extensao";

    move_uploaded_file($picture['tmp_name'], $nome_img);
    
    cortar_thumb($nome_img, $pasta, $nome_tmb, 200, 200, 1);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="foto" />
    <input type="hidden" name="acao" value="Enviar" />
    <input type="submit" name="cadastrar" value="Ok" />
</form>