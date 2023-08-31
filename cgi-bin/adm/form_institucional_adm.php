<?php
if ($pg_int <> "S"){
	$redir="Location:index_adm.php";
	header($redir);
	die();
}

$uploader="S";

$tabela="<p></p><br>
<table align='center' style='width:100%'>
	<tbody>
		<tr>
			<td vertical-align: top;'><b>PACOTE</b></td>
			<td vertical-align: top;'><b>SUITE ILHAS</b></td>
			<td vertical-align: top;'><b>CASAL VIP</b></td>
			<td vertical-align: top;'><b>CASAL</b></td>
			<td vertical-align: top;'><b>TRIPLO</b></td>
			<td vertical-align: top;'><b>QUÁDRUPLO</b></td>
		</tr>
		<tr>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
		</tr>
	</tbody>
</table>
<p></p>
<table align='center' style='width:100%'>
	<tbody>
		<tr>
			<td vertical-align: top;'><b>PACOTE</b></td>
			<td vertical-align: top;'><b>SUITE ILHAS</b></td>
			<td vertical-align: top;'><b>CASAL VIP</b></td>
			<td vertical-align: top;'><b>CASAL</b></td>
			<td vertical-align: top;'><b>TRIPLO</b></td>
			<td vertical-align: top;'><b>QUÁDRUPLO</b></td>
		</tr>
		<tr>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
			<td vertical-align: top;'>&nbsp;</td>
		</tr>
	</tbody>
</table>
";

/* if form
*************************************************************************************/
$meta_tag="S";

$e_data="N";
$e_cat="N"; // pra vincular segmento ao conteúdo
$e_texto="S";
$e_imagem="S";
$e_link="N";
$e_sobre_rodape="N";

/*
if ($acao=="edit" and $id=="1"){$e_texto="N";}

if (($acao=="cadastrar" and $id=="1") or $np=="1"){ 
	$e_chamada="S";
	$e_texto="N";
	$e_link="S";
	$meta_tag="N";
}else{
	$e_texto="S";
}


if ($acao=="edit" and $np=="3"){$e_texto="S";$e_chamada="S";}

if (($acao=="cadastrar" and $id=="3") or $np=="3"){ 
	$e_chamada="S";
	$e_texto="S";
	$e_link="N";
	$meta_tag="S";
}else{
	$e_texto="S";
}


//Blog / ID=6
//$blog="S";
if (($acao=="cadastrar" and $id=="X") or $np=="X"){
	$e_data="S";
	$e_chamada="S";
	$e_texto="S";
	$e_video="S";
	//$e_link="S";
	$permissao_sub_top="N";
}



// Fotos
if (($acao=="cadastrar" and $id=="2") or $np=="2"){
	$e_chamada="N";
	$e_texto="N";
	$meta_tag="N";
}
*/

// Tarifas

if ($id=="xxx" and $acao<>"cadastrar"){
	$e_periodo="N";
	$e_txt_sup="S";
	$e_txt_inf="S";
	$e_chamada="N";
	$e_texto="N";
	$e_imagem="N";
	}
if ($acao=="cadastrar" and $id=="xxxx5"){$e_periodo="N";$e_imagem="N";$texto=$tabela;}
if ($np=="xxxx"){$e_periodo="N";$e_imagem="N";}


// Pacotes
/*
if ($id=="8" and $acao<>"cadastrar"){
	$e_periodo="N";
	$e_txt_sup="S";
	$e_txt_inf="S";
	$e_chamada="N";
	$e_texto="N";
	$e_imagem="N";
	}
if ($acao=="cadastrar" and $id=="8"){$e_periodo="S";$e_imagem="N";}
if ($np=="8"){$e_periodo="S";$e_imagem="N";}




if ($e_texto=="S" and $e_texto_simples=="S"){
	$ms="ERRO:Os dois tipos de texto est&atilde;o selecionados.";
	$e_texto="N";
	$e_texto_simples="S";
}
*/

/* fim if form
*************************************************************************************/



echo "<br>"; 


