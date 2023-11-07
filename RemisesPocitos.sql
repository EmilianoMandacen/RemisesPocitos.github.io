drop database TortuStudioProyecto;
create database TortuStudioProyecto;
use TortuStudioProyecto;

-- Tabla Usuarios
CREATE TABLE Usuarios (
    nom_usu VARCHAR(30) not null,
    contrasena VARCHAR(8) not null,
    tipo VARCHAR(20) not null CHECK(tipo IN ('Administrador', 'Administrativo')) not null default ('Administrativo'),
    apellido VARCHAR(255) not null,
    ci VARCHAR(11) PRIMARY KEY,
    baja BOOLEAN not null default (1),
    estado BOOLEAN not null default (1)
);

CREATE TABLE Sesiones (
    ci_u VARCHAR(11) NOT NULL PRIMARY KEY,
	FOREIGN KEY (ci_u) REFERENCES Usuarios(ci)
);

-- Tabla Usuarios_tel
CREATE TABLE Usuarios_tel (
    ci VARCHAR(11),
    tel VARCHAR(11),
    PRIMARY KEY (ci, tel),
    FOREIGN KEY (ci) REFERENCES Usuarios(ci)
);

-- Tabla Administrador
CREATE TABLE Administrador (
    ci VARCHAR(11) PRIMARY KEY,
    FOREIGN KEY (ci) REFERENCES Usuarios(ci)
);

-- Tabla Administrativo
CREATE TABLE Administrativo (
    ci VARCHAR(11) PRIMARY KEY,
    FOREIGN KEY (ci) REFERENCES Usuarios(ci)
);

-- Tabla Empresa
CREATE TABLE Empresa (
    RUT VARCHAR(12) PRIMARY KEY,
    nom_ficticio VARCHAR(255) not null,
    razon_social VARCHAR(255) not null,
    baja BOOLEAN not null default (1),
    lista_negra BOOLEAN not null default (1)
);

-- Tabla empresa_tel
CREATE TABLE empresa_tel (
    RUT VARCHAR(12),
    tel VARCHAR(11),
    PRIMARY KEY (RUT),
    FOREIGN KEY (RUT) REFERENCES Empresa(RUT)
);
-- Tabla Empresa_direccion
CREATE TABLE Empresa_direccion (
    RUT VARCHAR(12) PRIMARY KEY,
    calle VARCHAR(255) not null,
    n_puerta VARCHAR(7) not null,
    Esquina VARCHAR(255) not null,
    FOREIGN KEY (RUT) REFERENCES Empresa(RUT)
);

-- Tabla Reserva
CREATE TABLE Reserva (
    cod_reserva INT PRIMARY KEY auto_increment,
    comentario TEXT,
    destino VARCHAR(255) not null,
    origen VARCHAR(255) not null,
    hora TIME not null,
    fecha DATE not null,
    tipo VARCHAR(20) not null CHECK(tipo IN ('Empresa', 'Particular')) not null,
    costo INT not null,
    baja BOOLEAN not null default (1)
);


-- Tabla Reserva_pasajero
CREATE TABLE Reserva_pasajero (
    cod_reserva INT,
    Nombre VARCHAR(255) not null,
    Apellido VARCHAR(255) not null,  
    tel VARCHAR(11) not null,
    PRIMARY KEY (cod_reserva, tel),
    FOREIGN KEY (cod_reserva) REFERENCES Reserva(cod_reserva)
);

-- Tabla coche
CREATE TABLE coche (
    matricula VARCHAR(20) PRIMARY KEY,
    marca VARCHAR(255),
    modelo VARCHAR(255),
    c_pasajeros INT,
    n_padron int(7),
    baja BOOLEAN not null default (1),
    seguro_coche VARCHAR(255) CHECK(seguro_coche IN ('total', 'parcial', 'por terceros'))
);

