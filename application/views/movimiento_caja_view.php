<!-- Ventana Modal de Para Abrir Caja-->
	<div id="modal_abrir_caja" class="modal fade" >
	  <div class="modal-dialog caja">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		       <h4>Apertura de Caja</h4>
	      </div>
	      <div class="modal-body ventana_modal" id="modal_content_busqueda">
	      	
	        <table class="table table-hover" id="tabla_articulos">
				<tbody>
					<tr>
						<td>Fecha</td>
						<td>
							<input type="text" id="fecha" class="form-control" value= "<?= date ("d-m-Y", time()); ?>">
								<script type="text/javascript"> 
								   Calendar.setup({ 
								   	inputField:    "fecha",
								    ifFormat:     "%d-%m-%Y",
								    selection     : new Date(),
								    button:    "fecha"
									});
								</script>
						</td>
					</tr>
					<tr>
						<td>Saldo Inicial</td>
						<td><input type="text" id="saldo_inicial" class="form-control" placeholder="0.00"></td>
					</tr>
				</tbody>
			</table>
	      </div>
	      <div class="modal-footer">
	      	<button id="abrir_caja" class="btn btn-primary flotar-izquierda" data-dismiss="modal">Abrir Caja</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
<!-- ***************************************** -->
<!-- Ventana Modal de Para Crear Nuevo Movimiento-->
	<div id="modal_nuevo_movimiento" class="modal fade" >
	  <div class="modal-dialog caja_nuevo_movimiento">
	    <div class="modal-content ventana_modal_movimiento">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		       <h4>Movimiento de Caja</h4>
	      </div>
	      <div class="modal-body " id="modal_content_busqueda">
	      	<div class="row">
		      	<div class="col-xs-5">
		      		<label for="tipo_operacion">Tipo Operación:</label>
		      		<select name="tipo_operacion" id="tipo_operacion">
		      			<option value=""></option>
		      			<option value="ingreso">Ingreso</option>
		      			<option value="salida">Salida</option>
		      		</select>
		      	</div>
		      	<div class="col-xs-5">
		      		<label for="comprobante">Comprobante: </label>
		      		<select name="comprobante" id="comprobante">
		      			<option value=""></option>
		      			<option value="factura">Factura</option>
		      			<option value="recibo">Recibo</option>
		      		</select>
		      		<label for="num_comprobante">Num. Comprobante</label>
		      		<input type="text" name="num_comprobante" id="num_comprobante">
		      	</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-xs-5">
	      			<input type="radio" name="moneda" id="bs" value="bs"><span>Bolivianos</span><br>
	      			<input type="radio" name="moneda" id="usd" value="usd"><span>Dolares</span>
	      			<div class="ocultar" id="tcambio">
		      			<label for="tipo_cambio">T.C.</label>
		      			<input type="text" id="tipo_cambio" style="width: 50px;">
	      			</div>
	      		</div>
	      		<div class="col-xs-5">
	      			<label for="monto">Monto</label>
	      			<input type="text" name="monto" id="monto">
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="col-xs-10">
	      			<label for="descripcion">Descripción</label>
	      			<input type="text" name="descripcion" id="descripcion" class="form-control">
	      		</div>
	      	</div>
	    </div>
	    <div class="modal-footer">
	      	<button id="reg_mov" class="btn btn-primary flotar-izquierda" data-dismiss="modal">Registrar Movimiento</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	    </div>
	  	</div>
	  </div>
	</div>
<!-- ***************************************** -->
<div class="row-fluid">
	<h2>&nbsp;</h2>
	<div class="span12">
			<!-- <h3>Inventario</h3> -->
			<!-- <button class="btn" id="agregar-articulos" data-toggle="modal" data-target="#modal_importa_articulos" style="margin-right:5%;">Importar Artículos</button> -->
		<div style="width: 30%;float: left;">
			<a href="" class="btn btn-primary" id="abrir" data-toggle="modal" data-target="#modal_abrir_caja" style="margin-right:5%;">Abrir Caja</a>
			<a href="" class="btn btn-danger" id="cerrar_caja" style="margin-right:5%;" data-toggle="modal" data-target="#modal_nuevo_articulo">Cerrar Caja</a>
			<a href="" class="btn btn-success" id="crear_mov" data-toggle="modal" data-target="#modal_nuevo_movimiento">Crear Mov.</a>
		</div>
		<div class="col-xs-2">
			<label for="fecha_ini">Fecha:</label>
	        <input type="text" id="fecha_ini" style="width: 100px;">
        </div>
        <div class="col-xs-2">
	        <label for="saldo_ini">Saldo Inicial:</label>
	        <span id="saldo_ini">_____</span>
		</div>
		<div class="col-xs-2">
	        <label for="estado_caja">Estado:</label>
	        <span id="estado_caja">Open</span>
		</div>
		<div style="float:right; margin-top: 0%; ">
			<form id="frm_pdf_main_search_invini" name="frm_pdf_main_search_invini" action="to_pdf_search_invini" target="_blank" method="post" style="float: right;">
				<input type="text" id="buscar_invini" name="buscar_invini" class="form-group icono input" placeholder="Buscar" autofocus style="width: 50%;">
				<img src="../assets/images/printer2.png" alt="Imprimir" id="imprimir-busqueda-invini" class="imagen printer">
			</form>
		</div>
		<div class="container">
		<div class="row">
			<table id="tabla_invini" class="table table-condensed table-striped resaltado cabecera">
				<thead>
					<tr>
						<th>#</th>
						<th>Tipo Operación</th>
						<th>Descripción Operación</th>
						<th>Cantidad</th>
						<th>Comprobante</th>
						<th># Serie</th>
						<th># Doc</th>
						<th>Importe $</th>
						<th>T.C.</th>
						<th>Importe Bs.</th>
					</tr>
				</thead>
				<tbody>
				
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
