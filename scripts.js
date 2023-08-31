$(".SearchByBrandCarousel").owlCarousel({

    loop: true,

    margin: 10,

    nav: true,

    responsive: {

      0: {

        items: 1,

      },

      350: {

        items: 2,

      },

      500: {

        items: 3,

      },

      768: {

        items: 4,

      },

      992: {

        items: 5,

      },

      1140: {

        items: 5,

      },

      1200: {

        items: 6,

      },

      1400: {

        items: 7,

      },

    },

});



$(".BannerPromo").owlCarousel({

    loop: true,

    margin: 10,

    nav: true,

    items: 1,

});





/*--------------------------------------------------------------

# ToTop

--------------------------------------------------------------*/

const btnToTop = document.querySelector(".btn-to-top");



btnToTop.addEventListener("click", () =>

  window.scrollTo({ top: 0, behavior: "smooth" })

);



window.addEventListener("scroll", () => {

  var posicaoScroll =

    window.pageYOffset || document.documentElement.scrollTop;



  if (posicaoScroll >= 100) {

    btnToTop.classList.remove("display-none");

  } else {

    btnToTop.classList.add("display-none");

  }

});







$(document).ready(function() {

  /*--------------------------------------------------------------

  # Lembrar senha

  --------------------------------------------------------------*/



  $('#lembrar_senha').submit(function() {

  $('#conteudo_ls').html("<b>Carregando...</b>");

    $.ajax({

    type: 'POST',

    url: host + '/envia_recuperacao_senha.php',

      data: $(this).serialize()

    })

    .done(function(data) {

      $('#conteudo_ls').html(data);

    })

    .fail(function() {

      alert("Falha no envio");

    });

    return false;

  });





  //api

  $("select[name=marca_fipe_motos]").change(function() {

      $("select[name=modelo_fipe_motos]").html('<option value="">Carregando...</option>');

      $("select[name=ano_fipe_motos]").html('<option value="">...</option>');

      $('#resultado_fipe').html("");

      $.post(host + "/adm/mostra_combo_api.php?m=mostra_modelo_moto", { id: $(this).val() },

          function(mostra_modelo) {

              $("select[name=modelo_fipe_motos]").html(mostra_modelo);

          }

      )

  });

  //api

  $("select[name=modelo_fipe_motos]").change(function() {

      $("select[name=ano_fipe_motos]").html('<option value="">Carregando...</option>');

      $('#resultado_fipe').html("");

      $.post(host + "/adm/mostra_combo_api.php?m=mostra_ano_moto", { id: $(this).val() },

          function(mostra_ano) {

              $("select[name=ano_fipe_motos]").html(mostra_ano);

          }

      )

  });

  //api

  $("select[name=ano_fipe_motos]").change(function() {

      $('#resultado_fipe').html("<b>Carregando...</b>");

      $.ajax({

              type: 'POST',

              url: host + '/adm/pega_fipe.php',

              data: $(this).serialize()

          })

          .done(function(data) {

              $('#resultado_fipe').html(data);

          })

          .fail(function() {

              $('#resultado_fipe').html("Falha na consulta");

          });

      // to prevent refreshing the whole page page

      return false;

  });



}); //read function