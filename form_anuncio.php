<?php

if ($pg_int <> "S") {

	$redir = "Location:index.php";

	header($redir);

}

$uploader="S";
$e_imagem = "S";



?>

<div class="row">

	<div class="col-sm-8 bg">

		<h4 class="mt-2">Características FIPE</h4>

	</div>

	<div class="col-sm-4 bg" id="resultado_fipe">

		<?

		if($var3=="edit"){

			$fipe=$marca_fipe."|".$modelo_fipe."|".$ano_fipe;

			pega_fipe($fipe);

		}

		?>

	</div>

</div>

<div class="row">

	<div class="col-sm-4">

		<b>Marca:</b><br>

		<!-- <select class="form-select" id="marca_fipe_motos" name="marca_fipe_motos" required>

			<option value="">Selecione a Marca</option>

			<?

			//$url='https://parallelum.com.br/fipe/api/v1/carros';

			//$url='https://parallelum.com.br/fipe/api/v1/caminhoes';

			$url = 'https://parallelum.com.br/fipe/api/v1/motos';

			$url .= "/marcas";



			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



			$result = curl_exec($ch);

			$obj = json_decode($result, true);



			foreach ($obj as $req) {

				$codigo = $req["codigo"];

				$marca_fipe_api = $req["nome"];

				if($codigo==$marca_fipe){

					echo "<option value='$codigo|$marca_fipe_api' selected>$marca_fipe_api</option>";

				}else{

					echo "<option value='$codigo|$marca_fipe_api'>$marca_fipe_api</option>";

				}

			}

			?>

		</select> -->



		<select class="form-select" id="marca_fipe_motos" name="marca_fipe_motos" required>

			<option value="">Selecione a Marca</option>

			<?

			$sql="select * from marcas_modelos_api where np=0 and status='A' order by topico";

			$sql = $conn->prepare($sql);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_marca=$rs['id'];

				$id_api=$rs['id_api'];

				$nome_marca=$rs['topico'];

				$nome_marca=str_replace("´","'",$nome_marca);

				If ($marca==$id_marca) {$selected=" selected";}else{$selected="";}

				//<option value='60|ADLY'>ADLY</option>

				echo "<option value='$id_api|$nome_marca' ".$selected.">".$nome_marca."</option>";

			}



			?>

		</select>	



	</div>

	<div class="col-sm-4">

		<b>Modelo:</b><br>

		<select class="form-select" id="modelo_fipe_motos" name="modelo_fipe_motos" required>

			<option value="">Selecione a Modelo</option>

			<?

			if($var3=="edit"){

				$url = 'https://parallelum.com.br/fipe/api/v1/motos/marcas/';

				$url .= $marca_fipe."/modelos";



				$ch = curl_init($url);

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			

				$result = curl_exec($ch);

				$obj = json_decode($result, true);

				$arr="modelos";

				foreach ($obj[$arr] as $p_mod) {

					$codigo = $p_mod["codigo"];

					$modelo_fipe_api = $p_mod["nome"];

					if($codigo==$modelo_fipe){

						echo "<option value='$marca_fipe|$modelo_fipe_api|$codigo|$modelo' selected>$modelo_fipe_api</option>";

					}else{

						echo "<option value='$marca_fipe|$modelo_fipe_api|$codigo|$modelo'>$modelo_fipe_api</option>";

					}

				}	

			}

			?>

		</select>

	</div>

	<div class="col-sm-4">

		<b>Ano modelo:</b><br>

		<select class="form-select" id="ano_fipe_motos" name="ano_fipe_motos" required>

			<option value="">Selecione o Ano</option>

			<?

			if($var3=="edit"){

				$url = "https://parallelum.com.br/fipe/api/v1/motos/marcas/$marca_fipe/modelos/$modelo_fipe/anos";



				$ch = curl_init($url);

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			

				$result = curl_exec($ch);

				$obj = json_decode($result, true);

			

				foreach ($obj as $p_mod) {

					$codigo = $p_mod["codigo"];

					$ano_fipe_api = $p_mod["nome"];

					if($codigo==$ano_fipe){

						echo "<option value='$marca_fipe|$modelo_fipe|$codigo' selected>$ano_fipe_api</option>";

					}else{

						echo "<option value='$marca_fipe|$modelo_fipe|$codigo'>$ano_fipe_api</option>";

					}

				}

			}

			?>

		</select>

	</div>

</div>



<hr>



