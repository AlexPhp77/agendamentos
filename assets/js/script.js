$(function(){

	$('#busca').on('keyup', function(){
		var texto = $(this).val();	
        
		$.ajax({
			url:'http://localhost/sistemas/agendamentos/ajax',
			type:'POST',
			data:{busca:texto},
			success:function(html){
				$('.teste').html(html);
			}
		});	
	});

	$('#marcar').on('click', function(){		
        
		$.ajax({
			url:'http://localhost/sistemas/agendamentos/reservar',
			type:'POST',
			data:{},
			success:function(html){
				$('.reservar').html(html);
			}
		});	
	});	

	$('#cep').mask('00000-000');
	$('#telefone').mask('(00) 00000-0000');
	$('#cpf').mask('000.000.000-00', {reverse: true});
});
