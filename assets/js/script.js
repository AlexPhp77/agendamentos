$(function(){

	$('#busca').on('keyup', function(){
		var texto = $(this).val();	
        
		$.ajax({
			url:'http://localhost/sistemas/dentista/ajax',
			type:'POST',
			data:{busca:texto},
			success:function(html){
				$('.teste').html(html);
			}
		});	
	});

	$('#marcar').on('click', function(){		
        
		$.ajax({
			url:'http://localhost/sistemas/dentista/reservar',
			type:'POST',
			data:{},
			success:function(html){
				$('.reservar').html(html);
			}
		});	
	});
	
});
