CREATE DATABASE IF NOT EXISTS GESTIONMOVILIDADES;

USE GESTIONMOVILIDADES;

CREATE TABLE IF NOT EXISTS ROL_USUARIOS (
    ID_ROL INT UNSIGNED NOT NULL AUTO_INCREMENT,
    TIPO VARCHAR(45) NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    PRIMARY KEY (ID_ROL)
);

CREATE TABLE IF NOT EXISTS PAISES (
    ID_PAIS INT UNSIGNED NOT NULL AUTO_INCREMENT,
    CODIGO_PAIS CHAR(2) NOT NULL,
    NOMBRE VARCHAR(45) NOT NULL,
    PRIMARY KEY (ID_PAIS),
    UNIQUE INDEX NOMBRE_UNIQUE (NOMBRE)
);
    
 
CREATE TABLE IF NOT EXISTS ESTADOS (
    ID_ESTADO INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ESTADO VARCHAR(45) NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    PRIMARY KEY (ID_ESTADO)
);
 
 
 
CREATE TABLE IF NOT EXISTS SOCIOS (
    ID_SOCIO INT UNSIGNED NOT NULL AUTO_INCREMENT,
    VAT VARCHAR(16) NULL,
    `PASSWORD` VARCHAR(255) NOT NULL,
    USUARIO VARCHAR(45) NOT NULL,
    NOMBRE_COMPLETO VARCHAR(100) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    TELEFONO VARCHAR(20) NOT NULL,
    FECHA_ALTA DATETIME NOT NULL,
    FECHA_BAJA DATETIME NULL,
    FECHA_MOD DATETIME NULL,
    CARGO VARCHAR(45) NOT NULL,
    DEPARTAMENTO VARCHAR(45) NOT NULL,
    R_ALOJAMIENTO BIT(1) NULL,
    PUNTUACION INT(4) NULL,
    ROL INT UNSIGNED NOT NULL,
    INSTITUCION INT UNSIGNED NULL,
    PAIS INT UNSIGNED NOT NULL,
    PRIMARY KEY (ID_SOCIO),
    UNIQUE INDEX VAT_UNIQUE (VAT),
    UNIQUE INDEX EMAIL_UNIQUE (EMAIL),
    UNIQUE INDEX USUARIO_UNIQUE (USUARIO),
    INDEX FK1_ROL (ROL),
    INDEX FK1_PAIS (PAIS),
    CONSTRAINT FK1_ROL FOREIGN KEY (ROL)
        REFERENCES ROL_USUARIOS (ID_ROL)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK1_PAIS FOREIGN KEY (PAIS)
        REFERENCES PAISES (ID_PAIS)
        ON DELETE RESTRICT ON UPDATE CASCADE
);
        
CREATE TABLE IF NOT EXISTS TIPOS_INSTITUCION (
    ID_TIPO_INSTITUCION INT UNSIGNED NOT NULL AUTO_INCREMENT,
    TIPO VARCHAR(45) NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    PRIMARY KEY (ID_TIPO_INSTITUCION)
);
  
  
  
CREATE TABLE IF NOT EXISTS INSTITUCIONES (
    ID_INSTITUCION INT UNSIGNED NOT NULL AUTO_INCREMENT,
    VAT VARCHAR(45) NULL,
    NOMBRE VARCHAR(45) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    TELEFONO VARCHAR(45) NOT NULL,
    CODIGO_POSTAL CHAR(45) NOT NULL,
    DIRECCION VARCHAR(255) NOT NULL,
    WEB VARCHAR(255) NULL,
    FECHA_ALTA DATE NOT NULL,
    FECHA_BAJA DATE NULL,
    FECHA_MOD DATETIME NULL,
    PAIS INT UNSIGNED NOT NULL,
    SOCIO INT UNSIGNED NOT NULL,
    TIPO INT UNSIGNED NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    PRIMARY KEY (ID_INSTITUCION),
    INDEX FK2_PAIS (PAIS),
    INDEX FK1_SOCIO (SOCIO),
    INDEX FK1_TIPO_INSTITUCION (TIPO),
    CONSTRAINT FK2_PAIS FOREIGN KEY (PAIS)
        REFERENCES PAISES (ID_PAIS)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK1_SOCIO FOREIGN KEY (SOCIO)
        REFERENCES SOCIOS (ID_SOCIO)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK1_TIPO_INSTITUCION FOREIGN KEY (TIPO)
        REFERENCES TIPOS_INSTITUCION (ID_TIPO_INSTITUCION)
        ON DELETE RESTRICT ON UPDATE CASCADE
);
    
    

