<?php
session_start();
if($_SESSION['admin']==""){
	unset ($_SESSION['sess']);
	unset ($_SESSION['id_adm']);
	unset ($_SESSION['admin']);
	unset ($_SESSION['nivel']);
	unset ($_SESSION['loja']);
    header('location:'.$host.'/adm/autentica.php');
}else{

	include("../conn.php");
	$conn=conecta();
	
	include("funcoes.php");

	$pg_int="S";

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
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<title></title>
	  <meta name="Generator" content="EditPlus">
	  <meta name="Author" content="">
	  <meta name="Keywords" content="">
	  <meta name="Description" content="">
	  <head>
		<link href="<?php echo $host_adm;?>/estilo.css" rel="stylesheet">
		<link href="<?php echo $host_adm;?>/css/font-awesome.min.css" rel="stylesheet">
		<style>body {background-color:#fff;}</style>
	 </head>
	<body>
	<table border='1' cellpadding='2' cellspacing='0' width='100%' bordercolor=#DADADA bgcolor="#FFFFFF">

	<?

	$diretorio="../imagens/"; 

	$acao=$_REQUEST['acao'];
	$id=$_REQUEST['id'];
	$id_ref=$_REQUEST['id_ref'];
	$top_ref=$_REQUEST['top_ref'];
	$tabela=$_REQUEST['tabela'];
	if($tabela==""){
		$tabela="imagens";
	}else{
		$outra_tabela="S";
		$campos_tabela=$_REQUEST['campos_tabela'];
		if($campos_tabela==""){$campos_tabela="campos_iguais_tabela_imagens";}	
	}

	if ($acao==""){
		$acao="vazio";
	}
	//echo "ID:".$id." - ID REF:".$id_ref." - TOP REF:".$top_ref." - TABELA=".$tabela."<br>";
	switch ($acao){

		case "ver":

			$sql = "select * from ".$tabela." where id_ref=:id_ref and id=:id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id_ref', $id_ref, PDO::PARAM_INT);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){
				echo "<div id='alerta'>Imagem n&atilde;o encontrada</div>";
			}else{

				$rs = $sql->fetch(PDO::FETCH_ASSOC);
				
				$id=$rs['id'];
				$id_ref=$rs['id_ref'];
				$top_ref=$rs['top_ref'];
				$imagem=$rs['img'];
				$extensao=$rs['extensao'];
				$largura=$rs['larg'];
				$altura=$rs['alt'];
				$titulo=$rs['img_tit'];

				?>
				<tr bgcolor=#F2F2F2>
				<td width="20"><center><a href="?acao=alterar&tabela=<?php echo $tabela;?>&id=<?php echo $id;?>&id_ref=<?php echo $id_ref;?>&top_ref=<?php echo $top_ref;?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
				<td width="20"><center><a href="?acao=del&tabela=<?php echo $tabela;?>&id=<?php echo $id;?>&id_ref=<?php echo $id_ref;?>&top_ref=<?php echo $top_ref;?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
				
				<td width="30"> </td>
				<td nowrap> </td>
				</tr>
				<tr><td colspan=4>
				<center>
				<?php if ($extensao=="gif" || $extensao=="jpeg" || $extensao=="jpg" || $extensao=="png"){ ?>
				<IMG SRC="<?php echo $diretorio."/".$imagem?>" BORDER=0 ALT="<?php echo $titulo;?>">
				<?php }else{ ?>
				<img src="../img_site/anexo.png" title="<?php echo $titulo;?>" alt="<?php echo $imagem;?> - <?php echo $titulo;?>" class="thumb" border=0><br><?php echo $imagem;?>
				<?php
				}

			}

		break;

		case "alterar":
			
			$confirma=$_POST['confirma'];

			if ($confirma != "sim"){

				$sql = "select * from ".$tabela." where id_ref=:id_ref and top_ref=:top_ref and id=:id";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id_ref', $id_ref, PDO::PARAM_INT);
				$sql->bindParam(':top_ref', $top_ref, PDO::PARAM_INT);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->execute();

				if($sql->rowCount()==0){
					echo "<div id='alerta'>Imagem não encontrada</div>";
				}else{
					$rs = $sql->fetch(PDO::FETCH_ASSOC);
				
					$id=$rs['id'];
					$id_ref=$rs['id_ref'];
					$top_ref=$rs['top_ref'];
					$imagem=$rs['img'];
					$extensao=$rs['extensao'];
					$largura=$rs['larg'];
					$altura=$rs['alt'];
					$titulo=$rs['img_tit'];
					$descricao=$rs['img_desc'];
					$credito=$rs['img_cred'];

					?>
					<tr><tr bgcolor=#F2F2F2><td><center><font class=titulo><b>Imagem/Arquivo a ser alterado: <?php echo $imagem;?></td></tr>
					<tr><td><center>
							
					<form name="file_upload" method=post ENCTYPE="multipart/form-data" action="?acao=alt_imagem">
					<input type=hidden name="id" Value="<?php echo $id;?>">
					<input type=hidden name="imagem_ant" Value="<?php echo $imagem;?>">
					<input type=hidden name="id_ref" Value="<?php echo $id_ref;?>">
					<input type=hidden name="top_ref" Value="<?php echo $top_ref;?>">
					<input type=hidden name="volta" Value="<?php echo $volta;?>">
					<input type=hidden name="tabela" Value="<?php echo $tabela;?>">
					<input type=hidden name="confirma" Value="sim">
					<center>

					<table width="100%" border=0>
					<TR><TD><center>
					<b>Imagem/Arquivo:<input type="file" size=20 name="img[]" class="texto"><br>T&iacute;tulo:<input type="text" class="texto" name="img_tit[]" value="<?php echo $titulo;?>"> Cr&eacute;dito:<input type="text"  class="texto" name="img_cred[]" value="<?php echo $credito;?>">
					<input class=texto type="submit" name="submit" value="Enviar &gt;&gt;"></Div>
					</td></tr>
					</table>
					
					<?php if ($extensao=="gif" || $extensao=="jpeg" || $extensao=="jpg" || $extensao=="png"){ ?>
					<IMG SRC="<?php echo $diretorio."/".$imagem;?>" BORDER="0" ALT=""><BR>
					<?php } ?>
					<div align='center'><b><font class='texto'><a href='javascript:history.back(1)' class='titulo'>Voltar</a>
					</form>
					</td></tr>	
					<?
				}
			}
		break;


		case "alt_imagem":

			$confirma=$_POST['confirma'];
			$img_ant=$_POST['imagem_ant'];
			$id=$_POST['id'];
			$id_ref=$_POST['id_ref'];
			$top_ref=$_POST['top_ref'];
			$volta=$_POST['volta'];

			if ($confirma!="sim"){
				header("location: imagens_adm.php?acao=alterar");
			}else{

				$acao="altera_img";

				include("salva_up.php");
				
				//caso não suba imagem e só altere o titulo/legenda...
				$tit_arq =$_POST['img_tit'][0];
				$desc_arq=$_POST['img_desc'][0];
				$cred_arq=$_POST['img_cred'][0];

				$sql = "update ".$tabela." SET img_tit=:tit_arq,img_desc=:desc_arq,img_cred=:cred_arq where id=:id";
				$up = $conn->prepare($sql);
				$up -> bindParam(':tit_arq',$tit_arq,PDO::PARAM_STR);
				$up -> bindParam(':desc_arq',$desc_arq,PDO::PARAM_STR);
				$up -> bindParam(':cred_arq',$cred_arq,PDO::PARAM_STR);
				$up -> bindParam(':id',$id,PDO::PARAM_INT);
				$up -> execute();
						
				if ($img_ant != "" && $arquivo != ""){
					$apaga=$diretorio."/".$img_ant;

					if( file_exists( $apaga ) ){
						unlink( $apaga );
					}
				}

				$redir="fotos_adm.php?tabela=".$tabela."&id_ref=".$id_ref."&top_ref=".$top_ref;

				?>
				<script>   
				opener.location.href = '<?php echo $redir;?>';   
				window.close();     
				</script>
				<?

			}
			
		break;

		case "del":

			$confirma=$_POST['confirma'];

			if ($confirma != "sim"){
				?>
				<form action="?acao=del" method="post">
				<input type=hidden name="id" value="<?php echo $id;?>">
				<input type=hidden name="imagem" value="<?php echo $imagem;?>">
				<input type=hidden name="id_ref" value="<?php echo $id_ref;?>">
				<input type=hidden name="top_ref" value="<?php echo $top_ref;?>">
				<input type=hidden name="tabela" Value="<?php echo $tabela;?>">
				<input type=hidden name="confirma" value="sim">

				<font class='titulo'><center><B>Favor confirmar a Exclus&atilde;o desta imagem</B><BR>
				<input type="submit" value="Excluir" Class="texto"><br>
				<IMG SRC="<?php echo $diretorio."/".$imagem?>" BORDER="0" ALT="">
				<BR>
				<div align='center'><b><font class='texto'><a href='javascript:history.back(1)' class='texto'>Voltar</a>
				</form>
				<?
			}else{

				$sql = "select * from ".$tabela." where id_ref=:id_ref and top_ref=:top_ref and id=:id";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id_ref', $id_ref, PDO::PARAM_INT);
				$sql->bindParam(':top_ref', $top_ref, PDO::PARAM_INT);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->execute();

				if($sql->rowCount()==0){
					echo "<div id='alerta'>Imagem não encontrada</div>";
				}else{
					$rs = $sql->fetch(PDO::FETCH_ASSOC);
					$img_db=$rs['img'];

					$apaga=$diretorio."/".$img_db;
					if( file_exists( $apaga ) ){
						unlink( $apaga );
					}
				}

				$sql = "delete from ".$tabela." where id_ref=:id_ref and id=:id";
				$del = $conn->prepare($sql);
				$del->bindParam(':id', $id, PDO::PARAM_INT);
				$del->bindParam(':id_ref', $id_ref, PDO::PARAM_INT);
				$del -> execute();

				$redir="fotos_adm.php?tabela=".$tabela."&id_ref=".$id_ref."&top_ref=".$top_ref;
				
				?>
				<script>   
				opener.location.href = '<?php echo $redir;?>';   
				window.close();     
				</script>
				<?	
			}	
		break;
			
	}//switch

	fecha_conn();
	?>
	</tr></td>
	</table>
	</body>
	</html>
<?php
} // login
?>