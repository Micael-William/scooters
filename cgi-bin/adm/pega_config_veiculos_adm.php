<?
$id=$rs['id'];
$ordem=$rs['ordem'];
$topico=$rs['topico'];
$sub_top=$rs['sub_top'];
$n_amigavel=$rs['n_amigavel'];
$ni=$rs['ni'];
$np=$rs['np'];
$title=$rs['title'];
$keywords=$rs['keywords'];
$description=$rs['description'];
$status=$rs['status'];
$id_ref=$id;

$id=str_replace("´","'",$id);
$ordem=str_replace("´","'",$ordem);
$topico=str_replace("´","'",$topico);
$sub_top=str_replace("´","'",$sub_top);
$n_amigavel=str_replace("´","'",$n_amigavel);
$ni=str_replace("´","'",$ni);
$np=str_replace("´","'",$np);
$title=str_replace("´","'",$title);
$keywords=str_replace("´","'",$keywords);
$description=str_replace("´","'",$description);
$status=str_replace("´","'",$status);
?>