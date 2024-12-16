# Usar la imagen base de MySQL
FROM mysql:5.7

# Establecer variables de entorno
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=nombres

# Copiar scripts de inicialización si es necesario
COPY ./init.sql /docker-entrypoint-initdb.d/

# Exponer el puerto 3306
EXPOSE 3306
