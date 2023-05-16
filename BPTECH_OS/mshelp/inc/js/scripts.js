$('[data-toggle="tooltip"]').tooltip();
$('[data-toggle="popover"]').popover();

$('body').on('click', function (e) {
$('[data-toggle="popover"]').each(function () {
    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
        $(this).popover('hide');
    }
});
});




//Escolher subatividade por atividade
$(function(){
	$('#cod_atividade').change(function(){
		if( $(this).val() ) {
            var valor = $(this).val();
            $.ajax({
    			type:"POST",
    			url:"getsubatividade2.php",
    			data:{id: valor},
    			success: function(result) {
    			    $('#cod_subatividade').html();
    				$('#cod_subatividade').html(result);
    			}
    		});
        } else {}
	});
});


//Escolher
$(function(){
	$('#cod_setor').change(function(){
		if( $(this).val() ) {
            var valor = $(this).val();
            $.ajax({
    			type:"POST",
    			url:"getatividade.php",
    			data:{id: valor},
    			success: function(result) {
    				$('#cod_atividade option').remove();
    				$('#cod_atividade').append(result);
    			}
    		});
        } else {}
	});
});

//Escolher setor e listar colaborador
$(function(){
	$('#cod_setor_col').change(function(){
		if( $(this).val() ) {
            var valor = $(this).val();
            $.ajax({
    			type:"POST",
    			url:"getcolaborador.php",
    			data:{id: valor},
    			success: function(result) {
    				$('#cod_colab option').remove();
    				$('#cod_colab').append(result);
    			}
    		});
        } else {}
	});
});

// Menu collapse
$("[data-collapse-group='myDivs']").click(function () {
    var $this = $(this);
    $("[data-collapse-group='myDivs']:not([data-target='" + $this.data("target") + "'])").each(function () {
        $($(this).data("target")).removeClass("in").addClass('collapse');
    });
});

// Mudar setor em nova meta e exibir seus colaboradores
$(function(){
	$('#cod_setorparameta').change(function(){
		if( $(this).val() ) {
            var valor = $(this).val();
            $.ajax({
    			type:"POST",
    			url:"get_colaborador_meta.php",
    			data:{id: valor},
    			success: function(result) {
                    $('#resultado_meta').html();
    				$('#resultado_meta').html(result);
    			}
    		});
        } else {}
	});
});

function calcular() {
    var total = 0;
    var desconto = 0;
    $('.calcular').each(function(){
      var valor = Number($(this).val());
      if (!isNaN(valor)) total += valor;
    });
    total = total - desconto;
    document.getElementById("metatotal").value = total.toFixed();
}

$(function(){
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });
} );