-- Tabla chofer
CREATE TABLE chofer (
    CI VARCHAR(11) PRIMARY KEY,
    nombre VARCHAR(255) not null,
    apellido VARCHAR(255) not null,
    c_salud DATE not null,
    tipo VARCHAR(20) CHECK(tipo IN ('particular', 'contratado')) not null,
    fecha_de_vencimiento_libreta_conducir DATE not null,
    matricula VARCHAR(20) not null,
    baja BOOLEAN not null default (1),
     estado BOOLEAN not null default (1),
    FOREIGN KEY (matricula) REFERENCES coche(matricula)
);

DELIMITER 
CREATE TRIGGER CheckFechasVencimiento BEFORE INSERT ON chofer
FOR EACH ROW
BEGIN
    IF NEW.c_salud = CURDATE() THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La fecha de vencimiento del carnet de salud debe ser mayor a la fecha actual.';
    END IF;

    IF NEW.fecha_de_vencimiento_libreta_conducir = CURDATE() THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La fecha de vencimiento de la libreta de conducción debe ser mayor a la fecha actual.';
    END IF;
END;

DELIMITER ;

-- Tabla chofer_tel
CREATE TABLE chofer_tel (
    CI VARCHAR(11),
    tel VARCHAR(11),
    PRIMARY KEY (CI, tel),
    FOREIGN KEY (CI) REFERENCES chofer(CI)
);

-- Tabla mantenimiento_coche
CREATE TABLE mantenimiento_coche (
    cod INT PRIMARY KEY auto_increment,
    concepto ENUM('GASOIL', 'CAMBIO ACEITE', 'ELECTRICISTA', 'ALINEACIÓN Y BALANCEO', 'CAMBIO DE CUBIERTA', 'GOMERÍA', 'CAMBIO DE CORREA', 'FRENOS', 'EMBRAGUE', 'CHAPISTA', 'OTROS'),
	baja BOOLEAN not null default (1)
);

-- Tabla metodo_de_pago
CREATE TABLE metodo_de_pago (
    cod_pago INT PRIMARY KEY auto_increment
);

-- Tabla Transferencia
CREATE TABLE Transferencia (
    cod_pago INT,
    num_cuenta VARCHAR(20) ,
    PRIMARY KEY (cod_pago, num_cuenta),
    FOREIGN KEY (cod_pago) REFERENCES metodo_de_pago(cod_pago)
);

-- Tabla Contado
CREATE TABLE Contado (
    cod_pago INT PRIMARY KEY,
    FOREIGN KEY (cod_pago) REFERENCES metodo_de_pago(cod_pago)
);

-- Tabla Tarjeta
CREATE TABLE Tarjeta (
    cod_pago INT,
    num_tarjeta VARCHAR(22),
    PRIMARY KEY (cod_pago, num_tarjeta),
    FOREIGN KEY (cod_pago) REFERENCES metodo_de_pago(cod_pago)
);

-- Tabla Cuenta_corriente
CREATE TABLE Cuenta_corriente(
    cod_pago INT,
    cod_cuenta INT,
    PRIMARY KEY (cod_pago, cod_cuenta),
    FOREIGN KEY (cod_pago) REFERENCES metodo_de_pago(cod_pago)
);

-- Tabla poseen
CREATE TABLE poseen(
RUT varchar(12) primary key,
cod_cuenta INT,
cod_pago int,
saldo int default 0,
foreign key (cod_pago, cod_cuenta) references Cuenta_corriente(cod_pago, cod_cuenta),
foreign key (RUT) references Empresa(RUT)
);

-- Tabla Crea
CREATE TABLE Crea (
    cod_Usu VARCHAR(11),
    cod_Admin VARCHAR(11) not null,
    PRIMARY KEY (cod_Usu),
    FOREIGN KEY (cod_Usu) REFERENCES Usuarios(ci),
    FOREIGN KEY (cod_Admin) REFERENCES Administrador(ci) on update cascade
);

