<?
if ($pg_int <> "S") {
    $redir = "Location:index.php";
    header($redir);
    die();
}?>

<div class="clearfix"></div>


<footer class="card-footer" id="Footer">
    <div class="container">
      <div class="FooterColumn">
        <div class="FooterBox">
          <h3 class="FooterBox_title">Comprar</h3>
          <ul>
            <li>
              <a href="<?=$host;?>/scooters">Scooter</a>
            </li>
            <li>
              <a href="<?=$host;?>/scooters-eletrica">Scooter elétrica </a>
            </li>
            <li>
              <a href="<?=$host;?>/scooters-novas">Scooters novas </a>
            </li>
            <li>
              <a href="<?=$host;?>/scooters-usadas">Scooters usadas </a>
            </li>
          </ul>
        </div>
        <div class="FooterBox">
          <h3 class="FooterBox_title">Vender</h3>
          <ul>
            <!-- <li>
              <a href="">scooter </a>
            </li>
            <li>
              <a href="">scooter elétrica </a>
            </li> -->
            <li>
              <a href="<?=$host;?>/minha-conta">gerenciar meu anúncio</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="FooterColumn">
        <div class="FooterBox">
          <h3 class="FooterBox_title">Serviços</h3>
          <ul>
            <li>
              <a href="<?=$host;?>/fipe">Tabela FIPE</a>
            </li>
            <li>
              <a href="<?=$host;?>/comparar-scooters">Comparar scooters</a>
            </li>
          </ul>
        </div>
        <div class="FooterBox">
          <h3 class="FooterBox_title">Redes Sociais</h3>
          <ul>
            <li>
              <a href="<?=$facebook_site;?>" target="_blank">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="<?=$instagram_site;?>" target="_blank">
                <i class="bi bi-instagram"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="FooterBox">
          <h3 class="FooterBox_title"><a href="mailto:<?=$email_site;?>">Fale Conosco</a></h3>
        </div>
      </div>
      <div class="FooterColumn">
        <div class="FooterBox">
          <h3 class="FooterBox_title">Ajuda</h3>
          <ul>
            <li>
              <a href="<?=$host;?>/ajuda/pessoa-fisica">Pessoa física</a>
            </li>
            <li>
              <a href="<?=$host;?>/ajuda/lojistas-e-revendas">Para lojas e revendas</a>
            </li>
            <li>
              <a href="<?=$host;?>/ajuda/atendimento/">Atendimento ao comprador</a>
            </li>
            <li>
              <a href="<?=$host;?>/ajuda/denuncie/">Denuncie um anúncio</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="FooterColumn">
        <div class="FooterBox">
          <h3 class="FooterBox_title">Intitucional</h3>
          <ul>
            <li>
              <a href="<?=$host;?>/institucional/sobre-nos">Sobre nós</a>
            </li>
            <li>
              <a href="<?=$host;?>/institucional/politica-do-site">Política do site</a>
            </li>
            <li>
              <a href="<?=$host;?>/institucional/politica-de-privacidade">Política de privacidade</a>
            </li>
            <li>
              <a href="<?=$host;?>/institucional/termos-de-uso">Termos de uso</a>
            </li>
            
            <li>
              <a href="<?=$host;?>/institucional/trabalhe-conosco">Trabalhe conosco</a>
            </li>
          </ul>
        </div>
      </div>
      <br><br>
    </div>
  </footer>