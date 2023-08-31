<?php

If ($depto_menu==""){
	$sql_0="select * from $tabela where ni='0' and np='0' order by topico";
}else {
	$sql_0="select * from $tabela where np=:depto_menu order by topico";
}

$sql_0 = $conn->prepare($sql_0);
If ($depto_menu<>""){$sql_0->bindParam(':depto_menu', $depto_menu, PDO::PARAM_INT);}
$sql_0->execute();

if($sql_0->rowCount()>0){
	
	while ($depto = $sql_0->fetch(PDO::FETCH_ASSOC)) {
		$id_depto=$depto['id']; 
		$cod=substr("0000".$id_depto,-4);
		$ni_depto=$depto['ni']; 
		$np_depto=$depto['np']; 
		$topico_depto=$depto['topico'];
		$topico_depto=str_replace("´","'",$topico_depto);
		$status_depto=$depto['status'];
		//$n_amigavel_depto=$host."/".$depto['n_amigavel_'.$idioma];
		//echo "<tr class='active'><td><b>".$topico_depto." (".$cod.")</b></td>";
		//echo "<tr class='active'><td><b>".$topico_depto."</b></td>";

		if ($status_depto=="A"){echo "<tr>";}
		if ($status_depto=="D"){echo "<tr class='bg-warning'>";}
		if ($status_depto=="N"){echo "<tr class='bg-danger'>";}

		if ($p_negrito==""){
			echo "<td><b>".$topico_depto."</b></td>";
		}else{
			echo "<td>".$topico_depto."</td>";
		}
		If ($nro_depto_loja > 0){ 
			echo "<td width='5%'class='text-center'><a href='".$link_pg."/cadastra/".$id_depto."-".$ni_depto."-".$np_depto."/".$topico_depto."' title='Inserir em ".$topico_depto."'><i class='fa fa-plus text-end' aria-hidden='true'></i></a></td>";
		}else{
			//echo "<td width='5%' class='text-center'>&nbsp;</td>";
		}

		echo "<td width='5%' class='text-center'><a href='".$link_pg."/edit/".$id_depto."-".$ni_depto."-".$np_depto."'><i class='social fa fa-pencil' aria-hidden='true'></i></td>";

		echo "<td width='5%' align=center><a href='".$link_pg."/del/".$id_depto."-".$ni_depto."-".$np_depto."'><i class='social fa fa-trash-o' aria-hidden='true'></i></td></tr>";


		$sql_1="select * from $tabela where ni=:ni and np=:id_depto order by topico";
		$sql_1 = $conn->prepare($sql_1);
		$sql_1->bindValue(':ni', '2', PDO::PARAM_INT);
		$sql_1->bindParam(':id_depto', $id_depto, PDO::PARAM_INT);
		$sql_1->execute();

		while ($secao = $sql_1->fetch(PDO::FETCH_ASSOC)) {

			$id_secao=$secao['id']; 
			$cod=substr("0000".$id_secao,-4);
			$ni_secao=$secao['ni']; 
			$np_secao=$secao['np']; 
			$topico_secao=$secao['topico'];
			$topico_secao=str_replace("´","'",$topico_secao);
			$status_secao=$secao['status'];
			
			if ($status_secao=="A"){echo "<tr>";}
			if ($status_secao=="D"){echo "<tr class='bg-warning'>";}
			if ($status_secao=="N"){echo "<tr class='bg-danger'>";}
			
			
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;»&nbsp;".$topico_secao."</td>";
		
			If ($nro_depto_loja > 1){ 
				echo "<td width='5%' class='text-center'><a href='".$link_pg."/cadastra/".$id_secao."-".$ni_secao."-".$np_secao."/".$topico_secao."' title='Inserir em ".$topico_secao."'><i class='fa fa-plus text-end' aria-hidden='true'></i></a></td>";
			}else{
				echo "<td width='5%' class='text-center'>&nbsp;</td>";
			}
				
			echo "<td width='5%' class='text-center'><a href='".$link_pg."/edit/".$id_secao."-".$ni_secao."-".$np_secao."'><i class='social fa fa-pencil' aria-hidden='true'></i></td>";
			
			echo "<td width='5%' class='text-center'><a href='".$link_pg."/del/".$id_secao."-".$ni_secao."-".$np_secao."'><i class='social fa fa-trash-o' aria-hidden='true'></i></td></tr>";

			$sql_2="select * from $tabela where ni=:ni and np=:id_secao order by topico";
			$sql_2 = $conn->prepare($sql_2);
			$sql_2->bindValue(':ni', '3', PDO::PARAM_INT);
			$sql_2->bindParam(':id_secao', $id_secao, PDO::PARAM_INT);
			$sql_2->execute();

			while ($cat = $sql_2->fetch(PDO::FETCH_ASSOC)) {

				$id_cat=$cat['id']; 
				$cod=substr("0000".$id_cat,-4);
				$ni_cat=$cat['ni']; 
				$np_cat=$cat['np']; 
				$topico_cat=$cat['topico'];
				$topico_cat=str_replace("´","'",$topico_cat);
				$status_cat=$cat['status'];
				
				if ($status_cat=="A"){echo "<tr>";}
				if ($status_cat=="D"){echo "<tr class='bg-warning'>";}
				if ($status_cat=="N"){echo "<tr class='bg-danger'>";}
				
				echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;»&nbsp;".$topico_cat."</td>";

				If ($nro_depto_loja>2){
					echo "<td width='5%' class='text-center'><a href='".$link_pg."/cadastra/".$id_cat."-".$ni_cat."-".$np_cat."/".$topico_cat."'><i class='fa fa-plus text-end' aria-hidden='true'></i></a></td>";
				}else{
					echo "<td width='5%' class='text-center'>&nbsp;</td>";
				}
				echo "<td width='5%' class='text-center'><a href='".$link_pg."/edit/".$id_cat."-".$ni_cat."-".$np_cat."'><i class='social fa fa-pencil' aria-hidden='true'></i></td>";
				echo "<td width='5%' class='text-center'><a href='".$link_pg."/del/".$id_cat."-".$ni_cat."-".$np_cat."'><i class='social fa fa-trash-o' aria-hidden='true'></i></td></tr>";

				$sql_3="select * from $tabela where ni=:ni and np=:id_cat order by topico";
				$sql_3 = $conn->prepare($sql_3);
				$sql_3->bindValue(':ni', '4', PDO::PARAM_INT);
				$sql_3->bindParam(':id_cat', $id_cat, PDO::PARAM_INT);
				$sql_3->execute();

				while ($subcat1 = $sql_3->fetch(PDO::FETCH_ASSOC)) {

					$id_subcat1=$subcat1['id'];
					$cod=substr("0000".$id_subcat1,-4);
					$ni_subcat1=$subcat1['ni']; 
					$np_subcat1=$subcat1['np']; 
					$topico_subcat1=$subcat1['topico'];
					$topico_subcat1=str_replace("´","'",$topico_subcat1);
					$status_subcat1=$subcat1['status'];
					
					if ($status_subcat1=="A"){echo "<tr>";}
					if ($status_subcat1=="D"){echo "<tr class='bg-warning'>";}
					if ($status_subcat1=="N"){echo "<tr class='bg-danger'>";}
					
					
					echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;»&nbsp;".$topico_subcat1."</td>";

					If ($nro_depto_loja>3){
						echo "<td width='5%' class='text-center'><a href='".$link_pg."/cadastra/".$id_subcat1."-".$ni_subcat1."-".$np_subcat1."/".$topico_subcat1."'><span class='glyphicon glyphicon-plus text-end'></a></td>";
					}else{ 
						echo "<td width='5%' align=center>&nbsp;</td>";
					}
					echo "<td width='5%' align=center><a href='".$link_pg."/edit/".$id_subcat1."-".$ni_subcat1."-".$np_subcat1."'><i class='social fa fa-pencil' aria-hidden='true'></i></td>";
					echo "<td width='5%' align=center><a href='".$link_pg."/del/".$id_subcat1."-".$ni_subcat1."-".$np_subcat1."'><i class='social fa fa-trash-o' aria-hidden='true'></i></td></tr>";
					
					$sql_4="select * from $tabela where ni=:ni and np=:id_subcat1 order by topico";
					$sql_4 = $conn->prepare($sql_4);
					$sql_4->bindValue(':ni', '5', PDO::PARAM_INT);
					$sql_4->bindParam(':id_subcat1', $id_subcat1, PDO::PARAM_INT);
					$sql_4->execute();

					while ($subcat2 = $sql_4->fetch(PDO::FETCH_ASSOC)) {

						$id_subcat2=$subcat2['id']; 
						$cod=substr("0000".$id_subcat2,-4);
						$ni_subcat2=$subcat2['ni']; 
						$np_subcat2=$subcat2['np']; 
						$topico_subcat2=$subcat2['topico'];
						$topico_subcat2=str_replace("´","'",$topico_subcat2);
						$status_subcat2=$subcat1['status'];
					
						if ($status_subcat2=="A"){echo "<tr>";}
						if ($status_subcat2=="D"){echo "<tr class='bg-warning'>";}
						if ($status_subcat2=="N"){echo "<tr class='bg-danger'>";}
						
						echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;»&nbsp;".$topico_subcat2."</td>";

						If ($nro_depto_loja>4){
							echo "<td width='5%' class='text-center'><a href='".$link_pg."/cadastra/".$id_subcat2."-".$ni_subcat2."-".$np_subcat2."/".$topico_subcat2."'><span class='glyphicon glyphicon-plus text-end'></a></td>";
						}else{ 
							echo "<td width='5%' align=center>&nbsp;</td>";
						}
						echo "<td width='5%' align=center><a href='".$link_pg."/edit/".$id_subcat2."-".$ni_subcat2."-".$np_subcat2."'><i class='social fa fa-pencil' aria-hidden='true'></i></td>";
						echo "<td width='5%' align=center><a href='".$link_pg."/del/".$id_subcat2."-".$ni_subcat2."-".$np_subcat2."'><i class='social fa fa-trash-o' aria-hidden='true'></i></td></tr>";

						$sql_5="select * from $tabela where ni=:ni and np=:id_subcat2 order by topico";
						$sql_5 = $conn->prepare($sql_5);
						$sql_5->bindValue(':ni', '6', PDO::PARAM_INT);
						$sql_5->bindParam(':id_subcat2', $id_subcat2, PDO::PARAM_INT);
						$sql_5->execute();

						while ($subcat3 = $sql_5->fetch(PDO::FETCH_ASSOC)) {

							$id_subcat3=$subcat3['id']; 
							$cod=substr("0000".$id_subcat3,-4);
							$ni_subcat3=$subcat3['ni']; 
							$np_subcat3=$subcat3['np']; 
							$topico_subcat3=$subcat3['topico'];
							$topico_subcat3=str_replace("´","'",$topico_subcat3);
							$status_subcat1=$subcat3['status'];
					
							if ($status_subcat3=="A"){echo "<tr>";}
							if ($status_subcat3=="D"){echo "<tr class='bg-warning'>";}
							if ($status_subcat3=="N"){echo "<tr class='bg-danger'>";}
							
							echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;»&nbsp;".$topico_subcat3."</td>";

							If ($nro_depto_loja>5){
								echo "<td width='5%' class='text-center'><a href='".$link_pg."/cadastra/".$id_subcat3."-".$ni_subcat3."-".$np_subcat3."/".$topico_subcat3."'><span class='glyphicon glyphicon-plus text-end'></a></td>";
							}else{ 
								echo "<td width='5%' align=center>&nbsp;</td>";
							}
							echo "<td width='5%' align=center><a href='".$link_pg."/edit/".$id_subcat3."-".$ni_subcat3."-".$np_subcat3."'><i class='social fa fa-pencil' aria-hidden='true'></i></td>";
							echo "<td width='5%' align=center><a href='".$link_pg."/del/".$id_subcat3."-".$ni_subcat3."-".$np_subcat3."'><i class='social fa fa-trash-o' aria-hidden='true'></i></td></tr>";
						}//subcat3

					}//subcat2

				}//subcat1

			}//cat

		}//secao

	}//depto

}else{
	echo "<tr><td><center><BR><BR><BR>Nenhum registro encontrado<BR><BR><BR></td></tr>";
}
?>
