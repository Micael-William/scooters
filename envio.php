<?php
$charset="UTF-8";
//$charset="ISO-8859-1";
header("Content-type: text/html; charset=".$charset,true);
setlocale(LC_ALL, "pt_BR");
setlocale(LC_MONETARY,"pt_BR", "ptb");

$envia=$_POST['envia'];

switch ($envia){

	case "contato":

		$envia="Ok";

		$nome=$_POST['nome'];
		$telefones=$_POST['telefones'];
		$email=$_POST['email'];
		$assunto=$_POST['assunto'];

		$mensagem_txt = $_POST['mensagem'];
		$mensagem = nl2br($_POST['mensagem']);

		if($assunto==""){$assunto="Contato";}

$msn="<html><head><meta http-equiv='content-type' content='text/html; charset=$charset'></head>
<body><font face=arial size=2>
Dados enviados através do formulário de contato do site.<br><br>
<b>Nome:</b>$nome<br>
<b>Telefone(s):</b>$telefones<br>
<b>Email:</b>$email<br>
<b>Mensagem:</b>$mensagem<br>
</body>
</html>";	

		$i_nome=str_replace("'","´",$nome);
		$i_email=str_replace("'","´",$email);
		$i_msn=str_replace("'","´",$msn);
		
		$i_data = date('Y-m-d H:i:s');
		$sql = 'insert into emails (data,nome,email,msn,status) values(:i_data,:i_nome,:i_email,:i_msn,:i_status)';
		$ins = $conn->prepare($sql);
		$ins -> bindParam(':i_data',$i_data,PDO::PARAM_STR);
		$ins -> bindParam(':i_nome',$i_nome,PDO::PARAM_STR);
		$ins -> bindParam(':i_email',$i_email,PDO::PARAM_STR);
		$ins -> bindParam(':i_msn',$i_msn,PDO::PARAM_STR);
		$ins -> bindParam(':i_status',$i_status,PDO::PARAM_STR);
		$ins -> execute();

	break;
	
	case "contato_2":

		$envia="Ok";

		$nome=$_POST['nome'];
		$email=$_POST['email'];
		$cidade=$_POST['cidade'];
		$uf=$_POST['uf'];
		$telefones=$_POST['telefones'];

		if(isset($_POST["como_encontrou"])) { 
			foreach($_POST["como_encontrou"] as $valor) {$como_encontrou.=$valor.","; } 
			$como_encontrou=substr($como_encontrou,0,-1);
		}

		$mensagem_txt = $_POST['mensagem'];
		$mensagem = nl2br($_POST['mensagem']);

		$assunto=$_POST['assunto'];
		if($assunto==""){$assunto="Contato";}

$msn="<html><head><meta http-equiv='content-type' content='text/html; charset=$charset'></head>
<body><font face=arial size=2>
Dados enviados através do formulário de contato do site.<br><br>
<b>Nome:</b>$nome<br>
<b>Email:</b>$email<br>
<b>Cidade:</b>$cidade - $uf<br>
<b>Telefone(s):</b>$telefones<br>
<b>Como nos encontrou:</b>$como_encontrou<br>
<b>Mensagem:</b>$mensagem<br>
</body>
</html>";	

		$i_nome=str_replace("'","´",$nome);
		$i_email=str_replace("'","´",$email);
		$i_msn=str_replace("'","´",$msn);
		
		$i_data = date('Y-m-d H:i:s');
		$sql = 'insert into emails (data,nome,email,msn,status) values(:i_data,:i_nome,:i_email,:i_msn,:i_status)';
		$ins = $conn->prepare($sql);
		$ins -> bindParam(':i_data',$i_data,PDO::PARAM_STR);
		$ins -> bindParam(':i_nome',$i_nome,PDO::PARAM_STR);
		$ins -> bindParam(':i_email',$i_email,PDO::PARAM_STR);
		$ins -> bindParam(':i_msn',$i_msn,PDO::PARAM_STR);
		$ins -> bindParam(':i_status',$i_status,PDO::PARAM_STR);
		$ins -> execute();

	break;

	case "news":

		//$envia="Ok";
		if($assunto==""){$assunto="Newsletter";}

		$email=$_POST['email'];
		$i_email=str_replace("'","´",$email);
		$i_data = date('Y-m-d H:i:s');
		$i_status="A";

		include("conn.php");
		$conn=conecta();

		$sql = 'insert into newsletter (data,email,status) values(:i_data,:i_email,:i_status)';
		$ins = $conn->prepare($sql);
		$ins -> bindParam(':i_data',$i_data,PDO::PARAM_STR);
		$ins -> bindParam(':i_email',$i_email,PDO::PARAM_STR);
		$ins -> bindParam(':i_status',$i_status,PDO::PARAM_STR);
		$ins -> execute();

		$envio="<div class='alert alert-success alert-dismissible' role='alert'>";
		$envio=$envio."<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button>";
		$envio=$envio."E-mail cadastrado com sucesso.";
		$envio=$envio."</div>";

		//echo $envio;

	break;

	

} //switch


if ($envia == "Ok") {

	//$email_site="portalhosting@hotmail.com";

	require 'mailer/class.phpmailer.php';

	$mail = new PHPMailer();
	$mail->IsSMTP();
	/*
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	*/
	$mail->Host = $sv;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->CharSet = 'UTF-8';
	$mail->Username = $ea;
	$mail->Password = $sa;

	$mail->From = $ea;
	$mail->FromName = $nome_site;

	$mail->AddAddress($email_site, $nome_site);
	$mail->AddReplyTo($email,$nome);
	$mail->IsHTML(true); 
	$mail->Subject  = $assunto;
	$mail->Body = $msn; 

	$mail->AltBody = $msn;

	$enviado = $mail->Send();
	
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	if ($enviado) {
		$envio = "<div class='alert alert-success alert-dismissible' role='alert'>";
		$envio = $envio . "<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button>";
		$envio = $envio . "Sua mensagem foi enviada com sucesso.<br>Em breve responderemos.";
		$envio = $envio . "</div>";
	} else {
		$envio = "<div class='alert alert-danger alert-dismissible' role='alert'>";
		$envio = $envio . "<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button>";
		$envio = $envio . "N&atilde;o foi poss&iacute;vel enviar sua mensagem.<br>" . $mail->ErrorInfo;
		$envio = $envio . "</div>";
	}
}
?>