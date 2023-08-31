<?

if ($pg_int <> "S") {

    $redir = "Location:index.php";

    header($redir);

    die();

}

//estilo eletrica=84

//estilo gasolina=89



$filtro="id > 0 ";



if($var1=="busca"){

    /*

    echo "<pre>";

    print_r($_POST);

    echo "</pre>";

    */



    $tipo=$_POST['tipo'];//estilo

    if($tipo=="eletrica"){$tipo="84";}//eletrica

    if($tipo=="combustao"){$tipo="88";}//gasolina



    $q=$_POST['q'];



    if($tipo<>""){$filtro.="and estilo='$tipo' ";}

    if($q<>""){$filtro.="and (marca like '%$q%' or modelo like '%$q%' ";}



    /*

    if($marca<>""){$filtro.="and estaleiro='$marca' ";}

    if($ano_de<>""){$filtro.="and ano_emb >= '$ano_de' ";}

    if($ano_ate<>""){$filtro.="and ano_emb <= '$ano_ate' ";}

    if($tamanho_de<>""){$filtro.="and tam >= '$tamanho_de' ";}

    if($tamanho_ate<>""){$filtro.="and tam <= '$tamanho_ate' ";}

    */



    $topico="<b>Resultado da busca</b>";



}else{



    $ano = date('Y');



    if($var1=="scooters"){$topico="Scooters";}

    if($var1=="scooters-eletrica"){$topico="Scooters elétrica";$filtro.="and estilo='84' ";}

    if($var1=="scooters-novas"){$topico=="Scooters novas";$filtro.="and km <= '100' and ano_fabricacao='$ano' ";}

    if($var1=="scooters-usadas"){$topico=="Scooters usadas";$filtro.="and ano_fabricacao < '$ano' ";}

    //echo "passou por aqui....Filtro=$filtro";

}





echo "<div class='topico mt-4'>";

echo "<div class='container'>";

echo "<div class='row'>";

echo "<div class='col-12  topico'>";

echo $topico;

echo "</div>";

echo "</div>";

echo "</div>";

echo "</div>";



$sql="select id,marca,modelo,ano_modelo,ano_fabricacao,valor,km,cidade,uf from veiculos where $filtro and status='A' order by id desc";

//echo $sql;

$sql = $conn->prepare($sql);

$sql->execute();



if ($sql->rowCount() == 0) {

    echo "<div class='container mt-4'>";

    echo "<div class='row'>";

    echo "<div class='col-md-12'>";

    echo "<br><br>Nenhum registro encontrado<br><br><br><br><br><br>";

    echo "</div>";

    echo "</div>";

    echo "</div>";



}else{

    $larg = '300';$alt = '210';



    echo "<div class='Highlights' id='Highlights'>";

    echo "<div class='HighlightsCards'>";



    //echo "<div class='container mt-4'>";

    //echo "<div class='row'>";

    while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {



        $id=$rs['id'];

        $marca=$rs['marca'];

        $modelo=$rs['modelo'];

        $ano_modelo=$rs['ano_modelo'];

        $ano_fabricacao=$rs['ano_fabricacao'];

        $valor=$rs['valor'];

        $km=$rs['km'];

        $cidade=$rs['cidade'];

        $uf=$rs['uf'];



        if ($valor==0 or $valor==""){

            $valor="Consulte";

        }else{

            $valor=number_format($valor, 2, ',', '.');

        }

        $marca_modelo=url_amigavel("$marca $modelo");



        $sql_img="select * from imagens where id_ref='$id' and top_ref='veiculos' order by ordem_img,id desc limit 1";

        $sql_img = $conn->prepare($sql_img);

        $sql_img->execute();



        if ($sql_img->rowCount() == 0) {

            $imagem="sem_imagem.jpg";

        }else{

            $rs_img = $sql_img->fetch(PDO::FETCH_ASSOC);

            $imagem=$rs_img['img'];

        }



        $link_anuncio="$host/ver/scooter/$marca_modelo-$id";



        //echo "<div class='Card col-6 col-md-3 mb-4'>";

        echo "<div class='Card mb-4'>";

        echo "<a href='$link_anuncio' class='Card'>";

        resimage($imagem, $larg, $alt, '', '');

        echo "<h4 class='Card_title'>$marca $modelo</h4>";

        echo "<div class='Card_desc-box'>";

        echo "<p class='Card_desc-text'>$ano_fabricacao/$ano_modelo</p>";

        echo "<p class='Card_desc-text'>$km km</p>";

        echo "</div>";

        echo "<p class='Card_desc-text'>$cidade - $uf</p>";

        echo "<h4 class='Card_value'>R$ $valor</h4>";

        echo "</a>";

        echo "</div>";

    }

    echo "</div>";

    echo "</div>";

}

?>