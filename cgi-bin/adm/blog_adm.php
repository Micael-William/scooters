<?php
if($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
	die();
}


$link_pg=$host."/adm/".$var2;

$uf="";
$pg="blog";
$top_ref="blog";

$acao=$var3;
$id=$var4;

if($acao==""){$acao="vazio";}
$id_cli=$var4;


if($acao<>"vazio" and $acao<>"cadastrar" and $acao<>"salva" and $acao<>"edit" and $acao<>"altera" and $acao<>"del"){
	$acao="vazio";
	$pag = $var3;
	$pag = filter_var($pag, FILTER_VALIDATE_INT);
	$inicio = 0;$limite = 10;
	if ($pag!=''){$inicio = ($pag - 1) * $limite;}else{$pag=1;}
}


$msn=$_SESSION['msn'];

If ($msn=="cad_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Cadastro efetuado com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
	$aviso.="</div>";
} 
		
If ($msn=="alt_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Alteração efetuada com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
	$aviso.="</div>";
}

If ($msn=="alt_erro"){
	$aviso="<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Não foi possível encontrar o registro.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
	$aviso.="</div>";
}

If ($msn=="del_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Registro apagado com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
	$aviso.="</div>";
} 


$_SESSION['msn']=""; 

$top_pagina="BLOG";
$cadastrar="CADASTRAR";
$editar="ALTERAR";
$apagar="APAGAR";


echo "<div class='card'>";

echo "<div class='card-header text-end topico'>";
echo "	<strong><a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'>$top_pagina</a></strong>&nbsp;&nbsp;";
if ($permissao_cad_blog=="S"){
	echo "<a href='".$link_pg."/cadastrar' data-toggle='tooltip' data-placement='bottom' title='Cadastrar'><i class='fa fa-plus' aria-hidden='true'></i></a>";
}	
echo "  </div>";

$filtro=$_REQUEST['status'];
if($filtro==""){
	$status='15';
}else{
	$status=$_REQUEST['status'];
}

echo "<div class='top_pesquisa'>";
echo "	<div class='row'>";
echo "		<div class='col-sm-9'>";
echo "			<form method=post action='".$link_pg."/edit' name='form_blog' id='form_blog' class='navbar-form' role='search'>";
echo "			<div class='input-group'>";
echo "					<input type='text' class='form-control' name='p_blog' id='p_blog' value='' required><div class='loader' id='loaderAgrnda' style='display:none;top: 23px;'></div><input type='hidden' name='id_blog' id='id_blog' value=''>";
echo "				<div class='input-group-prepend'>";
echo "					<button class='btn btn-ico_busca' type='submit'><i class='fa fa-search' aria-hidden='true'></i></button>";
echo "				</div>";
echo "			</div>";
echo "			</form>";
echo "		</div>";
echo "		<div class='col-sm-3'>";
echo "			<form method=post action='".$link_pg."' name='filtro' id='filtro' class='navbar-form' role='search'>";
echo "			<div class='input-group'>";
echo "				<select class='form-control' id='status' name='status' required>";
echo "					<option value=''>Selecione</option>";
echo "					<option value='T' ".$selected.">Todos</option>";
echo "					<option value='A' ".$selected.">Anterior</option>";
echo "					<option value='P' ".$selected.">Próximos</option>";
echo "				</select>";
echo "				<div class='input-group-prepend'>";
echo "					<button class='btn btn-ico_busca' type='submit'><i class='fa fa-search' aria-hidden='true'></i></button>";
echo "				</div>";
echo "			</div>";
echo "			</form>";
echo "		</div>";
echo "	</div>";
echo "</div>";

echo "	<div class='card-body'>";

