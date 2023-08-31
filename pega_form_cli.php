<?
$id=$_POST['id'];
$id_ref=$id;
$tipo=$_POST['tipo'];
$razao=$_POST['razao'];
$nome=$_POST['nome'];
$usual=$_POST['usual'];
$cpf_cnpj=$_POST['cpf_cnpj'];
$rg_ie=$_POST['rg_ie'];
$sexo=$_POST['sexo'];        
$nascimento=$_POST['nascimento'];

if ($nascimento<>""){
	list ($dia, $mes,  $ano) = explode ('/', $nascimento);
	$nascimento = $ano."/".$mes."/".$dia;
}


$est_civil=$_POST['est_civil'];
$endereco=$_POST['endereco'];
$nro=$_POST['nro'];
$compl=$_POST['compl'];
$p_ref=$_POST['p_ref'];
$bairro=$_POST['bairro'];
$cidade=$_POST['cidade'];
$uf=$_POST['uf'];
$cep=$_POST['cep'];
$tel=$_POST['tel'];
$cel=$_POST['cel'];
$contato=$_POST['p_contato'];
$email=$_POST['email'];
$senha=$_POST['senha'];
$obs=$_POST['obs'];

$cad_por="Site";
$cli_pgto="1";//Padrão Varejo

$data= date('Y-m-d H:i:s');
$ip = $_SERVER["REMOTE_ADDR"];
$newsletter=Trim($_POST['newsletter']);
if($newsletter==""){$newsletter="N";}else{$newsletter="S";}
$status="A";

$razao=str_replace("'","´",$razao);
$nome=str_replace("'","´",$nome);
$usual=str_replace("'","´",$usual);
$endereco=str_replace("'","´",$endereco);
$nro=str_replace("'","´",$nro);
$compl=str_replace("'","´",$compl);
$p_ref=str_replace("'","´",$p_ref);
$bairro=str_replace("'","´",$bairro);
$cidade=str_replace("'","´",$cidade);
$senha=str_replace("'","´",$senha);

if ($obs<>""){
	$obs=str_replace("'","´",$obs);
}

?>
