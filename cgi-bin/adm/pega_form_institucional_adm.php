<?php
$id=$_POST['id'];
$id_ref=$id;
$data=$_POST['data'];
$ordem=$_POST['ordem'];
$topico=$_POST['topico'];
$sub_top=$_POST['sub_top'];
$n_amigavel=$_POST['n_amigavel'];
$ni=$_POST['ni'];
$np=$_POST['np'];
$chamada=$_POST['chamada'];
$texto=$_POST['texto'];
$periodo_de=$_POST['periodo_de'];
$periodo_ate=$_POST['periodo_ate'];
$link=$_POST['link'];
$target=$_POST['target'];
$tags=$_POST['tags'];
$usuario=$_POST['usuario'];
$video=$_POST['video'];
$visualizacoes=$_POST['visualizacoes'];
$alterado=$_POST['alterado'];
$title=$_POST['title'];
$keywords=$_POST['keywords'];
$description=$_POST['description'];
$status=$_POST['status'];

if ($idioma==""){$idioma="br";}
if ($ordem==""){$ordem=5;}

$topico=str_replace("'","´",$topico);

if (trim($n_amivavel)==""){$n_amigavel=url_amigavel($topico);}else{$n_amigavel=url_amigavel($n_amigavel);}

if ($chamada<>""){$chamada=str_replace("'","´",$chamada);}
if ($texto_simples<>"" and $texto==""){$texto=$texto_simples;}
if ($texto<>""){$texto=str_replace("'","´",$texto);}
if ($tags<>""){$tags=str_replace("'","´",$tags);}
if ($link<>""){$link=str_replace("'","´",$link);}
if ($title<>""){$title=str_replace("'","´",$title);}
if ($keywords<>""){$keywords=str_replace("'","´",$keywords);}
if ($description<>""){$description=str_replace("'","´",$description);}
?>
