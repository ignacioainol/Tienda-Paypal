<? require_once 'Funciones.php';
	$obj = new Funciones();

	//Obtener productos de mi carrito
	$productos = $obj->obtenerCarrito('ddb07bb7ec1e6d394e3fa54c0627753b');

	$suma = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Carrito de Compras</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/main.css">
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
	      <li class="nav-item">
	        <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Mi Carrito</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	<!--[/NAVBAR]-->

	<div class="container mainContent">
		<h2>Mi Carrito de Compras</h2>
		<div class="row">
			<table class="table table-striped">
				<tr>
					<th>Nombre</th>
					<th>Cantidad</th>
					<th></th>
					<th>Precio Unitario</th>
					<th>Total</th>
				</tr>
				<? foreach ($productos as $index => $producto): ?>
					<tr>
						<td><?= $producto['nombre'] ?></td>
						<td><input type="number" name="cantidad" value="<?= $producto['cantidad'] ?>" class="form-control" id="txtCambiarCantidad<?= $producto['producto_id'] ?>"></td>
						<td><button class="btn btn-info btnCambiarCantidad" data-productoId="<?= $producto['producto_id'] ?>">Actualizar</button></td>
						<td><?= $producto['precio'] ?></td>
						<td><?= $producto['cantidad'] * $producto['precio'] ?></td>
					</tr>
					<? $suma += $producto['cantidad'] * $producto['precio'] ?>
				<? endforeach ?>
				<tr>
					<th>Total</th>
					<td></td>
					<td></td>
					<td></td>
					<td><?= $suma ?></td>
				</tr>
			</table>
		</div>
		<div class="btn btn-warning float-right">Pagar</div>
	</div>


	<!--[SCRIPTS]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			$(".btnCambiarCantidad").on('click',function(){
				var producto_id = $(this).attr('data-productoId');
				var cantidad = $("#txtCambiarCantidad" + producto_id).val();

				console.log(producto_id);
				console.log(cantidad);

				$.ajax({
					type: "POST",
					data: {
						cantidad: cantidad,
						producto_id: producto_id
					},
					url: "actualizar_carrito.php",
					success: function(data){
						alert(data);
						window.location.href="carrito.php";
					},
					error: function(e){
						alert("Error...");
					}
				});
			});
		});
	</script>
</body>