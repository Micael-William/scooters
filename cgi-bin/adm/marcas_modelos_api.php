<?php
if ($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
	die();
}

$diretorio="imagens/"; 
$acao=$var4;
$id=$var5;
	
if($acao=="ver"){
	$id_rec=$id;
	if($id_rec=="0"){$id_rec="";}
	$acao="vazio";
}

if($acao=="" or $acao=="ver"){$acao="vazio";}
	
	
$link_pg=$host."/adm/".$var2."/".$var3;

if($acao<>"vazio" and $acao<>"cadastrar" and $acao<>"salva" and $acao<>"edit" and $acao<>"altera" and $acao<>"del" and $acao<>"atualiza_em_massa"){
	$acao="vazio";
	$pag = $var4;
	$pag = filter_var($pag, FILTER_VALIDATE_INT);
	$inicio = 0;$limite = 15;
	if ($pag!=''){$inicio = ($pag - 1) * $limite;}else{$pag=1;}
}

$msn=$_SESSION['msn'];

If ($msn=="cad_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Cadastrado efetuado com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>";
	$aviso.="</div>";
} 
			
If ($msn=="alt_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Alteração efetuada com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>";
	$aviso.="</div>";
}

If ($msn=="alt_erro"){
	$aviso="<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Não foi possível encontrar o registro.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>";
	$aviso.="</div>";
}

If ($msn=="del_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Registro apagado com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Fechar'></button>";
	$aviso.="</div>";
} 	

$_SESSION['msn']="";

$top_ref="config_veiculos";
$conf_alt_p=100;
	
$top_pagina="VEÍCULOS - MARCAS/MODELOS API";
$cadastrar="CADASTRAR";
$editar="ALTERAR";
$apagar="APAGAR";

echo "<div class='card'>";

