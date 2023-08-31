<?php
$charset="utf-8";
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

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<meta charset="<?php echo $charset;?>">
		<title>Reordenar T&oacute;picos</title>  
		
		<link href="<?php echo $host_adm;?>/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo $host_adm;?>/estilo.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $host_adm;?>/js/scriptaculous/lists.css"/>
		<style>
		body {background-color:#fff;}
		
		
		</style>

		<!-- <script type="text/JavaScript" src="<?php echo $host_adm;?>/js/jquery-1.8.3.min.js"></script> -->
		<script type="text/JavaScript" src="<?php echo $host_adm;?>/js/jquery.js"></script>
		<script src="<?php echo $host_adm;?>/js/scriptaculous/prototype.js" type="text/javascript"></script>
		<script src="<?php echo $host_adm;?>/js/scriptaculous/scriptaculous.js" type="text/javascript"></script>
		<script language="JavaScript" type="text/javascript">
			function populateHiddenVars() {
				document.getElementById('Ordem').value = Sortable.serialize('sortableList');
			return true;
			}
		</script>
</head>

<body>

<?php
$np=$_REQUEST['np'];
$link_pg=$_REQUEST['link_pg'];
$tabela=$_REQUEST['tb'];
$idioma=$_REQUEST['idioma'];
if($tabela==""){$tabela="institucional";}
//echo "LinkPG=".$link_pg;
/*
if(isset($_POST['Ordem'])) {
	foreach($_POST as $nome_campo => $valor){ 
	  echo $valor . "<br>"; 
	} 
}
*/

if(isset($_POST['Ordem'])) {
	
	$ordem_db=$_POST['ordem_db'];
	$nova_ordem=$_POST['Ordem'];
	$nova_ordem=str_replace("sortableList[]=","",$nova_ordem);
	
	$quebra = explode("&", $nova_ordem);
	
	$ordem=0;
	
	foreach($quebra as $id){
			
		echo $id." - ".$ordem."<br/>";
		$sql='update '.$tabela.' set ordem=:ordem where id=:id';
		$up = $conn->prepare($sql);
		$up -> bindParam(':ordem',$ordem,PDO::PARAM_INT);
		$up -> bindParam(':id',$id,PDO::PARAM_INT);
		$up -> execute();
		
		$ordem++;
	
	}
	$redir=$link_pg;
	?>
	<script>
		//window.open("<?php echo $redir;?>","principala");//recarrega no iframe principala
		//opener.location.href = '<?php echo $redir;?>';
		window.opener.location.reload('<?php echo $redir;?>');
		window.close();
	</script>
	<?php

}else{

	$sql = "select * from ".$tabela." where np=:np order by ordem,id";
	//echo $sql;
	$sql = $conn->prepare($sql);
	$sql->bindParam(':np', $np, PDO::PARAM_STR);
	$sql->execute();

	if($sql->rowCount()==0){
		echo "Nenhum T&oacute;pico encontrado.";
	}else{

		echo "<div class='col-sm-12'><p class='bg text-center'><span class='topico'>Reordenar T&oacute;picos</span></div>";
		echo "<div class='col-sm-12'><p class='text-center'>Clique e arraste para reordenar</p></div>";

		echo "<div class='col-sm-12'>";
		echo "<ul id='sortableList' class='sortableList'>";
		$ordem_db="";
		$n=0;
		while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
			$n++;
			$id=$rs['id'];	
			$topico=$rs['topico'];	
			$topico=str_replace("´", "'",$topico);
			echo "<li id='id_".$id."'>".$topico."</li>";
			$ordem_db.=$id.",";
		}
		
		echo "<br><br>";
		echo "</ul>";
		
		echo "</div>";
		//echo "Ordem DB:".$ordem_db
		
		echo "<form action='?' method='POST' onSubmit='populateHiddenVars();' name='formulario' id='formulario'>";
		echo "<input type='hidden' name='ordem_db' value='".$ordem_db."'>";
		echo "<input type='hidden' name='Ordem' id='Ordem' size='250'>";
		//echo "<br><input type='button' value='Ordem atual' class='button' onClick='populateHiddenVars();'><br>";		
		
		echo "<input type='hidden' name='id' value='".$id_ref."'>";
		echo "<input type='hidden' name='top_ref' value='".$top_ref."'>";
		echo "<input type='hidden' name='tp_img' value='".$tp_img."'>";
		echo "<input type='hidden' name='tabela' value='".$tabela."'>";
		
		echo "<hr><p class='text-center'><input type='submit' value='Enviar' class='btn btn-secondary'></p>";
		echo "</form>";


		echo "<script type='text/javascript'>Sortable.create('sortableList',{tag:'li',overlap:'horizontal',constraint:false});</script>";
	}

}

fecha_conn();
?>
					
</body>
</html>
