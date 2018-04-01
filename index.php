<? require_once 'Funciones.php';
	$obj = new Funciones();

	$productos = $obj->getProductos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Carrito de Compras</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
	<!--[NAVBAR]-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Moto&Rock</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Mi Carrito</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	<!--[/NAVBAR]-->

	<div class="container">
		<h2>Productos</h2>
		<div class="row">
		<? foreach ($productos as $index => $producto): ?>
			<div class="col-lg-4">
				<h3><?= $producto['nombre'] ?></h3>
				<p><b>$<?= $producto['precio'] ?></b></p>
				<div class="btn btn-primary btnAgregarInicial" data-toggle="modal" data-target="#miModalito" data-productoId="<?= $producto['producto_id'] ?>">Agregar A Carrito</div>
			</div>
		<? endforeach ?>
		</div>
	</div>


	<!--[MODAL]-->
	<div class="modal fade" id="miModalito" tabindex="-1" role="dialog" aria-labelledby="miModalito" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Agregar al carrito</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p><b>Cantidad</b></p>
				<input type="number" name="cantidad" value="1" class="form-control txtCantidad" placeholder="Cantidad...">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary btnAgregar">Agregar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!--[/MODAL]-->

	<!--[SCRIPTS]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			$(".btnAgregarInicial").on('click',function(){
				var producto_id = $(this).attr('data-productoId');

				$(".btnAgregar").attr('data-productoId', producto_id);
			});

			$(".btnAgregar").on('click',function(){
				var cantidad = $(".txtCantidad").val().trim();
				var producto_id = $(this).attr('data-productoId');

				$.ajax({
					type: "POST",
					url: "agregar_carrito.php",
					data: {
						cantidad: cantidad,
						producto_id: producto_id
					},
					success: function(){
						alert("Agregado...");
					},
					error: function(e){
						alert("Error...");
					}
				});
			});
		});
	</script>
</body>
</html>