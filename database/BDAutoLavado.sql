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
												
												
/*Mostrar las CARDS de los empleados de lavado*/
DROP VIEW IF EXISTS cardsempleadoslavado; CREATE VIEW CardsEmpleadosLavado AS SELECT Nombre,Cargo,Turno FROM empleado WHERE Cargo="Lavado";
SELECT * FROM cardsempleadoslavado;


/*Mostrar las CARDS de los vehiculos registrados*/
DROP VIEW IF EXISTS cardsvehiculoslavado; 
CREATE VIEW CardsVehiculosLavado AS
SELECT v.Cliente AS NombreCliente, v.Placa, v.Tipo, v.Modelo
FROM Lavado l
JOIN Vehiculo v ON l.fkplaca = v.Placa;
SELECT * FROM cardsvehiculoslavado; 


/*Obtener el empleado del dia*/
DROP VIEW IF EXISTS EmpleadoDia; 
CREATE VIEW EmpleadoDia AS SELECT e.Nombre AS NombreEmpleado, COUNT(*) AS TotalLavados
FROM Lavado l
JOIN Empleado e ON l.fkidempleado = e.IdEmpleado
GROUP BY e.Nombre
ORDER BY TotalLavados DESC
LIMIT 1;
SELECT * FROM EmpleadoDia; 


/*Obtener el total de vehiculos lavados*/
DROP VIEW IF EXISTS TotalLavados;
CREATE VIEW TotalLavados AS
SELECT COUNT(*) AS TotalLavados
FROM lavado;
SELECT * FROM TotalLavados;


/*Obtener el total de ganacias*/
DROP VIEW IF EXISTS TotalGanacias;
CREATE VIEW TotalGanancias AS 
SELECT SUM(Costo) AS TotalGanancias
FROM Lavado;
SELECT * FROM TotalGanancias;


/*Filtrado por Fechas y cliente*/
DROP VIEW IF EXISTS LavadosxCliente;
CREATE VIEW LavadosxCliente AS 
SELECT l.IdLavado AS NumeroLavado, e.Nombre AS 'Nombre del Empleado', l.Costo AS 'Costo del Lavado', l.SalarioEmpleado AS 'Salario Ganancia del Empleado', l.ObservacionesVehiculo AS 'Observaciones Relevantes del Vehiculo'
FROM Lavado l
JOIN Empleado e ON l.fkidempleado = e.IdEmpleado
WHERE l.Fecha BETWEEN 'fecha_inicio' AND 'fecha_fin'
AND e.Nombre LIKE '%nombre_cliente%';

/*JARED
- Falta la consulta de fechas por empleado.
- Falta la consulta de fechas por vehiculo

MUY SIMILARES A LA ULTIMA QUE HICE*/