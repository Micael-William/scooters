<? if ($pg_int <> "S"){$redir="Location:index.php";header($redir);exit();}?>

<?php

$acao=$var2;

session_start();
$msn=$_SESSION['mensagem'];

//echo "Ação:$acao - Session:(".$_SESSION["id"].")<br>";

if($acao<>"cadastro" and $acao<>"cadastra"){
	//include("protect.php");
	if($_SESSION['id']==""){
		header('location:'.$host.'/login');
	}
}


if($acao==""){

	$acao="cadastro";
	$cpf_cnpj=$_POST['cpf_cnpj'];
	$sql="select * from usuarios where cpf_cnpj='$cpf_cnpj'";

	// echo $sql;
	$sql = $conn->prepare($sql);

	$sql->execute();
	if($sql->rowCount()>0){

		// echo "Entrou aqui sim....";

		$_SESSION['erro']="Este usuário já está cadastrado";

		$url=$host."/login";

		?><script>window.location.href = "<?php echo $url;?>"</script><?php

		exit();

	}

}

if ($acao<>"cadastro"){
	$sql="select * from usuarios where id='$sess_cli'";

	$sql = $conn->prepare($sql);

	$sql->execute();

	if($sql->rowCount()>0){

		$rs = $sql->fetch(PDO::FETCH_ASSOC);
		$id = $rs['id'];
		$cli = $id;
		$pessoa = $rs['pessoa'];
		$nome = $rs['nome'];
		$sobrenome=$rs['sobrenome'];
		$contato=$rs['contato'];
		$cpf_cnpj=$rs['cpf_cnpj'];
		$tel=$rs['tel'];
		$cel=$rs['cel'];
		$email=$rs['email'];
		$nascimento=$rs['nascimento'];
		list ($ano, $mes, $dia) = explode ('-', $nascimento);
		$nascimento=$dia."/".$mes."/".$ano;
		$sexo=$rs['sexo'];
		$endereco=$rs['endereco'];
		$nro=$rs['nro'];
		$compl=$rs['compl'];
		$bairro=$rs['bairro'];
		$cidade=$rs['cidade'];
		$uf=$rs['uf'];
		$cep=$rs['cep'];
		$newsletter=$rs['newsletter'];
		if($newsletter=="S"){$news_checked=" checked";}else{$news_checked="";}
		$nome=str_replace("´","'",$nome);
		$sobrenome=str_replace("´","'",$sobrenome);
		$endereco=str_replace("´","'",$endereco);
		$nro=str_replace("´","'",$nro);
		$compl=str_replace("´","'",$compl);
		$bairro=str_replace("´","'",$bairro);
		$cidade=str_replace("´","'",$cidade);
		$uf=str_replace("´","'",$uf);
		$cep=str_replace("´","'",$cep);
		if($sobrenome<>""){$nome=$nome." ".$sobrenome;}	

	}

}


?>

<div class='container'>

	<nav class="navbar navbar-expand-lg navbar-light bg-light center" style='border-top:1px solid #000;border-bottom:1px solid #000;'>

		<a class="navbar-brand txt-16" href="<?=$host;?>/minha-conta"><?=$mc_minha_conta;?></a>
	
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

			<span class="navbar-toggler-icon"></span>

		</button>

		<div class="collapse navbar-collapse" id="navbarNav">
			

			<ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link txt-14" href="<?=$host;?>/minha-conta/meus-dados">MEUS DADOS</a>
        </li>

        <li class="nav-item">
            <a class="nav-link txt-14" href="<?=$host;?>/minha-conta/trocar-senha">TROCAR SENHA</a>
        </li>

        <li class="nav-item">
            <a class="nav-link txt-14" href="<?=$host;?>/minha-conta/meus-anuncios">MEUS ANÚNCIOS</a>
        </li>

        <li class="nav-item">
            <a class="nav-link txt-14" href="<?=$host;?>/minha-conta/favoritos">FAVORITOS</a>
        </li>

        <li class="nav-item">
            <a class="nav-link txt-14" href="<?=$host;?>/minha-conta/mensagens">MENSAGENS</a>
        </li>

        <li class="nav-item">
            <a class="nav-link txt-14" href="<?=$host;?>/minha-conta/logout">SAIR</a>
        </li>
			</ul>
		</div>

	</nav>

	<hr>

