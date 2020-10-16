$(document).ready(function(){
		var table = $('#example').DataTable({		
		  'processing': true, 		    
		  'type': 'POST',
		  'dataType':'JSON',
		  'ajax': {		    
		          'url': BASE_URL+'tabela',
		          'ajax': 'data.json'


		},
		responsive: {
        details: {
            renderer: $.fn.dataTable.Responsive.renderer.tableAll()
        }
        },
		"columns": [			
            { "data": "nome" },
            { "data": "idade" },
            { "data": "sexo" },
            { "data": "cpf" },
            { "data": "email" },
            { "data": "telefone" }, 
            { "data": "id" }, 
            { "data": "acoes" }       
   
        ],
		   "columnDefs": [ {
	        "targets": -1,
	        "data": null,	       
	        "defaultContent": "<div class='icones-tabela'><img class='img1' src='./assets/images/editar-icone.svg'><img data-toggle='modal' data-target='#exampleModalCenter' class='img2' src='./assets/images/lixeira.svg'></div>"
        },

        {
            "targets": [ -2 ],
            "visible": false
        }

        ],		
		  'language':{
		    "sEmptyTable": "Nenhum registro encontrado",
		    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
		    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
		    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
		    "sInfoPostFix": "",
		    "sInfoThousands": ".",
		    "sLengthMenu": "_MENU_ resultados por página",
		    "sLoadingRecords": "Carregando...",
		    "sProcessing": "Processando...",
		    "sZeroRecords": "Nenhum registro encontrado",
		    "sSearch": "Pesquisar",
		    "oPaginate": {
		        "sNext": "Próximo",
		        "sPrevious": "Anterior",
		        "sFirst": "Primeiro",
		        "sLast": "Último"
		    },
		    "oAria": {
		        "sSortAscending": ": Ordenar colunas de forma ascendente",
		        "sSortDescending": ": Ordenar colunas de forma descendente"
		    },
		    "select": {
		        "rows": {
		            "_": "Selecionado %d linhas",
		            "0": "Nenhuma linha selecionada",
		            "1": "Selecionado 1 linha"
		        }
		    },
		    "buttons": {
		        "copy": "Copiar para a área de transferência",
		        "copyTitle": "Cópia bem sucedida",
		        "copySuccess": {
		            "1": "Uma linha copiada com sucesso",
		            "_": "%d linhas copiadas com sucesso"
		        }
		    }
		}	
   });

	$('#example tbody').on( 'click', 'img.img1', function () {  

		/*if(typeof id === 'undefined'){
			id = table.row( this ).data().id;
				
		} else if(typeof id === 'undefined'){
			id = table.row($(this).parents('td')).data().id;
		}*/

		var rows = table.rows( $(this).parents('td') ).indexes();
        var data = table.rows( rows ).data();	
        
        //data = JSON.stringify(data);
        
		console.log(data[0]['id']);				

		//Object.values(data[0].id)
		
		//id = table.row($(this).parents('td')).data().id;		
		
        window.open(BASE_URL+'cliente/?id='+data[0]['id'], '_self'); // abre link do id coluna        
    });  

    
	$('#example tbody').on( 'click', 'img.img2', function () {
	    //id = table.row( this ).data().id;	 

	   //var data = table.row().data();  

	   var rows = table.rows( $(this).parents('td') ).indexes();
       var data = table.rows( rows ).data();	

        $('#usuarioid').val(data[0]['id']);     
    });	

    $('#example_paginate').removeClass('dataTables_paginate');
    $('#example_paginate').addClass('float-right');
});

