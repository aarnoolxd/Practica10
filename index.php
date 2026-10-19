<?php
// Incluye la estructura HTML inicial y los estilos compartidos por las páginas.
include 'estilo.php';
?>

<!-- Encabezado de la pantalla de registro de lotes de exportación. -->
<h2>Registrar nuevo lote de exportación</h2>

<!-- Formulario que envía los datos del nuevo lote al archivo registrar.php. -->
<form method="post" action="registrar.php" class="border p-4 bg-white rounded mb-4">
    <div class="mb-3">
        <!-- Permite seleccionar uno de los productos agrícolas disponibles. -->
        <label class="form-label">Nombre del producto:</label>
        <select name="producto" class="form-select" required>
            <option value="">Seleccione un producto</option>
            <option value="Quinua">Quinua</option>
            <option value="Maíz morado">Maíz morado</option>
            <option value="Papa nativa">Papa nativa</option>
            <option value="Tarwi">Tarwi</option>
        </select>
    </div>
    <div class="mb-3">
        <!-- Captura la cantidad exportada en kilogramos, con valores decimales. -->
        <label class="form-label">Cantidad exportada (en kilos):</label>
        <input type="number" name="cantidad" min="1" step="0.1" class="form-control" required>
    </div>
    <div class="mb-3">
        <!-- Captura el precio correspondiente a cada kilogramo exportado. -->
        <label class="form-label">Precio por kilo:</label>
        <input type="number" name="precio" min="0" step="0.1" class="form-control" required>
    </div>
    <div class="mb-3">
        <!-- Permite seleccionar el país al que se enviará el lote. -->
        <label class="form-label">País de destino:</label>
        <select name="pais" class="form-select" required>
            <option value="">Seleccione un país</option>
            <option value="EE.UU.">EE.UU.</option>
            <option value="Alemania">Alemania</option>
            <option value="España">España</option>
            <option value="Canadá">Canadá</option>
            <option value="Japón">Japón</option>
        </select>
    </div>
    <!-- Envía el formulario para guardar el lote en el archivo de datos. -->
    <button type="submit" class="btn btn-primary">Guardar lote</button>
</form>

<!-- Enlace a la página que muestra los lotes registrados y sus totales. -->
<a href="reporte.php" class="btn btn-outline-secondary">Ver Reporte</a>

<?php
// Cierra los elementos HTML abiertos por la plantilla estilo.php.
echo "</div></body></html>";
?>
