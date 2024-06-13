2-- Crear la base de datos
CREATE DATABASE colegio;

USE colegio;

-- Tabla de usuarios (administradores y contables)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL, -- Almacenar contraseñas hasheadas
    rol ENUM('administrador', 'contable') NOT NULL
);

-- Tabla de estudiantes
CREATE TABLE estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE,
    grado INT,
    nombre_tutor VARCHAR(255),
    telefono_tutor VARCHAR(20),
    email_tutor VARCHAR(255)
);

-- Tabla de facturas
CREATE TABLE facturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_estudiante INT,
    fecha_emision DATE NOT NULL,
    monto_total DECIMAL(10, 2) NOT NULL,
    estado ENUM('pendiente', 'pagada', 'vencida') NOT NULL,
    FOREIGN KEY (id_estudiante) REFERENCES estudiantes(id)
);

-- Tabla de pagos
CREATE TABLE pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_factura INT,
    fecha_pago DATE NOT NULL,
    monto_pagado DECIMAL(10, 2) NOT NULL,
    metodo_pago ENUM('efectivo', 'tarjeta', 'transferencia') NOT NULL,
    FOREIGN KEY (id_factura) REFERENCES facturas(id)
);

-- Tabla de conceptos de factura (opcional)
CREATE TABLE conceptos_factura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_factura INT,
    descripcion VARCHAR(255) NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_factura) REFERENCES facturas(id)
);

-- Tabla de cortes contables (cierre de caja)
CREATE TABLE cortes_contables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    monto_inicial DECIMAL(10, 2) NOT NULL,
    monto_final DECIMAL(10, 2) NOT NULL,
    observaciones TEXT
);
