CREATE TABLE productos  ( 
	prod_id       	SERIAL NOT NULL,
	prod_nombre   	VARCHAR(25),
	prod_precio   	INTEGER,
	prod_situacion	SMALLINT DEFAULT 1 NOT NULL,
	PRIMARY KEY(prod_id)
	
)
