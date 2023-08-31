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
<div class="row">
	<div class="col-sm-8 mb-3">
		<b>Tópico</b><br>
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



echo "<div class='clear'></div>";
echo "<div class='error'></div>";
echo "<div class='clear'></div>";


if ($volta==""){$volta=$link_pg."/ver/".$id;}

echo "<div class='row'>";
echo "	<div class='col-sm-12'><p class='text-end'><a href='".$volta."'><button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;<button type='submit' name='submit' id='submit' class='btn btn-default btn-outline-secondary'><b>Enviar</b></button></p></div>";
echo "<div class='clear'></div>";
echo "</div>";