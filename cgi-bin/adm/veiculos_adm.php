<?php

if($pg_int <> "S"){

	$redir="Location:index.php";

	header($redir);

}

// ao invés de deletar é só bloquear o cliente que ele sai da lista. E ainda tem opção de visualizar e desbloquear pesquisando os bloqueados....

$link_pg=$host."/adm/".$var2;



$pg="veiculos";

$top_ref="veiculos";



$acao=$var3;





$id=$var4;



if($acao==""){$acao="vazio";}

$id_loja=$var4;





if($acao<>"vazio" and $acao<>"cadastrar" and $acao<>"salva" and $acao<>"edit" and $acao<>"altera" and $acao<>"del" and $acao<>"configuracoes" and $acao<>"marcas_modelos_api" and $acao<>"atualiza_api"){

	$acao="vazio";

	//$pag = $var3;

	$pag=$_REQUEST['pag'];

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



$top_pagina="ANÚNCIOS";

$cadastrar="CADASTRAR NOVO ANÚNCIO";

$editar="ALTERAR ANÚNCIO";

$apagar="APAGAR ANÚNCIO";





if($acao<>"configuracoes" and $acao<>"marcas_modelos_api" and $acao<>"atualiza_api"){

	echo "<div class='card'>";

	echo "	<div class='card-header text-end topico'>";

	echo "		<strong><a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'>$top_pagina</a></strong>&nbsp;&nbsp;";

	if ($sub_top=="S" or $_SESSION['nivel']<2){

		echo "<a href='".$link_pg."/cadastrar/' title='Cadastrar'><i class='fa fa-plus text-end' aria-hidden='true'></i></a>";

	}

	echo "	</div>";

	echo "<form method=post action='".$link_pg."/edit' name='form_cli' id='form_cli' class='navbar-form' role='search'>";

	echo "<div class='top_pesquisa'>";

	echo "	<div class='row'>";

	echo "		<div class='col-sm-2'>";

	echo "			<input type='text' class='form-control' name='codigo' id='codigo' placeholder='Busca por código'>";

	echo "		</div>";

	echo "		<div class='col-sm-10'>";

	echo "			<div class='input-group'>";

	echo "					<input type='text' class='form-control' placeholder='Busca por Marca, Modelo ou Placa' name='p_veiculo' id='p_veiculo' value='' required><div class='loader' id='loaderVeiculo' style='display:none;top: 23px;'></div><input type='hidden' name='id_veiculo' id='id_veiculo' value=''>";

	echo "				<div class='input-group-prepend'>";

	echo "					<button class='btn btn-ico_busca' type='submit'><i class='fa fa-search' aria-hidden='true'></i></button>";

	echo "				</div>";

	echo "			</div>";

	echo "			</form>";

	echo "		</div>";

	echo "	</div>";

	echo "</div>";

	echo "</form>";



	echo "<div class='card-body'>";



}



	switch ($acao){



		Case "vazio":

			

			$codigo=$_POST['codigo'];//$id_loja.".".$id_unidade.".".$id;

			if($codigo<>""){list($id_usuario, $id) = explode ('.', $codigo);}

			$palavras=$_POST['palavras'];

			

			//echo "Loja:$loja Cód:$codigo Palavras:$palavras Pag:$pag Início:$inicio Limite:$limite";



			if ($permissao_edit_veiculos<>"S"){

				echo "<p class='bg text-center'>Você não tem permissão para acessar esta área</p>";

			}else{



				If ($aviso<>""){echo $aviso;}



				echo "<table class='table table-bordered table-hover table-striped'><tbody>";

				

				$sql="select veiculos.id,veiculos.usuario,veiculos.tipo,veiculos.marca,veiculos.modelo, 

				veiculos.versao,veiculos.placa,veiculos.cor,veiculos.km,veiculos.portas,veiculos.ano_fabricacao, 

				veiculos.ano_modelo,veiculos.combustivel,veiculos.cambio, 

				veiculos.valor, 

				a.id as id_est,a.nome as n_usuario, 

				b.id as id_cor,b.topico as n_cor, 

				c.id as id_combustivel,c.topico as n_combustivel, 

				d.id as id_cambio,d.topico as n_cambio 

				from veiculos 

				left outer join usuarios as a on a.id = veiculos.usuario 

				left outer join tipos_veiculos as b on b.id = veiculos.cor 

				left outer join tipos_veiculos as c on c.id = veiculos.combustivel 

				left outer join tipos_veiculos as d on d.id = veiculos.cambio 

				where ";

				if($usuario<>""){$sql.="(veiculos.usuario='$usuario') and ";}

				if($codigo<>""){$sql.="veiculos.id=$id and ";}

				if($palavras<>""){$sql.="(veiculos.placa='$palavras' or veiculos.marca like '%$palavras%' or veiculos.modelo like '%$palavras%'  or veiculos.versao like '%palavras%') and ";}

				$sql.="veiculos.status='A' ";

				$sql.="order by veiculos.id desc limit ".$inicio.", ".$limite;

				//echo $sql."<hr>";

				$sql = $conn->prepare($sql);

				$sql->execute();


				$n_reg="select count(*) as total from veiculos where ";

				if($loja<>""){$n_reg.="(veiculos.loja='$loja') and ";}

				if($codigo<>""){$n_reg.="veiculos.id=$id and ";}

				if($palavras<>""){$n_reg.="(veiculos.placa='$palavras' or veiculos.marca like '%$palavras%' or veiculos.modelo like '%$palavras%'  or veiculos.versao like '%$palavras%') and ";}

				$n_reg.="veiculos.status='A'";

				$n_reg = $conn->prepare($n_reg);

				$n_reg->execute();



				$total = $n_reg->fetch(PDO::FETCH_ASSOC);

				$total = $total['total'];



				$prox = $pag + 1;

				$ant = $pag - 1;

				$ultima_pag = ceil($total / $limite);

				$penultima = $ultima_pag - 1;  

				$adjacentes = 2;





				//echo " Nreg:$total";



				if($sql->rowCount()==0){



					echo "<tr>";

					echo "<td>";

					echo "<p class='text-center'><br><br><b>Nenhum registro encontrado<br><br>";

					//echo "<a href='javascript:history.back(1)'>Voltar</p>";

					echo "</td>";

					echo "</tr>";



				}else{



					echo "<tr>";

					echo "<td class='text-center' width='5%'><b><b>Código</b></b></td>";

					echo "<td>Veículo</td>";

					echo "<td class='text-center' width='5%'><b>Ano</b></td>";

					echo "<td class='text-center' width='5%'><b>Cor</b></td>";

					echo "<td class='text-center' width='8%'><b>Valor (R$)</b></td>";



					echo "<td colspan=2><b>Funções</b></td>";

					echo "</tr>";









					while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

						$id=$rs['id'];

						$usuario=$rs['usuario'];

						$marca=$rs['marca'];

						$modelo=$rs['modelo'];



						$idReferencia=$usuario.".".$id;



						$ano_fabricacao=$rs['ano_fabricacao'];

						$ano_modelo=$rs['ano_modelo'];

						$cor=$rs['cor'];

						$valor=$rs['valor'];

						if ($valor==0 or $mostra_valor=="N"){

							$valor="Consulte";

						}else{

							If ($valor<>""){$valor=number_format($valor, 2, ',', '.');}

							$valor=$moeda." ".$valor;

						}





						$sql_img="select * from imagens where id_ref=$id and top_ref='veiculos' order by ordem_img,id desc limit 1";

						$sql_img = $conn->prepare($sql_img);

						$sql_img->execute();

								

						if($sql_img->rowCount()>0){//pega Principal

							$rs_img = $sql_img->fetch(PDO::FETCH_ASSOC);

							$imagem=$rs_img['img'];

						}





						echo "<tr><a href='".$link_pg."/edit/".$id."'>";

						echo "<td><a href='".$link_pg."/edit/".$id."'>$idReferencia</a></td>";

						//echo "<td><a href='".$link_pg."/edit/".$id."'><img src='$host/redim.php?img=$imagem&larg=200&alt=150&crop=S'></a></td>";

						echo "<td><a href='".$link_pg."/edit/".$id."'>$marca $modelo</a></td>";

						echo "<td class='text-center'>$ano_modelo</a></td>";

						echo "<td class='text-center'>$cor</a></td>";

						echo "<td class='text-right'>$valor</a></td>";



						echo "<td width='5%' class='text-center'><a href='".$link_pg."/edit/".$id."' data-toggle='tooltip' data-placement='top' title='Ver/Editar'><i class='fa fa-pencil'></i></a></td>";

						echo "<td width='5%' class='text-center'><a href='".$link_pg."/del/".$id."' data-toggle='tooltip' data-placement='top' title='Apagar'><i class='fa fa-trash-o'></i></a></td>";

						echo "</tr>";

					}

				}



				



				//echo "<tr><td colspan=8></td></tr>";

				$pagina_atual=$link_pg;



				echo "</tbody></table>";



				//if ($ultima_pag>1){

					echo "<div class='text-right'>";

					include("paginacao.php");

					echo "</div>";

				//}

				

				



			}

		break;





		Case "cadastrar":

			

			$status="A";//11=Ativo

			$escreve="Cadastrar anúncio";



			//If ($_REQUEST['id_loja']=="ne"){echo "<script>alert('Cliente não cadastrado');</script>";}

			if ($permissao_cad_veiculos<>"S"){

				echo "<p class='bg text-center'>Você não tem permissão para cadastrar</p>";

			}else{

				

				$acao_form=$link_pg."/salva";



				$loja=0;

				

				echo "<form method='post' action='".$link_pg."/salva' ENCTYPE='multipart/form-data' class='form-horizontal' name='formulario' id='formulario'>";

				echo "<input type=hidden name='id' value='".$id."'>";

				echo "<input type=hidden name='usuario' value='".$usuario."'>";

				

				include("form_anuncio_veiculos_moto_adm.php");

	

				echo "</form>";

				

			}

		break;



		Case "salva":

			

			if ($permissao_cad_veiculos<>"S"){

				echo "<p class='bg text-center'>Você não tem permissão para cadastrar</p>";

			}else{



				/*

				foreach($_POST as $key => $value) {

				  echo "<br>$key=$value;";

				}



				echo"<hr>";

				*/

				

				include("pega_form_veiculos_adm.php");	



				if ($valor<>""){

					$valor = str_replace(".","",$valor);

					$valor = str_replace(",",".",$valor);

				}else{

					$valor=0;

				}

				

				$dt_cadastro = date('Y-m-d H:i:s');

				$ult_alteracao="0000-00-00";

				$dt_desativacao="0000-00-00";

				$ip = getenv("REMOTE_ADDR");

				$cad_por=$_SESSION['id_adm'];

				if($car_por==""){$cad_por=0;$tp_adm="U";}

				$usuario=$_SESSION['usuario'];

				if($usuario==""){$usuario=0;$tp_adm="A";}



				$chave = Sorteia(15);

				$status_temp="X";



				$tipo=2;





				$sql = 'insert into veiculos (usuario,texto,dt_cadastro,status) values(:usuario,:texto,:dt_cadastro,:status)';

				$ins = $conn->prepare($sql);

				$ins -> bindParam(':usuario',$usuario,PDO::PARAM_STR);

				$ins -> bindParam(':texto',$chave,PDO::PARAM_STR);

				$ins -> bindParam(':dt_cadastro',$dt_cadastro,PDO::PARAM_STR);

				$ins -> bindParam(':status',$status_temp,PDO::PARAM_STR);

				$ins -> execute();



				$sql="select * from veiculos where usuario=:usuario and texto=:chave and dt_cadastro=:dt_cadastro and status=:status";

				$sql = $conn->prepare($sql);

				$sql -> bindParam(':usuario',$usuario,PDO::PARAM_STR);

				$sql -> bindParam(':chave',$chave,PDO::PARAM_STR);

				$sql -> bindParam(':dt_cadastro',$dt_cadastro,PDO::PARAM_STR);

				$sql -> bindParam(':status',$status_temp,PDO::PARAM_STR);

				$sql->execute();



				//echo "select * from veiculos where usuario='$usuario' and texto='$chave' and dt_cadastro='$dt_cadastro' and status='$status'<hr>";



				if($sql->rowCount()==0){

					echo "Erro. Não foi possível recuperar o cadastro";

				}else{



					$rs = $sql->fetch(PDO::FETCH_ASSOC);

					$id=$rs['id'];

					$id_ref=$id;



					$sql='update veiculos set usuario=:usuario,tipo=:tipo,marca_fipe=:marca_fipe,modelo_fipe=:modelo_fipe,ano_fipe=:ano_fipe,cod_fipe=:cod_fipe,destaque=:destaque,gp_anuncio=:gp_anuncio,marca=:marca,modelo=:modelo,versao=:versao,ano_modelo=:ano_modelo,ano_fabricacao=:ano_fabricacao,valor=:valor,placa=:placa,cor=:cor,combustivel=:combustivel,fipe_combustivel=:fipe_combustivel,km=:km,chassi=:chassi,renavam=:renavam,opcionais=:opcionais,infos=:infos,texto=:texto,carro=:carro,portas=:portas,cambio=:cambio,motos=:motos,cilindradas=:cilindradas,estilo=:estilo,refrigeracao=:refrigeracao,partida=:partida,motor=:motor,alimentacao=:alimentacao,freios=:freios,nro_marchas=:nro_marchas,cep=:cep,uf=:uf,cidade=:cidade,cad_por=:cad_por,tp_adm=:tp_adm,dt_cadastro=:dt_cadastro,ult_alteracao=:ult_alteracao,dt_desativacao=:dt_desativacao,api=:api,chamada_api=:chamada_api,retorno_api=:retorno_api,status=:status where id=:id';



					$up = $conn->prepare($sql);

					$up -> bindParam(':id',$id,PDO::PARAM_STR);

					$up -> bindParam(':usuario',$usuario,PDO::PARAM_STR);

					$up -> bindParam(':tipo',$tipo,PDO::PARAM_STR);

					$up -> bindParam(':marca_fipe',$marca_fipe,PDO::PARAM_STR);

					$up -> bindParam(':modelo_fipe',$modelo_fipe,PDO::PARAM_STR);

					$up -> bindParam(':ano_fipe',$ano_fipe,PDO::PARAM_STR);

					$up -> bindParam(':cod_fipe',$cod_fipe,PDO::PARAM_STR);

					$up -> bindParam(':destaque',$destaque,PDO::PARAM_STR);

					$up -> bindParam(':gp_anuncio',$gp_anuncio,PDO::PARAM_STR);

					$up -> bindParam(':marca',$marca,PDO::PARAM_STR);

					$up -> bindParam(':modelo',$modelo,PDO::PARAM_STR);

					$up -> bindParam(':versao',$versao,PDO::PARAM_STR);

					$up -> bindParam(':ano_modelo',$ano_modelo,PDO::PARAM_STR);

					$up -> bindParam(':ano_fabricacao',$ano_fabricacao,PDO::PARAM_STR);

					$up -> bindParam(':valor',$valor,PDO::PARAM_STR);

					$up -> bindParam(':placa',$placa,PDO::PARAM_STR);

					$up -> bindParam(':cor',$cor,PDO::PARAM_STR);

					$up -> bindParam(':combustivel',$combustivel,PDO::PARAM_STR);

					$up -> bindParam(':fipe_combustivel',$fipe_combustivel,PDO::PARAM_STR);

					$up -> bindParam(':km',$km,PDO::PARAM_STR);

					$up -> bindParam(':chassi',$chassi,PDO::PARAM_STR);

					$up -> bindParam(':renavam',$renavam,PDO::PARAM_STR);

					$up -> bindParam(':opcionais',$opcionais,PDO::PARAM_STR);

					$up -> bindParam(':infos',$infos,PDO::PARAM_STR);

					$up -> bindParam(':texto',$texto,PDO::PARAM_STR);

					$up -> bindParam(':carro',$carro,PDO::PARAM_STR);

					$up -> bindParam(':portas',$portas,PDO::PARAM_STR);

					$up -> bindParam(':cambio',$cambio,PDO::PARAM_STR);

					$up -> bindParam(':motos',$motos,PDO::PARAM_STR);

					$up -> bindParam(':cilindradas',$cilindradas,PDO::PARAM_STR);

					$up -> bindParam(':estilo',$estilo,PDO::PARAM_STR);

					$up -> bindParam(':refrigeracao',$refrigeracao,PDO::PARAM_STR);

					$up -> bindParam(':partida',$partida,PDO::PARAM_STR);

					$up -> bindParam(':motor',$motor,PDO::PARAM_STR);

					$up -> bindParam(':alimentacao',$alimentacao,PDO::PARAM_STR);

					$up -> bindParam(':freios',$freios,PDO::PARAM_STR);

					$up -> bindParam(':nro_marchas',$nro_marchas,PDO::PARAM_STR);

					$up -> bindParam(':cep',$cep,PDO::PARAM_STR);

					$up -> bindParam(':uf',$uf,PDO::PARAM_STR);

					$up -> bindParam(':cidade',$cidade,PDO::PARAM_STR);

					$up -> bindParam(':cad_por',$cad_por,PDO::PARAM_STR);

					$up -> bindParam(':tp_adm',$tp_adm,PDO::PARAM_STR);

					$up -> bindParam(':dt_cadastro',$dt_cadastro,PDO::PARAM_STR);

					$up -> bindParam(':ult_alteracao',$ult_alteracao,PDO::PARAM_STR);

					$up -> bindParam(':dt_desativacao',$dt_desativacao,PDO::PARAM_STR);

					$up -> bindParam(':api',$api,PDO::PARAM_STR);

					$up -> bindParam(':chamada_api',$chamada_api,PDO::PARAM_STR);

					$up -> bindParam(':retorno_api',$retorno_api,PDO::PARAM_STR);

					$up -> bindParam(':status',$status,PDO::PARAM_STR);

					$up -> execute();



					//$acao="altera_img";	

					include("salva_up.php");



					/*log*/

					include("log_veiculos_adm.php");



					$historico="insert";

					$id_registro=$id;

					$tabela="veiculos";

					$acao=$log;

					grava_log($historico,$id_registro,$tabela,$acao);



					$_SESSION['msn']="cad_ok";

					$url=$link_pg."/edit/".$id;

					

					?><script>window.location.href = "<?php echo $url;?>"</script><?php	

				

					//echo $log;

				}//veiculo



			}//permissao

	

		break;



		





		Case "edit":



			



			if ($permissao_edit_veiculos<>"S"){

				echo "<p class='bg text-center'>Você não tem permissão para editar</p>";

			}else{



				$cad_por=$_SESSION['id_adm'];

				if($car_por==""){$cad_por=0;$tp_adm="U";}

				$usuario=$_SESSION['usuario'];

				if($usuario==""){$usuario=0;$tp_adm="A";}

							

				//$sql="select * from veiculos where id='$id' and cad_por='$cad_por' and usuario='$usuario'";



				$sql = "select * from veiculos where id = :id";

				$sql = $conn->prepare($sql);

				$sql->bindParam(':id', $id, PDO::PARAM_INT);

				$sql->execute();



				if($sql->rowCount()>0){

					

					$rs = $sql->fetch(PDO::FETCH_ASSOC);

					include("pega_veiculos_adm.php");



					$valor=number_format($valor,2,",",".");



					$dt_cadastro=date('d/m/Y',strtotime($data));

					If ($dt_cadastro<>"0000-00-00"){$em="em ".$dt_cadastro;}

					

					If ($aviso<>""){echo $aviso;}

					

					echo "<div style='text-align:right;font-size:9px;'><b>Cadastrado ".$em."</b>&nbsp;&nbsp;&nbsp;</div>";



					echo "<form method='post' action='".$link_pg."/altera' ENCTYPE='multipart/form-data' class='form-horizontal' name='formulario' id='formulario'>";

					echo "	<div class='col-sm-12'>";

						echo "<input type=hidden name='id' value='".$id."'>";

						include("form_anuncio_veiculos_moto_adm.php");	

					echo "	</div>";



					echo "</form>";

				

				}else{;

					echo "<p class='text-center'>Não foi possível encontrar o anúncio.</p>";

					echo "<p class='text-right'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-secondary'>Voltar</button></a></p>";

				}

			}

		break;



		Case "altera":



			if ($permissao_alt_veiculos<>"S"){

				echo "<p class='bg text-center'>Você não tem permissão para cadastrar</p>";

			}else{



				include("pega_form_veiculos_adm.php");



				if ($valor<>""){

					$valor = str_replace(".","",$valor);

					$valor = str_replace(",",".",$valor);

				}else{

					$valor=0;

				}

				

			

				

				$ult_alteracao= date('Y-m-d H:i:s');

				$dt_desativacao="0000-00-00";

				$ip = getenv("REMOTE_ADDR");

				

				$sql="select * from veiculos where id='$id' and cad_por='$cad_por' and usuario='$usuario'";

				// echo $sql;

				$sql = $conn->prepare($sql);

				$sql->execute();



				if($sql->rowCount()==0){

					echo "Erro. Não foi possível recuperar o registro";

				}else{



					$rs = $sql->fetch(PDO::FETCH_ASSOC);

					$id=$rs['id'];

					$id_ref=$id;



					//echo "Marca Fipe:$marca_fipe - Modelo Fipe:$modelo_fipe - Ano Fipe:$ano_fipe - Cod Fipe:$cod_fipe";



					$sql='update veiculos set usuario=:usuario,tipo=:tipo,marca_fipe=:marca_fipe,modelo_fipe=:modelo_fipe,ano_fipe=:ano_fipe,cod_fipe=:cod_fipe,destaque=:destaque,gp_anuncio=:gp_anuncio,marca=:marca,modelo=:modelo,versao=:versao,ano_modelo=:ano_modelo,ano_fabricacao=:ano_fabricacao,valor=:valor,placa=:placa,cor=:cor,combustivel=:combustivel,fipe_combustivel=:fipe_combustivel,km=:km,chassi=:chassi,renavam=:renavam,opcionais=:opcionais,infos=:infos,texto=:texto,carro=:carro,portas=:portas,cambio=:cambio,motos=:motos,cilindradas=:cilindradas,estilo=:estilo,refrigeracao=:refrigeracao,partida=:partida,motor=:motor,alimentacao=:alimentacao,freios=:freios,nro_marchas=:nro_marchas,cep=:cep,uf=:uf,cidade=:cidade,cad_por=:cad_por,tp_adm=:tp_adm,ult_alteracao=:ult_alteracao,api=:api,chamada_api=:chamada_api,retorno_api=:retorno_api,status=:status where id=:id';



					$up = $conn->prepare($sql);

					$up -> bindParam(':id',$id,PDO::PARAM_STR);

					$up -> bindParam(':usuario',$usuario,PDO::PARAM_STR);

					$up -> bindParam(':tipo',$tipo,PDO::PARAM_STR);

					$up -> bindParam(':marca_fipe',$marca_fipe,PDO::PARAM_STR);

					$up -> bindParam(':modelo_fipe',$modelo_fipe,PDO::PARAM_STR);

					$up -> bindParam(':ano_fipe',$ano_fipe,PDO::PARAM_STR);

					$up -> bindParam(':cod_fipe',$cod_fipe,PDO::PARAM_STR);

					$up -> bindParam(':destaque',$destaque,PDO::PARAM_STR);

					$up -> bindParam(':gp_anuncio',$gp_anuncio,PDO::PARAM_STR);

					$up -> bindParam(':marca',$marca,PDO::PARAM_STR);

					$up -> bindParam(':modelo',$modelo,PDO::PARAM_STR);

					$up -> bindParam(':versao',$versao,PDO::PARAM_STR);

					$up -> bindParam(':ano_modelo',$ano_modelo,PDO::PARAM_STR);

					$up -> bindParam(':ano_fabricacao',$ano_fabricacao,PDO::PARAM_STR);

					$up -> bindParam(':valor',$valor,PDO::PARAM_STR);

					$up -> bindParam(':placa',$placa,PDO::PARAM_STR);

					$up -> bindParam(':cor',$cor,PDO::PARAM_STR);

					$up -> bindParam(':combustivel',$combustivel,PDO::PARAM_STR);

					$up -> bindParam(':fipe_combustivel',$fipe_combustivel,PDO::PARAM_STR);

					$up -> bindParam(':km',$km,PDO::PARAM_STR);

					$up -> bindParam(':chassi',$chassi,PDO::PARAM_STR);

					$up -> bindParam(':renavam',$renavam,PDO::PARAM_STR);

					$up -> bindParam(':opcionais',$opcionais,PDO::PARAM_STR);

					$up -> bindParam(':infos',$infos,PDO::PARAM_STR);

					$up -> bindParam(':texto',$texto,PDO::PARAM_STR);

					$up -> bindParam(':carro',$carro,PDO::PARAM_STR);

					$up -> bindParam(':portas',$portas,PDO::PARAM_STR);

					$up -> bindParam(':cambio',$cambio,PDO::PARAM_STR);

					$up -> bindParam(':motos',$motos,PDO::PARAM_STR);

					$up -> bindParam(':cilindradas',$cilindradas,PDO::PARAM_STR);

					$up -> bindParam(':estilo',$estilo,PDO::PARAM_STR);

					$up -> bindParam(':refrigeracao',$refrigeracao,PDO::PARAM_STR);

					$up -> bindParam(':partida',$partida,PDO::PARAM_STR);

					$up -> bindParam(':motor',$motor,PDO::PARAM_STR);

					$up -> bindParam(':alimentacao',$alimentacao,PDO::PARAM_STR);

					$up -> bindParam(':freios',$freios,PDO::PARAM_STR);

					$up -> bindParam(':nro_marchas',$nro_marchas,PDO::PARAM_STR);

					$up -> bindParam(':cep',$cep,PDO::PARAM_STR);

					$up -> bindParam(':uf',$uf,PDO::PARAM_STR);

					$up -> bindParam(':cidade',$cidade,PDO::PARAM_STR);

					$up -> bindParam(':cad_por',$cad_por,PDO::PARAM_STR);

					$up -> bindParam(':tp_adm',$tp_adm,PDO::PARAM_STR);

					$up -> bindParam(':ult_alteracao',$ult_alteracao,PDO::PARAM_STR);

					$up -> bindParam(':api',$api,PDO::PARAM_STR);

					$up -> bindParam(':chamada_api',$chamada_api,PDO::PARAM_STR);

					$up -> bindParam(':retorno_api',$retorno_api,PDO::PARAM_STR);

					$up -> bindParam(':status',$status,PDO::PARAM_STR);

					$up -> execute();



					//$acao="altera_img";	

					include("salva_up.php");



					$cad_por=$_SESSION['id_adm'];

					if($car_por==""){$cad_por=0;$tp_adm="U";}

					$usuario=$_SESSION['usuario'];

					if($usuario==""){$usuario=0;$tp_adm="A";}



					/*log*/

					include("log_veiculos_adm.php");



					$historico="update";

					$id_registro=$id;

					$tabela="veiculos";

					$acao=$log;

					grava_log($historico,$id_registro,$tabela,$acao);



					//include("atualiza_easy.php");



					$_SESSION['msn']="edit_ok";

					$url=$link_pg."/edit/".$id;

					

					?>

					<script>window.location.href = "<?php echo $url;?>"</script>

					<?php	

							

				}//veiculo



			}//permissao

	



		break;



        Case "configuracoes":

            include("config_veiculos_adm.php");

		break;





		Case "marcas_modelos_api": 

			include("marcas_modelos_api.php");

		break;



		Case "atualiza_api": 

			include("atualiza_api.php");

		break;



		Case "historico":

			echo $id_loja;



		break;



		Case "del":

			$confirma=$_REQUEST['confirma'];

			

			if ($confirma != "sim") {



				$sql = "select * from veiculos where id = :id";

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



				$sql = "select * from veiculos where id = :id";

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

					

					$sql = "delete from veiculos where id=:id";

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





if($acao<>"configuracoes" and $acao<>"marcas_modelos_api" and $acao<>"atualiza_api"){



	echo "<div class='card-footer'>";

	echo "";

	echo "</div>";//<!-- card-footer -->"



	echo "</div>";//<!-- card -->";

}

?>