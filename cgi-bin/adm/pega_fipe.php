<?php

header( 'Cache-Control: no-cache' );

header('Content-type: text/html; charset=utf-8');

//header( 'Content-type: application/xml; charset="utf-8"', true );

setlocale(LC_ALL, "pt_BR");

setlocale(LC_MONETARY,"pt_BR", "ptb");



//https://parallelum.com.br/fipe/api/v1/motos/marcas/61/modelos/2583/anos/1992-1

/*

{"TipoVeiculo":1,"Valor":"R$ 118.429,00","Marca":"VW - VolksWagen","Modelo":"AMAROK High.CD 2.0 16V TDI 4x4 Dies. Aut","AnoModelo":2014,"Combustivel":"Diesel","CodigoFipe":"005340-6","MesReferencia":"maio de 2023","SiglaCombustivel":"D"}



TipoVeiculo: 1

Valor: "R$ 118.429,00"

Marca: "VW - VolksWagen"

Modelo: "AMAROK High.CD 2.0 16V TDI 4x4 Dies. Aut"

AnoModelo: 2014

Combustivel: "Diesel"

CodigoFipe: "005340-6"

MesReferencia: "maio de 2023"

SiglaCombustivel: "D"



*/

$recebe=$_POST['ano_fipe_motos'];

//'61|2583|1992-1



list ($id_marca,$id_modelo,$id_ano) = explode ('|', $recebe);



//$url='https://parallelum.com.br/fipe/api/v1/carros';

//$url='https://parallelum.com.br/fipe/api/v1/caminhoes';

//$url = 'https://parallelum.com.br/fipe/api/v1/motos';



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



/*

$preco=$preco.".00";

$preco=number_format($preco, 2, ',', '.');

*/

echo "<div style='border: 1px solid #000; background-color: #000; border-radius: 10px;' class=''>";
echo "<h4 class='mt-2 text-center' style='color:#FFFF00; font-size: 17px;'>Fipe $fipe_mes_ref<br> $fipe_valor</h4>";
echo "</div>";
$marca=$fipe_marca;

$modelo=$fipe_modelo;

$ano=$fipe_ano_modelo;



/*

jogar isso pro fim do formulário para ser alimentado pelo script abaixo

echo "<input type='hidden' class='form-control' name='marca_fipe' id='marca_fipe' value='$fipe_marca'>";

echo "<input type='hidden' class='form-control' name='modelo_fipe' id='modelo_fipe' value='$fipe_modelo'>";

echo "<input type='hidden' class='form-control' name='ano_fipe' id='ano_fipe' value='$fipe_ano_modelo'>";

echo "<input type='hidden' class='form-control' name='cod_fipe' id='cod_fipe' value='$fipe_cod_fipe'>";

echo "<input type='hidden' class='form-control' name='fipe_combustivel' id='fipe_combustivel' value='$fipe_combustivel'>";

*/



?>

<script>

//document.getElementById('chamada_api').value="<?php echo $chamada_api;?>";

//document.getElementById('retorno_api').value="<?php echo $result;?>";

document.getElementById('marca').value="<?php echo $marca;?>";

document.getElementById('modelo').value="<?php echo $modelo;?>";

document.getElementById('ano_modelo').value="<?php echo $ano;?>";

//document.getElementById('valor_carro').value="<?php echo $preco;?>";

document.getElementById('marca_fipe').value="<?php echo $id_marca;?>";

document.getElementById('modelo_fipe').value="<?php echo $id_modelo;?>";

document.getElementById('ano_fipe').value="<?php echo $id_ano;?>";

//document.getElementById('valor_carro').value="<?php echo $preco;?>";

document.getElementById('cod_fipe').value="<?php echo $fipe_cod_fipe;?>";

document.getElementById('fipe_combustivel').value="<?php echo $fipe_combustivel;?>";

document.getElementById('ano_fabricacao').value="";

document.getElementById('valor').value="";

</script>