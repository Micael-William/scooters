<?php 
if($_SESSION['admin']==""){
	unset ($_SESSION['sess']);
	unset ($_SESSION['id_adm']);
	unset ($_SESSION['admin']);
	unset ($_SESSION['nivel']);
	unset ($_SESSION['loja']);
    header('location:'.$host.'/autentica.php');
	die();
}else{
	$session_sess=$_SESSION['sess'];
	$session_id_adm=$_SESSION['id_adm'];
	$session_admin=$_SESSION['admin'];
	$session_nivel=$_SESSION['nivel'];

	if ($pg_int <> "S"){
		$redir="Location:index.php";
		header($redir); 
		die();
	}

	if(isset($_POST['submit'])){  
		foreach($_FILES["img"]["error"] as $key => $error){
			if($error == UPLOAD_ERR_OK){
				$tmp_name = $_FILES["img"]["tmp_name"][$key];
				$up_nome = $_FILES["img"]["name"][$key];
				
				$tit_arq=$_POST['img_tit'][$key];
				$desc_arq=$_POST['img_desc'][$key];
				$cred_arq=$_POST['img_cred'][$key];

				$tp_img=$_POST['tp_img'][$key];
				//$ord_img=$_POST['ord_img'][$key-1];
				$ord_img=999;
				$array  = explode('.', $up_nome);
				$ubound=count($array);

				if ($ubound>1){
					$extensao=$array[$ubound-1];
					$nome="";
					
					for($x=0;$x<$ubound-1;$x++){
						$nome=$nome.$array[$x];
					}			

					$nome= strtolower(RemoveAcentos($nome));
					$extensao = strtolower(RemoveAcentos($extensao));
		
					if ($extensao=="exe" || $extensao=="php" || $extensao=="asp" ) {
						//unlink($tmp_name);
					}else{

						$arquivo=$nome.".".$extensao;
						$c=0;
						while (file_exists($diretorio.$arquivo)){
							if (file_exists($diretorio.$arquivo)){ 
								$c++; 
							}
							$t_nome=$nome."_".$c;
							$arquivo=$t_nome.".".$extensao;

						}

						move_uploaded_file($tmp_name, $diretorio.$arquivo);
						
						if ($extensao=="gif" || $extensao=="jpeg" || $extensao=="jpg" || $extensao=="png") {
							if (file_exists($diretorio.$arquivo)) {
								list($largura, $altura) = getimagesize($diretorio.$arquivo);
							}
						}

						

		
						if ($outra_tabela==""){

							if ($acao=="altera_img"){
								try {
									$log="update imagens set id_ref='$id_ref',top_ref='$top_ref',img='$arquivo',extensao='$extensao',tp_img='$tp_img',larg='$largura',alt='$altura',img_tit='$tit_arq',img_desc='$desc_arq',img_cred='$cred_arq' where id='$id'";

									$sql = "update imagens set id_ref=:id_ref,top_ref=:top_ref,img=:arquivo,extensao=:extensao,tp_img=:tp_img,larg=:largura,alt=:altura,img_tit=:tit_arq,img_desc=:desc_arq,img_cred=:cred_arq where id=:id";
									$up = $conn->prepare($sql);
									$up -> bindParam(':id_ref',$id_ref,PDO::PARAM_INT);
									$up -> bindParam(':top_ref',$top_ref,PDO::PARAM_STR);
									$up -> bindParam(':arquivo',$arquivo,PDO::PARAM_STR);
									$up -> bindParam(':extensao',$extensao,PDO::PARAM_STR);
									$up -> bindParam(':tp_img',$tp_img,PDO::PARAM_STR);
									//$up -> bindParam(':ordem_img',$ordem_img,PDO::PARAM_STR);
									$up -> bindParam(':largura',$largura,PDO::PARAM_STR);
									$up -> bindParam(':altura',$altura,PDO::PARAM_STR);
									$up -> bindParam(':tit_arq',$tit_arq,PDO::PARAM_STR);
									$up -> bindParam(':desc_arq',$desc_arq,PDO::PARAM_STR);
									$up -> bindParam(':cred_arq',$cred_arq,PDO::PARAM_STR);
									$up -> bindParam(':id',$id,PDO::PARAM_INT);
									$up -> execute();

								}catch(PDOException $e) {
								  echo 'Erro: Deu ruim '.$e->getMessage();
								}
								$tp_sql="update";

							}else{

								try {
									$log="insert into imagens (id_ref,top_ref,img,extensao,tp_img,larg,alt,img_tit,img_desc,img_cred) values('$id','$top_ref','$arquivo','$extensao','$tp_img','$largura','$altura','$tit_arq','$desc_arq','$cred_arq')";
									
									$sql="insert into imagens (id_ref,top_ref,img,extensao,tp_img,larg,alt,img_tit,img_desc,img_cred) values(:id,:top_ref,:arquivo,:extensao,:tp_img,:largura,:altura,:tit_arq,:desc_arq,:cred_arq)";
									$ins = $conn->prepare($sql);
									$ins -> bindParam(':id',$id,PDO::PARAM_INT);
									$ins -> bindParam(':top_ref',$top_ref,PDO::PARAM_STR);
									$ins -> bindParam(':arquivo',$arquivo,PDO::PARAM_STR);
									$ins -> bindParam(':extensao',$extensao,PDO::PARAM_STR);
									$ins -> bindParam(':tp_img',$tp_img,PDO::PARAM_STR);
									$ins -> bindParam(':largura',$largura,PDO::PARAM_STR);
									$ins -> bindParam(':altura',$altura,PDO::PARAM_STR);
									$ins -> bindParam(':tit_arq',$tit_arq,PDO::PARAM_STR);
									$ins -> bindParam(':desc_arq',$desc_arq,PDO::PARAM_STR);
									$ins -> bindParam(':cred_arq',$cred_arq,PDO::PARAM_STR);
									$ins -> execute();

								}catch(PDOException $e) {
								  echo 'Erro: '.$e->getMessage();
								}	
								
								$tp_sql="insert";

							}
							//$log=$sql;
							grava_log($tp_sql,$id,'imagens',$log);

							
						}else{//outra tabela
							
							//$tabela="banners";$outra_tabela="S";$campos_tabela="so_imagem";
							
							if ($campos_tabela=="so_imagem"){
								if ($acao=="altera_img"){
									try {
										$log = "update ".$tabela." set imagem='$arquivo' where id='$id'";

										$sql = "update ".$tabela." set imagem=:arquivo where id=:id";
										$up = $conn->prepare($sql);
										$up -> bindParam(':arquivo',$arquivo,PDO::PARAM_STR);
										$up -> bindParam(':id',$id,PDO::PARAM_INT);
										$up -> execute();

									}catch(PDOException $e) {
									  echo 'Erro: '.$e->getMessage();
									}
									$tp_sql="update";
								}else{
									try {
										$log="insert into ".$tabela." (imagem) values('$arquivo')";
										
										$sql="insert into ".$tabela." (imagem) values(:arquivo)";
										$ins = $conn->prepare($sql);
										$ins -> bindParam(':arquivo',$arquivo,PDO::PARAM_STR);
										$ins -> execute();

									}catch(PDOException $e) {
									  echo 'Erro: '.$e->getMessage();
									}
									$tp_sql="insert";
								}
							}

							if ($campos_tabela=="campos_iguais_tabela_imagens"){
								if ($acao=="altera_img"){
									try {
										
										$log="update ".$tabela." set id_ref='$id_ref',top_ref='$top_ref',img='$arquivo',extensao='$extensao',tp_img='$tp_img',larg='$largura',alt='$altura',img_tit='$tit_arq',img_desc='$desc_arq',img_cred='$cred_arq' where id='$id'";

										$sql = "update ".$tabela." set id_ref=:id_ref,top_ref=:top_ref,img=:arquivo,extensao=:extensao,tp_img=:tp_img,larg=:largura,alt=:altura,img_tit=:tit_arq,img_desc=:desc_arq,img_cred=:cred_arq where id=:id";
										$up = $conn->prepare($sql);
										$up -> bindParam(':id_ref',$id_ref,PDO::PARAM_INT);
										$up -> bindParam(':top_ref',$top_ref,PDO::PARAM_STR);
										$up -> bindParam(':arquivo',$arquivo,PDO::PARAM_STR);
										$up -> bindParam(':extensao',$extensao,PDO::PARAM_STR);
										$up -> bindParam(':tp_img',$tp_img,PDO::PARAM_STR);
										$up -> bindParam(':largura',$largura,PDO::PARAM_STR);
										$up -> bindParam(':altura',$altura,PDO::PARAM_STR);
										$up -> bindParam(':tit_arq',$tit_arq,PDO::PARAM_STR);
										$up -> bindParam(':desc_arq',$desc_arq,PDO::PARAM_STR);
										$up -> bindParam(':cred_arq',$cred_arq,PDO::PARAM_STR);
										$up -> bindParam(':id',$id,PDO::PARAM_INT);
										$up -> execute();

									}catch(PDOException $e) {
									  echo 'Erro: '.$e->getMessage();
									}
									$tp_sql="update";
								}else{

									try {
										
										$log="insert into ".$tabela." (id_ref,top_ref,img,extensao,tp_img,ordem_img,larg,alt,img_tit,img_desc,img_cred) values('$id','$top_ref','$arquivo','$extensao','$tp_img','$ordem_img','$largura','$altura','$tit_arq','$desc_arq','$cred_arq)";

										$sql="insert into ".$tabela." (id_ref,top_ref,img,extensao,tp_img,larg,alt,img_tit,img_desc,img_cred) values(:id,:top_ref,:arquivo,:extensao,:tp_img,:largura,:altura,:tit_arq,:desc_arq,:cred_arq)";
										$ins = $conn->prepare($sql);
										$ins -> bindParam(':id',$id,PDO::PARAM_INT);
										$ins -> bindParam(':top_ref',$top_ref,PDO::PARAM_STR);
										$ins -> bindParam(':arquivo',$arquivo,PDO::PARAM_STR);
										$ins -> bindParam(':extensao',$extensao,PDO::PARAM_STR);
										$ins -> bindParam(':tp_img',$tp_img,PDO::PARAM_STR);
										$ins -> bindParam(':largura',$largura,PDO::PARAM_STR);
										$ins -> bindParam(':altura',$altura,PDO::PARAM_STR);
										$ins -> bindParam(':tit_arq',$tit_arq,PDO::PARAM_STR);
										$ins -> bindParam(':desc_arq',$desc_arq,PDO::PARAM_STR);
										$ins -> bindParam(':cred_arq',$cred_arq,PDO::PARAM_STR);
										$ins -> execute();

									}catch(PDOException $e) {
									  echo 'Erro: '.$e->getMessage();
									}	
									$tp_sql="insert";	
								}
							}

							//$log=$sql;
							grava_log($tp_sql,$id,$tabela,$log);
						}

						//echo "<br><b>Arquivo salvo em:</b>".$diretorio.$arquivo." <b>Título:</b>".$tit_arq." <b>Descrição:</b>".$desc_arq." <b>Crédito:</b>".$cred_arq."<br>";	
					
					}//extensões
				}	
			} 
		}  
	} 

}
?>

