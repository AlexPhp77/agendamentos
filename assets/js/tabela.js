$(document).ready(function() {
    $('#tabela').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": BASE_URL+'home/lista',
        "dataType": "JSON"
    } );
} );
