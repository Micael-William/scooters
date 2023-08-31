<?php



function pega_fipe($fipe){

  //'61|2583|1992-1

  

  list ($id_marca,$id_modelo,$id_ano) = explode ('|', $fipe);

  list ($id_ano,$tp_combustivel) = explode ('|', $id_ano);



  $url="https://parallelum.com.br/fipe/api/v1/motos/marcas/$id_marca/modelos/$id_modelo/anos/$id_ano";



  echo "<input type='hidden' class='form-control' name='chamada_api' id='chamada_api' value='$url'>";

  

  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  

  $result = curl_exec($ch);

  $obj = json_decode($result, true);

  echo "<input type='hidden' class='form-control' name='retorno_api' id='retorno_api' value='$result'>";

  

  $fipe_tipo=$obj["TipoVeiculo"];

  $fipe_valor=$obj["Valor"];

  $fipe_marca=$obj["Marca"];

  $fipe_modelo=$obj["Modelo"];

  $fipe_ano_modelo=$obj["AnoModelo"];

  $fipe_combustivel=$obj["Combustivel"];

  $fipe_cod_fipe=$obj["CodigoFipe"];

  $fipe_mes_ref=$obj["MesReferencia"]; 

  $fipe_sigla_combustivel=$obj=["SiglaCombustivel"];


  echo "<div style='border: 1px solid #000; background-color: #000; border-radius: 10px;' class=''>";
  echo "<h4 class='mt-2 text-center' style='color:#FFFF00; font-size: 16px;'>Fipe $fipe_mes_ref <br>$fipe_valor</h4>";
  echo "</div>";


  $marca=$fipe_marca;

  $modelo=$fipe_modelo;

  $ano=$fipe_ano_modelo;



  ?>

    <script>

    document.getElementById('marca').value="<?php echo $marca;?>";

    document.getElementById('modelo').value="<?php echo $modelo;?>";

    document.getElementById('ano_modelo').value="<?php echo $ano;?>";

    document.getElementById('marca_fipe').value="<?php echo $id_marca;?>";

    document.getElementById('modelo_fipe').value="<?php echo $id_modelo;?>";

    document.getElementById('ano_fipe').value="<?php echo $id_ano;?>";

    document.getElementById('cod_fipe').value="<?php echo $fipe_cod_fipe;?>";

    document.getElementById('fipe_combustivel').value="<?php echo $fipe_combustivel;?>";

    document.getElementById('ano_fabricacao').value="";

    document.getElementById('valor').value="";

    </script>

  <?

}





function grava_log($historico,$id_registro,$tabela,$acao){

	$data= date('Y-m-d H:i:s');

	$usuario=$_SESSION['id_adm'];

	$tp_user=$_SESSION['nivel'];

	$historico=str_replace("'","´",$historico);

	$acao=str_replace("'","´",$acao);

	$ip = $_SERVER["REMOTE_ADDR"];

	

	$conn=conecta();

	try {

		$sql="insert into logs (data,usuario,tp_user,historico,id_registro,tabela,acao,ip) values (:data,:usuario,:tp_user,:historico,:id_registro,:tabela,:acao,:ip)";

		$ins = $conn->prepare($sql);

		$ins -> bindParam(':data',$data,PDO::PARAM_STR);

		$ins -> bindParam(':usuario',$usuario,PDO::PARAM_STR);

		$ins -> bindParam(':tp_user',$tp_user,PDO::PARAM_STR);

		$ins -> bindParam(':historico',$historico,PDO::PARAM_STR);

		$ins -> bindParam(':id_registro',$id_registro,PDO::PARAM_STR);

		$ins -> bindParam(':tabela',$tabela,PDO::PARAM_STR);

		$ins -> bindParam(':acao',$acao,PDO::PARAM_STR);

		$ins -> bindParam(':ip',$ip,PDO::PARAM_STR);

		$ins -> execute();



	}catch(PDOException $e) {

	  echo 'Erro: '.$e->getMessage();

	}

}





