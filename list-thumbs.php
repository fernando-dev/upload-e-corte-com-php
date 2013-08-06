<?php 
if(isset($_SESSION['fotos']) && !empty($_SESSION['fotos'])) {
    $session_fotos = $_SESSION['fotos'];

    echo "<hr>";
    echo "<ul class='thumbnails'>";
    if(isset($session_fotos['thumb']) && !empty($session_fotos['thumb']) && count($session_fotos['thumb']) > 0) {
        foreach ($session_fotos['thumb'] as $id => $thumb) {
            echo '<li class="span2">';
            echo '<a href="#image'.$id.'" class="thumbnail" data-toggle="modal"><img src="'.$thumb.'" alt=""></a>';
            echo '<a id="remove" class="btn btn-mini btn-success"><i class="icon-remove icon-white"></i></a>';
            echo '</li>';
        }
    }

    if(!empty($session_fotos['big']) && isset($session_fotos['big']) && count($session_fotos['big']) > 0) {
        foreach ($session_fotos['big'] as $id => $big) {
            echo '<div id="image'.$id.'" class="modal hide fade">';
            echo '<div class="modal-header">';
            echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            echo '<h3>Image Grande</h3>';
            echo '</div>';
            echo '<div class="modal-body"><img src="'.$big.'" alt=""></div>';
            echo '<div class="modal-footer">';
            echo '</div>';
            echo '</div>';
        }
    }
    echo "</ul>";
}