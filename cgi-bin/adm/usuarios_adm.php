<?php
if ($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
}

$link_pg=$host."/adm/".$var2;

$top_ref="usuarios";

$acao=$var3;
$id=$var4;

if($acao=="" or $acao=="msg"){$acao="vazio";}

$msn=$var4;

If ($msn=="cad_ok"){
	$aviso="<div class='alert alert-success alert-dismissible' role='alert'>";
	$aviso.="<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button>";
	$aviso.="<p class='text-center'>Cadastro efetuado com sucesso.</p>";
	$aviso.="</div>";
} 
		
If ($msn=="alt_ok"){
	$aviso="<div class='alert alert-success alert-dismissible text-center' role='alert'>";
	$aviso.="<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button>";
	$aviso.="<p class='text-center'>Alteração efetuada com sucesso.</p>";
	$aviso.="</div>";
}

If ($msn=="alt_erro"){
	$aviso="<div class='alert alert-danger alert-dismissible text-center' role='alert'>";
	$aviso.="<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button>";
	$aviso.="<p class='text-center'>Não foi possível encontrar o registro.</p>";
	$aviso.="</div>";
}

If ($msn=="del_ok"){
	$aviso="<div class='alert alert-success alert-dismissible' role='alert'>";
	$aviso.="<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Fechar</span></button>";
	$aviso.="<p class='text-center'>Registro apagado com sucesso.</p>";
	$aviso.="</div>";
} 


$top_pagina="USUÁRIOS";
$cadastrar="CADASTRO DE USUÁRIO";
$editar="ALTERAR USUÁRIO";
$apagar="APAGAR USUÁRIO";


echo "<div class='card'>";

echo "	<div class='card-header text-end topico'>";
echo "		<strong><a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'>$top_pagina</a></strong>&nbsp;&nbsp;";
echo "		<a href='".$link_pg."/cadastrar/".$id_rec."' data-toggle='tooltip' data-placement='bottom' title='Cadastrar novo usuário'><i class='fa fa-plus' aria-hidden='true'></i></a>";
echo "	</div>";


echo "	<div class='card-body'>";
//echo "Acao=".$acao." ID:".$id;
switch ($acao){
	
	Case "vazio":
		If ($aviso<>""){echo $aviso;}
		
		echo "<table class='table table-hover'><tbody>";
		

		$sql="select * from admin where (nivel > '$session_nivel' or id = '$session_id_adm') and status <> 'D' order by nome";
		//echo $sql;
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "<tr>";
			echo "<td>";
			echo "<p class='text-center'><br><br><b>Nenhum registro não encontrado<br><br><a href='javascript:history.back(1)'>Voltar</p>";
			echo "</td>";
			echo "</tr>";
		}else{

			echo "<tr>";
			echo "<td><b>Nome</b></td>";
			//echo "<td><b>Grupo</b></td>";
			//echo "<td><b>Região</b></td>";
			echo "<td><b>Email</b></td>";
			echo "<td><b>Telefones</b></td>";
			echo "<td><b>Último acesso</b></td>";
			echo "<td width='10%' colspan=2'><b>Funções</b></td>";
			echo "</tr>";

			while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

				$id=$rs['id'];
				$login=$rs['login'];
				$login=str_replace("´","'",$login);
				/*
				$senha=$rs['senha'];
				$senha=str_replace("´","'",$senha);
				*/
				$nome=$rs['nome'];
				$nome=str_replace("´","'",$nome);
				$usual=$rs['usual'];
				$usual=str_replace("´","'",$usual);
				$email=$rs['email'];
				$tel=$rs['tel'];
				$tel=str_replace("´","'",$tel);
				$cel=$rs['cel'];
				$cel=str_replace("´","'",$cel);
				$nivel=$rs['nivel'];
				$permissoes=$rs['permissoes'];
				$regiao=$rs['regiao'];
				$site=$rs['site'];
				$site=str_replace("´","'",$site);
				$ult_acesso=$rs['ult_acesso'];

				$status=$rs['status'];
				
				if ($tel==""){
					$telefones=$cel;
				}else{
					if ($cel<>""){ 
						$telefones=$tel. " / " .$cel;
					}else{
						$telefones=$tel;
					}
				}

				if ($ult_acesso<>"0000-00-00 00:00:00"){
					$ult_acesso=date('d/m/Y H:i:s',strtotime($ult_acesso));
				}
				 
				
				If ($nivel=="1"){$n_nivel="Administrador";}
				If ($nivel=="2"){$n_nivel="Vendas";}

				$status=$rs['status'];

				$grupo=$n_nivel;

				echo "<tr>";
				echo "<td align=left>".$nome."</td>";
				//echo "<td>".$grupo."</td>";
				//echo "<td>".$regiao."</td>";
				echo "<td>".$email."</td>";
				echo "<td>".$telefones."</td>";
				echo "<td>".$ult_acesso."</td>";
				echo "<td width='3%' align=center><a href='".$link_pg."/edit/".$id,"' title='Alterar'><i class='fa fa-pencil'></i></a></td>";
				echo "<td width='3%' align=center><a href='".$link_pg."/del/".$id."' title='Apagar'><i class='fa fa-trash-o'></i></a></td>";
				echo "</tr>";

			}
			echo "<tr><td colspan=9></td></tr></tbody></table>";
		}
			
	break;

	Case "cadastrar":
		
		$nome="";
		$action=$link_pg."/salva";
		$nome_form="cad_usuario";
		$bot="salva";
		$escreve="Novo Usuário";
		$volta=$link_pg;
		$status="A";


		echo "<p class='acao'>$cadastrar</p>";
		include("form_usuarios_adm.php");

	
	break;


	Case "salva":
