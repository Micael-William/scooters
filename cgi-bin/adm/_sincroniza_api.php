<?
include("../conn.php");
$conn=conecta();

$url = "https://parallelum.com.br/fipe/api/v1/motos/marcas";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$obj = json_decode($result, true);
//print_r($result);
$ni=0;
$np=0;
$status='I';
foreach ($obj as $valor) {
	$codigo = $valor["codigo"];
	$marca = $valor["nome"];
	echo "<br>Cod:$codigo - Marca:$marca";

    $sql="select * from marcas_modelos_api where id_api='$codigo'";
    $sql = $conn->prepare($sql);
    $sql->execute();
    
    if($sql->rowCount()==0){//grava
        
        $ins='insert into marcas_modelos_api (topico,id_api,ni,np,status) values (:topico,:id_api,:ni,:np,:status)';
        $ins = $conn->prepare($ins);
        $ins -> bindParam(':topico',$marca,PDO::PARAM_STR);
        $ins -> bindParam(':id_api',$codigo,PDO::PARAM_STR);
        $ins -> bindParam(':ni',$ni,PDO::PARAM_STR);
        $ins -> bindParam(':np',$np,PDO::PARAM_STR);
        $ins -> bindParam(':status',$status,PDO::PARAM_STR);
        $ins -> execute();

    }else{
        
        $up='update marcas_modelos_api set topico=:topico where id_api=:id_api';
        $up = $conn->prepare($up);
        $up -> bindParam(':topico',$marca,PDO::PARAM_STR);
        $up -> bindParam(':id_api',$codigo,PDO::PARAM_STR);
        $up -> execute();

    }

}


//Modelos
$sql="select * from marcas_modelos_api order by id";
$sql = $conn->prepare($sql);
$sql->execute();

while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
    
    $id=$rs['id'];
    $id_api=$rs['id_api'];
   
    $url = "https://parallelum.com.br/fipe/api/v1/motos/marcas/";
    $url.= $id_api."/modelos";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $obj = json_decode($result, true);

    $arr="modelos";
    foreach ($obj[$arr] as $p_mod) {
        $codigo = $p_mod["codigo"];
        $modelo = $p_mod["nome"];
        echo "<br>Cod:$codigo - Modelo:$modelo";

        $sql_m="select * from marcas_modelos_api where id_api='$codigo'";
        $sql_m = $conn->prepare($sql_m);
        $sql_m->execute();
        
        if($sql_m->rowCount()==0){//grava
            
            $ins='insert into marcas_modelos_api (topico,id_api,ni,np,status) values (:topico,:id_api,:ni,:np,:status)';
            $ins = $conn->prepare($ins);
            $ins -> bindParam(':topico',$modelo,PDO::PARAM_STR);
            $ins -> bindParam(':id_api',$codigo,PDO::PARAM_STR);
            $ins -> bindParam(':ni',$id_api,PDO::PARAM_STR);
            $ins -> bindParam(':np',$id,PDO::PARAM_STR);
            $ins -> bindParam(':status',$status,PDO::PARAM_STR);
            $ins -> execute();

        }else{
            
            $up='update marcas_modelos_api set topico=:topico where id_api=:id_api';
            $up = $conn->prepare($up);
            $up -> bindParam(':topico',$modelo,PDO::PARAM_STR);
            $up -> bindParam(':id_api',$codigo,PDO::PARAM_STR);
            $up -> execute();

        }
    }
}
?>