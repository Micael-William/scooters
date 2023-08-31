<?php

$url=$_GET['url'];

list ($var1, $var2, $var3, $var4,$var5,$var6,$var7) = explode ('/', $url);
// echo $var1;

$charset="utf-8";

//$charset="ISO-8859-1";

 

header('Content-type: text/html; charset='.$charset);

setlocale(LC_ALL, "pt_BR");

setlocale(LC_MONETARY,"pt_BR", "ptb");

session_start();



$ip = getenv("REMOTE_ADDR"); 



include("conn.php");

$conn=conecta();



include("adm/funcoes.php");

$diretorio="imagens/"; 

$dir_anexo="anexos/";

$dir_uploads="uploads/";



$conf_alt_p=100;



/*

require "lib/Cropper.php";

$c = new \CoffeeCode\Cropper\Cropper("imagens/cache");

*/



//$dir_inc="inc/"; 

$data = date('d-m-Y H:i:s');

$dt_whats = date('H:i');



$pag = ($_GET['pag']);

$pag = filter_var($pag, FILTER_VALIDATE_INT);



$inicio = 0;

$limite = 10;

if ($pag!=''){

	$inicio = ($pag - 1) * $limite;

}else{

	$pag=1;

}



$pg_int="S";



$sql = "select * from config where id = 1";

$sql = $conn->prepare($sql);

$sql->execute();



if($sql->rowCount()==0){

	echo "Nenhum arquivo encontrado";

}else{

	$rs = $sql->fetch(PDO::FETCH_ASSOC);

	$tipo=$rs['tipo'];

	$nome_site=$rs['nome'];$nome_site=str_replace("´","'",$nome_site);

	$cpf_cnpj_site=$rs['cpf_cnpj'];

	$endereco_site=$rs['endereco'];$endereco_site=str_replace("´","'",$endereco_site);

	$bairro_site=$rs['bairro'];$bairro_site=str_replace("´","'",$bairro_site);

	$cidade_site=$rs['cidade'];$cidade_site=str_replace("´","'",$cidade_site);

	$uf_site=$rs['uf'];

	$cep_site=$rs['cep'];

	$email_site=$rs['email'];

	$telefone_site=$rs['telefone'];

	$facebook_site=$rs['facebook'];

	$youtube_site=$rs['youtube'];

	$instagram_site=$rs['instagram'];

	$whats_site=$rs['whats'];

	$tripadvisor_site=$rs['tripadvisor'];

	$twitter_site=$rs['twitter'];

	$g_plus_site=$rs['g_plus'];

	$pinterest_site=$rs['pinterest'];

	$atendimento_site=$rs['atendimento'];

	$nro_idiomas_site=$rs['nro_idiomas'];

	$nro_deptos_site=$rs['nro_deptos'];

	$controla_estoque=$rs['controla_estoque'];

	if($controla_estoque=="S"){$controla="produtos.estoque > '0' ";}else{$controla="produtos.id > '0' ";}

	$campo_login=$rs['campo_login'];

	$latitude_site=$rs['latitude'];

	$longitude_site=$rs['longitude'];

	$zoom_site=$rs['zoom'];

	$ea=$rs['ea'];

	$sa=$rs['sa'];

	$sv=$rs['sv'];

	$url_site=$rs['url_site'];

	$tempo_sessao=$rs['tempo_sessao'];

	$title_site=$rs['title'];

	$description_site=$rs['description'];

	$keywords_site=$rs['keywords'];

	$tag_head=$rs['tag_head'];

	$tag_script=$rs['tag_script'];

	$script="";

	if ($title_site==""){$title_site=$nome_site;}

	$host=$rs['url_site'];

	$host_adm=$host."/adm";

}



if ($og_type==""){$og_type="website";}

if ($img_site==""){$img_site=$host."/img_site/logo.png";}

if ($temp_title_site<>""){$title_site=$temp_title_site;}

if ($temp_description_site<>""){$description_site=$temp_description_site;}

if ($temp_keywords_site<>""){$keywords_site=$temp_keywords_site;}



$link_whats=str_replace("(","",$whats_site);

$link_whats=str_replace(")","",$link_whats);

$link_whats=str_replace("-","",$link_whats);

$link_whats=str_replace(".","",$link_whats);

$link_whats=str_replace(" ","",$link_whats);



$link_whats="https://wa.me/55".$link_whats."?text=Olá,%20eu%20gostaria%20de%20infomações!";





include("envio.php");

?>