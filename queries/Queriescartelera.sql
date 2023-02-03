DROP TABLE IF EXISTS T_Ficha;
DROP TABLE IF EXISTS T_Peliculas;
DROP TABLE IF EXISTS T_Categorias;


CREATE TABLE IF NOT EXISTS T_Categorias (
    ID INT NOT NULL,
    nombre VARCHAR(200),
    imagen VARCHAR(200),
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS T_Peliculas (
    ID INT NOT NULL,
    titulo VARCHAR(200) DEFAULT NULL,
    año INT DEFAULT NULL,
    duracion INT DEFAULT NULL,
    sinopsis VARCHAR(500) DEFAULT NULL,
    imagen VARCHAR(100) DEFAULT NULL,
    votos INT DEFAULT 0,
    id_categoria INT DEFAULT NULL,
    PRIMARY KEY (ID),
    CONSTRAINT T_Peliculas_ibfk_1 FOREIGN KEY (id_categoria)
        REFERENCES T_Categorias (ID)
);

CREATE TABLE IF NOT EXISTS T_Ficha (
    ID INT NOT NULL,
    titulo VARCHAR(200) DEFAULT NULL,
    año INT DEFAULT NULL,
    directores VARCHAR(200) DEFAULT NULL,
    reparto VARCHAR(500) DEFAULT NULL,
    sinopsis VARCHAR(1000) DEFAULT NULL,
    imagen VARCHAR(100) DEFAULT NULL,
    votos INT DEFAULT 0,
    PRIMARY KEY (ID),
    CONSTRAINT T_Ficha_ibfk_1 FOREIGN KEY (ID)
        REFERENCES T_Peliculas (ID)
);

-- id titulo año duracion sinopsis imagen votos, id_categoria

INSERT INTO T_Categorias VALUES (1,"Terror","img/peniwais.jpg");
INSERT INTO T_Categorias VALUES (2,"Star Wars","img/starwarscartelera.jpeg");

INSERT INTO T_Peliculas VALUES (1,"It",2017,135, "Varios niños de una pequeña ciudad del estado de Maine se alían para combatir a una entidad
 diabólica que adopta la forma de un payaso y desde hace mucho tiempo emerge cada 27 años para saciarse de sangre infantil.","img/peniwais.jpg",0,1);
 
 INSERT INTO T_Peliculas VALUES (2,"Halloween Ends",2022,115, "Cuatro años después de la desaparición de Michael Myers, el joven Corey lo encuentra maltrecho en las alcantarillas. Poco a poco,
 se establece un extraño vínculo entre estos dos personajes unidos por la venganza y la locura.","img/myers.jpg",0,1);
 
 INSERT INTO T_Peliculas VALUES (3,"Texas Chainsaw Massacre",2022,83, "Un grupo de jóvenes idealistas viajan al remoto pueblo de Harlow, Texas, para montar un negocio. Pero su sueño se convierte en
 una auténtica pesadilla cuando molestan sin querer a Leatherface, el desquiciado asesino en serie.","img/texas.jpg",0,1);
 
 INSERT INTO T_Peliculas VALUES (4,"Saw",2004,135, "Adam y Lawrence despiertan encadenados con un cadáver. Su secuestrador es un loco conocido
 como Jigsaw cuyo juego consiste en forzar a herirse a si mismos o a otros con tal de permanecer vivos.","img/saw.jpg",0,1);
 
 INSERT INTO T_Peliculas VALUES (5,"Viernes 13",2009,95, "Un grupo de jóvenes visita el desahuciado campamento de Crystal Lake, donde tuvieron lugar varios
 monstruosos asesinatos hace más de dos décadas. Allí son brutalmente atacados por Jason, el temido asesino.","img/jason2.jpg",0,1);
 
  INSERT INTO T_Peliculas VALUES (6,"Star Wars: Episodio I - La amenaza fantasma",1999,136, "La República Galáctica está sumida en el caos. Los impuestos de las rutas comerciales a los sistemas estelares exteriores
 están en disputa. Esperando resolver el asunto con un bloqueo de poderosas naves de guerra.","img/starwars1.jpg",0,2);
 
 INSERT INTO T_Peliculas VALUES (7,"Star Wars: Episodio II - El ataque de los clones",2002,142, "En el Senado Galáctico reina la inquietud. Miles de sistemas solares han declarado su intención de abandonar la República. Este movimiento separatista ha provocado que a 
 los caballeros Jedi les resulte difícil mantener la paz.","img/starwars2.jpg",0,2);
 
 INSERT INTO T_Peliculas VALUES (8,"Star Wars: Episodio III - La venganza de los Sith",2005,140, "¡Guerra! La República se desmorona bajo los ataques del despiadado Lord Sith,
 el conde Dooku. Hay héroes en ambos bandos, pero el mal está por doquier y hay que detenerlo.","img/starwars3.jpg",0,2);
 
 INSERT INTO T_Peliculas VALUES (9,"Star Wars: Episodio IV - Una nueva esperanza",1977,95, "La nave en la que viaja la princesa Leia es capturada por las tropas imperiales. Antes de ser atrapada, Leia consigue introducir 
 un mensaje en su robot R2-D2, quien acompañado de C-3PO logran escapar.","img/starwars4.jpg",0,2);
 
 INSERT INTO T_Peliculas VALUES (10,"Star Wars: Episodio V - El Imperio contraataca",1980,124, "Son tiempos adversos para la rebelión. Aunque la Estrella de la Muerte ha sido destruida, las tropas imperiales han hecho salir a las fuerzas 
 rebeldes de sus bases ocultas y los persiguen a través de la galaxia.","img/starwars5.jpg",0,2);
 

 select * from T_peliculas;






