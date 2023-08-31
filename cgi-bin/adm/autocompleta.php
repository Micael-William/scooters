<?php
header('Content-type: text/html; charset=UTF-8');
include("../conn.php");
$conn=conecta();

$tp = $_REQUEST["tp"];
$query = $_REQUEST["q"];
$query=str_replace("'","´",$query);

//echo $query."<br>";
switch ($tp){

	Case "cliente":

		$cpf_cnpj=$query;
		$cpf_cnpj=str_replace(".","",$cpf_cnpj);
		$cpf_cnpj=str_replace("-","",$cpf_cnpj);
		$cpf_cnpj=str_replace("/","",$cpf_cnpj);

		$sql="select id,pessoa,tipo,nome from clientes where id like '$query' or razao like '$query%' or nome like '$query%' or cpf_cnpj like '$cpf_cnpj%' or tel1 like '$query%' or tel2 like '$query%' or cel like '$query%' order by nome";
		$e_sql=$sql;
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			//echo $e_sql."<br>";
			echo "Nenhum registro encontrado<br>";
		}else{
			//echo $e_sql."\n";
			while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id=$query['id'];
				$nome=$query['nome'];
				$nome=str_replace("´","'",$nome);
				echo $id." - ".$nome."|".$id."\n";
			}
		}

	break;

  Case "clientepf":

    $cpf_cnpj=$query;
    $cpf_cnpj=str_replace(".","",$cpf_cnpj);
    $cpf_cnpj=str_replace("-","",$cpf_cnpj);
    $cpf_cnpj=str_replace("/","",$cpf_cnpj);

    $sql="select * from clientes where pessoa = 'F' AND nome like '$query%' order by nome";
    $e_sql=$sql;
    $sql = $conn->prepare($sql);
    $sql->execute();

    if($sql->rowCount()==0){
      //echo $e_sql."<br>";
      echo "Nenhum registro encontrado<br>";
    }else{
      //echo $e_sql."\n";
      while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
        $id=$query['id'];
        $nome=$query['nome'];
        $nome=str_replace("´","'",$nome);
        //echo $id." - ".$nome."|".$id."\n";
		echo $nome."|".$id."\n";
      }
    }

    break;

  Case "cliente_nome":

    $cpf_cnpj=$query;
    $cpf_cnpj=str_replace(".","",$cpf_cnpj);
    $cpf_cnpj=str_replace("-","",$cpf_cnpj);
    $cpf_cnpj=str_replace("/","",$cpf_cnpj);

    $sql="SELECT 
                contato, 
                cpf_cnpj,
                rg_ie,
                cargo,
                nascimento,
                cep,
                endereco,
                nro,     
                compl,
                p_ref,
                bairro,
                cidade,
                uf,
                tel1,
                email,
                obs,
                nome
            FROM clientes  
            WHERE nome LIKE '$query%' ORDER BY nome";
    $e_sql=$sql; 
    $sql = $conn->prepare($sql);
    $sql->execute();

    if($sql->rowCount()==0){
      //echo $e_sql."<br>";
      echo "Nenhum registro encontrado<br>";
    }else{
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
    }

    break;


	Case "pedidos": 

		$sql="select * from ticket where id like '$query%' or nome like '$query%' order by nome";
		//$sql="SELECT produtos.nome_pt,pedidos.id,pedidos.custo,pedidos.venda FROM produtos LEFT OUTER JOIN pedidos ON produtos.id = pedidos.id_prod ORDER BY pedidos.id DESC"
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "";
		}else{
			while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id=$query['id'];
				//$nro=$query['nro'];
				$nome=$query['nome'];
				$nome=str_replace("´","'",$nome);
				echo $id." - ".$nome."|".$id."\n";
			}
		}

	break;

	Case "solicitacoes":

		$sql="select * from ticket where (id like '$query%' or nome like '$query%') and status < 3 order by nome";
		//$sql="SELECT produtos.nome_pt,pedidos.id,pedidos.custo,pedidos.venda FROM produtos LEFT OUTER JOIN pedidos ON produtos.id = pedidos.id_prod ORDER BY pedidos.id DESC"
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "";
		}else{
			while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id=$query['id'];
				//$nro=$query['nro'];
				$nome=$query['nome'];
				$nome=str_replace("´","'",$nome);
				echo $id." - ".$nome."|".$id."\n";
			}
		}

	break;


	Case "b_medicamento":
	
		$sql="select * from produtos where id = '".$query."' or (nome_pt like '%".$query."%' or nome_ing like '%".$query."%') order by nome_pt";
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "";
		}else{
			while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id=$query['id'];
				$nome=$query['nome_pt'];
				$apresentacao=$query['apresentacao_pt'];
				$nome=str_replace("´","'",$nome);
				$apresentacao=str_replace("´","'",$apresentacao);
				echo $nome." - ".$apresentacao."|".$id."||";
			}
		}
	break;

	Case "l_medicamento"://auto do formulário de solicitação 
	
	$sql="select * from produtos where id like '".$query."%' or nome_pt like '%".$query."%' or nome_ing like '%".$query."%' order by nome_pt";
	//$sql="select * from produtos where id like '".$query."%' or nome_pt like '%".$query."%' or nome_ing like '%".$query."%' order by nome_pt";
	//$sql="SELECT produtos.nome_pt,pedidos.id,pedidos.custo,pedidos.venda FROM produtos LEFT OUTER JOIN pedidos ON produtos.id = pedidos.id_prod where produtos.id like '".$query."%' or produtos.nome_pt like '%".$query."%' or produtos.nome_ing like '%".$query."%' order by produtos.nome_pt ORDER BY pedidos.id DESC";
	$sql = $conn->prepare($sql);
	$sql->execute();

	if($sql->rowCount()==0){
		echo "Nenhum produto encontrado";
	}else{
		while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {

			$id=$query['id'];
			$nome=$query['nome_pt'];
			$apresentacao=$query['apresentacao_pt'];
			$nome=str_replace("´","'",$nome);
			$apresentacao=str_replace("´","'",$apresentacao);

			$sql2="select * from pedidos where id_prod=$id order by id desc limit 1";
			//echo $sql2;
			$sql2 = $conn->prepare($sql2);
			$sql2->execute();

			if($sql2->rowCount()==0){
				$custo="------";
			}else{
				$rs = $sql2->fetch(PDO::FETCH_ASSOC);
				$custo=$rs['custo'];
				//$custo=$id_cli;
			}

			echo $nome." - ".$apresentacao." - Custo:".$custo."|".$id."||";
		}
	}
