<?php

  if(!isset($_SESSION)){
    session_start();
  }

  $link = $host . "/login";

  if(!isset($_SESSION["id"])){
    $abertura_tag = "<div class='alert alert-danger text-center container' role='alert'>";

    $fechamento_tag = "</div>";

    $legenda = "Você não pode acessar essa página se não estiver logado!";

		// die("Você não pode acessar essa página se não estiver logado!<p><a href=\"$redir\">Entrar</a></p>");
    die($abertura_tag .  $legenda . "<p><a href=\"$link\">Entrar</a></p>" . $fechamento_tag);
	}
?>