CREATE TABLE IF NOT EXISTS RESPONSABLES (
    ID_RESPONSABLE INT UNSIGNED NOT NULL AUTO_INCREMENT,
    EMAIL VARCHAR(255) NOT NULL,
    NOMBRE_COMPLETO VARCHAR(80) NOT NULL,
    TELEFONO VARCHAR(45) NULL,
    PRIMARY KEY (ID_RESPONSABLE , EMAIL),
    UNIQUE INDEX EMAIL_UNIQUE (EMAIL)
);
  
  
  
CREATE TABLE IF NOT EXISTS TIPOS_EMPRESA (
    ID_TIPO_EMPRESA INT UNSIGNED NOT NULL AUTO_INCREMENT,
    TIPO VARCHAR(45) NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    PRIMARY KEY (ID_TIPO_EMPRESA)
);
  
  
CREATE TABLE IF NOT EXISTS EMPRESAS (
    ID_EMPRESA INT UNSIGNED NOT NULL AUTO_INCREMENT,
    CARGO_RESPONSABLE VARCHAR(45) NOT NULL,
    VAT VARCHAR(45) NULL,
    NOMBRE VARCHAR(45) NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    TELEFONO VARCHAR(45) NOT NULL,
    CODIGO_POSTAL VARCHAR(45) NOT NULL,
    DIRECCION VARCHAR(255) NOT NULL,
    WEB VARCHAR(255) NULL,
    DESCRIPCION VARCHAR(255) NULL,
    FECHA_ALTA DATE NOT NULL,
    FECHA_BAJA DATE NULL,
    FECHA_MOD DATETIME NULL,
    PAIS INT UNSIGNED NOT NULL,
    SOCIO INT UNSIGNED NOT NULL,
    RESPONSABLE INT UNSIGNED NOT NULL,
    TIPO INT UNSIGNED NOT NULL,
    PRIMARY KEY (ID_EMPRESA),
    UNIQUE INDEX VAT_UNIQUE (VAT),
    INDEX FK3_PAIS (PAIS),
    INDEX FK2_SOCIO (SOCIO),
    INDEX FK1_RESPONSABLE (RESPONSABLE),
    INDEX FK1_TIPO_EMPRESA (TIPO),
    CONSTRAINT FK1_RESPOSABLE FOREIGN KEY (RESPONSABLE)
        REFERENCES RESPONSABLES (ID_RESPONSABLE)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK3_PAIS FOREIGN KEY (PAIS)
        REFERENCES PAISES (ID_PAIS)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK2_SOCIO FOREIGN KEY (SOCIO)
        REFERENCES SOCIOS (ID_SOCIO)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK1_TIPO_EMPRESA FOREIGN KEY (TIPO)
        REFERENCES TIPOS_EMPRESA (ID_TIPO_EMPRESA)
        ON DELETE RESTRICT ON UPDATE CASCADE
);
    
           
        
        
CREATE TABLE IF NOT EXISTS TIPOS_PUNTUACION (
    ID_TIPO_PUNTUACION INT UNSIGNED NOT NULL AUTO_INCREMENT,
    TIPO VARCHAR(45) NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    VALOR INT(3) NOT NULL,
    PRIMARY KEY (ID_TIPO_PUNTUACION)
);
  
  
  