-- Tabla Controla
CREATE TABLE Controla (
    cod varchar (11),
    cod_reserva INT,
    PRIMARY KEY (cod, cod_reserva),
    FOREIGN KEY (cod_reserva) REFERENCES Reserva(cod_reserva),
    foreign key (cod) references Usuarios(ci)
);

-- Tabla Genera
CREATE TABLE Genera (
    RUT VARCHAR(12),
    cod_reserva INT,
    PRIMARY KEY (RUT, cod_reserva),
    FOREIGN KEY (RUT) REFERENCES Empresa(RUT),
    FOREIGN KEY (cod_reserva) REFERENCES Reserva(cod_reserva)
);

-- Tabla Precisa
CREATE TABLE Precisa (
    cod_reserva INT,
    CI_chofer VARCHAR(11),
    PRIMARY KEY (cod_reserva, CI_chofer),
    FOREIGN KEY (cod_reserva) REFERENCES Reserva(cod_reserva),
    FOREIGN KEY (CI_chofer) REFERENCES chofer(CI)
);




-- Tabla tienen
CREATE TABLE tienen (
    matricula VARCHAR(9),
    cod INT not null,
    fecha DATE not null,
    importe int(6) not null,
    descripcion varchar (255) not null,
    PRIMARY KEY (matricula, cod),
    FOREIGN KEY (matricula) REFERENCES coche(matricula),
    FOREIGN KEY (cod) REFERENCES mantenimiento_coche(cod)
);

-- Tabla necesita
CREATE TABLE necesita (
    cod_reserva INT,
    cod INT,
    PRIMARY KEY (cod_reserva),
    FOREIGN KEY (cod_reserva) REFERENCES Genera(cod_reserva),
    FOREIGN KEY (cod) REFERENCES metodo_de_pago(cod_pago)
);

-- Inserciones en la tabla Usuarios
-- Insert para la tabla Usuarios
INSERT INTO Usuarios (tipo, nom_usu, apellido, ci, contrasena, baja, estado) 
VALUES 
('Administrativo', 'Facundo', 'Vastakas', '5.619.104-3', 'facu123', true, true),
('Administrador', 'Emiliano', 'Mandacen', '5.531.976-5', '12345', true, true),
('Administrador', 'Marta', 'Capretti', '2.314.567-8', 'marta987', true, true),
('Administrativo', 'Natalia', 'Torres', '9.875.264-5', 'chilena1', true, true),
('Administrativo', 'Fernando', 'Pertierra', '5.577.427-2', 'tortu123', true, true);

-- Insert para la tabla Usuarios_tel
INSERT INTO Usuarios_tel (ci, tel) 
VALUES 
('5.619.104-3', '555-123-456'),
('5.531.976-5', '555-234-567'),
('5.577.427-2', '555-345-678'),
('2.314.567-8', '555-456-789'),
('9.875.264-5', '555-567-890');

-- Insert para la tabla Administrador
INSERT INTO Administrador (ci)
VALUES
('5.531.976-5'),
('2.314.567-8');

-- Insert para la tabla Administrativo
INSERT INTO Administrativo (ci)
VALUES
('5.577.427-2'),
('5.619.104-3'),
('9.875.264-5');

-- Inserciones en la tabla Crea
INSERT INTO Crea (cod_Usu, cod_Admin)
VALUES
    ('5.619.104-3', '5.531.976-5'),
    ('9.875.264-5', '2.314.567-8'),
    ('5.577.427-2', '5.531.976-5');

-- Inserciones en la tabla Empresa
INSERT INTO Empresa (RUT, nom_ficticio, razon_social)
VALUES
    ('1234567890', 'Empresa A', 'Empresa A S.A.'),
    ('9876543210', 'Empresa B', 'Empresa B S.A.'),
    ('5555555555', 'Empresa C', 'Empresa C S.A.'),
    ('1111111111', 'Empresa D', 'Empresa D S.A.'),
    ('9999999999', 'Empresa E', 'Empresa E S.A.'),
    ('7777777777', 'Empresa F', 'Empresa F S.A.'),
    ('8888888888', 'Empresa G', 'Empresa G S.A.'),
    ('6666666666', 'Empresa H', 'Empresa H S.A.'),
    ('2222222222', 'Empresa I', 'Empresa I S.A.'),
    ('4444444444', 'Empresa J', 'Empresa J S.A.');


