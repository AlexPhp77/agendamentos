<div class="container" style=" background-color: #fff; padding: 20px;">

        <!-- Modal Inserir Users -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">CADASTRAR</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <a class="nav-link" href="cadastro">
                    <button class="btn btn-outline-info">Cliente</button>
                </a>
                <a class="nav-link" href="cadastro_funcionario">
                    <button class="btn btn-outline-info">Funcionário</button>
                </a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">CANCELAR</button>       
            </div>
          </div>
        </div>
        </div>


            <div class='botoes d-flex bd-highlight justify-content-start'>

                 <!-- Button modal -->
                <a href="<?php echo BASE_URL; ?>home">
                    <button style="float: right;" type="button" class="btn btn-primary justify-content-end" data-toggle="modal">
                    <img width="90px" src='<?php echo BASE_URL; ?>assets/images/home.svg'>
                    </button> 
                </a>

                <!-- Button modal -->
                <a href="<?php echo BASE_URL; ?>lista">
                    <button type="button" class="btn btn-primary" data-toggle="modal">
                    <img width="90px" src='<?php echo BASE_URL; ?>assets/images/lista.svg'>
                    </button> 
                </a>

                <!-- Button modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                   <img width="90px" src='<?php echo BASE_URL; ?>assets/images/add-paciente.svg'>
                </button>

                <!-- Button modal icone configurções em construção
                <a href="<?php // echo BASE_URL; ?>config">
                    <button type="button" class="btn btn-primary" data-toggle="modal">
                    <img width="90px" src='<?php //echo BASE_URL; ?>assets/images/engrenagem.svg'>
                    </button> 
                </a>-->

                 <!-- Button modal -->
                <a href="<?php echo BASE_URL; ?>sair">
                    <button style="float: right;" type="button" class="btn btn-primary justify-content-end" data-toggle="modal">
                    <img width="90px" src='<?php echo BASE_URL; ?>assets/images/exit.svg'>
                    </button> 
                </a>

            </div>
            <hr/>

    <table id="example" class="table table-striped table-bordered responsive dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
               
                <th>Nome</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>CPF</th>
                <th>E-mail</th> 
                <th>Telefone</th>   
                <th>ID</th>           
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
                <th>ID</th>              
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>    

 <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">DELETAR DADOS DO CLIENTE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
          Tem certeza que deseja excluir esse usuário? 
        </div>  
        <div class="modal-footer">

            <form method="POST" action="<?php echo BASE_URL; ?>cliente/deletar">
            <input type="hidden" value="" id="usuarioid" name="id_usuario">  
            <button type="button" class="btn btn-outline-info" data-dismiss="modal">CANCELAR</button>
            <button type="submit" style="float: right; margin-left: 10px;" class="btn btn-danger">SIM</button>   
            </form>
          
           
        </div>
      </div>
    </div>
  </div>

</div>




