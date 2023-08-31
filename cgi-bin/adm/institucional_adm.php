<?php
if ($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
	die();
}

$diretorio="imagens/"; 
$acao=$var3;
$id=$var4;
	
if($acao=="ver"){
	$id_rec=$id;
	if($id_rec=="0"){$id_rec="";}
	$acao="vazio";
}

if($acao=="" or $acao=="ver"){$acao="vazio";}
	
	
$link_pg=$host."/adm/".$var2;

if($acao<>"vazio" and $acao<>"cadastrar" and $acao<>"salva" and $acao<>"edit" and $acao<>"altera" and $acao<>"del"){
	$acao="vazio";
	$pag = $var3;
	$pag = filter_var($pag, FILTER_VALIDATE_INT);
	$inicio = 0;$limite = 15;
	if ($pag!=''){$inicio = ($pag - 1) * $limite;}else{$pag=1;}
}

$msn=$var5;

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


echo "<div class='card'>";

$top_ref="institucional";
$conf_alt_p=100;
	
$top_pagina="INSTITUCIONAL";
$cadastrar="CADASTRAR";
$editar="ALTERAR";
$apagar="APAGAR";

switch ($acao){


	case "vazio":

		if($id_rec==""){
			$e_topico=$top_pagina;
			try {
				$sql = "select * from institucional where ni='0' order by ordem,id,topico";
				$sql = $conn->prepare($sql);
				$sql->execute();
			} catch(PDOException $e) {
				echo 'Erro: '.$e->getMessage();
			}

		}else{

			try {
					
				$sql = "select * from institucional where id=:id_rec";
				$sql = $conn->prepare($sql);
				$sql->bindValue(':id_rec',$id_rec, PDO::PARAM_INT);
				$sql->execute();
					
				if($sql->rowCount()==0){

					$e_topico=$top_pagina." - ERRO";
					echo "<div class='card-header text-end topico'><strong>".$e_topico."</strong>&nbsp;";
					if ($sub_top=="S" or $_SESSION['nivel']<2){
						echo "&nbsp;&nbsp;<a href='".$link_pg."/cadastrar/".$id_rec."' title='Cadastrar'><i class='fa fa-plus text-end' aria-hidden='true'></i></a>";
					}
					echo "	</div>";
        			echo "	<div class='card-body'>";
					
					echo "<p class='text-center'>NENHUM REGISTRO ENCONTRADO</p>";
					echo "<p class='text-end'><a href='".$link_pg."/ver/".$np."'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
				}else{

					$rs = $sql->fetch(PDO::FETCH_ASSOC);
					$e_topico=$rs['topico'];
					$e_topico=str_replace("´", "'",$e_topico);
					$sub_top=$rs['sub_top'];
					$np=$rs['np'];

					$e_topico="<a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'>$top_pagina</a> - ".$e_topico;
				}

					$ordem=" order by ordem,id,topico";
					

					$sql = "select * from institucional where np=:id_rec".$ordem;
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
				if ($sub_top=="S" or $_SESSION['nivel']<2 ){
					echo "&nbsp;&nbsp;<a href='".$link_pg."/cadastrar/".$id_rec."' data-toggle='tooltip' data-placement='bottom' title='Cadastra nova página'><i class='fa fa-plus text-end' aria-hidden='true'></i></a>";
				}
				echo "	</div>";
        		echo "	<div class='card-body'>";

				echo "<p class='text-center'>NENHUM REGISTRO ENCONTRADO</p>";
			}else{

				$c=0;
				while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
					$c++;
					$id=$rs['id'];
					$data=$rs['data'];
					if ($data=="0000-00-00"){
						$data = "";
					}else{
						list ($data, $hora) = explode (' ', $data);
						list ($ano, $mes, $dia) = explode ('-', $data);
						$data = $dia."/".$mes."/".$ano;
					}

					$topico=$rs['topico'];
					$topico=str_replace("´", "'",$topico);
					$sub_top=$rs['sub_top'];
					$status=$rs['status'];
					$ni=$rs['ni'];
					$np=$rs['np'];

					if($blog=="S"){//blog
						$topico=$data." - ".$topico;
					}
							
					if ($c==1){
						echo "<div class='card-header text-end topico'><a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'><strong>".$e_topico."</strong></a>&nbsp;&nbsp;";
						if ($sub_top=="S" or $_SESSION['nivel']<2){
							echo "&nbsp;&nbsp;<a href='".$link_pg."/cadastrar/".$id_rec."' data-toggle='tooltip' data-placement='bottom' title='Cadastrar nova Página'><i class='fa fa-plus text-end' aria-hidden='true'></i></a>";
						}
								
						echo "	</div>";
        				echo "	<div class='card-body'>";

						If ($aviso<>""){echo $aviso;}

						echo "<table class='table table-hover'><tbody>";
					}
					
					if ($status=="A"){echo "<tr>";}
					if ($status=="D"){echo "<tr class='bg-warning'>";}
					if ($status=="N"){echo "<tr class='bg-danger'>";}

					echo "<td align=left>".$topico."</td>";

					if ($sub_top=="S"){
						echo "<td width='5%' class='text-center'><a href='".$link_pg."/ver/".$id."' data-toggle='tooltip' data-placement='top'  title='Ver subpáginas de ".$topico."'><i class='fa fa-share-square-o' aria-hidden='true'></i></a></td>";
					}else{
						echo "<td width='5%'><div align=center>&nbsp;</div></td>";
					}

					echo "<td width='5%' class='text-center'><a href='".$link_pg."/edit/".$id."' data-toggle='tooltip' data-placement='top' title='Editar'><i class='social fa fa-pencil' aria-hidden='true'></i></a></td>";
					echo "<td width='5%' class='text-center'><a href='".$link_pg."/del/".$id."' data-toggle='tooltip' data-placement='top' title='Apagar'><i class='social fa fa-trash-o' aria-hidden='true'></i></a></td>";
					echo "</tr>";
						
				}
			}

			?>
			<tr>
			<td colspan=3></td>
			<td class='text-center'>
				<a href="#" data-toggle='tooltip' data-placement='top' title='Reordenar Tópicos' onClick="window.open('<?php echo $host_adm;?>/reordena_topicos_adm.php?np=<?php echo $np;?>&link_pg=<?php echo $link_pg;?>&tb=<?php echo $tabela;?>','Janela','toolbar=no,location=yes,directories=yes,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=580,height=600'); return false;"><i class="fa fa-random" aria-hidden="true"></i></a>
			</td></tr>
			<?php


	
			if ($ni<>"0"){

				$sql = "select * from institucional where id = :np";
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
			
			echo "</div>";//card-body


		break;



	case "cadastrar":

		if ($id<>""){
			$sql = "select * from institucional where id = :id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){
				echo "Nenhum arquivo encontrado";
			}else{

				$rs = $sql->fetch(PDO::FETCH_ASSOC);
					
				$id=$rs['id'];
				$topico=$rs['topico'];
				$topico=str_replace("´", "'",$topico);
				$sub_top=$rs['sub_top'];
				$status=$rs['status'];
				$ni=$rs['ni'];
				$np=$rs['np'];

				$e_topico="  em  ".$topico;	
			}
		}
		$topico="";
		$texto="";

		$status="A"; //ativo
		
		$volta=$link_pg."/ver/".$np;
		$sub_top="N";

		echo "<div class='card-header text-end topico text-uppercase'><strong><a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'>".$top_pagina."</a></strong>&nbsp;";
		echo "</div>";
		
		echo "<div class='card-body'>";

		echo "<p class='acao'>$cadastrar</p>";

		echo "<form method='post' action='".$link_pg."/salva' ENCTYPE='multipart/form-data' class='form-horizontal' name='formulario' id='formulario'>";

		include("form_institucional_adm.php");
		
		echo "<input type=hidden name='id' value='".$id."'>";
		echo "<input type=hidden name='ni' value='".$ni."'>";
		echo "<input type=hidden name='np' value='".$np."'>";	

		echo "</form>";
		
		echo "</div>";//<!-- card-body -->"
	break;


	case "salva":
		
		include("pega_form_institucional_adm.php");  
		
		if ($data==""){
			$data = date('Y-m-d H:i:s');
		}else{
			list ($dia, $mes,  $ano) = explode ('/', $data);
			$hora = date('H:i:s');
			$data = $ano."/".$mes."/".$dia." ".$hora;
		}

		if ($periodo_de==""){
			$periodo_de = "0000-00-00";
		}else{
			list ($dia, $mes,  $ano) = explode ('/', $periodo_de);
			$periodo_de = $ano."/".$mes."/".$dia;
		}

		if ($periodo_ate==""){
			$periodo_ate = "0000-00-00";
		}else{
			list ($dia, $mes,  $ano) = explode ('/', $periodo_ate);
			$periodo_ate = $ano."/".$mes."/".$dia;
		}

		if ($id<>""){
			$ni++;
			$np=$id;
		}


		$sql = "select * from institucional where topico=:topico and ni=:ni and np=:np";
		$sql = $conn->prepare($sql);
		$sql->bindParam(':topico', $topico, PDO::PARAM_STR);
		$sql->bindParam(':ni', $ni, PDO::PARAM_STR);
		$sql->bindParam(':np', $np, PDO::PARAM_STR);
		$sql->execute();

		if($sql->rowCount()==0){
			
			$log="insert into institucional (data,topico,sub_top,n_amigavel,ni,np,chamada,texto,periodo_de,periodo_ate,link,target,tags,usuario,video,visualizacoes,alterado,title,keywords,description,status) values ('".$data."','".$topico."','".$sub_top."','".$n_amigavel."','".$ni."','".$np."','".$chamada."','".$texto."','".$periodo_de."','".$periodo_ate."','".$link."','".$target."','".$tags."','".$usuario."','".$video."','".$visualizacoes."','".$alterado."','".$title."','".$keywords."','".$description."','".$status."')";
			//$sql2 = mysql_query($sql2) or die(mysql_error());

			$ins = $conn->prepare('insert into institucional (data,topico,sub_top,n_amigavel,ni,np,chamada,texto,periodo_de,periodo_ate,link,target,tags,usuario,video,visualizacoes,alterado,title,keywords,description,status) values (:data,:topico,:sub_top,:n_amigavel,:ni,:np,:chamada,:texto,:periodo_de,:periodo_ate,:link,:target,:tags,:usuario,:video,:visualizacoes,:alterado,:title,:keywords,:description,:status)');
			$ins -> bindParam(':data',$data,PDO::PARAM_STR);
			$ins -> bindParam(':topico',$topico,PDO::PARAM_STR);
			$ins -> bindParam(':sub_top',$sub_top,PDO::PARAM_STR);
			$ins -> bindParam(':n_amigavel',$n_amigavel,PDO::PARAM_STR);
			$ins -> bindParam(':ni',$ni,PDO::PARAM_STR);
			$ins -> bindParam(':np',$np,PDO::PARAM_STR);
			$ins -> bindParam(':chamada',$chamada,PDO::PARAM_STR);
			$ins -> bindParam(':texto',$texto,PDO::PARAM_STR);
			$ins -> bindParam(':periodo_de',$periodo_de,PDO::PARAM_STR);
			$ins -> bindParam(':periodo_ate',$periodo_ate,PDO::PARAM_STR);
			$ins -> bindParam(':link',$link,PDO::PARAM_STR);
			$ins -> bindParam(':target',$target,PDO::PARAM_STR);
			$ins -> bindParam(':tags',$tags,PDO::PARAM_STR);
			$ins -> bindParam(':usuario',$usuario,PDO::PARAM_STR);
			$ins -> bindParam(':video',$video,PDO::PARAM_STR);
			$ins -> bindParam(':visualizacoes',$visualizacoes,PDO::PARAM_STR);
			$ins -> bindParam(':alterado',$alterado,PDO::PARAM_STR);
			$ins -> bindParam(':title',$title,PDO::PARAM_STR);
			$ins -> bindParam(':keywords',$keywords,PDO::PARAM_STR);
			$ins -> bindParam(':description',$description,PDO::PARAM_STR);
			$ins -> bindParam(':status',$status,PDO::PARAM_STR);

			$ins -> execute();

			$sql = "select * from institucional where topico=:topico and ni=:ni and np=:np";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':topico', $topico, PDO::PARAM_STR);
			$sql->bindParam(':ni', $ni, PDO::PARAM_STR);
			$sql->bindParam(':np', $np, PDO::PARAM_STR);
			$sql->execute();
			
			if($sql->rowCount() > 0){
					
				$rs = $sql->fetch(PDO::FETCH_ASSOC);
				$id=$rs['id'];
				$ni=$rs['ni'];
				$np=$rs['np'];

				include("salva_up.php");

				if ($erro != ""){
					echo "<div class='bg-danger text-center'><b>Houve erro(s) ao carregar o(s) arquivo(s).<br><a href=javascript:history.back(-1)>Voltar</a></b></div>";
				}else{

					$id=$np;
						
					$url=$link_pg."/ver/".$id."/cad_ok";
					?><script>window.location.href = "<?php echo $url;?>"</script><?php 
				} 
			}else{
				echo "<div class='card-header text-end topico'>";
				echo "	<strong>ERRO</strong>&nbsp;";
				echo "</div>";
				echo "<div class='bg-danger text-center'><b>Houve erro(s) ao carregar o(s) arquivo(s).<br><a href=javascript:history.back(-1)>Voltar</a></b></div>";		
			}

		}else{
			
			echo "<div class='card-header text-end topico'>";
			echo "	<strong>ERRO</strong>&nbsp;";
			echo "</div>";
			echo "<div class='bg-danger text-center'>Já existe um registro com este nome.<br><a href=javascript:history.back(-1)>Voltar</a></div>";
			//limpa_imagem_sessao();
		}

	break;

	case "edit":
		
		//$id=$_REQUEST['id'];

		$sql = "select * from institucional where id=:id";
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
			
			include("pega_institucional_adm.php");

			if ($data=="0000-00-00"){
				$data = "";
			}else{
				list ($data, $hora) = explode (' ', $data);
				list ($ano, $mes, $dia) = explode ('-', $data);
				$data = $dia."/".$mes."/".$ano;
			}

			if ($periodo_de=="0000-00-00"){
				$periodo_de = "";
			}else{
				list ($ano, $mes, $dia) = explode ('-', $periodo_de);
				$periodo_de = $dia."/".$mes."/".$ano;
			}

			if ($periodo_ate=="0000-00-00"){
				$periodo_ate = "";
			}else{
				list ($ano, $mes, $dia) = explode ('-', $periodo_ate);
				$periodo_ate = $dia."/".$mes."/".$ano;
			}
										

	
			echo "<div class='card-header text-end topico'>";
			echo "	<a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'><strong>".$top_pagina."</strong></a>&nbsp;";
			echo "</div><!-- card-header -->";
			
			If ($aviso<>""){echo $aviso;}

			$volta=$link_pg."/ver/".$np;
			echo "<div class='card-body'>";
			echo "<p class='acao'>$editar</p>";
			?>
			<form method=post action='<?php echo $link_pg;?>/altera' ENCTYPE="multipart/form-data" name="formulario" id="formulario">			  
			  <?php include("form_institucional_adm.php");?>
			  <input type="hidden" name="id" value="<?php echo $id;?>">
			  <input type="hidden" name="ni" value="<?php echo $ni;?>">
			  <input type="hidden" name="np" value="<?php echo $np;?>">
			  <input type="hidden" name="idioma" value="<?php echo $idioma;?>">
			</form>
			<?php 
			echo "</div>";//<!-- card-body -->"
			
		}

	break;

	case "altera":

		include("pega_form_institucional_adm.php");

		//echo "ID=$id<br>";
		$agora = date('Y-m-d H:i:s');

		if ($data==""){
			$data = date('Y-m-d H:i:s');
		}else{
			list ($dia, $mes,  $ano) = explode ('/', $data);
			$hora = date('H:i:s');
			$data = $ano."-".$mes."-".$dia." ".$hora;
		}

		if ($periodo_de==""){
			$periodo_de = "0000-00-00";
		}else{
			list ($dia, $mes,  $ano) = explode ('/', $periodo_de);
			$periodo_de = $ano."-".$mes."-".$dia;
		}

		if ($periodo_ate==""){
			$periodo_ate = "0000-00-00";
		}else{
			list ($dia, $mes,  $ano) = explode ('/', $periodo_ate);
			$periodo_ate = $ano."-".$mes."-".$dia;
		}

		$sql = "select * from institucional where id = :id";
		$sql = $conn->prepare($sql);
		$sql->bindParam(':id',$id, PDO::PARAM_INT);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "<div class='card-header text-end topico'>";
			echo "	<a href='$link_pg'><strong>ERRO</strong></a>&nbsp;";
			echo "</div>";
			echo "	<div class='card-body'>";
			echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
			echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
			echo "</div>";
		}else{

			$rs = $sql->fetch(PDO::FETCH_ASSOC);
			$np=$rs['np'];

			$sql = "select * from institucional where n_amigavel=:n_amigavel and ni=:ni and np=:np and id<>:id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':n_amigavel', $n_amigavel, PDO::PARAM_STR);
			$sql->bindParam(':ni', $ni, PDO::PARAM_INT);
			$sql->bindParam(':np', $np, PDO::PARAM_INT);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){

				try {

					/*
					$sql = "update institucional set  topico='".$topico."',sub_top='".$sub_top."',n_amigavel='".$n_amigavel."',chamada='".$chamada."',texto='".$texto."',periodo_de='".$periodo_de."',periodo_ate='".$periodo_ate."',link='".$link."',target='".$target."',tags='".$tags."',usuario='".$usuario."',video='".$video."',alterado='".$agora."',title='".$title."',keywords='".$keywords."',description='".$description."',status='".$status."' where id='".$id."'";
					echo $sql."<hr>";
					*/
					
					$sql = "update institucional set  topico=:topico,sub_top=:sub_top,n_amigavel=:n_amigavel,chamada=:chamada,texto=:texto,periodo_de=:periodo_de,periodo_ate=:periodo_ate,link=:link,target=:target,tags=:tags,usuario=:usuario,video=:video,alterado=:alterado,title=:title,keywords=:keywords,description=:description,status=:status where id=:id";

					$up = $conn->prepare($sql);
					$up -> bindParam(':topico',$topico,PDO::PARAM_STR);
					$up -> bindParam(':sub_top',$sub_top,PDO::PARAM_STR);
					$up -> bindParam(':n_amigavel',$n_amigavel,PDO::PARAM_STR);
					$up -> bindParam(':chamada',$chamada,PDO::PARAM_STR);
					$up -> bindParam(':texto',$texto,PDO::PARAM_STR);
					$up -> bindParam(':periodo_de',$periodo_de,PDO::PARAM_STR);
					$up -> bindParam(':periodo_ate',$periodo_ate,PDO::PARAM_STR);
					$up -> bindParam(':link',$link,PDO::PARAM_STR);
					$up -> bindParam(':target',$target,PDO::PARAM_STR);
					$up -> bindParam(':tags',$tags,PDO::PARAM_STR);
					$up -> bindParam(':usuario',$usuario,PDO::PARAM_STR);
					$up -> bindParam(':video',$video,PDO::PARAM_STR);
					$up -> bindParam(':alterado',$agora,PDO::PARAM_STR);
					$up -> bindParam(':title',$title,PDO::PARAM_STR);
					$up -> bindParam(':keywords',$keywords,PDO::PARAM_STR);
					$up -> bindParam(':description',$description,PDO::PARAM_STR);
					$up -> bindParam(':status',$status,PDO::PARAM_STR);
					$up -> bindParam(':id',$id,PDO::PARAM_INT);
					$up -> execute();

				}catch(PDOException $e) {
				  echo 'Erro: '.$e->getMessage();
				  $erro="deu_merda";
				}

				include("salva_up.php");

				if ($erro != ""){
					echo "<div id='alerta'><b>Erro(s) ao carregar o(s) arquivo(s).<br><a href=javascript:history.back(-1)>Voltar</a></b></div>";
				}else{
					//if ($ni > 0) {$id=$np;}
					
					$url=$link_pg."/edit/".$id."/alt_ok";
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

			$sql = "select * from institucional where id = :id";
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

			$sql = "select * from institucional where id = :id";
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
				
				$sql = "delete from institucional where id=:id";
				$del = $conn->prepare($sql);
				$del -> bindParam(':id',$id,PDO::PARAM_INT);
				$del -> execute();

				$sql = "select * from imagens where id_ref=:id and top_ref=:top_ref";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->bindParam(':top_ref', $top_ref, PDO::PARAM_STR);
				$sql->execute();

				while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
					
					$img_db=$rs['img'];
					
					if ($img_db<>""){
						$arquivo=$diretorio."/".$img_db;		
						if( file_exists( $arquivo ) ){unlink( $arquivo );}
					}
				}

				$sql = "delete from imagens where id_ref=:id and top_ref=:top_ref";
				$del = $conn->prepare($sql);
				$del->bindParam(':id', $id, PDO::PARAM_INT);
				$del->bindParam(':top_ref', $top_ref, PDO::PARAM_STR);
				$del -> execute();
				
			}

			$url=$link_pg."/ver/".$np."/del_ok";
			?><script>window.location.href = "<?php echo $url;?>"</script><?php 
		}

	break;



}//fecha switch

echo "<div class='card-footer'>";
echo "";
echo "</div>";//<!-- card-footer -->"


echo "</div>";//<!-- card -->";

?>