switch ($acao){


	case "vazio":

		if($id_rec==""){
			$e_topico=$top_pagina;
			try {
				$sql = "select * from marcas_modelos_api where marca='0' order by topico";
				$sql = $conn->prepare($sql);
				$sql->execute();
			} catch(PDOException $e) {
				echo 'Erro: '.$e->getMessage();
			}

		}else{

			try {
					
				$sql = "select * from marcas_modelos_api where id=:id_rec";
				$sql = $conn->prepare($sql);
				$sql->bindValue(':id_rec',$id_rec, PDO::PARAM_INT);
				$sql->execute();
					
				if($sql->rowCount()==0){

					$e_topico=$top_pagina." - ERRO";
					echo "<div class='card-header text-end topico'><strong>".$e_topico."</strong>&nbsp;";
					//if ($sub_top=="S" or $_SESSION['nivel']<2){
					//	echo "&nbsp;&nbsp;<a href='".$link_pg."/cadastrar/".$id_rec."' title='Cadastrar'><i class='fa fa-plus text-end' aria-hidden='true'></i></a>";
					//}
					echo "	</div>";
        			echo "	<div class='card-body'>";
					
					echo "<p class='text-center'>NENHUM REGISTRO ENCONTRADO</p>";
					echo "<p class='text-end'><a href='".$link_pg."/ver/".$ni."'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
				}else{

					$rs = $sql->fetch(PDO::FETCH_ASSOC);
					$e_topico=$rs['topico'];
					$e_topico=str_replace("´", "'",$e_topico);
					$np=$rs['np'];

					$e_topico="<a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'>$top_pagina</a> - ".mb_strtoupper($e_topico);
				}

					$ordem=" order by topico";
					

					$sql = "select * from marcas_modelos_api where np=:id_rec".$ordem;
					//echo "2=".$sql."<hr>id_rec=".$id_rec;
					$sql = $conn->prepare($sql);
					$sql->bindParam(':id_rec',$id_rec, PDO::PARAM_INT);
					$sql->execute();

				} catch(PDOException $e) {
					echo 'Erro: '.$e->getMessage();
				}
			
			
		}

		if($sql->rowCount()==0){

			echo "<div class='card-header text-end topico'><strong>".$e_topico."</strong>&nbsp;";
			//if ($sub_top=="S" or $_SESSION['nivel']<2 ){
				//echo "&nbsp;&nbsp;<a href='".$link_pg."/cadastrar/".$id_rec."' data-toggle='tooltip' data-placement='bottom' title='Cadastra'><i class='fa fa-plus text-end' aria-hidden='true'></i></a>";
			//}
			echo "	</div>";
        	echo "	<div class='card-body'>";
			echo "<p class='text-center'>NENHUM REGISTRO ENCONTRADO</p>";
		
		}else{

			echo "<form method=post action='$link_pg/atualiza_em_massa' ENCTYPE='multipart/form-data' name='formulario' id='formulario'>";			  
			$c=0;
			$nro_item=0;
			$ids="";
			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
				$c++;
				$nro_item++;
				$id=$rs['id'];
				$topico=$rs['topico'];
				$topico=str_replace("´", "'",$topico);
				$status=$rs['status'];
				$marca=$rs['marca'];
				$np=$rs['np'];

				if($marca=='0'){
					$sub_top="S";
					$tipo="MARCAS";
				}else{
					$tipo="MODELOS";
				}

				$ids.=$id.",";
		
				if ($c==1){
					echo "<div class='card-header text-end topico'><a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'><strong>".$e_topico."</strong></a>&nbsp;&nbsp;";
					//if ($sub_top=="S" or $_SESSION['nivel']<2){
					//	echo "&nbsp;&nbsp;<a href='".$link_pg."/cadastrar/".$id_rec."' data-toggle='tooltip' data-placement='bottom' title='Cadastrar nova Página'><i class='fa fa-plus text-end' aria-hidden='true'></i></a>";
					//}
								
					echo "	</div>";
        			echo "	<div class='card-body'>";

					If ($aviso<>""){echo $aviso;}

					echo "<table class='table table-hover'><tbody>";
				}
					
				if ($status=="A"){echo "<tr>";}
				if ($status=="D"){echo "<tr class='bg-warning'>";}
				if ($status=="N"){echo "<tr class='bg-danger'>";}

				if($status=="A"){$checked="checked";}else{$checked="";}

				echo "<td align=left><div class='form-check'>";
				echo "<input type='checkbox' name='$id' value='A' $checked id='$id'>";
				echo "<label class='form-check-label' for='$id'>&nbsp;&nbsp;".$topico."</label>";
				echo "</div></td>";
	
				if ($sub_top=="S"){
					echo "<td width='5%' class='text-center'><a href='".$link_pg."/ver/".$id."' data-toggle='tooltip' data-placement='top'  title='Ver modelos de ".$topico."'><i class='fa fa-share-square-o' aria-hidden='true'></i></a></td>";
				}else{
					echo "<td width='5%'><div align=center>&nbsp;</div></td>";
				}

				echo "<td width='5%' class='text-center'><a href='".$link_pg."/edit/".$id."' data-toggle='tooltip' data-placement='top' title='Editar'><i class='social fa fa-pencil' aria-hidden='true'></i></a></td>";
				echo "<td width='5%' class='text-center'><a href='".$link_pg."/del/".$id."' data-toggle='tooltip' data-placement='top' title='Apagar'><i class='social fa fa-trash-o' aria-hidden='true'></i></a></td>";
				echo "</tr>";
						
			}
		}

	
		if ($ni<>"0"){

			$sql = "select * from marcas_modelos_api where id = :np";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':np', $np, PDO::PARAM_INT);
			$sql->execute();
			if($sql->rowCount()>0){
					
				$rs = $sql->fetch(PDO::FETCH_ASSOC);
				$np=$rs['np'];
				
				echo "<tr><td colspan=4><p class='text-end'><a href='".$link_pg."/ver/".$np."'><button type='button' class='btn btn-default'>Voltar</button></a></p></td></tr>";
			}
		}	
					
		echo "</tbody></table>";
		//echo "Np:$id_rec";

		$ids=substr($ids, 0, -1);
		echo "<input type='hidden' name='nro_topicos' value='".$nro_item."'/>".PHP_EOL;
		echo "<input type='hidden' name='np' value='".$id_rec."'/>".PHP_EOL;
		echo "<input type='hidden' name='ids' value='".$ids."'/>".PHP_EOL;

		echo "<button type='submit' class='btn btn-primary'>ATUALIZAR $tipo</button>";
		echo "</form>";

		//echo "<p class='text-center'><a href='$host/adm/$var2/atualiza_api'><button type='button' class='btn btn-default'>ATUALIZAR MARCAS E MODELOS</button></a></p>";
			
		echo "</div>";//card-body


	break;

	
	case "atualiza_em_massa":

		$ids=$_POST['ids'];
		//$ids=substr($ids, 0, -1);
		$qf=explode(',',$ids);
		$nro=count($qf);
		$np=$_POST['np'];

		//echo "MARCA:$np<hr>";
		//echo "Ids:$ids<hr>";

		for($i = 0; $i < $nro; $i++) {

   			$id=$qf[$i];
			$check=$_POST[$id];
			if($check==""){$status="I";}else{$status="A";}

			//echo "$id - $status<br>";

			$sql='update marcas_modelos_api set status=:status where id=:id';
			$up = $conn->prepare($sql);
			$up -> bindParam(':id',$id,PDO::PARAM_STR);
			$up -> bindParam(':status',$status,PDO::PARAM_STR);
			$up -> execute();

		}

		if($np=="0"){$url=$link_pg;}else{$url=$link_pg."/ver/".$np;}
		
		?><script>window.location.href = "<?php echo $url;?>"</script><?
		
	break;	


	case "edit":
		
		//$id=$_REQUEST['id'];

		$sql = "select * from marcas_modelos_api where id=:id";
		$sql = $conn->prepare($sql);
		$sql->bindParam(':id', $id, PDO::PARAM_STR);
		$sql->execute();
			
		if($sql->rowCount() == 0){

			echo "<div class='card-header text-end topico'>";
			echo "	<strong>ERRO</strong>&nbsp;";
			echo "	</div>";
        	echo "	<div class='card-body'>";

			echo "<p class='text-center'><b>Registro não encontrado</p>";
			echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'>Voltar</p>";

			echo "</div>";//<!-- card-body -->"
		
		}else{
			
			$rs = $sql->fetch(PDO::FETCH_ASSOC);
			
			$id=$rs['id'];
			$topico=$rs['topico'];
			$topico=str_replace("´", "'",$topico);
			$status=$rs['status'];
			$marca=$rs['marca'];
			$np=$rs['np'];
			$imagem=$rs['imagem'];
			$status=$rs['status'];

			if($topico<>""){$e_topico=" - ".$topico;}

			echo "<div class='card-header text-end topico'>";
			echo "	<a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'><strong>".$top_pagina."</strong></a>&nbsp;";
			echo "</div><!-- card-header -->";
			
			If ($aviso<>""){echo $aviso;}

			$volta=$link_pg."/ver/".$np;
			echo "<div class='card-body'>";
			echo "<p class='acao'>$editar".mb_strtoupper($e_topico)."</p>";
			?>
			<form method=post action='<?php echo $link_pg;?>/altera' ENCTYPE="multipart/form-data" name="formulario" id="formulario">			  
			  <?php include("form_marcas_modelos_api_veiculos_adm.php");?>
			  <input type="hidden" name="id" value="<?php echo $id;?>">
			  <input type="hidden" name="marca" value="<?php echo $marca;?>">
			  <input type="hidden" name="np" value="<?php echo $np;?>">
			  <input type="hidden" name="idioma" value="<?php echo $idioma;?>">
			</form>
			<?php 
			echo "</div>";//<!-- card-body -->"
			
		}

	break;

	case "altera":

		$id=$_POST['id'];
		$topico=$_POST['topico'];
		$id_api=$_POST['id_api'];
		$marca=$_POST['marca'];
		$np=$_POST['np'];
		$status=$_POST['status'];

		$id=str_replace("'","´",$id);
		$topico=str_replace("'","´",$topico);
		$id_api=str_replace("'","´",$id_api);
		$ni=str_replace("'","´",$ni);
		$np=str_replace("'","´",$np);
		$status=str_replace("'","´",$status);

		$sql = "select * from marcas_modelos_api where id='$id'";
		//echo $sql;
		$sql = $conn->prepare($sql);
		$sql->execute();

		//echo "Total:".$sql->rowCount();

		if($sql->rowCount()==0){
			echo "<div class='card-header text-end topico'>";
			echo "	<a href='$link_pg'><strong>ERRO</strong></a>&nbsp;";
			echo "</div>";
			echo "	<div class='card-body'>";
			echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO!!!</p>";
			echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
			echo "</div>";
		}else{

			$rs = $sql->fetch(PDO::FETCH_ASSOC);
			$np=$rs['np'];

			$sql = "select * from marcas_modelos_api where topico='$topico' and marca='$marca' and np='$np' and id<>'$id'";
			//echo $sql;
			$sql = $conn->prepare($sql);
			$sql->execute();

			if($sql->rowCount()==0){

				try {

					$sql='update marcas_modelos_api set topico=:topico,status=:status where id=:id';

					$up = $conn->prepare($sql);
					$up -> bindParam(':id',$id,PDO::PARAM_STR);
					$up -> bindParam(':topico',$topico,PDO::PARAM_STR);
					$up -> bindParam(':status',$status,PDO::PARAM_STR);
					$up -> execute();

				}catch(PDOException $e) {
				  echo 'Erro: '.$e->getMessage();
				  $erro="deu_merda";
				}

				$acao="altera_img";
				$tabela="marcas_modelos_api";$outra_tabela="S";$campos_tabela="so_imagem";
				include("salva_up.php");

				if ($erro != ""){
					echo "<div id='alerta'><b>Erro(s) ao carregar o(s) arquivo(s).<br><a href=javascript:history.back(-1)>Voltar</a></b></div>";
				}else{
					//if ($ni > 0) {$id=$np;}
					$_SESSION['msn']="alt_ok";
					$url=$link_pg."/edit/".$id;
					?><script>window.location.href = "<?php echo $url;?>"</script><?php
					
				} 
				
			}else{
				echo "<div class='card-header text-end topico'>";
				echo "	<a href='$link_pg'><strong>ERRO ".$topico."</strong></a>&nbsp;";
				echo "</div>";
				echo "<div class='card-body'>";
				echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
				echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
				echo "</div>";
			}
		}
	break;

	case "del":

		
		$confirma=$_REQUEST['confirma'];
		
		if ($confirma != "sim") {

			$sql = "select * from marcas_modelos_api where id = :id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){
				echo "<div class='card-header text-end topico'>";
				echo "	<a href='$link_pg'><strong>ERRO</strong></a>&nbsp;";
				echo "</div>";
				
				echo "<div class='card-body'>";
				echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
				echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
				echo "</div>";
			}else{

				$rs = $sql->fetch(PDO::FETCH_ASSOC);

				$topico=$rs['topico'];
				$topico=str_replace("´", "'",$topico);
				

				echo "<div class='card-header text-end text-uppercase topico'>";
				echo "	<a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'><strong>".$top_pagina."</strong></a>&nbsp;";
				echo "</div>";

				echo "	<div class='card-body'>";
				echo "<p class='acao'>$apagar</p>";
				?>

				<form action="<?php echo $link_pg;?>/del" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<input type="hidden" name="idioma" value="<?php echo $idioma;?>">
				<input type="hidden" name="confirma" value="sim">
				<?php 
				$mensagem="<br><br>";

				echo "	<div class='row'>";
				echo "	<div class='col-sm-12 bg-danger bco'><p class='text-center'><br><br>Favor confirmar a exclusão de<br><b>".$topico."</b><br><br></p></div>";
				echo "  </div>";

				echo "	<div class='row mt-2'>";
				echo "	<div class='col-sm-12'><p class='text-end'><a href='javascript:history.back(-1)'><button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;<button type='submit' name='submit' id='submit' class='btn btn-vermelho'><b>Confirmar Exclusão</b></button></p></div>";
				echo "	</div>";

				echo "</div>";//<!-- card-body -->"
			}

		}else{

			$id=$_POST['id'];

			$sql = "select * from marcas_modelos_api where id = :id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){
				echo "<div class='card-header text-end text-uppercase topico'>";
				echo "	<a href='$link_pg'><strong>ERRO</strong></a>&nbsp;";
				echo "</div>";
				echo "	<div class='card-body'>";
				echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
				echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
				echo "</div>";//<!-- card-body -->"
			}else{
				
				$rs = $sql->fetch(PDO::FETCH_ASSOC);
				
				$np=$rs['np'];
				
				$sql = "delete from marcas_modelos_api where id=:id and np=:np";
				$del = $conn->prepare($sql);
				$del -> bindParam(':id',$id,PDO::PARAM_INT);
				$del -> bindParam(':np',$np,PDO::PARAM_INT);
				$del -> execute();

				$sql = "select * from imagens where (id_ref=:id or id_ref=:np) and top_ref=:top_ref";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->bindParam(':np', $np, PDO::PARAM_INT);
				$sql->bindParam(':top_ref', $top_ref, PDO::PARAM_STR);
				$sql->execute();

				while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
					
					$img_db=$rs['img'];
					
					if ($img_db<>""){
						$arquivo=$diretorio."/".$img_db;		
						if( file_exists( $arquivo ) ){unlink( $arquivo );}
					}
				}

				$sql = "delete from imagens where (id_ref=:id or id_ref=:np) and top_ref=:top_ref";
				$del = $conn->prepare($sql);
				$del->bindParam(':id', $id, PDO::PARAM_INT);
				$del->bindParam(':np', $np, PDO::PARAM_INT);
				$del->bindParam(':top_ref', $top_ref, PDO::PARAM_STR);
				$del -> execute();
				
			}
			$_SESSION['msn']="del_ok";
			$url=$link_pg."/ver/".$np;
			?><script>window.location.href = "<?php echo $url;?>"</script><?php 
		}

	break;



}//fecha switch

echo "<div class='card-footer'>";
echo "";
echo "</div>";//<!-- card-footer -->"


echo "</div>";//<!-- card -->";

?>
