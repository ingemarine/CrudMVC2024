CREATE TABLE productos  ( 
	prod_id       	SERIAL NOT NULL,
	prod_nombre   	VARCHAR(25),
	prod_precio   	INTEGER,
	prod_situacion	SMALLINT DEFAULT 1 NOT NULL,
	PRIMARY KEY(prod_id)
	
)
CREATE TABLE usuario(
    usu_id INT AUTO_INCREMENT PRIMARY KEY,
    usu_nombre VARCHAR(50),
    usu_catalogo INTEGER,
    usu_password VARCHAR(50),
    usu_situacion SMALLINT DEFAULT 1
);

CREATE TABLE aplicacion(
    app_id INT AUTO_INCREMENT PRIMARY KEY,
    app_nombre VARCHAR(75),
    app_situacion SMALLINT DEFAULT 1
);

CREATE TABLE rol(
    rol_id INT AUTO_INCREMENT PRIMARY KEY,
    rol_nombre VARCHAR(75),
    rol_nombre_ct VARCHAR(25),
    rol_app INTEGER,
    rol_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (rol_app) REFERENCES aplicacion(app_id)
);