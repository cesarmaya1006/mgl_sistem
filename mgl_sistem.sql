-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: mgl_sistem
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `config_apariencia`
--

DROP TABLE IF EXISTS `config_apariencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_apariencia` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `config_empresa_id` bigint unsigned DEFAULT NULL,
  `body_dark_mode` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `encabezado_fijo` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `dropdown_legacy` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `border_bottom` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sidebar_collapse` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sidebar_fixed_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sidebar_mini_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sidebar_mini_md_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sidebar_mini_xs_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `flat_sidebar_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `legacy_sidebar_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `compact_sidebar_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `child_indent_sidebar_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `child_hide_sidebar_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `no_expand_sidebar_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `footer_fixed_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `text_sm_body_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `text_sm_header_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `text_sm_brand_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `text_sm_sidebar_container` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `text_sm_footer_checkbox` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `fondo_barra_sup` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `fondo_barra_lat` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_crm_config_empresa_apariencia` (`config_empresa_id`),
  CONSTRAINT `fk_crm_config_empresa_apariencia` FOREIGN KEY (`config_empresa_id`) REFERENCES `config_empresa` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_apariencia`
--

LOCK TABLES `config_apariencia` WRITE;
/*!40000 ALTER TABLE `config_apariencia` DISABLE KEYS */;
INSERT INTO `config_apariencia` VALUES (1,NULL,'no','no','no','no','no','si','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no','navbar-light','','2024-04-04 03:43:33','2024-04-04 03:44:07'),(2,1,'no','no','no','no','no','si','si','no','no','no','no','no','no','no','no','no','no','no','no','no','no','','','2024-04-04 03:43:34',NULL);
/*!40000 ALTER TABLE `config_apariencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_empresa`
--

DROP TABLE IF EXISTS `config_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_empresa` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `config_grupo_empresas_id` bigint unsigned NOT NULL,
  `config_tipo_documento_id` bigint unsigned NOT NULL,
  `identificacion` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombres` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `contacto` varchar(200) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `cargo` varchar(200) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `estado` bigint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `config_empresa_identificacion_unique` (`identificacion`),
  UNIQUE KEY `config_empresa_email_unique` (`email`),
  KEY `fk_crm_empresa_config_grupo_empresas` (`config_grupo_empresas_id`),
  KEY `fk_crm_empresas_config_tipo_documento` (`config_tipo_documento_id`),
  CONSTRAINT `fk_crm_empresa_config_grupo_empresas` FOREIGN KEY (`config_grupo_empresas_id`) REFERENCES `config_grupo_empresas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_crm_empresas_config_tipo_documento` FOREIGN KEY (`config_tipo_documento_id`) REFERENCES `config_tipo_documento` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_empresa`
--

LOCK TABLES `config_empresa` WRITE;
/*!40000 ALTER TABLE `config_empresa` DISABLE KEYS */;
INSERT INTO `config_empresa` VALUES (1,1,6,'333222111','Empresa de Prueba','prueba@gmail.com','987654321','Calle de prueba 123','Contacto prueba','Cargo de prueba',1,'2024-04-04 03:43:33',NULL);
/*!40000 ALTER TABLE `config_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_grupo_empresas`
--

DROP TABLE IF EXISTS `config_grupo_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_grupo_empresas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `config_tipo_documento_id` bigint unsigned NOT NULL,
  `identificacion` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombres` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `contacto` varchar(200) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `cargo` varchar(200) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `estado` bigint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `config_grupo_empresas_identificacion_unique` (`identificacion`),
  UNIQUE KEY `config_grupo_empresas_email_unique` (`email`),
  KEY `fk_crm_grupo_empresas_config_tipo_documento` (`config_tipo_documento_id`),
  CONSTRAINT `fk_crm_grupo_empresas_config_tipo_documento` FOREIGN KEY (`config_tipo_documento_id`) REFERENCES `config_tipo_documento` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_grupo_empresas`
--

