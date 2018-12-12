# Host: localhost  (Version 5.5.5-10.1.32-MariaDB)
# Date: 2018-12-12 00:37:43
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "tb_actividad"
#

CREATE TABLE `tb_actividad` (
  `coidActividad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `db_usuarios_id_usuarios` int(10) unsigned NOT NULL DEFAULT '0',
  `coAccion` varchar(255) DEFAULT NULL,
  `coFecha` datetime DEFAULT NULL,
  `coTipo` int(10) unsigned DEFAULT NULL,
  `coId` int(11) DEFAULT NULL,
  PRIMARY KEY (`coidActividad`),
  KEY `fk_usuario` (`db_usuarios_id_usuarios`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "tb_actividad"
#

INSERT INTO `tb_actividad` VALUES (1,1,'Registro de Usuario (Alejandro Julio), con Privilegios de :admin','2018-11-28 01:26:54',1,2),(2,1,'Eliminar Usuario Exitosamente.','2018-11-29 19:32:11',3,2);

#
# Structure for table "tb_comuna"
#

CREATE TABLE `tb_comuna` (
  `coidComuna` varchar(11) NOT NULL DEFAULT '',
  `coNomComuna` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`coidComuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "tb_comuna"
#

INSERT INTO `tb_comuna` VALUES ('P1C1CO00','Canela'),('P1C1CO01','Illapel'),('P1C1CO02','Los Vilos'),('P1C1CO03','Salmanca'),('P2C2CO04','Andacollo'),('P2C2CO05','Coquimbo'),('P2C2CO06','La Higuera'),('P2C2CO07','La Serena'),('P2C2CO08','Paihuano'),('P2C2CO09','Vicuna'),('P3C3CO10','Combarbal&aacute'),('P3C3CO11','Monte Patria'),('P3C3CO12','Ovalle'),('P3C3CO13','Punitaqui'),('P3C3CO14','Rio Hurtado');

#
# Structure for table "tb_contenido"
#

CREATE TABLE `tb_contenido` (
  `coidContenido` int(11) NOT NULL AUTO_INCREMENT,
  `coTitulo` varchar(120) DEFAULT NULL,
  `coDescripcion` text,
  `coComuna` varchar(50) DEFAULT NULL,
  `coDireccion` varchar(150) DEFAULT NULL,
  `coDetalles` longtext,
  `coPrecio` varchar(60) DEFAULT NULL,
  `tb_usuario_coidUsuario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`coidContenido`),
  KEY `fk_usuario` (`tb_usuario_coidUsuario`),
  KEY `fk_comuna` (`coComuna`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "tb_contenido"
#


#
# Structure for table "tb_imagenes"
#

CREATE TABLE `tb_imagenes` (
  `coidImagen` int(11) NOT NULL AUTO_INCREMENT,
  `coNomimg` varchar(255) DEFAULT NULL,
  `tb_contenido_coidContenido` int(11) DEFAULT NULL,
  `tb_usuario_coidUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`coidImagen`),
  KEY `fk_contenido` (`tb_contenido_coidContenido`),
  KEY `fk_usuario` (`tb_usuario_coidUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "tb_imagenes"
#


#
# Structure for table "tb_producto"
#

CREATE TABLE `tb_producto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "tb_producto"
#


#
# Structure for table "tb_usuario"
#

CREATE TABLE `tb_usuario` (
  `coidUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `coNomUsuario` varchar(50) DEFAULT NULL,
  `coEmailUsuario` varchar(60) DEFAULT NULL,
  `coPrivilegiosUsuario` varchar(30) DEFAULT NULL,
  `coClaveUsuario` varchar(70) DEFAULT NULL,
  `coUltimaLog` datetime DEFAULT NULL,
  PRIMARY KEY (`coidUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "tb_usuario"
#

INSERT INTO `tb_usuario` VALUES (1,'Douglas Barraza','douglasbarraza@hotmail.com','super','$2y$12$55AsyGli8To449gp.LLf9OWQOtt2j4hRf9JtSH5VjSPFIIH8mldOS','2018-12-10 23:47:14');
