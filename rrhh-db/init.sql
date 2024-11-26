-- Crear la base de datos phpmyadmin
CREATE DATABASE IF NOT EXISTS phpmyadmin;

-- Crear las tablas necesarias para phpMyAdmin
USE phpmyadmin;

-- El esquema requerido por phpMyAdmin
CREATE TABLE IF NOT EXISTS pma__bookmark (
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    dbase varchar(255) NOT NULL DEFAULT '',
    user varchar(255) NOT NULL DEFAULT '',
    label varchar(255) NOT NULL DEFAULT '',
    query text NOT NULL,
    PRIMARY KEY (id)
);
-- Agrega aquí más tablas según el esquema necesario (o usa create_tables.sql completo)
-- Para obtener el esquema completo, consulta el archivo create_tables.sql en el repositorio de phpMyAdmin.