//echo "aqui.;...";
		$login=$_POST['login'];
		$senha=$_POST['senha'];
		if ($senha<>""){$senha=sha1($senha);}
		$nome=$_POST['nome'];
		$usual=$_POST['usual'];
		$email=$_POST['email'];
		$tel=$_POST['tel'];
		$cel=$_POST['cel'];
		$nivel=$_POST['nivel'];
		$permissoes=$_POST['permissoes'];
		$sexo=$_POST['sexo'];
		$cargo_pt=$_POST['cargo_pt'];
		$cargo_ing=$_POST['cargo_ing'];
		$site=$_POST['site'];
		$ult_acesso=$_POST['ult_acesso'];
		$logado=$_POST['logado'];
		$imagem=$_POST['imagem'];
		$status=$_POST['status'];

		$login=str_replace("'","´",$login);
		$senha=str_replace("'","´",$senha);
		$nome=str_replace("'","´",$nome);
		$usual=str_replace("'","´",$usual);
		$email=str_replace("'","´",$email);
		$tel=str_replace("'","´",$tel);
		$cel=str_replace("'","´",$cel);
		$nivel=str_replace("'","´",$nivel);
		$permissoes=str_replace("'","´",$permissoes);
		$sexo=str_replace("'","´",$sexo);
		$cargo_pt=str_replace("'","´",$cargo_pt);
		$cargo_ing=str_replace("'","´",$cargo_ing);
		$site=str_replace("'","´",$site);
		$ult_acesso=str_replace("'","´",$ult_acesso);
		$logado=str_replace("'","´",$logado);
		$imagem=str_replace("'","´",$imagem);
		$status=str_replace("'","´",$status);

		$ult_acesso="0000-00-00";
		$logado='N';
		if($status==""){$status="I";}else{$status="A";}
		
		$sql = "select * from admin where login = :login";
		$sql = $conn->prepare($sql);
		$sql->bindParam(':login', $login, PDO::PARAM_STR);
		$sql->execute();

		if($sql->rowCount()==0){
			
			$sql='insert into admin (id,login,senha,nome,usual,email,tel,cel,nivel,permissoes,regiao,site,ult_acesso,se,logado,status) values (:id,:login,:senha,:nome,:usual,:email,:tel,:cel,:nivel,:permissoes,:regiao,:site,:ult_acesso,:se,:logado,:status)';

			$ins = $conn->prepare($sql);
			$ins -> bindParam(':id',$id,PDO::PARAM_STR);
			$ins -> bindParam(':login',$login,PDO::PARAM_STR);
			$ins -> bindParam(':senha',$senha,PDO::PARAM_STR);
			$ins -> bindParam(':nome',$nome,PDO::PARAM_STR);
			$ins -> bindParam(':usual',$usual,PDO::PARAM_STR);
			$ins -> bindParam(':email',$email,PDO::PARAM_STR);
			$ins -> bindParam(':tel',$tel,PDO::PARAM_STR);
			$ins -> bindParam(':cel',$cel,PDO::PARAM_STR);
			$ins -> bindParam(':nivel',$nivel,PDO::PARAM_STR);
			$ins -> bindParam(':permissoes',$permissoes,PDO::PARAM_STR);
			$ins -> bindParam(':regiao',$regiao,PDO::PARAM_STR);
			$ins -> bindParam(':site',$site,PDO::PARAM_STR);
			$ins -> bindParam(':ult_acesso',$ult_acesso,PDO::PARAM_STR);
			$ins -> bindParam(':se',$se,PDO::PARAM_STR);
			$ins -> bindParam(':logado',$logado,PDO::PARAM_STR);
			$ins -> bindParam(':status',$status,PDO::PARAM_STR);
			$ins -> execute();

			$sql = "select * from admin where login = :login";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':login', $login, PDO::PARAM_STR);
			$sql->execute();

			$rs = $sql->fetch(PDO::FETCH_ASSOC);
			$id=$rs['id'];
			$id_ref=$id;

