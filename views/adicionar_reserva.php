<?php 

if(!isset($_SESSION['logado']) && empty($_SESSION['logado'])){
	?>
    <script type="text/javascript">window.location.href="<?php echo BASE_URL; ?>./";</script>
	<?php 
}

/*Verifica quantos dias há em um mês*/
$numero = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); 

?> 

<div class="container">
	<form method="POST">
		<div class="form-row">
		    <div class="form-group col-md-6">
		        <label for="data">Dia da consulta</label>		        
		        <select class="form-control form-control-lg" id="data" name="data">
		        	<option >Selecionar dia</option>
			        <?php for($i=1; $i <= $numero; $i++): ?>
					<option placeholder="Selecionar dia"><?php echo $i ?></option>
				    <?php endfor; ?>
		        </select>
		    </div>
		    <div class="form-group col-md-6">
		        <label for="hora">Hora início</label>
		        <select class="form-control form-control-lg" id="hora" name="hora">	
					<option >08:00</option>
					<option >09:00</option>
					<option >10:00</option>
					<option >11:00</option>
					<option >14:00</option>
					<option >15:00</option>
					<option >16:00</option>				 
					<option >17:00</option>					
		        </select>
		    </div>
		</div>  
        <button type="submit" class="btn btn-info">Reservar</button>
    </form>
</div>
<hr/>