CREATE TABLE IF NOT EXISTS HISTORICO_PUNTUACIONES (
    ID_PUNTUACION INT UNSIGNED NOT NULL AUTO_INCREMENT,
    FECHA DATETIME NOT NULL,
    TIPO_PUNTUACION INT UNSIGNED NOT NULL,
    SOCIO INT UNSIGNED NOT NULL,
    PRIMARY KEY (ID_PUNTUACION),
    INDEX FK1_TIPO_PUNTUACION (TIPO_PUNTUACION),
    INDEX FK3_SOCIO (SOCIO),
    CONSTRAINT FK1_TIPO_PUNTUACION FOREIGN KEY (TIPO_PUNTUACION)
        REFERENCES TIPOS_PUNTUACION (ID_TIPO_PUNTUACION)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT FK3_SOCIO FOREIGN KEY (SOCIO)
        REFERENCES SOCIOS (ID_SOCIO)
        ON DELETE CASCADE ON UPDATE CASCADE
);
    
    
    
    

  
CREATE TABLE IF NOT EXISTS HISTORICO_PETICIONES (
    ID_PETICION INT NOT NULL,
    ASUNTO VARCHAR(45) NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    FECHA DATETIME NOT NULL,
    ESTADO INT UNSIGNED NOT NULL,
    SOCIO_EMISOR INT UNSIGNED NOT NULL,
    SOCIO_RECEPTOR INT UNSIGNED NOT NULL,
    PRIMARY KEY (ID_PETICION),
    INDEX FK4_SOCIO (SOCIO_EMISOR),
    INDEX FK5_SOCIO (SOCIO_RECEPTOR),
    INDEX FK1_ESTADO (ESTADO),
    CONSTRAINT FK4_SOCIO FOREIGN KEY (SOCIO_EMISOR)
        REFERENCES SOCIOS (ID_SOCIO)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK5_SOCIO FOREIGN KEY (SOCIO_RECEPTOR)
        REFERENCES SOCIOS (ID_SOCIO)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK1_ESTADO FOREIGN KEY (ESTADO)
        REFERENCES ESTADOS (ID_ESTADO)
        ON UPDATE CASCADE ON DELETE RESTRICT
);
    
    

  
  
CREATE TABLE IF NOT EXISTS ALUMNOS (
    ID_ALUMNO INT UNSIGNED NOT NULL AUTO_INCREMENT,
    VAT VARCHAR(16) NULL,
    NOMBRE_COMPLETO VARCHAR(80) NOT NULL,
    GENERO ENUM('M', 'F', 'O') NOT NULL,
    FECHA_NACIMIENTO DATE NOT NULL,
    FECHA_ALTA DATETIME NOT NULL,
    FECHA_BAJA DATETIME NULL,
    FECHA_MOD DATETIME NULL,
    SOCIO INT UNSIGNED NOT NULL,
    PRIMARY KEY (ID_ALUMNO),
    INDEX FK6_SOCIO (SOCIO),
    UNIQUE INDEX VAT_UNIQUE (VAT),
    CONSTRAINT FK6_SOCIO FOREIGN KEY (SOCIO)
        REFERENCES SOCIOS (ID_SOCIO)
        ON DELETE RESTRICT ON UPDATE CASCADE
);
    
    
    
    
CREATE TABLE IF NOT EXISTS MOVILIDADES_EMPRESAS (
    ID_MOVILIDAD INT UNSIGNED NOT NULL AUTO_INCREMENT,
    FECHA_INICIO DATE NOT NULL,
    FECHA_FIN_ESTIMADO DATE NOT NULL,
    FECHA_FIN DATE NULL,
    FECHA_ALTA DATETIME NOT NULL,
    EMPRESA INT UNSIGNED NOT NULL,
    ALUMNO INT UNSIGNED NOT NULL,
    PRIMARY KEY (ID_MOVILIDAD),
    INDEX FK1_EMPRESA (EMPRESA),
    INDEX FK1_ALUMNO (ALUMNO),
    CONSTRAINT FK1_EMPRESA FOREIGN KEY (EMPRESA)
        REFERENCES EMPRESAS (ID_EMPRESA)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK1_ALUMNO FOREIGN KEY (ALUMNO)
        REFERENCES ALUMNOS (ID_ALUMNO)
        ON DELETE CASCADE ON UPDATE CASCADE
);
    
    
    
