
DROP DATABASE IF EXISTS alquiler_de_coches;
CREATE DATABASE alquiler_de_coches;

USE alquiler_de_coches;

CREATE TABLE cliente (
    id_cliente INT PRIMARY KEY,
    usuario VARCHAR(50),
    correo_electronico VARCHAR(50),
    contrasenya VARCHAR(50),
    fecha_de_nacimiento DATE,
    numero_de_telefono VARCHAR(20),
    direccion VARCHAR(100)
);

CREATE TABLE tipo_de_cliente (
    id_tipo_de_cliente INT PRIMARY KEY,
    tipo_de_cliente VARCHAR(50),
    id_cliente INT,
    FOREIGN KEY (id_cliente)
        REFERENCES cliente (id_cliente)
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
    anyo INT,
    capacidad INT,
    FOREIGN KEY (id_tipo_de_vehiculo)
        REFERENCES tipo_de_vehiculo (id_tipo_de_vehiculo)
);
		
CREATE TABLE listado_danyos (
    id_listado INT PRIMARY KEY,
    id_vehiculo INT,
    tipo_danyo VARCHAR(50),
    descripcion VARCHAR(1000),
    longitud VARCHAR(50),
    FOREIGN KEY (id_vehiculo)
        REFERENCES vehiculo (id_vehiculo)
);

CREATE TABLE reserva (
    id_reserva INT PRIMARY KEY,
    id_cliente INT,
    id_vehiculo INT,
    fecha_de_inicio DATE,
    fecha_de_fin DATE,
    costo_total DECIMAL(10 , 2 ),
    precio_por_dia DECIMAL(10 , 2 ),
    FOREIGN KEY (id_cliente)
        REFERENCES cliente (id_cliente),
    FOREIGN KEY (id_vehiculo)
        REFERENCES vehiculo (id_vehiculo)
);

CREATE TABLE seguro (
    id_seguro INT PRIMARY KEY,
    id_reserva INT,
    tipo_seguro VARCHAR(50),
    fecha_de_inicio DATE,
    fecha_de_fin DATE,
    FOREIGN KEY (id_reserva)
        REFERENCES reserva (id_reserva)
);

CREATE TABLE factura (
    id_factura INT PRIMARY KEY,
    id_reserva INT,
    fecha_de_emision DATE,
    subtotal DECIMAL(10 , 2 ),
    impuestos DECIMAL(10 , 2 ),
    total DECIMAL(10 , 2 ),
    FOREIGN KEY (id_reserva)
        REFERENCES reserva (id_reserva)
);
