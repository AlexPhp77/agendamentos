$(function(){

	$('#busca').on('keyup', function(){		
		
		var texto = $.trim($(this).val());	
        
		$.ajax({
			url: BASE_URL+'ajax',
			type:'POST',
			data:{busca:texto},
			success:function(html){
				$('.teste').html(html).val();
			}
		});	
	});	

	$('#cep').mask('00000-000');
	$('#telefone').mask('(00) 00000-0000');
	$('#cpf').mask('000.000.000-00', {reverse: true});

	$.ajax({
		url: BASE_URL+'home/notificacao',
		type:'POST',
		dataType:'JSON',
		success:function(json){

		}
	});

	$('#modaldelete').on('show.bs.modal', function (event) {                                                      
        var button = $(event.relatedTarget);
        var recipientId = button.data('id2');                                                                
        //var recipientNome = button.data('nome'); 

        var modal = $(this);
        modal.find('#id2').val(recipientId);
        //modal.find('#nome').val(recipientNome);
    })
});