-- Insertar datos ficticios en la tabla empresa_tel
INSERT INTO empresa_tel (RUT, tel)
VALUES
    ('1234567890', '123-456-890'),
    ('9876543210', '987-654-210'),
    ('5555555555', '555-555-555'),
    ('1111111111', '111-111-111'),
    ('9999999999', '999-999-999'),
    ('7777777777', '777-777-777'),
    ('8888888888', '888-888-888'),
    ('6666666666', '666-666-666'),
    ('2222222222', '222-222-222'),
    ('4444444444', '444-444-444');


-- Inserciones en la tabla Empresa_direccion, usando los mismos RUT
INSERT INTO Empresa_direccion (RUT, calle, n_puerta, Esquina)
VALUES
    ('1234567890', 'Calle A', '123', 'Esquina A'),
    ('9876543210', 'Calle B', '456', 'Esquina B'),
    ('5555555555', 'Calle C', '789', 'Esquina C'),
    ('1111111111', 'Calle D', '101', 'Esquina D'),
    ('9999999999', 'Calle E', '202', 'Esquina E'),
    ('7777777777', 'Calle F', '303', 'Esquina F'),
    ('8888888888', 'Calle G', '404', 'Esquina G'),
    ('6666666666', 'Calle H', '505', 'Esquina H'),
    ('2222222222', 'Calle I', '606', 'Esquina I'),
    ('4444444444', 'Calle J', '707', 'Esquina J');

-- Inserciones en la tabla coche
INSERT INTO coche (matricula, marca, modelo, c_pasajeros, n_padron, baja, seguro_coche)
VALUES
    ('SRE1234', 'Ford', 'Focus', 5, '1234567', 1, 'total'),
    ('SRE9678', 'Toyota', 'Corolla', 4, '9876543', 1, 'parcial'),
    ('SRE4321', 'Chevrolet', 'Cruze', 5, '2345678', 1, 'por terceros'),
    ('SRE5678', 'Honda', 'Civic', 4, '7890123', 1, 'parcial'),
    ('SRE7890', 'Volkswagen', 'Jetta', 5, '3456789', 1, 'total');

-- Inserciones en la tabla chofer
INSERT INTO chofer (CI, nombre, apellido, c_salud, tipo, fecha_de_vencimiento_libreta_conducir, matricula)
VALUES
    ('1.234.567-8', 'Juan', 'Pérez', '2024-10-01', 'particular', '2025-05-15', 'SRE1234'),
    ('8.765.432-1', 'María', 'González', '2025-03-15', 'contratado', '2024-12-10', 'SRE9678'),
    ('9.876.543-2', 'Pedro', 'López', '2024-11-20', 'particular', '2025-09-30', 'SRE4321'),
    ('2.345.678-9', 'Ana', 'Martínez', '2024-10-05', 'contratado', '2025-06-20', 'SRE5678'),
    ('3.456.789-0', 'Carlos', 'Rodríguez', '2025-01-12', 'particular', '2024-08-25', 'SRE7890');

