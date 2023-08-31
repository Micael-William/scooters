

<? if ($pg_int <> "S") {

	$redir = "Location:index.php";

	header($redir);

	exit();

}

?>

<form class="form-horizontal" name='cad_usuario' id='cad_usuario' method='post' enctype='multipart/form-data' action='<?php echo $host."/minha-conta/cadastra"; ?>'>

	<input type="hidden" name="cli" value="<?php echo $cli; ?>">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="hidden" name="tipo" value="<?php echo $tipo; ?>">

	<div class='row'>

		<div class="col-md-12 mb-2">

			<div class='bg'><b><?=$e_cadastro;?></b></div>

		</div>

	</div>



	<? if ($tipo == "F") { 

		$e_login="seu CPF";

		?>

		<div class="row ">

			<div class="col-md-6 mb-2">

				<b>Nome</b><br>

				<input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome; ?>" required />

			</div>

			<div class="col-md-2 mb-2">

				<b>Usual</b><br>

				<input type="text" class="form-control" name="usual" id="usual" value="<?php echo $usual; ?>" required />

			</div>

			<div class="col-sm-2 mb-2">

				<b>CPF</b><br>

				<input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo $cpf_cnpj; ?>" type="text" disabled />

				<input type="hidden" name="cpf_cnpj" value="<?php echo $cpf_cnpj; ?>">

			</div>

			<div class="col-sm-2 mb-2">

				<b>Nascimento</b><br>

				<input type="text" class="form-control data" name="nascimento" id="nascimento" value="<?php echo $data_nascimento; ?>" required>

			</div>

		</div>

	<?php } ?>







	<?php if ($tipo == "J") { 

		$e_login="sua CNPJ";

		?>

		<div class="row ">

			<div class="col-sm-4 mb-2">

				<b>Razão Social</b><br>

				<input type="text" class="form-control" name="razao" id="razao" value="<?php echo $razao; ?>" required>

			</div>

			<div class="col-sm-4 mb-2">

				<b>Nome Fantasia</b><br>

				<input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome; ?>" required>

			</div>

			<div class="col-sm-4 mb-2">

				<b>Cnpj</b><br>

				<input type="text" class="form-control cnpj" name="cnpj" id="cnpj" value="<?php echo $cpf_cnpj; ?>" type="text" disabled />

				<input type="hidden" name="cpf_cnpj" value="<?php echo $cpf_cnpj; ?>">

			</div>

		</div>

	<?php } ?>



	<?php if ($tipo == "F") { ?>

		<div class="row ">

			<div class="col-sm-4 mb-2">

				<b>Telefone</b><br>

				<input class="form-control tel" name="telefone" id="tel" type="text" value="<?php echo $tel; ?>" />

			</div>



			<div class="col-sm-4 mb-2">

				<b>Celular</b><br>

				<input class="form-control cel" name="celular" id="cel" type="text" value="<?php echo $celular; ?>" required>

			</div>



			<div class="col-sm-4 mb-2">

				<b>Email</b><br>

				<input class="form-control" name="email" id="email" type="email" value="" required>

			</div>

		</div>

	<?php } ?>



	<?php if ($tipo == "J") { ?>

		<div class="row ">

			<div class="col-sm-4 mb-2">

				<b>Responsável</b><br>

				<input class="form-control" name="responsavel" id="contato" type="text" value="<?php echo $responsavel; ?>" required/>

			</div>



			<div class="col-sm-2 mb-2">

				<b>Telefone</b><br>

				<input class="form-control tel" name="telefone" id="tel" type="text" value="<?php echo $tel; ?>" />

			</div>



			<div class="col-sm-2 mb-2">

				<b>Celular</b><br>

				<input class="form-control cel" name="celular" id="cel" type="text" value="<?php echo $celular; ?>" required>

			</div>



			<div class="col-sm-4 mb-2">

				<b>Email</b><br>

				<input class="form-control" name="email" id="email" type="email" value="" required>

			</div>

		</div>

	<?php } ?>





	<div class='row'>

		<div class="col-md-12">

			<hr>

		</div>

	</div>



	<div class='row'>

		<div class="col-md-12 mb-2">

			<div class='bg'><b>Endereço</b></div>

		</div>

	</div>

	<div class='row'>

		<div class="col-md-2 mb-2">CEP<br>

			<input class="form-control cep" name="cep" id="cep" type="text" value="<?=$cep;?>" onblur='pesquisacep(this.value);' required/>

		</div>	

		<div class="col-md-8 mb-2">

			<b>Endereço</b><br>

			<input class="form-control" name="endereco" id="endereco" type="text" value="<?php echo $endereco; ?>" required/>	

		</div>

		<div class="col-md-2 mb-2">

			<b>Número</b><br>

			<input class="form-control" name="numero" id="nro" type="text" value="<?php echo $numero; ?>" required/>	

		</div>

	</div>



	<div class='row'>

		<div class="col-md-4 mb-2">

			<b>Bairro</b><br>

			<input class="form-control" name="bairro" id="bairro" type="text" value="<?php echo $bairro; ?>" required/>	

		</div>

		<div class="col-md-6 mb-2">

			<b>Cidade</b><br>

			<input class="form-control" name="cidade" id="cidade" type="text" value="<?php echo $cidade; ?>" required/>	

		</div>

		<div class="col-md-2 mb-2">

			<b>Estado</b><br>

			<?php include("adm/select_uf.php"); ?>	

		</div>

	</div>



	<div class='row'>

		<div class="col-md-12">

			<hr>

		</div>

	</div>



	<div class='row'>

		<div class="col-md-12 mb-2">

			<div class='bg'><b>Dados de acesso</b></div>

		</div>

	</div>



	<div class='row'>

		<div class="col-sm-4 mb-2">

			<b>Login</b><br>

			<div class='fake'> Seu login é <?=$e_login;?> ou seu E-mail.</div>

		</div>

		<div class="col-sm-4 mb-2">

			<b>Senha</b><br>

			<input class="form-control" name="senha" id="senha" type="password" value="" required/>

		</div>

		<div class="col-sm-4 mb-2">

			<b>Confirma</b><br>

			<input class="form-control" name="senha2" id="senha2" type="password" value="" required/>

		</div>

	</div>					



	<div class="error"></div>



	<div class='row'>

		<div class="col-md-12 mb-2">

			<p class='text-end'><button type='submit' name='cadastra' id='cadastra' class='btn btn-default'><b>Enviar</b></button></p>

		</div>

	</div>



</form>

