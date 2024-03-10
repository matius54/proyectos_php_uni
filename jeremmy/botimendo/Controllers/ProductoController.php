<?php
//require_once "../Models/ProductoModel.php";
class ProductoController
{

    public function registrar()
    {
        $nombre = $_POST['name'];
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['description'];
        $tipo = $_POST['type'];
        $cantidad = $_POST['stock'];
        $precio = $_POST['price'];

        if (empty($nombre) || empty($codigo) || empty($descripcion) || empty($tipo) || empty($cantidad) || empty($precio)) {
            echo "<h1>Por favor llenar los campos</h1>";
        } else {
            try {
                include "../Models/ProductoModel.php";
                $pm = new ProductoModel;
                $pm->insertarProduct($nombre, $codigo, $precio, $descripcion, $tipo, $cantidad);
            } catch (PDOException $e) {
                die("Ocurrio un error. INFO: " . $e->getMessage());
            }

            header("location: ../Views/inventary/index.php");
        }
    }
    public function modificar($id_producto)
    {
    }
    public function eliminar($id_producto)
    {
    }
}

$producto = new ProductoController;
$producto->registrar();
