<?php
if ($pg_int <> "S"){
	$redir="Location:index_adm.php";
	header($redir);
	die();
}

$uploader="S";

echo "<br>"; 


if ($alerta=="S"){
	echo "<div class='row'>";
	echo "	<div class='col-sm-12 mb-3'><p class='btn btn-danger'>".$alerta."</p></div>";
	echo "</div>";
}

$e_chamada="N";
$meta_tag="S";
?>
<form method=post action='<?=$acao_form;?>' enctype='multipart/form-data' name='blog' id='blog'>
<input type='hidden' name='id' value='<?=$id;?>'>
<div class="row">
  	<div class="col-sm-2 mb-3">
		<b>Data</b><br>
		<input class='form-control data' name="data" id="data" value="<?php echo $data;?>" type="text" required>
	</div>
	<!-- <div class='col-sm-2 mb-3'>
		<b>Hora:</b><br>
		<input type="time" class='form-control' id="hora" name="hora" value="<?php echo $hora;?>" required>
	</div> -->

    <div class='col-sm-2 mb-3'>
		<b>Assunto</b><br>	
		<select class="form-select" name='assunto' id='assunto' required>	
            <option value="">Selecione</option>
			<?php
			$sql = "select * from blog_assuntos where ni=:ni and np=:np order by ordem,topico";
			$sql = $conn->prepare($sql);
			$sql->bindValue(':ni', '1', PDO::PARAM_INT);
			$sql->bindValue(':np', '1', PDO::PARAM_INT);
			$sql->execute();
			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id_ass=$rs['id'];
				$ass=$rs['topico']; 
				$ass=str_replace("´","'",$ass);
				If ($assunto==$id_ass) {$selected=" selected";}else{$selected="";}
				echo "<option value='".$id_ass."' ".$selected.">".$ass."</option>";
			}
			?>
		</select>
	</div>	

    <div class='col-sm-6'></div>

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
			/*echo "		<option value='D'";
			If ($status=='D'){ echo ' selected';}
			echo ">Em desenvolvimento</option>";
            */
			?>
		</select>
	</div>	

</div>

<div class="row">
    <div class="col-sm-12 mb-3">
	    <b>Título</b><br>
		<input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $titulo;?>" required>
	</div>
</div>
<?

if ($e_chamada=="S"){
    echo "<div class='row mb-3'>";
    echo "	<div class='col-sm-12 mb-3'><b>Chamada</b></div>";
    echo "	<div class='col-sm-12 mb-3'><textarea class='form-control editor_p' id='chamada' name='chamada' wrap='virtual'>".$chamada."</textarea></div>";
    echo "</div>";
}

echo "<div class='row mb-3'>";
echo "	<div class='col-sm-12'><b>Matéria</b></div>";
echo "	<div class='col-sm-12'><textarea class='form-control editor' name='descricao' id='descricao' wrap='virtual'>".$descricao."</textarea></div>";
echo "</div>";

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

?>
<div style='display:none'>
	<input type='file' class='form-control' name='img[]' value=''>
	<input type='text' class='form-control' name='img_tit[]'>
	<input type='text' class='form-control' name='tp_img[]'>
	<input type='text' class='form-control' name='img_desc[]'>
	<input type='text' class='form-control' name='img_cred[]'>
</div>
    <?
$conf_alt_p=90;

If ($var3<>"cadastrar"){
    echo "<div class='row'>";
    echo "	<div class='col-sm-12'>";
    echo "		<table class='table' height='".$conf_alt_p."'><tbody><tr>";
    echo "			<td bgcolor='#e8e8e8' width='14'><a href='#' onMouseOver='goXleft()' onMouseOut='stopXleft()'><img src='$host/img/rolagem_esquerda.gif' width='14' height='".$conf_alt_p."' border='0' alt=''></a></td>";
    echo "			<td bgcolor='#f4f4f4'><iframe name='principala' frameborder='0' width='100%' height='".$conf_alt_p."' scrolling='no' src='$host/adm/fotos_adm.php?top_ref=".$top_ref."&id_ref=".$id."'></iframe></td>";
    echo "			<td bgcolor='#e8e8e8' width='14'><a href='#' onMouseOver='goXright()' onMouseOut='stopXright()'><img src='$host/img/rolagem_direito.gif' width='14' height='".$conf_alt_p."' border='0' alt=''></a></td>";
    echo "		</tbody></tr></table>";
    echo "	</div>";
    echo "</div>";
}

?>
<div id=files >
    <div id='dfile1'>
        <div class='row'>	
            <div class='form-group col-sm-4'><b>Arquivo:</b><input type='file' class='form-control' name='img[]'></div>
            <div class='form-group col-sm-6'><b>Descrição/Legenda:</b><input type='text' class='form-control' name='img_tit[]'></div>				
            <div class='form-group col-sm-2 d-grid'><br><input type='button' class='btn btn-block btn-secondary btn-sm' value='Adicionar Arquivo' OnClick='return(Expand())'></div>
        </div>		
    </div>	
</div>
<?

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
	

if ($volta==""){$volta=$link_pg;}
?>
<div class='row'>
	<div class='col-sm-12'>
		<p class='text-end'><a href='<?=$volta;?>'>
		<button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;
		<button type='submit' name='submit' id='submit' class='btn btn-default btn-outline-secondary'><b>Enviar</b></button>
		</p>
	</div>
</div>
</form>