CREATE TABLE IF NOT EXISTS MOVILIDADES_INSTITUCIONES (
    ID_MOVILIDAD INT UNSIGNED NOT NULL AUTO_INCREMENT,
    FECHA_INICIO DATE NOT NULL,
    FECHA_FIN_ESTIMADO DATE NOT NULL,
    FECHA_FIN DATE NULL,
    FECHA_ALTA DATETIME NOT NULL,
    ALUMNO INT UNSIGNED NOT NULL,
    INSTITUCION INT UNSIGNED NOT NULL,
    PRIMARY KEY (ID_MOVILIDAD),
    INDEX FK1_INSTITUCION (INSTITUCION),
    INDEX FK2_ALUMNO (ALUMNO),
    CONSTRAINT FK1_INSTITUCION FOREIGN KEY (INSTITUCION)
        REFERENCES INSTITUCIONES (ID_INSTITUCION)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK2_ALUMNO FOREIGN KEY (ALUMNO)
        REFERENCES ALUMNOS (ID_ALUMNO)
        ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS TIPOS_ESPECIALIDAD (
    ID_ESPECIALIDAD INT UNSIGNED NOT NULL AUTO_INCREMENT,
    TIPO VARCHAR(45) NOT NULL,
    DESCRIPCION VARCHAR(255) NULL,
    PRIMARY KEY (ID_ESPECIALIDAD)
);
  
  
CREATE TABLE IF NOT EXISTS INSTITUCIONES_ESPECIALIDADES (
    ESPECIALIDAD INT UNSIGNED NOT NULL,
    INSTITUCION INT UNSIGNED NOT NULL,
    PRIMARY KEY (ESPECIALIDAD , INSTITUCION),
    INDEX FK1_ESPECIALIDAD (ESPECIALIDAD),
    INDEX FK2_INSTITUCION (INSTITUCION),
    CONSTRAINT FK1_ESPECIALIDAD FOREIGN KEY (ESPECIALIDAD)
        REFERENCES TIPOS_ESPECIALIDAD (ID_ESPECIALIDAD)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK2_INSTITUCION FOREIGN KEY (INSTITUCION)
        REFERENCES INSTITUCIONES (ID_INSTITUCION)
        ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE IF NOT EXISTS ALUMNOS_ESPECIALIDADES (
    ALUMNO INT UNSIGNED NOT NULL,
    ESPECIALIDAD INT UNSIGNED NOT NULL,
    INDEX FK3_ALUMNO (ALUMNO),
    INDEX FK2_ESPECIALIDAD (ESPECIALIDAD),
    PRIMARY KEY (ALUMNO , ESPECIALIDAD),
    CONSTRAINT FK3_ALUMNO FOREIGN KEY (ALUMNO)
        REFERENCES ALUMNOS (ID_ALUMNO)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK2_ESPECIALIDAD FOREIGN KEY (ESPECIALIDAD)
        REFERENCES TIPOS_ESPECIALIDAD (ID_ESPECIALIDAD)
        ON DELETE CASCADE ON UPDATE CASCADE
);
    
    
CREATE TABLE IF NOT EXISTS EMPRESAS_ESPECIALIDADES (
    ESPECIALIDAD INT UNSIGNED NOT NULL,
    EMPRESA INT UNSIGNED NOT NULL,
    PRIMARY KEY (ESPECIALIDAD , EMPRESA),
    INDEX FK3_ESPECIALIDAD (ESPECIALIDAD),
    INDEX FK2_EMPRESA (EMPRESA),
    CONSTRAINT FK3_ESPECIALIDAD FOREIGN KEY (ESPECIALIDAD)
        REFERENCES TIPOS_ESPECIALIDAD (ID_ESPECIALIDAD)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FK2_EMPRESA FOREIGN KEY (EMPRESA)
        REFERENCES EMPRESAS (ID_EMPRESA)
        ON DELETE CASCADE ON UPDATE CASCADE
);

    


  
ALTER TABLE SOCIOS
ADD CONSTRAINT FK3_INSTITUCION
FOREIGN KEY (INSTITUCION) REFERENCES INSTITUCIONES(ID_INSTITUCION)
ON DELETE RESTRICT
ON UPDATE CASCADE;
    
    
    
    
    
    
    
    
    
    
    

  
  
  
  
  
  
  
  