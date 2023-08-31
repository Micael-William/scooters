<?php

//merge
//https://www.youtube.com/watch?v=X-AyxG4OTEU

$imagem='foto_qualquer.jpg';
$logo='logo.png';

list($largura,$altura) = getimagesize($logo);

$imagem1 = imagecreatefromstring(file_get_contents($imagem));
$imagem2 = imagecreatefromstring(file_get_contents($logo));

imagecopymerge($imagem1,$imagem2, 104,160,0,0,$largura,$altura,100);//faz o merge

imagejpeg($imagem1,'foto_merge.jpg');

/*
//converte pra webp
// Image
$dir = 'img/countries/';
$name = 'brazil.png';
$newName = 'brazil.webp';

// Create and save
$img = imagecreatefrompng($dir . $name);
imagepalettetotruecolor($img);
imagealphablending($img, true);
imagesavealpha($img, true);
imagewebp($img, $dir . $newName, 100);
imagedestroy($img);
*/