if ($alerta=="S"){
	echo "<div class='row'>";
	echo "	<div class='col-sm-12 mb-3'><p class='btn btn-danger'>".$alerta."</p></div>";
	echo "</div>";
}

if ($e_periodo=="S"){
	?>
	<div class="row">
  		<div class="col-sm-5">
			<div class="input-group mb-3">
				<b>Período</b><br>
				<input type="text" class="form-control periodo_de" name="periodo_de"  id="periodo_de" value="<?php echo $periodo_de;?>">
				<span class="input-group-text">a</span>
				<input type="text" class="form-control periodo_ate" name="periodo_ate" id="periodo_ate" value="<?php echo $periodo_ate;?>">
			</div>
		</div>
		<div class='col-sm-7'>
			&nbsp;
		</div>
	</div>
	<div class='clear'></div>
	<?php
}

if ($e_data=="S"){
	?>
	<div class="row">
  		<div class="col-sm-2 mb-3">
			<b>Data</b><br>
			<input class='form-control data' name="data" id="data" style='width:85px;' value="<?php echo $data;?>" type="text" required>
		</div>
		<div class='col-sm-9'>
			&nbsp;
		</div>
	</div>
	<div class='clear'></div>
	<?php
}

if ($permissao_sub_top=="S")	{
	?>
	<div style='display:none'>
		<input type='file' class='form-control' name='img[]' value=''>
		<input type='text' class='form-control' name='img_tit[]'>
		<input type='text' class='form-control' name='tp_img[]'>
		<input type='text' class='form-control' name='img_desc[]'>
		<input type='text' class='form-control' name='img_cred[]'>
	</div>

	<div class="row">
		<div class="col-sm-8 mb-3">
			<b>Título</b><br>
			<input type="text" class="form-control" name="topico" id="topico" value="<?php echo $topico;?>" required>
		</div>
		<div class="col-sm-2 mb-3">
			<b>Subtópico</b><br>
			<select class="form-select" name="sub_top" id="sub_top" required> 
			<option value="" selected><b>Selecione</b></option>
			<option value="S"<?php If ($sub_top=="S"){ echo "selected";}?>>Sim</option>
			<option value="N"<?php If ($sub_top=="N"){ echo "selected";}?>>Não</option>
			</select>
		</div>
			
		<div class='col-sm-2 mb-3'>
			<b>Status</b><br>	
			<select class="form-select" name='status' id='status' required>	
				<?php
				echo "<option value='A'";
				If ($status=='A'){ echo ' selected';}
				echo ">Ativa</option>";
				echo "		<option value='N'";
				If ($status=='N'){ echo ' selected';}
				echo ">Desabilitada</option>";
				echo "		<option value='D'";
				If ($status=='D'){ echo ' selected';}
				echo ">Em desenvolvimento</option>";
				?>
			</select>
		</div>	
	</div>
	<?php
}else{
	?>
	<div class="row">
		<div class="col-sm-10 mb-3">
			<b>Título</b><br>
			<input type="text" class="form-control" name="topico" id="topico" value="<?php echo $topico;?>" required>
		</div>	
		<div class='col-sm-2 mb-3'>
			<b>Status</b><br>	
			<select class="form-select" name='status' id='status' required>	
				<?php
				echo "<option value='A'";
				If ($status=='A'){ echo ' selected';}
				echo ">Ativa</option>";
				echo "		<option value='N'";
				If ($status=='N'){ echo ' selected';}
				echo ">Desabilitada</option>";
				echo "		<option value='D'";
				If ($status=='D'){ echo ' selected';}
				echo ">Em desenvolvimento</option>";
				?>
			</select>
		</div>	
	</div>
	<input type="hidden" name="sub_top" value="<?php echo $sub_top;?>">
	<?php
}

