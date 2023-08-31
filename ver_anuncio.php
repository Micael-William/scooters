<?


$top_ref="veiculos";





$q_v3=explode('-', $var3);

$nro_arr=count($q_v3);



if ($nro_arr>1){$id=$q_v3[$nro_arr-1];}



$sql="select veiculos.id,veiculos.usuario,veiculos.tipo,veiculos.marca_fipe,veiculos.modelo_fipe,veiculos.ano_fipe,

veiculos.marca,veiculos.modelo,veiculos.versao,veiculos.valor,

veiculos.ano_fabricacao,veiculos.ano_modelo,veiculos.motor,veiculos.cilindradas,veiculos.alimentacao,

veiculos.nro_marchas,veiculos.freios,veiculos.refrigeracao,veiculos.partida,

veiculos.cor,veiculos.placa,veiculos.km,veiculos.estilo,

veiculos.cidade,veiculos.uf,

veiculos.infos,veiculos.opcionais,veiculos.texto, 

a.id as id_user,a.nome as n_usuario, 

b.id as id_alim,b.topico as n_alimentacao, 

c.id as id_freios,c.topico as n_freios, 

d.id as id_refrigeracao,d.topico as n_refrigeracao, 

e.id as id_partida,e.topico as n_partida, 

f.id as id_cor,f.topico as n_cor, 

g.id as id_estilo,g.topico as n_estilo,

h.id as id_motor,h.topico as n_motor,

i.id as id_marchas,i.topico as n_marchas

from veiculos 

left outer join usuarios as a on a.id = veiculos.usuario 	

left outer join tipos_veiculos as b on b.id = veiculos.alimentacao 	

left outer join tipos_veiculos as c on c.id = veiculos.freios 

left outer join tipos_veiculos as d on d.id = veiculos.refrigeracao

left outer join tipos_veiculos as e on e.id = veiculos.partida

left outer join tipos_veiculos as f on f.id = veiculos.cor

left outer join tipos_veiculos as g on g.id = veiculos.estilo

left outer join tipos_veiculos as h on h.id = veiculos.motor

left outer join tipos_veiculos as i on i.id = veiculos.nro_marchas

where veiculos.id=$id";

$sql = $conn->prepare($sql);

$sql->execute();




