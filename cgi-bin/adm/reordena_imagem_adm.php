<?php
header('Content-type: text/html; charset=.$charset.');
header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include("../conn.php");
include("funcoes.php");
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


?>
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<meta charset="ISO-8859-1">

		<link href="<?php echo $host_adm;?>/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo $host_adm;?>/estilo.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $host_adm;?>/js/scriptaculous/lists.css"/>
		<style>body {background-color:#fff;}</style>

		<!-- <script type="text/JavaScript" src="<?php echo $host_adm;?>/js/jquery-1.8.3.min.js"></script> -->
		<script src="<?php echo $host_adm;?>/js/jquery.js" type="text/JavaScript"></script>
		
		<script src="<?php echo $host_adm;?>/js/scriptaculous/prototype.js" type="text/javascript"></script>
		<script src="<?php echo $host_adm;?>/js/scriptaculous/scriptaculous.js" type="text/javascript"></script>
		<script language="JavaScript" type="text/javascript">
			function populateHiddenVars() {
				document.getElementById('imageFloatOrder').value = Sortable.serialize('imageFloatContainer');
			return true;
			}
		</script>
</head>

<body>

<?php
$id_ref=$_REQUEST['id'];
$top_ref=$_REQUEST['top_ref'];
$tp_img=$_REQUEST['tp_img'];
$tabela=$_REQUEST['tabela'];
echo "Id ref:$id_ref / Top ref:$top_ref / Tabela:$tabela<br>";
if($tp_img==""){$tp_img="Galeria";}
if($tabela==""){$tabela="imagens";}

echo "Tabela:$tabela<br>";
/*
if(isset($_POST['imageFloatOrder'])) {
	foreach($_POST as $nome_campo => $valor){ 
	  echo $valor . "<br>"; 
	} 
}
*/

if(isset($_POST['imageFloatOrder'])) {
	
	$ordem_db=$_POST['ordem_db'];
	$nova_ordem=$_POST['imageFloatOrder'];
	$nova_ordem=str_replace("imageFloatContainer[]=","",$nova_ordem);
	
	$quebra = explode("&", $nova_ordem);
	
	$ordem=0;
	
	foreach($quebra as $id_img){
			
		//echo $id_img." - ".$ordem."<br/>";
		$sql='update '.$tabela.' set ordem_img=:ordem where id=:id_img';
		$up = $conn->prepare($sql);
		$up -> bindParam(':ordem',$ordem,PDO::PARAM_INT);
		$up -> bindParam(':id_img',$id_img,PDO::PARAM_INT);
		$up -> execute();
		
		$ordem++;
	
	}

	$redir="fotos_adm.php?tabela=".$tabela."&id_ref=".$id_ref."&top_ref=".$top_ref;
	
	?>
	<script>
		window.open("<?php echo $redir;?>","principala");//recarrega no iframe principala
		//opener.location.href = '<?php echo $redir;?>';
		window.close();
	</script>
	<?php

}else{

	$sql = "select * from ".$tabela." where top_ref=:top_ref and id_ref=:id_ref order by tp_img,ordem_img,id";
	//echo $sql;
	$sql = $conn->prepare($sql);
	$sql->bindParam(':top_ref', $top_ref, PDO::PARAM_STR);
	$sql->bindParam(':id_ref', $id_ref, PDO::PARAM_INT);
	$sql->execute();

	if($sql->rowCount()==0){
		echo "<div class='col-sm-12'><br><br><p class='bg text-center'><span class='topico'>Nenhuma imagem encontrada</span></div>";
	}else{

		echo "<div class='col-sm-12'><p class='bg text-center'><span class='topico'>Reordenar Imagens</span></div>";
		echo "<div class='col-sm-12'><p class='text-center'>Clique e arraste para reordenar</p></div>";

		echo "<div id='imageFloatContainer' class='col-sm-12'>";
		$ordem_db="";
		$n=0;
		while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
			$n++;
			$id=$rs['id'];	
			$id_ref=$rs['id_ref'];	
			$imagem=$rs['img'];
			$extensao=$rs['extensao'];
			$largura=$rs['larg'];
			$altura=$rs['alt'];
			$titulo=$rs['img_tit'];

			
			if ($extensao=="gif" || $extensao=="jpeg" || $extensao=="jpg" || $extensao=="png"){
				echo "<img id='img_".$id."' src='$host/redim.php?img=".$imagem."&larg=120&alt=90&crop=S' title='".$id." - ".$titulo."'>";
			}
			$ordem_db.=$id.",";
		}

		echo "<hr style='clear:both;border:0;visibility:none;'>";
		echo "</div>";
		//echo "Ordem DB:".$ordem_db

		echo "<form action='?' method='POST' onSubmit='populateHiddenVars();' name='formulario' id='formulario'>";
		echo "<input type='hidden' name='ordem_db' value='".$ordem_db."'>";
		echo "<input type='hidden' name='imageFloatOrder' id='imageFloatOrder' size='250'>";
		//echo "<br><input type='button' value='Ordem atual' class='button' onClick='populateHiddenVars();'><br>";		
		
		echo "<input type='hidden' name='id' value='".$id_ref."'>";
		echo "<input type='hidden' name='top_ref' value='".$top_ref."'>";
		echo "<input type='hidden' name='tp_img' value='".$tp_img."'>";
		echo "<input type='hidden' name='tabela' value='".$tabela."'>";
		
		echo "<hr><p class='text-center'><input type='submit' value='Enviar' class='btn btn-secondary'></p>";
		echo "</form>";


		echo "<script type='text/javascript'>Sortable.create('imageFloatContainer',{tag:'img',overlap:'horizontal',constraint:false});</script>";
	}

}

fecha_conn();
?>
					
</body>
</html>
