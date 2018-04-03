<?php
require 'init.php';

class Funciones{
	public function getProductos(){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM productos");
		$query->execute();

		return $query->fetchAll();
	}

	public function agregarCarrito($cantidad, $producto_id, $session){
		global $pdo;

		$query = $pdo->prepare("INSERT INTO carrito (sesion_id,producto_id, cantidad)
								VALUES(:sesion_id,:producto_id, :cantidad)");
		$query->execute([
			'sesion_id' => $session,
			'producto_id' => $producto_id,
			'cantidad' => $cantidad
		]);

		return 'true';
	}

	public function actualizarCarrito($cantidad, $producto_id, $session_id){
		global $pdo;

		$query = $pdo->prepare("UPDATE carrito
								SET cantidad = :cantidad
								WHERE producto_id = :producto_id AND sesion_id = :sesion_id");
		
		$query->execute([
			'sesion_id' => $session_id,
			'producto_id' => $producto_id,
			'cantidad' => $cantidad
		]);

		return 'true';

	}


	public function obtenerCarrito($sesion_id){
		global $pdo;
		$query = $pdo->prepare("SELECT carrito.*, productos.* 
								FROM carrito
								INNER JOIN productos
								ON carrito.producto_id = productos.producto_id
								WHERE sesion_id = :sesion_id"
							);

		$query->execute([
			'sesion_id' => $sesion_id
		]);
		return $query->fetchAll();
	}

}