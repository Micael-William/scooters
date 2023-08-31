<?php

  $id= $_SESSION['id'];


  $sql = "SELECT * FROM usuarios WHERE id=:id";
  $result = $conn->prepare($sql);

  $result->bindParam(":id",$id,PDO::PARAM_STR);
  $result->execute();
  $data = $result->fetch(PDO::FETCH_ASSOC);


?>



<form class="form-horizontal" name='trocar-senha' id='trocar-senha' method='post' enctype='multipart/form-data' action='<?php echo $host."/minha-conta/trocar-senha"; ?>'>
  <input type="hidden" name="id" value="<?php echo ($data['id']) ? $data['id'] : ''; ?>">
  <input type="hidden" name="ultimo_acesso" value="<?php echo ($data['ultimo_acesso']) ? $data['ultimo_acesso'] : ''; ?>">
    <div class='row'>
      <div class="col-md-12 mb-2">
        <div class='bg'><b>Dados de acesso</b></div>
      </div>
    </div>
    <div class='row'>
      <div class="col-sm-4 mb-2">
        <b>Email</b><br>
        <input disabled class="form-control" name="email" id="email" type="email" value="<?php echo ($data['email']) ? $data['email'] : ''; ?>" required>
      </div>

      <div class="col-sm-4 mb-2">
        <b>Senha</b><br>
        <input class="form-control" name="senha_nova_usuario" id="senha_nova_usuario" type="password" required/>
      </div>
      <div class="col-sm-4 mb-2">
        <b>Confirmar senha</b><br>
        <input class="form-control" name="confimar_senha_nova_usuario" id="confimar_senha_nova_usuario" type="password" required/>
      </div>
    </div>					
    <div class="error"></div>
    <div class='row'>
      <div class="col-md-12 mb-2">
        <p class='text-end'><button type='submit' name='enviar' id='enviar' class='btn btn-secondary btn-lg'><b>Alterar senha</b></button></p>
      </div>
    </div>
</form>
