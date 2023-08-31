<?php
if ($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
}

$tabela="blog_assuntos";

$top_ref="blog_assuntos";
$conf_alt_p=100;

$nro_depto_loja=0;//nro de subtópicos
$depto_menu=1;// id na tabela tipos
$p_negrito="S";

$acao=$var3;
list ($acao,$tipo) = explode ('-', $var3);

$id=$var4;
list ($id,$ni,$np) = explode ('-', $var4);
$id_ref=$id;

if($acao=="" or $acao=="msg"){$acao="vazio";}

$link_pg=$host_adm."/".$var2;

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

$topico=$_REQUEST['topico'];

$top_pagina="TOPICOS";
$cadastrar="CADASTRAR";
$editar="ALTERAR";
$apagar="APAGAR";

$nome_0="Tópico";$escreve_0="Novo ".$nome_0;
If ($ni_escreve==1){$nome_1="Tópico";$escreve_1="Novo ".$nome_1;}
If ($ni_escreve==2){$nome_2="......";$escreve_2="Novo ".$nome_2." em ".$topico;}
If ($ni_escreve==3){$nome_3="......";$escreve_3="Novo ".$nome_3." em ".$topico;}


echo "<div class='card'>";

echo "	<div class='card-header text-end topico'>";
echo "		<strong><a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'>$top_pagina</a></strong>&nbsp;&nbsp;";
if ($permissao_cad_blog_assuntos=="S"){
	echo "<a href='".$link_pg."/cadastrar' data-toggle='tooltip' data-placement='bottom' title='Cadastrar'><i class='fa fa-plus' aria-hidden='true'></i></a>";
}	
echo "  </div>";

echo "	<div class='card-body'>";