if ($sql->rowCount() == 0) {



    echo "<div class='topico mt-4'>";

    echo "<div class='container'>";

    echo "<div class='row'>";

    echo "<div class='col-12'>";

    echo $topico;

    echo "</div>";

    echo "</div>";

    echo "</div>";

    echo "</div>";



    echo "<div class='container mt-4'>";

    echo "<div class='row'>";

    echo "<div class='col-12 text-center'>";

    echo "<br><br>Nenhum registro encontrado<br><br><br><br><br><br>";

    echo "</div>";

    echo "</div>";

    echo "</div>";



}else{



    $rs = $sql->fetch(PDO::FETCH_ASSOC);
   
    include("adm/pega_veiculos_adm.php");



    //pega fipe

    $url="https://parallelum.com.br/fipe/api/v1/motos/marcas/$marca_fipe/modelos/$modelo_fipe/anos/$ano_fipe";

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    $obj = json_decode($result, true);

    $fipe_valor=$obj["Valor"];

    $fipe_mes_ref=$obj["MesReferencia"]; 



    $valor_db=$valor;

	if ($valor==0 or $valor==""){

        $valor="Consulte";

    }else{

        $valor=number_format($valor, 2, ',', '.');

        $valor="R$ ".$valor;

    }

	

    $topico="$marca $modelo";

    

    $n_usuario=$rs['n_usuario'];

    $n_alimentacao=$rs['n_alimentacao'];

    $n_freios=$rs['n_freios'];

    $n_refrigeracao=$rs['n_refrigeracao'];

    $n_partida=$rs['n_partida'];

    $n_cor=$rs['n_cor'];

    $n_estilo=$rs['n_estilo'];

    $n_motor=$rs['n_motor'];

    $n_marchas=$rs['n_marchas'];



    if($placa<>""){

		$final_placa = "<span class='claro'>***-***</span><b>".substr($placa, -1)."</b>";

	}





    if ($infos<>""){				

		$mostra_infos="";

		$p_tipo="¨¨".$infos;

		$exp_tipo=explode("¨", $p_tipo);

		//¨12¬S¬¬IPVA pago¨6¬S¬¬Licenciado¨10¬¬¬Manual do Proprietário

		foreach($exp_tipo as $linha){//¨id¬tem¬exibe¬item

			list ($id_linha, $tem_linha, $exibe_linha, $item_linha) = explode ('¬', $linha);

			

			if ($tem_linha=="S"){

				$mostra_infos.="<div class='col-sm-4 mt-2'><div class='opcionais'>".$item_linha."</div></div>";

			}	

			$id_linha="";$tem_linha="";$exibe_linha="";$item_linha="";

		}

	}



    if ($opcionais<>""){				

		$mostra_opcionais="";

		$p_tipo="¨¨".$opcionais;

		$exp_tipo=explode("¨", $p_tipo);

		//¨12¬S¬¬IPVA pago¨6¬S¬¬Licenciado¨10¬¬¬Manual do Proprietário

		foreach($exp_tipo as $linha){//¨id¬tem¬exibe¬item

			list ($id_linha, $tem_linha, $exibe_linha, $item_linha) = explode ('¬', $linha);

			

			if ($tem_linha=="S"){

				$mostra_opcionais.="<div class='col-sm-4 mt-2'><div class='opcionais'>".$item_linha."</div></div>";

			}	

			$id_linha="";$tem_linha="";$exibe_linha="";$item_linha="";

		}

	}

    







    if ($acessorios<>""){				

		$mostra_acessorios="";

		$p_tipo="¨¨".$acessorios;

		$exp_tipo=explode("¨", $p_tipo);

		//¨12¬S¬¬IPVA pago¨6¬S¬¬Licenciado¨10¬¬¬Manual do Proprietário

		foreach($exp_tipo as $linha){//¨id¬tem¬exibe¬item

			list ($id_linha, $tem_linha, $exibe_linha, $item_linha) = explode ('¬', $linha);

			

			if ($tem_linha=="S"){

				$mostra_acessorios.="<div class='col-sm-4 mt-2'><div class='opcionais'>".$item_linha."</div></div>";

			}	

			$id_linha="";$tem_linha="";$exibe_linha="";$item_linha="";

		}

	}



    if ($eletrica<>""){				

		$mostra_eletrica="";

		$p_tipo="¨¨".$eletrica;

		$exp_tipo=explode("¨", $p_tipo);

		foreach($exp_tipo as $linha){

			list ($id_linha, $tem_linha, $exibe_linha, $item_linha) = explode ('¬', $linha);

			

			if ($tem_linha=="S"){

				$mostra_eletrica.="<div class='col-sm-4 mt-2'><div class='opcionais'>".$item_linha."</div></div>";

			}	

			$id_linha="";$tem_linha="";$exibe_linha="";$item_linha="";

		}

	}





    if ($instrumentos<>""){				

		$mostra_instrumentos="";

		$p_tipo="¨¨".$instrumentos;

		$exp_tipo=explode("¨", $p_tipo);

		foreach($exp_tipo as $linha){

			list ($id_linha, $tem_linha, $exibe_linha, $item_linha) = explode ('¬', $linha);

			

			if ($tem_linha=="S"){

				$mostra_instrumentos.="<div class='col-sm-4 mt-2'><div class='opcionais'>".$item_linha."</div></div>";

			}

					

			$id_linha="";$tem_linha="";$exibe_linha="";$item_linha="";

		}

	}

    



    /***********

     * pega imagens

     */

    $larg_g=710;$alt_g=450;

    $tam_g=$larg_g."x".$alt_g;



    $larg_p=123;$alt_p=92;

    $tam_p=$larg_p."x".$alt_p;



    $sql_img="select * from imagens where id_ref=:id_ref and top_ref=:top_ref order by ordem_img,id";

	$sql_img = $conn->prepare($sql_img);

	$sql_img->bindParam(':id_ref', $id, PDO::PARAM_INT);

	$sql_img->bindParam(':top_ref', $top_ref, PDO::PARAM_STR);

	$sql_img->execute();



	if($sql_img->rowCount()>0){//pega Galeria

		$img_g="";

		$img_p="";

		$img_fotorama="";

		$img_t="";

		$fotos=0;

        echo "<div class='esconde'>";

		while ($rs = $sql_img->fetch(PDO::FETCH_ASSOC)) {

			$imagem=$rs['img'];

			$img_tit=$rs['img_tit'];
            // echo 'test';
            

            resimage($imagem,$larg_g,$alt_g,'../../','');

            resimage($imagem,$larg_p,$alt_p,'../../','');



            $array  = explode('.', $imagem);

            $ubound=count($array);

            if ($ubound>1){$extensao=$array[$ubound-1];}

            $nome="";

            for($x=0;$x<$ubound-1;$x++){

                $nome=$nome.$array[$x];

            }

            

            $img_g=$nome."_".$tam_g.".".$extensao;

            $img_p=$nome."_".$tam_p.".".$extensao;

           

			$img_fotorama.="<a href='$host/imagens/redim/$img_g'><img src='$host/imagens/redim/$img_p' alt='$img_tit'></a>".PHP_EOL;

		}

        echo "</div>";//esconde
	}else{//pega não tem imagem

		$img_fotorama='_sem_imagem.jpg';

	}



    echo "<div class='container mt-4'>";

    echo "<div class='row'>";

    echo "<div class='col-md-8'>";

    echo "<p><strong class='azul txt-40'>$topico</strong></p>";

   
   


    echo "</div>";

    echo "<div class='col-md-4'>";

    echo "<p class='valor'><strong class='valor'>$valor</strong></p>";

    echo "<h6 class='mt-2' style='color:red;'>Tabela Fipe $fipe_mes_ref: $fipe_valor</h6>";

    echo "</div>";

    echo "</div>";



    echo "<div class='row'>";

    echo "<div class='col-md-8'>";

    echo "<div class='sticky-top'>";

    

    $sql="select veiculos.id,veiculos.usuario,veiculos.usuario_logado,veiculos.tipo,veiculos.marca_fipe,veiculos.modelo_fipe,veiculos.ano_fipe,

veiculos.marca,veiculos.modelo,veiculos.versao,veiculos.valor,

veiculos.ano_fabricacao,veiculos.ano_modelo,veiculos.motor,veiculos.cilindradas,veiculos.alimentacao,

veiculos.nro_marchas,veiculos.freios,veiculos.refrigeracao,veiculos.partida,

veiculos.cor,veiculos.placa,veiculos.km,veiculos.estilo,

veiculos.cidade,veiculos.uf,

veiculos.infos,veiculos.opcionais,veiculos.texto, 

a.id as id_user,a.nome as n_usuario, 

b.id as id_alim,b.topico as n_alimentacao, 

c.id as id_freios,c.topico as n_freios, 

d.id as id_refrigeracao,d.topico as n_refrigeracao, 

e.id as id_partida,e.topico as n_partida, 

f.id as id_cor,f.topico as n_cor, 

g.id as id_estilo,g.topico as n_estilo,

h.id as id_motor,h.topico as n_motor,

i.id as id_marchas,i.topico as n_marchas

from veiculos 

left outer join usuarios as a on a.id = veiculos.usuario 	

left outer join tipos_veiculos as b on b.id = veiculos.alimentacao 	

left outer join tipos_veiculos as c on c.id = veiculos.freios 

left outer join tipos_veiculos as d on d.id = veiculos.refrigeracao

left outer join tipos_veiculos as e on e.id = veiculos.partida

left outer join tipos_veiculos as f on f.id = veiculos.cor

left outer join tipos_veiculos as g on g.id = veiculos.estilo

left outer join tipos_veiculos as h on h.id = veiculos.motor

left outer join tipos_veiculos as i on i.id = veiculos.nro_marchas

where veiculos.id=$id";

    $sql = $conn->prepare($sql);

    $sql->execute();

    $data = $sql->fetch(PDO::FETCH_ASSOC);

   
   

    if(isset($_SESSION['id'])) {
        $id_usuario_logado = $_SESSION['id'];
        $id_veiculo =        $data['id'];
        $modelo_veiculo =    $data['modelo'];
        $marca_veiculo =     $data['marca'];
        $ultimo_acesso = date('Y-m-d H:i:s');

        $botaoFavoritar = "🤍 favoritar";


        $sql = "SELECT * FROM favoritos WHERE usuario=:id_usuario_logado AND anuncio=:id_veiculo";
        $result = $conn->prepare($sql);
        $result->bindParam(":id_usuario_logado", $id_usuario_logado, PDO::PARAM_STR);
        $result->bindParam(":id_veiculo", $id_veiculo, PDO::PARAM_STR);
        $result->execute();

        if ($result->rowCount() > 0) {
            $botaoFavoritar = "❤️ favoritado";
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($botaoFavoritar === "🤍 favoritar") {
                $sql = "INSERT INTO favoritos (usuario, data, anuncio) VALUES (:id_usuario_logado,:ultimo_acesso, :id_veiculo)";
                $resultado = $conn->prepare($sql);
                $resultado->bindParam(":id_usuario_logado", $id_usuario_logado, PDO::PARAM_STR);
                $resultado->bindParam(":ultimo_acesso", $ultimo_acesso, PDO::PARAM_STR);
                $resultado->bindParam(":id_veiculo", $id_veiculo, PDO::PARAM_STR);
                $resultado->execute();

                $botaoFavoritar = "❤️ favoritado";
            } else {
                $sql = "DELETE FROM favoritos WHERE usuario=:id_usuario_logado AND anuncio=:id_veiculo";
                $resultado = $conn->prepare($sql);
                $resultado->bindParam(":id_usuario_logado", $id_usuario_logado, PDO::PARAM_STR);
                $resultado->bindParam(":id_veiculo", $id_veiculo, PDO::PARAM_STR);
                $resultado->execute();

                $botaoFavoritar = "🤍 favoritar";
            }
        }

        
    
      
        /**** FORMULARIO PARA FAVORITAR  ****/ 
        $formulario = " 
        <form id='meuForm' method='POST'>
            <input type='submit' class='favorite-btn' name='produto' value='$botaoFavoritar'>
        </form>
        ";

        echo $formulario;

    }else {
        echo '';
    }

  

    echo "<div class='fotorama' style='padding:0px;margin:0;' data-allowfullscreen='native' data-transition='crossfade' data-loop='true' data-autoplay='true' data-width='100%' data-nav='thumbs' data-thumbwidth='$larg_p' data-thumbheight='$alt_p'>";
	echo $img_fotorama;

    

	echo "</div>";



    echo "<hr>";



    

    echo "<div class='row'>";

	/************ */

    

    //ano  motor cilindrada alimentação

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Ano</b></span><br>";

    echo "<span class='txt_15 claro'><b>$ano_fabricacao/$ano_modelo</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Motor</b></span><br>";

    echo "<span class='txt_15 claro'><b>$n_motor</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;		

    echo "</div>";

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Cilindradas</b></span><br>";

    echo "<span class='txt_15 claro'><b>$cilindradas</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Alimentação</b></span><br>";

    echo "<span class='txt_15 claro'><b>$n_alimentacao</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";



    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";//row



    echo "<div class='row'>";

    //marchas freios refrigeração partida 

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Marchas</b></span><br>";

    echo "<span class='txt_15 claro'><b>$n_marchas</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Refrigeração</b></span><br>";

    echo "<span class='txt_15 claro'>$n_refrigeracao</span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Freios</b></span><br>";

    echo "<span class='txt_15 claro'><b>$n_freios</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Partida</b></span><br>";

    echo "<span class='txt_15 claro'><b>$n_partida</b></span>";

    echo "<div class='clear'></div>".PHP_EOL;	

    echo "</div>";



    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";//row



    echo "<div class='row'>";

    //cor final placa  km  estilo

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Cor</b></span><br>";

    echo "<span class='txt_15 claro'><b>$n_cor</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

    //if($final_placa<>""){

        echo "<div class='col-md-3 col-6 mt-2'>";

        echo "<span class='txt_15 escuro'><b>Final de placa</b></span><br>";

        echo "<span class='txt_15 claro'>$final_placa</span>";

        echo "<div class='clearfix'></div>".PHP_EOL;	

        echo "</div>";

    //}

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Km</b></span><br>";

    echo "<span class='txt_15 claro'><b>$km</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

    echo "<div class='col-md-3 col-6 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Estilo</b></span><br>";

    echo "<span class='txt_15 claro'><b>$n_estilo</b></span>";

    echo "<div class='clear'></div>".PHP_EOL;	

    echo "</div>";



    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";//row





    echo "<div class='row'>";

    //cor final placa  km  estilo

    echo "<div class='col-md-12 col-12 mt-2'>";

    echo "<span class='txt_15 escuro'><b>Cidade/Uf</b></span><br>";

    echo "<span class='txt_15 claro'><b>$cidade/$uf</b></span>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";//row





    echo "<hr>";



    if($mostra_infos<>""){

        echo "<div class='row mt-2'>";

        echo "<div class='col-md-12 escuro'>";

        echo "<b>Outras informações</b>";

        echo "<div class='clearfix'></div>".PHP_EOL;	

        echo "</div>";

        echo "<div class='clearfix'></div>".PHP_EOL;	

        echo "</div>";//row

        echo "<div class='row'>";

    

        echo $mostra_infos;

        

        echo "<div class='clearfix'></div>".PHP_EOL;	

        echo "</div>";//row

    }



    echo "<hr>";



    if($mostra_opcionais<>""){

        echo "<div class='row mt-2'>";

        echo "<div class='col-md-12 escuro'>";

        echo "<b>Opcionais</b>";

        echo "<div class='clearfix'></div>".PHP_EOL;	

        echo "</div>";

        echo "<div class='clearfix'></div>".PHP_EOL;	

        echo "</div>";//row

        echo "<div class='row'>";

    

        echo $mostra_opcionais;

        

        echo "<div class='clearfix'></div>".PHP_EOL;	

        echo "</div>";//row

    }



    echo "<hr>";



    echo "<div class='row'>";

    echo "<div class='col-md-12'>";

    echo nl2br($texto);

    echo "<br><br>";

    echo "<div class='clearfix'></div>".PHP_EOL;	

    echo "</div>";

  



    echo "<div class='clearfix'></div>".PHP_EOL;	



    echo "</div>";//row

	

    /*************/

    echo "</div>"; //sticky-top

    echo "</div>"; //conteudo 9

    /*************/

    /*************/

    echo "<div class='col-md-4'>";

    echo "<div class='sticky-top'>";

    

    /*************/
  
    if (!isset($_SESSION['id'])) {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $id_anuncio =    $data['id'];
            $id_anunciante = $data['usuario_logado'];
            
            $nome =          $_POST['nome'];
            $telefone =      $_POST['telefone'];
            $email =         $_POST['email'];
            $mensagem =      $_POST['mensagem'];
            $status_user =   "A";
        
            $inseri_dados = "insert into mensagens (data, id_anuncio, anunciante, nome, celular, email,  msn, status)values (:ultimo_acesso, :id_anuncio, :id_anunciante, :nome, :telefone, :email, :mensagem, :status_user)";
        
            $sql_data = $conn->prepare($inseri_dados);
        
            $ultimo_acesso = date('Y-m-d H:i:s');
        
            $sql_data->bindParam(":ultimo_acesso", $ultimo_acesso, PDO::PARAM_STR);
            $sql_data->bindParam(":id_anuncio", $id_anuncio, PDO::PARAM_STR);
            $sql_data->bindParam(":id_anunciante", $id_anunciante, PDO::PARAM_STR);
            $sql_data->bindParam(":nome", $nome, PDO::PARAM_STR);
            $sql_data->bindParam(":telefone", $telefone, PDO::PARAM_STR);
            $sql_data->bindParam(":email", $email, PDO::PARAM_STR);
            $sql_data->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
            $sql_data->bindParam(":status_user", $status_user, PDO::PARAM_STR);
        
            if ($sql_data->execute()) {
                $mensagem_sucesso = "
                <div class='alert alert-success' role='alert'> 
                    Mensagem enviada com sucesso!
                </div>";
    
                echo $mensagem_sucesso;
            } 
        }
    }

    
    
    

    // FORMULARIO ENVIA PROPOSTA
   
    echo "<form class='form-horizontal'  method='POST' id='form_contato_anuncio' action=''>";

	echo "<input type='hidden' name='anuncio' value='$id_anuncio'>";

	echo "<input type='hidden' name='embarcacao' value='$carro'>";

	echo "<input type='hidden' name='ano' value='$ano'>";

	echo "<input type='hidden' name='valor' value='$valor_db'>";

	
    echo "<p><strong>Ficou interessado ?</strong></p>";

	echo "Preencha seus dados e envie sua proposta!<br>";
    echo "<input type='text' class='form-control mt-3' name='nome' id='nome' placeholder='Seu Nome' required/>";
	echo "<input type='text' class='form-control mt-2' name='telefone' id='telefone' placeholder='Telefone/WhatApp' required>";
	echo "<input type='email' class='form-control mt-2' name='email' id='email' placeholder='E-mail' required/>";
	echo "<textarea class='form-control mt-2' name='mensagem' id='mensagem' wrap='virtual' style='height:95px;' placeholder='Sua Mensagem'>Olá, tenho interesse na Scooter. Favor entrar em contato.</textarea>";

	echo "<div class='form-check mt-1'>
	<input class='form-check-input' type='checkbox' value='S' name='aceite_contato' id='aceite_contato' checked>
	<label class='form-check-label txt_12' for='aceite_contato'>
	Aceito receber contatos por e-mail, WhatsApp ou outros canais.
	</label>
	</div>";

	echo "<div class='mt-1 mb-1' id='ret_contato_anuncio'></div>";
	echo "<div class='clearfix'></div>".PHP_EOL;


	echo "<div class='d-grid gap-2'>";
    	echo "<button type='submit' class='btn btn-lg btn-warning'><b>Enviar mensagem</b></button>";
	echo "</div>";



    /*************/

    echo "</div>"; //sticky-top

    echo "</div>"; //lateral 2

    echo "</div>"; //row

    echo "</div>"; //container



}

echo "<br><br>";

?>