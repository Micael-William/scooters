<?php

//$campo="opcionais_carro";

//$nro_np="4";

$sql = "select * from tipos_veiculos where np=:nro_np order by topico";

$sql = $conn->prepare($sql);

$sql->bindParam(':nro_np', $nro_np, PDO::PARAM_INT);

$sql->execute();



if($sql->rowCount()==0){

	echo "Nenhum registro encontrado";

}else{

    echo "<div class='row'>";

	$c=0;

	$nro_item=0;



	$p_tipo="¨¨".$compara;

	//$p_tipo="¨¨".$campo;

	$exp_tipo=explode("¨", $p_tipo);

	

	while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {

		$c++;

		$nro_item++;

		//if ($c==1){echo "<div class='row'>".PHP_EOL;}

		$id_item=$rs['id'];

		$item=$rs['topico'];

		If ($item<>""){$item=str_replace("´","'",$item);}



		if(strpos($p_tipo,"¨".$id_item."¬")) {

			

			foreach($exp_tipo as $linha){//¨id¬tem¬exibe¬item



				list ($id_linha, $tem_linha, $exibe_linha, $item_linha) = explode ('¬', $linha);

				if ($id_item==$id_linha){	

					if($tem_linha=="S"){$checked_tem=" checked";$estilo_item="bold";}else{$checked_tem="";$exibe_disabled=" disabled";$estilo_item="normal";}

					$e_item=$item_linha;

					break;

				}

				$id_linha="";$tem_linha="";$exibe_linha="";$item_linha="";

			}

		

		}else{

			// não encontrou

			$e_item=$item;

			$exibe_disabled=" disabled";

			$checked_tem="";

			$checked_exibe="";

			$estilo_item="normal";

		} 

	

		echo "<div class='col-sm-4'><div class='checkbox'><label>".PHP_EOL;

		echo "	<input type='hidden' name='".$campo."_id_".$nro_item."' value='".$id_item."'/>".PHP_EOL;

		echo "	<input type='hidden' name='".$campo."_nome_".$nro_item."' value='".$item."'/>".PHP_EOL;

		//echo "	<input type='checkbox' name='".$campo."_tem_".$nro_item."' id='".$campo."_tem_".$nro_item."' value='S' ".$checked_tem." onchange='check_visu_opcionais_carro(".$nro_item.")'>&nbsp;";

		echo "	<input type='checkbox' name='".$campo."_tem_".$nro_item."' id='".$campo."_tem_".$nro_item."' value='S' ".$checked_tem.">&nbsp;";

		echo "&nbsp;<span class='".$campo."_".$nro_item." ".$estilo_item."'>".$e_item."</span>".PHP_EOL;

		echo "</label></div></div>".PHP_EOL;

		$id_item="";$item="";$e_item="";$item_qtde="";

	}

    echo "<div class='row'>";

	echo "<input type='hidden' name='nro_".$campo."' value='".$nro_item."'/>".PHP_EOL;

}



$nro_item=0;

?>