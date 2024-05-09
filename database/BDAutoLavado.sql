CREATE DATABASE proyectoautolavado;
USE proyectoautolavado;

												/*Tablas.*/
CREATE TABLE Users(
IdUser INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
Nombre VARCHAR(100) UNIQUE NOT NULL,
Cargo ENUM('Administrador','Supervisor') NOT NULL,
PASSWORD VARCHAR(100)NOT NULL);
INSERT INTO users VALUES (NULL,'Gabriel','Administrador','12345'),(NULL,'Jared','Supervisor','123');
CREATE TABLE Empleado(
IdEmpleado INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
Nombre VARCHAR(100),
Cargo ENUM('Administrador','Supervisor','Lavado'),
Turno ENUM('Matutino','Vespertino'),
Salario FLOAT,
Color VARCHAR(50));
CREATE TABLE Vehiculo(
Placa VARCHAR(50) PRIMARY KEY NOT NULL,
Cliente VARCHAR(100),
Tipo VARCHAR(50),
VariableClasificacion FLOAT,
Modelo VARCHAR(50),
Color VARCHAR(50));
CREATE TABLE Lavado(
IdLavado INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
fkidempleadoUno INT, 
fkidempleadoDos INT,
SalarioEmpleadoUno FLOAT,
SalarioEmpleadoDos FLOAT,
fkplaca VARCHAR(50),
Fecha DATE,
Costo FLOAT,
Ganancia FLOAT, 
ObservacionesVehiculo VARCHAR(100),
FOREIGN KEY(fkidempleadoUno) REFERENCES Empleado(IdEmpleado),
FOREIGN KEY(fkidempleadoDos) REFERENCES Empleado(IdEmpleado),
FOREIGN KEY(fkplaca) REFERENCES Vehiculo(Placa));

												/*PROCEDIMIENTOS ALMACENADOS*/