break;


	Case "fabricante":
	
		$sql="select * from fabricantes where id like '".$query."%' or nome like '%".$query."%' order by nome";
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "";
		}else{
			while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id=$query['id'];
				$nome=$query['nome'];
				$nome=str_replace("´","'",$nome);
				echo $id.":".$nome."|".$id."\n";
			}
		}
	break;


	Case "fornecedor":
	
		$sql="select * from fornecedores where id like '$query' or origem like '$query%' or razao like '$query%' or nome like '$query%' or cnpj like '$query%' order by nome";
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "";
		}else{
			while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id=$query['id'];
				$nome=$query['nome'];
				$nome=str_replace("´","'",$nome);
				echo $id." - ".$nome."|".$id."\n";
			}
		}
	break;



	Case "transportadora":
	
		$sql="select * from transportadoras where id like '$query' or razao like '$query%' or nome like '$query%' or cnpj like '$query%' order by nome";
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "";
		}else{
			while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id=$query['id'];
				$nome=$query['nome'];
				$nome=str_replace("´","'",$nome);
				echo $nome."|".$id."\n";
			}
		}
	break;


	Case "parceiro":
	
		$sql="select * from parceiros where id like '$query' or tipo like '$query%' or razao like '$query%' or nome like '$query%' or cnpj like '$query%' order by nome";
		$sql = $conn->prepare($sql);
		$sql->execute();

		if($sql->rowCount()==0){
			echo "";
		}else{
			while ($query = $sql->fetch(PDO::FETCH_ASSOC)) {
				$id=$query['id'];
				$tipo=$query['tipo'];
				$nome=$query['nome'];
				$tipo=str_replace("´","'",$tipo);
				$nome=str_replace("´","'",$nome);
				echo $id." - ".$nome."|".$id."\n";
			}
		}
	break;

}

fecha_conn();
?>