<?php
$ip = getenv("REMOTE_ADDR");
if($ip=="187.21.240.82"){
	//https://www.teste.estudio345.com.br/adm/_varre_tabela.php?tb=institucional
	$charset="utf-8";
	header('Content-type: text/html; charset=.$charset.');
	setlocale(LC_ALL, "pt_BR");
	echo "<font face=arial size=2>";
	include("../conn.php");
	$conn=conecta();

	$tabela=$_REQUEST['tb'];

	$sql = "show columns from ".$tabela;
	$sql = $conn->prepare($sql);
	$sql->execute();

	if($sql->rowCount()>0){

		echo "<b>log_".$tabela.".php</b><br>";
		$monta='$log="<br>';

		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta.=$row['Field'];
			$monta.=":*".$row['Field'].",<br>";
		}
		$monta= substr($monta,0,-5);
		$instrucao=str_replace("*","$",$monta);
		echo $instrucao;
		echo '<br>";';
		echo '<br><br>';

	/**********************************/

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		echo "<b>pega_".$tabela."_adm.php</b><br>";
		$monta="";

		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta.="*".$row['Field'];
			$monta.="=*rs['".$row['Field']."'];<br>";
		}
		
		$monta.="*id_ref=*id;<br>";

		$monta=str_replace("*","$",$monta);
		
		echo $monta;
		
		echo "<br>";


		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		$monta="";

		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta.='*'.$row['Field'].'=str_replace("/","|",*'.$row['Field'].');<br>';
		}

		$monta=str_replace("/","&acute;",$monta);
		$monta=str_replace("|","'",$monta);
		$monta=str_replace("*","$",$monta);
		echo $monta;
		echo "<br>";



	/**********************************/


		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		echo "<br><b>pega_form_".$tabela."_adm.php</b><br>";
		$monta="";
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta.="*".$row['Field']."=*_POST['".$row['Field']."'];<br>";

		}
		$monta=str_replace("*","$",$monta);
		echo $monta;
		echo "<br>";
		echo '<b>NÃO ESQUECER DE COLOCAR o if (trim($n_amigavel_1)==""){$n_amigavel_1=url_amigavel($topico_1);}else{$n_amigavel_1=url_amigavel($n_amigavel_1);}</b>';
		echo "<br>";

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		$monta="";

		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta.='*'.$row['Field'].'=str_replace("|","/",*'.$row['Field'].');<br>';
		}

		$monta=str_replace("/","&acute;",$monta);
		$monta=str_replace("|","'",$monta);
		$monta=str_replace("*","$",$monta);
		echo $monta;
		echo "<br>";
		

	/**********************************/

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		echo "<br><br><b>echo insert</b><br>insert into $tabela ";
		$monta="(";
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta=$monta.$row['Field'].",";
		}

		$monta= substr($monta,0,-1);

		$monta=$monta.") values (";

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta=$monta."'#.*".$row['Field'].".#',";
		}
		$monta= substr($monta,0,-1);
		$monta.=");";
		$instrucao=str_replace("*","$",$monta);
		$instrucao=str_replace('#','"',$instrucao);
		echo $instrucao;


	/**********************************/

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		echo "<br><br><b>Insert</b><br>";
		$monta="*sql='insert into $tabela (";
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta=$monta.$row['Field'].",";
		}

		$monta= substr($monta,0,-1);

		$monta=$monta.") values (";

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta=$monta.":".$row['Field'].",";
		}
		$monta= substr($monta,0,-1);
		$monta.=")';";
		$monta=str_replace("*","$",$monta);
		echo $monta;

		echo "<br><br>";



	/**********************************/

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		//echo "<br><br><b>Insert</b><br>";
		//$ins -> bindParam(':data',$data,PDO::PARAM_STR);
		$monta="*ins = *conn->prepare(*sql);<br>";
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta.="*ins -> bindParam(':".$row['Field']."',*".$row['Field'].",PDO::PARAM_STR);<br>";
		}
		$monta.="*ins -> execute();";
		
		$monta=str_replace("*","$",$monta);
		echo $monta;

	/**********************************/


		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		echo "<br><br><b>echo update</b><br>";
		$monta="update $tabela set ";
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			if ($row['Field']<>"id"){
				$monta=$monta.$row['Field']."='#.*".$row['Field'].".#',";
			}
		}
		$monta= substr($monta,0,-1);
		$monta.=" where id='*id'";
		$instrucao=str_replace("*","$",$monta);
		$instrucao=str_replace('#','"',$instrucao);
		echo $instrucao;
		
	/**********************************/

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		echo "<br><br><b>Update</b><br>";
		$monta="*sql='update $tabela set ";
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta.=$row['Field']."=:".$row['Field'].",";
		}
		$monta= substr($monta,0,-1);
		$monta.=" where id=:id';";
		
		$monta=str_replace("*","$",$monta);
		echo $monta;
		echo "<br><br>";

	/**********************************/

		$sql = "show columns from ".$tabela;
		$sql = $conn->prepare($sql);
		$sql->execute();

		//echo "<br><br><b>Update</b><br>";
		//$up -> bindParam(':data',$data,PDO::PARAM_STR);
		$monta="*up = *conn->prepare(*sql);<br>";
		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
			$monta.="*up -> bindParam(':".$row['Field']."',*".$row['Field'].",PDO::PARAM_STR);<br>";
		}
		$monta.="*up -> execute();";
		
		$monta=str_replace("*","$",$monta);
		echo $monta;

	/**********************************/

	}

echo "<br><br><br><br>";

}//ip
?>