<div class="row">

	<div class="col-sm-6 mt-2 mb-2 bg">

		<h4 class="pt-2">Dados para o anúncio</h4>

	</div>

	<div class="col-sm-6 mt-2 mb-2 bg text-end">

		<p class="pt-2"><b>

			Ativo</b>&nbsp;<input type="checkbox" name="status" id="status" value="A" <?php If ($status=="A"){echo " checked";}?>>&nbsp;&nbsp;

			<!-- Destaque</b>&nbsp;<input type="checkbox" name="destaque" id="destaque" value="S" <?php If ($destaque=="S"){echo " checked";}?>>&nbsp;&nbsp; -->

		</b>

	</div>

</div>







<div class="row">

	<div class="col-sm-3">

		<b>Marca:</b><br>

		<input type="text" class="form-control" name="marca" id="marca" value="<?php echo $marca; ?>" required>

	</div>

	<div class="col-sm-3">

		<b>Modelo:</b><br>

		<input type="text" class="form-control" name="modelo" id="modelo" value="<?php echo $modelo; ?>" required>

	</div>

	<div class="col-sm-2">

		<b>Ano modelo:</b><br>

		<input type="text" class="form-control" name="ano_modelo" id="ano_modelo" value="<?php echo $ano_modelo; ?>" required>

	</div>

	<div class="col-sm-2">

		<b>Ano fabricação:</b><br>

		<input type="text" class="form-control" name="ano_fabricacao" id="ano_fabricacao" value="<?php echo $ano_fabricacao; ?>" required>

	</div>

	<div class="col-sm-2">

		<b>Valor:</b><br>

		<input type="text" class="form-control moeda" name="valor" id="valor" value="<?php echo $valor; ?>" required>

	</div>



</div>





<div class="row">



	<div class="col-sm-1">

		<b>CC</b><br>

		<input type="text" class="form-control" name="cilindradas" id="cilindradas" value="<?php echo $cilindradas; ?>" required>

	</div>

	<div class="col-sm-2">

		<b>Placa</b><br>

		<input type="text" class="form-control placa" style='text-transform: uppercase;' name="placa" id="placa" value="<?php echo $placa; ?>">

	</div>

	<div class="col-sm-3">

		<b>Cor predominante</b><br>

		<select class="form-select" id="cor" name="cor" required> 

			<option value="">Selecione</option>

			<?php

			$sql = "select * from tipos_veiculos where np=:np order by ordem,topico";

			$sql = $conn->prepare($sql);

			$sql->bindValue(':np', '73', PDO::PARAM_INT);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_cor=$rs['id'];

				$nome_cor=$rs['topico'];

				$nome_cor=str_replace("´","'",$nome_cor);

				If ($cor==$id_cor) {$selected=" selected";}else{$selected="";}

				echo "<option value='".$id_cor."' ".$selected.">".$nome_cor."</option>";

			}

			?>

		</select>

	</div>

	<div class="col-sm-3">

		<b>Estilo</b><br>

		<select class="form-select" id="estilo" name="estilo" required> 

			<option value="">Selecione</option>

			<?php

			$sql = "select * from tipos_veiculos where np=:np order by ordem,topico";

			$sql = $conn->prepare($sql);

			$sql->bindValue(':np', '76', PDO::PARAM_INT);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_estilo=$rs['id'];

				$nome_estilo=$rs['topico'];

				$nome_estilo=str_replace("´","'",$nome_estilo);

				If ($estilo==$id_estilo) {$selected=" selected";}else{$selected="";}

				echo "<option value='".$id_estilo."' ".$selected.">".$nome_estilo."</option>";

			}

			?>

		</select>

	</div>

	<div class="col-sm-3">

		<b>Refrigeração</b><br>

		<select class="form-select" id="refrigeracao" name="refrigeracao" required> 

			<option value="">Selecione</option>

			<?php

			$sql = "select * from tipos_veiculos where np=:np order by ordem,topico";

			$sql = $conn->prepare($sql);

			$sql->bindValue(':np', '77', PDO::PARAM_INT);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_refrigeracao=$rs['id'];

				$nome_refrigeracao=$rs['topico'];

				$nome_refrigeracao=str_replace("´","'",$nome_refrigeracao);

				If ($refrigeracao==$id_refrigeracao) {$selected=" selected";}else{$selected="";}

				echo "<option value='".$id_refrigeracao."' ".$selected.">".$nome_refrigeracao."</option>";

			}

			?>

		</select>

	</div>



</div>





