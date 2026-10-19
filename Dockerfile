# Imagen ligera con PHP y el servidor web integrado.
FROM php:8.2-cli

# Directorio público de la aplicación.
WORKDIR /var/www/html

# Copia los archivos PHP y el archivo inicial de datos al contenedor.
COPY . .

# Puerto usado localmente y como referencia para proveedores como Render.
EXPOSE 10000

# Render proporciona PORT; localmente se usará 10000 como valor predeterminado.
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-10000} -t /var/www/html"]
