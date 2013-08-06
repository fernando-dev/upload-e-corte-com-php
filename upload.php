<?php
/**
 * Corte de imagem com PHP
 *
 * @author Fernando Moreira <fernando@fernandomoreiraweb.com>
 */
session_name("Upload");
session_start();

if(isset($_POST['acao']) && $_POST['acao']=='Enviar') {

    $file = $_FILES['foto'];
    $dir  = 'uploads/';

    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];

    if( !is_dir($dir) ) @mkdir($dir);
    
    $ext = strtolower(strrchr($file_name,"."));

    $nome_img = md5(uniqid($file_name)).$ext;
    $nome_tmb = "200x200-".$nome_img;

    image_crop($file_tmp_name, $dir, $nome_img, 900, 600, false);
    image_crop($file_tmp_name, $dir, $nome_tmb, 200, 200, true);

    files_dir($dir);
}


if(isset($_POST['src']) && !empty($_POST['src'])) {
    
    $src  = $_POST['src'];
    $exp  = explode('/', $_POST['src']);
    $dir  = $exp[0];
    $file = $exp[1];

    if(file_exists($src)) {
        @unlink($src); // Removemos a imagem thumb
        @unlink($dir.'/'.str_replace('200x200-', '', $file)); // removemos a imagem grande
        echo '<div class="alert">Imagem removida com sucesso!</div>'; // retornamos uma mensagem
        files_dir($dir.'/'); // atualizamos a session com os arquivos no diretorio
    }
    else {
        echo '<div class="alert">A imagem não existe!</div>';
    }

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
        $h     = $altura / $ratio;
        $x     = ($w - $largura / $ratio) / 2;
        $w     = $largura / $ratio;
    }
    else {
        if($w < $largura and $h < $altura) {
            die("A foto est&aacute; muito pequena.");
            return false;
        }

        $ratio   = min($largura/$w, $altura/$h);
        $largura = $w * $ratio;
        $altura  = $h * $ratio;
        $x = 0;
    }

    $nova = imagecreatetruecolor($largura, $altura);
    imagecopyresampled($nova, $img, 0, 0, $x, 0, $largura, $altura, $w, $h);
    imagejpeg($nova, "$dir"."$thumb");
        
    return true;
}


function files_dir( $path = null ) {
    $dir = dir($path);
    $_SESSION['fotos'] = array();
    while($file = $dir->read()){

        if ($file!="." && $file!="..") {
            if( str_replace('200x200-', '', $file) == $file ) {
                $_SESSION['fotos']['big'][] = $path.$file;
            }
            if( str_replace('200x200-', '', $file) != $file ) {
                $_SESSION['fotos']['thumb'][] = $path.$file;
            }
        }

    }

    $dir->close();
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