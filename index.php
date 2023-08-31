<?

include("head.php");
if($var1=="adm"){
	include("adm/index.php");
  
}else{

  if ($zoom_site==""){$zoom_site=14;}
	if ($og_type==""){$og_type="website";}
	if ($img_site==""){$img_site=$host."/img/logo.png";}
	if ($temp_title_site<>""){$title_site=$temp_title_site;}
	if ($temp_description_site<>""){$description_site=$temp_description_site;}
	if ($temp_keywords_site<>""){$keywords_site=$temp_keywords_site;}

	$script="";

	if($var1=="comprar" || $var1=="vender" || $var1=="ajuda" || $var1=="institucional"){$mostra="institucional";}
  if($var1=="scooters" || $var1=="scooters-eletrica" || $var1=="scooters-novas" || $var1=="scooters-usadas" || $var1=="busca"){$mostra="scooters";}
	if($var1=="fipe"){$mostra="fipe";}
  if($var1=="blog"){$mostra="blog";}
  if($var1=="minha-conta"){$mostra="minha-conta";}
  if($var1=="comparar-scooters"){$mostra="comparar-scooters";}
  if($var1=="login"){$mostra="login";}
	if($var1=="ver"){$mostra="ver";}
	if($var1==""){$mostra="home";}
?>  
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title><?=$title_site;?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="<?=$host;?>/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?=$host;?>/css/bootstrap-icons.css" />
  <link rel="stylesheet" href="<?=$host;?>/css/fotorama.css" />
  <link rel="stylesheet" href="<?=$host;?>/css/datepicker.css" />
  <link rel="stylesheet" href="<?=$host;?>/css/owl.carousel.min.css" />
  <link rel="stylesheet" href="<?=$host;?>/css/owl.theme.default.min.css" />
  <link rel="stylesheet" href="<?=$host;?>/css/uploader.css" />
  <link rel="stylesheet" href="<?=$host;?>/estilo.css" />
  <style>
    .legenda-campos {
      font-weight: 300;
      font-size: 15px;
    }

    .legenda-campos-check {
      font-weight: normal;
      font-size: 15px;
    }
  </style>
</head>
<body>
  <main>


  <?
	include("topo.php");

	//echo "mostra:($mostra)";

	switch ($mostra){

		case "home":
			include("home.php");
		break;

    case "fipe":
			echo "<br><br><br>Mostra Fipe<br><br><br>";
		break;

    case "institucional":
			include("institucional.php");
		break;

    case "blog":
      include("blog.php");
		break;

    case "login":
			include("login.php");
		break;

    case "minha-conta":
			include ("minha_conta.php");
		break;

    case "comparar-scooters":
			echo "<br><br><br>Mostra scooters para comparação<br><br><br>";
		break;

    case "scooters":
      include ("scooters.php");
    break;

    case "ver":
			include ("ver_anuncio.php");
		break;
    

  }

  ?>
  </main>
  
  <? include("rodape.php");?>
  
  <button class="btn-to-top display-none"><i class="bi bi-arrow-up-short"></i></button>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="<?= $host; ?>/js/jquery.min.js"></script>
  <script src="<?= $host; ?>/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $host; ?>/js/func.js"></script>
  <script src="<?= $host; ?>/js/jquery-ui.min.js"></script>
	<script src="<?= $host; ?>/js/autocomplete.js"></script>
  <script src="<?= $host; ?>/js/jquery.mask.min.js"></script>
  <script src="<?= $host; ?>/js/jquery.validate.min.js"></script>
  <script src="<?= $host; ?>/js/jquery.maskMoney.min.js"></script>
  <script src="<?= $host; ?>/js/add_validate.js"></script>
	<script src="<?= $host; ?>/js/datepicker.js"></script>
	<script src="<?= $host; ?>/js/valida_form.js"></script>
  <script src="<?= $host; ?>/js/owl.carousel.min.js"></script>
  <script src="<?= $host; ?>/js/fotorama.js"></script>
  <script src="<?= $host; ?>/js//uploader.js"></script>
  <script src="<?= $host; ?>/adm/editor/ckeditor.js"></script>
	<script src="<?= $host; ?>/adm/editor/adapters/jquery.js"></script>
	

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
  <script type='text/javascript'>
		var host = "<?=$host;?>";
		var localizacao="<b><?=$nome_site;?></b><br><?=$endereco_site;?> - <?=$bairro_site;?><br><?=$cidade_site;?> - <?=$uf_site;?>";
		var latitude = "<?=$latitude_site;?>";
		var longitude = "<?=$longitude_site;?>";
		var zoom = "<?=$zoom_site;?>";
	</script>
  <script src="<?= $host; ?>/scripts.js"></script>
  <script src="<?= $host; ?>/https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>    
    setTimeout(function() {
      var mensagem = document.querySelector('.mensagem');
      if (mensagem) {
        mensagem.style.display = 'none';
      }
    },5000); 
  </script>
</body>

</html>

<?}?>