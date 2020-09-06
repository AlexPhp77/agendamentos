<div class="container" style="margin-top: 10px;">

    <table id="example" class=" table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
               
                <th>Nome</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>CPF</th>
                <th>E-mail</th> 
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>   
        <tfoot>
            <tr>           
                <th>Nome</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>CPF</th>
                <th>E-mail</th> 
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>    

 <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">DELETAR DADOS DO PACIENTE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
          Tem certeza que deseja excluir esse usuário? 
        </div>  
        <div class="modal-footer">

            <form method="POST" action="<?php echo BASE_URL; ?>paciente/deletar">
            <input type="hidden" value="" id="usuarioid" name="id_usuario">  
            <button type="button" class="btn btn-info" data-dismiss="modal">CANCELAR</button>
            <button type="submit" style="float: right; margin-left: 10px;" class="btn btn-danger">SIM</button>   
            </form>
          
           
        </div>
      </div>
    </div>
  </div>

</div>