<div class="row">

	<div class="col-sm-3">

		<b>Partida</b><br>

		<select class="form-select" id="partida" name="partida" required> 

			<option value="">Selecione</option>

			<?php

			$sql = "select * from tipos_veiculos where np=:np order by ordem,topico";

			$sql = $conn->prepare($sql);

			$sql->bindValue(':np', '78', PDO::PARAM_INT);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_partida=$rs['id'];

				$nome_partida=$rs['topico'];

				$nome_partida=str_replace("´","'",$nome_partida);

				If ($partida==$id_partida) {$selected=" selected";}else{$selected="";}

				echo "<option value='".$id_partida."' ".$selected.">".$nome_partida."</option>";

			}

			?>

		</select>

	</div>



	<div class="col-sm-3">

		<b>Motor</b><br>

		<select class="form-select" id="motor" name="motor" required> 

			<option value="">Selecione</option>

			<?php

			$sql = "select * from tipos_veiculos where np=:np order by ordem,topico";

			$sql = $conn->prepare($sql);

			$sql->bindValue(':np', '79', PDO::PARAM_INT);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_motor=$rs['id'];

				$nome_motor=$rs['topico'];

				$nome_motor=str_replace("´","'",$nome_motor);

				If ($motor==$id_motor) {$selected=" selected";}else{$selected="";}

				echo "<option value='".$id_motor."' ".$selected.">".$nome_motor."</option>";

			}

			?>

		</select>

	</div>



	<div class="col-sm-3">

		<b>Alimentação</b><br>

		<select class="form-select" id="alimentacao" name="alimentacao" required> 

			<option value="">Selecione</option>

			<?php

			$sql = "select * from tipos_veiculos where np=:np order by ordem,topico";

			$sql = $conn->prepare($sql);

			$sql->bindValue(':np', '80', PDO::PARAM_INT);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_alimentacao=$rs['id'];

				$nome_alimentacao=$rs['topico'];

				$nome_alimentacao=str_replace("´","'",$nome_alimentacao);

				If ($alimentacao==$id_alimentacao) {$selected=" selected";}else{$selected="";}

				echo "<option value='".$id_alimentacao."' ".$selected.">".$nome_alimentacao."</option>";

			}

			?>

		</select>

	</div>



	<div class="col-sm-3">

		<b>Freio dianteiro/traseiro</b><br>

		<select class="form-select" id="freios" name="freios" required> 

			<option value="">Selecione</option>

			<?php

			$sql = "select * from tipos_veiculos where np=:np order by ordem,topico";

			$sql = $conn->prepare($sql);

			$sql->bindValue(':np', '81', PDO::PARAM_INT);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_freios=$rs['id'];

				$nome_freios=$rs['topico'];

				$nome_freios=str_replace("´","'",$nome_freios);

				If ($freios==$id_freios) {$selected=" selected";}else{$selected="";}

				echo "<option value='".$id_freios."' ".$selected.">".$nome_freios."</option>";

			}

			?>

		</select>

	</div>



</div>





<div class="row">



	<div class="col-sm-3">

		<b>Chassi</b><br>

		<input type="text" class="form-control" name="chassi" id="chassi" value="<?php echo $chassi; ?>">

	</div>



	<div class="col-sm-3">

		<b>Renavam</b><br>

		<input type="text" class="form-control" name="renavam" id="renavam" value="<?php echo $renavam; ?>">

	</div>



	<div class="col-sm-3">

		<b>Marchas</b><br>

		<select class="form-select" id="nro_marchas" name="nro_marchas" required> 

			<option value="">Selecione</option>

			<?php

			$sql = "select * from tipos_veiculos where np=:np order by ordem,topico";

			$sql = $conn->prepare($sql);

			$sql->bindValue(':np', '82', PDO::PARAM_INT);

			$sql->execute();

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id_marcha=$rs['id'];

				$nome_marcha=$rs['topico'];

				$nome_marcha=str_replace("´","'",$nome_marcha);

				If ($nro_marchas==$id_marcha) {$selected=" selected";}else{$selected="";}

				echo "<option value='".$id_marcha."' ".$selected.">".$nome_marcha."</option>";

			}

			?>

		</select>

		<!-- <input type="text" class="form-control" name="nro_marchas" id="nro_marchas" value="<?php echo $nro_marchas; ?>" required> -->

	</div>



	<div class="col-sm-3">

		<b>Km</b><br>

		<input type="text" class="form-control" name="km" id="km" value="<?php echo $km;?>" required>

	</div>



</div>



<hr>





