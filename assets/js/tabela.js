jQuery(document).ready( function () {


	$('#tabela').DataTable( {
	    serverSide: true,
	    ajax: {
	        url: BASE_URL+'home/listar_datas',
	        type: 'POST'
	    }
    });

   

} );



