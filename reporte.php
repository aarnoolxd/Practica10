<?php
// Incluye la estructura HTML inicial y los estilos comunes del sitio.
include 'estilo.php';
?>

<!-- Título de la página que presenta la información almacenada. -->
<h2 class="mb-4">Reporte de Exportaciones</h2>
<?php
// Inicializa la colección que contendrá los lotes leídos desde el archivo.
$lotes = [];

// Define el archivo de texto donde se almacenan los registros de exportación.
$archivo = 'exportaciones.txt';

// Solo intenta leer el archivo si existe en el servidor.
if (file_exists($archivo)) {
    // Lee cada registro sin conservar los saltos de línea.
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES);

    // Convierte cada línea separada por comas en un arreglo estructurado.
    foreach ($lineas as $linea) {
        list($producto, $cantidad, $precio, $pais) = explode(",", $linea);
        $lotes[] = [
            // Conserva el nombre del producto y del país como texto.
            "producto" => $producto,

            // Convierte cantidad y precio a números para poder hacer cálculos.
            "cantidad" => floatval($cantidad),
            "precio" => floatval($precio),
            "pais" => $pais
        ];
    }
}

// Inicializa los acumuladores usados en los indicadores del reporte.
$total_acumulado = 0;
$alta_exportacion = 0;
$destinos_especiales = 0;
?>

<!-- Tabla principal con el detalle y la clasificación de cada lote. -->
<table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Cantidad (kg)</th>
            <th>Precio por kilo</th>
            <th>Total</th>
            <th>País</th>
            <th>Alta Exportación</th>
            <th>Destino Especial</th>
        </tr>
    </thead>
    <tbody>
        <!-- Procesa y muestra cada lote almacenado. -->
        <?php foreach ($lotes as $l): 
            // Calcula el valor total del lote y lo suma al acumulado general.
            $total_lote = $l["cantidad"] * $l["precio"];
            $total_acumulado += $total_lote;

            // Clasifica como alta exportación los lotes que superan 1000 kg.
            if ($l["cantidad"] > 1000) {
                $alta = "Sí";
                $color_alta = "text-success";
                $alta_exportacion++;
            } else {
                $alta = "No";
                $color_alta = "text-muted";
            }

            // Marca como destino especial a EE.UU. y Alemania.
            if ($l["pais"] == "EE.UU." || $l["pais"] == "Alemania") {
                $especial = "Sí";
                $color_esp = "text-primary";
                $destinos_especiales++;
            } else {
                $especial = "No";
                $color_esp = "text-muted";
            }
        ?>
        <!-- Presenta los datos calculados y originales del lote actual. -->
        <tr>
            <td><?php echo $l["producto"]; ?></td>
            <td><?php echo $l["cantidad"]; ?></td>
            <td>S/ <?php echo $l["precio"]; ?></td>
            <td>S/ <?php echo $total_lote; ?></td>
            <td><?php echo $l["pais"]; ?></td>
            <td class="<?php echo $color_alta; ?>"><?php echo $alta; ?></td>
            <td class="<?php echo $color_esp; ?>"><?php echo $especial; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Muestra los indicadores generales solo cuando existe al menos un lote. -->
<?php if (count($lotes) > 0): ?>
<div class="alert alert-info">
    <p><strong>Valor total exportado acumulado:</strong> S/ <?php echo round($total_acumulado, 2); ?></p>
    <p><strong>Lotes mayores a 1000 kg (alta exportación):</strong> <?php echo $alta_exportacion; ?></p>
    <p><strong>Lotes a EE.UU. o Alemania (destinos especiales):</strong> <?php echo $destinos_especiales; ?></p>
</div>
<?php else: ?>
<!-- Mensaje alternativo para indicar que todavía no hay registros. -->
<div class="alert alert-warning">Aún no se han registrado lotes de exportación.</div>
<?php endif; ?>

<!-- Permite volver al formulario y registrar un nuevo lote. -->
<a href="index.php" class="btn btn-secondary">Registrar otro lote</a>

<?php
// Cierra los elementos HTML abiertos por la plantilla estilo.php.
echo "</div></body></html>";
?>