//echo "Ação:$acao";

	switch ($acao){

		Case "vazio":
			
			if($_REQUEST['status']==""){
				if($_SESSION['status_blog']==""){
					$status='P';
					$e_filtro="P";
				}else{
					$status=$_SESSION['status_blog'];
					$e_filtro=$status;
				}	
			}

			if($_REQUEST['status']<>""){
				$status=$_REQUEST['status'];
				$_SESSION['status_blog']=$status;
				$e_filtro=$_REQUEST['status'];
			}

			

			if ($permissao_edit_blog<>"S"){
				echo "<p class='bg text-center'>Você não tem permissão para acessar esta área</p>";
			}else{

				$hoje=date('d-m-Y');
				$agora=date('H:i');

				If ($aviso<>""){echo $aviso;}

				echo "<table class='table table-hover'><tbody>";
				if($status=="T"){
					$sql="select * from blog order by data desc limit ".$inicio.", ".$limite;
					$n_reg="select count(*) as total from blog";
				}

				if($status=="A"){
					$sql="select * from blog where data <= '$hoje' order by data desc limit ".$inicio.", ".$limite;
					$n_reg="select count(*) as total from blog where data <= '$hoje'";
				}

				if($status=="P"){
					$sql="select * from blog where data >= '$hoje' order by data desc limit ".$inicio.", ".$limite;
					$n_reg="select count(*) as total from blog where data <= '$hoje'";
				}


				$sql="select * from blog order by data desc limit ".$inicio.", ".$limite;
				$n_reg="select count(*) as total from blog";


				$sql = $conn->prepare($sql);
				$sql->bindParam(':status', $status, PDO::PARAM_INT);
				$sql->execute();
				

				$n_reg = $conn->prepare($n_reg);
				$n_reg->bindParam(':status', $status, PDO::PARAM_INT);
				$n_reg->execute();

				$total = $n_reg->fetch(PDO::FETCH_ASSOC);
				$total = $total['total'];

				$prox = $pag + 1;
				$ant = $pag - 1;
				$ultima_pag = ceil($total / $limite);
				$penultima = $ultima_pag - 1;  
				$adjacentes = 2;

				if($sql->rowCount()==0){

					echo "<tr>";
					echo "<td>";
					echo "<p class='text-center'><br><br><b>Nenhum registro encontrado<br><br>";
					//echo "<a href='javascript:history.back(1)'>Voltar</p>";
					echo "</td>";
					echo "</tr>";

				}else{

					echo "<tr>";
					echo "<td width='5%' class='text-center'><b>Data</b></td>";
					//echo "<td width='5%' class='text-center'><b>Horário</b></td>";
					//echo "<td><b>Evento</b></td>";
					echo "<td colspan='3'><b>Título</b></td>";
					echo "</tr>";

					while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
						$id=$rs['id'];
						$data=$rs['data'];
						$inicio=$rs['inicio'];
						$fim=$rs['fim'];
						$titulo=$rs['titulo'];
						$local=$rs['local'];

                        list ($ano, $mes, $dia) = explode ('-', $data);
                        $data=$dia."/".$mes."/".$ano;
						
						list ($hi, $mi, $si) = explode (':', $inicio);

						$horario=$hi.":".$mi;
						if($fim<>"00:00:00"){
							list ($hf, $mf, $sf) = explode (':', $fim);
							$horario.=" - ".$hf.":".$mf;
						}

						
						echo "<tr>";
						echo "<td><a href='".$link_pg."/edit/".$id."'>".$data."</a></td>";
						//echo "<td><a href='".$link_pg."/edit/".$id."'>".$horario."</a></td>";
						echo "<td><a href='".$link_pg."/edit/".$id."'>".$titulo."</a></td>";
						//echo "<td><a href='".$link_pg."/edit/".$id."'>".$local."</a></td>";
						echo "<td width='5%' class='text-center'><a href='".$link_pg."/edit/".$id."' data-toggle='tooltip' data-placement='top' title='Ver/Editar'><i class='fa fa-pencil'></i></a></td>";
						echo "<td width='5%' class='text-center'><a href='".$link_pg."/del/".$id."' data-toggle='tooltip' data-placement='top' title='Apagar'><i class='fa fa-trash-o'></i></a></td>";
			
						echo "</tr>";
					}
				}

				$pagina_atual=$link_pg;

				echo "</tbody></table>";

				if ($ultima_pag>1){
					echo "<div class='text-end'>";
					include("paginacao.php");
					echo "</div>";
				}

			}
		break;


		Case "cadastrar":

            $acao_form=$link_pg."/salva";
			echo "<p class='acao'>$cadastrar</p>";
			
			$data="";
			$status="A";

            $data = date('d/m/Y');
            $hora = date('H:i');

			if ($permissao_cad_blog<>"S"){
				echo "<p class='bg text-center txt-18'>Você não tem permissão para cadastrar</p>";
			}else{
				include("form_blog_adm.php");
			}

		break;
 
		Case "salva": 
			
			if ($permissao_cad_blog<>"S"){
				echo "<p class='bg text-center'>Você não tem permissão para cadastrar</p>";
			}else{
				include("pega_form_blog_adm.php");

				$criacao = date('Y-m-s H:i:s');
				
				if ($data<>""){
					list ($dia,$mes,$ano) = explode ('/', $data);
					$data=$ano."-".$mes."-".$dia;
				}else{
					$data="0000-00-00";
				}

				$status="A";

				$chave=Sorteia(10).date('YmdHis').$ip;

				$sql='insert into blog (criacao,data,hora,assunto,titulo,n_amigavel,chamada,descricao,layout,ordem,title,keywords,description,status) values (:criacao,:data,:hora,:assunto,:titulo,:n_amigavel,:chamada,:descricao,:layout,:ordem,:title,:keywords,:description,:status)';

				$ins = $conn->prepare($sql);
				$ins -> bindParam(':criacao',$criacao,PDO::PARAM_STR);
				$ins -> bindParam(':data',$data,PDO::PARAM_STR);
				$ins -> bindParam(':hora',$hora,PDO::PARAM_STR);
				$ins -> bindParam(':assunto',$assunto,PDO::PARAM_STR);
				$ins -> bindParam(':titulo',$titulo,PDO::PARAM_STR);
				$ins -> bindParam(':n_amigavel',$n_amigavel,PDO::PARAM_STR);
				$ins -> bindParam(':chamada',$chamada,PDO::PARAM_STR);
				$ins -> bindParam(':descricao',$descricao,PDO::PARAM_STR);
				$ins -> bindParam(':layout',$layout,PDO::PARAM_STR);
				$ins -> bindParam(':ordem',$ordem,PDO::PARAM_STR);
				$ins -> bindParam(':title',$title,PDO::PARAM_STR);
				$ins -> bindParam(':keywords',$chave,PDO::PARAM_STR);
				$ins -> bindParam(':description',$description,PDO::PARAM_STR);
				$ins -> bindParam(':status',$status,PDO::PARAM_STR);
				$ins -> execute();

				$sql="select * from blog where keywords='$chave'";
				//echo "<br>$sql<br>";
				$sql = $conn->prepare($sql);
				$sql->execute();
				if($sql->rowCount()==0){
					echo "Erro. Não foi possível recuperar o registro";
				}else{
							
					$rs = $sql->fetch(PDO::FETCH_ASSOC);
					$id=$rs['id'];
							
					$sql_up="update blog set keywords='$keywords' where id='$id'";
					$up = $conn->prepare($sql_up);
					$up -> execute();

                    include("salva_up.php");
					
					$_SESSION['msn']="cad_ok";
					$url=$link_pg."/edit/".$id;
					?><script>window.location.href = "<?php echo $url;?>"</script><?php
							
				}
			
			}
	
		break;

		Case "edit":

			if ($permissao_edit_cli<>"S"){
				echo "<p class='bg text-center'>Você não tem permissão para editar</p>";
			}else{

				$acao_form=$link_pg."/altera";

				if($id==""){
					$id=$_POST['id'];
					$id=$id;
				}

			
				$sql = "select * from blog where id=:id";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_STR);
				$sql->execute();

				if($sql->rowCount()>0){
					
					$rs = $sql->fetch(PDO::FETCH_ASSOC);
					include("pega_blog_adm.php");
				

					if ($data=="0000-00-00"){
						$data = "";
					}else{
						list ($data, $hora) = explode (' ', $data);
						list ($ano, $mes, $dia) = explode ('-', $data);
						$data = $dia."/".$mes."/".$ano;
					}

					
					include("form_blog_adm.php");
	
				}else{
					echo "<p class='text-center'>Não foi possível encontrar o registro.</p>";
				}
			
			}
			
		break;


		

		Case "altera":

			$id=strip_tags($_POST['id']);

			if ($permissao_alt_blog<>"S"){
				echo "<p class='bg text-center'>Você não tem permissão para alterar</p>";
			}else{

				include("pega_form_blog_adm.php");
				
				if ($data<>""){
					list ($dia,$mes,$ano) = explode ('/', $data);
					$data=$ano."-".$mes."-".$dia;
				}else{
					$data="0000-00-00";
				}

				if ($inicio<>""){
					list ($h,$m,$s) = explode (':', $inicio);
					$inicio=$h.":".$m;
				}else{
					$inicio="";
				}

				if ($fim<>""){
					list ($h,$m,$s) = explode (':', $fim);
					$fim=$h.":".$m;
				}else{
					$fim="";
				}

			
				$sql = "select * from blog where id = :id";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->execute();

				if($sql->rowCount()==0){
					echo "<p class='text-center'>Não foi possível encontrar o registro.</p>";
					echo "<p class='text-right'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
				}else{


					$sql='update blog set data=:data,hora=:hora,assunto=:assunto,titulo=:titulo,n_amigavel=:n_amigavel,chamada=:chamada,descricao=:descricao,layout=:layout,title=:title,keywords=:keywords,description=:description,status=:status where id=:id';

					$up = $conn->prepare($sql);
					$up -> bindParam(':id',$id,PDO::PARAM_STR);
					$up -> bindParam(':data',$data,PDO::PARAM_STR);
					$up -> bindParam(':hora',$hora,PDO::PARAM_STR);
					$up -> bindParam(':assunto',$assunto,PDO::PARAM_STR);
					$up -> bindParam(':titulo',$titulo,PDO::PARAM_STR);
					$up -> bindParam(':n_amigavel',$n_amigavel,PDO::PARAM_STR);
					$up -> bindParam(':chamada',$chamada,PDO::PARAM_STR);
					$up -> bindParam(':descricao',$descricao,PDO::PARAM_STR);
					$up -> bindParam(':layout',$layout,PDO::PARAM_STR);
					$up -> bindParam(':title',$title,PDO::PARAM_STR);
					$up -> bindParam(':keywords',$keywords,PDO::PARAM_STR);
					$up -> bindParam(':description',$description,PDO::PARAM_STR);
					$up -> bindParam(':status',$status,PDO::PARAM_STR);
					$up -> execute();

                    include("salva_up.php");
					
					$_SESSION['msn']="alt_ok";
					$url=$link_pg."/edit/".$id;
					?><script>window.location.href = "<?php echo $url;?>"</script><?php 
					
					
				}
			} 

		break;

		case "del":

		
			$confirma=$_REQUEST['confirma'];
			
			if ($confirma != "sim") {
	
				$sql = "select * from blog where id = :id";
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
	
					$titulo=$rs['titulo'];
					$titulo=str_replace("´", "'",$titulo);
	
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
					echo "	<div class='col-sm-12 bg-danger bco'><p class='text-center'><br><br>Favor confirmar a exclusão de<br><b>".$titulo."</b><br><br></p></div>";
					echo "  </div>";
	
					echo "	<div class='row mt-2'>";
					echo "	<div class='col-sm-12'><p class='text-end'><a href='javascript:history.back(-1)'><button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;<button type='submit' name='submit' id='submit' class='btn btn-vermelho'><b>Confirmar Exclusão</b></button></p></div>";
					echo "	</div>";
	
					echo "</div>";//<!-- card-body -->"
				}
	
			}else{
	
				$id=$_POST['id'];
	
				$sql = "select * from blog where id = :id";
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
					
					$sql = "delete from blog where id=:id";
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

	}

echo "</div>";//<!-- card-body -->"

echo "<div class='card-footer'>";
echo "";
echo "</div>";//<!-- card-footer -->"
    
echo "</div>";//<!-- card -->
?>