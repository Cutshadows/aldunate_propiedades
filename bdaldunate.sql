# Host: localhost  (Version 5.5.5-10.1.36-MariaDB)
# Date: 2018-11-28 15:40:09
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "tb_actividad"
#

CREATE TABLE `tb_actividad` (
  `coidActividad` int(11) NOT NULL AUTO_INCREMENT,
  `db_usuarios_id_usuarios` int(11) DEFAULT NULL,
  `coAccion` varchar(255) DEFAULT NULL,
  `coFecha` datetime DEFAULT NULL,
  `coTipo` int(11) DEFAULT NULL,
  `coId` int(11) DEFAULT NULL,
  PRIMARY KEY (`coidActividad`),
  KEY `fk_usuario` (`db_usuarios_id_usuarios`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "tb_actividad"
#

INSERT INTO `tb_actividad` VALUES (1,1,'Registro de Usuario (Julia Aldunate), con Privilegios de :admin','2018-11-28 10:53:48',1,2),(2,1,'Registro de Usuario (Julia Aldunate), con Privilegios de :admin','2018-11-28 12:14:05',1,3),(3,1,'Registro de Usuario (Andres Moreno), con Privilegios de :admin','2018-11-28 12:37:08',1,4),(4,1,'Eliminar Usuario(), con Privilegios de :  ','2018-11-28 12:37:14',3,4),(5,1,'Registro de Usuario (Miguel Santander), con Privilegios de :admin','2018-11-28 12:44:41',1,5),(6,1,'Eliminar Usuario Exitosamente.','2018-11-28 12:44:49',3,5);

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
  KEY `fk_usuario` (`tb_usuario_coidUsuario`)
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "tb_usuario"
#

INSERT INTO `tb_usuario` VALUES (1,'Douglas Barraza','douglasbarraza@hotmail.com','super','$2y$12$KteJ1u5CqrLj1Uzr53ygXez27XUP2LLAFwexFCxUV554xnglaZVOO','2018-11-28 10:40:37');
