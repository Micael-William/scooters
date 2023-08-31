<?php
$charset = "utf-8";
//$charset="ISO-8859-1";
header('Content-type: text/html; charset='.$charset);
session_start();
include("../conn.php");
$conn = conecta();
include("funcoes.php");

$pg = $_POST['pg'];
$pg_int = "S";

if ($pg == "") {
	$pg = "vazio"; 
}

$sql = "select * from config where id = 1";
$sql = $conn->prepare($sql);
$sql->execute();

if($sql->rowCount()==0){
	echo "Nenhum arquivo encontrado";
}else{
	$rs = $sql->fetch(PDO::FETCH_ASSOC);
	include("pega_config.php");
	$host=$url_site;
}


switch ($pg) {
	case "vazio":
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo $host; ?>/favicon.ico">
    <title><?=$nome_site;?></title>
    <link href="<?php echo $host; ?>/adm/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $host; ?>/adm/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $host; ?>/adm/estilo.css" rel="stylesheet">
</head>

<body class="text-center">
	<main class="form-signin mt-5">
		<form name="formulario" id="formulario" method="POST" action="<?=$host;?>/adm/autentica.php" enctype="multipart/form-data">

			<input type="hidden" name="pg" value="autentica">
			<img src="<?=$host;?>/img/logo_adm.png" alt="" class='img-fluid'>

			<!-- <br><br><h2 class="h3 mb-3 fw-normal">Login</h2> -->
			<br><br>
			<?php

				if ($_SESSION['erro_sess'] == "erro") {
					echo "<div class='bs-example'>";
					echo "<div class='alert alert-danger'>";
					echo "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
					echo "<strong>Usuário ou senha Inválido</strong>";
					echo "</div>";
					echo "</div>";
					unset($_SESSION['erro_sess']);
				}
			?>
					
			<div class="form-floating">
				<input type="text" class="form-control" id="floatingInput" name="usuario" placeholder="Usuário">
				<label for="floatingInput">Usuário</label>
			</div>
			<div class="form-floating">
				<input type="password" class="form-control" id="floatingPassword" name="senha" placeholder="Senha">
				<label for="floatingPassword">Senha</label>
			</div>

			<!-- <div class="checkbox mb-3">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div> -->
			<button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
			<!-- <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p> -->
		</form>
	</main>
</body>
</html>
<?php
	break;
	case "autentica":
		$login = Trim($_POST['usuario']);
		$senha = Trim($_POST['senha']);
		$senha = sha1($senha);
		$loja  = Trim($_POST['loja']);
		if ($loja == "") {
			$loja = 0;
		}
		$login = str_replace("'", "'", $login);
		$log_erro_senha = str_replace("'", "1", $_POST['senha']);

		$log = "select * from admin where login='" . $login . "' and senha='" . $log_erro_senha . "' and status='A'";

		//$conn=conecta();
		$sql = "select * from admin where login=:login and senha=:senha and status=:status";
		$sql = $conn->prepare($sql);
		$sql->bindValue(':login', $login, PDO::PARAM_STR);
		$sql->bindValue(':senha', $senha, PDO::PARAM_STR);
		$sql->bindValue(':status', 'A', PDO::PARAM_STR);
		$sql->execute();

		if ($sql->rowCount() > 0) {

			$rs = $sql->fetch(PDO::FETCH_ASSOC);

			$id = $rs['id'];
			$nome = $rs['usual'];
			$nivel = $rs['nivel'];
			$mat = $rs['mat'];
			$dir = $rs['dir'];
			$ger = $rs['ger'];
			$rep = $rs['rep'];
			$idioma = $rs['idioma'];
			$regiao = $rs['regiao'];
			$sess = time() . "|" . $id . "|" . $nome . "|" . $nivel;
			$_SESSION['sess'] = $sess;
			$_SESSION['id_adm'] = $id;
			$_SESSION['admin'] = $nome;
			$_SESSION['nivel'] = $nivel;
			$_SESSION['mat'] = $mat;
			$_SESSION['dir'] = $dir;
			$_SESSION['ger'] = $ger;
			$_SESSION['rep'] = $rep;
			$_SESSION['regiao'] = $regiao;
			$expira = time() + (1 * 3600); //1 hora			
			setcookie("sess", time(), $expira);
			setcookie("idioma", $idioma, time() + 3600 * 24 * 30);
			$ua = date('Y-m-d H:i:s');
			$redir = "index.php";
			//$redir = $host . "/" . $idioma;
			$redir = $host . "/adm";

			if ($grava_log == "S") {
				grava_log('login', $id, 'admin', $login);
			}
			//atualiza

			try {
				$up = $conn->prepare('update admin set ult_acesso=:ua,logado=:logado,se=:se where id=:id');
				$up->bindParam(':ua', $ua, PDO::PARAM_STR);
				$up->bindValue(':logado', 'S', PDO::PARAM_STR);
				$up->bindParam(':se', $_POST['senha'], PDO::PARAM_STR);
				$up->bindParam(':id', $id, PDO::PARAM_INT);
				$up->execute();
			} catch (PDOException $e) {
				echo 'Erro: ' . $e->getMessage();
			}
		} else {
			/*session_destroy();*/
			//Limpa
			unset($_SESSION['sess']);
			unset($_SESSION['id_adm']);
			unset($_SESSION['admin']);
			unset($_SESSION['nivel']);
			unset($_SESSION['mat']);
			unset($_SESSION['dir']);
			unset($_SESSION['ger']);
			unset($_SESSION['rep']);
			unset($_SESSION['con']);
			unset($_SESSION['regiao']);


			$_SESSION['erro_sess'] = "erro";
			$redir = $host . "/adm/autentica.php";
			if ($grava_log == "S") {
				grava_log('erro_login', $id, 'admin', $log);
			}
		}

		//echo $redir;

		header('location:' . $redir);
		break;
}
?>