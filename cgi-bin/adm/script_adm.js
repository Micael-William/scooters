/*--------------------------------------------------------------
# Funções
--------------------------------------------------------------*/



/*--------------------------------------------------------------
# Diversos
--------------------------------------------------------------*/

$(document).ready(function() {

    //$('.cad_serv').collapse('collapsible: true, active: false');

    /*
    $('link_modal').on('shown.bs.modal', function () {
    	$('#myInput').focus()
    })
				

    $('.fatura-modal').on('click',function(){
    	var id=$(this).data('id');
    	//alert(id);
    	$('.modal-content').html('<b>Carregando...</b>');
    	$.ajax({
    		type: 'POST',
    		url: 'fatura_modal.php',
    		data:{id: id},
    		success: function(fatura) {
    		$('.modal-content').html(fatura);
    		},
    		error:function(err_aprova){
    		alert("Não foi possível carregar o arquivo");
    		}
    	})
    });
    */
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







    $("select[name=estaleiro]").change(function() {
        $("select[name=linha]").html('<option value="">Carregando...</option>');
        $("select[name=modelo]").html('<option value=""></option>');
        $.post(host + "/adm/mostra_combo.php?m=linha", { id: $(this).val() },
            function(mostra_linha) {
                $("select[name=linha]").html(mostra_linha);
            }
        )
    });

    $("select[name=linha]").change(function() {
        $("select[name=modelo]").html('<option value="">Carregando...</option>');
        $.post(host + "/adm/mostra_combo.php?m=modelo", { id: $(this).val() },
            function(mostra_modelo) {
                $("select[name=modelo]").html(mostra_modelo);
            }
        )
    });



}); //read function