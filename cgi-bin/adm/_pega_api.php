<?
include("../conn.php");
$conn=conecta();
/*
https://parallelum.com.br/fipe/api/v1/carros/marcas
https://parallelum.com.br/fipe/api/v1/carros/marcas/59/modelos
https://parallelum.com.br/fipe/api/v1/carros/marcas/59/modelos/5940/anos
https://parallelum.com.br/fipe/api/v1/carros/marcas/59/modelos/5940/anos/2014-3
*/
//MARCAS

//$url='https://parallelum.com.br/fipe/api/v1/carros';
//$url='https://parallelum.com.br/fipe/api/v1/caminhoes';

$url = 'https://parallelum.com.br/fipe/api/v1/motos';
$url .= "/marcas";

$url ="https://parallelum.com.br/fipe/api/v1/carros/marcas";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$obj = json_decode($result, true);
//print_r($result);
foreach ($obj as $valor) {
	$codigo = $valor["codigo"];
	$marca = $valor["nome"];
	echo "<br>Cod:$codigo - Marca:$marca";
}



//MODELOS
/*
$id="60|AGRALE";

list ($id,$marca) = explode ('|', $id);

$url = "https://parallelum.com.br/fipe/api/v1/motos/marcas/";
$url.= $id."/modelos";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$obj = json_decode($result, true);

echo "<pre>";
print_r($obj['modelos']);
echo "</pre>";

//echo "<pre>";
//print_r($obj['anos']);
//echo "</pre>";

$arr="modelos";
//$arr="anos";
foreach ($obj[$arr] as $p_mod) {
	$codigo = $p_mod["codigo"];
	$modelo = $p_mod["nome"];
	echo "<br>Cod:$codigo - Modelo:$modelo";
}
*/

/*
//ANOS
//https://parallelum.com.br/fipe/api/v1/carros/marcas/59/modelos/5940/anos
//https://parallelum.com.br/fipe/api/v1/motos/marcas/61/modelos/2583/anos
echo "ANOS<hr>";
$id="61|2583";

list ($id_marca,$id_modelo) = explode ('|', $id);

$url = "https://parallelum.com.br/fipe/api/v1/motos/marcas/$id_marca/modelos/$id_modelo/anos";
echo $url."<hr>";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$obj = json_decode($result, true);

//echo "<pre>";
//print_r($obj);
//echo "</pre>";

//echo "<pre>";
//print_r($obj['anos']);
//echo "</pre>";

//$arr="modelos";
//$arr="anos";
foreach ($obj as $p_mod) {
	$codigo = $p_mod["codigo"];
	$modelo = $p_mod["nome"];
	echo "<br>Cod:$codigo - Modelo:$modelo";
}
*/
?>