-- Inserciones en la tabla Reserva
INSERT INTO Reserva (comentario, destino, origen, hora, fecha,tipo ,costo, baja)
VALUES
    ('Comentario1', 'Destino1', 'Origen1', '120000', '2024-05-01','Empresa', 100, TRUE),
    ('Comentario2', 'Destino2', 'Origen2', '143000', '2023-09-01','Empresa', 150, TRUE),
    ('Comentario3', 'Destino3', 'Origen3', '164500', '2023-08-13','Empresa', 120, TRUE),
    ('Comentario4', 'Destino4', 'Origen4', '091500', '2023-08-24','Empresa', 200, TRUE),
    ('Comentario5', 'Destino5', 'Origen5', '113000', '2023-08-04','Empresa', 180, TRUE),
    ('Comentario6', 'Destino6', 'Origen6', '132000', '2022-12-6','Particular', 130, TRUE),
    ('Comentario7', 'Destino7', 'Origen7', '151000', '2022-05-07','Particular', 170, TRUE),
    ('Comentario8', 'Destino8', 'Origen8', '170000', '2023-02-08','Particular', 190, TRUE),
    ('Comentario9', 'Destino9', 'Origen9', '183000', '2024-04-09','Particular', 140, TRUE),
    ('Comentario10', 'Destino10', 'Origen10', '201500', '2333-08-10','Particular', 160, TRUE);

-- Inserciones en la tabla Reserva_pasajero
INSERT INTO Reserva_pasajero (cod_reserva, Nombre, Apellido, tel)
VALUES
    (1, 'Pasajero1', 'Apellido1', '1111111111'),
    (2, 'Pasajero2', 'Apellido2', '1111111111'),
    (3, 'Pasajero3', 'Apellido3', '3333333333'),
    (4, 'Pasajero4', 'Apellido4', '4444444444'),
    (5, 'Pasajero5', 'Apellido5', '5555555555'),
    (6, 'Pasajero6', 'Apellido6', '6666666666'),
    (7, 'Pasajero7', 'Apellido7', '7777777777'),
    (8, 'Pasajero8', 'Apellido8', '8888888888'),
    (9, 'Pasajero9', 'Apellido9', '9999999999'),
    (10, 'Pasajero10', 'Apellido10', '0000000000');


    


-- Inserciones en la tabla chofer_tel
INSERT INTO chofer_tel (CI, tel)
VALUES
    ('1.234.567-8', '093-234-567'),
    ('8.765.432-1', '093-876-543'),
    ('9.876.543-2', '093-345-678'),
    ('2.345.678-9', '093-890-123'),
    ('3.456.789-0', '093-456-789');

-- Inserciones en la tabla mantenimiento_coche

INSERT INTO mantenimiento_coche (concepto)
VALUES
    ('GASOIL'),
    ('CAMBIO ACEITE'),
    ('ELECTRICISTA'),
    ('ALINEACIÓN Y BALANCEO'),
    ('CAMBIO DE CUBIERTA');


-- Inserciones en la tabla metodo_de_pago
INSERT INTO metodo_de_pago (cod_pago)
VALUES
    (1),
    (2),
    (3),
    (4),
    (5),
    (6),
    (7),
    (8),
    (9),
    (10);

-- Inserciones en la tabla Transferencia
INSERT INTO Transferencia (cod_pago, num_cuenta)
VALUES
    (1, '1111111111'),
    (2, '2222222222'),
    (3, '3333333333'),
    (4, '4444444444'),
    (5, '5555555555'),
    (6, '6666666666'),
    (7, '7777777777'),
    (8, '8888888888'),
    (9, '9999999999'),
    (10, '0000000000');

-- Inserciones en la tabla Contado
INSERT INTO Contado (cod_pago)
VALUES
    (1),
    (2),
    (3),
    (4),
    (5),
    (6),
    (7),
    (8),
    (9),
    (10);

-- Inserciones en la tabla Tarjeta
INSERT INTO Tarjeta (cod_pago, num_tarjeta)
VALUES
    (1, '1111111111111111111111'),
    (2, '2222222222222222222222'),
    (3, '3333333333333333333333'),
    (4, '4444444444444444444444'),
    (5, '5555555555555555555555'),
    (6, '6666666666666666666666'),
    (7, '7777777777777777777777'),
    (8, '8888888888888888888888'),
    (9, '9999999999999999999999'),
    (10, '0000000000000000000000');