function grava_log_cli($cli,$historico){

	$data= date('Y-m-d H:i:s');

	$usuario=$cli;

	$historico=str_replace("'","´",$historico);

	$ip = $_SERVER["REMOTE_ADDR"];

	$conn=conecta();

	try {

		$sql="insert into logs_acessos_cli (data,usuario,historico,ip) values (:data,:usuario,:historico,:ip)";

		$ins = $conn->prepare($sql);

		$ins -> bindParam(':data',$data,PDO::PARAM_STR);

		$ins -> bindParam(':usuario',$usuario,PDO::PARAM_STR);

		$ins -> bindParam(':historico',$historico,PDO::PARAM_STR);

		$ins -> bindParam(':ip',$ip,PDO::PARAM_STR);

		$ins -> execute();



	}catch(PDOException $e) {

	  echo 'Erro: '.$e->getMessage();

	}

}



function grava_log_barco($usuario,$tp_user,$historico,$id_ref,$log){

	$data= date('Y-m-d H:i:s');

	$historico=str_replace("'","´",$historico);

  $log=str_replace("'","´",$log);

	$ip = $_SERVER["REMOTE_ADDR"];

	$conn=conecta();

	try {

		$sql="insert into log_barco (data,historico,usuario,tp_user,id_ref,log,ip) values (:data,:historico,:usuario,:tp_user,:id_ref,:log,:ip)";

		$ins = $conn->prepare($sql);

		$ins -> bindParam(':data',$data,PDO::PARAM_STR);

    $ins -> bindParam(':historico',$historico,PDO::PARAM_STR);

    $ins -> bindParam(':usuario',$usuario,PDO::PARAM_STR);

		$ins -> bindParam(':tp_user',$tp_user,PDO::PARAM_STR);

    $ins -> bindParam(':id_ref',$id_ref,PDO::PARAM_STR);

    $ins -> bindParam(':log',$log,PDO::PARAM_STR);

		$ins -> bindParam(':ip',$ip,PDO::PARAM_STR);

		$ins -> execute();

	}catch(PDOException $e) {

	  echo 'Erro: '.$e->getMessage();

	}

}





function grava_log_veiculo($usuario,$tp_user,$historico,$id_ref,$log){

	$data= date('Y-m-d H:i:s');

	$historico=str_replace("'","´",$historico);

  $log=str_replace("'","´",$log);

	$ip = $_SERVER["REMOTE_ADDR"];

	$conn=conecta();

	try {

		$sql="insert into log_veiculo (data,historico,usuario,tp_user,id_ref,log,ip) values (:data,:historico,:usuario,:tp_user,:id_ref,:log,:ip)";

		$ins = $conn->prepare($sql);

		$ins -> bindParam(':data',$data,PDO::PARAM_STR);

    $ins -> bindParam(':historico',$historico,PDO::PARAM_STR);

    $ins -> bindParam(':usuario',$usuario,PDO::PARAM_STR);

		$ins -> bindParam(':tp_user',$tp_user,PDO::PARAM_STR);

    $ins -> bindParam(':id_ref',$id_ref,PDO::PARAM_STR);

    $ins -> bindParam(':log',$log,PDO::PARAM_STR);

		$ins -> bindParam(':ip',$ip,PDO::PARAM_STR);

		$ins -> execute();

	}catch(PDOException $e) {

	  echo 'Erro: '.$e->getMessage();

	}

}



