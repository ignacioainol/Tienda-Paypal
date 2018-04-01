<?php

require 'Funciones.php';
$obj = new Funciones();

$obj->agregarCarrito($_POST['cantidad'], $_POST['producto_id'], session_id());

echo "true";