<?
$id=$rs['id'];
$criacao=$rs['criacao'];
$data=$rs['data'];
$hora=$rs['hora'];
$assunto=$rs['assunto'];
$titulo=$rs['titulo'];
$n_amigavel=$rs['n_amigavel'];
$chamada=$rs['chamada'];
$descricao=$rs['descricao'];
$layout=$rs['layout'];
$ordem=$rs['ordem'];
$title=$rs['title'];
$keywords=$rs['keywords'];
$description=$rs['description'];
$status=$rs['status'];
$id_ref=$id;

$id=str_replace("´","'",$id);
$criacao=str_replace("´","'",$criacao);
$data=str_replace("´","'",$data);
$hora=str_replace("´","'",$hora);
$assunto=str_replace("´","'",$assunto);
$titulo=str_replace("´","'",$titulo);
$n_amigavel=str_replace("´","'",$n_amigavel);
$chamada=str_replace("´","'",$chamada);
$descricao=str_replace("´","'",$descricao);
$layout=str_replace("´","'",$layout);
$ordem=str_replace("´","'",$ordem);
$title=str_replace("´","'",$title);
$keywords=str_replace("´","'",$keywords);
$description=str_replace("´","'",$description);
$status=str_replace("´","'",$status);
?>