LOCK TABLES `config_grupo_empresas` WRITE;
/*!40000 ALTER TABLE `config_grupo_empresas` DISABLE KEYS */;
INSERT INTO `config_grupo_empresas` VALUES (1,6,'333222111','Grupo de Prueba','prueba@gmail.com','987654321','Calle de prueba 123','Contacto prueba','Cargo de prueba',1,'2024-04-04 03:43:33',NULL);
/*!40000 ALTER TABLE `config_grupo_empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_menu`
--

DROP TABLE IF EXISTS `config_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_menu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `config_menu_id` bigint unsigned DEFAULT NULL,
  `nombre` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `url` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `orden` bigint unsigned NOT NULL DEFAULT '1',
  `icono` varchar(50) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_menu`
--

LOCK TABLES `config_menu` WRITE;
/*!40000 ALTER TABLE `config_menu` DISABLE KEYS */;
INSERT INTO `config_menu` VALUES (1,NULL,'Dashboard','dashboard',1,'mdi mdi-view-dashboard','2024-04-04 03:43:33',NULL),(2,NULL,'Configuración Sistema','#',2,'fas fa-cogs','2024-04-04 03:43:33',NULL),(3,2,'Menús','dashboard/configuracion_sis/menu',1,'fas fa-list-ul','2024-04-04 03:43:33',NULL),(4,2,'Roles','dashboard/configuracion_sis/rol',2,'fas fa-users','2024-04-04 03:43:33',NULL),(5,2,'Menú - Roles','dashboard/configuracion_sis/permisos_menus_rol',3,'fas fa-chalkboard-teacher','2024-04-04 03:43:33',NULL),(6,2,'Grupo Empresas','dashboard/configuracion_sis/grupo_empresas',4,'fas fa-industry','2024-04-04 03:43:33',NULL),(7,2,'Empresas','dashboard/configuracion_sis/empresas',5,'fas fa-building','2024-04-04 03:43:33',NULL),(8,NULL,'Configuración','#',3,'fas fa-cogs','2024-04-04 03:43:33',NULL),(9,8,'Organigrama','#',1,'fas fa-sitemap','2024-04-04 03:43:33',NULL),(10,9,'Áreas','dashboard/configuracion/areas',1,'fas fa-project-diagram','2024-04-04 03:43:33',NULL),(11,9,'Cargos','dashboard/configuracion/cargos',2,'fas fa-user-tie','2024-04-04 03:43:33',NULL),(12,9,'Empleados','dashboard/configuracion/empleados',3,'fas fa-users','2024-04-04 03:43:33',NULL),(13,NULL,'Módulo Jurídico','#',4,'fas fa-balance-scale','2024-04-04 03:43:33',NULL),(14,13,'Parametrización','#',1,'fas fa-indent','2024-04-04 03:43:33',NULL),(15,14,'Parámetros Juzgados','#',1,'fas fa-balance-scale','2024-04-04 03:43:33',NULL),(16,15,'Jurisdiccion Juzgados','dashboard/modulo-juridico/param-juzgados/jurisdiccion-juzgados',1,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(17,15,'Departamentos Juzgados','dashboard/modulo-juridico/param-juzgados/departamentos-juzgados',2,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(18,15,'Distritos Juzgados','dashboard/modulo-juridico/param-juzgados/distritos-juzgados',3,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(19,15,'Circuitos Juzgados','dashboard/modulo-juridico/param-juzgados/circuitos-juzgados',4,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(20,15,'Municipios Juzgados','dashboard/modulo-juridico/param-juzgados/circuitos-juzgados',5,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(21,15,'Juzgados','dashboard/modulo-juridico/param-juzgados/juzgados',6,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(22,14,'Parámetros Procesos','#',2,'fas fa-copy','2024-04-04 03:43:33',NULL),(23,22,'Tipos de Procesos','dashboard/modulo-juridico/param-procesos/tipos-procesos',1,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(24,22,'Papel Cliente','dashboard/modulo-juridico/param-procesos/papel-cliente',2,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(25,22,'Estado Procesos','dashboard/modulo-juridico/param-procesos/estado-procesos',3,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(26,22,'Etapa Procesos','dashboard/modulo-juridico/param-procesos/etapa-procesos',4,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(27,22,'Riesgo Perdida Procesos','dashboard/modulo-juridico/param-procesos/riesgo-procesos',5,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(28,22,'Sentidos de Fallo Procesos','dashboard/modulo-juridico/param-procesos/sentido-fallo-procesos',6,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(29,22,'Terminación Anormal Procesos','dashboard/modulo-juridico/param-procesos/terminacion-anormal-procesos',7,'fas fa-caret-right','2024-04-04 03:43:33',NULL),(30,13,'Procesos','dashboard/modulo-juridico/procesos',2,'fas fa-gavel','2024-04-04 03:43:33',NULL),(31,NULL,'Módulo Archivo','dashboard/modulo-archivo',5,'far fa-folder-open','2024-04-04 03:43:33',NULL),(32,NULL,'Módulo proyectos','dashboard/modulo-proyectos',6,'fas fa-project-diagram','2024-04-04 03:43:33',NULL),(33,NULL,'Noticias','dashboard/noticias',7,'fas fa-newspaper','2024-04-04 03:43:33',NULL),(34,NULL,'Diagnósticos Legales','dashboard/diagnosticos',8,'fas fa-chart-line','2024-04-04 03:43:33',NULL),(35,NULL,'Consultas / Solicitudes','dashboard/solicitudes',9,'far fa-hand-paper','2024-04-04 03:43:33',NULL);
/*!40000 ALTER TABLE `config_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_menu_rol`
--

DROP TABLE IF EXISTS `config_menu_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_menu_rol` (
  `config_menu_id` bigint unsigned NOT NULL,
  `config_rol_id` bigint unsigned NOT NULL,
  UNIQUE KEY `cmr_unico` (`config_menu_id`,`config_rol_id`),
  KEY `fk_cmr_configrol` (`config_rol_id`),
  CONSTRAINT `fk_cmr_configmenu` FOREIGN KEY (`config_menu_id`) REFERENCES `config_menu` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_cmr_configrol` FOREIGN KEY (`config_rol_id`) REFERENCES `config_rol` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_menu_rol`
--

LOCK TABLES `config_menu_rol` WRITE;
/*!40000 ALTER TABLE `config_menu_rol` DISABLE KEYS */;
INSERT INTO `config_menu_rol` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1);
/*!40000 ALTER TABLE `config_menu_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_permiso`
--

DROP TABLE IF EXISTS `config_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_permiso` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_permiso`
--

LOCK TABLES `config_permiso` WRITE;
/*!40000 ALTER TABLE `config_permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `config_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_rol`
--

DROP TABLE IF EXISTS `config_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_rol` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `config_rol_nombre_unique` (`nombre`),
  UNIQUE KEY `config_rol_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_rol`
--

LOCK TABLES `config_rol` WRITE;
/*!40000 ALTER TABLE `config_rol` DISABLE KEYS */;
INSERT INTO `config_rol` VALUES (1,'Super Administrador','superadmin','2024-04-04 03:43:33',NULL),(2,'Administrador','admin','2024-04-04 03:43:33',NULL),(3,'Administrador Empresa','adminempresa','2024-04-04 03:43:33',NULL),(4,'Empleado','empleado','2024-04-04 03:43:33',NULL);
/*!40000 ALTER TABLE `config_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_rol_permiso`
--

DROP TABLE IF EXISTS `config_rol_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_rol_permiso` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_rol_permiso`
--

LOCK TABLES `config_rol_permiso` WRITE;
/*!40000 ALTER TABLE `config_rol_permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `config_rol_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_tipo_documento`
--

DROP TABLE IF EXISTS `config_tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_tipo_documento` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `abreb_id` varchar(10) COLLATE utf8mb3_spanish_ci NOT NULL,
  `tipo_id` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_tipo_documento`
--

LOCK TABLES `config_tipo_documento` WRITE;
/*!40000 ALTER TABLE `config_tipo_documento` DISABLE KEYS */;
INSERT INTO `config_tipo_documento` VALUES (1,'CC','Cedula de ciudadania','2024-04-04 03:43:33',NULL),(2,'CE','Cedula de extranjeria','2024-04-04 03:43:33',NULL),(3,'PA','Pasaporte','2024-04-04 03:43:33',NULL),(4,'RC','Registro Civil','2024-04-04 03:43:33',NULL),(5,'TI','Tarjeta de identidad','2024-04-04 03:43:33',NULL),(6,'NIT','Num Identif Tributaria','2024-04-04 03:43:33',NULL),(7,'PEP','Permiso Especial de Permanencia','2024-04-04 03:43:33',NULL),(8,'TMF','Tarjeta de Movilidad Fronteriza','2024-04-04 03:43:33',NULL);
/*!40000 ALTER TABLE `config_tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_usuario`
--

DROP TABLE IF EXISTS `config_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_usuario` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `config_tipo_documento_id` bigint unsigned DEFAULT NULL,
  `config_empresa_id` bigint unsigned DEFAULT NULL,
  `identificacion` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `nombres` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `password` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb3_spanish_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb3_spanish_ci,
  `camb_password` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `foto` varchar(255) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'usuario-inicial.jpg',
  `remember_token` varchar(100) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `config_usuario_email_unique` (`email`),
  UNIQUE KEY `config_usuario_identificacion_unique` (`identificacion`),
  KEY `fk_mrc_config_tipo_documento_usuario` (`config_tipo_documento_id`),
  KEY `fk_crm_config_empresa_usuario` (`config_empresa_id`),
  CONSTRAINT `fk_crm_config_empresa_usuario` FOREIGN KEY (`config_empresa_id`) REFERENCES `config_empresa` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_mrc_config_tipo_documento_usuario` FOREIGN KEY (`config_tipo_documento_id`) REFERENCES `config_tipo_documento` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_usuario`
--

LOCK TABLES `config_usuario` WRITE;
/*!40000 ALTER TABLE `config_usuario` DISABLE KEYS */;
INSERT INTO `config_usuario` VALUES (1,NULL,NULL,NULL,'Super Administrador',NULL,'superadmin1006@gmail.com',NULL,'$2y$12$iPmAZO3m0EwvdL6Ash2SgOsZUS7Hj2YNYvnHcLwTLXYrT5K9ofoda',NULL,NULL,NULL,0,NULL,1,'usuario-inicial.jpg',NULL,'2024-04-04 03:43:34','2024-04-04 03:43:34');
/*!40000 ALTER TABLE `config_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_usuario_rol`
--

DROP TABLE IF EXISTS `config_usuario_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config_usuario_rol` (
  `config_rol_id` bigint unsigned NOT NULL,
  `config_usuario_id` bigint unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `fk_mcr_config_rol_usuario` (`config_rol_id`),
  KEY `fk_mcr_config_usuario_rol` (`config_usuario_id`),
  CONSTRAINT `fk_mcr_config_rol_usuario` FOREIGN KEY (`config_rol_id`) REFERENCES `config_rol` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_mcr_config_usuario_rol` FOREIGN KEY (`config_usuario_id`) REFERENCES `config_usuario` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_usuario_rol`
--

LOCK TABLES `config_usuario_rol` WRITE;
/*!40000 ALTER TABLE `config_usuario_rol` DISABLE KEYS */;
INSERT INTO `config_usuario_rol` VALUES (1,1,1,NULL,NULL),(1,1,1,NULL,NULL);
/*!40000 ALTER TABLE `config_usuario_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa_area`
--

DROP TABLE IF EXISTS `empresa_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa_area` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `empresa_area_id` bigint unsigned DEFAULT NULL,
  `config_empresa_id` bigint unsigned NOT NULL,
  `area` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_crm_empresa_area_area` (`empresa_area_id`),
  KEY `fk_crm_area_config_empresa` (`config_empresa_id`),
  CONSTRAINT `fk_crm_area_config_empresa` FOREIGN KEY (`config_empresa_id`) REFERENCES `config_empresa` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_crm_empresa_area_area` FOREIGN KEY (`empresa_area_id`) REFERENCES `empresa_area` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa_area`
--

LOCK TABLES `empresa_area` WRITE;
/*!40000 ALTER TABLE `empresa_area` DISABLE KEYS */;
INSERT INTO `empresa_area` VALUES (1,NULL,1,'Gerencia','2024-04-04 03:43:34',NULL),(2,1,1,'Dirección Administrativa','2024-04-04 03:43:34',NULL),(3,1,1,'Dirección Técnica','2024-04-04 03:43:34',NULL),(4,1,1,'Dirección Operativa','2024-04-04 03:43:34',NULL);
/*!40000 ALTER TABLE `empresa_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa_cargo`
--

DROP TABLE IF EXISTS `empresa_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa_cargo` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `empresa_area_id` bigint unsigned DEFAULT NULL,
  `cargo` varchar(150) COLLATE utf8mb3_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_crm_empresa_area_cargo` (`empresa_area_id`),
  CONSTRAINT `fk_crm_empresa_area_cargo` FOREIGN KEY (`empresa_area_id`) REFERENCES `empresa_area` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa_cargo`
--

LOCK TABLES `empresa_cargo` WRITE;
/*!40000 ALTER TABLE `empresa_cargo` DISABLE KEYS */;
INSERT INTO `empresa_cargo` VALUES (1,1,'Gerente','2024-04-04 03:43:34',NULL),(2,2,'Director Administrativo','2024-04-04 03:43:34',NULL),(3,3,'Director Técnico','2024-04-04 03:43:34',NULL),(4,4,'Director Operativo','2024-04-04 03:43:34',NULL),(5,4,'Desarrollador','2024-04-04 03:43:34',NULL);
/*!40000 ALTER TABLE `empresa_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa_empleados`
--

DROP TABLE IF EXISTS `empresa_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa_empleados` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `empresa_cargo_id` bigint unsigned NOT NULL,
  `mgl` tinyint(1) NOT NULL DEFAULT '0',
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_crm_empresa_cargo_usuario` (`empresa_cargo_id`),
  CONSTRAINT `fk_crm_config_usuario_usuario` FOREIGN KEY (`id`) REFERENCES `config_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_crm_empresa_cargo_usuario` FOREIGN KEY (`empresa_cargo_id`) REFERENCES `empresa_cargo` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa_empleados`
--

LOCK TABLES `empresa_empleados` WRITE;
/*!40000 ALTER TABLE `empresa_empleados` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (181,'2014_10_12_000000_create_users_table',1),(182,'2014_10_12_100000_create_password_reset_tokens_table',1),(183,'2019_08_19_000000_create_failed_jobs_table',1),(184,'2019_12_14_000001_create_personal_access_tokens_table',1),(185,'2024_03_05_153056_crear_tabla_config_menu',1),(186,'2024_03_05_155318_crear_tabla_config_rol',1),(187,'2024_03_05_155451_crear_tabla_config_menu_rol',1),(188,'2024_03_05_182115_crear_tabla_config_permiso',1),(189,'2024_03_05_182245_crear_tabla_config_rol_permiso',1),(190,'2024_03_05_182527_crear_tabla_config_tipo_documento',1),(191,'2024_03_05_204241_crear_tabla_config_grupo_empresas',1),(192,'2024_03_15_012443_crear_tabla_confg_empresa',1),(193,'2024_03_15_012444_crear_tabla_config_apariencia',1),(194,'2024_03_15_195140_crear_tabla_empresa_area',1),(195,'2024_03_19_222456_crear_tabla_empresa_cargo',1),(196,'2024_03_27_010201_crear_tabla_config_usuario',1),(197,'2024_03_27_010202_crear_tabla_config_usuario_rol',1),(198,'2024_03_27_010203_crear_tabla_empresa_empleados',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-03 22:08:34
