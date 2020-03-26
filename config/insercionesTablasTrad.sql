
USE GESTIONMOVILIDADES;

INSERT INTO PAISES VALUES (null, 'AT', 'Austria');
INSERT INTO PAISES VALUES (null, 'BE', 'Belgium');
INSERT INTO PAISES VALUES (null, 'BG', 'Bulgaria');
INSERT INTO PAISES VALUES (null, 'HR', 'Croatia');
INSERT INTO PAISES VALUES (null, 'CY', 'Cyprus');
INSERT INTO PAISES VALUES (null, 'CZ', 'Czech Republic');
INSERT INTO PAISES VALUES (null, 'DK', 'Denmark');
INSERT INTO PAISES VALUES (null, 'EE', 'Estonia');
INSERT INTO PAISES VALUES (null, 'FI', 'Finland');
INSERT INTO PAISES VALUES (null, 'FR', 'France');
INSERT INTO PAISES VALUES (null, 'DE', 'Germany');
INSERT INTO PAISES VALUES (null, 'GR', 'Greece');
INSERT INTO PAISES VALUES (null, 'HU', 'Hungary');
INSERT INTO PAISES VALUES (null, 'IE', 'Ireland');
INSERT INTO PAISES VALUES (null, 'IT', 'Italy');
INSERT INTO PAISES VALUES (null, 'LV', 'Latvia');
INSERT INTO PAISES VALUES (null, 'LT', 'Lithuania');
INSERT INTO PAISES VALUES (null, 'LU', 'Luxembourg');
INSERT INTO PAISES VALUES (null, 'MT', 'Malta');
INSERT INTO PAISES VALUES (null, 'NL', 'Netherlands');
INSERT INTO PAISES VALUES (null, 'PL', 'Poland');
INSERT INTO PAISES VALUES (null, 'PT', 'Portugal');
INSERT INTO PAISES VALUES (null, 'RO', 'Romania');
INSERT INTO PAISES VALUES (null, 'SK', 'Slovakia');
INSERT INTO PAISES VALUES (null, 'SI', 'Slovenia');
INSERT INTO PAISES VALUES (null, 'ES', 'Spain');
INSERT INTO PAISES VALUES (null, 'SE', 'Sweden');
-- 

INSERT INTO ROL_USUARIOS  (tipo,descripcion) VALUES ('ADMIN','User with administration permissions, user changing roles, register specialties and institution or companies types.');
INSERT INTO ROL_USUARIOS (tipo,descripcion) VALUES('REGISTERED','User who can register students, companies, institutions and generate mobilities.');
INSERT INTO ROL_USUARIOS (tipo,descripcion) VALUES('ANONYMOUS','Not registered user that can only look for simple searches.');
-- 
INSERT INTO TIPOS_PUNTUACION(TIPO,DESCRIPCION,VALOR) VALUES('DEFICIT','Minimun score a partner can have on his own.',-30);
INSERT INTO TIPOS_PUNTUACION(TIPO,DESCRIPCION,VALOR) VALUES('REGISTER','Default score when an account is registered.',10);
INSERT INTO TIPOS_PUNTUACION(TIPO,DESCRIPCION,VALOR) VALUES('COMPANY REGISTER','Score given to a partner when register a company.',20);
INSERT INTO TIPOS_PUNTUACION(TIPO,DESCRIPCION,VALOR) VALUES('STUDENT ACCOMMODATION','Score given to a partner when he manages the student accommodation.',15);
INSERT INTO TIPOS_PUNTUACION(TIPO,DESCRIPCION,VALOR) VALUES('MOBILITY','Score removed from a partner when a mobility its done.',-20);
-- 
INSERT INTO ESTADOS (ESTADO,DESCRIPCION) VALUES('REQUESTED','Request send but it hasnt been revised by the partner in question.');
INSERT INTO ESTADOS (ESTADO,DESCRIPCION) VALUES('IN PROCCESS','Accepted request and been processed.');
INSERT INTO ESTADOS (ESTADO,DESCRIPCION) VALUES('SOLVED','Request checked and solved by the partner in question.');
INSERT INTO ESTADOS (ESTADO,DESCRIPCION) VALUES('CANCELED','Request canceled by the partner in question.');
INSERT INTO ESTADOS (ESTADO,DESCRIPCION) VALUES('DECLINED','Request declined by the partner in question.');


INSERT INTO TIPOS_INSTITUCION (TIPO,DESCRIPCION) VALUES('VS','Vocational Studies Center');
INSERT INTO TIPOS_INSTITUCION (TIPO,DESCRIPCION) VALUES('Higher Education','Institute of Higher Education');
INSERT INTO TIPOS_INSTITUCION (TIPO,DESCRIPCION) VALUES('University','University');

