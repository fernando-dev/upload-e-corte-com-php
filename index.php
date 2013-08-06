<?php include('upload.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Upload e corte de imagens com Bootstrap e PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Upload e corte de imagens com Bootstrap e PHP">
<meta name="author" content="Fernando Moreira">

<!-- Le styles -->
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body { 
    background: #f1f1f1;
    font-family: 'Carrois Gothic', sans-serif;
}
a:hover {text-decoration: none}
.main-container {
    margin: 0 auto;
    max-width: 790px;
    padding: 50px 0;
    text-align: center;
}
.main-container h1 {
    margin-bottom: 80px;
}
.main-container h1 a {
    font-size: 0.7em;
    color: #111;
    text-shadow: 0px 3px 3px #fff;
    text-transform: uppercase;
}
.thumbnails > li {
    position: relative;
}
.thumbnails a.btn {
    position: absolute;
    top: 10px;
    right: 10px;
}
.footer {
    padding-top: 40px;
}
</style>
<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/images/apple-touch-icon-114x114.png">
</head>
<body>
    <div class="main-container">
        
        <h1><a href="./">Upload e corte de imagens com Bootstrap e PHP</a></h1>

        <form action="" method="post" enctype="multipart/form-data">
            <!-- <input type="file" name="foto" /> -->
            <input type="file" name="foto" title="Adicionar arquivo...">
            <input type="hidden" name="acao" value="Enviar" />
            <input type="submit" class="btn btn-primary" name="cadastrar" value="Enviar" />
        </form>

        <?php include('list-thumbs.php'); ?>

        <hr>

        <footer class="footer">
            <p>
                <a class="btn btn-success" href="https://github.com/fernando-dev/upload-e-corte-com-php/archive/master.zip" target="_blank">Download</a> | 
                <a class="btn btn-primary" href="https://github.com/fernando-dev/upload-e-corte-com-php" target="_blank">Git</a> | 
                by <a href="http://github.com/fernando-dev/" target="_blank">fernando-dev</a>
            </p>
        </footer>
    </div>
    <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="http://gregpike.net/demos/bootstrap-file-input/bootstrap.file-input.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-transition.js"></script>
    <script src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-modal.js"></script>
    <script>
        $(document).ready(function(){
            $('input[type=file]').bootstrapFileInput();

            $('.thumbnails').on('click', '#remove', function(){
                var _parent = $(this).parent()
                    _img    = _parent.find('img'),
                    _src    = _img.attr('src');

                $.ajax({
                    type : 'post',
                    data : 'src='+_src,
                    url  : 'upload.php',
                    success: function(retorno){
                        $(this).remove();
                        _img.remove();
                        _parent.html(retorno);
                    }
                })
            });
        });
    </script>
</body>
</html>