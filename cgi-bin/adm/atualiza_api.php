<?
if($pg_int <> "S"){
	$redir="Location:index.php";
	header($redir);
	die();
}





$link_pg=$host."/adm/".$var2;

$url = "https://parallelum.com.br/fipe/api/v1/motos/marcas";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$obj = json_decode($result, true);
//print_r($result);
$marca=0;
$np=0;
$status='I';
foreach ($obj as $valor) {
	$codigo = $valor["codigo"];
	$topico = $valor["nome"];
	//echo "<br>Cod:$codigo - Marca:$topico";

    $sql="select * from marcas_modelos_api where id_api='$codigo'";
    $sql = $conn->prepare($sql);
    $sql->execute();
    
    if($sql->rowCount()==0){//grava
        
        $ins='insert into marcas_modelos_api (topico,id_api,marca,np,status) values (:topico,:id_api,:marca,:np,:status)';
        $ins = $conn->prepare($ins);
        $ins -> bindParam(':topico',$topico,PDO::PARAM_STR);
        $ins -> bindParam(':id_api',$codigo,PDO::PARAM_STR);
        $ins -> bindParam(':marca',$marca,PDO::PARAM_STR);
        $ins -> bindParam(':np',$np,PDO::PARAM_STR);
        $ins -> bindParam(':status',$status,PDO::PARAM_STR);
        $ins -> execute();

        echo "Nova marca:$topico<br>";

    }else{
        
        $up='update marcas_modelos_api set topico=:topico where id_api=:id_api';
        $up = $conn->prepare($up);
        $up -> bindParam(':topico',$topico,PDO::PARAM_STR);
        $up -> bindParam(':id_api',$codigo,PDO::PARAM_STR);
        $up -> execute();

    }

}


//Modelos
$sql="select * from marcas_modelos_api where marca='0' order by id";
$sql = $conn->prepare($sql);
$sql->execute();

while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
    
    $id=$rs['id'];
    $marca_db=$rs['topico'];
    $id_api=$rs['id_api'];
   
    $url = "https://parallelum.com.br/fipe/api/v1/motos/marcas/";
    $url.= $id_api."/modelos";

    //echo "Url:".$url;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $obj = json_decode($result, true);
    //print_r($result);
    $arr="modelos";
    foreach ($obj[$arr] as $p_mod) {
        $codigo = $p_mod["codigo"];
        $modelo = $p_mod["nome"];
        //echo "Cod:$codigo - Modelo:$modelo >> ";

        $sql_m="select * from marcas_modelos_api where id_api='$codigo'";
        $sql_m = $conn->prepare($sql_m);
        $sql_m->execute();
        
        if($sql_m->rowCount()==0){//grava
            
            $ins='insert into marcas_modelos_api (topico,id_api,marca,np,status) values (:topico,:id_api,:marca,:np,:status)';
            $ins = $conn->prepare($ins);
            $ins -> bindParam(':topico',$modelo,PDO::PARAM_STR);
            $ins -> bindParam(':id_api',$codigo,PDO::PARAM_STR);
            $ins -> bindParam(':marca',$id_api,PDO::PARAM_STR);
            $ins -> bindParam(':np',$id,PDO::PARAM_STR);
            $ins -> bindParam(':status',$status,PDO::PARAM_STR);
            $ins -> execute();

            echo "Novo modelo da marca $marca_db: $modelo<br>";

        }else{
            
            $up='update marcas_modelos_api set topico=:topico where id_api=:id_api';
            $up = $conn->prepare($up);
            $up -> bindParam(':topico',$modelo,PDO::PARAM_STR);
            $up -> bindParam(':id_api',$codigo,PDO::PARAM_STR);
            $up -> execute();

        }
    }
}

echo "<hr><p class='text-center'><b>MARCAS E MODELOS ATUALIZADOS COM SUCESSO</b><hr><br><br>";
?>