Function url_amigavel($string) {



	//https://sounoob.com.br/slugify-converter-texto-em-slug-com-php/#code



    $string = preg_replace('/[\t\n]/', ' ', $string);

    $string = preg_replace('/\s{2,}/', ' ', $string);

    $list = array(

        'Š' => 'S',

        'š' => 's',

        'Đ' => 'Dj',

        'đ' => 'dj',

        'Ž' => 'Z',

        'ž' => 'z',

        'Č' => 'C',

        'č' => 'c',

        'Ć' => 'C',

        'ć' => 'c',

        'À' => 'A',

        'Á' => 'A',

        'Â' => 'A',

        'Ã' => 'A',

        'Ä' => 'A',

        'Å' => 'A',

        'Æ' => 'A',

        'Ç' => 'C',

        'È' => 'E',

        'É' => 'E',

        'Ê' => 'E',

        'Ë' => 'E',

        'Ì' => 'I',

        'Í' => 'I',

        'Î' => 'I',

        'Ï' => 'I',

        'Ñ' => 'N',

        'Ò' => 'O',

        'Ó' => 'O',

        'Ô' => 'O',

        'Õ' => 'O',

        'Ö' => 'O',

        'Ø' => 'O',

        'Ù' => 'U',

        'Ú' => 'U',

        'Û' => 'U',

        'Ü' => 'U',

        'Ý' => 'Y',

        'Þ' => 'B',

        'ß' => 'Ss',

        'à' => 'a',

        'á' => 'a',

        'â' => 'a',

        'ã' => 'a',

        'ä' => 'a',

        'å' => 'a',

        'æ' => 'a',

        'ç' => 'c',

        'è' => 'e',

        'é' => 'e',

        'ê' => 'e',

        'ë' => 'e',

        'ì' => 'i',

        'í' => 'i',

        'î' => 'i',

        'ï' => 'i',

        'ð' => 'o',

        'ñ' => 'n',

        'ò' => 'o',

        'ó' => 'o',

        'ô' => 'o',

        'õ' => 'o',

        'ö' => 'o',

        'ø' => 'o',

        'ù' => 'u',

        'ú' => 'u',

        'û' => 'u',

        'ý' => 'y',

        'ý' => 'y',

        'þ' => 'b',

        'ÿ' => 'y',

        'Ŕ' => 'R',

        'ŕ' => 'r',

        '/' => '-',

        ' ' => '-',

        '.' => '-',

		"'" => '',

		'+' => '',

		'(' => '',

		')' => '',

		',' => ''



    );



	$string = strtr($string, $list);

    $string = preg_replace('/-{2,}/', '-', $string);

    $string = strtolower($string);



    return $string;

}