$log="
id:$id,
login:$login,
senha:$senha,
nome:$nome,
usual:$usual,
email:$email,
tel:$tel,
cel:$cel,
nivel:$nivel,
permissoes:$permissoes,
sexo:$sexo,
cargo_pt:$cargo_pt,
cargo_ing:$cargo_ing,
site:$site,
ult_acesso:$ult_acesso,
logado:$logado,
imagem:$imagem,
status:$status
";
		

			
			if ($grava_log=="S"){grava_log('insert',$id,'admin',$log);}
			/*
			$tabela="admin";$outra_tabela="S";$campos_tabela="so_imagem";
			include("salva_up.php");
			*/
			$url=$link_pg."/edit/".$id."/cad_ok";
			?><script>window.location.href = "<?php echo $url;?>"</script><?php 
			
			
		}else{
			echo "<p class='bg-danger text-center'>Já existe um usuário com este nome.<br><a href=javascript:history.back(-1)>Voltar</a></p>";
		}

	break;

	Case "edit":

		If ($aviso<>""){echo $aviso;}

		$sql = "select * from admin where id = '$id'";
		//echo $sql;
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "<br><br>Não foi possível recuperar o registro<br><br>";
		}else{

			$rs = $sql->fetch(PDO::FETCH_ASSOC);

			$id=$rs['id'];
			$login=$rs['login'];
			//$senha=$rs['senha'];
			$nome=$rs['nome'];
			$usual=$rs['usual'];
			$email=$rs['email'];
			$tel=$rs['tel'];
			$cel=$rs['cel'];
			$nivel=$rs['nivel'];
			$permissoes=$rs['permissoes'];
			$sexo=$rs['sexo'];
			$cargo_pt=$rs['cargo_pt'];
			$cargo_ing=$rs['cargo_ing'];
			$site=$rs['site'];
			$ult_acesso=$rs['ult_acesso'];
			$logado=$rs['logado'];
			$imagem=$rs['imagem'];
			$status=$rs['status'];
			$id_ref=$id;

			$id=str_replace("´","'",$id);
			$login=str_replace("´","'",$login);
			//$senha=str_replace("´","'",$senha);
			$nome=str_replace("´","'",$nome);
			$usual=str_replace("´","'",$usual);
			$email=str_replace("´","'",$email);
			$tel=str_replace("´","'",$tel);
			$cel=str_replace("´","'",$cel);
			$nivel=str_replace("´","'",$nivel);
			$permissoes=str_replace("´","'",$permissoes);
			$sexo=str_replace("´","'",$sexo);
			$cargo_pt=str_replace("´","'",$cargo_pt);
			$cargo_ing=str_replace("´","'",$cargo_ing);
			$site=str_replace("´","'",$site);
			$ult_acesso=str_replace("´","'",$ult_acesso);
			$logado=str_replace("´","'",$logado);
			$imagem=str_replace("´","'",$imagem);
			$status=str_replace("´","'",$status);

			$log="";
			if ($grava_log=="S"){grava_log('editou',$id,'admin',$log);}

			$escreve="Alterar";
			$action=$link_pg."/altera";
			$nome_form="edit_usuario";
			
/*
			$sql =" select * from imagens where id_ref=:id and (extensao='gif' or extensao='jpeg' or extensao='jpg' or extensao='png') and top_ref=:top_ref";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->bindParam(':top_ref', $top_ref, PDO::PARAM_INT);
			$sql->execute();
								
			if($sql->rowCount()==0){
				$rs = $sql->fetch(PDO::FETCH_ASSOC);
				$img_id=$rs['id'];
				$img_usuario=$rs['img'];
				$imagem="S";
			}
*/
			$volta=$link_pg;//link do botão volta do form


			echo "<p class='acao'>$editar</p>";
			include("form_usuarios_adm.php");


		}
	
	break;

	Case "altera":


		$id=$_POST['id'];
		$login=$_POST['login'];
		$senha=$_POST['senha'];
		$nome=$_POST['nome'];
		$usual=$_POST['usual'];
		$email=$_POST['email'];
		$tel=$_POST['tel'];
		$cel=$_POST['cel'];
		$nivel=$_POST['nivel'];
		$permissoes=$_POST['permissoes'];
		$sexo=$_POST['sexo'];
		$cargo_pt=$_POST['cargo_pt'];
		$cargo_ing=$_POST['cargo_ing'];
		$site=$_POST['site'];
		$ult_acesso=$_POST['ult_acesso'];
		$logado=$_POST['logado'];
		//$imagem=$_POST['imagem'];
		$status=$_POST['status'];

		$id=str_replace("'","´",$id);
		$login=str_replace("'","´",$login);
		$senha=str_replace("'","´",$senha);
		$nome=str_replace("'","´",$nome);
		$usual=str_replace("'","´",$usual);
		$email=str_replace("'","´",$email);
		$tel=str_replace("'","´",$tel);
		$cel=str_replace("'","´",$cel);
		$nivel=str_replace("'","´",$nivel);
		$permissoes=str_replace("'","´",$permissoes);
		$sexo=str_replace("'","´",$sexo);
		$cargo_pt=str_replace("'","´",$cargo_pt);
		$cargo_ing=str_replace("'","´",$cargo_ing);
		$site=str_replace("'","´",$site);
		$ult_acesso=str_replace("'","´",$ult_acesso);
		$logado=str_replace("'","´",$logado);
		//$imagem=str_replace("'","´",$imagem);
		$status=str_replace("'","´",$status);

		
		$id_ref=$id;
		$img_id=$_POST['img_id'];
		
		if (trim($senha)<>""){
			$senha=sha1($senha);
			//$senha=str_replace("'","´",$senha);
			$alt_senha="senha=:senha,";
		}else{
			$alt_senha="";
		}
		

		If ($permissao_alt=="S"){$up_adm=",permissoes=:permissoes,nivel=:nivel";}else{$up_adm="";}