// text-left active

	if ($e_txt_sup=="S"){
		echo "<div class='row'>";
		echo "	<div class='col-sm-12 mb-3'><b>Texto superior</b></div>";
		echo "	<div class='col-sm-12' mb-3><textarea class='form-control editor_p' id='chamada' name='chamada' wrap='virtual' required>".$chamada."</textarea></div>";
		echo "</div>";
	}

	if ($e_txt_inf=="S"){
		echo "<div class='row'>";
		echo "	<div class='col-sm-12 mb-3'><b>Texto inferior</b></div>";
		echo "	<div class='col-sm-12 mb-3'><textarea class='form-control editor_p2' name='texto' id='texto' wrap='virtual'>".$texto."</textarea></div>";
		echo "</div>";
	}
/**/

	if ($e_chamada=="S"){
		echo "<div class='row'>";
		echo "	<div class='col-sm-12 mb-3'><b>Chamada</b></div>";
		echo "	<div class='col-sm-12 mb-3'><textarea class='form-control editor_p' id='chamada' name='chamada' wrap='virtual'>".$chamada."</textarea></div>";
		echo "</div>";
	}

	if ($e_texto_simples=="S"){
		echo "<div class='row'>";
		echo "	<div class='col-sm-12 mb-3'><b>Texto</b></div>";
		echo "	<div class='col-sm-12 mb-3'><textarea class='form-control' name='texto_simples' id='texto_simples' wrap='virtual' style='height:320px;'>".$texto."</textarea></div>";
		echo "</div>";
	}

	if($cont_link=="S"){
		if ($radio=="link"){
			$dis_link="inline";
			$dis_texto="none";
			echo "<div class='row mb-3'>";
			echo "	<div class='col-sm-12 control-label'>";
			echo "		<input type='radio' name='radio' class='radio-inline' value='link' onclick='radio_cont(this.value);' checked>Link externo&nbsp;&nbsp;";
			echo "		<input type='radio' name='radio' class='radio-inline' value='texto' onclick='radio_cont(this.value);'>Conte&uacute;do interno";
			echo "	</div>";
			echo "</div>";
		}else{
			$dis_link="none";
			$dis_texto="inline";
			echo "<div class='row mb-3'>";
			echo "	<div class='col-sm-12 control-label'>";
			echo "		<input type='radio' name='radio' class='radio-inline' value='link' onclick='radio_cont(this.value);'>Link externo&nbsp;&nbsp;";
			echo "		<input type='radio' name='radio' class='radio-inline' value='texto' onclick='radio_cont(this.value);' checked>Conte&uacute;do interno";
			echo "	</div>";
			echo "</div>";
		}

		echo "<div class='row mb-3'><div id='div_link' style='display:".$dis_link.";'>";
		echo "	<div class='col-sm-12'><b>Link</b></div>";
		echo "	<div class='col-sm-12'><input type='text' class='form-control' name='link' id='link' value='".$link."'></div>";
		echo "</div>";


		echo "<div class='row mb-3'><div id='div_texto' style='display:".$dis_texto.";'>";
		echo "	<div class='col-sm-12'><b>Conte&uacute;do</b></div>";
		echo "	<div class='col-sm-12'><textarea class='form-control editor' name='texto' id='texto' wrap='virtual'>".$texto."</textarea></div>";
		echo "</div>";
	}else{	

		if ($e_texto=="S"){
			echo "<div class='row mb-3'>";
			echo "	<div class='col-sm-12'><b>Conte&uacute;do</b></div>";
			echo "	<div class='col-sm-12'><textarea class='form-control editor' name='texto' id='texto' wrap='virtual'>".$texto."</textarea></div>";
			echo "</div>";
		}

		if ($e_link=="S"){
			echo "<div class='row mb-3'>";
			echo "	<div class='col-sm-12'><b>Link</b></div>";
			echo "	<div class='col-sm-12'><input type='text' class='form-control' name='link' id='link' value='".$link."'></div>";
			echo "</div><br>";
		}
	}//cont_link



	if ($e_sobre_rodape=="S"){
		echo "<hr><br><br>";
		echo "<div class='row mb-3'>";
		echo "	<div class='col-sm-12'><b>Sobre</b> (texto curto no rodapé do site)</div>";
		echo "	<div class='col-sm-12'><textarea class='form-control editor_p' name='chamada' id='chamada' wrap='virtual' style='height:320px;'>".$chamada."</textarea></div>";
		echo "</div>";
		echo "<div class='row mb-3'>";
		echo "	<div class='col-sm-12'><b>Link</b></div>";
		echo "	<div class='col-sm-12'><input type='text' class='form-control' name='link' id='link' value='".$link."'></div>";
		echo "</div><hr><br><br>";
	}


	if ($e_video=="S"){
		$ex=htmlspecialchars('<iframe width="560" height="315" src="//www.youtube.com/embed/BqhZMh6dQNM" frameborder="0" allowfullscreen></iframe>', ENT_QUOTES);
		echo "<div class='row mb-3'>";
		echo "	<div class='col-sm-12'><p class='bg text-center'><strong>Vídeo</strong>";
		//echo "		<br><span style='font-size:11px;'><b>Ex Youtube:</b>".$ex."</span></p>";
		echo "	</div>";
		echo "	<div class='col-sm-1 control-label'><b>Vídeo</b></div>";
		echo "	<div class='col-sm-11'><input type='text' class='form-control' name='video' id='video' value='".$video."'></div>";
		echo "</div>";
	}
	
	
	if ($e_imagem=="S"){

		echo "<div class='row'>";
		echo "	<div class='col-sm-12'><p class='bg text-center'><strong>Imagens</strong>";

		If ($var3<>"cadastrar"){
			?>
			&nbsp;-&nbsp;
			<a href="#" title='Reordenar imagens' onClick="window.open('<?php echo $host;?>/adm/reordena_imagem_adm.php?id=<?php echo $id;?>&tabela=imagens&top_ref=<?php echo $top_ref;?>','Janela','toolbar=no,location=yes,directories=yes,status=yes,menubar=no,scrollbars=yes,resizable=yes,width=580,height=600'); return false;"><i class="social fa fa-random" aria-hidden="true"></i></a>
			</p>
			<?php
		}
		
		echo "</p></div>";
		echo "</div>";

		If ($var3<>"cadastrar"){
			echo "<div class='row'>";
			echo "	<div class='col-sm-12'>";
			echo "		<table class='table' height='".$conf_alt_p."'><tbody><tr>";
			echo "			<td bgcolor='#e8e8e8' width='14'><a href='#' onMouseOver='goXleft()' onMouseOut='stopXleft()'><img src='$host/img_site/rolagem_esquerda.gif' width='14' height='".$conf_alt_p."' border='0' alt=''></a></td>";
			echo "			<td bgcolor='#f4f4f4'><iframe name='principala' frameborder='0' width='100%' height='".$conf_alt_p."' scrolling='no' src='$host/adm/fotos_adm.php?top_ref=".$top_ref."&id_ref=".$id."'></iframe></td>";
			echo "			<td bgcolor='#e8e8e8' width='14'><a href='#' onMouseOver='goXright()' onMouseOut='stopXright()'><img src='$host/img_site/rolagem_direito.gif' width='14' height='".$conf_alt_p."' border='0' alt=''></a></td>";
			echo "		</tbody></tr></table>";
			echo "	</div>";
			echo "</div>";
		}

		?>
		<div id=files >

			<div id='dfile1'>

				<div class='row'>	
					<div class='form-group col-sm-4'><b>Arquivo:</b><input type='file' class='form-control' name='img[]'></div>
					<div class='form-group col-sm-6'><b>Descrição:</b><input type='text' class='form-control' name='img_tit[]'></div>				
					<div class='form-group col-sm-2 d-grid'><br><input type='button' class='btn btn-block btn-secondary btn-sm' value='Adicionar Arquivo' OnClick='return(Expand())'></div>
				</div>		

			</div>	

		</div>
		<?
		/*
		echo "<div class='row'>";
		echo "		<div id=files >";
		echo "			<div id='dfile1'>";
		echo "				<div class='col-sm-5'>Imagem:<input type='file' class='form-control' name='img[]'></div>";
		echo "				<div class='col-sm-5'>Titulo:<input type='text' class='form-control' name='img_tit[]'></div>";
		/*
		echo "				<div class='col-sm-2'>Tipo:";
		echo "					<select class='form-control' style='padding-left:2px;' name='tp_img[]'>";
		echo "						<option value='img'>Imagem</option>";
		echo "						<option value='arq'>Arquivo</option>";
		echo "					</select>";
		echo "				</div>";
		*/
		/*
		echo "				<!-- Crédito:<input type='text' class='form-control' name='img_cred[]'> -->&nbsp;";
		echo "				<div class='col-sm-2 text-right'><input type='button' value='+ Imagens' OnClick='return(Expand())'></div>";
		echo "			</div>";
		echo "		</div>";
		*/

		
		echo "<div class='row'>";
		echo "	<div class='col-sm-12'>";
		//echo "		<div id=files >";
		//echo "			<div id='dfile1'>";
		echo "				<div class='area-upload'>";
		echo "					<label for='upload-file' class='label-upload'>";
		echo "						<i class='fas fa-cloud-upload-alt'></i>";
		echo "						<div class='texto'>Clique ou arraste o arquivo</div>";
		echo "					</label>";
		echo "					<input type='file' id='upload-file' name='img[]' multiple/>";

		echo "					<div class='lista-uploads'>";
		echo "					</div>";
		echo "				</div>";
		//echo "			</div>";
		//echo "		</div>";
		echo "	</div>";
		echo "</div>";
		echo "<div class='form-group'>";
		echo "	<div class='col-sm-12'><p class='bg' style='height:3px;'></p></div>";
		echo "</div>";

	}

	if ($meta_tag=="S"){

		echo "<div class='row mb-3'>";
		?><div class='col-sm-12'><p class='bg text-left'>&nbsp;&nbsp;<b>Otimização SEO</b>&nbsp;<input type='checkbox' name='mostra_meta' value='0' onclick="mostra_div('mostra_meta');"></p></div><?php
		echo "</div>";
		echo "<div class='row' id='mostra_meta' style='display:none;'>";

			//echo "<div class='form-group'>";
			echo "	<div class='col-sm-12'><b><a href='#' class='tooltips' data-toggle='tooltip' data-placement='top' title='Título - 70 caracteres ou menos' data-original-title='Título - 70 caracteres ou menos'>Título</a></b></div>";
			echo "	<div class='col-sm-12'><input type='text' class='form-control' name='title' id='title' value='".$title."'></div>";
			//echo "</div>";
		
			//echo "<div class='form-group'>";
			echo "	<div class='col-sm-12'><b><a href='#' data-toggle='tooltip' data-placement='top' title='Descrição - Texto objetivo de 150 caracteres ou menos' data-original-title='Descrição - Texto objetivo de 150 caracteres ou menos'>Descrição</a></b></div>";
			echo "	<div class='col-sm-12'><textarea class='form-control' name='description' id='description' wrap='virtual' style='height:60px;'>".$description."</textarea></div>";
			//echo "</div>";

			//echo "<div class='form-group'>";
			echo "	<div class='col-sm-12'><b><a href='#' class='tooltips' data-toggle='tooltip' data-placement='top' title='Recomenda-se utilizar três (ou menos) palavras-chave altamente segmentados ou frases separadas por vírgulas.' data-original-title='Recomenda-se utilizar três (ou menos) palavras-chave altamente segmentados ou frases separados por vírgulas.'>Palavras Chave</a></b></div>";
			echo "	<div class='col-sm-12'><textarea class='form-control' name='keywords' id='keywords' wrap='virtual' style='height:60px;'>".$keywords."</textarea></div>";
			//echo "</div>";

		echo "</div>";

	}


echo "<div class='clear'></div>";
echo "<div class='error'></div>";
echo "<div class='clear'></div>";


if ($volta==""){$volta=$link_pg."/ver/".$id;}

echo "<div class='row'>";
echo "	<div class='col-sm-12'><p class='text-end'><a href='".$volta."'><button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;<button type='submit' name='submit' id='submit' class='btn btn-default btn-outline-secondary'><b>Enviar</b></button></p></div>";
echo "<div class='clear'></div>";
echo "</div>";
