<?php

session_start();
ob_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["senha"])) {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "SELECT * FROM usuarios WHERE email=:email";
        $result = $conn->prepare($sql);
        $result->bindParam(':email', $email);
        $result->execute();

        
        if ($result->rowCount() == 1) {
            $user = $result->fetch(PDO::FETCH_ASSOC);
            $verifica_senha = $user["senha"];

            if(password_verify($senha, $verifica_senha)){
                $_SESSION["id"] =            $user["id"];
                $_SESSION["email"] =         $user["email"];
                $_SESSION["nome"] =          $user["nome"];
                $_SESSION["usual"] =         $user["usual"];
                $_SESSION["tipo"] =          $user["tipo"];
                $_SESSION["ultimo_acesso"] = $user["ultimo_acesso"];
                
                $page="location:".$host."/minha-conta/meus-dados";
                
                header($page);
                exit();
            } 
            else {
                $mensagem_erro = "<div class='alert alert-danger text-center' role='lert'>Senha incorreta!</div>";
                echo $mensagem_erro;
            }
        } else {
            $mensagem_erro = "<div class='alert alert-danger text-center' role='lert'>E-mail ou senha incorretos!</div>";
            echo $mensagem_erro;
        }
    }

    if (isset($_POST["cpf_cnpj"]) && isset($_POST["cep"])) {
        $cpf_cnpj = $_POST["cpf_cnpj"];
        $cep = $_POST["cep"];
        
        $sql_data = "SELECT * FROM usuarios WHERE cpf_cnpj=:cpf_cnpj";
        $resultado_cpf_cnpj = $conn->prepare($sql_data);
        $resultado_cpf_cnpj->bindParam(':cpf_cnpj', $cpf_cnpj);
        $resultado_cpf_cnpj->execute();
        
        if ($resultado_cpf_cnpj->rowCount() == 1) {
            $mensagem_erro = "<div class='alert alert-danger text-center' role='lert'>Já existe um usuário com esse CPF/CNPJ</div>";
            echo $mensagem_erro;
        } else {
            $_SESSION['cpf_cnpj'] = $cpf_cnpj;
            $_SESSION['cep'] = $cep;
            
            $page="location:".$host."/minha-conta/cadastro";
            header($page);
            exit();
        }
    }
}




if ($pg_int <> "S") {

    $redir = "Location:index.php";

    header($redir);

    die();

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


if($ip=="187.21.240.82"){
    $_SESSION['email']="andre@portalhosting.com.br";
    $senha="123489";
}


?>

<div class='container mt-4'>

    <div class='row'>

        <div class="col-xs-12 col-md-1 col-lg-1 text-left">&nbsp;</div>

        <div class="col-xs-12 col-md-4 col-lg-4 text-left">

            <h5><b>Já sou cadastrado</b></h5>
                
            <br>

            <form name="login1" id="login1" method="post" action="">
                <div id="erro"></div>
                <input type="hidden" name="redir" value="">

                E-mail:<br>

                <input class="form-control" value="<?php echo $_SESSION['email']; ?>" name="email" id="email" type="email" required /><br>

                Senha:<span class='txt-14 float-end recuperar_senha'><a href='#' class="txt-14 recuperar_senha" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Esqueceu a senha?</a></span><br>

                <input class="form-control" name="senha" id="senha" type="password" required value="<?=$senha;?>"/><br>



                <div class='d-grid gap-2'>

                    <button type='submit' name='login1' id='login1' class='btn btn-lg btn-warning'><b>Entrar</b></button>

                </div>



                <div class='clear'></div><br>

                <p class='erro_login text-center'></p>

            </form>

        </div>



        <div class="col-xs-12 col-md-2 col-lg-2 text-left">&nbsp;</div>



        <div class="col-xs-12 col-md-4 col-lg-4 text-left">

            <h5><b>Quero me cadastrar</b></h5>

            <br>

            <!-- /minha-conta/cadastro -->
            <form name="login2" id="login2" method="post" action="">
                <input type="hidden" name="tipo" value="cadastro">
                <input type="hidden" name="redir" value="">
                Cpf ou Cnpj:<br>
				<input class="form-control" name="cpf_cnpj" id="cpf_cnpj" value="" onBlur="validar(this);" type="text" required/><br>

                <!-- E-mail:<br>

                <input class="form-control" name="email" id="email" value="" type="email" required /><br> -->

                CEP:<!-- <span class='txt_login_14 float-right'>Não sei meu CEP</span> --><br>

                <input class="form-control cep" name="cep" id="cep" value="" type="text" required />

                <br>

                <div class='d-grid gap-2'>

                    <button type='submit' name='login2' id='login2' class='btn btn-lg btn-warning'><b>Continuar</b></button>

                </div>





                <div class='clear'></div><br>

                <p class='erro_login text-center'></p>

            </form>

        </div>

        <div class="col-xs-12 col-md-1 col-lg-1 text-left">&nbsp;</div>

    </div>

</div>

</div>

</section>

<br><br>

<!-- Modal -->



<form id="lembrar_senha" name="formulario" action="<?= $host; ?>/lembrar_senha" method="post">

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div id='conteudo_ls'>

        <div class="modal-content">

            <div class="modal-header">

                <h1 class="modal-title fs-5" id="staticBackdropLabel">Lembrar senha</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <p class="text-center">Digite seu <b>e-mail</b> abaixo para recuperar sua senha.<BR>

                    <input class='form-control' name="email" id="email" type="email" required />

                </p>

            </div>

            <div class="modal-footer">

                <button type="submit"  name='formulario' id='formulario' class="btn btn-warning">Recuperar Senha</button>

            </div>   

        </div>

    </div>

    </div>

</div>

</form> 