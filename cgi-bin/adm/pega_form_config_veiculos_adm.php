<?
$id=$_POST['id'];
$ordem=$_POST['ordem'];
$topico=$_POST['topico'];
$sub_top=$_POST['sub_top'];
$n_amigavel=$_POST['n_amigavel'];
$ni=$_POST['ni'];
$np=$_POST['np'];
$title=$_POST['title'];
$keywords=$_POST['keywords'];
$description=$_POST['description'];
$status=$_POST['status'];

if (trim($n_amigavel)==""){$n_amigavel=url_amigavel($topico);}else{$n_amigavel=url_amigavel($n_amigavel);}

$id=str_replace("'","´",$id);
$ordem=str_replace("'","´",$ordem);
$topico=str_replace("'","´",$topico);
$sub_top=str_replace("'","´",$sub_top);
$n_amigavel=str_replace("'","´",$n_amigavel);
$ni=str_replace("'","´",$ni);
$np=str_replace("'","´",$np);
$title=str_replace("'","´",$title);
$keywords=str_replace("'","´",$keywords);
$description=str_replace("'","´",$description);
$status=str_replace("'","´",$status);
?>