<?php
if($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
	die();
}



$acao=$var4;
if($acao==""){$acao="vazio";}
$id=$var5;
	
$link_pg=$host."/adm/banner/".$var3;


$pg="banner";
$top_ref="banner";

if($acao==""){$acao="vazio";}

if($acao<>"vazio" and $acao<>"cadastrar" and $acao<>"salva" and $acao<>"edit" and $acao<>"altera" and $acao<>"del"){
	$acao="vazio";
	$pag = $var3;
	$pag = filter_var($pag, FILTER_VALIDATE_INT);
	$inicio = 0;$limite = 10;
	if ($pag!=''){$inicio = ($pag - 1) * $limite;}else{$pag=1;}
}


$msn=$_SESSION['msn'];

If ($msn=="cad_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Cadastro efetuado com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
	$aviso.="</div>";
} 
		
If ($msn=="alt_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Alteração efetuada com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
	$aviso.="</div>";
}

If ($msn=="alt_erro"){
	$aviso="<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Não foi possível encontrar o registro.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
	$aviso.="</div>";
}

If ($msn=="del_ok"){
	$aviso="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
	$aviso.="<p class='text-center'>Registro apagado com sucesso.</p>";
	$aviso.="<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
	$aviso.="</div>";
} 


$_SESSION['msn']="";

$tipo_banner=$var3;

if($tipo_banner=="horizontal"){$top_pagina="SLIDER INFERIOR";}
if($tipo_banner=="vertical"){$top_pagina="BANNER VERTICAL";}
if($tipo_banner=="principal"){$top_pagina="SLIDER PRINCIPAL";}
if($tipo_banner=="noticias"){
    $top_pagina="BANNER DESTAQUE NOTÍCIA";

    $n_reg="select count(*) as total from banners where tipo = 'noticias'";
    $n_reg = $conn->prepare($n_reg);
	$n_reg->execute();

	$total = $n_reg->fetch(PDO::FETCH_ASSOC);
	$total = $total['total'];

    if($total > 0){$permissao_cad_banner="N";}

}

if($tipo_banner=="vertical"){$top_pagina="BANNER VERTICAL";}
if($tipo_banner=="video"){$top_pagina="BANNER VÍDEO";}


$cadastrar="CADASTRAR NOVO SLIDER";
$editar="ALTERAR SLIDER";
$apagar="APAGAR SLIDER";


echo "<div class='card'>"; 

echo "<div class='card-header text-end topico'>";
echo "	<strong><a href='".$link_pg."' data-toggle='tooltip' data-placement='bottom' title='Início'>$top_pagina</a></strong>&nbsp;&nbsp;";
if ($permissao_cad_banner=="S"){
	echo "<a href='".$link_pg."/cadastrar' data-toggle='tooltip' data-placement='bottom' title='Cadastrar'><i class='fa fa-plus' aria-hidden='true'></i></a>";
}	
echo "  </div>";

echo "	<div class='card-body'>";

