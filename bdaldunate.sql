# Host: localhost  (Version 5.5.5-10.1.36-MariaDB)
# Date: 2018-11-27 17:27:05
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "tb_actividad"
#

CREATE TABLE `tb_actividad` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "tb_actividad"
#


#
# Structure for table "tb_producto"
#

CREATE TABLE `tb_producto` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "tb_usuario"
#

INSERT INTO `tb_usuario` VALUES (1,'Douglas Barraza','douglasbarraza@hotmail.com','super','$2y$12$KteJ1u5CqrLj1Uzr53ygXez27XUP2LLAFwexFCxUV554xnglaZVOO','2018-11-27 11:34:27');
