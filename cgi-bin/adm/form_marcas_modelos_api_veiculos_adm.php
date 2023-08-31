<?php
if ($pg_int <> "S"){
	$redir="Location:index_adm.php";
	header($redir);
	die();
}

/* if form
*************************************************************************************/
$meta_tag="N";

$e_data="N";
$e_cat="N"; // pra vincular segmento ao conteúdo
$e_texto="N";
$e_imagem="N";
$e_link="N";
$e_sobre_rodape="N";


/* fim if form
*************************************************************************************/
echo "<br>"; 

if ($alerta=="S"){
	echo "<div class='row'>";
	echo "	<div class='col-sm-12 mb-3'><p class='btn btn-danger'>".$alerta."</p></div>";
	echo "</div>";
}
?>

<? if ($marca==0 and $np==0){?>
<div class="row">
	<div class="col-sm-6 mb-3">
		<b>Marca</b><br>
		<input type="text" class="form-control" name="topico" id="topico" value="<?php echo $topico;?>" required>
	</div>

	<div class="col-sm-4 mb-3">
		<b>Logo</b><br>
		<input type='file' class='form-control' name='img[]'>
	</div>
			
	<div class='col-sm-2 mb-3'>
		<b>Status</b><br>	
		<select class="form-select" name='status' id='status' required>	
			<?php
			echo "<option value='A'";
			If ($status=='A'){ echo ' selected';}
			echo ">Ativa</option>";
			echo "		<option value='I'";
			If ($status=='I'){ echo ' selected';}
			echo ">Inativa</option>";
			?>
		</select>
	</div>	
</div>
<? }else{?>

<div class="row">
	<div class="col-sm-10 mb-3">
		<b>Modelo</b><br>
		<input type="text" class="form-control" name="topico" id="topico" value="<?php echo $topico;?>" required>
	</div>
			
	<div class='col-sm-2 mb-3'>
		<b>Status</b><br>	
		<select class="form-select" name='status' id='status' required>	
			<?php
			echo "<option value='A'";
			If ($status=='A'){ echo ' selected';}
			echo ">Ativa</option>";
			echo "		<option value='I'";
			If ($status=='I'){ echo ' selected';}
			echo ">Inativa</option>";
			?>
		</select>
	</div>	
</div>
<? }?>
<div style='display:none'>
	<input type='file' class='form-control' name='img[]' value=''>
	<input type='text' class='form-control' name='img_tit[]'>
	<input type='text' class='form-control' name='tp_img[]'>
	<input type='text' class='form-control' name='img_desc[]'>
	<input type='text' class='form-control' name='img_cred[]'>
</div>
<?php

if ($acao=="edit" and $imagem<>""){
    echo "<p class='text-center bg'><b>IMAGEM ATUAL</b></p>";
    echo "<p class='text-center'><img src='$host/imagens/$imagem' class='img-fluid'></p>";
    echo "<hr>";
}

echo "<div class='clear'></div>";
echo "<div class='error'></div>";
echo "<div class='clear'></div>";


if ($volta==""){$volta=$link_pg."/ver/".$id;}

echo "<div class='row'>";
echo "	<div class='col-sm-12'><p class='text-end'><a href='".$volta."'><button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;<button type='submit' name='submit' id='submit' class='btn btn-default btn-outline-secondary'><b>Enviar</b></button></p></div>";
echo "<div class='clear'></div>";
echo "</div>";