INSERT INTO TIPOS_EMPRESA (TIPO,DESCRIPCION) VALUES('PLC','Public Limited Company');
INSERT INTO TIPOS_EMPRESA (TIPO,DESCRIPCION) VALUES('LTD','Private Limited Company');
INSERT INTO TIPOS_EMPRESA (TIPO,DESCRIPCION) VALUES('ST','Solid Trader');


INSERT INTO SOCIOS (PASSWORD,USUARIO,NOMBRE_COMPLETO,EMAIL,TELEFONO,FECHA_ALTA,FECHA_MOD,CARGO,DEPARTAMENTO,R_ALOJAMIENTO,PUNTUACION,ROL,INSTITUCION,PAIS) 
VALUES ('$2y$10$..s5jkdivf15k4t9a0NMiOKjuj0hIKetrRJ3jY66BCN5686wH.6UG','socio1','socio numero 1','socio1@gmail.com','11111111',now(),now(),'socio','web',1,10,2,NULL,1);

INSERT INTO SOCIOS (PASSWORD,USUARIO,NOMBRE_COMPLETO,EMAIL,TELEFONO,FECHA_ALTA,FECHA_MOD,CARGO,DEPARTAMENTO,R_ALOJAMIENTO,PUNTUACION,ROL,INSTITUCION,PAIS) 
VALUES ('$2y$10$..s5jkdivf15k4t9a0NMiOKjuj0hIKetrRJ3jY66BCN5686wH.6UG','socio2','socio numero 2','socio2@gmail.com','11111111',now(),now(),'socio','web',1,10,2,NULL,1);

INSERT INTO SOCIOS (PASSWORD,USUARIO,NOMBRE_COMPLETO,EMAIL,TELEFONO,FECHA_ALTA,FECHA_MOD,CARGO,DEPARTAMENTO,R_ALOJAMIENTO,PUNTUACION,ROL,INSTITUCION,PAIS) 
VALUES ('$2y$10$..s5jkdivf15k4t9a0NMiOKjuj0hIKetrRJ3jY66BCN5686wH.6UG','socio3','socio numero 3','socio3@gmail.com','11111111',now(),now(),'socio','web',1,10,2,NULL,1);

INSERT INTO SOCIOS (PASSWORD,USUARIO,NOMBRE_COMPLETO,EMAIL,TELEFONO,FECHA_ALTA,FECHA_MOD,CARGO,DEPARTAMENTO,R_ALOJAMIENTO,PUNTUACION,ROL,INSTITUCION,PAIS) 
VALUES ('$2y$10$..s5jkdivf15k4t9a0NMiOKjuj0hIKetrRJ3jY66BCN5686wH.6UG','admin','administrador','admin@gmail.com','11111111',now(),now(),'admin','web',1,10,1,NULL,1);


INSERT INTO INSTITUCIONES( NOMBRE, EMAIL, TELEFONO, CODIGO_POSTAL, DIRECCION, WEB, FECHA_ALTA, FECHA_MOD, PAIS, SOCIO, TIPO, DESCRIPCION) 
VALUES ('institucion1','institucion1@gmail.com','111111111','36883','Vigo','institucion1.com',now(),now(),1,1,1,'institucion numero 1');

INSERT INTO INSTITUCIONES( NOMBRE, EMAIL, TELEFONO, CODIGO_POSTAL, DIRECCION, WEB, FECHA_ALTA, FECHA_MOD, PAIS, SOCIO, TIPO, DESCRIPCION) 
VALUES ('institucion2','institucion2@gmail.com','111111111','36883','Vigo','institucion2.com',now(),now(),1,2,1,'institucion numero 2');

INSERT INTO INSTITUCIONES( NOMBRE, EMAIL, TELEFONO, CODIGO_POSTAL, DIRECCION, WEB, FECHA_ALTA, FECHA_MOD, PAIS, SOCIO, TIPO, DESCRIPCION) 
VALUES ('institucion3','institucion3@gmail.com','111111111','36883','Vigo','institucion3.com',now(),now(),1,3,1,'institucion numero 3');

INSERT INTO INSTITUCIONES( NOMBRE, EMAIL, TELEFONO, CODIGO_POSTAL, DIRECCION, WEB, FECHA_ALTA, FECHA_MOD, PAIS, SOCIO, TIPO, DESCRIPCION) 
VALUES ('institucion_admin','institucion_admin@gmail.com','111111111','36883','Vigo','institucion_admin.com',now(),now(),1,4,1,'institucion del admin');

update SOCIOS set institucion=1 where id_socio=1;
update SOCIOS set institucion=2 where id_socio=2;
update SOCIOS set institucion=3 where id_socio=3;
update SOCIOS set institucion=4 where id_socio=4;



INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ('Web Development');
INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ('App Development');
INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ('IT Administration');
INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ('SMR Administration');
INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ('Stylist and Beauty');
INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ('Big Data');
INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ("Hairdresser's");
INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ('Lawyer');
INSERT INTO TIPOS_ESPECIALIDAD (TIPO) VALUES ('History');




