-- Inserciones en la tabla Cuenta_corriente
INSERT INTO Cuenta_corriente (cod_pago, cod_cuenta)
VALUES
    (1, 101),
    (2, 102),
    (3, 103),
    (4, 104),
    (5, 105),
    (6, 106),
    (7, 107),
    (8, 108),
    (9, 109),
    (10, 110);
    
-- Inserciones en la tabla Controla
INSERT INTO Controla (cod, cod_reserva)
VALUES
    ('5.619.104-3', 1),
    ('5.531.976-5', 2),
    ('5.577.427-2', 3),
    ('2.314.567-8', 4),
    ('9.875.264-5', 5),
    ('5.619.104-3', 6),
    ('5.531.976-5', 7),
    ('5.577.427-2', 8),
    ('2.314.567-8', 9),
    ('9.875.264-5', 10);

-- Inserciones en la tabla Genera
INSERT INTO Genera (RUT, cod_reserva)
VALUES
    ('1234567890', 1),
    ('9876543210', 2),
    ('5555555555', 3),
    ('1111111111', 4),
    ('9999999999', 5),
    ('7777777777', 6),
    ('8888888888', 7),
    ('6666666666', 8),
    ('2222222222', 9),
    ('4444444444', 10);

-- Inserciones en la tabla Precisa
INSERT INTO Precisa (cod_reserva, CI_chofer)
VALUES
    (1, '1.234.567-8'),
    (2, '1.234.567-8'),
    (3, '3.456.789-0'),
    (4, '1.234.567-8'),
    (5, '1.234.567-8'),
    (6, '8.765.432-1'),
    (7, '8.765.432-1'),
    (8, '8.765.432-1'),
    (9, '9.876.543-2'),
    (10, '2.345.678-9');

-- Inserciones en la tabla tienen
INSERT INTO tienen (matricula, cod, fecha, importe, descripcion)
VALUES
    ('SRE1234', 1, '2023-10-10', 150, 'Cambio de aceite y filtros'),
    ('SRE9678', 2, '2023-09-20', 200, 'Reparación eléctrica'),
    ('SRE4321', 3, '2023-08-15', 100, 'Alineación y balanceo'),
    ('SRE5678', 4, '2023-07-25', 300, 'Cambio de cubiertas'),
    ('SRE7890', 5, '2023-06-30', 120, 'Revisión de frenos');

-- Inserciones en la tabla necesita
INSERT INTO necesita (cod_reserva, cod)
VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 6),
    (7, 7),
    (8, 8),
    (9, 9),
    (10, 10);

-- Inserciones en la tabla poseen
INSERT INTO poseen (RUT, cod_cuenta, cod_pago, saldo)
VALUES
    ('1234567890', 101, 1, 50000),
    ('9876543210', 102, 2, 60000),
    ('5555555555', 103, 3, 70000),
    ('1111111111', 104, 4, 80000),
    ('9999999999', 105, 5, 90000),
    ('7777777777', 106, 6, 100000),
    ('8888888888', 107, 7, 110000),
    ('6666666666', 108, 8, 120000),
    ('2222222222', 109, 9, 130000),
    ('4444444444', 110, 10, 140000);



-- CREATE USER 'superuser'@'localhost' IDENTIFIED BY 'password';
-- GRANT ALL PRIVILEGES ON . TO 'superuser'@'localhost' WITH GRANT OPTION;

-- CREATE USER 'db_admin'@'localhost' IDENTIFIED BY 'password';
-- GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, ALTER, CREATE TEMPORARY TABLES ON . TO 'db_admin'@'localhost';

-- CREATE USER 'security_user'@'localhost' IDENTIFIED BY 'password';
-- GRANT CREATE USER, ALTER, DROP ON . TO 'security_user'@'localhost';
-- GRANT GRANT OPTION ON . TO 'security_user'@'localhost';

