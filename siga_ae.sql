-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2026 a las 20:40:12
-- Versión del servidor: 10.11.16-MariaDB
-- Versión de PHP: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `siga_ae`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sesion_clase_id` bigint(20) UNSIGNED NOT NULL,
  `matricula_id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(2) NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricula_id` bigint(20) UNSIGNED NOT NULL,
  `criterio_evaluacion_id` bigint(20) UNSIGNED NOT NULL,
  `nota` decimal(5,2) DEFAULT NULL,
  `docente_id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargas_lectivas`
--

CREATE TABLE `cargas_lectivas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unidad_didactica_id` bigint(20) UNSIGNED NOT NULL,
  `semestre_lectivo_id` bigint(20) UNSIGNED NOT NULL,
  `docente_id` bigint(20) UNSIGNED NOT NULL,
  `seccion_id` bigint(20) UNSIGNED NOT NULL,
  `turno_id` bigint(20) UNSIGNED NOT NULL,
  `cupo` varchar(20) DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargas_lectivas`
--

INSERT INTO `cargas_lectivas` (`id`, `unidad_didactica_id`, `semestre_lectivo_id`, `docente_id`, `seccion_id`, `turno_id`, `cupo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, 1, '30', 'activo', '2026-11-25 19:08:25', '2026-11-25 19:08:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterios_evaluacion`
--

CREATE TABLE `criterios_evaluacion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `carga_lectiva_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `indicador` varchar(180) DEFAULT NULL,
  `porcentaje` decimal(5,2) NOT NULL DEFAULT 0.00,
  `orden` smallint(5) UNSIGNED NOT NULL DEFAULT 1,
  `es_calificable` tinyint(1) NOT NULL DEFAULT 1,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `codigo_docente` varchar(30) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `especialidad` varchar(120) DEFAULT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `usuario_id`, `codigo_docente`, `apellidos`, `nombres`, `especialidad`, `telefono`, `estado`, `created_at`, `updated_at`) VALUES
