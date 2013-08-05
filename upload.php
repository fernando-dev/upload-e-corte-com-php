<?php
/**
 * Corte de imagem com PHP
 *
 * @author Fernando Moreira <fernando@fernandomoreiraweb.com>
 */
if(isset ($_POST['acao']) && $_POST['acao']=='Enviar') {

    $file = $_FILES['foto'];
    $dir     = 'uploads/';

    if( !is_dir($dir) ) @mkdir($dir);
    
    $ext = strtolower(strrchr($file['name'],"."));
    $nome_tmb = "200x200-".md5(uniqid('200x200')).$ext;
    image_crop($file['tmp_name'], $dir, $nome_tmb, 200, 200, 1);
}


function image_crop($tipo, $dir, $thumb, $largura, $altura, $corte = false) {

    if(!list($w, $h) = getimagesize($tipo)) {
        die("Tipo de imagem n&atilde;o suportado.");
        return false;
    }

    $img = imagecreatefromjpeg($tipo);

    // resize
    if($corte) {

        if($w < $largura or $h < $altura) {
            die("A foto est&aacute; muito pequena.");
            return false;
        }

        $ratio = max($largura/$w, $altura/$h);
        $h = $altura / $ratio;
        $x = ($w - $largura / $ratio) / 2;
        $w = $largura / $ratio;
    }
    else {
        if($w < $largura and $h < $altura) {
            die("A foto est&aacute; muito pequena.");
            return false;
        }

        $ratio = min($largura/$w, $altura/$h);
        $largura = $w * $ratio;
        $altura = $h * $ratio;
        $x = 0;
    }

    $nova = imagecreatetruecolor($largura, $altura);
    imagecopyresampled($nova, $img, 0, 0, $x, 0, $largura, $altura, $w, $h);
    imagejpeg($nova, "$dir"."$thumb");
        
    return true;
}


/* Debug simples */
function debug($arr = array(), $vdump = false) {

    print("<pre>");
    
    if($vdump) {
        var_dump($arr);
    }
    else {
        print_r ($arr);        
    }

    print("</pre>");

}