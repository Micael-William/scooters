<?php
if ($pg_int <> "S"){
	$redir="Location:index_adm.php";
	header($redir);
	die();
}

//$uploader="S";

echo "<br>"; 


if ($alerta=="S"){
	echo "<div class='row'>";
	echo "	<div class='col-sm-12 mb-3'><p class='btn btn-danger'>".$alerta."</p></div>";
	echo "</div>";


}

?>
<form method=post action='<?=$acao_form;?>' enctype='multipart/form-data' name='noticias' id='noticias'>
<input type='hidden' name='id' value='<?=$id;?>'>
<input type='hidden' name='tipo' value='<?=$tipo_banner;?>'>

<div class="row">
  	<div class="col-sm-6 mb-3">
		<b>Título</b><br>
		<input class='form-control' name="titulo" id="titulo" value="<?php echo $titulo;?>" type="text" required>
	</div>
    <div class='col-sm-6 mb-3'>
        <b>Imagem</b><br>
		<input type='file' class='form-control' name='img[]'>
    </div>
</div>


<!-- <div class='row'>	
    <div class='col-sm-10 mb-3'>
        <b>Link</b><br>
        <input type="text" class="form-control" name="link" id="link" value="<?php echo $link;?>">
    </div>

    <div class='col-sm-2 mb-3'>
        <b>Target</b><br>
        <select class="form-select" name='target' id='target' required>	
			<option value='0' <?if($target==0){echo "selected";}?>>Mesma Janela</option>
			<option value='1' <?if($target==1){echo "selected";}?>>Nova Janela</option>
		</select>
    </div>
</div>		 -->

<div style='display:none'>
	<input type='file' class='form-control' name='img[]' value=''>
	<input type='text' class='form-control' name='img_tit[]'>
	<input type='text' class='form-control' name='tp_img[]'>
	<input type='text' class='form-control' name='img_desc[]'>
	<input type='text' class='form-control' name='img_cred[]'>
</div>
<?
if ($volta==""){$volta=$link_pg;}

if ($acao=="edit"){
    echo "<p class='text-center bg'><b>IMAGEM ATUAL</b></p>";
    echo "<p class='text-center'><img src='$host/imagens/$imagem' class='img-fluid'></p>";
    echo "<hr>";
}
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