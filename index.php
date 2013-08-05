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
    <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">body { padding-top: 100px; }</style>
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
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- <input type="file" name="foto" /> -->
            <input type="file" name="foto" title="Adicionar arquivo...">
            <input type="hidden" name="acao" value="Enviar" />
            <input type="submit" class="btn btn-primary" name="cadastrar" value="Enviar" />
        </form>

        <hr>

        <footer>
            <p>by <a href="http://github.com/fernando-dev/">fernando-dev</a></p>
        </footer>
    </div>
    <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="http://gregpike.net/demos/bootstrap-file-input/bootstrap.file-input.js"></script>
    <script>
        $(document).ready(function(){
            $('input[type=file]').bootstrapFileInput();
        });
    </script>
</body>
</html>