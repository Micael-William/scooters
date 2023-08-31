<?
if ($pg_int <> "S") {
    $redir = "Location:index.php";
    header($redir);
    die();
}


echo "<div class='Home' id='Home'>";
echo "<div id='carouselExample' class='carousel slide' data-bs-ride='carousel'>";
echo "<div class='carousel-inner'>";

$sql="select * from banners where tipo='principal'";
$sql = $conn->prepare($sql);
$sql->execute();
$a=0;
while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
    $a++;
    if($a===1){$active="active";}else{$active="";}
    $id=$rs['id'];
    $imagem=$rs['imagem'];
    echo "<div class='carousel-item $active' data-bs-interval='3000'>";
    resimage($imagem, '', '', '', 'HomeImage');
    //<img src="./assets/pexels-pixabay-159192.jpg" alt="IMAGE HOME" class="HomeImage"/>
    echo "</div>"; 
}

echo "</div>";
echo "<button class='carousel-control-prev' type='button' data-bs-target='#carouselExample' data-bs-slide='prev'>";
echo "<span class='carousel-control-prev-icon' aria-hidden='true'></span>";
echo "<span class='visually-hidden'>Previous</span>";
echo "</button>";
echo "<button class='carousel-control-next' type='button' data-bs-target='#carouselExample' data-bs-slide='next'>";
echo "<span class='carousel-control-next-icon' aria-hidden='true'></span>";
echo "<span class='visually-hidden'>Next</span>";
echo "</button>";
echo "</div>";
echo "</div>";
?>
<div class="HomeBoxSearch" id="HomeBoxSearch">
    <div class="accordion" id="accordionExample">
        <div class="AccordionHeaders">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Scooters Elétricas</button>
            </h2>
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Scooter Combustão</button>
            </h2>
        </div>
        <div class="accordion-item">
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="<?= $host; ?>/busca" class="HomeBoxSearchForm" method='POST'>
                        <input type="hidden" name="tipo" value="eletrica">
                        <input type="text" name="q" id="q" class="HomeBoxSearchForm_input" placeholder="Digite a marca ou modelo" required/>
                        <button type="submit" class="HomeBoxSearchForm_btn"><i class="bi bi-search"></i>Buscar Scooters</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="<?= $host; ?>/busca" class="HomeBoxSearchForm" method='POST'>
                        <input type="hidden" name="tipo" value="combustao">
                        <input type="text" name="q" id="q" class="HomeBoxSearchForm_input" placeholder="Digite a marca ou modelo" required/>
                        <button type="submit" class="HomeBoxSearchForm_btn"><i class="bi bi-search"></i>Buscar Scooters</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="SearchByBrand container" id="SearchByBrand">
    <h2 class="MainTitle">Buscar por Marca</h2>
    <div class="owl-carousel owl-theme SearchByBrandCarousel">
        <?
        $larg = '150';$alt = '120';
        $sql="select * from marcas_modelos_api where np=0 and imagem is not null and imagem<>'' and status='A'";
        $sql = $conn->prepare($sql);
        $sql->execute();

        while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
            $id=$rs['id'];
            $imagem=$rs['imagem'];
            echo "<div class='item'>";
            resimage($imagem, $larg, $alt, '', '');
            echo "</div>";
        }
        ?>
    </div>
</div>


<div class="Highlights" id="Highlights">
    <h2 class="MainTitle">Destaques</h2>
    <div class="HighlightsCards">
<?

    $larg = '300';$alt = '210';

    $sql="select * from veiculos where destaque ='S' and status='A' order by rand()";
    $sql = $conn->prepare($sql);
    $sql->execute();

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
    ?>
    </div>
</div>     


<div class="owl-carousel owl-theme BannerPromo container" id="BannerPromo">
    <?
    $sql="select * from banners where tipo='horizontal'";
    $sql = $conn->prepare($sql);
    $sql->execute();
    while ($rs = $sql->fetch(PDO::FETCH_ASSOC)) {
        $id=$rs['id'];
        $imagem=$rs['imagem'];
        echo "<div class='item'>";
        resimage($imagem, '', '', '', '');
        echo "</div>"; 
    }
    ?>
</div>