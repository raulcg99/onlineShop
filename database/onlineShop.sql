DROP DATABASE IF EXISTS onlineShop;
CREATE DATABASE onlineShop;
USE onlineShop;

create table usuarios (
id_usu INT AUTO_INCREMENT PRIMARY KEY,
nombre varchar(40),
email varchar(30),
pass varchar(30),
rol varchar(10));

create table productos (
id_pro INT AUTO_INCREMENT PRIMARY KEY,
nombre varchar(30),
plataforma varchar(20),
precio decimal(5,2),
imagen varchar(50));

create table pedidos (
id_pedido INT AUTO_INCREMENT PRIMARY KEY,
clave_transaccion varchar(250),
correo varchar(30),
paypal_datos text,
total decimal(60,2),
estatus varchar(20));

create table linea_pedido (
id INT AUTO_INCREMENT PRIMARY KEY,
id_pro INT,
id_pedido INT,
cantidad INT,
precio decimal(20,2),
FOREIGN KEY (id_pedido) REFERENCES pedidos (id_pedido)
ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY (id_pro) REFERENCES productos (id_pro)
ON DELETE RESTRICT ON UPDATE CASCADE);

create table hace (
id_usu INT PRIMARY KEY,
id_pedido INT,
fecha date,
forma_pago varchar(30),
FOREIGN KEY (id_pedido) REFERENCES pedidos (id_pedido)
ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY (id_usu) REFERENCES usuarios (id_usu)
ON DELETE RESTRICT ON UPDATE CASCADE);

insert into productos (nombre,plataforma,precio,imagen) values ('Animal Crossing: NH','Nintendo Switch',54.99,'img/AC.jpg');
insert into productos (nombre,plataforma,precio,imagen) values ('Persona 5: Royal','PS4',64.99,'img/P5.jpg');
insert into productos (nombre,plataforma,precio,imagen) values ('Gears 5','Xbox One',59.99,'img/gears5.jpg');
insert into productos (nombre,plataforma,precio,imagen) values ('Xenoblade Chronicles','Nintendo Switch',69.99,'img/xeno.jpg');
select * from usuarios;
insert into usuarios (nombre,pass,email,rol) values ('admin','1234','admin@gmail.com','admin');