$log="
id:$id,
login:$login,
senha:$senha,
nome:$nome,
usual:$usual,
email:$email,
tel:$tel,
cel:$cel,
nivel:$nivel,
permissoes:$permissoes,
sexo:$sexo,
cargo_pt:$cargo_pt,
cargo_ing:$cargo_ing,
site:$site,
ult_acesso:$ult_acesso,
logado:$logado,
imagem:$imagem,
status:$status
";

		$sql="update admin set ".$alt_senha."nome=:nome,usual=:usual,email=:email,tel=:tel,cel=:cel,status=:status".$up_adm." where id=:id";

		$up = $conn->prepare($sql);
		if (trim($senha)<>""){
			$up -> bindParam(':senha',$senha,PDO::PARAM_STR);
		}
		$up -> bindParam(':nome',$nome,PDO::PARAM_STR);
		$up -> bindParam(':usual',$usual,PDO::PARAM_STR);
		$up -> bindParam(':email',$email,PDO::PARAM_STR);
		$up -> bindParam(':tel',$tel,PDO::PARAM_STR);
		$up -> bindParam(':cel',$cel,PDO::PARAM_STR);
		If ($permissao_alt=="S"){
			$up -> bindParam(':nivel',$nivel,PDO::PARAM_STR);
			$up -> bindParam(':permissoes',$permissoes,PDO::PARAM_STR);
		}
		$up -> bindParam(':status',$status,PDO::PARAM_STR);
		$up -> bindParam(':id',$id,PDO::PARAM_INT);
		$up -> execute();
				
		if ($grava_log=="S"){grava_log('update',$id,'admin',$log);}
