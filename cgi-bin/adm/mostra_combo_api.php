<?php
header( 'Cache-Control: no-cache' );
//header('Content-type: text/html; charset=ISO-8859-1');
header('Content-type: text/html; charset=utf-8');
//header( 'Content-type: application/xml; charset="utf-8"', true );
setlocale(LC_ALL, "pt_BR");
//include("../conn.php");
//$conn=conecta();

$id = $_REQUEST['id'];
$mostra= $_REQUEST['m'];

if ($mostra=="mostra_modelo_moto" and $id<>""){
    //https://parallelum.com.br/fipe/api/v1/carros/marcas/59/modelos
    list ($id_marca,$marca) = explode ('|', $id);
   
	echo "<option value=''>Selecione o modelo</option>";

	//$url='https://parallelum.com.br/fipe/api/v1/carros';
	//$url='https://parallelum.com.br/fipe/api/v1/caminhoes';
	$url = 'https://parallelum.com.br/fipe/api/v1/motos/marcas/';
	$url .= $id_marca."/modelos";

    //echo "<option value=''>$id - $marca - $url</option>";

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($ch);
	$obj = json_decode($result, true);
	//print_r($result);
    $arr="modelos";
    //$arr="anos";
    foreach ($obj[$arr] as $p_mod) {
	    $codigo = $p_mod["codigo"];
	    $modelo = $p_mod["nome"];
	    echo "<option value='$id_marca|$marca|$codigo|$modelo'>$modelo</option>";
	}	

}

if ($mostra=="mostra_ano_moto" and $id<>""){
    
    //echo "<option value=''>$id</option>";
    //ID=61|AGRALE|2584|DAKAR 50

    //https://parallelum.com.br/fipe/api/v1/carros/marcas/59/modelos/5940/anos

    list ($id_marca,$marca,$id_modelo,$modelo) = explode ('|', $id);

    $url = "https://parallelum.com.br/fipe/api/v1/motos/marcas/$id_marca/modelos/$id_modelo/anos";

    echo "<option value=''>Selecione o ano</option>";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $obj = json_decode($result, true);

    foreach ($obj as $p_mod) {
        $codigo = $p_mod["codigo"];
        $ano = $p_mod["nome"];
        //echo "<br>Cod:$codigo - Modelo:$modelo";
        echo "<option value='$id_marca|$id_modelo|$codigo'>$ano</option>";
    }

}


?>