(1, 3, 'DOC-001', 'Cabrera Málaga', 'Giovanni', 'Diseño y Desarrollo de Videojuegos', '999888777', 1, '2026-11-25 18:52:55', '2026-11-25 19:29:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `codigo_estudiante` varchar(30) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `usuario_id`, `codigo_estudiante`, `apellidos`, `nombres`, `documento`, `telefono`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, '20260001', 'Yapo Coaquira', 'Raul Andres', '40560348', '932519471', 1, '2026-11-25 16:28:24', '2026-11-25 16:28:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificaciones_asistencia`
--

CREATE TABLE `justificaciones_asistencia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asistencia_id` bigint(20) UNSIGNED NOT NULL,
  `motivo` varchar(250) NOT NULL,
  `nro_documento` varchar(80) DEFAULT NULL,
  `ruta_adjunto` varchar(255) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `usuario_registro_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED NOT NULL,
  `carga_lectiva_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_matricula` date NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id`, `estudiante_id`, `carga_lectiva_id`, `fecha_matricula`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-11-25', '1', '2026-11-25 19:09:02', '2026-11-25 19:09:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2026_11_25_000001_create_siga_ae_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos_formativos`
--

CREATE TABLE `modulos_formativos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programa_estudio_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulos_formativos`
--

INSERT INTO `modulos_formativos` (`id`, `programa_estudio_id`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'Módulo formativo 2026-B - Datos de prueba', 'Módulo provisional para organizar las asignaturas de ejemplo del periodo 2026-B', 1, '2026-11-25 15:54:01', '2026-11-25 15:54:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `modulo` varchar(60) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `codigo`, `nombre`, `modulo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'O11', 'Estudiantes', 'Archivos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(2, 'O12', 'Docentes', 'Archivos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(3, 'O13', 'Programas Estudio', 'Archivos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(4, 'O14', 'Módulos', 'Archivos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(5, 'O15', 'Itinerarios / Unidades Didácticas', 'Archivos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(6, 'O16', 'Periodos', 'Archivos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(7, 'O21', 'Importar Datos Matrícula', 'Procesos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(8, 'O22', 'Registrar / Asignar carga horaria', 'Procesos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(9, 'O23', 'Registrar Indicadores y Logro Aprendizaje', 'Procesos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(10, 'O24', 'Evaluaciones', 'Procesos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(11, 'O25', 'Asistencia Estudiantes', 'Procesos', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(12, 'O31', 'Asignaciones Carga Docente', 'Consultas', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(13, 'O32', 'Asistencia Estudiantes', 'Consultas', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(14, 'O33', 'Registro de Evaluación', 'Consultas', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(15, 'O34', 'Boleta de Notas', 'Consultas', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(16, 'O35', 'Acta Consolidada', 'Consultas', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(17, 'O41', 'Modificar Perfil', 'Herramientas', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(18, 'O42', 'Cerrar Periodo', 'Herramientas', NULL, '2026-11-25 15:35:27', '2026-11-25 15:35:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_rol`
--

CREATE TABLE `permiso_rol` (
  `rol_id` bigint(20) UNSIGNED NOT NULL,
  `permiso_id` bigint(20) UNSIGNED NOT NULL,
  `puede_visualizar` tinyint(1) NOT NULL DEFAULT 1,
  `puede_modificar` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permiso_rol`
--

INSERT INTO `permiso_rol` (`rol_id`, `permiso_id`, `puede_visualizar`, `puede_modificar`) VALUES
(1, 1, 1, 1),
(1, 2, 1, 1),
(1, 3, 1, 1),
(1, 4, 1, 0),
(1, 5, 1, 0),
(1, 6, 1, 1),
(1, 7, 1, 0),
(1, 8, 1, 0),
(1, 9, 1, 0),
(1, 10, 1, 0),
(1, 11, 1, 0),
(1, 12, 1, 1),
(1, 13, 1, 1),
(1, 14, 1, 1),
(1, 15, 1, 1),
(1, 16, 1, 1),
(1, 17, 1, 1),
(1, 18, 1, 1),
(2, 1, 1, 0),
(2, 2, 1, 0),
(2, 3, 1, 0),
(2, 4, 0, 1),
(2, 5, 0, 1),
(2, 6, 1, 0),
(2, 8, 0, 1),
(2, 12, 0, 1),
(2, 13, 1, 1),
(2, 14, 0, 1),
(2, 15, 0, 1),
(2, 16, 0, 1),
(2, 17, 0, 1),
(3, 1, 1, 0),
(3, 5, 1, 0),
(3, 9, 0, 1),
(3, 10, 0, 1),
(3, 11, 0, 1),
(3, 13, 1, 1),
(3, 14, 0, 1),
(3, 17, 0, 1),
(4, 4, 1, 0),
(4, 5, 1, 0),
(4, 13, 1, 0),
(4, 15, 1, 0),
(4, 17, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas_estudio`
--

CREATE TABLE `programas_estudio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `programas_estudio`
--

INSERT INTO `programas_estudio` (`id`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Desarrollo de Sistemas de Información', 'Programa de estudios del IESTP Pedro P. Díaz - Arequipa', 1, '2026-11-25 15:53:12', '2026-11-25 15:53:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Acceso total', '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(2, 'Coordinador Programa Estudios', 'Gestión académica', '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(3, 'Docente', 'Registro de asistencia y notas', '2026-11-25 15:35:27', '2026-11-25 15:35:27'),
(4, 'Estudiante', 'Consulta de información académica', '2026-11-25 15:35:27', '2026-11-25 15:35:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(120) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'A-PRUEBA', 'Sección de prueba para SIGA-AE', '2026-11-25 19:06:15', '2026-11-25 19:06:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres_lectivos`
--

CREATE TABLE `semestres_lectivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'planificado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `semestres_lectivos`
--

INSERT INTO `semestres_lectivos` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `estado`, `created_at`, `updated_at`) VALUES
(1, '2026-II - PRUEBA', '2026-08-01', '2026-12-31', '1', '2026-11-25 19:05:21', '2026-11-25 19:05:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones_clase`
--

CREATE TABLE `sesiones_clase` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `carga_lectiva_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `nro_sesion` smallint(5) UNSIGNED NOT NULL,
  `tema_desarrollado` varchar(200) DEFAULT NULL,
  `horas_dictadas` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `nombre`, `hora_inicio`, `hora_fin`, `created_at`, `updated_at`) VALUES
(1, 'Noche - PRUEBA', '18:00:00', '22:00:00', '2026-11-25 19:06:41', '2026-11-25 19:06:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_didacticas`
--

CREATE TABLE `unidades_didacticas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modulo_formativo_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `horas_totales` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `creditos` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidades_didacticas`
--

INSERT INTO `unidades_didacticas` (`id`, `modulo_formativo_id`, `nombre`, `horas_totales`, `creditos`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'Experiencias Formativas en Situaciones Reales de Trabajo', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(2, 1, 'Desarrollo de Videojuegos', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(3, 1, 'Arquitectura de Sistemas de Información', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(4, 1, 'Desarrollo Web Integrado', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(5, 1, 'Administración de Base de Datos', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(6, 1, 'Servicio Web', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(7, 1, 'Administración de Servidores Linux', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(8, 1, 'Programación Orientada a Objetos - Noche', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(9, 1, 'Inglés para la Comprensión y Redacción', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50'),
(10, 1, 'Interpretación y Producción de Textos-DSI-IV-Noche 2026-B', 0, 0, 1, '2026-11-25 15:54:50', '2026-11-25 15:54:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `primer_inicio` tinyint(1) NOT NULL DEFAULT 1,
  `ultimo_acceso` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `activo`, `primer_inicio`, `ultimo_acceso`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@siga-ae.local', '$2y$12$yhqVwif43H27KjeY9brVEuaH5H3exQdwYi7UXA7PEyuKZbi9p/bqm', 1, 0, '2026-11-25 19:25:15', NULL, '2026-11-25 15:35:27', '2026-11-25 19:25:15'),
(2, 'coordinador', 'coordinador@siga-ae.local', '$2y$12$ddnrWQqC3eSprt93gsEofOMDz2YMou/mW0cjc4TPSR3XhHSttpFCG', 1, 0, '2026-11-25 17:52:43', NULL, '2026-11-25 16:48:03', '2026-11-25 17:52:56'),
(3, 'docente', 'docente@siga-ae.local', '$2y$12$Pv84vBv5fI9JHI/9IRoxOuZ11tNfTu/XyYPMM3zknoYc7aGSDjnbi', 1, 0, '2026-11-25 19:30:14', NULL, '2026-11-25 16:48:03', '2026-11-25 19:30:14'),
(4, 'estudiante', 'estudiante@siga-ae.local', '$2y$12$71CqxJn/F1imQfkBz0SUXOy/v7iiwQQTOApisRSxsudyw1MxbdEtC', 1, 1, NULL, NULL, '2026-11-25 16:48:03', '2026-11-25 16:48:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `rol_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`usuario_id`, `rol_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asistencias_sesion_clase_id_matricula_id_unique` (`sesion_clase_id`,`matricula_id`),
  ADD KEY `asistencias_matricula_id_foreign` (`matricula_id`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `calificaciones_matricula_id_criterio_evaluacion_id_unique` (`matricula_id`,`criterio_evaluacion_id`),
  ADD KEY `calificaciones_criterio_evaluacion_id_foreign` (`criterio_evaluacion_id`),
  ADD KEY `calificaciones_docente_id_foreign` (`docente_id`),
  ADD KEY `calificaciones_estudiante_id_foreign` (`estudiante_id`);

--
-- Indices de la tabla `cargas_lectivas`
--
ALTER TABLE `cargas_lectivas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_carga_lectiva` (`unidad_didactica_id`,`semestre_lectivo_id`,`docente_id`,`seccion_id`,`turno_id`),
  ADD KEY `cargas_lectivas_semestre_lectivo_id_foreign` (`semestre_lectivo_id`),
  ADD KEY `cargas_lectivas_docente_id_foreign` (`docente_id`),
  ADD KEY `cargas_lectivas_seccion_id_foreign` (`seccion_id`),
  ADD KEY `cargas_lectivas_turno_id_foreign` (`turno_id`);

--
-- Indices de la tabla `criterios_evaluacion`
--
ALTER TABLE `criterios_evaluacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criterios_evaluacion_carga_lectiva_id_foreign` (`carga_lectiva_id`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `docentes_usuario_id_unique` (`usuario_id`),
  ADD UNIQUE KEY `docentes_codigo_docente_unique` (`codigo_docente`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estudiantes_usuario_id_unique` (`usuario_id`),
  ADD UNIQUE KEY `estudiantes_codigo_estudiante_unique` (`codigo_estudiante`),
  ADD UNIQUE KEY `estudiantes_documento_unique` (`documento`);

--
-- Indices de la tabla `justificaciones_asistencia`
--
ALTER TABLE `justificaciones_asistencia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `justificaciones_asistencia_asistencia_id_unique` (`asistencia_id`),
  ADD KEY `justificaciones_asistencia_usuario_registro_id_foreign` (`usuario_registro_id`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matriculas_estudiante_id_carga_lectiva_id_unique` (`estudiante_id`,`carga_lectiva_id`),
  ADD KEY `matriculas_carga_lectiva_id_foreign` (`carga_lectiva_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos_formativos`
--
ALTER TABLE `modulos_formativos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modulos_formativos_programa_estudio_id_nombre_unique` (`programa_estudio_id`,`nombre`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permisos_codigo_unique` (`codigo`);

--
-- Indices de la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD PRIMARY KEY (`rol_id`,`permiso_id`),
  ADD KEY `permiso_rol_permiso_id_foreign` (`permiso_id`);

--
-- Indices de la tabla `programas_estudio`
--
ALTER TABLE `programas_estudio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programas_estudio_nombre_unique` (`nombre`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nombre_unique` (`nombre`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `secciones_nombre_unique` (`nombre`);

--
-- Indices de la tabla `semestres_lectivos`
--
ALTER TABLE `semestres_lectivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sesiones_clase`
--
ALTER TABLE `sesiones_clase`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sesiones_clase_carga_lectiva_id_fecha_nro_sesion_unique` (`carga_lectiva_id`,`fecha`,`nro_sesion`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `turnos_nombre_unique` (`nombre`);

--
-- Indices de la tabla `unidades_didacticas`
--
ALTER TABLE `unidades_didacticas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unidades_didacticas_modulo_formativo_id_foreign` (`modulo_formativo_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_username_unique` (`username`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`usuario_id`,`rol_id`),
  ADD KEY `usuario_rol_rol_id_foreign` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargas_lectivas`
--
ALTER TABLE `cargas_lectivas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `criterios_evaluacion`
--
ALTER TABLE `criterios_evaluacion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `justificaciones_asistencia`
--
ALTER TABLE `justificaciones_asistencia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos_formativos`
--
ALTER TABLE `modulos_formativos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `programas_estudio`
--
ALTER TABLE `programas_estudio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `semestres_lectivos`
--
ALTER TABLE `semestres_lectivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sesiones_clase`
--
ALTER TABLE `sesiones_clase`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidades_didacticas`
--
ALTER TABLE `unidades_didacticas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_matricula_id_foreign` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistencias_sesion_clase_id_foreign` FOREIGN KEY (`sesion_clase_id`) REFERENCES `sesiones_clase` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_criterio_evaluacion_id_foreign` FOREIGN KEY (`criterio_evaluacion_id`) REFERENCES `criterios_evaluacion` (`id`),
  ADD CONSTRAINT `calificaciones_docente_id_foreign` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `calificaciones_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`),
  ADD CONSTRAINT `calificaciones_matricula_id_foreign` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cargas_lectivas`
--
ALTER TABLE `cargas_lectivas`
  ADD CONSTRAINT `cargas_lectivas_docente_id_foreign` FOREIGN KEY (`docente_id`) REFERENCES `docentes` (`id`),
  ADD CONSTRAINT `cargas_lectivas_seccion_id_foreign` FOREIGN KEY (`seccion_id`) REFERENCES `secciones` (`id`),
  ADD CONSTRAINT `cargas_lectivas_semestre_lectivo_id_foreign` FOREIGN KEY (`semestre_lectivo_id`) REFERENCES `semestres_lectivos` (`id`),
  ADD CONSTRAINT `cargas_lectivas_turno_id_foreign` FOREIGN KEY (`turno_id`) REFERENCES `turnos` (`id`),
  ADD CONSTRAINT `cargas_lectivas_unidad_didactica_id_foreign` FOREIGN KEY (`unidad_didactica_id`) REFERENCES `unidades_didacticas` (`id`);

--
-- Filtros para la tabla `criterios_evaluacion`
--
ALTER TABLE `criterios_evaluacion`
  ADD CONSTRAINT `criterios_evaluacion_carga_lectiva_id_foreign` FOREIGN KEY (`carga_lectiva_id`) REFERENCES `cargas_lectivas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `justificaciones_asistencia`
--
ALTER TABLE `justificaciones_asistencia`
  ADD CONSTRAINT `justificaciones_asistencia_asistencia_id_foreign` FOREIGN KEY (`asistencia_id`) REFERENCES `asistencias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `justificaciones_asistencia_usuario_registro_id_foreign` FOREIGN KEY (`usuario_registro_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_carga_lectiva_id_foreign` FOREIGN KEY (`carga_lectiva_id`) REFERENCES `cargas_lectivas` (`id`),
  ADD CONSTRAINT `matriculas_estudiante_id_foreign` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`);

--
-- Filtros para la tabla `modulos_formativos`
--
ALTER TABLE `modulos_formativos`
  ADD CONSTRAINT `modulos_formativos_programa_estudio_id_foreign` FOREIGN KEY (`programa_estudio_id`) REFERENCES `programas_estudio` (`id`);

--
-- Filtros para la tabla `permiso_rol`
--
ALTER TABLE `permiso_rol`
  ADD CONSTRAINT `permiso_rol_permiso_id_foreign` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permiso_rol_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sesiones_clase`
--
ALTER TABLE `sesiones_clase`
  ADD CONSTRAINT `sesiones_clase_carga_lectiva_id_foreign` FOREIGN KEY (`carga_lectiva_id`) REFERENCES `cargas_lectivas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `unidades_didacticas`
--
ALTER TABLE `unidades_didacticas`
  ADD CONSTRAINT `unidades_didacticas_modulo_formativo_id_foreign` FOREIGN KEY (`modulo_formativo_id`) REFERENCES `modulos_formativos` (`id`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuario_rol_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
