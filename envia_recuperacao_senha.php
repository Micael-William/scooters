<?php
include("head.php");

$email=$_POST['email'];
?>
<div class="modal-content" style="width:100%;background-color:#fff;height:400px">
	<div class="modal-header">
		<h4 class="modal-title login" id="exampleModalLabel"><b>Lembrar senha</b></h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="history.go(0)">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body txt-14">
<?php
if($email==""){
	echo "É necessário informar seu e-mail!";
}else{

	$data = date('Y-m-d H:i:s');

	$sql="select * from usuarios where email=:email";
	$sql = $conn->prepare($sql);
	$sql -> bindParam(':email',$email,PDO::PARAM_STR);
	$sql->execute();
	
	if($sql->rowCount()==0){
		echo "E-mail não encontrado";
	}else{
		
		$rs = $sql->fetch(PDO::FETCH_ASSOC);
		
		$id_cli=$rs['id'];
		$usual = $rs['contato'];

		$chave = Sorteia(65, false, true);

		$sql = 'insert into link_recupera_senha (data,cli,chave) values(:data,:cli,:chave)';
		$ins = $conn->prepare($sql);
		$ins -> bindParam(':data',$data,PDO::PARAM_STR);
		$ins -> bindParam(':cli',$id_cli,PDO::PARAM_STR);
		$ins -> bindParam(':chave',$chave,PDO::PARAM_STR);
		$ins -> execute();

		$link_recuperacao = $host."/alterar-senha/".$chave;

		$tipo_email="recupera_senha";
		include("adm/envia_email.php");

		if($_SESSION['envio_email']=="enviado"){
			echo "<b>E-mail enviado.</b><br><br>";
			echo "Enviamos um e-mail com as instruções e o link para você trocar a sua senha. Caso você não receba o e-mail em alguns minutos, verifique a sua caixa de spam ou repita o processo.";
		}else{
			echo "Ocorreu falha na operação. Nosso serviço pode estar temporariamente com problemas. Tente novamente mais tarde e se o problema persistir entre em contato conosco pelo e-mail $email_site.".$mailer->ErrorInfo;;
		}

	}
}
?>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-rosa" data-dismiss="modal" onClick="history.go(0)">Fechar</button>
	</div>
</div>
<div class='clear'></div>