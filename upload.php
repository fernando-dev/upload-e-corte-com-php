<?php
/**
 * Corte de imagem com PHP
 *
 * @author Fernando Moreira <fernando@fernandomoreiraweb.com>
 */
if(isset ($_POST['acao']) && $_POST['acao']=='Enviar') {

    function cortar_thumb($tipo, $dir, $thumb, $largura, $altura, $corte=0) {

        if(!list($w, $h) = getimagesize($tipo)) return "Tipo de imagem n&atilde;o suportado.";
            $img = imagecreatefromjpeg($tipo);

            // resize
            if($corte) {
                if($w < $largura or $h < $altura) return "A foto est&aacute; muito pequena.";
                    $ratio = max($largura/$w, $altura/$h);
                    $h = $altura / $ratio;
                    $x = ($w - $largura / $ratio) / 2;
                    $w = $largura / $ratio;
            }
            else {
                if($w < $largura and $h < $altura) return "A foto est&aacute; muito pequena.";
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

    $file = $_FILES['foto'];
    $dir     = 'uploads/';

    if( !is_dir($dir) ) @mkdir($dir);
    
    $extensao = strtolower(strrchr($file['name'],"."));

    $nome_img = $dir."img_orig$extensao";
    $nome_tmb = "200x200-".md5(uniqid('200x200'))."$extensao";

    move_uploaded_file($file['tmp_name'], $nome_img);
    
    cortar_thumb($nome_img, $dir, $nome_tmb, 200, 200, 1);
}
