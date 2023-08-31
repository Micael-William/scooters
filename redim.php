<?php
//https://pt.stackoverflow.com/questions/9754/redimensionar-imagem-com-php-mantendo-propor%C3%A7%C3%A3o
$imagem = $_GET['img'];
$l = $_GET['larg'];
$a = $_GET['alt'];
$c = $_GET['crop'];
$t = $_GET['tp'];

include 'lib/ImageResize.php';

$image = new \Gumlet\ImageResize('imagens/'.$imagem);

if($c<>"" and $l<>"" and $a<>""){//crop
	$image->crop($l, $a);
}else{

    if($l=="" and $a<>""){
        $image->resizeToHeight($a);
    }
    if($l<>"" and $a==""){
        $image->resizeToWidth($l);
    }
    if($l<>"" and $a<>""){
        /*
        $image->resizeToLongSide(500);
        $image->resizeToShortSide(300);
        $image->resizeToBestFit(500, 300);
        $image->resize(500, 300, $allow_enlarge = True);
        */
        $image->resize($l, $a);
    }


}
//$image->save('google-analytics-2.jpg');
$image->output();
?>