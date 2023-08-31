<?
if ($pg_int <> "S") {
    $redir = "Location:index.php";
    header($redir);
    die();
}

if($var1=="contato" || $var1=="seguros"){
    include("forms.php");
}

$top_ref="institucional";

if($var1=="ajuda" || $var1=="institucional"){$var1=$var2;}

if($var1=="comprar"){$id=10;}
if($var1=="vender"){$id=11;}
if($var1=="pessoa-fisica"){$id=5;}
if($var1=="lojistas-e-revendas"){$id=6;}
if($var1=="atendimento"){$id=4;}
if($var1=="denuncie"){$id=7;}
if($var1=="sobre-nos"){$id=8;}
if($var1=="politica-do-site"){$id=1;}
if($var1=="politica-de-privacidade"){$id=2;}
if($var1=="termos-de-uso"){$id=3;}
if($var1=="trabalhe-conosco"){$id=9;}

$sql = "select * from institucional where id='$id'";
//echo $sql;
$sql = $conn->prepare($sql);
$sql->execute();
if ($sql->rowCount() == 0) {
    include("404.php");
}else{
    $rs = $sql->fetch(PDO::FETCH_ASSOC);
    $id=$rs['id'];
    $id_conteudo=$id;
    $topico=$rs['topico'];
    $texto=$rs['texto'];


    //#formulario_compra#
$form_compra="
<form id='form' role='form' method='POST' class='row'>
  <input type='hidden' name='form' value='compra'>
  <div class='col-md-12 mb-3'>
    Nome:
    <input type='text' class='form-control' name='nome' id='nome' value='' placeholder='' required>
  </div>
  <div class='col-md-6 mb-3'>
    E-mail
    <input type='email' class='form-control' name='email' id='email' value='' placeholder='' required>
  </div>
  <div class='col-md-4 mb-3'>
    Telefone
    <input type='email' class='form-control cel' name='telefone' id='telefone' value='' placeholder='' required>
  </div>
  <div class='col-md-12 mb-3'>
    Possui embarcação ? Se sim, qual ?
    <input type='text' class='form-control' name='tipo_embarcacao' id='tipo_embarcacao' value='' placeholder='' required>
  </div>
  <div class='mb-3'>
    <textarea class='form-control' name='mensagem' id='mensagem' wrap='virtual' style='height:85px;' placeholder='Descritivo da embarcação pretendida e sua finalidade'></textarea>
  </div>
  <p class='text-end'><button type='submit' class='btn btn-site text-end'>Enviar</button></p>
</form>
<div id='resultado_form'></div>
";



//#formulario_cadastro#
$form_cadastro="
<form id='form' role='form' method='POST' class='row'>
  <input type='hidden' name='form' value='compra'>
  <div class='col-md-12 mb-3'>
    Nome:
    <input type='text' class='form-control' name='nome' id='nome' value='' placeholder='' required>
  </div>
  <div class='col-md-6 mb-3'>
    E-mail
    <input type='email' class='form-control' name='email' id='email' value='' placeholder='' required>
  </div>
  <div class='col-md-6 mb-3'>
    Telefone
    <input type='email' class='form-control cel' name='telefone' id='telefone' value='' placeholder='' required>
  </div>

  <div class='col-md-6 mb-3'>
    Tipo de embarcação
    <input type='text' class='form-control' name='tipo_embarcacao' id='tipo_embarcacao' value='' placeholder='' required>
  </div>
  <div class='col-md-6 mb-3'>
    Modelo da embarcação
    <input type='text' class='form-control' name='tipo_embarcacao' id='tipo_embarcacao' value='' placeholder='' required>
  </div>
  <div class='col-md-1 mb-3'>
    Tamanho
    <input type='text' class='form-control' name='tam' id='tam' value='' placeholder='Pés' required>
  </div>
  <div class='col-md-1 mb-3'>
    Ano
    <input type='text' class='form-control' name='tipo_embarcacao' id='tipo_embarcacao' value='' placeholder='' required>
  </div>

  <div class='col-md-4 mb-3'>
    Motor
    <input type='text' class='form-control' name='horas_uso' id='horas_uso' value='' placeholder='' required>
  </div>
  <div class='col-md-2 mb-3'>
    Horas de uso
    <input type='text' class='form-control' name='tipo_embarcacao' id='tipo_embarcacao' value='' placeholder='' required>
  </div>

  <div class='col-md-2 mb-3'>
    Moeda
    <select name='moeda' id='moeda' class='form-select' required>
      <option value=''></option>
      <option value='R$'>R$</option>
      <option value='U$'>U$</option>
      <option value='€'>€</option>
    </select>
  </div>
  <div class='col-md-2 mb-3'>
    Valor pretendido
    <input type='text' class='form-control' name='valor' id='valor' value='' placeholder='' required>
  </div>

  <div class='mb-3'>
    <textarea class='form-control' name='mensagem' id='mensagem' wrap='virtual' style='height:85px;'
      placeholder='Outras observações'></textarea>
  </div>
  <p class='text-end'><button type='submit' class='btn btn-site text-end'>Enviar</button></p>
</form>
<div id='resultado_form'></div>
";

    $texto=str_replace("#formulario_de_compra#",$form_compra,$texto);
    $texto=str_replace("#formulario_contato#",$form_contato,$texto);
    $texto=str_replace("#formulario_seguros#",$form_seguros,$texto);
    $texto=str_replace("#formulario_cadastro#",$form_cadastro,$texto);



    //imagem principal
    $sql_img="select * from imagens where id_ref='$id_conteudo' and top_ref='$top_ref' and (extensao='jpg' or extensao='jpeg' or extensao='png' or extensao='gif')";
    $sql_img = $conn->prepare($sql_img);
    $sql_img->execute();
    
    $total_img=$sql_img->rowCount();
    if($total_img > 0){
        $rs_img = $sql_img->fetch(PDO::FETCH_ASSOC);
        $id=$rs_img['id'];
        $imagem=$rs_img['img'];
    }

    //audio
    $sql_img="select * from imagens where id_ref='$id_conteudo' and top_ref='$top_ref' and (extensao='mp3' or extensao='ogg' or extensao='mp3')";
    $sql_img = $conn->prepare($sql_img);
    $sql_img->execute();
    
    $total_audio=$sql_img->rowCount();
    if($total_audio > 0){
        $rs_img = $sql_img->fetch(PDO::FETCH_ASSOC);
        $id=$rs_img['id'];
        $audio=$rs_img['img'];
        $player_audio="<audio controls><source src='$host/imagens/$audio' type='audio/ogg'><source src='$host/imagens/$audio' type='audio/mpeg'>Seu browser não suporta este formato de áudio.</audio>";
    }

    $sql_img="select * from imagens where id_ref='$id_conteudo' and top_ref='$top_ref' and extensao='pdf'";
    $sql_img = $conn->prepare($sql_img);
    $sql_img->execute();
    
    $total_pdf=$sql_img->rowCount();
    $mostra_pdf="";
    if($total_pdf > 0){
        while ($rs_img = $sql_img->fetch(PDO::FETCH_ASSOC)) {
            //$rs_img = $sql_img->fetch(PDO::FETCH_ASSOC);
            $id=$rs_img['id'];
            $pdf=$rs_img['img'];
            $mostra_pdf.="<embed src='$host/imagens/$pdf' type='application/pdf' width='100%' height='500'/><br>";
        }
    }

    
    
    echo "<div class='topico mt-4'>";
    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<div class='col-12 topico text-end'>";
    echo $topico;
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";


    echo "<div class='container mt-4'>";
    echo "<div class='row'>";
    echo "<div class='col-12'>";


    if($total_img > 0){
        echo "<p class='text-center'>";
            resimage($imagem,'','','', 'img-100 center');
        echo "</p><br>";
    }
    if($total_audio > 0){echo $player_audio;}

    echo $texto;

    if($total_pdf > 0){echo $mostra_pdf;}

    // Restante das imagens
    $sql_img="select * from imagens where id_ref='$id_conteudo' and top_ref='$top_ref' and img<>'$imagem' and (extensao='jpg' or extensao='jpeg' or extensao='png' or extensao='gif')";
    $sql_img = $conn->prepare($sql_img);
    $sql_img->execute();
        
    $total_gal=$sql_img->rowCount();

    if($total_gal > 0){
        echo "<br>";
        if($total_gal == 1){
            $rs_img = $sql_img->fetch(PDO::FETCH_ASSOC);
            $id=$rs_img['id'];
            $imagem=$rs_img['img'];
            resimage($imagem,'','','', 'img-100 center');echo "<br><br>";

        }else{//mostra galeria

            echo "<br>";
            echo "<div class='row'>";
            while ($rs_img = $sql_img->fetch(PDO::FETCH_ASSOC)) {
               
                $id=$rs_img['id'];
                $imagem=$rs_img['img'];
                echo "<div class='col-sm-12 col-md-6 col-lg-6 mb-2'>";
                resimage($imagem,'','','', 'w-100 img-fluid');echo "<br><br>";
                echo "</div>";
            }
            echo "</div>";

        }
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
}