</div>
<div class='container '>
<section class='cadastro'>

	<?php
	
	switch ($acao){

		case "meus-dados": 
			echo "<div class='container'>";

			$pessoa_fisica_juridica = $_POST['fisico_juridico'];
			$tipo_pessoa=$_POST['tipo_pessoa'];

			$nascimento=$_POST['nascimento'];
			list ($dia, $mes,  $ano) = explode ('/', $nascimento);
			$nascimento = $ano."/".$mes."/".$dia;
			$data = $nascimento;

			if ($_SERVER["REQUEST_METHOD"] === "POST") {
				$id=$_POST['id'];
				$nome=$_POST['nome'];
				$data;
				$usual=$_POST['usual'];
				$email=$_POST['email'];
				$celular=$_POST['celular'];
				$telefone=$_POST['telefone'];
				$senha=$_POST['senha'];
				$cep=$_POST['cep'];
				$numero=$_POST['numero'];
				$endereco=$_POST['endereco'];
				$bairro=$_POST['bairro'];
				$cidade=$_POST['cidade'];
				$razao = $_POST['razao'];
				$responsavel = $_POST['responsavel'];
				$uf=$_POST['uf'];
				$data_acesso=$_POST['ultimo_acesso'];
				$ultimo_acesso = date('Y-m-d H:i:s');
				$data_acesso = $ultimo_acesso;
		
			
				$atualizar_dados ='UPDATE usuarios SET nome=:nome,
				usual=:usual,
				nascimento=:nascimento,
				celular=:celular,
				telefone=:telefone,
				email=:email,
				numero=:numero,
				endereco=:endereco,
				cep=:cep,
				cidade=:cidade,
				razao=:razao,
				responsavel=:responsavel,
				uf=:uf,
				bairro=:bairro,
				numero=:numero,
				ultimo_acesso=:data_acesso
				WHERE id=:id';
			
				$atualizar = $conn->prepare($atualizar_dados);
				$atualizar->bindParam(':id',        $id,       PDO::PARAM_STR);
				$atualizar->bindParam(':nome',      $nome,     PDO::PARAM_STR);
				$atualizar->bindParam(':usual',     $usual,      PDO::PARAM_STR);
				$atualizar->bindParam(':nascimento',$nascimento, PDO::PARAM_STR);
				$atualizar->bindParam(':telefone',  $telefone,   PDO::PARAM_STR);
				$atualizar->bindParam(':celular',   $celular,    PDO::PARAM_STR);
				$atualizar->bindParam(':email',     $email,      PDO::PARAM_STR);
				$atualizar->bindParam(':numero',    $numero,     PDO::PARAM_STR);
				$atualizar->bindParam(':endereco',  $endereco,   PDO::PARAM_STR);
				$atualizar->bindParam(':cep',       $cep,        PDO::PARAM_STR);
				$atualizar->bindParam(':cidade',    $cidade,     PDO::PARAM_STR);
				$atualizar->bindParam(':razao',     $razao,      PDO::PARAM_STR);
				$atualizar->bindParam(':responsavel',  $responsavel, PDO::PARAM_STR);
				$atualizar->bindParam(':uf',        $uf,         PDO::PARAM_STR);
				$atualizar->bindParam(':bairro',    $bairro,     PDO::PARAM_STR);
				$atualizar->bindParam(':data_acesso', $data_acesso, PDO::PARAM_STR);
			
				if ($atualizar->execute()) {
					
					$mensagem_sucesso = "<div class='alert alert-success' role='alert'>
						Dados alterados com sucesso!
				  </div>";

					echo $mensagem_sucesso;

				} else {
					$mensagem_erro = "<div class='alert alert-danger' role='lert'>
					Falha ao alterar!
				  </div>";

				  echo $mensagem_erro;

					echo "Erro ao atualizar. Detalhes: " . print_r($up->errorInfo(), true);
				}
			}
				
			include('editar.php');
			echo "</div>";

		break;

		case "cadastro":
			echo "<div class='container'>";
			$cep=$_SESSION['cep'];
			$cpf_cnpj=$_SESSION['cpf_cnpj'];
		

			function pega_cep($URL){ 

				$ch = curl_init (); 
				$timeout = 60;
				curl_setopt ( $ch , CURLOPT_RETURNTRANSFER ,  1 ); 
				curl_setopt ( $ch , CURLOPT_URL , $URL );
				curl_setopt ( $ch , CURLOPT_CONNECTTIMEOUT, $timeout);
				curl_setopt ( $ch , CURLOPT_TIMEOUT, $timeout); 
				curl_setopt ( $ch , CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);  
				$data = curl_exec ( $ch ); 
				curl_close ( $ch ); 
				return $data ; 

			}
			$url='https://viacep.com.br/ws/'.$cep.'/json/';
			$resultado=pega_cep($url);
			$data = json_decode($resultado, true);
			$endereco=$data["logradouro"];
			$bairro=$data["bairro"];
			$cidade=$data["localidade"];
			$uf=$data["uf"];

			if (strlen($cpf_cnpj)==14){
				$tipo="F";
				$e_cadastro="Cadastro Pessoa Física";
			}else{
				$tipo="J";
				$e_cadastro="Cadastro Pessoa Jurídica";			
			}
			include("form_usuarios.php");
			echo "</div>";
		break;

		case "cadastra":
			echo "<div class='container'>";
			include("pega_form_usuarios.php");

			$sql="select * from usuarios where cpf_cnpj='$cpf_cnpj' or email='$email'";

			$sql = $conn->prepare($sql);

			$sql -> bindParam(':email',$email,PDO::PARAM_STR);

			$sql->execute();
			
			if($sql->rowCount()==0){
				$status="A";

				$dt_cadastro= date('Y-m-d H:i:s');

				$ultimo_acesso = date('Y-m-d H:i:s');

				$sql='insert into usuarios (
				tipo,
				responsavel,
				razao,
				nome,
				usual,
				cpf_cnpj,
				email,
				celular,
				telefone,
				senha,
				cep,
				endereco,
				bairro,
				numero,
				cidade,
				uf,
				dt_cadastro,
				ultimo_acesso,
				status,
				nascimento
				) 
				values 
				(
				:tipo,
				:responsavel,
				:razao,
				:nome,
				:usual,
				:cpf_cnpj,
				:email,
				:celular,
				:telefone,
				:senha_criptografada,
				:cep,
				:endereco,
				:bairro,
				:numero,
				:cidade,
				:uf,
				:dt_cadastro,
				:ultimo_acesso,
				:status,
				:data_nascimento
				)';

				$ins = $conn->prepare($sql);

				$ins -> bindParam(':tipo',$tipo,PDO::PARAM_STR);

				$ins -> bindParam(':responsavel',$responsavel,PDO::PARAM_STR);

				$ins -> bindParam(':razao',$razao,PDO::PARAM_STR);

				$ins -> bindParam(':nome',$nome,PDO::PARAM_STR);

				$ins -> bindParam(':usual',$usual,PDO::PARAM_STR);

				$ins -> bindParam(':cpf_cnpj',$cpf_cnpj,PDO::PARAM_STR);

				$ins -> bindParam(':email',$email,PDO::PARAM_STR);

				$ins -> bindParam(':celular',$celular,PDO::PARAM_STR);

				$ins -> bindParam(':telefone',$tel,PDO::PARAM_STR);

				$ins -> bindParam(':senha_criptografada',$senha_criptografada,PDO::PARAM_STR);

				$ins -> bindParam(':cep',$cep,PDO::PARAM_STR);

				$ins -> bindParam(':endereco',$endereco,PDO::PARAM_STR);

				$ins -> bindParam(':bairro',$bairro,PDO::PARAM_STR);

				$ins -> bindParam(':numero',$numero,PDO::PARAM_STR);

				$ins -> bindParam(':cidade',$cidade,PDO::PARAM_STR);

				$ins -> bindParam(':uf',$uf,PDO::PARAM_STR);

				$ins -> bindParam(':dt_cadastro',$dt_cadastro,PDO::PARAM_STR);

				$ins -> bindParam(':ultimo_acesso',$ultimo_acesso,PDO::PARAM_STR);

				$ins -> bindParam(':status',$status,PDO::PARAM_STR);

				$ins -> bindParam(':data_nascimento',$data_nascimento,PDO::PARAM_STR);

				$ins -> execute();

				  // if ($ins->execute()) {
          //   $mensagem_sucesso_cadastro = "<div class='alert alert-success' role='alert'>
					// 	Cadastro realizado com sucesso!
				  //  </div>";

					//  echo $mensagem_sucesso_cadastro;
          // }

				$ins->errorInfo();


				$sql="select * from usuarios where cpf_cnpj='$cpf_cnpj' or email='$email'";

				$sql = $conn->prepare($sql);

				$sql->execute();

				if($sql->rowCount()==0){

					echo "<p class='text-center'>Erro. Não foi possível recuperar o registro</p>";

				}else{

					$rs = $sql->fetch(PDO::FETCH_ASSOC);

					$id=$rs['id'];
					$usual=$rs['usual'];
					$_SESSION['id'] = $id;
					$_SESSION['usual'] = $usual;


					$url=$host."/minha-conta/meus-dados";

					?><script>window.location.href = "<?php echo $url;?>"</script><?php
					

				}
			}else{
				echo "<p class='text-center'>Erro. Já existe um usuário com esses dados.</p>";

				echo "<p class='text-center'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
			}
			echo "</div>";
		break;
		
		case "trocar-senha": 
			
			echo "<div class='container'>";
			
			if($_SERVER["REQUEST_METHOD"] === "POST"){

				$senha=$_POST['senha_nova_usuario'];
				$confirmar_senha=$_POST['confimar_senha_nova_usuario'];

				if($senha == $confirmar_senha){

					$id=$_POST['id'];
					$data_acesso=$_POST['ultimo_acesso'];
					$ultimo_acesso = date('Y-m-d H:i:s');
					$data_acesso = $ultimo_acesso;
					$troca_senha = password_hash($confirmar_senha, PASSWORD_DEFAULT);

					$atualiza_senha = "UPDATE usuarios SET 
					senha=:troca_senha, 	
					ultimo_acesso=:data_acesso
				  WHERE id=:id";

					$atualiza = $conn->prepare($atualiza_senha);
					$atualiza->bindParam(':id', $id);
					$atualiza->bindParam(':troca_senha', $troca_senha);
					$atualiza->bindParam(':data_acesso', $data_acesso);

					if ($atualiza->execute()) {
						$mensagem_sucesso = "<div class='alert alert-success' role='alert'>
						Senha alterada com sucesso!
				    </div>";

					  echo $mensagem_sucesso;
					} else {
						echo "Erro ao atualizar. Detalhes: " . print_r($up->errorInfo(), true);
					}
				}else {
					$mensagem_erro = "<div class='alert alert-danger' role='lert'>
					Senhas não conferem!
				  </div>";

				  echo $mensagem_erro;
				}
			}

			include('trocaSenha.php');			
			echo "</div>";
		break;

		case "meus-anuncios": 
			echo "<div class='container'>";
			// include("form_anuncio.php");
			include("veiculos_anunciante.php");
			echo "</div>";
		break;

		case "favoritos":
		
			$userId = $_SESSION['id'];
			$sql = $conn->prepare("SELECT * FROM 
			usuarios
			INNER JOIN favoritos ON usuarios.id = favoritos.usuario
			INNER JOIN veiculos  ON favoritos.anuncio = veiculos.id
			INNER JOIN imagens   ON veiculos.id = imagens.id_ref
			WHERE usuarios.id =:userId 
			");

			$sql->bindParam(":userId", $userId, PDO::PARAM_INT);
			$sql->execute();

			$quantidade_favoritos = $sql->rowCount();

	     echo "<div style='width: 100%; height: 70%;' class='card text-center d-flex'>";

				echo "<div class='card-header'>";
				echo "<ul class='nav nav-pills card-header-pills'>";
				echo "<li class='nav-item'>";
						echo $quantidade_favoritos > 0
						? "<button style='' type='button' class='btn btn-secondary'>
								Favoritos <span class='badge text-bg-light'>$quantidade_favoritos</span>
							</button>"
						: "<span class='container'>Você não possui nenhum favorito</span>
					";
				echo "</li>";
				echo "</ul>";

				echo "</div>";

				echo "<div class='Highlights' id='Highlights'>";

				echo "<div  class='HighlightsCards'>";

			while ($favoritos = $sql->fetch(PDO::FETCH_ASSOC)) {
				// var_dump($favoritos);

				$marca =        	$favoritos['marca'];
				$modelo =       	$favoritos['modelo'];
				$valor =        	$favoritos['valor'];
				$ano_fabricacao = $favoritos['ano_fabricacao'];
				$ano_modelo = 		$favoritos['ano_modelo'];
				$km = 						$favoritos['km'];
				$img = 						$favoritos['img'];		
				$valor =          number_format($valor, 2, ',', '.');
				$valor =          "R$ ".$valor;

				echo "<div style='box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;' class='Card mb-4'>";

        echo "<a href='$link_anuncio' class='Card'>";
				echo "<img src='$host/imagens/$img' class='card-img-top' alt='$modelo'>";

        // resimage($imagem, $larg, $alt, '', '');

        echo "<h4 class='Card_title'>$marca $modelo</h4>";

        echo "<div class='Card_desc-box'>";

        echo "<p class='Card_desc-text'>$ano_fabricacao/$ano_modelo</p>";

        echo "<p class='Card_desc-text'>$km km</p>";

        echo "</div>";

        // echo "<p class='Card_desc-text'>$cidade - $uf</p>";

        echo "<h4 class='Card_value'>R$ $valor</h4>";

        echo "</a>";

        echo "</div>";

			}


			echo "</div>";
			echo "</div>";
			
		break;	
		
		case "mensagens":	
	
			echo "<div class='container d-flex justify-content-center'>";
      $id_user = $_SESSION['id'];


			$sql = $conn->prepare("SELECT * FROM 
			mensagens WHERE anunciante=:id_user ORDER BY id
			");
			$sql->bindParam(":id_user", $id_user, PDO::PARAM_STR);
      $sql->execute();


			$quantidade_msn = $sql->rowCount();
	     echo "<div style='width: 100%; height: 70%;' class='card text-center'>";
				echo "<div class='card-header'>";
				echo "<ul class='nav nav-pills card-header-pills'>";
				echo "<li class='nav-item'>";
						echo $quantidade_msn > 0
						? "<button style='' type='button' class='btn btn-secondary'>
								Mensagens <span class='badge text-bg-light'>$quantidade_msn</span>
							</button>"
						: "<buttonstyle=''  type='button' class='btn btn-secondary'>
						Mensagens <span class='badge text-bg-light'>$quantidade_msn</span>
					</buttonstyle=>";
				echo "</li>";
				echo "</ul>";
				echo "</div>";
		
		
				echo "<table class='table table-bordered table-hover table-striped'>";
				echo "<tbody>";

				
			$mensagem_sucesso_alteracao = "<div class='mensagem alert alert-success' role='alert'>
			Dados alterados com sucesso!
			</div>";

			$mensagem_sucesso_exclusao = "<div class='mensagem alert alert-success' role='alert'>
			Registro excluido com sucesso!
			</div>";


			function exibeMensagemParaCadaAcao($mensagem, $sucesso_alteracao, $sucesso_exclusao) {
				if ($mensagem === "edit"){
          echo $sucesso_alteracao;
          $_SESSION["mensagem"] = "";
        }
        else if ($mensagem === "delet"){
          echo $sucesso_exclusao;
          $_SESSION["mensagem"] = "";
        }
			}

			exibeMensagemParaCadaAcao($msn, $mensagem_sucesso_alteracao, $mensagem_sucesso_exclusao);

				if($quantidade_msn == 0) {
					echo "<p class='d-flex justify-content-center' style='margin-top: 17px;'>Você não possui nenhuma mensagem.</p>";
				}else {
					echo "<tr>";
					echo "<td class='text-center' width='5%'><b>Id</b></td>";
					echo "<td width='2%'><b>id_anuncio</b></td>";
					echo "<td class='text-center' width='5%'><b>Data</b></td>";
					echo "<td class='text-center' width='12%'><b>Nome</b></td>";
					echo "<td class='text-center' width='8%'><b>E-mail</b></td>";
					echo "<td class='text-center' width='15%'><b>Celular</b></td>";
					echo "<td class='text-center' colspan=3 width='15%'><b>Funções</b></td>";
					
					echo "</tr>";
					
					
					while ($mensagens = $sql->fetch(PDO::FETCH_ASSOC)) {
	
							$id_msn = $mensagens['id'];
							$id_anuncio = $mensagens['id_anuncio'];
							$data = $mensagens['data'];
							$data = date("d/m/Y", strtotime($data));
	
	
							$nome = $mensagens['nome'];
							$email = $mensagens['email'];
							$celular = $mensagens['celular'];
							$msn = $mensagens['msn'];
					
							echo "<tr>";
							echo "<td class='text-center'>$id_msn    </td>";
							echo "<td class='text-center'>$id_anuncio</td>";
							echo "<td class='text-center'>$data      </td>";
							echo "<td class='text-right' >$nome      </td>";
							echo "<td class='text-right' >$email     </td>";
							echo "<td class='text-right' >$celular   </td>";
	
							// Abre o Modal para visualizar a mensagem.
							echo "<td width='5%' class='text-center'><a href='#' style='color: #000;' class='abrir-modal' data-bs-toggle='modal' data-bs-target='#modalView$id_msn'><i class='bi bi-eye'></i></a></td>";
	
	
							// Abre o Modal para editar.
							echo "<td width='5%' class='text-center'><a href='' style='color: #000;' class='abrir-modal' data-bs-toggle='modal' data-bs-target='#modal$id_msn'><i class='bi bi-pencil'></i></a></td>";
	
							echo "<td width='5%' class='text-center'>";
							
							// Faz a exclusão
							echo "<form id='meuForm' method='POST'>
							<input type='hidden' class='favorite-btn' name='id' value='$id_msn'>
	
							<button type='submit' name='excluir' class='favorite-btn'><i class='bi bi-trash'></i></button>
							</form>";
	
					
							if ($_SERVER["REQUEST_METHOD"] === "POST") {
							
	
								if (isset($_POST["editar"])) {
									$id =          $_POST['id_msn'];
									$data_sm_hr =  $_POST['data_msn'];
	
									
									list ($dia, $mes,  $ano) = explode ('/', $data_sm_hr);
									$data_sm_hr = $ano."/".$mes."/".$dia;
									$data = $data_sm_hr;
									
									$nome_msn =    $_POST['nome_msn'];
									$email_msn  =  $_POST['email_msn'];
									$celular_msn = $_POST['celular_msn'];
								
									$sql_data_edit = "update mensagens set
									data=:data_sm_hr,
									nome=:nome_msn,
									email=:email_msn,
									celular=:celular_msn
									
									WHERE id=:id";
		
									$edit = $conn->prepare($sql_data_edit);
									$edit->bindParam(":id",           $id,          PDO::PARAM_INT);
									$edit->bindParam(":data_sm_hr",   $data_sm_hr,  PDO::PARAM_STR);
									$edit->bindParam(":nome_msn",     $nome_msn,    PDO::PARAM_STR);
									$edit->bindParam(":email_msn",    $email_msn,   PDO::PARAM_STR);
									$edit->bindParam(":celular_msn",  $celular_msn, PDO::PARAM_STR);
									$edit->execute();


									$_SESSION['mensagem'] = "edit";
									$url=$host."/minha-conta/mensagens";
	
								 ?><script>window.location.href = "<?php echo $url;?>"</script><?php
	
	
								} if (isset($_POST["excluir"])) {
	
									$id = $_POST['id'];
									$sql_data = "DELETE FROM mensagens WHERE id=:id";
									$delet = $conn->prepare($sql_data);
									$delet->bindParam(":id", $id, PDO::PARAM_INT);
									$delet->execute();
	
									$_SESSION['mensagem'] = "delet";
									$url=$host."/minha-conta/mensagens";
	
									?><script>window.location.href = "<?php echo $url;?>"</script><?php
	
								}
	
							}
							
						
							echo "</tr>";
	
							echo "<div class='modal fade' id='modalView$id_msn' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='modalLabelView$id_msn' aria-hidden='true'>";
							echo "<div class='modal-dialog modal-sm' style='max-width: 35%;'>";
							echo "<div class='modal-content'>";
							echo "<div class='modal-header'>";
							echo "<h5 class='modal-title' id='modalLabelView$id_msn'>Detalhes da Mensagem</h5>";
							echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
							echo "</div>";
							echo "<div class='modal-body'>";
	
							echo "<div class='alert alert-success' role='alert'>
			 
							<p>$msn</p>
							
						 
						</div>";
	
							echo "</div>";
							echo "<div class='modal-footer'>";
							echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
	
							
					
							echo "<div class='modal fade' id='modal$id_msn' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='modalLabel$id_msn' aria-hidden='true'>";
							echo "<div class='modal-dialog'>";
							echo "<div class='modal-content'>";
							echo "<div class='modal-header'>";
							echo "<h5 class='modal-title' id='modalLabel$id_msn'>Editar dados</h5>";
							echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
							echo "</div>";
							echo "<div class='modal-body d-flex flex-column justify-content-start'>";
							echo "<form  method='POST'>";
	
							 echo "<div class='row g-3'>
	
							 <div class='col'>
							 <label style='float: left'>Data</label>
								 <input type='text' class='form-control data'name='data_msn' id='nascimento' placeholder='data' value='$data' required>
							 </div>
	
							 <div class='col'>
									<label style='float: left'>Nome</label>
							 <input type='text'  class='form-control'name='nome_msn' placeholder='Seu nome' value='$nome' required>
							
							 </div>
							 
								<div></div>
	
								<div class='col'>
								<label style='float: left'>Email</label>
									<input type='text' class='form-control'name='email_msn' placeholder='Seu email' value='$email' required>
								</div>
	
							 <div class='col'>
							 <label style='float: left'>Celular</label>
							 <input type='text'
							 class='form-control tel'name='celular_msn' id='tel' placeholder='Seu celular' value='$celular' required>
							 </div>
	
							 <input type='hidden' class='form-control' name='id_msn' value='$id_msn' >
							 </div>
							 "; 
	
	
							
							echo "</div>";
							echo "<div class='modal-footer d-flex'>";
							echo "<input type='submit' class='text-left btn btn-secondary'  name='editar' value='Editar'/>";
	
							echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>";
							echo "<form>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
					}
					

				}
		
				
				echo "</tbody>";
				echo "</table>";
				echo "</div>";

		
		break;

		case "logout":
			echo "<div class='container'>";
				session_destroy();
				?><script>window.location.href = "<?php echo $host;?>"</script><?php
			echo "</div>";
		break;
	}

	//echo "<br>Ação:$acao - Session:(".$_SESSION["id"].")<br>";
	?>


<div class='clear'></div>

</section>
</div>
<br><br>