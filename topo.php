<?
session_start();
ob_start();


if ($pg_int <> "S") {

    $redir = "Location:index.php";

    header($redir);

    die();

}?>

<header class="Header" id="Header">

  <div class="BarIcons">

    <div class="BarIconsBox container">

      <div style="line-height: 25px;" class="BarIcons_field">

        <?php if (isset($_SESSION['id'], $_SESSION['usual'])){ ?>

        <i class="bi bi-person-circle"></i>
          <div class="dropdown">
          
            <a style="cursor: pointer; text-decoration:none; color:#000;" class="dropdown-toggle"data-bs-toggle="dropdown"aria-expanded="false">
             <?php echo $_SESSION['usual']; ?>
            </a>

            <ul class="dropdown-menu">
           
              <li style="font-size: 14px; font-family:Arial, Helvetica, sans-serif">
                <a  href="<?=$host;?>/minha-conta/meus-dados"  class="dropdown-item">Meus dados</a>
              </li>
              <li style=" font-size: 14px;">
                <a style="" href="<?=$host;?>/minha-conta/trocar-senha"  class="dropdown-item">Trocar senha</a>
              </li>
              <li style=" font-size: 15px;">
                <a style="" href="<?=$host;?>/minha-conta/meus-anuncios"  class="dropdown-item">Meus anúncios</a>
              </li>
              
              <li  style="font-size: 15px;">
                <a style="" href="<?=$host;?>/minha-conta/favoritos"  class="dropdown-item">Favoritos</a>
              </li>

             <li style="font-size: 15px;">
                <a style="" href="<?=$host;?>/minha-conta/mensagens"  class="dropdown-item">Mensagens</a>
              </li>
              
              <li style=" font-size: 15px;">
                <a style="margin-top: 5px;" href="<?=$host;?>/minha-conta/logout"  class="dropdown-item">Sair</a>
              </li>
            </ul>
          </div>
        
       <?php } else { ?>
        <i class="bi bi-person-circle"></i>
        <a href="<?=$host;?>/login" class="BarIcons_field-text">Login</a>
        <?php }?>
      </div>

      <div class="BarIcons_field">

        <i class="bi bi-heart-half"></i>

        <a href="<?=$host;?>/minha-conta/favoritos" class="BarIcons_field-text">Favoritos</a>

      </div>

      <div class="BarIcons_field">

        <i class="bi bi-chat-right"></i>

        <a href="<?=$host;?>/minha-conta/mensagens" class="BarIcons_field-text">Mensagens</a>

      </div>

    </div>

  </div>

  <div class="MainHeader container">

    <div class="MainHeaderLogo text-center">

      <a href="<?=$host;?>"><img src="<?=$host;?>/img/logo_site.png" alt="LOGO ISCOOTERS" /></a>

    </div>

    <nav class="MainHeaderNav">

      <li class="MainHeaderNav_item"><a href='<?=$host;?>/scooters'>Scooters</a></li>

      <li class="MainHeaderNav_item"><a href='<?=$host;?>/scooters-eletrica'>Scooters Elétrica</a></li>

      <li class="MainHeaderNav_item"><a href='<?=$host;?>/comprar'>Comprar</a></li>

      <li class="MainHeaderNav_item"><a href='<?=$host;?>/vender'>Vender</a></li>

      <li class="MainHeaderNav_item"><a href='<?=$host;?>/fipe'>Tabela FIPE</a></li>

      <li class="MainHeaderNav_item"><a href='<?=$host;?>/blog'>Dicas e Novidades</a></li>

      <button class="MainHeaderNav_menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">

        <i class="bi bi-list"></i>

      </button>

    </nav>

  </div>



  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

    <div class="offcanvas-header">

      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

    </div>

    <div class="offcanvas-body">

      <a href="<?=$host;?>"><img src="<?=$host;?>/img/logo_site.png" alt="LOGO ISCOOTERS" height="90"/></a>

      <nav class="MainHeaderNavMobile">

        <li class="MainHeaderNavMobile_item"><a href='<?=$host;?>/scooters'>Scooters</a></li>

        <li class="MainHeaderNavMobile_item"><a href='<?=$host;?>/scooters-eletrica'>Scooters Elétrica</a></li>

        <li class="MainHeaderNavMobile_item"><a href='<?=$host;?>/comprar'>Comprar</a></li>

        <li class="MainHeaderNavMobile_item"><a href='<?=$host;?>/vender'>Vender</a></li>

        <li class="MainHeaderNavMobile_item"><a href='<?=$host;?>/fipe'>Tabela FIPE</a></li>

        <li class="MainHeaderNavMobile_item"><a href='<?=$host;?>/blog'>Dicas e Novidades</a></li>

      </nav>

    </div>

  </div>

</header>