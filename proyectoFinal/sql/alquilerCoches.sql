
DROP DATABASE IF EXISTS alquiler_de_coches;
CREATE DATABASE alquiler_de_coches;

USE alquiler_de_coches;

CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY,
    nombre VARCHAR(50),
    correo_electronico VARCHAR(50),
    contrasena VARCHAR(50)
);

CREATE TABLE cliente (
    id_cliente INT PRIMARY KEY,
    id_usuario INT,
    fecha_de_nacimiento DATE,
    numero_de_telefono VARCHAR(20),
    direccion VARCHAR(100),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

CREATE TABLE tipo_de_vehiculo (
    id_tipo_de_vehiculo INT PRIMARY KEY,
    tipo_de_vehiculo VARCHAR(50)
);

CREATE TABLE vehiculo (
    id_vehiculo INT PRIMARY KEY,
    id_tipo_de_vehiculo INT,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    anio INT,
    capacidad INT,
    transmision VARCHAR(20),
    precio_por_dia DECIMAL(10,2),
    FOREIGN KEY (id_tipo_de_vehiculo) REFERENCES tipo_de_vehiculo(id_tipo_de_vehiculo)
);

CREATE TABLE reserva (
    id_reserva INT PRIMARY KEY,
    id_cliente INT,
    id_vehiculo INT,
    fecha_de_inicio DATE,
    fecha_de_fin DATE,
    costo_total DECIMAL(10,2),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculo(id_vehiculo)
);

CREATE TABLE factura (
    id_factura INT PRIMARY KEY,
    id_reserva INT,
    fecha_de_emision DATE,
    subtotal DECIMAL(10,2),
    impuestos DECIMAL(10,2),
    total DECIMAL(10,2),
    FOREIGN KEY (id_reserva) REFERENCES reserva(id_reserva)
);

CREATE TABLE tipo_de_cliente (
    id_tipo_de_cliente INT PRIMARY KEY,
    tipo_de_cliente VARCHAR(50),
    id_cliente INT,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

CREATE TABLE vip (
    id_vip INT PRIMARY KEY,
    id_cliente INT,
    rebaja INT(20),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);