-- CREATE USER 'backup_user'@'localhost' IDENTIFIED BY 'password';
-- GRANT BACKUP_ADMIN, RELOAD, PROCESS, LOCK TABLES, EVENT, RELOAD, SHOW databases, SELECT ON . TO 'backup_user'@'localhost';

-- CREATE USER 'lectura_user'@'localhost' IDENTIFIED BY 'password';
-- GRANT SELECT ON `app_database`. TO 'lectura_user'@'localhost';
select r.*, p.*,g.* from reserva r
join reserva_pasajero p on p.cod_reserva= r.cod_reserva
join genera g on g.cod_reserva=r.cod_reserva;

-- Empleados
select * from Usuarios u
ORDER BY u.tipo,u.nom_usu,u.apellido,u.ci;

SELECT u.tipo, u.nom_usu, u.apellido, u.ci, u.contrasena, t.tel
FROM Usuarios u
JOIN Usuarios_tel t ON u.ci = t.ci
ORDER BY u.tipo,u.nom_usu,u.apellido,u.ci,t.tel;


-- Facturación por auto
select sum(r.costo) as facturacion, c.matricula from Chofer c
join Precisa p on c.CI = p.CI_chofer
join Reserva r on p.cod_reserva = r.cod_reserva
group by c.matricula
order by facturacion desc;

-- Facturación por chofer
select sum(r.costo) as facturacion, c.CI from Chofer c
join Precisa p on c.CI = p.CI_chofer
join Reserva r on p.cod_reserva = r.cod_reserva
group by c.CI
order by facturacion desc;

-- Datos de los viajes de un cliente determinado
select r.cod_reserva, r.comentario, r.destino, r.hora, r.fecha, r.hora, p.Nombre, p.Apellido, p.tel from Reserva r
join Reserva_pasajero p on r.cod_reserva = p.cod_reserva
where p.tel = '1111111111';

-- Datos de un viaje determinado
select r.cod_reserva, r.comentario, r.destino, r.hora, r.fecha, r.hora, p.Nombre, p.Apellido, p.tel  from Reserva r
join Reserva_pasajero p on r.cod_reserva = p.cod_reserva
where r.cod_reserva = '5';

-- Datos de los últimos 5 viajes realizados
select r.cod_reserva, r.comentario, r.destino, r.hora, r.fecha, r.hora, p.Nombre, p.Apellido, p.tel  from Reserva r
join Reserva_pasajero p on r.cod_reserva = p.cod_reserva
order by r.fecha desc
limit 5;

-- Búsqueda de viajes por fecha
select r.cod_reserva, r.comentario, r.destino, r.hora, r.fecha, r.hora, p.Nombre, p.Apellido, p.tel  from Reserva r
join Reserva_pasajero p on r.cod_reserva = p.cod_reserva
where r.fecha = '2023-08-04';

-- Consultas realizadas para hacer un login efectivo
-- SELECT  FROM Usuarios WHERE ci = '$ci' AND contrasena = '$contrasena;

-- Total de facturación diario, mensual y anual.
SELECT fecha, SUM(costo) AS facturacion_diaria
FROM Reserva
WHERE baja = FALSE
GROUP BY fecha
ORDER BY fecha;

-- Total de facturación mensual
SELECT DATE_FORMAT(fecha, '%Y-%m') AS mensual, SUM(costo) AS facturacion_mensual
FROM Reserva
WHERE baja = FALSE
GROUP BY mensual
ORDER BY mensual;

-- Total de facturación anual
SELECT DATE_FORMAT(fecha, '%Y') AS anual, SUM(costo) AS facturacion_anual
FROM Reserva
WHERE baja = FALSE
GROUP BY anual
ORDER BY anual;

describe Usuarios;

-- Cantidad de viajes realizados por cada chofer entre dos fechas.
select count(cod_reserva) as cantidad from Reserva r
where r.fecha BETWEEN '2022-01-01' AND '2024-01-01';





