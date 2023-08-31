<?

$id=$_POST['id'];

$tipo=$_POST['tipo'];

$responsavel=$_POST['responsavel'];

$razao=$_POST['razao'];

$nome=$_POST['nome'];

$usual=$_POST['usual'];

$cpf_cnpj=$_POST['cpf_cnpj'];

$email=$_POST['email'];

$celular=$_POST['celular'];

$tel=$_POST['telefone'];

$senha=$_POST['senha'];

$senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

$cep=$_POST['cep'];

$endereco=$_POST['endereco'];

$bairro=$_POST['bairro'];

$numero=$_POST['numero'];

$cidade=$_POST['cidade'];

$uf=$_POST['uf'];

$dt_cadastro=$_POST['dt_cadastro'];

$ultimo_acesso=$_POST['ultimo_acesso'];

$status=$_POST['status'];

$nascimento=$_POST['nascimento'];
$pessoa_fisica_juridica = $_POST['fisico_juridico'];
list ($dia, $mes,  $ano) = explode ('/', $nascimento);
$nascimento = $ano."/".$mes."/".$dia;
$data_nascimento = $nascimento;


$id=str_replace("'","´",$id);

$tipo=str_replace("'","´",$tipo);

$razao=str_replace("'","´",$razao);

$nome=str_replace("'","´",$nome);

$usual=str_replace("'","´",$usual);

$cpf_cnpj=str_replace("'","´",$cpf_cnpj);

$email=str_replace("'","´",$email);

$celular=str_replace("'","´",$celular);

$senha=str_replace("'","´",$senha);

$cep=str_replace("'","´",$cep);

$endereco=str_replace("'","´",$endereco);

$bairo=str_replace("'","´",$bairo);

$cidade=str_replace("'","´",$cidade);

$uf=str_replace("'","´",$uf);

$dt_cadastro=str_replace("'","´",$dt_cadastro);

$ultimo_acesso=str_replace("'","´",$ultimo_acesso);

$status=str_replace("'","´",$status);

?>