/*
		$acao="altera_img";
		$tabela="admin";$outra_tabela="S";$campos_tabela="so_imagem";
		include("salva_up.php");

		
		$img_ant=$_POST['img_ant'];
		//echo "Img_ant=".$img_ant." Arquivo=".$arquivo;

		if ($img_ant != "" && $arquivo != ""){
			$apaga=$diretorio."/".$img_ant;
			if( file_exists( $apaga ) ){
				unlink( $apaga );
			}
		}
*/
		$url=$link_pg."/edit/".$id."/alt_ok";
		
		?><script>window.location.href = "<?php echo $url;?>"</script><?php 
	
	break;

	case "del":

		//$id=$_REQUEST['id'];
		$confirma=$_REQUEST['confirma'];
		
		if ($confirma != "sim") {

			$sql = "select * from admin where id = :id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){
				echo "<div class='card-header bg text-end topico'>";
				echo "	<a href='$link_pg'><strong>ERRO</strong></a>&nbsp;";
				echo "</div>";
				echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
				echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
			}else{

				$rs = $sql->fetch(PDO::FETCH_ASSOC);

				$nome=$rs['nome'];
				$nome=str_replace("¬", "'",$nome);
	
				echo "<p class='acao'>$apagar</p>";

				?>

				<form action="<?php echo $link_pg;?>/del" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>">
				<input type="hidden" name="idioma" value="<?php echo $idioma;?>">
				<input type="hidden" name="confirma" value="sim">
				<?php 
				$mensagem="<br><br>";
				
				echo "	<div class='row'>";
				echo "	<div class='col-sm-12 bg-danger bco'><p class='text-center'><br><br>Favor confirmar a exclusão de<br><b>".$nome."</b><br><br></p></div>";
				echo "  </div>";

				echo "	<div class='row mt-2'>";
				echo "	<div class='col-sm-12'><p class='text-end'><a href='javascript:history.back(-1)'><button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;<button type='submit' name='submit' id='submit' class='btn btn-vermelho'><b>Confirmar Exclusão</b></button></p></div>";
				echo "	</div>";
			}

		}else{

			$id=$_POST['id'];

			$sql = "select * from admin where id = :id";
			$sql = $conn->prepare($sql);
			$sql->bindParam(':id', $id, PDO::PARAM_INT);
			$sql->execute();

			if($sql->rowCount()==0){
				echo "<div class='panel panel-default'>";
				echo "<div class='card-header bg text-end topico'>";
				echo "	<a href='$link_pg'><strong>ERRO</strong></a>&nbsp;";
				echo "</div>";
				echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
				echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
			}else{
				
				$rs = $sql->fetch(PDO::FETCH_ASSOC);
				
				$id=$rs['id'];

				$senha="@#@#@#@#@#@#@#@#@";
				$status="D";
				$sql='update admin set senha=:senha,status=:status where id=:id';
				$up = $conn->prepare($sql);
				$up -> bindParam(':senha',$senha,PDO::PARAM_STR);
				$up -> bindParam(':status',$status,PDO::PARAM_STR);
				$up -> bindParam(':id',$id,PDO::PARAM_INT);
				$up -> execute();


/*
				$sql = "delete from admin where id=:id";
				$del = $conn->prepare($sql);
				$del -> bindParam(':id',$id,PDO::PARAM_INT);
				$del -> execute();

				$sql = "select * from imagens where id_ref=:id and top_ref=:top_ref";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->bindParam(':top_ref', $top_ref, PDO::PARAM_STR);
				$sql->execute();

				while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
					
					$img_db=$rs['img'];
					
					if ($img_db<>""){
						$arquivo=$diretorio."/".$img_db;		
						if( file_exists( $arquivo ) ){unlink( $arquivo );}
					}
				}

				$sql = "delete from imagens where id_ref=:id and top_ref=:top_ref";
				$del = $conn->prepare($sql);
				$del->bindParam(':id', $id, PDO::PARAM_INT);
				$del->bindParam(':top_ref', $top_ref, PDO::PARAM_STR);
				$del -> execute();
*/
				
			}

			$url=$link_pg."/msg/".$id."/del_ok";
			?><script>window.location.href = "<?php echo $url;?>"</script><?php 
		}

	break;

}
echo "</div>";//<!-- card-body -->"

echo "<div class='card-footer'>";
echo "";
echo "</div>";//<!-- card-footer -->"
    
echo "</div>";//<!-- card -->