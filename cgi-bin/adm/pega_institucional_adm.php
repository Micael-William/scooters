<?php
$id=$rs['id'];
$id_ref=$id;
$data=$rs['data'];
$ordem=$rs['ordem'];
$topico=$rs['topico'];
$sub_top=$rs['sub_top'];
$n_amigavel=$rs['n_amigavel'];
$ni=$rs['ni'];
$np=$rs['np'];
$chamada=$rs['chamada'];
$texto=$rs['texto'];
$periodo_de=$rs['periodo_de'];
$periodo_ate=$rs['periodo_ate'];
$link=$rs['link'];
$target=$rs['target'];
$tags=$rs['tags'];
$usuario=$rs['usuario'];
$video=$rs['video'];
$visualizacoes=$rs['visualizacoes'];
$alterado=$rs['alterado'];
$title=$rs['title'];
$keywords=$rs['keywords'];
$description=$rs['description'];
$status=$rs['status'];

$topico=str_replace("´","'",$topico);
if ($chamada<>""){$chamada=str_replace("´","'",$chamada);}
if ($texto<>""){$texto=str_replace("´","'",$texto);}
if ($tags<>""){$tags=str_replace("´","'",$tags);}
if ($link<>""){$link=str_replace("´","'",$link);}
if ($title<>""){$title=str_replace("´","'",$title);}
if ($keywords<>""){$keywords=str_replace("´","'",$keywords);}
if ($description<>""){$description=str_replace("´","'",$description);}
?>