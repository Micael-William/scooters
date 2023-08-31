<?
$id=$_POST['id'];
$criacao=$_POST['criacao'];
$data=$_POST['data'];
$hora=$_POST['hora'];
$assunto=$_POST['assunto'];
$titulo=$_POST['titulo'];
$n_amigavel=$_POST['n_amigavel'];
$chamada=$_POST['chamada'];
$descricao=$_POST['descricao'];
$layout=$_POST['layout'];
$ordem=$_POST['ordem'];
$title=$_POST['title'];
$keywords=$_POST['keywords'];
$description=$_POST['description'];
$status=$_POST['status'];

if (trim($n_amigavel)==""){$n_amigavel=url_amigavel($titulo);}else{$n_amigavel=url_amigavel($n_amigavel);}

$id=str_replace("'","´",$id);
$criacao=str_replace("'","´",$criacao);
$data=str_replace("'","´",$data);
$hora=str_replace("'","´",$hora);
$assunto=str_replace("'","´",$assunto);
$titulo=str_replace("'","´",$titulo);
$n_amigavel=str_replace("'","´",$n_amigavel);
$chamada=str_replace("'","´",$chamada);
$descricao=str_replace("'","´",$descricao);
$layout=str_replace("'","´",$layout);
$ordem=str_replace("'","´",$ordem);
$title=str_replace("'","´",$title);
$keywords=str_replace("'","´",$keywords);
$description=str_replace("'","´",$description);
$status=str_replace("'","´",$status);
?>