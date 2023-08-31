<?php
if ($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
}

echo "<form method=post action='".$action."' enctype='multipart/form-data' name='".$nome_form."' id='".$nome_form."' class='form-horizontal'>";
echo "<input type='hidden' name='id' value='".$id."'>";
echo "<input type='hidden' name='img_ant' value='".$imagem."'>";

If ($_SESSION['nivel'] <= 1){//'eu ou o administrador
	$dis_nivel="";
}else{
	$dis_nivel="disabled alt='Você não tem permissão para alterar o nível' title='Você não tem permissão para alterar o nível'd";
}

If ($_GET['acao']=="cadastrar"){$dis_nivel="";}

If ($acao=="edit"){
	$dis="disabled alt='Não é possível alterar o usuário' title='Não é possível alterar o usuário'";
	echo "<input type='hidden' name='login' value='".$login."'>";
} 

?>
	
	<div class="row">
		<div class="col-sm-8 control-label mb-3"><b>Nome</b><br>
			<input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome;?>"/>
		</div>
		<div class="col-sm-3 mb-3"><b>Usual</b><br>
			<input type="text" class="form-control" name="usual" id="usual" value="<?php echo $usual;?>"/>
		</div>
		<div class="col-sm-1 mb-3" style='text-align:right;'><br>Ativo&nbsp;<input type="checkbox" name="status" id="status" value="A" <?php If ($status=="A"){echo " checked";}?>>&nbsp;&nbsp;
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 mb-3"><b>Grupo</b><br>
			<select class="form-select" name="nivel" id="nivel" <?php echo $dis_nivel;?>>
			<?php
				echo "<option value=''";
				If ($nivel==""){echo " selected";}
				echo ">Nível</option>";

				If ($nivel_adm <= 1){
					echo "<option value='1'";
					If ($nivel=="1"){echo " selected";}
					echo ">Administrador(a)</option>";
				}
/*
				If ($nivel_adm <= 2){
					echo "<option value='2'";
					If ($nivel=="2"){echo " selected";}
					echo ">Vendas</option>";
				}

				If ($nivel_adm <= 3){
					echo "<option value='3'";
					If ($nivel=="3"){echo " selected";}
					echo ">Financeiro/Vendas</option>";
				}

				If ($nivel_adm <= 4){
					echo "<option value='4'";
					If ($nivel=="4"){echo " selected";}
					echo ">Manutenção de Medicamentos</option>";
				}

				
				If ($nivel_adm <= 5){
					echo "<option value='5'";
					If ($nivel=="5"){echo " selected";}
					echo ">Operacional</option>";
				}
*/				
			?>
			</select>
		</div>
		<div class="col-sm-4 mb-3"><b>Email</b><br>
			<input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>"/>
		</div>
		<div class="col-sm-4 mb-3"><b>Telefone</b><br>
			<input class="form-control cel" name="cel" id="cel" type="text" value="<?php echo $cel;?>"/>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 mb-3"><b>Usuário</b><br>
			<input <?php echo $dis;?> type="text" class="form-control" name="login" id="login" value="<?php echo $login;?>" type="text"/>
		</div>
		<div class="col-sm-4 mb-3"><b>Senha</b><br>
			<?php if ($var3=="cadastrar"){ ?>
				<input class="form-control" name="senha" id="senha" value="<?php echo $senha;?>" type="password" title=""/>
			<?php }else{ ?>
				<input class="form-control" name="senha" id="senha" value="<?php echo $senha;?>" type="password" title=""/>
			<?php } ?>
		</div>
		<div class="col-sm-4 mb-3"><b>Confirma</b><br>
			<?php if ($var3=="cadastrar"){ ?>
				<input class="form-control" name="senha2" id="senha2" value="<?php echo $senha;?>" type="password"/>
			<?php }else{ ?>
				<input class="form-control" name="senha2" id="senha2" value="<?php echo $senha;?>" type="password"/>
			<?php } ?>	
		</div>
	</div>

	

	<!-- <div class="row">
		<div class="col-sm-4"><b>Cargo (PT)</b><br>
			<input type="text" class="form-control" name="cargo_pt" id="cargo_pt" value="<?php echo $cargo_pt;?>" type="text"/>
		</div>
		<div class="col-sm-4"><b>Cargo (ING)</b><br>
			<input type="text" class="form-control" name="cargo_ing" id="cargo_ing" value="<?php echo $cargo_ing;?>" type="text"/>
		</div>
		<div class="col-sm-4"><b>Assinatura</b><br>
			<input type='file' class='form-control' name='img[]'>
			<?php if($imagem<>""){echo "<img src='$host/imagens/$imagem' style='max-height:100px;' class='center'>";}?>
		</div>
	</div> -->


	<div class="error"></div>

	<div class="row">
		<div class="col-sm-12 mb-3 text-end">
		<?php if ($permissao_cad=="S"){?>
			<a href="<?php echo $volta;?>" class="btn btn-outline-secondary" role="button">Voltar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php }?>
		<button type="submit" name='submit' id='submit' class="btn btn-outline-secondary"><b>&nbsp;&nbsp;Enviar&nbsp;&nbsp;</b></button></div>
	</div>

</form>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo $nome;?></h4>
			</div>
			<div class="modal-body">
				<p><img src="<?php echo $host."/".$diretorio.$img_usuario;?>"  class='center img-responsive' /></p>
			</div>
			<div class="modal-footer">
				<!-- <button type='button' class='btn btn-outline-secondary' data-toggle='popover' data-placement='top' title='Confirmar' data-content='Confirma exclusão?'>Apagar</button> -->
				<!-- <a class="btn" id="confirma" data-toggle="confirmation" data-placement="top">Apagar</a> -->
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<script>
$('myModal').on('shown.bs.modal', function () {
	$('#myInput').focus()
})
</script>			
<!-- Fim Modal -->