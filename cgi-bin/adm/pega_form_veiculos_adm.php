<?

$id=$_POST['id'];

$usuario=$_POST['usuario'];

$tipo=$_POST['tipo'];

$marca_fipe=$_POST['marca_fipe'];

$modelo_fipe=$_POST['modelo_fipe'];

$ano_fipe=$_POST['ano_fipe'];

$cod_fipe=$_POST['cod_fipe'];

$destaque=$_POST['destaque'];

$gp_anuncio=$_POST['gp_anuncio'];

$marca=$_POST['marca'];

$modelo=$_POST['modelo'];

$versao=$_POST['versao'];

$ano_modelo=$_POST['ano_modelo'];

$ano_fabricacao=$_POST['ano_fabricacao'];

$valor=$_POST['valor'];

$placa=$_POST['placa'];

$cor=$_POST['cor'];

$combustivel=$_POST['combustivel'];

$fipe_combustivel=$_POST['fipe_combustivel'];

$km=$_POST['km'];

$chassi=$_POST['chassi'];

$renavam=$_POST['renavam'];

$opcionais=$_POST['opcionais'];

$infos=$_POST['infos'];

$texto=$_POST['texto'];

$carro=$_POST['carro'];

$portas=$_POST['portas'];

$cambio=$_POST['cambio'];

$motos=$_POST['motos'];

$cilindradas=$_POST['cilindradas'];

$estilo=$_POST['estilo'];

$refrigeracao=$_POST['refrigeracao'];

$partida=$_POST['partida'];

$motor=$_POST['motor'];

$alimentacao=$_POST['alimentacao'];

$freios=$_POST['freios'];

$nro_marchas=$_POST['nro_marchas'];

$cep=$_POST['cep'];

$uf=$_POST['uf'];

$cidade=$_POST['cidade'];

$cad_por=$_POST['cad_por'];

$tp_adm=$_POST['tp_adm'];

$dt_cadastro=$_POST['dt_cadastro'];

$ult_alteracao=$_POST['ult_alteracao'];

$dt_desativacao=$_POST['dt_desativacao'];

$api=$_POST['api'];

$chamada_api=$_POST['chamada_api'];

$retorno_api=$_POST['retorno_api'];

$status=$_POST['status'];



$id=str_replace("'","´",$id);

$usuario=str_replace("'","´",$usuario);

$tipo=str_replace("'","´",$tipo);

$marca_fipe=str_replace("'","´",$marca_fipe);

$modelo_fipe=str_replace("'","´",$modelo_fipe);

$ano_fipe=str_replace("'","´",$ano_fipe);

$cod_fipe=str_replace("'","´",$cod_fipe);

$destaque=str_replace("'","´",$destaque);

$gp_anuncio=str_replace("'","´",$gp_anuncio);

$marca=str_replace("'","´",$marca);

$modelo=str_replace("'","´",$modelo);

$versao=str_replace("'","´",$versao);

$ano_modelo=str_replace("'","´",$ano_modelo);

$ano_fabricacao=str_replace("'","´",$ano_fabricacao);

$valor=str_replace("'","´",$valor);

$placa=str_replace("'","´",$placa);

$cor=str_replace("'","´",$cor);

$combustivel=str_replace("'","´",$combustivel);

$fipe_combustivel=str_replace("'","´",$fipe_combustivel);

$km=str_replace("'","´",$km);

$chassi=str_replace("'","´",$chassi);

$renavam=str_replace("'","´",$renavam);

$opcionais=str_replace("'","´",$opcionais);

$infos=str_replace("'","´",$infos);

$texto=str_replace("'","´",$texto);

$carro=str_replace("'","´",$carro);

$portas=str_replace("'","´",$portas);

$cambio=str_replace("'","´",$cambio);

$motos=str_replace("'","´",$motos);

$cilindradas=str_replace("'","´",$cilindradas);

$estilo=str_replace("'","´",$estilo);

$refrigeracao=str_replace("'","´",$refrigeracao);

$partida=str_replace("'","´",$partida);

$motor=str_replace("'","´",$motor);

$alimentacao=str_replace("'","´",$alimentacao);

$freios=str_replace("'","´",$freios);

$nro_marchas=str_replace("'","´",$nro_marchas);

$cep=str_replace("'","´",$cep);

$uf=str_replace("'","´",$uf);

$cidade=str_replace("'","´",$cidade);

$cad_por=str_replace("'","´",$cad_por);

$tp_adm=str_replace("'","´",$tp_adm);

$dt_cadastro=str_replace("'","´",$dt_cadastro);

$ult_alteracao=str_replace("'","´",$ult_alteracao);

$dt_desativacao=str_replace("'","´",$dt_desativacao);

$api=str_replace("'","´",$api);

$chamada_api=str_replace("'","´",$chamada_api);

$retorno_api=str_replace("'","´",$retorno_api);

$status=str_replace("'","´",$status);





// depois meter um if tipo de veiculo para pegar as infos e opcionais de cada um

$nro_infos_moto=$_POST['nro_infos_moto'];

$infos="";

for ($x = 1; $x <= $nro_infos_moto; $x++) {  

	$id_infos=$_POST['infos_moto_id_'.$x];

	$nome_infos=$_POST['infos_moto_nome_'.$x];$nome_infos=str_replace("'","´",$nome_infos);

	$infos_tem=$_POST['infos_moto_tem_'.$x];

	$infos_exibe=$_POST['infos_moto_exibe_'.$x];

	$infos.=$id_infos."¬".$infos_tem."¬".$infos_exibe."¬".$nome_infos."¨";

}



$nro_opcionais_moto=$_POST['nro_opcionais_moto'];

$opcionais="";

for ($x = 1; $x <= $nro_opcionais_moto; $x++) {  

	$id_opcionais=$_POST['opcionais_moto_id_'.$x];

	$nome_opcionais=$_POST['opcionais_moto_nome_'.$x];$nome_opcionais=str_replace("'","´",$nome_opcionais);

	$opcionais_tem=$_POST['opcionais_moto_tem_'.$x];

	$opcionais_exibe=$_POST['opcionais_moto_tem_exibe_'.$x];

	$opcionais.=$id_opcionais."¬".$opcionais_tem."¬".$opcionais_exibe."¬".$nome_opcionais."¨";



}

?>