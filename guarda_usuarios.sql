drop database clinica;

create database clinica;

use clinica;

create table if not exists registro_empleado(
id_empleado int(11) unsigned not null AUTO_INCREMENT,
rango varchar(45) NOT NULL,
nombre varchar(50) NOT NULL,
username varchar(50) NOT NULL,
correo varchar(45) NOT NULL,
cedula int(10) NOT NULL,
clave varchar(45) NOT NULL,
primary key (id_empleado)
);

create table if not exists registro_paciente(
id_paciente int(11) unsigned not null AUTO_INCREMENT,
nombre_enfermero varchar(45) NOT NULL,
correo_enfermero varchar(45) NOT NULL,
cedula_enfermero int(10) NOT NULL,
nombre_paciente varchar(50) NOT NULL,
correo_paciente varchar(45) NOT NULL,
cedula_paciente int(10) NOT NULL,
tipo_examen varchar(30) NOT NULL,
estado varchar(10)  NOT NULL,
primary key (id_paciente)
);

create table if not exists respuesta_informe(
id_informe int(11) unsigned not null AUTO_INCREMENT,
nombre_enfermero varchar(45) NOT NULL,
correo_enfermero varchar(45) NOT NULL,
cedula_enfermero int(10) NOT NULL,
nombre_medico varchar(45) NOT NULL,
correo_medico varchar(45) NOT NULL,
cedula_medico int(10) NOT NULL,
id_paciente int(11) NOT NULL,
nombre_paciente varchar(50) NOT NULL,
correo_paciente varchar(45) NOT NULL,
cedula_paciente int(10) NOT NULL,
tipo_examen varchar(30) NOT NULL,
diagnostico varchar(100) NOT NULL,
estado_envio varchar(10) NOT NULL,
primary key (id_informe)
);