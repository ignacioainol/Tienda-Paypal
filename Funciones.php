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
}