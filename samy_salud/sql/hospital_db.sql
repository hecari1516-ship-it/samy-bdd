-- ============================================
-- Hospital "SaMy Salud Integral"
-- Script de creación de base de datos
-- ============================================

CREATE DATABASE IF NOT EXISTS hospital_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE hospital_db;

-- Tabla de usuarios (login por roles)
CREATE TABLE IF NOT EXISTS usuarios (
  id_usuario  INT AUTO_INCREMENT PRIMARY KEY,
  usuario     VARCHAR(40)  NOT NULL UNIQUE,
  password    VARCHAR(255) NOT NULL,
  rol         ENUM('Administrador','Medico') NOT NULL
);

-- El primer usuario Administrador se crea ejecutando crear_admin.php una sola vez
-- (genera correctamente el hash de la contraseña con password_hash de PHP).

-- Tabla de pacientes
CREATE TABLE IF NOT EXISTS pacientes (
  id_paciente      INT AUTO_INCREMENT PRIMARY KEY,
  nombre           VARCHAR(60)  NOT NULL,
  apellido         VARCHAR(60)  NOT NULL,
  fecha_nacimiento DATE         NOT NULL,
  sexo             ENUM('M','F','Otro') NOT NULL,
  telefono         VARCHAR(15),
  direccion        VARCHAR(150),
  tipo_sangre      VARCHAR(5),
  fecha_registro   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de doctores
CREATE TABLE IF NOT EXISTS doctores (
  id_doctor     INT AUTO_INCREMENT PRIMARY KEY,
  nombre        VARCHAR(60) NOT NULL,
  apellido      VARCHAR(60) NOT NULL,
  especialidad  VARCHAR(60),
  telefono      VARCHAR(15),
  cedula_prof   VARCHAR(20)
);

-- Tabla de habitaciones
CREATE TABLE IF NOT EXISTS habitaciones (
  id_habitacion INT AUTO_INCREMENT PRIMARY KEY,
  numero        VARCHAR(10) NOT NULL,
  tipo          ENUM('General','Privada','Terapia Intensiva','Urgencias') NOT NULL,
  estado        ENUM('Disponible','Ocupada','Mantenimiento') NOT NULL DEFAULT 'Disponible'
);

-- Tabla de citas
CREATE TABLE IF NOT EXISTS citas (
  id_cita        INT AUTO_INCREMENT PRIMARY KEY,
  id_paciente    INT NOT NULL,
  id_doctor      INT NOT NULL,
  id_habitacion  INT NOT NULL,
  fecha_cita     DATETIME NOT NULL,
  motivo         VARCHAR(150),
  estado         ENUM('Programada','Atendida','Cancelada') NOT NULL DEFAULT 'Programada',
  FOREIGN KEY (id_paciente)   REFERENCES pacientes(id_paciente),
  FOREIGN KEY (id_doctor)     REFERENCES doctores(id_doctor),
  FOREIGN KEY (id_habitacion) REFERENCES habitaciones(id_habitacion)
);

-- Tabla de recetas
CREATE TABLE IF NOT EXISTS recetas (
  id_receta     INT AUTO_INCREMENT PRIMARY KEY,
  id_cita       INT NOT NULL,
  medicamento   VARCHAR(100) NOT NULL,
  dosis         VARCHAR(60),
  indicaciones  VARCHAR(200),
  FOREIGN KEY (id_cita) REFERENCES citas(id_cita)
);
