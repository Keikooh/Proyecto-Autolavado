-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para proyectoautolavado
CREATE DATABASE IF NOT EXISTS `proyectoautolavado` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `proyectoautolavado`;

-- Volcando estructura para vista proyectoautolavado.cardsempleadoslavado
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `cardsempleadoslavado` (
	`Nombre` VARCHAR(100) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Cargo` ENUM('Administrador','Supervisor','Lavado') NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Turno` ENUM('Matutino','Vespertino') NULL COLLATE 'utf8mb4_0900_ai_ci'
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectoautolavado.cardsvehiculoslavado
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `cardsvehiculoslavado` (
	`NombreCliente` VARCHAR(100) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Placa` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Tipo` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Modelo` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci'
) ENGINE=MyISAM;

-- Volcando estructura para procedimiento proyectoautolavado.CostoVariable
DELIMITER //
CREATE PROCEDURE `CostoVariable`(
IN p_Placa VARCHAR(50))
BEGIN 
SELECT Tipo,VariableClasificacion FROM vehiculo WHERE Placa=p_Placa;
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.DeleteEmpleado
DELIMITER //
CREATE PROCEDURE `DeleteEmpleado`(
IN p_IdEmpleado INT)
BEGIN
DELETE FROM empleado WHERE IdEmpleado=p_IdEmpleado;
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.DeleteVehiculo
DELIMITER //
CREATE PROCEDURE `DeleteVehiculo`(
IN p_Placa VARCHAR(50))
BEGIN
DELETE FROM vehiculo WHERE Placa=p_Placa;
END//
DELIMITER ;

-- Volcando estructura para tabla proyectoautolavado.empleado
CREATE TABLE IF NOT EXISTS `empleado` (
  `IdEmpleado` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `Cargo` enum('Administrador','Supervisor','Lavado') DEFAULT NULL,
  `Turno` enum('Matutino','Vespertino') DEFAULT NULL,
  `Salario` float DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdEmpleado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento proyectoautolavado.InsertLavado
DELIMITER //
CREATE PROCEDURE `InsertLavado`(
    IN p_fkidempleadoUno INT,
    IN p_fkidempleadoDos INT, 
    IN p_fkplaca VARCHAR(50),
    IN p_Fecha DATE,
    IN p_Costo FLOAT,
    IN p_ObservacionesVehiculo VARCHAR(100))
BEGIN 
    DECLARE salarioEmpleadoUno FLOAT DEFAULT (SELECT Salario * p_Costo FROM empleado WHERE IdEmpleado = p_fkidempleadoUno);
    DECLARE salarioEmpleadoDos FLOAT DEFAULT (SELECT Salario * p_Costo FROM empleado WHERE IdEmpleado = p_fkidempleadoDos);
    DECLARE ganancia FLOAT DEFAULT (p_Costo - (salarioEmpleadoUno + salarioEmpleadoDos));
    
    INSERT INTO lavado 
    VALUES(NULL, p_fkidempleadoUno, p_fkidempleadoDos, salarioEmpleadoUno, salarioEmpleadoDos, p_fkplaca, p_Fecha, p_Costo, ganancia, p_ObservacionesVehiculo);
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.InsertOrUpdateEmpleado
DELIMITER //
CREATE PROCEDURE `InsertOrUpdateEmpleado`(
IN p_IdEmpleado INT,
IN p_Nombre VARCHAR(100),
IN p_Cargo ENUM('Administrador','Supervisor','Lavado'),
IN p_Turno ENUM('Matutino','Vespertino'),
IN p_Salario FLOAT,
IN p_Color VARCHAR(50))
BEGIN 
DECLARE x INT;
SELECT COUNT(*) FROM empleado WHERE IdEmpleado=p_IdEmpleado INTO X;
if X=0 then
INSERT INTO empleado VALUES(NULL,p_Nombre,p_Cargo,p_Turno,p_Salario,p_color);
ELSE if X=1 then
UPDATE empleado SET Nombre=p_Nombre,Cargo=p_Cargo,Turno=p_Turno,Salario=p_Salario,Color=p_color WHERE IdEmpleado=p_IdEmpleado;
END if;
END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.InsertOrUpdateVehiculo
DELIMITER //
CREATE PROCEDURE `InsertOrUpdateVehiculo`(
IN p_Placa VARCHAR(50),
IN p_Cliente VARCHAR(100),
IN p_Tipo VARCHAR(50),
IN p_VariableClasificacion FLOAT,
IN p_Modelo VARCHAR(50),
IN p_Color VARCHAR(50))
BEGIN 
DECLARE x INT;
SELECT COUNT(*) FROM vehiculo WHERE Placa=p_Placa INTO X;
if X=0 then
INSERT INTO vehiculo VALUES(p_Placa,p_Cliente,p_Tipo,p_VariableClasificacion,p_Modelo,p_Color);
ELSE if X=1 then
UPDATE vehiculo SET Cliente=p_Cliente,Tipo=p_Tipo,VariableClasificacion=p_VariableClasificacion,Modelo=p_Modelo,Color=p_Color WHERE Placa=p_Placa;
END if;
END if;
END//
DELIMITER ;

-- Volcando estructura para tabla proyectoautolavado.lavado
CREATE TABLE IF NOT EXISTS `lavado` (
  `IdLavado` int NOT NULL AUTO_INCREMENT,
  `fkidempleadoUno` int DEFAULT NULL,
  `fkidempleadoDos` int DEFAULT NULL,
  `SalarioEmpleadoUno` float DEFAULT NULL,
  `SalarioEmpleadoDos` float DEFAULT NULL,
  `fkplaca` varchar(50) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Costo` float DEFAULT NULL,
  `Ganancia` float DEFAULT NULL,
  `ObservacionesVehiculo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdLavado`),
  KEY `fkidempleadoUno` (`fkidempleadoUno`),
  KEY `fkidempleadoDos` (`fkidempleadoDos`),
  KEY `fkplaca` (`fkplaca`),
  CONSTRAINT `lavado_ibfk_1` FOREIGN KEY (`fkidempleadoUno`) REFERENCES `empleado` (`IdEmpleado`),
  CONSTRAINT `lavado_ibfk_2` FOREIGN KEY (`fkidempleadoDos`) REFERENCES `empleado` (`IdEmpleado`),
  CONSTRAINT `lavado_ibfk_3` FOREIGN KEY (`fkplaca`) REFERENCES `vehiculo` (`Placa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento proyectoautolavado.pConsultarEmpleadoDelDia
DELIMITER //
CREATE PROCEDURE `pConsultarEmpleadoDelDia`()
BEGIN
    SELECT * FROM v_empleadodia;
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.pConsultarGananciasDelDia
DELIMITER //
CREATE PROCEDURE `pConsultarGananciasDelDia`()
BEGIN
    SELECT * FROM v_totalgananciasdia;
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.pConsultarReportes
DELIMITER //
CREATE PROCEDURE `pConsultarReportes`(
IN pFechaInicio DATE,
IN pFechaFin DATE,
IN pFiltro VARCHAR(100),
IN pEmpleado BOOL,
IN pCliente BOOL,
IN pPlaca BOOL
)
BEGIN
	IF pFechaFin > pFechaInicio OR (pFechaFin IS NULL) THEN
    	SET pFechaFin = CURDATE();
   END IF;
   
   IF pFechaInicio IS NULL THEN
   	SET pFechaInicio = CURDATE();
   END IF;
   
   -- Obtener consulta filtrando por empleado
   IF NOT pPlaca AND NOT pCliente AND pEmpleado THEN
   	SELECT * FROM v_reportes
   	WHERE (Fecha
    	BETWEEN pFechaInicio AND pFechaFin)
		AND (NombreEmpleadoUno LIKE CONCAT('%',pFiltro,'%')
		OR NombreEmpleadoDos LIKE CONCAT('%',pFiltro,'%'));
	-- Obtener consulta filtrando por Cliente
   ELSEIF NOT pPlaca AND pCliente AND NOT pEmpleado THEN
   	SELECT * FROM v_reportes
   	WHERE (Fecha
    	BETWEEN pFechaInicio AND pFechaFin)
		AND (Cliente LIKE CONCAT('%',pFiltro,'%'));
	-- Obtener consulta filtrando por Cliente y por Empleado
   ELSEIF NOT pPlaca AND pCliente AND pEmpleado THEN
   	SELECT * FROM v_reportes
   	WHERE (Fecha
    	BETWEEN pFechaInicio AND pFechaFin)
		AND (NombreEmpleadoUno LIKE CONCAT('%',pFiltro,'%')
		OR NombreEmpleadoDos LIKE CONCAT('%',pFiltro,'%')
		OR Cliente LIKE CONCAT('%',pFiltro,'%'));
	-- Obtener consulta filtrando por Placa
   ELSEIF pPlaca AND NOT pCliente AND NOT pEmpleado THEN
   	SELECT * FROM v_reportes
   	WHERE (Fecha
    	BETWEEN pFechaInicio AND pFechaFin)
		AND (Placa LIKE CONCAT('%',pFiltro,'%'));
	-- Obtener consulta filtrando por Placa y por Empleado
   ELSEIF pPlaca AND NOT pCliente AND pEmpleado THEN
   	SELECT * FROM v_reportes
   	WHERE (Fecha
    	BETWEEN pFechaInicio AND pFechaFin)
		AND (Placa LIKE CONCAT('%',pFiltro,'%')
		OR NombreEmpleadoUno LIKE CONCAT('%',pFiltro,'%')
		OR NombreEmpleadoDos LIKE CONCAT('%',pFiltro,'%'));
	-- Obtener consulta filtrando por Placa y por Cliente
   ELSEIF pPlaca AND pCliente AND NOT pEmpleado THEN
   	SELECT * FROM v_reportes
   	WHERE (Fecha
    	BETWEEN pFechaInicio AND pFechaFin)
		AND (Placa LIKE CONCAT('%',pFiltro,'%')
		OR Cliente LIKE CONCAT('%',pFiltro,'%'));
   ELSE
   	SELECT * FROM v_reportes
   	WHERE (Fecha
    	BETWEEN pFechaInicio AND pFechaFin)
		AND (NombreEmpleadoUno LIKE CONCAT('%',pFiltro,'%')
		OR NombreEmpleadoDos LIKE CONCAT('%',pFiltro,'%')
		OR Placa LIKE CONCAT('%',pFiltro,'%')
		OR Cliente LIKE CONCAT('%',pFiltro,'%'));
   END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.pConsultarTotalLavadosDelDia
DELIMITER //
CREATE PROCEDURE `pConsultarTotalLavadosDelDia`()
BEGIN
    SELECT * FROM v_totallavados;
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.ShowEmpleado
DELIMITER //
CREATE PROCEDURE `ShowEmpleado`()
BEGIN
SELECT * FROM empleado;
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyectoautolavado.ShowVehiculo
DELIMITER //
CREATE PROCEDURE `ShowVehiculo`()
BEGIN
SELECT * FROM vehiculo WHERE Placa NOT IN (SELECT fkplaca FROM lavado);
END//
DELIMITER ;

-- Volcando estructura para tabla proyectoautolavado.users
CREATE TABLE IF NOT EXISTS `users` (
  `IdUser` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Cargo` enum('Administrador','Supervisor') NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  PRIMARY KEY (`IdUser`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla proyectoautolavado.vehiculo
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `Placa` varchar(50) NOT NULL,
  `Cliente` varchar(100) DEFAULT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `VariableClasificacion` float DEFAULT NULL,
  `Modelo` varchar(50) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Placa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para vista proyectoautolavado.v_empleadodia
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_empleadodia` (
	`Nombre` VARCHAR(100) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`TotalAutosLavados` BIGINT(19) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectoautolavado.v_reportes
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_reportes` (
	`IdLavado` INT(10) NOT NULL,
	`NombreEmpleadoUno` VARCHAR(100) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`NombreEmpleadoDos` VARCHAR(100) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Cliente` VARCHAR(100) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Placa` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Tipo` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Modelo` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Color` VARCHAR(50) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`ObservacionesVehiculo` VARCHAR(100) NULL COLLATE 'utf8mb4_0900_ai_ci',
	`Fecha` DATE NULL,
	`costo` FLOAT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectoautolavado.v_totalgananciasdia
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_totalgananciasdia` (
	`totalGanancia` DOUBLE NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectoautolavado.v_totallavados
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `v_totallavados` (
	`TotalAutos` BIGINT(19) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para vista proyectoautolavado.cardsempleadoslavado
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `cardsempleadoslavado`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `cardsempleadoslavado` AS select `empleado`.`Nombre` AS `Nombre`,`empleado`.`Cargo` AS `Cargo`,`empleado`.`Turno` AS `Turno` from `empleado` where (`empleado`.`Cargo` = 'Lavado');

-- Volcando estructura para vista proyectoautolavado.cardsvehiculoslavado
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `cardsvehiculoslavado`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `cardsvehiculoslavado` AS select `v`.`Cliente` AS `NombreCliente`,`v`.`Placa` AS `Placa`,`v`.`Tipo` AS `Tipo`,`v`.`Modelo` AS `Modelo` from (`lavado` `l` join `vehiculo` `v` on((`l`.`fkplaca` = `v`.`Placa`)));

-- Volcando estructura para vista proyectoautolavado.v_empleadodia
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_empleadodia`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_empleadodia` AS select `empleado`.`Nombre` AS `Nombre`,count(`lavado`.`fkplaca`) AS `TotalAutosLavados` from (`empleado` left join `lavado` on(((`empleado`.`IdEmpleado` = `lavado`.`fkidempleadoUno`) or (`empleado`.`IdEmpleado` = `lavado`.`fkidempleadoDos`)))) where (cast(`lavado`.`Fecha` as date) = curdate()) group by `empleado`.`IdEmpleado` limit 1;

-- Volcando estructura para vista proyectoautolavado.v_reportes
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_reportes`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_reportes` AS select `lavado`.`IdLavado` AS `IdLavado`,`empleado_uno`.`Nombre` AS `NombreEmpleadoUno`,`empleado_dos`.`Nombre` AS `NombreEmpleadoDos`,`vehiculo`.`Cliente` AS `Cliente`,`lavado`.`fkplaca` AS `Placa`,`vehiculo`.`Tipo` AS `Tipo`,`vehiculo`.`Modelo` AS `Modelo`,`vehiculo`.`Color` AS `Color`,`lavado`.`ObservacionesVehiculo` AS `ObservacionesVehiculo`,`lavado`.`Fecha` AS `Fecha`,`lavado`.`Costo` AS `costo` from (((`lavado` join `empleado` `empleado_uno` on((`lavado`.`fkidempleadoUno` = `empleado_uno`.`IdEmpleado`))) join `empleado` `empleado_dos` on((`lavado`.`fkidempleadoDos` = `empleado_dos`.`IdEmpleado`))) join `vehiculo` on((`lavado`.`fkplaca` = `vehiculo`.`Placa`)));

-- Volcando estructura para vista proyectoautolavado.v_totalgananciasdia
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_totalgananciasdia`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totalgananciasdia` AS select sum(`lavado`.`Ganancia`) AS `totalGanancia` from `lavado` where (cast(`lavado`.`Fecha` as date) = curdate());

-- Volcando estructura para vista proyectoautolavado.v_totallavados
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `v_totallavados`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_totallavados` AS select count(0) AS `TotalAutos` from (select `lavado`.`IdLavado` AS `IdLavado`,`empleado_uno`.`Nombre` AS `NombreEmpleadoUno`,`empleado_dos`.`Nombre` AS `NombreEmpleadoDos`,`lavado`.`SalarioEmpleadoUno` AS `SalarioEmpleadoUno`,`lavado`.`SalarioEmpleadoDos` AS `SalarioEmpleadoDos`,`lavado`.`fkplaca` AS `fkplaca`,`lavado`.`Fecha` AS `Fecha`,`lavado`.`Costo` AS `costo`,`lavado`.`Ganancia` AS `Ganancia`,`lavado`.`ObservacionesVehiculo` AS `ObservacionesVehiculo`,`vehiculo`.`Cliente` AS `Cliente`,`vehiculo`.`Modelo` AS `Modelo`,`vehiculo`.`Color` AS `Color` from (((`lavado` join `empleado` `empleado_uno` on((`lavado`.`fkidempleadoUno` = `empleado_uno`.`IdEmpleado`))) join `empleado` `empleado_dos` on((`lavado`.`fkidempleadoDos` = `empleado_dos`.`IdEmpleado`))) join `vehiculo` on((`lavado`.`fkplaca` = `vehiculo`.`Placa`))) where (cast(`lavado`.`Fecha` as date) = curdate())) `subconsulta`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
