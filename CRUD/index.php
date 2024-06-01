<?php
/*
CRUD  con PHP - AJAX y JQuery

Archivo : index.php

Se utilizaran:
1)JQuery
2)Bootsrap
3)JS
   - twbsPagination js
   - Validator js 
   - toast js 

Las opciones que creearemos serán:
1)Agregar
2)Modificar
3)Eliminar
4)getData

Primero creearemos una base datos donde se almacenaran los 
datos, por lo que decidamos que vamos a alamacenar, en este 
caso serán articulos "X"

CREATE DATABASE php_ajax_crud;

CREATE TABLE IF NOT EXISTS `articulos_crud` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `articulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `creado` timestamp NULL DEFAULT NULL,
  `actualizado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;


*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ejemplo de CRUD 2024</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


	<script type="text/javascript">
    	 var url = "http://localhost:8000/";
  </script>
  <script src="js/item-ajax.js"></script>

</head>
<body>


	<div class="container">
		<div class="row">
		    <div class="col-lg-12 margin-tb">					
		        <div class="pull-left">
		            <h2>Ejemplo de un CRUD (PHP-Jquery-Ajax)</h2>
		        </div>
		        <div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
					  Crear Articulo
				</button>
		        </div>
		    </div>
		</div>


		<table class="table table-bordered">
			<thead>
			    <tr>
				<th>Articulo</th>
				<th>Descripcion</th>
				<th width="200px">Acciones</th>
			    </tr>
			</thead>
			<tbody>
			</tbody>
		</table>


		<ul id="pagination" class="pagination-sm"></ul>


	        <!-- Create Item Modal -->
		<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Crear articulo</h4>
		      </div>


		      <div class="modal-body">
		      		<form data-toggle="validator" action="api/create.php" method="POST">


		      			<div class="form-group">
							<label class="control-label" for="articulo">Nombre Articulo:</label>
							<input type="text" name="title" class="form-control" data-error="Por favor! Ingresa un nombre a tu articulo" required />
							<div class="help-block with-errors"></div>
						</div>


						<div class="form-group">
							<label class="control-label" for="articulo">Descripcion:</label>
							<textarea name="descripcion" class="form-control" data-error="Por favor ingresa una descripcion." required></textarea>
							<div class="help-block with-errors"></div>
						</div>


						<div class="form-group">
							<button type="submit" class="btn crud-submit btn-success">Cargar</button>
						</div>


		      		</form>


		      </div>
		    </div>


		  </div>
		</div>


		<!-- Edit Item Modal -->
		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Editar Articulo</h4>
		      </div>


		      <div class="modal-body">
		      		<form data-toggle="validator" action="api/update.php" method="put">
		      			<input type="hidden" name="id" class="edit-id">


		      			<div class="form-group">
							<label class="control-label" for="articulo">Articulo:</label>
							<input type="text" name="title" class="form-control" data-error="Por favor ingresa un nombre a tu articulo." required />
							<div class="help-block with-errors"></div>
						</div>


						<div class="form-group">
							<label class="control-label" for="articulo">Descripcion:</label>
							<textarea name="descripcion" class="form-control" data-error="Por favor! Ingresa una descripción." required></textarea>
							<div class="help-block with-errors"></div>
						</div>


						<div class="form-group">
							<button type="submit" class="btn btn-success crud-submit-edit">Guardar cambios</button>
						</div>


		      		</form>


		      </div>
		    </div>
		  </div>
		</div>


	</div>
	
</body>
</html>