<?php
$url=$_GET['url'];
list ($var1, $var2, $var3, $var4) = explode ('/', $url);

session_start();

if (!isset($_SESSION['id'])) {
    session_destroy();
	unset ($_SESSION['sess']);
	unset ($_SESSION['id']);
	unset ($_SESSION['admin']);
	unset ($_SESSION['nivel']);
    header('location:autentica.php');
}else{
	$session_sess=$_SESSION['sess'];
	$session_id_adm=$_SESSION['id_adm'];
	$session_admin=$_SESSION['admin'];
	$session_nivel=$_SESSION['nivel'];
}

include("conn.php");
include("adm/funcoes.php");
$conn=conecta();


$sql="select * from config where id=:id";
$sql = $conn->prepare($sql);
$sql->bindValue(':id', '1', PDO::PARAM_INT);
$sql->execute();

if($sql->rowCount()==0){
	$er=0;
}else{
	$rs = $sql->fetch(PDO::FETCH_ASSOC);
	$nome_site=$rs['nome'];$nome_site=str_replace("´","'",$nome_site);
	$url_site=$rs['url_site'];
	$host=$rs['url_site'];
}
$host_adm=$host."/adm";


$diretorio="imagens/"; 
$data = date('d-m-Y H:i:s');

$conf_alt_p=$conf_alt_p + 90;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<title></title>
  <meta name="Generator" content="EditPlus">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <head>
	<link href="<?php echo $host_adm;?>/estilo.css" rel="stylesheet">
	<style>
	body {background-color:#fff;}
	</style>
 </head>
<body>
<table border='0' cellpadding='2' cellspacing='2' width='100%' bordercolor=#DADADA bgcolor="#FFFFFF">

<tr>
<?php

//echo $_SESSION['nivel'];
$id_ref=$_REQUEST['id_ref'];
$np_ref=$_REQUEST['np_ref'];
$top_ref=$_REQUEST['top_ref'];
$tabela=$_REQUEST['tabela'];
if($tabela==""){
	$tabela="imagens";
}else{
	//$tabela="....";
	$campos_tabela=".....";//so_imagem ou campos_iguais_tabela_imagens
}


//echo "select * from ".$tabela." where id_ref='$id_ref' and top_ref='$top_ref' order by ordem_img, id";

try {
	
	$sql = "select * from ".$tabela." where id_ref=:id_ref and top_ref=:top_ref order by ordem_img, id";
	//echo $sql;
	$sql = $conn->prepare($sql);
	$sql->bindParam(':id_ref',$id_ref, PDO::PARAM_STR);
	$sql->bindParam(':top_ref',$top_ref,PDO::PARAM_STR);
	$sql->execute();

	if($sql->rowCount()==0){
		echo "<td height=".$conf_alt_p."><center><center><font face=arial color=red size=2><b>&nbsp;Nenhuma imagem vinculada a este registro</td>";
	}else{

		while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
			$id=$rs['id'];	
			$id_ref=$rs['id_ref'];	
			$imagem=$rs['img'];
			$extensao=$rs['extensao'];
			$largura=$rs['larg'];
			$altura=$rs['alt'];
			$titulo=$rs['img_tit'];
			
			$j_larg=$largura + 50;

			//if ($j_larg < 500){$j_larg=500;}
			//if ($j_larg > 1100){$j_larg=1100;}

			?>
			<td><center>
			<?php if ($_SESSION['nivel'] < 4){ ?>
			<a href="http://#" onClick="window.open('imagens_adm.php?acao=ver&id=<?php echo $id;?>&id_ref=<?php echo $id_ref;?>&tabela=<?php echo $tabela;?>&campos_tabela=<?php echo $campos_tabela;?>','Janela','toolbar=no,location=yes,directories=yes,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=<?php echo $j_larg;?>,height=<?php echo $altura+150;?>'); return false;" class=texto>
			<?php }?>	



			<?php 
			if ($extensao=="gif" || $extensao=="jpeg" || $extensao=="jpg" || $extensao=="png"){ ?>
				<img src="redim.php?img=<?php echo $imagem;?>&larg=120&alt=90&crop=S" title="<?php echo $titulo;?>" alt="<?php echo $imagem;?> - <?php echo $titulo;?>" class="thumb" border=0 style='padding:2px;'>
			<?php }else{ ?>
				<img src="img_site/anexo.png" height="50" title="<?php echo $titulo;?>" alt="<?php echo $imagem;?> - <?php echo $titulo;?>" class="thumb" border=0><br><?php echo $imagem;?>
			<?php }?>

			<?php if ($_SESSION['nivel'] < 4){ ?>
				</a>
			<?php }?>
			</td>
			<?
		}
	}
	

  
} catch(PDOException $e) {
	echo 'Erro: '.$e->getMessage();
}

echo "</tr></table>";

?>
</body>
</html>
