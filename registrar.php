<?php
// Verifica que el formulario haya enviado todos los campos requeridos.
if (isset($_POST['producto'], $_POST['cantidad'], $_POST['precio'], $_POST['pais'])) {
    // Limpia los textos y convierte los valores numéricos antes de crear la línea.
    $linea = trim($_POST['producto']) . "," . floatval($_POST['cantidad']) . "," . floatval($_POST['precio']) . "," . trim($_POST['pais']) . "\n";

    // Agrega el nuevo lote al final del archivo sin borrar los registros existentes.
    file_put_contents('exportaciones.txt', $linea, FILE_APPEND);
}

// Regresa al reporte para que el usuario pueda consultar el lote guardado.
header("Location: reporte.php");

// Detiene la ejecución después de enviar la redirección.
exit;
