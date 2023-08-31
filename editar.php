<?php

  $id= $_SESSION['id'];

  $sql = "SELECT * FROM usuarios WHERE id=:id";
  $result = $conn->prepare($sql);

  $result->bindParam(":id",$id,PDO::PARAM_STR);
  $result->execute();
  $data = $result->fetch(PDO::FETCH_ASSOC);
 
?>

<form class="form-horizontal"  action="<?=$host;?>/minha-conta/meus-dados" enctype='multipart/form-data'  id='edit' method='post'>

	<input type="hidden" name="tipo" value="<?php echo ($data['tipo']) ? $data['tipo'] : ''; ?>">
  <input type="hidden" name="id" value="<?php echo ($data['id']) ? $data['id'] : ''; ?>">  
  <input type="hidden" name="ultimo_acesso" value="<?php echo ($data['ultimo_acesso']) ? $data['ultimo_acesso'] : ''; ?>">


	<? if ($data['tipo'] == "F") { 
		?>
		<div class="row ">
			<div class="col-md-6 mb-2">
				<b>Nome</b><br>
				<input type="text" class="form-control" name="nome" id="nome" value="<?php echo ($data['nome'])?
        $data['nome'] : ''; ?>" required />
			</div>

			<div class="col-md-2 mb-2">
				<b>Usual</b><br>
				<input type="text" class="form-control" name="usual" id="usual" value="<?php echo ($data['usual'])?
        $data['usual'] : ''; ?>" required />
			</div>

			<div class="col-sm-2 mb-2">
				<b>CPF</b><br>
				<input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo ($data['cpf_cnpj'])?
        $data['cpf_cnpj'] : ''; ?>" type="text" disabled />
			</div>

			<div class="col-sm-2 mb-2">
				<b>Nascimento</b><br>
				<input type="text" class="form-control data" name="nascimento" id="nascimento" value="<?php echo ($data['nascimento']) ? date('d/m/Y', strtotime($data['nascimento'])) : ''; ?>" required>
			</div>
		</div>
	<?php } ?>







	<?php if ($data['tipo'] == "J") { 
		$e_login="sua CNPJ";
		?>
		<div class="row ">
			<div class="col-sm-4 mb-2">
				<b>Razão Social</b><br>
				<input type="text" class="form-control" name="razao" id="razao" value="<?php echo ($data['razao'])?
        $data['razao'] : '';  ?>" required>
			</div>

			<div class="col-sm-4 mb-2">
				<b>Nome Fantasia</b><br>
				<input type="text" class="form-control" name="nome" id="nome" value="<?php echo ($data['nome'])?
        $data['nome'] : ''; ?>" required>
			</div>

			<div class="col-sm-4 mb-2">
				<b>Cnpj</b><br>
				<input type="text" class="form-control cnpj" name="cnpj" id="cnpj" value="<?php echo ($data['cpf_cnpj'])?
        $data['cpf_cnpj'] : ''; ?>" type="text" disabled />
			</div>
		</div>
	<?php } ?>



	<?php if ($data['tipo'] == "F") { ?>
		<div class="row ">
			<div class="col-sm-4 mb-2">
				<b>Telefone</b><br>
				<input class="form-control tel" name="telefone" id="tel" type="text" value="<?php echo ($data['telefone'])?
        $data['telefone'] : ''; ?>" />
			</div>

			<div class="col-sm-4 mb-2">
				<b>Celular</b><br>
				<input class="form-control cel" name="celular" id="cel" type="text" value="<?php echo ($data['celular'])?
        $data['celular'] : ''; ?>" required>
			</div>

			<div class="col-sm-4 mb-2">
				<b>Email</b><br>
				<input class="form-control" name="email" id="email" type="email" value="<?php echo ($data['email'])?
        $data['email'] : ''; ?>" required>
			</div>
		</div>

		<div class='row'>
		<div class="col-md-12 mb-2">
			<div class='bg'><b>Endereço</b></div>
		</div>
	</div>

	<div class='row'>
		<div class="col-md-2 mb-2">CEP<br>
			<input class="form-control cep" name="cep" id="cep" type="text" value="<?php echo ($data['cep'])?
        $data['cep'] : ''; ?>" onblur='pesquisacep(this.value);' required/>
		</div>	

		<div class="col-md-8 mb-2">
			<b>Endereço</b><br>
			<input class="form-control" name="endereco" id="endereco" type="text" value="<?php echo ($data['endereco'])?
        $data['endereco'] : ''; ?>" required/>	
		</div>

		<div class="col-md-2 mb-2">
			<b>Número</b><br>
			<input class="form-control" name="numero" id="nro" type="text" value="<?php echo ($data['numero'])?
        $data['numero'] : ''; ?>" required/>	
		</div>

	</div>

	<div class='row'>
		<div class="col-md-4 mb-2">
			<b>Bairro</b><br>
			<input class="form-control" name="bairro" id="bairro" type="text" value="<?php echo ($data['bairro'])?
        $data['bairro'] : ''; ?>" required/>	
		</div>

		<div class="col-md-6 mb-2">
			<b>Cidade</b><br>
			<input class="form-control" name="cidade" id="cidade" type="text" value="<?php echo ($data['cidade'])?
        $data['cidade'] : ''; ?>" required/>	
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

	<?php } ?>



	<?php if ($data['tipo'] == "J") { ?>
		<div class="row ">
			<div class="col-sm-4 mb-2">
				<b>Responsável</b><br>
				<input class="form-control" name="responsavel" id="contato" type="text" value="<?php echo ($data['responsavel'])?
        $data['responsavel'] : ''; ?>" required/>
			</div>

			<div class="col-sm-2 mb-2">
				<b>Telefone</b><br>
				<input class="form-control tel" name="telefone" id="tel" type="text" value="<?php echo ($data['telefone'])?
        $data['telefone'] : ''; ?>" />
			</div>

			<div class="col-sm-2 mb-2">
				<b>Celular</b><br>
				<input class="form-control cel" name="celular" id="cel" type="text" value="<?php echo ($data['celular'])?
        $data['celular'] : ''; ?>" required>
			</div>

			<div class="col-sm-4 mb-2">
				<b>Email</b><br>
				<input class="form-control" name="email" id="email" type="email" value="<?php echo ($data['email'])?
        $data['email'] : ''; ?>" required>
			</div>
		</div>

		<div class='row'>
		<div class="col-md-12 mb-2">
			<div class='bg'><b>Endereço</b></div>
		</div>
	</div>

	<div class='row'>
		<div class="col-md-2 mb-2">CEP<br>
			<input class="form-control cep" name="cep" id="cep" type="text" value="<?php echo ($data['cep'])?
        $data['cep'] : ''; ?>" onblur='pesquisacep(this.value);' required/>
		</div>	

		<div class="col-md-8 mb-2">
			<b>Endereço</b><br>
			<input class="form-control" name="endereco" id="endereco" type="text" value="<?php echo ($data['endereco'])?
        $data['endereco'] : ''; ?>" required/>	
		</div>

		<div class="col-md-2 mb-2">
			<b>Número</b><br>
			<input class="form-control" name="numero" id="nro" type="text" value="<?php echo ($data['numero'])?
        $data['numero'] : ''; ?>" required/>	
		</div>

	</div>



	<div class='row'>
		<div class="col-md-4 mb-2">
			<b>Bairro</b><br>
			<input class="form-control" name="bairro" id="bairro" type="text" value="<?php echo ($data['bairro'])?
        $data['bairro'] : ''; ?>" required/>	
		</div>

		<div class="col-md-6 mb-2">
			<b>Cidade</b><br>
			<input class="form-control" name="cidade" id="cidade" type="text" value="<?php echo ($data['cidade'])?
        $data['cidade'] : ''; ?>" required/>	
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

	<?php } ?>


	<div class="error"></div>

	<div class='row'>
		<div class="col-md-12 mb-2">
			<p class='text-end'><button type='submit' name='editar' id='editar' class='btn btn-secondary btn-lg'><b>Alterar meus dados</b></button></p>
		</div>
	</div>
</form>

