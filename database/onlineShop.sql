DROP DATABASE IF EXISTS onlineShop;
CREATE DATABASE onlineShop;
USE onlineShop;

create table usuarios (
id_usu INT AUTO_INCREMENT PRIMARY KEY,
nombre varchar(20),
apellido1 varchar(20),
apellido2 varchar(20),
pass varchar(30));

create table productos (
id_pro INT AUTO_INCREMENT PRIMARY KEY,
nombre varchar(30),
plataforma varchar(20),
categoria varchar(20),
precio varchar(10));

create table compra (
id_pro INT PRIMARY KEY,
id_usu INT,
cantidad INT,
FOREIGN KEY (id_usu) REFERENCES usuarios (id_usu)
ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY (id_pro) REFERENCES productos (id_pro)
ON DELETE RESTRICT ON UPDATE CASCADE);
