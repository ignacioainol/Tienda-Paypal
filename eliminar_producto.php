<?php

require 'Funciones.php';
$obj = new Funciones();

$obj->eliminarProducto($_POST['producto_id'], session_id());

echo "true";