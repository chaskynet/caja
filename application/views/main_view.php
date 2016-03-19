<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
	
	<!-- <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> -->
	<title>Caja - Main</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/js/jquery-ui-1.11.4/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/calendario.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/estilos.css">
	<!-- <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico"> -->
	

</head>
<body>

	<!-- Ventana para busqueda de articulos-->
	<div id="modal_añadir_articulos" class="modal fade" >
	  <div class="modal-dialog caja">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <div class="col-xs-10 input-group">
				  <span class="input-group-addon"><strong>Articulo a buscar: </strong> </span>
				  <input type="text" class="form-control" id="articulo_buscar" autofocus>
				</div>
	      </div>
	      <div class="modal-body ventana_modal" id="modal_content_busqueda">
	      	
	        <table class="table table-hover" id="tabla_articulos">
				<thead>
				<tr>
					<th>Cod. Articulo</th>
					<th>Descripción</th>
					<th>Procedencia</th>
					<th>Saldo</th>
				</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
	      </div>
	      <div class="modal-footer">
	      	<button id="cargar" class="btn btn-primary flotar-izquierda">Cargar Articulos</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Fin ventana Busqueda de Articulos -->

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<a href="#" class="navbar-brand" id="home">Caja</a>
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav navbar-nav navbar-right">
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Manejo de Caja <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#" id="movimientos_caja">Movimientos de Caja</a></li>
							<li><a href="#" id="reportes_caja">Reportes</a></li>
						</ul>
					</li>
					<!-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <b class="caret"></b></a>
						<ul class="dropdown-menu">
						</ul>
					</li> -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Configuraciones <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#" id="creacion-usuarios">Creación de usuarios</a></li>
						</ul>
					</li>
					<li><a href="logout">Salir</a></li>
					<li><a href="#">Usuario: <?php echo $this->session->userdata('usuario'); ?></a></li>

				</ul>
			</div>
		</div>
	</div>	
	<div class="container">
		<div id="contenido" class="row">
			
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.12.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/calendar/calendar.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/calendar/calendar-es.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/calendar/calendar-setup.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/css/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/AjaxFileUploader/ajaxfileupload.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/caja.js"></script>
</body>
</html>