<div class="row">



	<div class="col-sm-2">

		<b>Cep</b><br>

		<input type="text" class="form-control cep" name="cep" id="cep" value="<?php echo $cep; ?>" required  onblur='pesquisacep_v(this.value);'>

	</div>



	<div class="col-sm-8">

		<b>Cidade</b><br>

		<input type="text" class="form-control" name="cidade_v" id="cidade_v" value="<?php echo $cidade; ?>" disabled>

		<input type='hidden' class='form-control' name='cidade' id='cidade' value='<?=$cidade;?>'>

	</div>



	<div class="col-sm-2">

		<b>Estado</b><br>

		<input type="text" class="form-control" name="uf_v" id="uf_v" value="<?php echo $uf; ?>" disabled>

		<input type='hidden' class='form-control' name='uf' id='uf' value='<?=$uf;?>'>

	</div>



</div>

<hr>





<h4 class="bg mt-2">Outras Informações</h4>



<div class="row">

	<div class="col-sm-12">

		<?php

		//echo $infos;

		$compara=$infos;

		$nro_np = "75";

		$campo = "infos_moto";

		include("mostra_infos_e_opcionais.php");

		?>

	</div>

</div>



<hr>



<h4 class="bg mt-2">Opcionais</h4>

<div class="row">

	<div class="col-sm-12">

		<?php

		//echo $opcionais;

		$compara=$opcionais;

		$nro_np = "74";

		$campo = "opcionais_moto";

		include("mostra_infos_e_opcionais.php");

		?>

	</div>

</div>



<hr>



<div class="row mt-3">

	<div class="col-sm-12">

		<p class="bg text-center"><strong>Texto do anúncio</strong></p>

	</div>

</div>



<div class="row">

	<div class="col-sm-12"><textarea class="form-control xxeditor" id="texto" name="texto" wrap='virtual' style='height:180px;'><?php echo $texto; ?></textarea></div>

</div>







<!-- <?php

		$exemplo = 'Clique com o botão direto no vídeo do youtube e copie o código de incorporação';

		?>

<div class="row mt-3">

	<div class="col-sm-12"><p class="bg text-center"><strong>Vídeo</strong><br><span style='font-size:11px;'><?php echo "<b>Ex:</b>$exemplo"; ?></span></p></div>

</div>



<div class='row'>

	<div class='col-sm-1 col-form-label'>Youtube</div>

	<div class='col-sm-11'><input type='text' class='form-control' name='video1' id='video1' value='<?php echo $video1; ?>'></div>

</div> -->



<?php

$cat = "N";

if ($cat <> "N") { ?>

	<div class="row mt-3">

		<div class="col-sm-12">

			<p class="bg text-center"><strong>Observações Internas<br><span style='font-size:11px;'>(não&nbsp;publicado)</span></strong></p>

		</div>

	</div>

	<div class='row'>

		<div class='col-sm-12'><textarea class='form-control' name='obs' id='obs' wrap='virtual' style='height:100px;'><?php echo $obs; ?></textarea></div>

	</div>

<?php } ?>

<hr>

<?

if ($e_imagem == "S") {



	echo "<div class='row'>";

	echo "	<div class='col-sm-12'><p class='bg text-center'><strong>Imagens</strong>";



	if ($var3 <> "cadastrar") {

?>

		&nbsp;-&nbsp;

		<a href="#" title='Reordenar imagens' onClick="window.open('<?php echo $host; ?>/reordena_imagem.php?id=<?php echo $id; ?>&tabela=imagens&top_ref=<?php echo $top_ref; ?>','Janela','toolbar=no,location=yes,directories=yes,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=580,height=600'); return false;"><i class="social fa fa-random" aria-hidden="true"></i></a>

		</p>

	<?php

	}



	echo "</p></div>";

	echo "</div>";



	if ($var3 <> "cadastrar") {

		echo "<div class='row'>";

		echo "	<div class='col-sm-12'>";

		echo "		<table class='table' height='" . $conf_alt_p . "'><tbody><tr>";

		echo "			<td bgcolor='#e8e8e8' width='14'><a href='#' onMouseOver='goXleft()' onMouseOut='stopXleft()'><img src='$host/img/rolagem_esquerda.gif' width='14' height='" . $conf_alt_p . "' border='0' alt=''></a></td>";

		echo "			<td bgcolor='#f4f4f4'><iframe name='principala' frameborder='0' width='100%' height='" . $conf_alt_p . "' scrolling='no' src='$host/fotos.php?top_ref=" . $top_ref . "&id_ref=" . $id . "'></iframe></td>";

		echo "			<td bgcolor='#e8e8e8' width='14'><a href='#' onMouseOver='goXright()' onMouseOut='stopXright()'><img src='$host/img/rolagem_direito.gif' width='14' height='" . $conf_alt_p . "' border='0' alt=''></a></td>";

		echo "		</tbody></tr></table>";

		echo "	</div>";

		echo "</div>";

	}



	?>

	<!-- <div id=files>



		<div id='dfile1'>



			<div class='row'>

				<div class='form-group col-sm-4'><b>Arquivo:</b><input type='file' class='form-control' name='img[]'></div>

				<div class='form-group col-sm-6'><b>Descrição:</b><input type='text' class='form-control' name='img_tit[]'></div>

				<div class='form-group col-sm-2 d-grid'><br><input type='button' class='btn btn-block btn-secondary btn-sm' value='Adicionar Arquivo' OnClick='return(Expand())'></div>

			</div>



		</div>



	</div> -->

<?



	echo "<div class='row'>";

	echo "	<div class='col-sm-12'>";

	echo "		<div class='area-upload'>";

	echo "			<label for='upload-file' class='label-upload'>";

	echo "				<i class='fas fa-cloud-upload-alt'></i>";

	echo "				<div class='texto'>Clique ou arraste o arquivo</div>";

	echo "			</label>";

	echo "			<input type='file' id='upload-file' name='img[]' multiple/>";

	echo "			<div class='lista-uploads'>";

	echo "			</div>";

	echo "		</div>";

	echo "	</div>";

	echo "</div>";

	echo "<div class='form-group'>";

	echo "	<div class='col-sm-12'><p class='bg' style='height:3px;'></p></div>";

	echo "</div>";

}