//echo "Ação:$acao";

	switch ($acao){

		Case "vazio":
		
	
			if ($permissao_edit_banner<>"S"){
				echo "<p class='bg text-center'>Você não tem permissão para acessar esta área</p>";
			}else{


				If ($aviso<>""){echo $aviso;}

                $sql="select * from banners where tipo='$tipo_banner' order by id desc";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':status', $status, PDO::PARAM_INT);
				$sql->execute();
				
                echo "<table class='table table-hover'><tbody>";
				if($sql->rowCount()==0){

					echo "<tr>";
					echo "<td>";
					echo "<p class='text-center'><br><br><b>Nenhum registro encontrado<br><br>";
					//echo "<a href='javascript:history.back(1)'>Voltar</p>";
					echo "</td>";
					echo "</tr>";

				}else{

					/*
                    echo "<tr>";
					echo "<td colspan='3'><b>Título</b></td>";
					echo "</tr>";
                    */

					while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
						$id=$rs['id'];
                        $titulo=$rs['titulo'];
						
						echo "<tr>";
						echo "<td><a href='".$link_pg."/edit/".$id."'>".$titulo."</a></td>";
						echo "<td width='5%' class='text-center'><a href='".$link_pg."/edit/".$id."' data-toggle='tooltip' data-placement='top' title='Ver/Editar'><i class='fa fa-pencil'></i></a></td>";
						echo "<td width='5%' class='text-center'><a href='".$link_pg."/del/".$id."' data-toggle='tooltip' data-placement='top' title='Apagar'><i class='fa fa-trash-o'></i></a></td>";
						echo "</tr>";
					}
				}
				echo "</tbody></table>";

			}
		break;


		Case "cadastrar":

            $acao_form=$link_pg."/salva";
			echo "<p class='acao'>$cadastrar</p>";
			
			if ($permissao_cad_banner<>"S"){
				echo "<p class='bg text-center txt-18'>Você não tem permissão para cadastrar</p>";
			}else{
				include("form_banners_adm.php");
			}

		break;

		Case "salva":
			
			if ($permissao_cad_banner<>"S"){
				echo "<p class='bg text-center'>Você não tem permissão para cadastrar</p>";
			}else{
				
                $id=$_POST['id'];
                $tipo=$_POST['tipo'];
                $titulo=$_POST['titulo'];
                $imagem=$_POST['imagem'];
                $link=$_POST['link'];
                $target=$_POST['target'];
                $ordem=5;
                $status=$_POST['status'];

                $tipo=str_replace("'","´",$tipo);
                $titulo=str_replace("'","´",$titulo);
                $imagem=str_replace("'","´",$imagem);
                $link=str_replace("'","´",$link);
                $target=str_replace("'","´",$target);
                $ordem=str_replace("'","´",$ordem);
                $status=str_replace("'","´",$status);
				
			
				$chave=Sorteia(10).date('YmdHis').$ip;

				$sql='insert into banners (tipo,titulo,imagem,link,target,ordem,status) values (:tipo,:titulo,:imagem,:link,:target,:ordem,:status)';

                $ins = $conn->prepare($sql);
                $ins -> bindParam(':tipo',$tipo,PDO::PARAM_STR);
                $ins -> bindParam(':titulo',$titulo,PDO::PARAM_STR);
                $ins -> bindParam(':imagem',$chave,PDO::PARAM_STR);
                $ins -> bindParam(':link',$link,PDO::PARAM_STR);
                $ins -> bindParam(':target',$target,PDO::PARAM_STR);
                $ins -> bindParam(':ordem',$ordem,PDO::PARAM_STR);
                $ins -> bindParam(':status',$status,PDO::PARAM_STR);
                $ins -> execute();


				$sql="select * from banners where imagem='$chave'";
				$sql = $conn->prepare($sql);
				$sql->execute();
				if($sql->rowCount()==0){
					echo "Erro. Não foi possível recuperar o registro";
				}else{
							
					$rs = $sql->fetch(PDO::FETCH_ASSOC);
					$id=$rs['id'];

                    
                    $acao="altera_img";
                    $tabela="banners";$outra_tabela="S";$campos_tabela="so_imagem";
                    include("salva_up.php");

                    if ($erro != ""){
                        echo "<p class='bg-danger text-center'><b>Houve erro(s) ao carregar o(s) arquivo(s).<br><a href=javascript:history.back(-1)>Voltar</a></b></p>";
                    }else{	
                        $_SESSION['msn']="cad_ok";
                        $url=$link_pg."/edit/".$id;
                        ?><script>window.location.href = "<?php echo $url;?>"</script><?php
                    }
							
				}
			
			}
	
		break;

		Case "edit":

			if ($permissao_edit_banner<>"S"){
				echo "<p class='bg text-center'>Você não tem permissão para editar</p>";
			}else{

				$acao_form=$link_pg."/altera";

				if($id==""){
					$id=$_POST['id'];
					$id=$id;
				}

			
				$sql = "select * from banners where id=:id";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_STR);
				$sql->execute();

				if($sql->rowCount()>0){
					
					$rs = $sql->fetch(PDO::FETCH_ASSOC);
					$id=$rs['id'];
                    $tipo_banner=$rs['tipo'];
                    $titulo=$rs['titulo'];
                    $imagem=$rs['imagem'];
                    $link=$rs['link'];
                    $target=$rs['target'];
                    $ordem=$rs['ordem'];
                    $status=$rs['status'];
                    $id_ref=$id;

                    $tipo_banner=str_replace("´","'",$tipo_banner);
                    $titulo=str_replace("´","'",$titulo);
                    $imagem=str_replace("´","'",$imagem);
                    $link=str_replace("´","'",$link);
                    $target=str_replace("´","'",$target);
					
					include("form_banners_adm.php");
	
				}else{
					echo "<p class='text-center'>Não foi possível encontrar o cliente.</p>";
				}
			
			}
			
		break;


		

		Case "altera":

			if ($permissao_alt_links_uteis<>"S"){
				echo "<p class='bg text-center'>Você não tem permissão para alterar</p>";
			}else{

                $id=strip_tags($_POST['id']);
                $tipo=$_POST['tipo'];
                $titulo=$_POST['titulo'];
                $imagem=$_POST['imagem'];
                $link=$_POST['link'];
                $target=$_POST['target'];
                $ordem=$_POST['ordem'];
                $status=$_POST['status'];

 
                $tipo=str_replace("'","´",$tipo);
                $titulo=str_replace("'","´",$titulo);
                $imagem=str_replace("'","´",$imagem);
                $link=str_replace("'","´",$link);
                $target=str_replace("'","´",$target);
                $ordem=str_replace("'","´",$ordem);
                $status=str_replace("'","´",$status);
				
			
				$sql = "select * from banners where id = :id";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->execute();

				if($sql->rowCount()==0){
					echo "<p class='text-center'>Não foi possível encontrar o registro.</p>";
					echo "<p class='text-right'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
				}else{

                    $rs = $sql->fetch(PDO::FETCH_ASSOC);
					$img_ant=$rs['imagem'];
					
                    $sql='update banners set titulo=:titulo,link=:link,target=:target where id=:id';
                    $up = $conn->prepare($sql);
                    $up -> bindParam(':id',$id,PDO::PARAM_STR);
                    $up -> bindParam(':titulo',$titulo,PDO::PARAM_STR);
                    $up -> bindParam(':link',$link,PDO::PARAM_STR);
                    $up -> bindParam(':target',$target,PDO::PARAM_STR);
                    $up -> execute();


                    $acao="altera_img";
					$tabela="banners";$outra_tabela="S";$campos_tabela="so_imagem";
					include("salva_up.php");

					if ($img_ant != "" && $arquivo != ""){
						$apaga=$diretorio."/".$img_ant;
						if( file_exists( $apaga ) ){unlink( $apaga );}
					}
					
					$_SESSION['msn']="alt_ok";
					$url=$link_pg."/edit/".$id;
					?><script>window.location.href = "<?php echo $url;?>"</script><?php 
					
					
				}
			} 

		break;

		case "del":

		
			$confirma=$_REQUEST['confirma'];
			
			if ($confirma != "sim") {
	
				$sql = "select * from banners where id = :id";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->execute();
	
				if($sql->rowCount()==0){
					echo "<div class='card-header text-end topico'>";
					echo "	<a href='$link_pg'><strong>ERRO</strong></a>&nbsp;";
					echo "</div>";
					
					echo "<div class='card-body'>";
					echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
					echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
					echo "</div>";
				}else{
	
					$rs = $sql->fetch(PDO::FETCH_ASSOC);
	
					$titulo=$rs['titulo'];
					$titulo=str_replace("´", "'",$titulo);
	
					echo "	<div class='card-body'>";
					echo "<p class='acao'>$apagar</p>";
					?>
	
					<form action="<?php echo $link_pg;?>/del" method="post">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<input type="hidden" name="idioma" value="<?php echo $idioma;?>">
					<input type="hidden" name="confirma" value="sim">
					<?php 
					$mensagem="<br><br>";
	
					echo "	<div class='row'>";
					echo "	<div class='col-sm-12 bg-danger bco'><p class='text-center'><br><br>Favor confirmar a exclusão de<br><b>".$titulo."</b><br><br></p></div>";
					echo "  </div>";
	
					echo "	<div class='row mt-2'>";
					echo "	<div class='col-sm-12'><p class='text-end'><a href='javascript:history.back(-1)'><button type='button' class='btn btn-default btn-outline-secondary'>Voltar</button></a>&nbsp;&nbsp;&nbsp;<button type='submit' name='submit' id='submit' class='btn btn-vermelho'><b>Confirmar Exclusão</b></button></p></div>";
					echo "	</div>";
	
					echo "</div>";//<!-- card-body -->"
				}
	
			}else{
	
				$id=$_POST['id'];
	
				$sql = "select * from banners where id = :id";
				$sql = $conn->prepare($sql);
				$sql->bindParam(':id', $id, PDO::PARAM_INT);
				$sql->execute();
	
				if($sql->rowCount()==0){
					echo "<div class='card-header text-end text-uppercase topico'>";
					echo "	<a href='$link_pg'><strong>ERRO</strong></a>&nbsp;";
					echo "</div>";
					echo "	<div class='card-body'>";
					echo "<p class='text-center'>REGISTRO NÃO ENCONTRADO</p>";
					echo "<p class='text-end'><a href='javascript:history.back(1)' class='texto'><button type='button' class='btn btn-default'>Voltar</button></a></p>";
					echo "</div>";//<!-- card-body -->"
				}else{
					
					$rs = $sql->fetch(PDO::FETCH_ASSOC);
					
					$img_db=$rs['imagem'];
					if ($img_db<>""){
						$arquivo=$diretorio."/".$img_db;		
						if( file_exists( $arquivo ) ){unlink( $arquivo );}
					}
					
					$sql = "delete from banners where id=:id";
					$del = $conn->prepare($sql);
					$del -> bindParam(':id',$id,PDO::PARAM_INT);
					$del -> execute();
					
				}
                $_SESSION['msn']="del_ok";
				$url=$link_pg;
				?><script>window.location.href = "<?php echo $url;?>"</script><?php 
			}
	
		break;

	}

echo "</div>";//<!-- card-body -->"

echo "<div class='card-footer'>";
echo "";
echo "</div>";//<!-- card-footer -->"
    
echo "</div>";//<!-- card -->
?>