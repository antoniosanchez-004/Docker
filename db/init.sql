-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS nombres;

-- Usar la base de datos
USE nombres;

-- Crear la tabla users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE
);

-- Insertar datos en la tabla users
INSERT INTO users (nombre) VALUES
('Antonio'),
('Manolo'),
('Luis'),
('Daniel'),
('Alejandro');
