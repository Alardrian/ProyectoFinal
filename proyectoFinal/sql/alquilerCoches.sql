
DROP DATABASE IF EXISTS alquiler_de_coches;
CREATE DATABASE alquiler_de_coches;

USE alquiler_de_coches;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50),
    clave VARCHAR(400),
    perfil VARCHAR(50)
);

CREATE TABLE cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    nombre VARCHAR(200),
    email VARCHAR(200),
    fecha_de_nacimiento DATE,
    numero_de_telefono VARCHAR(20),
    direccion VARCHAR(100),
    tarjeta_credito VARCHAR(500),
    caducidad_tarjeta VARCHAR(500),
    pin_tarjeta VARCHAR(500),
    FOREIGN KEY (id_usuario)
        REFERENCES usuario (id_usuario)
);

CREATE TABLE tipo_de_vehiculo (
    id_tipo_de_vehiculo INT PRIMARY KEY,
    tipo_de_vehiculo VARCHAR(50)
);

CREATE TABLE vehiculo (
    id_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    id_tipo_de_vehiculo INT,
    marca VARCHAR(50),
    modelo VARCHAR(50),
    anio INT,
    capacidad INT,
    precio_dia DECIMAL(10 , 2 ),
    FOREIGN KEY (id_tipo_de_vehiculo)
        REFERENCES tipo_de_vehiculo (id_tipo_de_vehiculo)
);


CREATE TABLE reserva (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    id_vehiculo INT,
    fecha_de_inicio DATE,
    fecha_de_fin DATE,
    costo_diario DECIMAL(10 , 2 ),
    FOREIGN KEY (id_cliente)
        REFERENCES cliente (id_cliente),
    FOREIGN KEY (id_vehiculo)
        REFERENCES vehiculo (id_vehiculo)
);
	
CREATE TABLE seguro (
    id_seguro INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT,
    tipo_seguro VARCHAR(50),
    costo_total DECIMAL(10 , 2 ),
    fecha_de_inicio DATE,
    fecha_de_fin DATE,
    FOREIGN KEY (id_reserva)
        REFERENCES reserva (id_reserva)
);

CREATE TABLE factura (
    id_factura INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT,
    fecha_de_emision DATE,
    subtotal DECIMAL(10 , 2 ),
    impuestos DECIMAL(10 , 2 ),
    total DECIMAL(10 , 2 ),
    FOREIGN KEY (id_reserva)
        REFERENCES reserva (id_reserva)
);

CREATE TABLE listado_danyos_vehiculo (
    id_listado INT PRIMARY KEY,
    id_vehiculo INT,
    descripcion_danyo VARCHAR(500),
    posicion_danyo VARCHAR(500),
	medida VARCHAR(50),
    FOREIGN KEY (id_vehiculo)
        REFERENCES vehiculo (id_vehiculo)
);


-- inserts

INSERT INTO tipo_de_vehiculo VALUES(1, "compacto");
INSERT INTO tipo_de_vehiculo VALUES(2, "SUV");
INSERT INTO tipo_de_vehiculo VALUES(3, "Furgo");
INSERT INTO vehiculo(id_tipo_de_vehiculo,marca,modelo,anio,capacidad,precio_dia) VALUES (1, "prueba", "modeloprueba", 1998, 5, 50);
INSERT INTO vehiculo(id_tipo_de_vehiculo,marca,modelo,anio,capacidad,precio_dia) VALUES (1, "prueba2", "modeloprueba", 1998, 5, 50);
INSERT INTO vehiculo(id_tipo_de_vehiculo,marca,modelo,anio,capacidad,precio_dia) VALUES (1, "prueba3", "modeloprueba", 1998, 5, 50);
INSERT INTO vehiculo(id_tipo_de_vehiculo,marca,modelo,anio,capacidad,precio_dia) VALUES (2, "prueba4", "modeloprueba", 1998, 5, 50);