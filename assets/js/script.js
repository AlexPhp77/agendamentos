$(function(){

	$('#busca').on('keyup', function(){		
		
		var texto = $.trim($(this).val());	
        
		$.ajax({
			url:'http://localhost/agenda/ajax',
			type:'POST',
			data:{busca:texto},
			success:function(html){
				$('.teste').html(html);
			}
		});	
	});	

	$('#cep').mask('00000-000');
	$('#telefone').mask('(00) 00000-0000');
	$('#cpf').mask('000.000.000-00', {reverse: true});
});

