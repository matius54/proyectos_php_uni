<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario_6</title>
</head>
<body> 
    <form action="subida.php" method="post" enctype="multipart/form-data" target="_blank">
        <input type="file" name="archivo" id="archivo"> <br>
        <input type="submit" value="cargar imagen" name="submit" onclick="abrirpestaña">
    </form>
    
</body>
</html>
<script>
function abrirpestaña() {
  // URL de la página que quieres abrir en la nueva pestaña
  const url = "subida.php";

  // Abrir la URL en una nueva pestaña
  window.open(url, "_blank");
}
</script>