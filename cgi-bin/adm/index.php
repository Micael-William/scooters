<?php
session_start();

if($_SESSION['admin']==""){
	unset ($_SESSION['sess']);
	unset ($_SESSION['id_adm']);
	unset ($_SESSION['admin']);
	unset ($_SESSION['nivel']);
	unset ($_SESSION['loja']);
	header('location:'.$host.'/adm/autentica.php');
}else{
	$pg = $var2;

	include("permissoes_adm.php"); 

	if($pg_inicial==""){$pg_inicial="inicial";}
	if($pg==""){$pg=$pg_inicial;}
	if($url==""){$redir="location:".$pg_inicial;header($redir);die();}

	$acao=$_REQUEST['acao'];
	$sessao=$_REQUEST['sessao'];

	if ($var1=="sair" or $pg=="sair"){
		//grava_log('logoff',$session_cli,'---','');	
		//session_destroy();
		unset ($_SESSION['sess']);
		unset ($_SESSION['id_adm']);
		unset ($_SESSION['admin']);
		unset ($_SESSION['nivel']);
		unset ($_SESSION['loja']);
		$expira=time()-1;
		setcookie ("base_ck","",$expira);
		header('Location:'.$host);	
		die();
	}else{
		if ($meta_tit==""){$meta_tit=$nome_site;}
		?>
		<!DOCTYPE html>
		<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
		<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
		<!--[if gt IE 9]><!-->
		<html>
		<!--<![endif]-->

		<head>
			<title><?php echo $meta_tit;?></title>
			<?php echo $meta_cache;?>
			<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>">
			<meta name="Author" content="Portal Hosting Soluções Web">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="shortcut icon" href="<?=$host;?>/img/favicon.ico">
			<link rel="stylesheet" href="<?=$host;?>/adm/css/bootstrap.min.css" media="all" type="text/css" />
			<link rel="stylesheet" href="<?=$host;?>/adm/css/font-awesome.min.css" media="all" type="text/css" />
			<link rel="stylesheet" href="<?=$host;?>/adm/css/uploader.css" media="all" type="text/css" />
			<link rel="stylesheet" href="<?=$host;?>/adm/css/datepicker.css" media="all" type="text/css" />
			<link rel="stylesheet" href="<?=$host;?>/adm/css/jquery-ui.css" rel="stylesheet">
			<!-- <link rel="stylesheet" href="<?=$host;?>/adm/css/bootstrap-select.min.css" rel="stylesheet"> -->
			<link rel="stylesheet" href="<?=$host;?>/adm/estilo.css" media="all" type="text/css" />
	
			<!--  -->
			<!-- <link rel="stylesheet" href="<?=$host;?>/bootstrap-select.css" rel="stylesheet"> -->
			<!-- <link rel="stylesheet" href="<?=$host;?>/css/jquery-ui.css" rel="stylesheet"> -->
			<!-- <link rel="stylesheet" href="<?=$host;?>/css/ui.css" media="all" type="text/css" />-->
			<!-- <link rel="stylesheet" href="<?=$host;?>/css/jquery.autocomplete.css" media="all" type="text/css" /> -->
    		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
		</head>
		<body>
			<div class="faixa_menu">
				<?php include("menu_adm.php"); ?>
			</div>

			<div class="clear"></div>

			<div class="conteudo">

				<div class="container">

				<?php
				//echo "ADM:".$_SESSION['id_adm'];
				//echo "var1:$var1 - var2:$var2 / Pg:$pg";
				echo "<br>";
				switch ($pg){

				
					Case "banner": 
						include("banners_adm.php");
					break;

					Case "blog": 
						include("blog_adm.php");
					break;

					Case "blog_assuntos": 
						include("blog_assuntos_adm.php");
					break;
					
					Case "clientes": 
						include("clientes_adm.php");
					break;

					Case "config": 
						include("config_adm.php");
					break;
					
					Case "inicial":
						include("inicial_adm.php");
					break;

					Case "institucional":
						include("institucional_adm.php");
					break;

					Case "rodape_site": 
						include("rodape_site_adm.php");
					break;

					Case "usuarios": 
						include("usuarios_adm.php");
					break;

					Case "veiculos": 
						include("veiculos_adm.php");
					break;

					Default:
						echo "<br><br><br><br><p class='text-center'>Ops...<br><br><br><br>";
				}
			
				?>
				<br><br>
				</div>
			</div>
		</div>
		<!-- Fim conteúdo -->
		<div id="footer">
			<div class="container">
				<p class="text-end text-11"><b><a href='http://www.tgamarketing.com.br' target='_blank'>TGA Marketing - Desenvolvimento e Soluções WEB</a></b></p><br><br><br>
			</div>
		</div>

		<script type='text/javascript'>
			var host = "<?=$host;?>";
			var localizacao="<b><?=$nome_site;?></b><br><?=$endereco_site;?> - <?=$bairro_site;?><br><?=$cidade_site;?> - <?=$uf_site;?>";
			var latitude = "<?=$latitude_site;?>";
			var longitude = "<?=$longitude_site;?>";
			var zoom = "<?=$zoom_site;?>";
		</script>

		<script type="text/javascript" src="<?=$host;?>/adm/js/jquery.min.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?=$host;?>/adm/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?=$host;?>/adm/js/func.js"></script>
		<?if($uploader=="S"){?>
			<script type="text/javascript" src="<?=$host;?>/adm/js/uploader.js"></script>
		<?}?>
		<script type="text/javascript" src="<?=$host;?>/adm/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?=$host;?>/adm/js/autocomplete.js"></script>

		<script type="text/javascript" src="<?=$host;?>/adm/js/jquery.mask.min.js"></script>
		<script type="text/javascript" src="<?=$host;?>/adm/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?=$host;?>/adm/js/jquery.maskMoney.min.js"></script>
		<script type="text/javascript" src="<?=$host;?>/adm/js/add_validate.js"></script>
		<!-- <script type="text/javascript" src="<?=$host;?>/adm/js/bootstrap-select.min.js"></script> -->
		<script type="text/javascript" src="<?=$host;?>/adm/js/datepicker.js"></script>
		<script type="text/javascript" src="<?=$host;?>/adm/valida_form.js"></script>

		<script type="text/javascript" src="<?=$host;?>/adm/editor/ckeditor.js"></script>
		<script type="text/javascript" src="<?=$host;?>/adm/editor/adapters/jquery.js"></script>


    	<script type="text/javascript" src="<?=$host;?>/adm/script_adm.js"></script>

		</body>

		</html>

		<?php
		}//sair
	} // login
?>