if ($meta_tag == "S") {

	//echo "<hr>";

	echo "<div class='row'>";

	?>

	<div class='col-sm-12'>

		<p class='bg text-left'>&nbsp;&nbsp;<b>Otimização SEO</b>&nbsp;<input type='checkbox' name='mostra_meta' value='0' onclick="mostra_div('mostra_meta');"></p>

	</div>

	

	<?php

	echo "</div>";

	echo "<div class='row' id='mostra_meta' style='display:none;'>";



	//echo "<div class='row'>";

	echo "	<div class='col-sm-12'><b><a href='#' class='tooltips' data-toggle='tooltip' data-placement='top' title='Título - 70 caracteres ou menos' data-original-title='Título - 70 caracteres ou menos'>Título</a></b></div>";

	echo "	<div class='col-sm-12'><input type='text' class='form-control' name='title' id='title' value='" . $title . "'></div>";

	//echo "</div>";



	//echo "<div class='row'>";

	echo "	<div class='col-sm-12'><b><a href='#' data-toggle='tooltip' data-placement='top' title='Descrição - Texto objetivo de 150 caracteres ou menos' data-original-title='Descrição - Texto objetivo de 150 caracteres ou menos'>Descrição</a></b></div>";

	echo "	<div class='col-sm-12'><textarea class='form-control' name='description' id='description' wrap='virtual' style='height:60px;'>" . $description . "</textarea></div>";

	//echo "</div>";



	//echo "<div class='row'>";

	echo "	<div class='col-sm-12'><b><a href='#' class='tooltips' data-toggle='tooltip' data-placement='top' title='Recomenda-se utilizar três (ou menos) palavras-chave altamente segmentados ou frases que são separados por vírgulas.' data-original-title='Recomenda-se utilizar três (ou menos) palavras-chave altamente segmentados ou frases que são separados por vírgulas.'>Palavras Chave</a></b></div>";

	echo "	<div class='col-sm-12'><textarea class='form-control' name='keywords' id='keywords' wrap='virtual' style='height:60px;'>" . $keywords . "</textarea></div>";

	//echo "</div>";



	echo "</div>";

	//echo "<hr>";

}

//echo "<input type='hidden' class='form-control' name='chamada_api' id='chamada_api' value='$chamada_api'>";

//echo "<input type='hidden' class='form-control' name='retorno_api' id='retorno_api' value='$result'>";

echo "<input type='hidden' class='form-control' name='marca_fipe' id='marca_fipe' value='$marca_fipe'>";

echo "<input type='hidden' class='form-control' name='modelo_fipe' id='modelo_fipe' value='$modelo_fipe'>";

echo "<input type='hidden' class='form-control' name='ano_fipe' id='ano_fipe' value='$ano_fipe'>";

echo "<input type='hidden' class='form-control' name='cod_fipe' id='cod_fipe' value='$cod_fipe'>";

echo "<input type='hidden' class='form-control' name='fipe_combustivel' id='fipe_combustivel' value='$fipe_combustivel'>";

?>



<div class="error"></div>

<div class="row mt-3">

	<div class="col-sm-12 text-end">

		<p class='xbg'><button type='submit' name='submit' id='submit' class="btn btn-default btn-outline-secondary"><b>&nbsp;&nbsp;Enviar&nbsp;&nbsp;</b></button></p>

	</div>

</div>

</form>