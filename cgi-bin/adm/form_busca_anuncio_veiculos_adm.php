<?php
if ($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
}
?>

<h4 class="bg text-center mt-2"><?php echo $escreve;?>????</h4>
<form name="formulario" id="formulario" method="post" action="<?php echo $acao_form;?>" enctype='multipart/form-data' role="form">
	<!-- <input type="hidden" name="id_loja" value="<?php echo $_id_loja;?>"> -->
	<div class="row">
		<div class="col-sm-3">
			<select class="form-control" id="loja" name="loja"> 
				<?php
				$status_loja='11';
				$sql = "select * from lojas where status=:status order by nome";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':status', $status_loja, PDO::PARAM_INT);
				$sql->execute();

				if($sql->rowCount()==0){
					echo  '<option value="" disabled>'.htmlentities("Inexistênte").'</option>';
				}else{
					echo  '<option value="" selected>Loja</option>';
					echo  '<option value=""></option>';
					while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
						$id_loja=$rs['id'];
						$nome_loja=$rs['nome'];$nome_loja=str_replace("´","'",$nome_loja);
						
						if($loja==$id_loja and $unidade=="SBC"){$select=" selected";}else{$select="";}
						echo "<option value='".$id_loja."'".$select.">".$nome_loja."</option>";
						
					}
				}
				?>
			</select>
		</div>
		<div class="col-sm-2">
			<input type="text" class="form-control" name="codigo" id="codigo" placeholder="Busca por código">
		</div>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="palavras" id="palavras" placeholder="Busca por placa, marca, modelo ou versão">
		</div>
		<div class="col-sm-1">
			<button type="submit" name='submit' class="btn btn-secondary"><b>Enviar</b></button>
		</div>
	</div>
</form>
<hr>