/*Para empleado*/
/*GUARDAR Y ACTUALIZAR*/
delimiter ;;
CREATE PROCEDURE InsertOrUpdateEmpleado(
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
END;;
/*ELIMINAR*/
delimiter ;;
CREATE PROCEDURE DeleteEmpleado(
IN p_IdEmpleado INT)
BEGIN
DELETE FROM empleado WHERE IdEmpleado=p_IdEmpleado;
END;;
/*MOSTRAR*/
delimiter ;;
CREATE PROCEDURE ShowEmpleado()
BEGIN
SELECT * FROM empleado;
END;;
/*Para vehiculo*/
/*GUARDAR Y ACTUALIZAR*/
delimiter ;;
CREATE PROCEDURE InsertOrUpdateVehiculo(
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
END;;
/*ELIMINAR*/
delimiter ;;
CREATE PROCEDURE DeleteVehiculo(
IN p_Placa VARCHAR(50))
BEGIN
DELETE FROM vehiculo WHERE Placa=p_Placa;
END;;
/*MOSTRAR*/
delimiter ;;
CREATE PROCEDURE ShowVehiculo()
BEGIN
SELECT * FROM vehiculo WHERE Placa NOT IN (SELECT fkplaca FROM lavado);
END;;
/*Para lavado*/
/*GUARDAR Y ACTUALIZAR*/
DELIMITER ;;
DROP PROCEDURE IF EXISTS InsertLavado;
CREATE PROCEDURE InsertLavado(
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
END;;
/*Obtener costo*/
delimiter ;;
CREATE PROCEDURE CostoVariable(
IN p_Placa VARCHAR(50))
BEGIN 
SELECT Tipo,VariableClasificacion FROM vehiculo WHERE Placa=p_Placa;
END;;

												/*Vistas*/
CREATE VIEW v_reportes AS
SELECT lavado.IdLavado,empleado_uno.Nombre AS NombreEmpleadoUno, empleado_dos.Nombre AS NombreEmpleadoDos,vehiculo.Cliente,
lavado.fkplaca AS 'Placa',-- lavado.SalarioEmpleadoUno, lavado.SalarioEmpleadoDos, 
vehiculo.Tipo,vehiculo.Modelo,vehiculo.Color,lavado.ObservacionesVehiculo,
lavado.Fecha,lavado.costo/*lavado.Ganancia,*/
FROM lavado
INNER JOIN empleado AS empleado_uno ON lavado.fkidempleadoUno = empleado_uno.IdEmpleado
INNER JOIN empleado AS empleado_dos ON lavado.fkidempleadoDos = empleado_dos.IdEmpleado
INNER JOIN vehiculo ON lavado.fkplaca = vehiculo.Placa;

/*SELECT COUNT(lavado.IdLavado)
FROM lavado
INNER JOIN empleado AS empleado_uno ON lavado.fkidempleadoUno = empleado_uno.IdEmpleado
INNER JOIN empleado AS empleado_dos ON lavado.fkidempleadoDos = empleado_dos.IdEmpleado
INNER JOIN vehiculo ON lavado.fkplaca = vehiculo.Placa;


SELECT *,COUNT(lavado.fkplaca) FROM empleado,lavado
WHERE empleado.IdEmpleado=lavado.fkidempleadoUno 
OR empleado.IdEmpleado = lavado.fkidempleadoDos
GROUP BY empleado.IdEmpleado;*/


DELIMITER //

CREATE PROCEDURE pConsultarReportes(
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
		
	-- Obtener consulta filtrando por Placa, Cliente o Empleado
   ELSE
   	SELECT * FROM v_reportes
   	WHERE (Fecha
    	BETWEEN pFechaInicio AND pFechaFin)
		AND (NombreEmpleadoUno LIKE CONCAT('%',pFiltro,'%')
		OR NombreEmpleadoDos LIKE CONCAT('%',pFiltro,'%')
		OR Placa LIKE CONCAT('%',pFiltro,'%')
		OR Cliente LIKE CONCAT('%',pFiltro,'%'));
   END IF;
END 


																	/*Vistas y Procedimientos agregados a el modulo de administrador NUEVOS PROPUESTA GABRIEL...*/
DELIMITER //
CREATE PROCEDURE pConsultarGananciasEmpleadosFechas(
    IN p_FechaInicio DATE,
    IN p_FechaFin DATE
)
BEGIN
	IF p_FechaInicio IS NULL THEN
   	SET p_FechaInicio = CURDATE();
   END IF;
   IF p_FechaFin IS NULL THEN
   	SET p_FechaFin = CURDATE();
   END IF;
   SELECT IdEmpleado, Nombre, Cargo, SUM(Salario) AS TotalSalario
    	FROM (
        SELECT IdEmpleado, Nombre, Cargo, SalarioEmpleadoUno AS Salario
        FROM Empleado e
        JOIN Lavado l ON e.IdEmpleado = l.fkidempleadoUno
        WHERE l.Fecha BETWEEN p_FechaInicio AND p_FechaFin
        UNION ALL
        SELECT IdEmpleado, Nombre, Cargo, SalarioEmpleadoDos AS Salario
        FROM Empleado e
        JOIN Lavado l ON e.IdEmpleado = l.fkidempleadoDos
        WHERE l.Fecha BETWEEN p_FechaInicio AND p_FechaFin
		    ) AS SalariosTotales
		    GROUP BY IdEmpleado, Nombre, Cargo;
END //

-- Definir el procedimiento almacenado pConsultarEmpleadoDelDia_por_rango
CREATE VIEW v_empleadodia_max AS
SELECT empleado.Nombre, COUNT(lavado.fkplaca) AS TotalAutosLavados
FROM empleado
LEFT JOIN lavado ON (empleado.IdEmpleado = lavado.fkidempleadoUno OR empleado.IdEmpleado = lavado.fkidempleadoDos)
WHERE DATE(lavado.Fecha) = CURDATE()
GROUP BY empleado.IdEmpleado
ORDER BY TotalAutosLavados DESC
LIMIT 1;
DELIMITER //
CREATE PROCEDURE pConsultarEmpleadoDelDia_por_rango(IN PfechaInicio DATE, IN PfechaFin DATE)
BEGIN
	IF PFechaInicio IS NULL OR PFechaFin IS NULL THEN
   	SELECT * FROM v_empleadodia_max;
   ELSE
   	SELECT empleado.Nombre, COUNT(lavado.fkplaca) AS TotalAutosLavados
		FROM empleado
		LEFT JOIN lavado ON (empleado.IdEmpleado = lavado.fkidempleadoUno OR empleado.IdEmpleado = lavado.fkidempleadoDos)
		WHERE DATE(lavado.Fecha) BETWEEN PfechaInicio AND PfechaFin
		GROUP BY empleado.IdEmpleado
		HAVING COUNT(lavado.fkplaca) = (
		    SELECT MAX(contador)
		    FROM (
		        SELECT COUNT(lavado.fkplaca) AS contador
		        FROM empleado
		        LEFT JOIN lavado ON (empleado.IdEmpleado = lavado.fkidempleadoUno OR empleado.IdEmpleado = lavado.fkidempleadoDos)
		        WHERE DATE(lavado.Fecha) BETWEEN PfechaInicio AND PfechaFin
		        GROUP BY empleado.IdEmpleado
		    ) AS subconsulta);
	END IF;
END //
CALL pConsultarEmpleadoDelDia_por_rango(NULL,NULL);
CALL pConsultarEmpleadoDelDia_por_rango('2024-05-06','2024-05-08');

-- Definir el procedimiento almacenado pConsultarTotalLavadosDelDia_por_rango
CREATE VIEW v_TotalLavados AS 
SELECT COUNT(*) AS TotalAutos
FROM (
    SELECT lavado.IdLavado, empleado_uno.Nombre AS NombreEmpleadoUno, empleado_dos.Nombre AS NombreEmpleadoDos, lavado.SalarioEmpleadoUno, lavado.SalarioEmpleadoDos, 
    lavado.fkplaca, lavado.Fecha, lavado.costo, lavado.Ganancia, lavado.ObservacionesVehiculo, vehiculo.Cliente, vehiculo.Modelo, vehiculo.Color
    FROM lavado
    INNER JOIN empleado AS empleado_uno ON lavado.fkidempleadoUno = empleado_uno.IdEmpleado
    INNER JOIN empleado AS empleado_dos ON lavado.fkidempleadoDos = empleado_dos.IdEmpleado
    INNER JOIN vehiculo ON lavado.fkplaca = vehiculo.Placa
    WHERE DATE(lavado.Fecha) = CURDATE()
) AS subconsulta;
DELIMITER //
CREATE PROCEDURE pConsultarTotalLavadosDelDia_por_rango(IN PfechaInicio DATE, IN PfechaFin DATE)
BEGIN
	IF PFechaInicio IS NULL OR PFechaFin IS NULL THEN
   	SELECT * FROM v_totallavados;
   ELSE
   	SELECT COUNT(*) AS TotalAutos
		FROM (
	    SELECT lavado.IdLavado, empleado_uno.Nombre AS NombreEmpleadoUno, empleado_dos.Nombre AS NombreEmpleadoDos, lavado.SalarioEmpleadoUno, lavado.SalarioEmpleadoDos, 
	    lavado.fkplaca, lavado.Fecha, lavado.costo, lavado.Ganancia, lavado.ObservacionesVehiculo, vehiculo.Cliente, vehiculo.Modelo, vehiculo.Color
	    FROM lavado
	    INNER JOIN empleado AS empleado_uno ON lavado.fkidempleadoUno = empleado_uno.IdEmpleado
	    INNER JOIN empleado AS empleado_dos ON lavado.fkidempleadoDos = empleado_dos.IdEmpleado
	    INNER JOIN vehiculo ON lavado.fkplaca = vehiculo.Placa
	    WHERE DATE(lavado.Fecha) BETWEEN PfechaInicio AND PfechaFin
		) AS subconsulta;
   END IF;
END //
CALL pConsultarTotalLavadosDelDia_por_rango(NULL,NULL);
CALL pConsultarTotalLavadosDelDia_por_rango('2024-05-06','2024-05-08');

-- Definir el procedimiento almacenado pConsultarGananciasDelDia_por_rango
CREATE VIEW v_totalgananciasdia AS
SELECT SUM(Ganancia) AS totalGanancia FROM lavado
WHERE DATE(lavado.Fecha) = CURDATE();
DELIMITER //
CREATE PROCEDURE pConsultarGananciasDelDia_por_rango(IN PfechaInicio DATE, IN PfechaFin DATE)
BEGIN
	IF PFechaInicio IS NULL OR PFechaFin IS NULL THEN
   	SELECT * FROM v_totalgananciasdia;
   ELSE
    SELECT SUM(Ganancia) AS totalGanancia FROM lavado
		WHERE DATE(lavado.Fecha) BETWEEN PfechaInicio AND PfechaFin;
	END IF;
END //
CALL pConsultarGananciasDelDia_por_rango(NULL,NULL);
CALL pConsultarGananciasDelDia_por_rango('2024-05-06','2024-05-08');