switch ($acao){

	Case "vazio":
		If ($aviso<>""){echo $aviso;}
		echo "<table class='table table-bordered table-hover'><tbody>";
			include("corre_blog_assuntos.php");
		echo "<tr><td colspan=4></td></tr></tbody></table>";
	break;

	case "cadastrar":

		if($id==""){
			$ni=1;
			$np=$depto_menu;
			$ni_escreve=$ni;
		}else{
			$np=$id;
			$ni_escreve=$ni+1;
			$sub_top=$id;
		}

		If ($ni_escreve==1){$nome=$nome_1;$escreve=$escreve_1;}
		If ($ni_escreve==2){$nome=$nome_2;$escreve=$escreve_2;}
		If ($ni_escreve==3){$nome=$nome_3;$escreve=$escreve_3;}

		If ($nome==""){$nome=$nome_0;$escreve=$escreve_0;}

		$ativo="S";
		$topico="";
		$tipo="salva";
		$status="S";

		$acao_form=$link_pg."/salva";
		
		If ($topico=="Home"){$dis="disabled";}

		$volta=$link_pg;

		?>
		<form method="post" action="<?php echo $acao_form;?>" class="form-horizontal" ENCTYPE="multipart/form-data" name="formulario" id="formulario">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="hidden" name="ni" value="<?php echo $ni;?>">
			<input type="hidden" name="np" value="<?php echo $np;?>">
			<input type="hidden" name="sub_top" value="<?php echo $sub_top;?>">
			
			<? echo "<p class='acao'>$cadastrar</p>";?>

			<div class="row">
				<div class="col-sm-1 col-form-label"><b>&nbsp;<?php echo $nome;?></b></div>
				<div class="col-sm-5"><input type="text" class="form-control" name="topico" id="topico" value="<?php echo $topico;?>" required/></div>
				<div class="col-sm-6 col-form-label">Ativo&nbsp;<input type="checkbox" name="status" id="status" value="<?php echo $status;?>" <?php If ($status=="S"){echo " checked";}?> <?php echo $dis;?>>&nbsp;&nbsp;</div>
			</div>
			<div class='row'>
				<div class='col-sm-12'>
					<p class='text-end'><a href='<?=$volta;?>'>
					<button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;
					<button type='submit' name='submit' id='submit' class='btn btn-default btn-outline-secondary'><b>Enviar</b></button>
					</p>
				</div>
			</div>
		</form>
		<?php

		
	break;
	
	Case "salva":

		$id=$_POST['id'];
		$topico=$_POST['topico'];
		$n_amigavel=url_amigavel($topico);
		$texto=$_POST['chamada'];
		$ni=$_POST['ni'];
		$np=$_POST['np'];
		$title=$_POST['title'];
		$keywords=$_POST['keywords'];
		$description=$_POST['description'];
		$status=$_POST['status'];

		if($id==""){
			$ni=1;
			$np=$depto_menu;
		}else{
			$ni=$ni+1;
			$np=$id;
		}

		if ($status==""){$status="N";}else{$status="S";}
		If (trim($topico)<>""){$topico=str_replace("'","´",$topico);}	
		If (trim($texto)<>""){$texto=str_replace("'","´",$texto);}
		
		If ($title<>""){$title=str_replace("'","´",$title);}
		If ($keywords<>""){$keywords=str_replace("'","´",$keywords);}
		If ($description<>""){$description=str_replace("'","´",$description);}

		$sql = "select * from $tabela where topico=:topico and ni=:ni and np=:np";
		$sql = $conn->prepare($sql);
		$sql->bindParam(':topico', $topico, PDO::PARAM_STR);
		$sql->bindParam(':ni', $ni, PDO::PARAM_INT);
		$sql->bindParam(':np', $np, PDO::PARAM_INT);
		$sql->execute();

		if($sql->rowCount()==0){

			$log="insert into $tabela (topico,n_amigavel,ni,np,texto,title,keywords,description,status) values ('".$topico."','".$n_amigavel."','".$ni."','".$np."','".$texto."','".$title."','".$keywords."','".$description."','".$status."')";
			
			$sql="insert into $tabela (topico,n_amigavel,ni,np,texto,title,keywords,description,status) values (:topico,:n_amigavel,:ni,:np,:texto,:title,:keywords,:description,:status)";
			$ins = $conn->prepare($sql);
			$ins -> bindParam(':topico',$topico,PDO::PARAM_STR);
			$ins -> bindParam(':n_amigavel',$n_amigavel,PDO::PARAM_STR);
			$ins -> bindParam(':ni',$ni,PDO::PARAM_STR);
			$ins -> bindParam(':np',$np,PDO::PARAM_STR);
			$ins -> bindParam(':texto',$texto,PDO::PARAM_STR);
			$ins -> bindParam(':title',$title,PDO::PARAM_STR);
			$ins -> bindParam(':keywords',$keywords,PDO::PARAM_STR);
			$ins -> bindParam(':description',$description,PDO::PARAM_STR);
			$ins -> bindParam(':status',$status,PDO::PARAM_STR);
			$ins -> execute();
			

			$sql = "select * from $tabela where topico=:topico and ni=:ni and np=:np";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':topico', $topico, PDO::PARAM_STR);
			$sql->bindParam(':ni', $ni, PDO::PARAM_INT);
			$sql->bindParam(':np', $np, PDO::PARAM_INT);
			$sql->execute();

			$rs = $sql->fetch(PDO::FETCH_ASSOC);

			$id=$rs['id'];
			$id_ref=$id;
			
			if ($grava_log=="S"){grava_log('insert',$id,'tipos',$log);}
			//include("salva_up.php");

			$url=$link_pg."/msg/".$id."-".$ni."-".$np."/cad_ok";
			?><script>window.location.href = "<?php echo $url;?>"</script><?php
		
		}else{

			echo "<p class='text-center'><BR><BR><BR>Já existe um registro com este nome.</p>";

		}
	break;

	case "edit":

		If ($aviso<>""){echo $aviso;}

		$log = "select * from $tabela where id='".$id."' and ni='".$ni."' and np='".$np."'";


		$sql = "select * from $tabela where id=:id and ni=:ni and np=:np";
		$sql = $conn->prepare($sql);
		$sql->bindParam(':id', $id, PDO::PARAM_INT);
		$sql->bindParam(':ni', $ni, PDO::PARAM_INT);
		$sql->bindParam(':np', $np, PDO::PARAM_INT);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "<p class='bg-danger text-center'>Nenhum registro encontrado</p>";
		}else{
			$rs = $sql->fetch(PDO::FETCH_ASSOC);

			$id=$rs['id'];        
			$ordem=$rs['ordem'];
			$topico=$rs['topico'];
			$n_amigavel=$rs['n_amigavel'];
			$texto=$rs['texto'];
			$ni=$rs['ni'];
			$np=$rs['np'];
			$title=$rs['title'];
			$keywords=$rs['keywords'];
			$description=$rs['description'];
			$status=$rs['status'];

			if ($grava_log=="S"){grava_log('editou',$id,'tipos',$log);}
				
			$id_ref=$id;
			$ni_escreve=$rs['ni'];
			$np_ref=$rs['np'];
				
			If ($topico<>""){$topico_1=str_replace("´","'",$topico);}
			If ($texto<>""){$texto_1=str_replace("´","'",$texto);}
			If ($title<>""){$title=str_replace("´","'",$title);}
			If ($keywords<>""){$keywords=str_replace("´","'",$keywords);}
			If ($description<>""){$description=str_replace("´","'",$description);}

			If ($ni_escreve==1){$nome=$nome_1;$escreve=$escreve_1;}
			If ($ni_escreve==2){$nome=$nome_2;$escreve=$escreve_2;}
			If ($ni_escreve==3){$nome=$nome_3;$escreve=$escreve_3;}

			If ($nome==""){$nome=$nome_0;$escreve=$escreve_0;}


			$acao_form=$link_pg."/alterar";
			$volta=$link_pg;

			If ($conf_alt_p==""){$conf_alt_p=50;}
			If ($topico=="Home"){$dis="disabled";}
			
			//if ($_REQUEST['tipo']=="novo" or ($ni=="0" and $tipo=="alterar")){$desc_img="S";}
			$f_desc="N";
			$f_img="S";
			?>
			<form method="post" action="<?php echo $acao_form;?>" class="form-horizontal" ENCTYPE="multipart/form-data" name="formulario" id="formulario">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<input type="hidden" name="ni" value="<?php echo $ni;?>">
				<input type="hidden" name="np" value="<?php echo $np;?>">
				<input type="hidden" name="sub_top" value="<?php echo $sub_top;?>">
				
				<? echo "<p class='acao'>$editar - ".mb_strtoupper($topico)."</p>";?>

				<div class="row">
					<div class="col-sm-1 col-form-label"><b><?php echo $nome;?></b></div>
					<div class="col-sm-5"><input type="text" class="form-control" name="topico" id="topico" value="<?php echo $topico;?>" validate="{required:true, messages:{required:'Favor preencher o nome'}}"/></div>
					<div class="col-sm-6 col-form-label" style='text-align:left;'>Ativo&nbsp;<input type="checkbox" name="status" id="status" value="<?php echo $status;?>" <?php If ($status=="S"){echo " checked";}?> <?php echo $dis;?>>&nbsp;&nbsp;</div>
				</div>
				<div class='row'> 
					<div class='col-sm-12'>
						<p class='text-end'><a href='<?=$volta;?>'>
						<button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;
						<button type='submit' name='submit' id='submit' class='btn btn-default btn-outline-secondary'><b>Enviar</b></button>
						</p>
					</div>
				</div>
			</form>
		<?php
		}
	break;


	case "alterar":

		$id=$_POST['id'];
		$ordem=$_POST['ordem'];
		$topico=$_POST['topico'];
		$e_topico=$topico;
		$n_amigavel=url_amigavel($topico);
		$texto=$_POST['chamada'];
		$ni=$_POST['ni'];
		$np=$_POST['np'];
		$title=$_POST['title'];
		$keywords=$_POST['keywords'];
		$description=$_POST['description'];
		$status=$_POST['status'];
		

		if ($np==""){$np="0";}
		if ($ni==""){$ni="0";}

		if ($status==""){$status="N";}else{$status="S";}

		$sub_top=$_POST['sub_top'];

		If ($sub_top<>"" And $sub_top==$id){$ni=$ni+1;$np=$id;} 

		If (trim($topico)<>""){$topico=str_replace("'","´",$topico);}	
		If (trim($texto)<>""){$texto=str_replace("'","´",$texto);}
		
		If ($title<>""){$title=str_replace("'","´",$title);}
		If ($keywords<>""){$keywords=str_replace("'","´",$keywords);}
		If ($description<>""){$description=str_replace("'","´",$description);}

		$sql = "select * from $tabela where ni='$ni' and np='$np' and topico='$topico' and id<>'$id'";
		$sql = $conn->prepare($sql);
		$sql->execute();
		
		if($sql->rowCount()<>0){
			echo "<p class='xbg-danger text-center'>Já existe um registro com este nome ($e_topico).<br><br><a href='javascript:history.back(1)'>Voltar</p>";
		}else{
			
			$sql = "select * from $tabela where id=:id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){
				echo "<p class='bg-danger text-center'>Nenhum registro encontrado.<br><br><a href='javascript:history.back(1)'>Voltar</p>";
			}else{

				$log = "update $tabela SET topico='".$topico."',n_amigavel='".$n_amigavel."',ni='".$ni."',np='".$np."',texto='".$texto."',title='".$title."',keywords='".$keywords."',description='".$description."',status='".$status."' where id='".$id."'";
				
				$sql="update $tabela set topico=:topico,n_amigavel=:n_amigavel,ni=:ni,np=:np,texto=:texto,title=:title,keywords=:keywords,description=:description,status=:status where id=:id";
				$up = $conn->prepare($sql);
				$up -> bindParam(':topico',$topico,PDO::PARAM_STR);
				$up -> bindParam(':n_amigavel',$n_amigavel,PDO::PARAM_STR);
				$up -> bindParam(':ni',$ni,PDO::PARAM_STR);
				$up -> bindParam(':np',$np,PDO::PARAM_STR);
				$up -> bindParam(':texto',$texto,PDO::PARAM_STR);
				$up -> bindParam(':title',$title,PDO::PARAM_STR);
				$up -> bindParam(':keywords',$keywords,PDO::PARAM_STR);
				$up -> bindParam(':description',$description,PDO::PARAM_STR);
				$up -> bindParam(':status',$status,PDO::PARAM_STR);
				$up -> bindParam(':id',$id,PDO::PARAM_INT);
				$up -> execute();
				
				if ($grava_log=="S"){grava_log('update',$id,'tipos',$log);}
				//include("salva_up.php");

				$url=$link_pg."/msg/".$id."-".$ni."-".$np."/alt_ok";
				?><script>window.location.href = "<?php echo $url;?>"</script><?php
			}
		}

	break;


	case "del":
		
		$confirma=$_REQUEST['confirma'];
		
		if ($confirma != "sim") {

			$sql = "select * from $tabela where id = :id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){
				
				echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
				echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
				
			}else{

				$rs = $sql->fetch(PDO::FETCH_ASSOC);

				$topico=$rs['topico'];
				$topico=str_replace("´", "'",$topico);
				
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

			}

		}else{

			$id=$_POST['id'];

			$sql = "select * from $tabela where id = :id";
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
				
				$sql = "delete from $tabela where id=:id";
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

			$url=$link_pg."/msg/".$np."-".$ni."-".$np."/del_ok";
			?><script>window.location.href = "<?php echo $url;?>"</script><?php 
		}
	
	break;

}//fecha switch

echo "</div>"; //<!-- card-body -->"

echo "<div class='card-footer'>";
echo "";
echo "</div>";//<!-- card-footer -->"
echo "</div>";//<!-- card -->";