function resimage($imagem, $larg, $alt, $path,$class){

	

	$diretorio="imagens";

	

	//echo $diretorio."/".$imagem;

	list($largura, $altura) = getimagesize($diretorio."/".$imagem);

	if($larg==""){$larg=$largura;}

	if($alt==""){$alt=$altura;}

	

	$size=$larg."x".$alt;



	$array  = explode('.', $imagem);

	$ubound=count($array);



	if ($ubound>1){$extensao=$array[$ubound-1];}



	$nome="";

	for($x=0;$x<$ubound-1;$x++){

		$nome=$nome.$array[$x];

	}			



	$srcPath = $diretorio."/".$imagem;

	$dstPath = $diretorio."/redim/".$nome."_".$size.".".$extensao;



	if(file_exists($path.$dstPath)){

		//unlink( $arquivo );

	}else{

	

		//echo "path:$dstPath";

		

		list($w, $h, $type) = getimagesize($srcPath);



		switch ($type) {

				case IMAGETYPE_JPEG:

						$src = imagecreatefromjpeg($srcPath);

						break;

				case IMAGETYPE_PNG:

						$src = imagecreatefrompng($srcPath);

						break;

				case IMAGETYPE_GIF:

						$src = imagecreatefromgif($srcPath);

						break;

				case IMAGETYPE_BMP:

						$src = imagecreatefrombmp($srcPath);

						break;

		}



		list($dst_w, $dst_h) = explode('x', $size);

		$dst = imagecreatetruecolor($dst_w, $dst_h);



		$dst_x = $dst_y = 0;

		$src_x = $src_y = 0;



		if ($dst_w / $dst_h < $w / $h) {

				$src_w = $h * ($dst_w / $dst_h);

				$src_h = $h;

				$src_x = ($w - $src_w) / 2;

				$src_y = 0;

		} else {

				$src_w = $w;

				$src_h = $w * ($dst_h / $dst_w);

				$src_x = 0;

				$src_y = ($h - $src_h) / 2;

		}



		imagecopyresampled($dst, $src, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

		imagejpeg($dst, $dstPath);

		imagedestroy($src);

		imagedestroy($dst);

	}

	echo "<img src='$path$dstPath' class='$class'>";

	$dstPath="";

}





Function RemoveAcentos($string){

  $string = preg_replace('/[\t\n]/', ' ', $string);

   $string = preg_replace('/\s{2,}/', ' ', $string);

   $list = array(

       'Š' => 'S',

       'š' => 's',

       'Đ' => 'Dj',

       'đ' => 'dj',

       'Ž' => 'Z',

       'ž' => 'z',

       'Č' => 'C',

       'č' => 'c',

       'Ć' => 'C',

       'ć' => 'c',

       'À' => 'A',

       'Á' => 'A',

       'Â' => 'A',

       'Ã' => 'A',

       'Ä' => 'A',

       'Å' => 'A',

       'Æ' => 'A',

       'Ç' => 'C',

       'È' => 'E',

       'É' => 'E',

       'Ê' => 'E',

       'Ë' => 'E',

       'Ì' => 'I',

       'Í' => 'I',

       'Î' => 'I',

       'Ï' => 'I',

       'Ñ' => 'N',

       'Ò' => 'O',

       'Ó' => 'O',

       'Ô' => 'O',

       'Õ' => 'O',

       'Ö' => 'O',

       'Ø' => 'O',

       'Ù' => 'U',

       'Ú' => 'U',

       'Û' => 'U',

       'Ü' => 'U',

       'Ý' => 'Y',

       'Þ' => 'B',

       'ß' => 'Ss',

       'à' => 'a',

       'á' => 'a',

       'â' => 'a',

       'ã' => 'a',

       'ä' => 'a',

       'å' => 'a',

       'æ' => 'a',

       'ç' => 'c',

       'è' => 'e',

       'é' => 'e',

       'ê' => 'e',

       'ë' => 'e',

       'ì' => 'i',

       'í' => 'i',

       'î' => 'i',

       'ï' => 'i',

       'ð' => 'o',

       'ñ' => 'n',

       'ò' => 'o',

       'ó' => 'o',

       'ô' => 'o',

       'õ' => 'o',

       'ö' => 'o',

       'ø' => 'o',

       'ù' => 'u',

       'ú' => 'u',

       'û' => 'u',

       'ý' => 'y',

       'ý' => 'y',

       'þ' => 'b',

       'ÿ' => 'y',

       'Ŕ' => 'R',

       'ŕ' => 'r',

       '/' => '-',

       ' ' => '-',

       '.' => '-',

   );



   $string = strtr($string, $list);

   $string = preg_replace('/-{2,}/', '-', $string);

   //$string = strtolower($string);

   return $string;

}





function Sorteia ($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){

	// tamanho default = 8

	// Caracteres de cada tipo

	$lmin = 'abcdefghijklmnopqrstuvwxyz';

	$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	$num = '1234567890';

	$simb = '!@#$%*-';



	// Variáveis internas

	$retorno = '';

	$caracteres = '';



	// Agrupamos todos os caracteres que poderão ser utilizados

	$caracteres .= $lmin;

	if ($maiusculas) $caracteres .= $lmai;

	if ($numeros) $caracteres .= $num;

	if ($simbolos) $caracteres .= $simb;



	// Calculamos o total de caracteres possíveis

	$len = strlen($caracteres);



	for ($n = 1; $n <= $tamanho; $n++) {

	// Criamos um número aleatório de 1 até $len para pegar um dos caracteres

	$rand = mt_rand(1, $len);

	// Concatenamos um dos caracteres na variável $retorno

	$retorno .= $caracteres[$rand-1];

	}



	return $retorno;



	// Gera uma senha com 10 carecteres: letras (min e mai), números Ex: gfUgF3e5m7

	// $senha = Sorteia(10);



	// Gera uma senha com 9 carecteres: letras (min e mai) Ex: BJnCYupsN

	// $senha = Sorteia(9, true, false);





	// Gera uma senha com 6 carecteres: letras minúsculas e números	Ex: sowz0g

	// $senha = Sorteia(6, false, true);



	// Gera uma senha com 15 carecteres de números, letras e símbolos  Ex: fnwX@dGO7P0!iWM

	// $senha = Sorteia(15, true, true, true);

}

 

?>